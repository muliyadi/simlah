<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Xkurikulum extends CI_Controller
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
		$data['list_kurikulum']=$this->Crud_model->get_all('kurikulum');
		$this->template->load('vtemplate/'.$this->view, 'vkurikulum/list_kurikulum', $data);
	   
	}
	
	function detail_kurikulum($kd_kurikulum)
    {
         $this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		
		$data['list_tingkat']=$this->Crud_model->get_all('tingkat');
		$data['list_semester']=$this->Crud_model->get_all('pelajaran_semester');
		$data['kd_kurikulum']=$kd_kurikulum;
	
		$this->template->load('vtemplate/'.$this->view, 'vkurikulum/pilih_tingkat_f', $data);
		
        
    }
    function save_pilihan_kurikulum()
	{
	      $sess_data['tingkat'] = $this->input->post('tingkat');
            $sess_data['semester'] = $this->input->post('semester');
			$sess_data['kd_kurikulum'] =$this->input->post('kd_kurikulum');
				$this->session->set_userdata($sess_data);
					redirect ('xkurikulum/list_detail_kurikulum','refresh');
	}
    function list_detail_kurikulum()
	{
	    	$this->cek();
	    		$data['menu']=$this->session->userdata('nm_sekolah');

			
	    $key['tingkat']=$this->session->userdata('tingkat');
	    $key['semester']=$this->session->userdata('semester');
	    $key['kd_kurikulum']=$this->session->userdata('kd_kurikulum');
	    

	    	$data['list_kurikulum_detail']=$this->Crud_model->get_list_selected('vkurikulum_detail',$key);
	    	
		$this->template->load('vtemplate/'.$this->view, 'vkurikulum/list_kurikulum_detail', $data);
	}
    function input_detail_kurikulum()
    {
        $kd_kurikulum=$this->session->userdata('kd_kurikulum');
        $tingkat=$this->session->userdata('tingkat');
        $semester=$this->session->userdata('semester');
        
        $this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		$data['kd_kurikulum']=$kd_kurikulum;
		$data['list_semester']=$this->Crud_model->get_all('pelajaran_semester');
		$data['list_tingkat']=$this->Crud_model->get_all('tingkat');
		$data['list_pelajaran']=$this->Crud_model->get_all('pelajaran');
			$data['list_kategori']=$this->Crud_model->get_all('kategori');
		
		$data['semester']=$semester;
		$data['tingkat']=$tingkat;
		$data['kd_kurikulum']=$kd_kurikulum;
		
		$this->template->load('vtemplate/'.$this->view, 'vkurikulum/form_kurikulum_detail', $data);
    }
    function save_detail_kurikulum()
    {
        $kurikulum=$this->input->post('kd_kurikulum');
        $data['kd_kurikulum']= $kurikulum;
        $data['tingkat']=$this->input->post('tingkat');
         $data['semester']=$this->input->post('semester');
          $data['kd_pelajaran']=$this->input->post('kd_pelajaran');
           $data['kategori']=$this->input->post('kategori');
           $data['waktu']=$this->input->post('waktu');
            $id_kurikulum=$this->creae_id_kurikulum($kurikulum);
            $data['id_kurikulum']=$id_kurikulum;
            $key['kd_kurikulum']= $kurikulum;
            $key['tingkat']=$this->input->post('tingkat');
            $key['semester']=$this->input->post('semester');
            $key['kd_pelajaran']=$this->input->post('kd_pelajaran');
            
          $cek= $this->Crud_model->get_row_selected('kurikulum_detail',$key);
            
           if($cek)
           {
                $this->Crud_model->update_data('kurikulum_detail',$data,$key);
           }else
           {
               $this->Crud_model->save_data('kurikulum_detail',$data);
           }
           
           
           $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data berhasil disimpan.");

	    $this->session->set_flashdata($pesan);
	 
	 	redirect(base_url('xkurikulum/list_detail_kurikulum'));
	//	$this->detail_kurikulum($kurikulum);
           
    }
    function edit_detail_kurikulum($id)
    {
         $this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		
		
        $key['id_kurikulum']=$id;
        $dk=$this->Crud_model->get_row_selected('kurikulum_detail',$key);
        
        
    }
    
    //modul kompetensi pelajaran
	function input_kompetensi($id_kurikulum)
	{
		$this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');

        $key['id_kurikulum']=$id_kurikulum;
		$kurikulum=$this->Crud_model->get_row_selected('vkurikulum_detail',$key);
	    
	    

	
		$data['no_urut']=$this->Crud_model->get_all('nourut');
	    	$data['id_kurikulum']=$id_kurikulum;
	    $data['kd_pelajaran']=$kurikulum->kd_pelajaran;
	    $data['nm_pelajaran']=$kurikulum->nm_pelajaran;
	    $data['semester']=$kurikulum->semester;
	    $data['tingkat']=$kurikulum->tingkat;
		$data['kompetensi_ke']='';
	    $data['desk_pengetahuan']='';
	    $data['desk_keterampilan']='';
		$keys['id_kurikulum']=$id_kurikulum;
		$data['list_kompetensi']=$this->Crud_model->get_list_selected('kurikulum_kompetensi',$keys);
		$this->template->load('vtemplate/'.$this->view,'vkurikulum/form_kompetensi',$data);
		
	}
	function edit_kompetensi($id_kurikulum,$ke)
	{
	    $this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		$data['no_urut']=$this->Crud_model->get_all('nourut');
	    $keyk['id_kurikulum']=$id_kurikulum;
	    $keyk['kompetensi_ke']=$ke;
	   
	    $kompetensi=$this->Crud_model->get_row_selected('kurikulum_kompetensi',$keyk);
	    $data['kompetensi_ke']=$kompetensi->kompetensi_ke;

        	$data['id_kurikulum']=$id_kurikulum;
	    $data['desk_pengetahuan']=$kompetensi->desk_pengetahuan;
	    $data['desk_keterampilan']=$kompetensi->desk_keterampilan;
	    
	      $key['id_kurikulum']=$id_kurikulum;
		$kurikulum=$this->Crud_model->get_row_selected('vkurikulum_detail',$key);
		 $data['kd_pelajaran']=$kurikulum->kd_pelajaran;
	    $data['nm_pelajaran']=$kurikulum->nm_pelajaran;
	    $data['semester']=$kurikulum->semester;
	    $data['tingkat']=$kurikulum->tingkat;
	    
	    	$data['list_kompetensi']=$this->Crud_model->get_list_selected('kurikulum_kompetensi',$key);
        	$this->template->load('vtemplate/'.$this->view,'vkurikulum/form_kompetensi',$data);
	   
	    
	}
	function save_kompetensi()
	{
		$key['id_kurikulum']=$this->input->post('id_kurikulum');
		$key['kompetensi_ke']=$this->input->post('kompetensi_ke');
		$data['desk_pengetahuan']=$this->input->post('desk_pengetahuan');
		$data['desk_keterampilan']=$this->input->post('desk_keterampilan');

		$cek=$this->Crud_model->get_row_selected('kurikulum_kompetensi',$key);
		if($cek)
		{
			$this->Crud_model->update_data('kurikulum_kompetensi',$data,$key);
		}else{
            $data['id_kurikulum']=$this->input->post('id_kurikulum');
		    $data['kompetensi_ke']=$this->input->post('kompetensi_ke');
			$this->Crud_model->save_data('kurikulum_kompetensi',$data);
		}
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Kompetensi Pelajaran berhasil disimpan.");
		$this->session->set_flashdata($pesan);
		
		
		$id=$this->input->post('id_kurikulum');
		redirect ('xkurikulum/input_kompetensi'.'/'.$id,'refresh');
	
		
	}
	public function delete_kompetensi($kd_pelajaran,$ke)
	{
	    $key['id_kurikulum']=$kd_pelajaran;
	    $key['kompetensi_ke']=$ke;
	    $cek=$this->Crud_model->delete_data('kurikulum_kompetensi',$key);
	    if($cek){
	        	$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Kompetensi Pelajaran berhasil dihapus.");
		
	    }else{
	        	$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Kompetensi Pelajaran berhasil dihapus.");
	    }
	    $this->session->set_flashdata($pesan);
	 
		$this->input_kompetensi($kd_pelajaran);
	    
	}
	//akhir modul kompetensi
	
	
	
	
	

	
	
	
	
	
   


    

}

?>