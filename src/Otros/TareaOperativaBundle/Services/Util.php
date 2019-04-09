<?php
/**
 * Contiene metodos utiles, utilizados por toda la aplicación.
 *
 * @author Frank
 */
namespace Otros\TareaOperativaBundle\Services;


class Util
{
    private $em;
            
    function __construct($doctrine)
    {
        $this->em = $doctrine->getManager();
    }
    
    /**
     * 
     * @param type $tarea
     * @param type $responsables
     */
    public function addTrabajadores($tarea, $responsables, $action="")
    {
        $ids = json_decode($responsables);
        
        if ($action === "edit")
        {
            foreach ($tarea->getTareaOperativaTrabajador() as $entity)
            {
                $this->em->remove($entity);
            }
            $this->em->flush();
        }
        foreach ($ids as $id)
        {
            $responsable = new \Otros\TareaOperativaBundle\Entity\TareaOperativaTrabajador();
            $responsable->setPendiente(\TRUE);
            $responsable->setTareaOperativa($tarea);
            $responsable->setTrabajador($this->em->find('NomencladorBundle:Trabajador', $id));
            $this->em->persist($responsable);
        }
        $this->em->flush();
    }
    
    /**
     * 
     * @param type $tarea
     * @param type $fechaFinal
     */
    public function addEstado($tarea, $fechaFinal, $action="add")
    {
        if ($action === "edit")
        {
            foreach ($tarea->getEstadoTareaOperativa() as $estado)
            {
                $this->em->remove($estado);
            }
            $this->em->flush();
        }
        $estado = new \Otros\TareaOperativaBundle\Entity\EstadoTareaOperativa();
        $estado->setFecha(new \DateTime(date("Y-m-d H:i:s")));
        $estado->setEstado('Pendiente');
        $estado->setFechaFinal(new \DateTime($fechaFinal));
        $estado->setTareaOperativa($tarea);
        $this->em->persist($estado);
        $this->em->flush();
    }
    
    /**
     * 
     * @param type $tarea
     * @param type $periodoChequeo
     */
    public function addPeriodo($tarea, $periodoChequeo, $action="")
    {
        if ($action === "edit")
        {
            foreach ($tarea->getChequeoTareaOperativa() as $periodo)
            {
                $this->em->remove($periodo);
            }
            $this->em->flush();
        }
        foreach (json_decode($periodoChequeo) as $periodo)
        {
            $chequeo = new \Otros\TareaOperativaBundle\Entity\ChequeoTareaOperativa();
            $chequeo->setPeriodo($periodo);
            $chequeo->setTareaOperativa($tarea);
            $this->em->persist($chequeo);
        }
        $this->em->flush();
    }
}