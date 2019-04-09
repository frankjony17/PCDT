<?php

namespace Reportes\PDFBundle\Controller\transporte;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("transporte/")
 */
class PlanificacionController extends Controller
{
    /**
     * @Route("planificacion")
     */
    public function planificacionAction(Request $rq)//$rq->get("Nombre")
    {   // Cabecera
        $header  = "<table border=\"1\">";
        $header .= "<tr>";
        $header .= "<th width=\"590\"><b>Planificación de transporte (días feriados y fin de semana)</b><br></br><br>";
        $header .= "<b>Días:</b> 18/04/14, 19/04/14 y 20/04/14</br></th>";
        $header .= "<th width=\"170\" align=\"right\"><img src=\"/images/logo.png\" height=\"35\"/><br>";
        $header .= "<font align=\"center\">Dirección Territorial-Isla de la Juventud</font></br></th>";
        $header .= "</tr><tr><th></th></tr>";
        $header .= "</table>";
        // Contenido-Cabecera de Tabla.
        $content  = "<table border=\"1\" bgcolor=\"#eeeeee\">";
        $content .= "<tr align=\"center\">";
        $content .= "<th colspan=\"2\" width=\"100\"><b>Matrícula</b></th>";
        $content .= "<th rowspan=\"2\" width=\"63\"><b>Fecha</b></th>";
        $content .= "<th colspan=\"2\" width=\"120\"><b>Horario</b></th>";
        $content .= "<th rowspan=\"2\" width=\"325\"><b>Tarea a ejecutar</b></th>";
        $content .= "<th rowspan=\"2\" width=\"150\"><b>Nombre del conductor</b></th>";
        $content .= "</tr>";
        $content .= "<tr align=\"center\">";
        $content .= "<th width=\"40\"><b>Letras</b></th>";
        $content .= "<th width=\"60\"><b>Números</b></th>";
        $content .= "<th width=\"60\"><b>Inicio</b></th>";
        $content .= "<th width=\"60\"><b>Fin</b></th>";
        $content .= "</tr>";
        $content .= "</table>";
        // Filas de la Tabla para el día (Sábado).
        $content .= "<table border=\"1\">";
        $content .= "<tr align=\"center\">";
        $content .= "<th width=\"758\"><b>Sábado</b></th>";
        $content .= "</tr>";
        $content .= "</table>";
        
        $content  .= "<table border=\"1\">";
        $content .= "<tr align=\"center\">";
        $content .= "<th width=\"40\"></th>";
        $content .= "<th width=\"60\"></th>";
        $content .= "<th width=\"63\"></th>";
        $content .= "<th width=\"60\"></th>";
        $content .= "<th width=\"60\"></th>";
        $content .= "<th width=\"325\"></th>";
        $content .= "<th width=\"150\"></th>";
        $content .= "</tr>";
        $content .= "</table>";
        
        // Crear PDF.
        $pdf = $this->get('util.tcpdf')->init();
        $pdf->create('Planificacion de Transporte DTIJ', $header, $content);
        // FIN.
        return new Response('');        
    }
}
