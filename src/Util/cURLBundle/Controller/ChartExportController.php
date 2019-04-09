<?php

namespace Util\cURLBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpFoundation\Request;

class ChartExportController extends Controller
{
    /**
     * @Route("chart/export")
     */
    public function chartExportAction(Request $rq)
    {
        $chart = $this->get('chart.export')->init($rq->get('svg'), $rq->get('type'), $rq->get('width'), $rq->get('height'));

        $contents = $chart->converter();

        $header = array(
            header("Content-Type: image/png"),
            header("Content-Disposition: attachment; filename=\"chart-from-pcdt.png\";")
        );
        return new Response($contents, 200, $header);
    }
}