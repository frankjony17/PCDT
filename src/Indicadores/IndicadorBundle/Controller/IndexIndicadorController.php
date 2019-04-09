<?php

namespace Indicadores\IndicadorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;

class IndexIndicadorController extends Controller
{
    /**
     * @Route("/{app}")
     * @Template()
     */
    public function indexAppAction($app)
    {
        $cont = $this->get('security.context');
        
        if ($cont->isGranted('ROLE_'.  strtoupper($app).'_INDICADOR'))
        {
            $arc = $this->getDoctrine()->getManager()->getRepository('IndicadorBundle:IndArc')->findBy(array("fecha" => date("Y")));

            return $this->render('IndicadorBundle:Indicador:index.html.twig',
                array('modulo' => $app, 'session' => $this->get('session'), 'year' => date("Y"), 'arc' => $arc));
        }
        else
        {
            return new RedirectResponse($this->generateUrl('logout'));
        }
    }
    
    /**
     * @Route("/", name="indicadores")
     * @Template()
     */
    public function indexAction()
    {
        $cont = $this->get('security.context');
        $role = $this->get('session')->get('roles');
        $modu = $this->get('transporte.util')->getModulo("INDICADOR", $role);
        
        if ($cont->isGranted('ROLE_'.  strtoupper($modu).'_INDICADOR'))
        {
            $arc = $this->getDoctrine()->getManager()->getRepository('IndicadorBundle:IndArc')->findBy(array("fecha" => date("Y")));

            return $this->render('IndicadorBundle:Indicador:index.html.twig',
                array('modulo' => $modu, 'session' => $this->get('session'), 'year' => date("Y"), 'arc' => $arc));
        }
        else
        {
            return new RedirectResponse($this->generateUrl('logout'));
        }
    }
}
