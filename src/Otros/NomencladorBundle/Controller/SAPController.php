<?php

namespace Otros\NomencladorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("sap/")
 */
class SAPController extends Controller
{
    /**
     * @Route("read_txt_sap_rh")
     */
    public function readTxtSapRHAction(Request $rq)
    {
        $sap = $this->get('otros.sap'); // Obtener el servicio SapRH.

        if ($rq->get('UO') !== 'All')
        {
            $response = $sap->updateDatabase($sap->getKey($rq->get('UO')));
        }
        else
        {
            $response = $sap->updateDatabase(\FALSE);
        }
        return new Response($response);
    }
}
