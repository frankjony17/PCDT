<?php

namespace Otros\TareaOperativaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Otros\TareaOperativaBundle\Entity\ChequeoTareaOperativa;

/**
 * @Route("chequeo/")
 */
class ChequeoTareaController extends Controller
{
    /**
     * @Route("edit")
     */
    public function periodoChequeoAction(Request $rq)
    {
        $em = $this->getDoctrine()->getManager();
        $tarea = $em->find("TareaOperativaBundle:TareaOperativa", $rq->get("Id"));

        $entity = $em->getRepository("TareaOperativaBundle:ChequeoTareaOperativa")->findBy(
            array("tareaOperativa" => $tarea)
        );
        foreach ($entity as $obj) {
            $em->remove($obj);
        }
        $em->flush();
        foreach (json_decode($rq->get("PeriodoChequeo")) as $per) {
            $entity = new ChequeoTareaOperativa();
            $entity->setPeriodo($per);
            $entity->setTareaOperativa($tarea);
            $em->persist($entity);
        }
        return new Response($this->get("otros.util")->validate($entity));
    }
}