<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class xpelajaran extends CI_Controller
{
    public $view='';
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Crud_model');
		$this->load->helper('url', 'form','security'); 
        $this->load->library('form_validation');
        //$this->load->library('table');
		$level = $this->session->userdata('level');
		$this->view=$this->session->userdata('template');
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

	    $data['menu']=$this->session->userdata('nm_sekolah');
	    $data['list_pelajaran']=$this->Crud_model->get_all('pelajaran');
		
		$this->template->load('vtemplate/'.$this->view, 'vpelajaran/list_matapelajaran', $data);
	}
	
	function input_mata_pelajaran()
	{
		$this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		$data['list_kategori']=$this->Crud_model->get_all('kategori');
		$this->template->load('vtemplate/'.$this->view, 'vpelajaran/input_matapelajaran', $data);
	
	}
	public function save_mata_pelajaran()
	{
		$data['kd_pelajaran']=$this->input->post('kd_pelajaran');
		$data['nm_pelajaran']=$this->input->post('nm_pelajaran');
		$sub=$this->input->post('subkategori');
		$key['kategori']=$sub;
		$row=$this->Crud_model->get_row_selected('kategori',$key);
		$data['subkategori']=$sub;
		$data['kategori']=$row->group_kategori;
		$this->Crud_model->save_data('pelajaran',$data);
		
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"Data Pelajaran tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('xpelajaran');
		
	}
	public function edit_mata_pelajaran($kd)
	{
		$this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		$key['kd_pelajaran']=$kd;
		$data['pelajaran']=$this->Crud_model->get_row_selected('pelajaran',$key);
		$data['list_kategori']=$this->Crud_model->get_all('kategori');
		$this->template->load('vtemplate/'.$this->view, 'vpelajaran/edit_matapelajaran', $data);
	}
	function update_mata_pelajaran()
	{
		$keys['kd_pelajaran']=$this->input->post('kd_pelajaran');
		$data['nm_pelajaran']=$this->input->post('nm_pelajaran');
		$sub=$this->input->post('subkategori');
		$key['kategori']=$sub;
		$row=$this->Crud_model->get_row_selected('kategori',$key);
		$data['subkategori']=$sub;
		$data['kategori']=$row->group_kategori;
		$this->Crud_model->update_data('pelajaran',$data,$keys);
		
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"Data Pelajaran berhasil dirubah.");
		$this->session->set_flashdata($pesan);
		redirect ('xpelajaran');
	}
	
	function delete_mata_pelajaran($id)
	{
	    $this->cek();
		$key['kd_pelajaran']=$id;
		$this->Crud_model->delete_data('pelajaran',$key);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"Data Pelajaran berhasil dihapus.");
		$this->session->set_flashdata($pesan);
		redirect('xsiswa');
	}
	
	
	

	
	
	
	
	
   


    

}

?>