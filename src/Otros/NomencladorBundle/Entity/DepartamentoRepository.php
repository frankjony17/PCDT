<?php

namespace Otros\NomencladorBundle\Entity;

use Doctrine\ORM\EntityRepository;

class DepartamentoRepository extends EntityRepository
{
    /**
     * Encuentra los deaprtamentos sin repetirlos.
     * 
     * @return object
     */
    public function findDistinctDepartamentos()
    {
        $query = $this
                ->getEntityManager()
                ->createQuery('SELECT distinct(d.nombre) as nombre FROM NomencladorBundle:Departamento d');
        try
        {
            $result = $query->getArrayResult();
        }
        catch (\Doctrine\Orm\NoResultException $ex)
        {
            return \NULL;
        }
        return $result;
    }
    
    /**
     * Contar los departamentos que existen.
     * 
     * @return int
     */
    public function findCantidadDepartamento()
    {   
        $query = $this
                ->getEntityManager()
                ->createQueryBuilder()
                ->select('count(d) as cantidad')
                ->from('NomencladorBundle:Departamento', 'd')
                ->getQuery();
        try
        {
            $result = $query->getSingleResult();
        }
        catch (\Doctrine\Orm\NoResultException $ex)
        {
            return 0;
        }
        return $result['cantidad'];
    }
}