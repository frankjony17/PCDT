<?php

namespace Transporte\TransporteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("matricula/")
 */
class MatriculaController extends Controller
{
    /**
     * @Route("list")
     */
    public function listAction()
    {
        $data = $this->get('otros.util')->toArray($this->getDoctrine()->getManager()->getRepository('TransporteBundle:Matricula')->findMatriculas($this->get('session')->get('unidad_organizativa_id')));

        return new Response('({"total":"'.count($data).'","data":'.json_encode($data).'})');
    }

    /**
     * @Route("edit")
     */ 
    public function editAction(Request $rq)
    {
        if ($rq->getMethod() == 'POST')
        {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TransporteBundle:Matricula')->find($rq->get("Id"));

            $entity->setChapa($rq->get("Chapa"));
            $entity->setChapaVieja($rq->get("ChapaVieja"));
            $entity->setCirculacion($rq->get("Circulacion"));
            ($rq->get("Vencimiento")) ? $entity->setVencimiento(new \DateTime($rq->get("Vencimiento"))) : \NULL;
            
            if ($em->getRepository('TransporteBundle:Matricula')->findUnicos($rq->get("Id"), $rq->get("Chapa"), $rq->get("ChapaVieja"), $rq->get("Circulacion")))
            {
                $em->persist($entity);
                return new Response($em->flush());
            }
            return new Response('Unico');
        }
        throw $this->createNotFoundException('Esta acción no esta permitida.');                
    }
    
    /**
     * @Route("edit_id")
     */ 
    public function editIdAction(Request $rq)
    {
        if ($rq->getMethod() == 'POST')
        {      
            $entity = $this->getDoctrine()->getManager()->getRepository('TransporteBundle:Matricula')->find($rq->get("Id"));

            $entity->setId($rq->get("NewId"));

            return new Response($this->get('otros.util')->validate($entity));
        }
        throw $this->createNotFoundException('Esta acción no esta permitida.');                
    }    
}
