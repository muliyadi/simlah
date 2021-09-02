<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 include_once APPPATH . '/libraries/dompdf/autoload.inc.php';
//require_once("./application/libraries/dompdf/autoload.inc.php");
use Dompdf\Dompdf;

class Pdf {

  public function generate($html, $filename='', $stream=TRUE, $paper = 'A4', $orientation = "portrait")
  {
    $dompdf = new DOMPDF();
    $dompdf->loadHtml($html);
    $dompdf->setPaper($paper, $orientation);
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename.".pdf", array("Attachment" => 0));
    } else {
        return $dompdf->output();
    }
  }
}