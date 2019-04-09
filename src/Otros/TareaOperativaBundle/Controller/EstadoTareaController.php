<?php

namespace Otros\TareaOperativaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Otros\TareaOperativaBundle\Entity\EstadoTareaOperativa;

/**
 * @Route("estado/")
 */
class EstadoTareaController extends Controller
{
    /**
     * @Route("add_fecha_final_estado")
     */
    public function fechaFinalEditAction(Request $rq)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = new EstadoTareaOperativa();
        $entity->setFecha(new \DateTime(date("Y-m-d H:i:s")));
        $entity->setEstado("Pendiente");
        $entity->setFechaFinal(new \DateTime($rq->get("Fecha")));
        $entity->setTareaOperativa($tarea = $em->find("TareaOperativaBundle:TareaOperativa", $rq->get("Id")));

        if ($this->get('otros.util')->validate($entity) === 'Unico')
        {
            $entity = $em->getRepository("TareaOperativaBundle:EstadoTareaOperativa")->findOneBy(
                array(
                    "estado" => "Pendiente",
                    "fechaFinal" => new \DateTime($rq->get("Fecha")),
                    "tareaOperativa" => $tarea
                ));
            $entity->setFecha(new \DateTime(date("Y-m-d H:i:s")));
            $em->persist($entity);
            $em->flush();
        }
        return new Response("");
    }

    /**
     * @Route("add_estado_final")
     */
    public function estadoEditAction(Request $rq)
    {
        $em = $this->getDoctrine()->getManager();
        $to = $this->getDoctrine()->getManager()->find("TareaOperativaBundle:TareaOperativa", $rq->get("Id"));

        $entity = new EstadoTareaOperativa();
        $entity->setFecha(new \DateTime(date("Y-m-d")));
        $entity->setEstado("Final");
        $entity->setFechaFinal(new \DateTime(date("Y-m-d")));
        $entity->setTareaOperativa($to);

        if (count($this->get('validator')->validate($entity)) > 0)
        {
            return new Response('Unico');
        }
        $em->persist($entity);

        foreach($to->getTareaOperativaTrabajador() as $tot)
        {
            $tot->setPendiente(false);
            $em->persist($tot);
        }
        $em->flush();

        return new Response('');
    }
}