<?php

namespace Transporte\TransporteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TransporteController extends Controller
{
    /**
     * @Route("/{app}")
     * @Template()
     */
    public function indexAppAction($app)
    {
        $cont = $this->get('security.context');
        
        if ($cont->isGranted('ROLE_'.  strtoupper($app).'_TRANSPORTE'))
        {
            return $this->render('TransporteBundle:Transporte:index.html.twig', array('modulo' => $app, 'session' => $this->get('session')));
        }
        else
        {
            return new RedirectResponse($this->generateUrl('logout'));
        }        
    }
    
    /**
     * @Route("/", name="transporte")
     * @Template()
     */
    public function indexAction()
    {
        $cont = $this->get('security.context');
        $role = $this->get('session')->get('roles');
        $modu = $this->get('transporte.util')->getModulo("TRANSPORTE", $role);
        
        if ($cont->isGranted('ROLE_'.  strtoupper($modu).'_TRANSPORTE'))
        {
            return array('modulo' => $modu, 'session' => $this->get('session'));
        }
        else
        {
            return new RedirectResponse($this->generateUrl('logout'));
        }
    }
}