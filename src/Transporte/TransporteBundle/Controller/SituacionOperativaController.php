<?php

namespace Transporte\TransporteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Transporte\TransporteBundle\Entity\SituacionOperativa;

/**
 * @Route("situacion_operativa/")
 */
class SituacionOperativaController extends Controller
{
    /**
     * @Route("list")
     */
    public function listAction(Request $rq)
    {
        $em = $this->getDoctrine()->getManager();
        
        if(!$rq->get('Nombre'))
        {
            $data = $this->get('otros.util')->toArray($em->getRepository('TransporteBundle:SituacionOperativa')->findAll());
        }
        else
        {
            $data = $em->getRepository('TransporteBundle:SituacionOperativa')->findByNombre($rq->get('Nombre'));
        }
        return new Response('({"total":"'.count($data).'","data":'.json_encode($data).'})');
    }
    
//    /**
//     * @Route("add")
//     */    
//    public function addAction(Request $rq)
//    {
//        if ($rq->getMethod() == 'POST')
//        {            
//            $entity = new SituacionOperativa();
//            
//            $entity->setNombre($rq->get("Nombre"));
//            $entity->setDescripcion($rq->get("Descripcion"));
//            
//            return new Response($this->get('otros.util')->validate($entity));
//        }
//        throw $this->createNotFoundException('Esta acción no esta permitida.');
//    }    
//
//    /**
//     * @Route("edit")
//     */ 
//    public function editAction(Request $rq)
//    {
//        if ($rq->getMethod() == 'POST')
//        {      
//            $em = $this->getDoctrine()->getManager();
//            $entity = $em->getRepository('TransporteBundle:SituacionOperativa')->find($rq->get("Id"));
//
//            $entity->setNombre($rq->get("Nombre"));
//            $entity->setDescripcion($rq->get("Descripcion"));
//
//            return new Response($this->get('otros.util')->validate($entity));
//        }
//        throw $this->createNotFoundException('Esta acción no esta permitida.');                
//    }    
//    
//    /**
//     * @Route("remove")
//     */  
//    public function removeAction(Request $rq)
//    {
//        if ($rq->getMethod() == 'POST')
//        {   // Borrar entidades a partir de un identificador...
//            return new Response($this->get('otros.util')->remove($rq->get("ids"), 'TransporteBundle:SituacionOperativa'));
//        } 
//        throw $this->createNotFoundException('Esta acción no esta permitida.');             
//    }
}
