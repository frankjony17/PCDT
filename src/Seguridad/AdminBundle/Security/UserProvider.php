<?php

namespace Seguridad\AdminBundle\Security;

use Doctrine\Bundle\DoctrineBundle\Registry;

use Seguridad\AdminBundle\Security\Util;

class UserProvider
{
    private $em, $doctrine, $util;
            
    function __construct(Registry $doctrine, Util $util)
    {
        $this->em = $doctrine->getManager();
        
        $this->doctrine = $doctrine;
        
        $this->util = $util;
    }

    /**
     * Comrobar si el usuario existe en el directorio activo LDAP y verificar password.
     *
     * @param string $username Username del usuario.
     * @param string $password Password del usuario.
     * @return bool|string
     */
    public function loadUserFromLdap($username, $password)
    {   
        $ldap_config = $this->util->parse('Seguridad/AdminBundle/Resources/config', 'ldap.yml');
        // Positive LDAP link identifier on success, or FALSE on error.
        $ds = @ldap_connect($ldap_config['host'], $ldap_config['port']);

        ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
        // TRUE on success or FALSE on failure.
        if (@ldap_bind($ds))
        {   // Buscar usuario en servidor ldap.
            @$r = @ldap_search( $ds, 'ou=etecsa.cu,ou=people,dc=etecsa,dc=cu', 'uid=' . $username);
            // Si el usuario existe?
            if ($r)
            {   // Obtengo informacion del usuario.
                $result = ldap_get_entries($ds, $r);
                // Si tengo la informacion.
                if ($result['count'] > 0)
                {   // Compruebo password.
                    @$ldapbind = ldap_bind($ds, $result[0]['dn'], $this->util->getPlainText($password));
                    // Retorno TRUE on success or FALSE on failure.
                    if ($ldapbind === true)
                    {
                        return $ldapbind;
                    }
                    // Credenciales Invalidas.
                    return '2';
                }
            }
            // No existe una entrada para ese usuario.
            return '1';
        }
        // No se puede conectar al servidor LDAP.
        return false;
    }

    /**
     * Cargar usuario de la base de datos a partir del username y comrobar que tiene el rol necesario para
     * acceder al modulo seleccionado.
     *
     * @param string $username Username del usuario.
     * @param string $rolename Nombre del rol.
     * @return \Seguridad\AdminBundle\Entity\Users|string
     */
    public function loadUserByUsername($username, $rolename)
    {   // Salida.
        $output = '0';
        // Seleccionar usuario por username.
        $user = $this->em->getRepository('AdminBundle:Users')->findOneBy(array('username' => $username));
        // Existe el usuario?
        if ($user)
        {   // Entre los roles del usuario existe uno con el nombre de la aplicacion a la cual quiere entrar?
            foreach ($user->getRoles() as $role)
            {   // Si existe lo retorno.
                if (parse_str('ROLE_'. strtoupper($rolename)) == parse_str($role))
                {
                    return $user;
                }
                $output = '2'; // Credenciales Invalidas.
            }
        }
        // Usuario no posee el role solicitado.
        return $output;
    }
    
    /**
     * Obtener el trabajador que representa el user name.
     * 
     * @param string $username User name.
     * @return array
     */
    public function loadDataByUsername($username)
    {
        $conn = $this->doctrine->getConnection();
        
        $fetch = $conn->fetchAll(
                'SELECT'.
                    ' trabajador.id as trabajador_id, trabajador.nombre_apellidos as nombre_apellidos,'.
                    ' departamento.id as departamento_id, departamento.nombre as departamento,'.
                    ' area.id as area_id, area.nombre as area,'.
                    ' unidad_organizativa.id as unidad_organizativa_id, unidad_organizativa.nombre as unidad_organizativa'.
                ' FROM users '.
                    'JOIN trabajador ON (users.trabajador_id = trabajador.id AND users.username = \''.$username.'\') '.
                    'JOIN departamento ON (trabajador.departamento_id = departamento.id) '.
                    'JOIN area ON (trabajador.area_id = area.id) '.
                    'JOIN unidad_organizativa ON (area.unidad_organizativa_id = unidad_organizativa.id);');
        
        if (count($fetch) > 0)
        {
            return $fetch[0];
        }
        return false;
    }
}
