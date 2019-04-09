<?php

namespace Otros\NomencladorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Otros\NomencladorBundle\Entity\Area;

/**
 * @Route("area/")
 */
class AreaController extends Controller
{
    /**
     * @Route("list")
     */
    public function listAction()
    {
        $data = $this->get('otros.util')->toArray($this->getDoctrine()->getManager()->getRepository('NomencladorBundle:Area')->findBy(array(
            'unidadOrganizativa' => $this->get('session')->get('unidad_organizativa_id')
        )));
        return new Response('({"total":"'.count($data).'","data":'.json_encode($data).'})');
    }
    
    /**
     * @Route("add")
     */    
    public function addAction(Request $rq)
    {
        $entity = new Area();
        $entity->setNombre($rq->get("Area"));
        $entity->setUnidadOrganizativa($this->getDoctrine()->getManager()->find('NomencladorBundle:UnidadOrganizativa', $this->get('session')->get('unidad_organizativa_id')));

        return new Response($this->get('otros.util')->validate($entity));
    }

    /**
     * @Route("edit")
     */ 
    public function editAction(Request $rq)
    {
        $entity = $this->getDoctrine()->getManager()->getRepository('NomencladorBundle:Area')->find($rq->get("Id"));

        $entity->setNombre($rq->get("Area"));

        return new Response($this->get('otros.util')->validate($entity));
    }
    
    /**
     * @Route("remove")
     */  
    public function removeAction(Request $rq)
    {
        return new Response($this->get('otros.util')->remove($rq->get("ids"), 'NomencladorBundle:Area'));
    }
}
