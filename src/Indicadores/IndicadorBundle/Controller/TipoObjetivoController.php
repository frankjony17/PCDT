<?php

namespace Indicadores\IndicadorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Indicadores\IndicadorBundle\Entity\IndTipoObjetivo;

/**
 * @Route("objetivo/tipo/")
 */
class TipoObjetivoController extends Controller
{
    /**
     * @Route("list")
     */
    public function listAction(Request $rq)
    {
        $data = $this->get('otros.util')->toArray($this->getDoctrine()->getManager()->getRepository('IndicadorBundle:IndTipoObjetivo')->findAll());
        return new Response('({"total":"'.count($data).'","data":'.json_encode($data).'})');
    }

    /**
     * @Route("add")
     */
    public function addAction(Request $rq)
    {
        $entity = new IndTipoObjetivo();
        $entity->setNombre($rq->get("Nombre"));
        return new Response($this->get('otros.util')->validate($entity));
    }

    /**
     * @Route("edit")
     */
    public function editAction(Request $rq)
    {
        $entity = $this->getDoctrine()->getManager()->getRepository('IndicadorBundle:IndTipoObjetivo')->find($rq->get("Id"));
        $entity->setNombre($rq->get("Nombre"));
        return new Response($this->get('otros.util')->validate($entity));
    }

    /**
     * @Route("remove")
     */
    public function removeAction(Request $rq)
    {
        return new Response($this->get('otros.util')->remove($rq->get("ids"), 'IndicadorBundle:IndTipoObjetivo'));
    }
}