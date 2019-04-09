<?php

namespace Indicadores\IndicadorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Indicadores\IndicadorBundle\Entity\IndObjetivo;

/**
 * @Route("objetivo/")
 */
class ObjetivoController extends Controller
{
    /**
     * @Route("list")
     */
    public function listAction()
    {
        $data = $this->get('otros.util')->toArray($this->getDoctrine()->getManager()->getRepository('IndicadorBundle:IndObjetivo')->findObjetivos(date("Y")));
        return new Response('({"total":"'.count($data).'","data":'.json_encode($data).'})');
    }

    /**
     * @Route("add")
     */
    public function addAction(Request $rq)
    {
        $manager = $this->getDoctrine()->getManager();
        $entity = new IndObjetivo();
        $entity->setNombre($rq->get("Nombre") ."-". date("Y"));
        $entity->setDescripcion($rq->get("Descripcion"));
        $entity->setTipoObjetivo($manager->find("IndicadorBundle:IndTipoObjetivo", $rq->get("TipoObjetivo")));
        $entity->setArc($manager->find("IndicadorBundle:IndArc", $rq->get("Arc")));
        return new Response($this->get('otros.util')->validate($entity));
    }

    /**
     * @Route("edit")
     */
    public function editAction(Request $rq)
    {
        $entity = $this->getDoctrine()->getManager()->getRepository('IndicadorBundle:IndObjetivo')->find($rq->get("Id"));
        $entity->setNombre($rq->get("Nombre") ."-". date("Y"));
        $entity->setDescripcion($rq->get("Descripcion"));
        $entity->setTipoObjetivo($this->get('otros.util')->entity("IndicadorBundle:IndTipoObjetivo", "nombre", $rq->get("TipoObjetivo")));
        return new Response($this->get('otros.util')->validate($entity));
    }

    /**
     * @Route("remove")
     */
    public function removeAction(Request $rq)
    {
        return new Response($this->get('otros.util')->remove($rq->get("ids"), 'IndicadorBundle:IndObjetivo'));
    }
}