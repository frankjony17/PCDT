<?php

namespace Calidad\CalidadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Calidad\CalidadBundle\Entity\CalControlCalidad;

/**
 * @Route("control/")
 */
class ControlController extends Controller
{
    /**
     * @Route("list")
     * @return Response
     * @internal param Request $rq
     */
    public function listAction()
    {
        $data = $this->get('otros.util')->toArray($this->getDoctrine()->getManager()->getRepository('CalidadBundle:CalControlCalidad')->findAll());
        return new Response('({"total":"'.count($data).'","data":'.json_encode($data).'})');
    }

    /**
     * @Route("add")
     * @param Request $rq
     * @return Response
     */
    public function addAction(Request $rq)
    {
        $entity = new CalControlCalidad();
        $entity->setFecha(new \DateTime($rq->get("fecha")));
        $entity->setEjecutores($rq->get("ejecutores"));
        $entity->setControlTipo($this->getDoctrine()->getManager()->find('CalidadBundle:CalControlTipo', $rq->get("controlTipo")));
        $entity->setUo($this->getDoctrine()->getManager()->find('NomencladorBundle:UnidadOrganizativa', $this->get('session')->get('unidad_organizativa_id')));
        return new Response($this->get('otros.util')->validate($entity));
    }

    /**
     * @Route("edit")
     * @param Request $rq
     * @return Response
     */
    public function editAction(Request $rq)
    {
        $entity = $this->getDoctrine()->getManager()->getRepository('CalidadBundle:CalControlCalidad')->find($rq->get("id"));
        $entity->setFecha(new \DateTime($rq->get("fecha")));
        $entity->setEjecutores($rq->get("ejecutores"));
//        $entity->setControlTipo($this->getDoctrine()->getManager()->find('CalidadBundle:CalControlTipo', $rq->get("controlTipo")));
        return new Response($this->get('otros.util')->validate($entity));
    }

    /**
     * @Route("remove")
     * @param Request $rq
     * @return Response
     */
    public function removeAction(Request $rq)
    {
        return new Response($this->get('otros.util')->remove($rq->get("ids"), 'CalidadBundle:CalControlCalidad'));
    }
}
