<?php

namespace Otros\NomencladorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("trabajador/")
 */
class TrabajadorController extends Controller
{
    /**
     * @Route("externo")
     */
    public function listExternoAction(Request $rq)
    {
        $em = $this->getDoctrine()->getManager();
        
        if ($rq->get('departamento') == 'externo' || $rq->get('departamento') == '')
        {
            $value = 'externo';
        } else {
            $value = $rq->get('departamento');
        }
        $data = $em->getRepository('NomencladorBundle:Trabajador')->findTrabajadores($value, $rq->get('limit'), $rq->get('start'));
        // Cantidad real de trabajadores en la base de datos.
        $cant = $em->getRepository('NomencladorBundle:Trabajador')->findCantidadTrabajadores('externo');

        return new Response('({"total":"'.$cant.'","data":'.json_encode($data).'})');
    }
    
    /**
     * @Route("interno")
     */
    public function listInternoAction(Request $rq)
    {
        $em = $this->getDoctrine()->getManager();
        
        $data = $em->getRepository('NomencladorBundle:Trabajador')->findTrabajadores('interno', $rq->get('limit'), $rq->get('start'), $this->get('session')->get('unidad_organizativa_id'));
        // Cantidad real de trabajadores en la base de datos.
        $cant = $em->getRepository('NomencladorBundle:Trabajador')->findCantidadTrabajadores('interno', $this->get('session')->get('unidad_organizativa_id'));
        //-!
        return new Response('({"total":"'.$cant.'","data":'.json_encode($data).'})');
    }

    /**
     * @Route("list_for_tarea_operativa")
     */
    public function listTrabajadorUserAction()
    {
        $trabajadores = $this->getDoctrine()->getManager()->getRepository('NomencladorBundle:Trabajador')->findTrabajadoresUser($this->get('session')->get('unidad_organizativa_id'));

        return new Response('({"total":"'.count($trabajadores).'","data":'.json_encode($trabajadores).'})');
    }
    
    /**
     * @Route("add_area_trabajador")
     */
    public function addAreaTrabajadorAction(Request $rq)
    {
        if ($rq->getMethod() == 'POST')
        {      
            $em = $this->getDoctrine()->getManager();
            
            $area = $em->find('NomencladorBundle:Area', $rq->get('Id'));
            
            foreach (json_decode($rq->get('Ids')) as $id)
            {
                $trabajador = $em->find('NomencladorBundle:Trabajador', $id);
                $trabajador->setArea($area);
                $em->persist($trabajador);
            }
            return new Response($em->flush());
        }
        throw $this->createNotFoundException('Esta acción no esta permitida.');
    }
    
    /**
     * @Route("edit")
     */ 
    public function editAction(Request $rq)
    {
        if ($rq->getMethod() == 'POST')
        {   
            $ut = $this->get('otros.util');
            $em = $this->getDoctrine()->getManager();
            
            $entity = $em->find('NomencladorBundle:Trabajador', $rq->get("Id"));
            $entity->setMovil($rq->get("Movil"));
            
            $em->persist($entity);
            
            return new Response($ut->validate($entity));
        }
        throw $this->createNotFoundException('Esta acción no esta permitida.');                
    }
    
    /**
     * @Route("add_cargo_trabajador")
     */
    public function addCargoTrabajadorAction(Request $rq)
    {
        if ($rq->getMethod() == 'POST')
        {      
            $em = $this->getDoctrine()->getManager();
            
            $area = $em->find('NomencladorBundle:Cargo', $rq->get('Id'));
            
            foreach (json_decode($rq->get('Ids')) as $id)
            {
                $trabajador = $em->find('NomencladorBundle:Trabajador', $id);
                $trabajador->setCargo($area);
                $em->persist($trabajador);
            }
            return new Response($em->flush());
        }
        throw $this->createNotFoundException('Esta acción no esta permitida.');
    }
    
    /**
     * @Route("remove_area_trabajador")
     */
    public function removeAreaTrabajadorAction(Request $rq)
    {
        $em = $this->getDoctrine()->getManager();

        foreach (json_decode($rq->get('Ids')) as $id)
        {
            $user = $em->getRepository('AdminBundle:Users')->findOneBy(array(
                "trabajador_id" => intval($id)
            ));
            if (is_object($user))
            {
                $user->setIsActive(\FALSE);
                $em->persist($user);
            }
            $trabajador = $em->find('NomencladorBundle:Trabajador', $id);
            $trabajador->setArea(\NULL);
            $em->persist($trabajador);
        }
        return new Response($em->flush());
    }
}
