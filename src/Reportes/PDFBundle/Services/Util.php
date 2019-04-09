<?php
/**
 * @author Frank
 */
namespace Reportes\PDFBundle\Services;

use Reportes\PDFBundle\Services\TCPDFService;

class Util
{
    private $unit, $tcpdf, $format, $orientation;
            
    function __construct(TCPDFService $tcpdf)
    {
        $this->tcpdf = $tcpdf;
    }

    /**
     * This is the class constructor. 
     * It allows to set up the page format, the orientation and 
     * the measure unit used in all the methods (except for the font sizes).
     * 
     * @param string $orientation page orientation. Portrait (P) or Landscape (L).
     * @param string $unit User measure unit. pt: point, mm: millimeter, cm: centimeter, in: inch.
     * @param mixed  $format The format used for pages. (A4, LETTER).
     * @param string $title Title from PDF.
     * @param string $header Header from PDF.
     * @param string $content Content from PDF.
     */
    public function create($title, $header, $content)
    {
        $pdf = $this->tcpdf->create($this->orientation, $this->unit, $this->format);
        
        $pdf->SetCreator("ETECSA");
        $pdf->SetAuthor("CDTIJ");
        $pdf->SetTitle($title);
        $pdf->SetSubject("Reportes PDF");
        $pdf->SetKeywords('TCPDF, PDF, reporte, testo, guia');
        
        $pdf->setPrintHeader(\FALSE);
        $pdf->setPrintFooter(\FALSE);
        $pdf->SetMargins(10, 5, 10);
        $pdf->SetFont('times', 'N', 10);
        $pdf->AddPage();

        $pdf->writeHTML($header);
        $pdf->writeHTML($content);
        
        $pdf->Output($name = ''.$title.'.pdf', 'D');
    }
    
    public function init($orientation = 'L', $unit = 'mm', $format = 'letter')
    {
        $this->unit = $unit;
        $this->format = $format;
        $this->orientation = $orientation;
        
        return $this;
    }
}
