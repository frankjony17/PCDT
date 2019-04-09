<?php

namespace Otros\TareaOperativaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Otros\TareaOperativaBundle\Entity\TareaOperativaTrabajador;

/**
 * @Route("responsable/")
 */
class ResponsableController extends Controller
{
    /**
     * @Route("add")
     */
    public function addAction(Request $rq)
    {
        $entity = $this->getDoctrine()->getManager()->getRepository("TareaOperativaBundle:TareaOperativaTrabajador")->findOneBy(
            array(
                "tareaOperativa" => $rq->get("Id"),
                "trabajador" => $this->getDoctrine()->getManager()->find("NomencladorBundle:Trabajador", $rq->get("TrabajadorId"))
            )
        );
        $entity->setPendiente($rq->get("Estado"));

        return new Response($this->get('otros.util')->validate($entity));
    }
}