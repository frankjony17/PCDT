<?php

namespace Transporte\TransporteBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ChoferRepository extends EntityRepository
{
    /**
     * Listar todos los choferes de la Unidad Organizativa actual.
     * 
     * @param type $uo_id ID de la Unidad Organizativa del usuario logeado en el sistema.
     * 
     * @return Object
     */
    public function findChoferes($uo_id)
    {
        $query = $this
                ->getEntityManager()
                ->createQuery('SELECT ch FROM TransporteBundle:Chofer ch '.
                        'JOIN ch.trabajador t JOIN t.area a JOIN a.unidadOrganizativa uo WHERE uo.id = :id');
        $query->setParameter('id', $uo_id);
        
        return $query->getResult(\Doctrine\ORM\Query::HYDRATE_OBJECT);
    }
    
    /**
     * Encontrar si la licencia existe.
     * 
     * @param type $licencia Número de Licencia.
     * @param type $chofer_id ID trabajador
     * 
     * @return Boleano
     */
    public function findSiLicenciaExiste($licencia, $chofer_id=\NULL)
    {
        ($chofer_id != \NULL) ? $andChoferId = ' AND ch.id <> '.$chofer_id : $andChoferId = '';
        
        $query = $query = $this
                ->getEntityManager()
                ->createQuery('SELECT COUNT(ch.licencia) FROM TransporteBundle:Chofer ch WHERE ch.licencia = :licencia'.$andChoferId);
        $query->setParameter('licencia', $licencia);
        
        $result = $query->getSingleScalarResult();
        
        if ($result == 0)
        {
            return \TRUE;
        } else {
            return \FALSE;
        }
    }
    
//    /**
//     * Obtener los choferes según departamento y cargo del mismo ó obtenerlos todos...
//     * 
//     * @param integer $cargo_id clave primaria de Cargo.
//     * @param integer $departamento_id clave primaria de Departamento...
//     */
//    public function findByCargoAndDepartamento($cargo_id, $departamento_id)
//    {
//        $em = $this->getEntityManager();
//       //Declarando criterio vacio, devolveria todo... 
//        $criteria = '';
//       //Agregando criterio, depende de los parametros y sus valores... 
//        if ($cargo_id != '' && $departamento_id != '')
//        {
//            $criteria .= ' WHERE t.cargo = '.$cargo_id.' AND t.departamento = '.$departamento_id;
//        }
//        else if ($cargo_id != '')
//        {
//            $criteria .= ' WHERE t.cargo = '. $cargo_id;
//        }
//        else if ($departamento_id != '')
//        {
//            $criteria .= ' WHERE t.departamento = '. $departamento_id;
//        }
//       //Creando consulta... 
//        $query = $em->createQuery('SELECT ch.id, t.nombre, t.apellidos FROM TransporteBundle:Chofer ch JOIN ch.trabajador t'.$criteria);
//       //Retorno resultado de la consulta como un arreglo... 
//        return $query->getArrayResult();
//    }
}