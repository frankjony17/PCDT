<?php

namespace Seguridad\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PortalController extends Controller
{
    /**
     * @Route("/", name="portal")
     * @Template()
     */
    public function indexAction()
    {
        return array('entorno' => $this->get("router")->getContext()->getBaseUrl());
    }
}
