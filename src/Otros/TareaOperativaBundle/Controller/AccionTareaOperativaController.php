<?php

namespace Otros\TareaOperativaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Otros\TareaOperativaBundle\Entity\AccionTareaOperativa;

/**
 * @Route("accion/")
 */  
class AccionTareaOperativaController extends Controller
{
    /**
     * @Route("list")
     */
    public function listAction(Request $rq)
    {
        $array = array();
        $entity = $this->getDoctrine()->getManager()->getRepository("TareaOperativaBundle:AccionTareaOperativa")->findAcciones(
            $rq->get("Area"),
            $rq->get("Estado"),
            $rq->get("Inicial"),
            $rq->get("Final"),
            $this->get('session')->get('unidad_organizativa_id')
        );
        foreach ($entity as $obj)
        {
            $array[] = $obj->toArray(FALSE);
        }

        return new Response('({"total":"'.count($entity).'","data":'.json_encode($array).'})');
    }

    /**
     * @Route("get_descripcion")
     */
    public function getDescripcionAction(Request $rq)
    {
        $entity = $this->getDoctrine()->getManager()->find("TareaOperativaBundle:AccionTareaOperativa", $rq->get("Id"));

        return new Response($entity->getDescripcion());
    }

    /**
     * @Route("add")
     */    
    public function addAction(Request $rq)
    {
        $entity = new AccionTareaOperativa();

        $entity->setFecha(new \DateTime(date("Y-m-d H:i:s")));
        $entity->setDescripcion($rq->get("Descripcion"));
        $entity->setTareaOperativa($this->getDoctrine()->getManager()->find("TareaOperativaBundle:TareaOperativa", $rq->get("Id")));

        return new Response($this->get('otros.util')->validate($entity));
    }
    
    /**
     * @Route("edit")
     */ 
    public function editAction(Request $rq)
    {
        $entity = $this->getDoctrine()->getManager()->find("TareaOperativaBundle:AccionTareaOperativa", $rq->get("Id"));
        $entity->setFecha(new \DateTime(date("Y-m-d H:i:s")));
        $entity->setDescripcion($rq->get("Descripcion"));

        return new Response($this->get('otros.util')->validate($entity));
    }
    
    /**
     * @Route("remove")
     */  
    public function removeAction(Request $rq)
    {
        return new Response($this->get('otros.util')->remove($rq->get("Id"), 'TareaOperativaBundle:AccionTareaOperativa'));
    }
}
