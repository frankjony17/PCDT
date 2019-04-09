<?php

namespace Seguridad\AdminBundle\Entity;

use Doctrine\ORM\EntityRepository;

class UsersRepository extends EntityRepository
{
    /**
     * Listar todos los usuarios.
     */
    public function findUsers($uo_id)
    {
        $em = $this->getEntityManager(); $users = array();
        try
        {
            $fetch = $em->getConnection()->fetchAll(
                'SELECT users.id as id, users.username as username, users.date_last_login as date_last_login, '.
                       'users.time_last_login as time_last_login, users.is_active as is_active, users.correo as email, '.
                       'trabajador.nombre_apellidos as nombre_apellidos, trabajador.movil as movil, trabajador.id as trab_id, '.
                       'area.nombre as area, unidad_organizativa.nombre as unidad_organizativa '.
                'FROM users '.
                'JOIN trabajador ON (users.trabajador_id = trabajador.id) '.
                'JOIN area ON (trabajador.area_id = area.id) '.
                'JOIN unidad_organizativa ON (area.unidad_organizativa_id = unidad_organizativa.id AND unidad_organizativa.id = '. $uo_id .');');
            
            foreach ($fetch as $val)
            {
                $user = $this->find($val['id']);
                $trab = $em->getRepository('NomencladorBundle:Trabajador')->find($val['trab_id']);
                        
                $users[] = array(
                    'id'                   => $val['id'],
                    'username'             => $val['username'],
                    'nombre'               => $val['nombre_apellidos'],
                    'movil'                => ($val['movil']) ? $val['movil'] : 'No se conoce.',
                    'email'                => ($val['email']) ? $val['email'] : 'No se conoce.',
                    'cargo'                => ($trab->getCargo()) ? $trab->getCargo()->getNombre() : 'No se conoce.',
                    'area'                 => $trab->getArea()->getNombre(),
                    'last_login'           => $val['date_last_login'] .' '. $val['time_last_login'],
                    'is_active'            => $val['is_active'],
                    'roles'                => $user->getStringRoles()
                );
            }
            return $users;
        }
        catch (\Exception $e)
        {
            return $e->getMessage();
        }        
    }
    
    /**
     * Listar trabajadores de la Base de Datos que no son usuarios.
     * 
     * @param type $area_id ID de Area.
     * @return array
     */
    public function findUsersFromDataBase($area_id, $limit, $start, $uo_id)
    {
        $em = $this->getEntityManager();
        $worker = array();
        $area_id != '' ? $andArea = ' AND a.id = '.$area_id : $andArea = '';
        $AndTrabajadorIds = '';
        
        foreach ($this->findAll() as $user)
        {
            $AndTrabajadorIds .= ' AND t.id <> '.$user->getTrabajadorId();
        }
        $query = $em
            ->createQuery('SELECT t FROM NomencladorBundle:Trabajador t JOIN t.area a JOIN a.unidadOrganizativa uo '.
                    'WHERE uo.id = '.$uo_id.$andArea.$AndTrabajadorIds);
        
        $result = $query->getResult(\Doctrine\ORM\Query::HYDRATE_OBJECT);
        
        $limit += $start;
        
        $limit > \count($result) ? $limit = \count($result) : $limit;
        
        for ($i = $start; $i < $limit; $i++)
        {
            $val = $result[$i];
            
            $array_nombre = explode(' ', $val->getNombreApellidos());

            $worker[] = array(
                'id'   => $val->getId(),
                'cn'   => $val->getNombreApellidos(),
                'uid'  => $this->strtolower($array_nombre[0] .'.'. $array_nombre[1]),
                'mail' => 'No se conoce..'
            );
        }
        return $worker;
    }
    
    /**
     * Listar trabajadores del servidor LDAP.
     */
    public function findUsersFromLDAP($cdt_util)
    {
        $ldap_config = $cdt_util->parse('Seguridad/AdminBundle/Resources/config', 'ldap.yml');
        
        $ds = ldap_connect($ldap_config['host'], $ldap_config['port']);
        
        ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION,3);
        ldap_set_option($ds, LDAP_OPT_REFERRALS,0);
        
        try
        {
            $r = ldap_search( $ds, $ldap_config['basedn'], $ldap_config['ou'], array("uid", "cn", "mail"));
            
            if($r)
            {
                $user_array = array();
                $user_lista = ldap_get_entries( $ds, $r);
                
                foreach ($user_lista as $user)
                {
                    if($user["uid"][0] != '')
                    {
                        $user_array[] = array(
                            'id'   => 'LDAP',
                            'uid'  => $user["uid"][0],
                            'cn'   => $user["cn"][0],
                            'mail' => $user["mail"][0]
                        ); 
                    }
                }
                return $user_array;
            } 
        }
        catch (\Exception $exc)
        {
            return '0';
        }
    }
    
    /**
     * Contar los trabajadores que forman parte de la estructura de Interna y no son usuarios.
     * 
     * @return int
     */
    public function findCantidadTrabajadores($uo_id)
    {   
        $trabajadorId = '';
        
        foreach ($this->findAll() as $user)
        {
            $trabajadorId .= ' t.id <> '.$user->getTrabajadorId() .' AND';
        }
        ($trabajadorId !== '') ?  $where = ' WHERE uo.id = '.$uo_id.' AND '. \rtrim($trabajadorId, ' AND') : $where = '';
        
        $query = $this
                ->getEntityManager()
                ->createQuery('SELECT COUNT(t) AS cantidad FROM NomencladorBundle:Trabajador t '.
                              'JOIN t.area a JOIN a.unidadOrganizativa uo'.$where);
        try
        {
            $result = $query->getSingleResult();
            
            return $result['cantidad'];
        }
        catch (\Doctrine\Orm\NoResultException $ex)
        {
            return 0;
        }
    }    
    
    /**
     * Verificar si existe un usuario con los datos ($username, $email) además del
     * usuario reprecentado por el id.
     * 
     * @param type $id
     * @param type $username
     * @param type $email
     * 
     * @return array Resultado de la consulta.
     */
    public function countUsers($id, $username, $email)
    {
        $query = $this->getEntityManager()->createQueryBuilder()
            ->select('u.username')
            ->from('AdminBundle:Users', 'u')
            ->where('u.id <> :id and (u.username = :username or u.correo = :email)')
            ->setParameter('id', $id)
            ->setParameter('username', $username)
            ->setParameter('email', $email)->getQuery();
        
        try
        {
            return $query->getResult();
        }
        catch (\Doctrine\Orm\NoResultException $ex)
        {
            return 1;
        }        
    }
    
    /**
     * Convierte en minusculas los caracteres de un STRING.
     * 
     * @param string $string Cadena en mayuscula a convertir en minuscula.
     * @return string
     */
    private function strtolower($string)
    {
        $search = array("Á", "É", "Í", "Ó", "Ú", "Ñ");
        $replace = array("á", "é", "í", "ó", "ú", "ñ");

        return strtolower(str_replace($search, $replace, $string));    
    }
}
