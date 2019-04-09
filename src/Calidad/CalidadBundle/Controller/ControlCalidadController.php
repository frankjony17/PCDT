<?php

namespace Calidad\CalidadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Calidad\CalidadBundle\Entity\CalBrechasOtros;

/**
 * @Route("cc/")
 */
class ControlCalidadController extends Controller
{
    /**
     * @Route("list")
     * @param Request $rq
     * @return Response
     */
    public function listAction(Request $rq)
    {
        $trabajador = "";
        if (true === $this->get('security.context')->isGranted('ROLE_RESPONSABLE_CONTROL_CALIDAD')) {
            $trabajador = $this->get('session')->get('trabajador_id');
        }
        $data = $this->get('otros.util')->toArray($this->getDoctrine()->getManager()->getRepository('CalidadBundle:CalBrechasOtros')->findBrechasOtros(
           $rq->get("tipo"),
            $rq->get("estado") == "Culminado" ? true : false,
            $rq->get("fechainicial"),
            $rq->get("fechafinal"),
            $trabajador,
            $this->get('session')->get('unidad_organizativa_id')
        ));
        return new Response('({"total":"'.count($data).'","data":'.json_encode($data).'})');
    }

    /**
     * @Route("add")
     * @param Request $rq
     * @return Response
     */
    public function addAction(Request $rq)
    {
        $entity = new CalBrechasOtros(); $em = $this->getDoctrine()->getManager();
        $entity->setNombre($rq->get("nombre"));
        $entity->setObservaciones($rq->get("observaciones"));
        $entity->setParticipantes($rq->get("participantes"));
        $entity->setControlCalidad($em->getRepository('CalidadBundle:CalControlCalidad')->find($rq->get("control")));
        $entity->setTipo($rq->get("tipo"));
        $entity->setFecha(new \DateTime($rq->get("fecha")));
        $entity->setEstado(false);
        foreach (json_decode($rq->get("trabajadores")) as $value) {
            $trabajador = $em->getRepository('NomencladorBundle:Trabajador')->find($value[0]);
            $trabajador->addBrechasOtro($entity);
        }
        if (true === $this->get('security.context')->isGranted('ROLE_RESPONSABLE_CONTROL_CALIDAD')) {
            $trabajador = $em->getRepository('NomencladorBundle:Trabajador')->find($this->get('session')->get('trabajador_id'));
            $trabajador->addBrechasOtro($entity);
        }
        if (count($errors = $this->get('validator')->validate($entity)) > 0) {
            return new Response("UNICO");
        }
        $em->persist($entity);
        return new Response($em->flush());
    }

    /**
     * @Route("edit")
     * @param Request $rq
     * @return Response
     */
    public function editAction(Request $rq)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CalidadBundle:CalBrechasOtros')->find($rq->get("id"));

        $entity->setNombre($rq->get("nombre"));
        $entity->setObservaciones($rq->get("observaciones"));
        $entity->setParticipantes($rq->get("participantes"));
        $entity->setTipo($rq->get("tipo"));
        $entity->setFecha(new \DateTime($rq->get("fecha")));

        foreach ($entity->getTrabajador() as $value){
            $value->removeBrechasOtro($entity);
        }
        foreach (json_decode($rq->get("trabajadores")) as $value) {
            $trabajador = $em->getRepository('NomencladorBundle:Trabajador')->find($value[0]);
            $trabajador->addBrechasOtro($entity);
        }
        if (true === $this->get('security.context')->isGranted('ROLE_RESPONSABLE_CONTROL_CALIDAD')) {
            $trabajador = $em->getRepository('NomencladorBundle:Trabajador')->find($this->get('session')->get('trabajador_id'));
            $trabajador->removeBrechasOtro($entity);
            $trabajador->addBrechasOtro($entity);
        }
        if (count($errors = $this->get('validator')->validate($entity)) > 0) {
            return new Response("UNICO");
        }
        $em->persist($entity);
        return new Response($em->flush());
    }

    /**
     * @Route("estado")
     * @param Request $rq
     * @return Response
     */
    public function estadoAction(Request $rq)
    {

        if (true === $this->get('security.context')->isGranted('ROLE_ESPECIALISTA_CONTROL_CALIDAD')) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CalidadBundle:CalBrechasOtros')->find($rq->get("id"));
            $entity->setEstado($rq->get("estado"));
            $em->persist($entity);
            return new Response($em->flush());
        }
        return new Response("");
    }
    /**
     * @Route("remove")
     * @param Request $rq
     * @return Response
     */
    public function removeAction(Request $rq)
    {
        return new Response($this->get('otros.util')->remove($rq->get("ids"), 'CalidadBundle:CalBrechasOtros'));
    }
}
