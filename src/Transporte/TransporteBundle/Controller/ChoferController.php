<?php

namespace Transporte\TransporteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Transporte\TransporteBundle\Entity\Chofer;

/**
 * @Route("chofer/")
 */
class ChoferController extends Controller
{
    /**
     * @Route("list")
     */
    public function listAction()
    {
        $data = $this->get('otros.util')->toArray($this->getDoctrine()->getManager()->getRepository('TransporteBundle:Chofer')->findChoferes($this->get('session')->get('unidad_organizativa_id')));

        return new Response('({"total":"'.count($data).'","data":'.json_encode($data).'})');
    }
//    
//    /**
//     * @Route("add")
//     */    
//    public function addAction(Request $rq)
//    {
//        if ($rq->getMethod() == 'POST')
//        {
//            $ut = $this->get('otros.util');
//            $em = $this->getDoctrine()->getManager();
//            
//            ($rq->get("Licencia")) ? $value = $em->getRepository('TransporteBundle:Chofer')->findSiLicenciaExiste($rq->get("Licencia")) : $value = \TRUE;
//            
//            if ($value)
//            {
//                $entity = new Chofer();
//
//                $entity->setLicencia($rq->get("Licencia"));
//                $entity->setProfecional($ut->boolean($rq->get("Profecional")));
//                $entity->setHoraParqueo(new \DateTime($rq->get("HoraParqueo")));
//                $entity->setTrabajador($em->find('NomencladorBundle:Trabajador', $rq->get("TrabajadorId")));
//
//                return new Response($ut->validate($entity));
//            }
//            return new Response('Unico');
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
//            $ut = $this->get('otros.util');
//            $em = $this->getDoctrine()->getManager();
//            
//            ($rq->get("Licencia")) ? $value = $em->getRepository('TransporteBundle:Chofer')->findSiLicenciaExiste($rq->get("Licencia"), $rq->get("Id")) : $value = \TRUE;
//            
//            if ($value)
//            {
//                $entity = $em->getRepository('TransporteBundle:Chofer')->find($rq->get('Id'));
//
//                $entity->setLicencia($rq->get("Licencia"));
//                $entity->setProfecional($ut->boolean($rq->get("Profecional")));
//                $entity->setHoraParqueo(new \DateTime($rq->get("HoraParqueo")));
//                $entity->setTrabajador($em->getRepository('NomencladorBundle:Trabajador')->find($rq->get("TrabajadorId")));
//
//                return new Response($ut->validate($entity));
//            }
//            return new Response('Unico');
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
//            return new Response($this->get('otros.util')->remove($rq->get("ids"), 'TransporteBundle:Chofer'));
//        } 
//        throw $this->createNotFoundException('Esta acción no esta permitida.');             
//    }
//    
//    /**
//     * @Route("change")
//     */  
//    public function changeAction(Request $rq)
//    {
//        if ($rq->getMethod() == 'POST')
//        { 
//            $em = $this->getDoctrine()->getManager();
//
//            switch ($rq->get('Accion'))
//            {
//                case 'Seleccionados':
//                case 'No seleccionados':
//                case 'Todos':
//                    foreach (json_decode($rq->get('ChoferId')) as $id)
//                    {
//                        $chofer = $em->getRepository('TransporteBundle:Chofer')->find($id);
//                        $chofer->setHoraParqueo(new \DateTime($rq->get("HoraParqueo")));
//                        $em->persist($chofer);
//                    }
//                    break;
//                default:
//                    $trabajadores = $em->getRepository('NomencladorBundle:Trabajador')->findBy(array('cargo' => $rq->get('ChoferId')));
//
//                    foreach ($trabajadores as $trabajador)
//                    {
//                        $chofer = $em->getRepository('TransporteBundle:Chofer')->findOneBy(array('trabajador' => $trabajador));
//                        if (is_object($chofer)) 
//                        {
//                            $chofer->setHoraParqueo(new \DateTime($rq->get("HoraParqueo")));
//                            $em->persist($chofer);
//                        }
//                    }
//                    break;
//            }
//            return new Response($em->flush());                
//        }
//        throw $this->createNotFoundException('Esta acción no esta permitida.');                
//    }
}
