<?php

namespace Indicadores\IndicadorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Indicadores\IndicadorBundle\Entity\IndCriterioMedida,
    Indicadores\IndicadorBundle\Entity\IndPlan;

/**
 * @Route("cm/")
 */
class CriterioMedidaController extends Controller
{
    /**
     * @Route("tree/list")
     */
    public function listTreeAction()
    {
        $data = $this->getDoctrine()->getManager()->getRepository('IndicadorBundle:IndObjetivo')->findObjetivos(date("Y"));
        $data_tree = array("text"=> ".",  "children" => ""); $i = 0; $progress = 0;

        foreach ($data as $objetivo)
        {
            $children = array();

            if (count($criterio_medidas = $objetivo->getCriterioMedida()) > 0)
            {
                foreach ($criterio_medidas as $cm)
                {
                    $data = $cm->getPlanReal();
                    $children[] = array(
                        "ID" => $cm->getId(),
                        "nombre" => $cm->getNombre(),
                        "progress" => $data["progress"],
                        "iconCls" => $i%2 === 0 ? "tree-node-2" : "tree-node-1",
                        "leaf" => true
                    );
                    $progress += $data["progress"];
                    $i++;
                }
            }
            $data_tree["children"][] = array(
                "ID" => $objetivo->getId(),
                "nombre" => $objetivo->getNombre(),
                "progress" => $i > 0 ? $progress / $i : 0,
                "iconCls" => "tree-close-folder",
                "expanded" => false,
                "children" => $children
            );
            $progress = 0; $i = 0;
        }
        return new Response(json_encode($data_tree));
    }

    /**
     * @Route("list")
     */
    public function listAction()
    {
        $data = $this->get('otros.util')->toArray($this->getDoctrine()->getManager()->getRepository('IndicadorBundle:IndCriterioMedida')->findCriterioMedida(date("Y"), $this->get('session')->get('unidad_organizativa_id')));
        return new Response('({"total":"'.count($data).'","data":'.json_encode($data).'})');
    }

    /**
     * @Route("add")
     */
    public function addAction(Request $rq)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new IndCriterioMedida();
        $entity->setNombre($rq->get("nombre"));
        $entity->setDescripcion($rq->get("descripcion"));
        $entity->setObjetivo($em->find("IndicadorBundle:IndObjetivo", $rq->get("objetivo")));
        $entity->setTrabajador($em->find("NomencladorBundle:Trabajador", $rq->get("responsable")));

        if (count($this->get("validator")->validate($entity)) > 0) {
            return 'Unico';
        } else {
            $em->persist($entity);
            $plan = new IndPlan();
            $plan->setValor($rq->get("plan"));
            $plan->setEvaluacion($em->find("IndicadorBundle:IndEvaluacion", $rq->get("evaluacion")));
            $plan->setCriterioMedida($entity);
            $plan->setUnidadOrganizativa($em->find("NomencladorBundle:UnidadOrganizativa", $this->get('session')->get('unidad_organizativa_id')));
            $em->persist($plan);
        }
        return new Response($em->flush());
    }

    /**
     * @Route("edit")
     */
    public function editAction(Request $rq)
    {
        $em = $this->getDoctrine()->getManager();

        if (is_numeric($rq->get("responsable"))){
            $trabajador = $em->find("NomencladorBundle:Trabajador", $rq->get("responsable"));
        } else {
            $trabajador = $em->getRepository("NomencladorBundle:Trabajador")->findOneTrabajador($rq->get("responsable"), $this->get('session')->get('unidad_organizativa_id'));
        }
        if (is_numeric($rq->get("responsable"))){
            $objetivo = $em->find("IndicadorBundle:IndObjetivo", $rq->get("objetivo"));
        } else {
            $objetivo = $em->getRepository("IndicadorBundle:IndObjetivo")->findOneBy(array("nombre" => $rq->get("objetivo")));
        }
        $entity = $em->getRepository('IndicadorBundle:IndCriterioMedida')->find($rq->get("id"));
        $entity->setNombre($rq->get("nombre"));
        $entity->setDescripcion($rq->get("descripcion"));
        $entity->setObjetivo($objetivo);
        $entity->setTrabajador($trabajador);

        if (count($this->get("validator")->validate($entity)) > 0) {
            return new Response('Unico');
        } else {
            $plan = $entity->getPlan();
            $plan->setValor($rq->get("plan"));
            $plan->setEvaluacion($this->get("otros.util")->entity("IndicadorBundle:IndEvaluacion", "tipo", $rq->get("evaluacion")));

            $em->persist($entity);
            $em->persist($plan);
        }
        return new Response($em->flush());
    }

    /**
     * @Route("remove")
     *
     * @param Request $rq
     * @return Response
     */
    public function removeAction(Request $rq)
    {
        return new Response($this->get('otros.util')->remove($rq->get("ids"), 'IndicadorBundle:IndCriterioMedida'));
    }

    /**
     * @Route("real/list")
     */
    public function listRealAction(Request $rq)
    {
        $entity = $this->getDoctrine()->getManager()->find("IndicadorBundle:IndCriterioMedida", $rq->get("Id"));
        $data = $entity->getData();
        return new Response('({"total":"'.count($data).'","data":'.json_encode($data).'})');
    }

    /**
     * @Route("real/chart/list")
     */
    public function listRealChartAction(Request $rq)
    {
        $entity = $this->getDoctrine()->getManager()->find("IndicadorBundle:IndCriterioMedida", $rq->get("Id"));
        $data = $entity->getData();
        return new Response('({"total":"'.count($data).'","data":'.json_encode($data).'})');
    }
}