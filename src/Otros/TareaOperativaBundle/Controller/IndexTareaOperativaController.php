<?php

namespace Otros\TareaOperativaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;


class IndexTareaOperativaController extends Controller
{
    /**
     * @Route("/{app}")
     * @Template()
     */
    public function indexAppAction($app)
    {
        $cont = $this->get('security.context');
        
        if ($cont->isGranted('ROLE_'.  strtoupper($app).'_TAREAS_OPERATIVAS'))
        {
            return $this->render('TareaOperativaBundle:TareaOperativa:index.html.twig', array('modulo' => $app, 'session' => $this->get('session')));
        }
        else
        {
            return new RedirectResponse($this->generateUrl('logout'));
        }
    }
    
    /**
     * @Route("/", name="tareasoperativas")
     * @Template()
     */
    public function indexAction()
    {
        $cont = $this->get('security.context');
        $role = $this->get('session')->get('roles');
        $modu = $this->get('transporte.util')->getModulo("TAREAS", $role);
        
        if ($cont->isGranted('ROLE_'.  strtoupper($modu).'_TAREAS_OPERATIVAS'))
        {
            return $this->render('TareaOperativaBundle:TareaOperativa:index.html.twig', array('modulo' => $modu, 'session' => $this->get('session')));
        }
        else
        {
            return new RedirectResponse($this->generateUrl('logout'));
        }
    }
}
