<?php
date_default_timezone_set("Asia/Makassar");
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Absen extends CI_Controller
{
    public $view='bk/template';
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Crud_model');
		$this->load->helper('url', 'form','security'); 
        $this->load->library('form_validation');
        //$this->load->library('table');
		$level = $this->session->userdata('level');
		
		//session_start();
    }

    public function index()
    {
		//$this->cek();
		  $data['aksi']='datang';
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
	    $data['gambar']=date('d-m-Y');
		$this->load->view('pos/index', $data);
	}
	public function datang()
	{
	    $data['aksi']='datang';
	    
		$this->load->view('pos/index', $data);
	}
	function istrahat()
	{
	    $data['aksi']='istrahat';
	    
		$this->load->view('pos/index', $data);
	}
	function izin()
	{
	    $data['aksi']='izin';
	    
		$this->load->view('pos/index', $data);
	}
		function pulang()
	{
	    $data['aksi']='istrahat';
	    
		$this->load->view('pos/index', $data);
	}

	public function save_absen()
	{
	    $data['nis']=$this->input->post('nis',true);
	     $data['status']='H';
	    $data['tgl_absen']=date("Y-m-d");
	     $data['jabsen']=$this->input->post('aksi',true);
	    
	     $data['jam']=date("H:i:s");

	  
	    
	    	
	    	$keys['nis']=$this->input->post('nis',true);
	    	$siswa=$this->Crud_model->get_row_selected('siswa',$keys);
	    	if($siswa)
	    	{
	    	      $this->Crud_model->save_data('absenh',$data);
	    	       $sess_data['foto'] = $siswa->image;
	    	       	$this->session->set_userdata($sess_data);
	    	}
	    		     
	      

	    redirect('absen','refresh');
	    
	}
	
	

	
	
	
	
	
   


    

}

?>