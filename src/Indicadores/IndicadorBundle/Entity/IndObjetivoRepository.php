<?php

namespace Indicadores\IndicadorBundle\Entity;

use Doctrine\ORM\EntityRepository;

class IndObjetivoRepository extends EntityRepository
{
    /**
     * Objetivos por Año.
     *
     * @return Objetivos
     */
    public function findObjetivos($fecha)
    {
        $query = $this
                ->getEntityManager()
                ->createQuery("SELECT o FROM IndicadorBundle:IndObjetivo o
                        JOIN o.arc arc WHERE arc.fecha = :fecha ORDER BY o.nombre ASC");
        $query->setParameter("fecha", $fecha);

        return $query->getResult(\Doctrine\ORM\Query::HYDRATE_OBJECT);
    }
}