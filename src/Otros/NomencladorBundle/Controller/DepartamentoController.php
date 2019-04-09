<?php

namespace Otros\NomencladorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("departamento/")
 */
class DepartamentoController extends Controller
{
    /**
     * @Route("list")
     */
    public function listAction(Request $rq)
    {
        $em = $this->getDoctrine()->getManager();
        // Seleccionar departamentos. 
        $data = $this->get('otros.util')->toArray($em->getRepository('NomencladorBundle:Departamento')->findBy(
                array(),
                array('nombre' => 'ASC'),
                $rq->get('limit'),
                $rq->get('start')
        ));
        // Cantidad real de departamentos en la base de datos.
        $cant = $em->getRepository('NomencladorBundle:Departamento')->findCantidadDepartamento();
        //-
        return new Response('({"total":"'.$cant.'","data":'.json_encode($data).'})');
    }
    
    /**
     * @Route("list_distinct_nombre")
     */
    public function listDistinctNombreAction()
    {
        $data = $this->getDoctrine()->getManager()->getRepository('NomencladorBundle:Departamento')->findDistinctDepartamentos();

        return new Response('({"total":"'.count($data).'","data":'.json_encode($data).'})');
    }
    
    /**
     * @Route("edit")
     */ 
    public function editAction(Request $rq)
    {
        $entity = $this->getDoctrine()->getManager()->getRepository('NomencladorBundle:Departamento')->find($rq->get("Id"));

        $entity->setTelefonos($rq->get("Telefonos"));

        return new Response($this->get('otros.util')->validate($entity));
    }
    
    /**
     * @Route("remove")
     */  
    public function removeAction(Request $rq)
    {
        return new Response($this->get('otros.util')->remove($rq->get("ids"), 'NomencladorBundle:Departamento'));
    }
}
