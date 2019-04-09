<?php

namespace Otros\TareaOperativaBundle\Entity;

use Doctrine\ORM\EntityRepository;

class AccionTareaOperativaRepository extends EntityRepository
{

    /**
     * Find all Tareas Operativas from one Unidad Organizativa.
     * @param $area
     * @param $estado
     * @param $inicial
     * @param $final
     * @param null $uo_id
     * @return Object
     */
    public function findAcciones($area, $estado, $inicial, $final, $uo_id=\NULL)
    {
        $area != "" ? $andAreaId = " AND a.id = ".$area : $andAreaId = "";
        $estado != "" ? $andEstado = " AND e.estado = '".$estado."' AND e.fecha = (SELECT MAX(eto.fecha) FROM TareaOperativaBundle:EstadoTareaOperativa eto WHERE eto.tareaOperativa = top)" : $andEstado = "";
        $inicial != "" ? $andFechaIni = " AND top.fechaCreacion >= '".$inicial."'" : $andFechaIni = "";
        $final != "" ? $andFechaFin = " AND e.fechaFinal <= '".$final."'" : $andFechaFin = "";

        $query = $this
            ->getEntityManager()
            ->createQuery("SELECT atop FROM TareaOperativaBundle:AccionTareaOperativa atop
                JOIN atop.tareaOperativa top
                JOIN top.tareaOperativaTrabajador topt
                JOIN top.estadoTareaOperativa e
                JOIN topt.trabajador t
                JOIN t.area a
                JOIN a.unidadOrganizativa uo
                WHERE uo.id = :uo_id ".$andAreaId.$andEstado.$andFechaIni.$andFechaFin." ORDER BY atop.fecha DESC");

        $query->setParameter("uo_id", $uo_id);

        return $query->getResult(\Doctrine\ORM\Query::HYDRATE_OBJECT);
    }
}