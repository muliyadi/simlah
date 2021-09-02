<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author abd_salam
 */
class Wbk extends CI_Controller {

	public $view='wka/template';
    function __construct()
    {
        parent::__construct();
        $this->load->model('Crud_model');
		$this->load->helper('url', 'form','security'); 
        $this->load->library('form_validation');
        //$this->load->library('table');
		//$level = $this->session->userdata('level');
		
		//session_start();
    }
	function cek()
	{
		$level=$this->session->userdata('level');
		if($level!='wba')
		{
			$this->session->sess_destroy();
		//	unset($_SESSION[$sess_data]);
			redirect(base_url());
		}
	}
	
    public function index()
    {
		$this->cek();
		$data['title']='SIAKAD';
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		
		$key['aktif']='Ya';
		$data['profil']=$this->Crud_model->get_row_selected('sekolah',$key);
		$this->template->load($this->view, 'wba/sekolah', $data);
	}
    

}
?>