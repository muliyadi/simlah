<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
//require_once APPPATH.'/tcpdf/tcpdf.php';
//require('/libraries/tcpdf/tcpdf.php');
 include_once APPPATH . '/libraries/tcpdf/tcpdf.php';
class Pdf extends TCPDF {
	
	function __construct()
	{
		parent::__construct();
	}
	
}

?>