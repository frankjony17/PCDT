<?php

namespace Otros\NomencladorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Otros\NomencladorBundle\Entity\UnidadOrganizativa;

/**
 * @Route("uo/")
 */
class UnidadOrganizativaController extends Controller
{
    /**
     * @Route("list")
     */
    public function listAction(Request $rq)
    {
        $em = $this->getDoctrine()->getManager();
        // Creiteria de selección.
        $criteria = array();
        ($rq->get('ALL') != 'OK') ? $criteria['id'] = $this->get('session')->get('unidad_organizativa_id') : $criteria;
        // Listar Unidades Organizativas 
        $uo = $this->get('otros.util')->toArray($em->getRepository('NomencladorBundle:UnidadOrganizativa')->findBy($criteria));
        // Si no existen se crean
        if (count($uo) === 0 && $rq->get('ALL') === 'OK')
        {
            $etecsa_uo = $this->get('cdt.util')->parse('Otros/NomencladorBundle/Resources/config', 'unidades_organizativas.yml');

            foreach ($etecsa_uo as $acronimo => $nombre)
            {
                $uo = new UnidadOrganizativa();
                $uo->setAcronimo($acronimo);
                $uo->setNombre($nombre);
                $em->persist($uo);
            }            
            $em->flush();
            // Listar Unidades Organizativas
            $uo = $this->get('otros.util')->toArray($em->getRepository('NomencladorBundle:UnidadOrganizativa')->findBy($criteria));
        }
        return new Response('({"total":"'.count($uo).'","data":'.json_encode($uo).'})');
    }
    
    /**
     * @Route("edit")
     */ 
    public function editAction(Request $rq)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->find('NomencladorBundle:UnidadOrganizativa', $rq->get("Id"));

        $entity->setTelefonos($rq->get("Telefonos"));

        $em->persist($entity);

        return new Response($em->flush());
    }
}
