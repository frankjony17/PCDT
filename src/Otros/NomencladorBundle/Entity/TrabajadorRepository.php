<?php

namespace Otros\NomencladorBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TrabajadorRepository extends EntityRepository
{
    /**
     * Contar los trabajadores que existen.
     * 
     * @return int
     */
    public function findCantidadTrabajadores($value, $uo_id=\NULL)
    {   
        if ($value === 'interno')
        {
             $joinArea = ' JOIN t.area a JOIN a.unidadOrganizativa uo';
             $where = ' WHERE uo.id = '.$uo_id;
        } else {
            $where = ' WHERE t.area IS NULL'; $joinArea = '';
        }
        $query = $this
                ->getEntityManager()
                ->createQuery('SELECT COUNT(t) AS cantidad FROM NomencladorBundle:Trabajador t'.$joinArea.$where);
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
     * Encontrar Trabajadores.
     * 
     * @param type $value
     * @param type $limit
     * @param type $start
     * 
     * @return array
     */
    public function findTrabajadores($value, $limit, $start, $uo_id=\NULL)
    {
        $em = $this->getEntityManager(); $trabajadores = array(); $andNameIs = '';
        $where = ' WHERE trabajador.area_id IS NULL ORDER BY departamento.nombre '; $areaName = ''; $innerJoinArea = '';
        try
        {
            if ($value !== 'interno' && $value !== 'externo') // Trabajador Externo (Si existe valor del departamento).
            {
                $andNameIs = ' AND departamento.nombre = \''.$value.'\'';
            }
            else if ($value === 'interno') // Trabajador Interno ($value = interno).
            {
                $where = '';
                $areaName = ', area.nombre AS area ';
                $innerJoinArea = ' INNER JOIN area ON (trabajador.area_id = area.id)'.
                                 ' INNER JOIN unidad_organizativa ON (area.unidad_organizativa_id = unidad_organizativa.id AND unidad_organizativa.id = '. $uo_id .') ORDER BY area.nombre ';
            }
            $fetch = $em
                ->getConnection()
                ->fetchAll('SELECT trabajador.id, trabajador.numero_plaza, trabajador.nombre_apellidos, trabajador.movil, '.
                                  'trabajador.area_id, trabajador.cargo_id, departamento.nombre'.$areaName.' '.
                           'FROM trabajador '.
                           'INNER JOIN departamento ON (trabajador.departamento_id = departamento.id'.$andNameIs.')'.
                            $innerJoinArea.
                            $where.
                           'LIMIT '. $limit .' OFFSET '. $start .';');
            //-!
            foreach ($fetch as $value)
            {
                $cargo = $value['cargo_id'] ? $em->find('NomencladorBundle:Cargo', $value['cargo_id']) : \NULL;
                
                $trabajadores[] = array(
                    'id'              => $value['id'],
                    'numeroPlaza'     => $value['numero_plaza'],
                    'nombreApellidos' => $value['nombre_apellidos'],
                    'movil'           => $value['movil'],
                    'cargo'           => $cargo ? $cargo->getNombre() : 'Sin asignar.',
                    'area'            => ($areaName !== '') ? $value['area'] : '',
                    'departamento'    => $value['nombre']
                );
            }
            return $trabajadores;
        }
        catch (\Doctrine\DBAL\DBALException $ex)
        {
            return $ex->getEntityManager();
        }        
    }

    /**
     * Encontrar trabajadores que son usuarios del sistema.
     *
     * @param $uo_id
     * @return array|string
     */
    public function findTrabajadoresUser($uo_id)
    {
        $em = $this->getEntityManager(); $trabajadores = array();
        try
        {
            $fetch = $em->getConnection()->fetchAll(
                'SELECT trabajador.id as id, trabajador.nombre_apellidos as nombre_apellidos, cargo.nombre as cargo,
                        area.nombre as area, departamento.nombre as departamento
                 FROM trabajador
                 JOIN users ON (trabajador.id = users.trabajador_id)
                 JOIN area ON (trabajador.area_id = area.id)
                 JOIN cargo ON (trabajador.cargo_id = cargo.id)
                 JOIN departamento ON (trabajador.departamento_id = departamento.id)
                 JOIN unidad_organizativa ON (area.unidad_organizativa_id = unidad_organizativa.id AND unidad_organizativa.id = '. $uo_id .');');

            foreach ($fetch as $val)
            {
                $trabajadores[] = array(
                    'id'              => $val['id'],
                    'nombreApellidos' => $val['nombre_apellidos'],
                    'cargo'           => $val["cargo"],
                    'area'            => $val["area"],
                    'departamento'    => $val["departamento"]
                );
            }
            return $trabajadores;
        }
        catch (\Exception $e)
        {
            return $e->getMessage();
        }
    }

    /**
     * Seleccionar un trabajadoe por UO y nombre.
     *
     * @param $nombre
     * @param null $uo_id
     * @return array
     */
    public function findOneTrabajador($nombre, $uo_id=\NULL)
    {
        $query = $this
            ->getEntityManager()
            ->createQuery("SELECT t FROM NomencladorBundle:Trabajador t
                        JOIN t.area a
                        JOIN a.unidadOrganizativa uo
                        WHERE uo.id = :id AND t.nombreApellidos = :nombre");
        $query->setParameter("id", $uo_id);
        $query->setParameter("nombre", $nombre);

        return $query->getSingleResult(\Doctrine\ORM\Query::HYDRATE_SIMPLEOBJECT);
    }
}