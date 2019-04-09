<?php

namespace Calidad\CalidadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Calidad\CalidadBundle\Entity\CalControlTipo;
/**
 * @Route("control/tipo/")
 */
class ControlTipoController extends Controller
{
    /**
     * @Route("list")
     * @return Response
     * @internal param Request $rq
     */
    public function listAction()
    {
        $data = $this->get('otros.util')->toArray($this->getDoctrine()->getManager()->getRepository('CalidadBundle:CalControlTipo')->findAll());
        return new Response('({"total":"'.count($data).'","data":'.json_encode($data).'})');
    }

    /**
     * @Route("add")
     * @param Request $rq
     * @return Response
     */
    public function addAction(Request $rq)
    {
        $entity = new CalControlTipo();
        $entity->setNombre($rq->get("nombre"));
        $entity->setDescripcion($rq->get("descripcion"));
        return new Response($this->get('otros.util')->validate($entity));
    }

    /**
     * @Route("edit")
     * @param Request $rq
     * @return Response
     */
    public function editAction(Request $rq)
    {
        $entity = $this->getDoctrine()->getManager()->getRepository('CalidadBundle:CalControlTipo')->find($rq->get("id"));
        $entity->setNombre($rq->get("nombre"));
        $entity->setDescripcion($rq->get("descripcion"));
        return new Response($this->get('otros.util')->validate($entity));
    }

    /**
     * @Route("remove")
     * @param Request $rq
     * @return Response
     */
    public function removeAction(Request $rq)
    {
        return new Response($this->get('otros.util')->remove($rq->get("ids"), 'CalidadBundle:CalControlTipo'));
    }
}
