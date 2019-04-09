<?php

namespace Calidad\CalidadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Calidad\CalidadBundle\Entity\CalPlanAccion;

/**
 * @Route("planaccion/")
 */
class PlanAccionController extends Controller
{
    /**
     * @Route("list")
     * @param Request $rq
     * @return Response
     */
    public function listAction(Request $rq)
    {
        $manager = $this->getDoctrine()->getManager();
        $data = $this->get('otros.util')->toArray($manager->getRepository('CalidadBundle:CalPlanAccion')->findBy(
            array('brechasOtros' => $manager->getRepository('CalidadBundle:CalBrechasOtros')->find($rq->get('pk')))
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
        $entity = new CalPlanAccion();
        $entity->setEstado(false);
        $entity->setFechaInicial(new \DateTime($rq->get("fechaInicial")));
        $entity->setFechaFinal(new \DateTime($rq->get("fechaFinal")));
        $entity->setDescripcion($rq->get("descripcion"));
        $entity->setBrechasOtros($this->getDoctrine()->getManager()->find('CalidadBundle:CalBrechasOtros', $rq->get('id')));

        return new Response($this->get('otros.util')->validate($entity));
    }

    /**
     * @Route("edit")
     * @param Request $rq
     * @return Response
     */
    public function editAction(Request $rq)
    {
        $entity = $this->getDoctrine()->getManager()->getRepository('CalidadBundle:CalPlanAccion')->find($rq->get("id"));

        $entity->setFechaInicial(new \DateTime($rq->get("fechaInicial")));
        $entity->setFechaFinal(new \DateTime($rq->get("fechaFinal")));
        $entity->setDescripcion($rq->get("descripcion"));

        return new Response($this->get('otros.util')->validate($entity));
    }

    /**
     * @Route("estado")
     * @param Request $rq
     * @return Response
     */
    public function estadoAction(Request $rq)
    {
        $entity = $this->getDoctrine()->getManager()->getRepository('CalidadBundle:CalPlanAccion')->find($rq->get("id"));

        $entity->setEstado($rq->get("estado"));

        return new Response($this->get('otros.util')->validate($entity));
    }

    /**
     * @Route("remove")
     * @param Request $rq
     * @return Response
     */
    public function removeAction(Request $rq)
    {
        return new Response($this->get('otros.util')->remove($rq->get("ids"), 'CalidadBundle:CalPlanAccion'));
    }
}
