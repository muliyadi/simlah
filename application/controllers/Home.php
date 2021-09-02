<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller
{
    public $view='';
     public $home='';
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Crud_model');
		$this->load->helper('url', 'form','security'); 
        $this->load->library('form_validation');
        //$this->load->library('table');
		$level = $this->session->userdata('level');
		$this->view=$this->session->userdata('template');
		$this->home=$this->session->userdata('home');
		//session_start();
    }
	function cek()
	{
		$login=$this->session->userdata('logged_in');
		if($login!='1')
		{
            $this->session->sess_destroy();
	
	        redirect(base_url());
		}

	}
    public function index()
    {
		$this->cek();

		$data['menu']=' '.$this->session->userdata('nm_sekolah');

		$this->template->load('vtemplate/'.$this->view, 'vhome/'.$this->home, $data);
	}
	
	
	
	
	

	
	
	
	
	
   


    

}

?>