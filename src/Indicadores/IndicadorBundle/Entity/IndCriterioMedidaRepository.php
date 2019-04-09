<?php

namespace Indicadores\IndicadorBundle\Entity;

use Doctrine\ORM\EntityRepository;

class IndCriterioMedidaRepository extends EntityRepository
{
    /**
     * CriterioMedida por Unidad Organizativa y Año.
     *
     * @param $fecha
     * @param $uo_id
     * @return array
     */
    public function findCriterioMedida($fecha, $uo_id)
    {
        $query = $this
                ->getEntityManager()
                ->createQuery("SELECT cm FROM IndicadorBundle:IndCriterioMedida cm
                        JOIN cm.objetivo o
                        JOIN o.arc arc
                        JOIN cm.trabajador t
                        JOIN t.area a
                        JOIN a.unidadOrganizativa uo
                        WHERE uo.id = :id AND arc.fecha = :fecha ORDER BY o.nombre ASC");
        $query->setParameter("id", $uo_id);
        $query->setParameter("fecha", $fecha);

        return $query->getResult(\Doctrine\ORM\Query::HYDRATE_OBJECT);
    }
}