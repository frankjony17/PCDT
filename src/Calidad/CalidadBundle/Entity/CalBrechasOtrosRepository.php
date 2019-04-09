<?php

namespace Calidad\CalidadBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\DateTime;

class CalBrechasOtrosRepository extends EntityRepository
{
    /**
     * @param $tipo
     * @param $estado
     * @param $fechaIni
     * @param $fechaFin
     * @param null $uo_id
     * @return CalBrechasOtros
     */
    public function findBrechasOtros($tipo, $estado, $fechaIni, $fechaFin, $trabajador, $uo_id=\NULL)
    {

        $tipo != "" ? $andTipo = " AND bo.tipo = '".$tipo."'" : $andTipo = "";
        $estado != "" ? $andEstado = " AND bo.estado = '".$estado."'" : $andEstado = " AND bo.estado = false";
        $fechaIni != "" ? $andFechaIni = " AND bo.fecha >= '".$fechaIni."'" : $andFechaIni = "";
        $fechaFin != "" ? $andFechaFin = " AND bo.fecha <= '".$fechaFin."'" : $andFechaFin = "";
        $trabajador != "" ? $andTrabajadorId = " AND tt.id = '".$trabajador."'" : $andTrabajadorId = "";

        $query = $this
                ->getEntityManager()
                ->createQuery("SELECT bo FROM CalidadBundle:CalBrechasOtros bo
                        JOIN bo.trabajador tt
                        JOIN bo.controlCalidad cc
                        JOIN cc.uo uo
                        WHERE uo.id = :uo_id".$andTipo.$andEstado.$andFechaIni.$andFechaFin.$andTrabajadorId." ORDER BY bo.fecha ASC");
        $query->setParameter("uo_id", $uo_id);

        return $query->getResult(\Doctrine\ORM\Query::HYDRATE_OBJECT);
    }
}