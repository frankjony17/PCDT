<?php

namespace Otros\NomencladorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Otros\NomencladorBundle\Entity\Cargo;

/**
 * @Route("cargo/")
 */
class CargoController extends Controller
{
    /**
     * @Route("list")
     */
    public function listAction()
    {
        $data = $this->get('otros.util')->toArray($this->getDoctrine()->getManager()->getRepository('NomencladorBundle:Cargo')->findAll());

        return new Response('({"total":"'.count($data).'","data":'.json_encode($data).'})');
    }
    
    /**
     * @Route("add")
     */    
    public function addAction(Request $rq)
    {
        $entity = new Cargo();
        $entity->setNombre($rq->get("Nombre"));
        $entity->setDescripcion($rq->get("Descripcion"));

        return new Response($this->get('otros.util')->validate($entity));
    }

    /**
     * @Route("edit")
     */ 
    public function editAction(Request $rq)
    {
        $entity = $this->getDoctrine()->getManager()->find('NomencladorBundle:Cargo', $rq->get("Id"));

        $entity->setNombre($rq->get("Nombre"));
        $entity->setDescripcion($rq->get("Descripcion"));

        return new Response($this->get('otros.util')->validate($entity));
    }
    
    /**
     * @Route("remove")
     */  
    public function removeAction(Request $rq)
    {
        return new Response($this->get('otros.util')->remove($rq->get("ids"), 'NomencladorBundle:Cargo'));
    }
}
