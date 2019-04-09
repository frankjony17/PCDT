<?php

namespace Indicadores\IndicadorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Indicadores\IndicadorBundle\Entity\IndEvaluacion;

/**
 * @Route("evaluacion/")
 */
class EvaluacionController extends Controller
{
    /**
     * @Route("list")
     */
    public function listAction()
    {
        $data = $this->get('otros.util')->toArray($this->getDoctrine()->getManager()->getRepository('IndicadorBundle:IndEvaluacion')->findAll());
        return new Response('({"total":"'.count($data).'","data":'.json_encode($data).'})');
    }

    /**
     * @Route("add")
     */
    public function addAction(Request $rq)
    {
        $entity = new IndEvaluacion();
        $entity->setTipo($rq->get("Nombre"));
        $entity->setDescripcion($rq->get("Descripcion"));
        return new Response($this->get('otros.util')->validate($entity));
    }

    /**
     * @Route("edit")
     */
    public function editAction(Request $rq)
    {
        $entity = $this->getDoctrine()->getManager()->getRepository('IndicadorBundle:IndEvaluacion')->find($rq->get("Id"));
        $entity->setTipo($rq->get("Nombre"));
        $entity->setDescripcion($rq->get("Descripcion"));
        return new Response($this->get('otros.util')->validate($entity));
    }

    /**
     * @Route("remove")
     */
    public function removeAction(Request $rq)
    {
        return new Response($this->get('otros.util')->remove($rq->get("ids"), 'IndicadorBundle:IndEvaluacion'));
    }
}