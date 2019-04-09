<?php

namespace Otros\TareaOperativaBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\DateTime;

class TareaOperativaRepository extends EntityRepository
{
    /**
     * Tareas operativas por Unidad Organizativa.
     * 
     * @return TareaOperativa
     */
    public function findTareasOperativas($estado, $dep_id, $uo_id=\NULL)
    {
        $estado != "" ? $andEstado = " AND e.estado = '".$estado."' AND e.fecha = (SELECT MAX(eto.fecha) FROM TareaOperativaBundle:EstadoTareaOperativa eto WHERE eto.tareaOperativa = top)" : $andEstado = "";
        $dep_id != "" ? $andRespon = " AND d.id = '".$dep_id."'" : $andRespon = "";

        $query = $this
                ->getEntityManager()
                ->createQuery("SELECT top FROM TareaOperativaBundle:TareaOperativa top
                        JOIN top.tareaOperativaTrabajador tot
                        JOIN top.estadoTareaOperativa e
                        JOIN tot.trabajador t
                        JOIN t.departamento d
                        JOIN t.area a
                        JOIN a.unidadOrganizativa uo WHERE uo.id = :uo_id ".$andEstado.$andRespon." ORDER BY top.numero ASC");
        $query->setParameter("uo_id", $uo_id);

        return $query->getResult(\Doctrine\ORM\Query::HYDRATE_OBJECT);
    }

    /**
     * Tareas operativas por Unidad Organizativa y año.
     *
     * @return TareaOperativa
     */
    public function findDataChart($dep_id, $uo_id=\NULL)
    {
        $dep_id != "" ? $andRespon = " AND d.id = '".$dep_id."'" : $andRespon = "";

        $query = $this
            ->getEntityManager()
            ->createQuery("SELECT top FROM TareaOperativaBundle:TareaOperativa top
                        JOIN top.tareaOperativaTrabajador tot
                        JOIN tot.trabajador t
                        JOIN t.departamento d
                        JOIN t.area a
                        JOIN a.unidadOrganizativa uo
                        WHERE uo.id = :uo_id ".$andRespon." AND top.fechaCreacion >= '".date('Y-01-01')."'
                           AND top.fechaCreacion <= '".date('Y-12-31')."' ORDER BY top.numero ASC");
        $query->setParameter("uo_id", $uo_id);

        return $query->getResult(\Doctrine\ORM\Query::HYDRATE_OBJECT);
    }
    
    /**
     * Obtener el número maximo de las tareas OPerativas en un año.
     * 
     * @return string.
     */
    public function findMaxNumero($uo_id=\NULL)
    {
        $parms = array($uo_id, date('Y'));

        $fetch = $this
                ->getEntityManager()
                ->getConnection()
                ->fetchAll('SELECT MAX(numero) AS numero FROM tarea_operativa
                    JOIN tarea_operativa_trabajador ON (tarea_operativa.id = tarea_operativa_trabajador.tarea_operativa_id)
                    JOIN trabajador ON (trabajador.id = tarea_operativa_trabajador.trabajador_id)
                    JOIN area ON (trabajador.area_id = area.id)
                    JOIN unidad_organizativa ON (area.unidad_organizativa_id = unidad_organizativa.id)
                    WHERE unidad_organizativa.id = ? AND DATE_PART(\'year\', tarea_operativa.fecha_creacion) = ?;', $parms);
                
        return $fetch[0]['numero'] + 1;
    }

    /**
     * Tareas Operativas Pendientes que tienen fecha tope
     * @param null $uo_id
     * @return object
     */
    public function findTareasEmail($uo_id=\NULL)
    {
        $tareas_oper_array = array();
        $tareas_operativas = $this->findTareasOperativas("Pendiente", $uo_id);

        foreach ($tareas_operativas as $tarea)
        {
            $array_periodo = $this->get_array($tarea);

            switch ($array_periodo["periodo"]) {
                case "Diario":
                    ($diario = $this->diario($array_periodo, $tareas_oper_array)) !== FALSE ? $tareas_oper_array = $diario : null;
                    break;
                case "Quincenal":
                    ($quincenal = $this->quincenal($array_periodo, $tareas_oper_array)) !== FALSE ? $tareas_oper_array = $quincenal : null;
                    break;
                case "Mensual":
                    ($mensual = $this->mensual($array_periodo, $tareas_oper_array)) !== FALSE ? $tareas_oper_array = $mensual : null;
                    break;
                default:
                    ($semanal = $this->semanal($array_periodo, $tareas_oper_array)) !== FALSE ? $tareas_oper_array = $semanal : null;
                    break;
            }
        }
        return $tareas_oper_array;
    }

    private function diario ($array_periodo, $tareas_oper_array)
    {   // El diá de mañana. [Monday, Monday, Wednesday, Thursday, Friday]
        $dia = date('l', strtotime(date('Y-m-d',time()+84600)));
        // Si no es sábado o domingo.
        if ($dia !== "Saturday" && $dia !== "Sunday")
        {
            return $this->get_values($array_periodo, $tareas_oper_array);
        }
        return FALSE;
    }

    private function semanal ($array_periodo, $tareas_oper_array)
    {
        foreach ($array_periodo["dias"] as $dia)
        {
            if ($dia === date('l', strtotime(date('Y-m-d',time()+84600))))
            {
                return $this->get_values($array_periodo, $tareas_oper_array);
            }
        }
        return FALSE;
    }

    private function quincenal ($array_periodo, $tareas_oper_array)
    {
        foreach ($array_periodo["dias"] as $dia)
        {
            if ($dia === date('l', strtotime(date('Y-m-d',time()+84600))))
            {
                if (is_object($array_periodo["chequeo"]->getFecha()))
                {
                    if ($this->count_dias(date("Y-m-d", time()+84600), $array_periodo["chequeo"]->getFecha()->format("Y-m-d")) == 14)
                    {
                        $this->edit_fecha($array_periodo["chequeo"]);
                        return $this->get_values($array_periodo, $tareas_oper_array);
                    }
                }
                else
                {
                    $this->edit_fecha($array_periodo["chequeo"]);
                    return $this->get_values($array_periodo, $tareas_oper_array);
                }
            }
        }
        return FALSE;
    }

    private function mensual ($array_periodo, $tareas_oper_array)
    {
        foreach ($array_periodo["dias"] as $dia)
        {
            if ($dia === date('l', strtotime(date('Y-m-d',time()+84600))))
            {
                if (is_object($fecha = $array_periodo["chequeo"]->getFecha()))
                {
                    if ($this->count_dias(date("Y-m-d", time()+84600), $array_periodo["chequeo"]->getFecha()->format("Y-m-d")) > 31)
                    {
                        $this->edit_fecha($array_periodo["chequeo"]);
                        return $this->get_values($array_periodo, $tareas_oper_array);
                    }
                }
                else
                {
                    $this->edit_fecha($array_periodo["chequeo"]);
                    return $this->get_values($array_periodo, $tareas_oper_array);
                }
            }
        }
        return FALSE;
    }

    private function get_array ($tarea_operativa)
    {
        $array = array();
        foreach ($tarea_operativa->getChequeoTareaOperativa() as $chequeo)
        {
            switch ($chequeo->getPeriodo()) {
                case 0: // Diario
                    $array["periodo"] = "Diario";
                    break;
                case 6: // Quincenal
                    $array["chequeo"] = $chequeo;
                    $array["periodo"] = "Quincenal";
                    break;
                case 7: // Mensual
                    $array["chequeo"] = $chequeo;
                    $array["periodo"] = "Mensual";
                    break;
                default:
                    $array["dias"][] = $chequeo->getStringPeriodo();
                    break;
            }
        }
        $array["tarea"] = $tarea_operativa;
        key_exists("periodo", $array) === FALSE ? $array["periodo"] = "Semanal" : null;
        return $array;
    }

    private function get_values($array_periodo, $tareas_oper_array)
    {
        foreach ($array_periodo["tarea"]->getTareaOperativaTrabajador() as $value)
        {
            $id = $value->getTrabajador()->getId();

            $tareas_oper_array[$id][] = array(
                "numero"         => $array_periodo["tarea"]->getNumeroTarea(),
                "fecha"          => date("Y-m-d", time()+84600),
                "fecha_final"    => $array_periodo["tarea"]->getFechaFinal(),
                "fecha_creacion" => $array_periodo["tarea"]->getFechaCreacion()->format("Y-m-d"),
                "descripcion"    => preg_replace("/&#?[a-z0-9]+;/i","", strip_tags($array_periodo["tarea"]->getDescripcion())),
                "area" => $value->getTrabajador()->getArea()->getNombre()
            );
        }
        return $tareas_oper_array;
    }

    private function count_dias($ini, $fin)
    {
        $dias = (strtotime($ini)-strtotime($fin))/86400;
        $dias = floor(abs($dias));

        return $dias;
    }

    private function edit_fecha (\Otros\TareaOperativaBundle\Entity\ChequeoTareaOperativa $chequeo)
    {
        $em = $this->getEntityManager();
        $chequeo->setFecha(new \DateTime(date("Y-m-d", time()+84600)));
        $em->persist($chequeo);
        $em->flush();
    }
}