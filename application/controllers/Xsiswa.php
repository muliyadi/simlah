<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Xsiswa extends CI_Controller
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

		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['list']=$this->Crud_model->get_all('siswa');
		$this->template->load('vtemplate/'.$this->view, 'vsiswa/list_siswa', $data);
	}
	
	function input_siswa()
	{
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['list_status_siswa']=$this->Crud_model->get_all('status_siswa');
		$data['list_kelamin']=$this->Crud_model->get_all('kelamin');
		$data['list_agama']=$this->Crud_model->get_all('agama');
		$data['list_negara']=$this->Crud_model->get_all('negara');
			$data['list_status_keluarga']=$this->Crud_model->get_all('status_dalam_keluarga');
		//$data['list_program']=$this->Crud_model->get_all('program');
		$this->template->load('vtemplate/'.$this->view, 'vsiswa/input_siswa', $data);
	}
	function save_siswa()
	{
	    $this->cek();
		$nama = ($this->input->post('nis'));
		$config['upload_path']   = './foto_siswa/';
        $config['allowed_types'] = 'jpg|jpeg|png'; //mencegah upload backdor
        $config['file_name']     = $nama; 
        $this->upload->initialize($config);
		if ($this->upload->do_upload('userfile')){
			$image = $this->upload->data();
			$data['image'] = $image['file_name'];
			
			    $configx['image_library']='gd2';
                $configx['source_image']='./foto_siswa/'.$image['file_name'];
                $configx['create_thumb']= FALSE;
                $configx['maintain_ratio']= FALSE;
                $configx['quality']= '50%';
                $configx['width']= 600;
                $configx['height']= 400;
                $configx['new_image']= './assets/images/'.$image['file_name'];
                $this->load->library('image_lib', $configx);
                $this->image_lib->resize();
        }
		$data['nis']=$this->input->post('nis');
		$data['nisn']=$this->input->post('nisn');
		$data['nm_siswa']=$this->input->post('nm_siswa');
		$data['tempat']=$this->input->post('tempat');
		$data['tgl_lahir']=$this->input->post('tgl_lahir');
		$data['jk']=$this->input->post('kelamin');
		$data['agama']=$this->input->post('agama');
		$data['kewarganegaraan']=$this->input->post('kewarganegaraan');
		$data['alamat']=$this->input->post('alamat');
		$data['no_hp']=$this->input->post('no_hp');
        
        $data['asal_sekolah']=$this->input->post('asal_sekolah');
		$data['alamat_asal_sekolah']=$this->input->post('alamat_asal_sekolah');
		$data['tahun_ijazah']=$this->input->post('tahun_ijazah');
		$data['no_ijazah']=$this->input->post('no_ijazah');
		$data['anak_ke']=$this->input->post('anak_ke');
		$data['status_dalam_keluarga']=$this->input->post('status_dalam_keluarga');
		$data['nama_ayah']=$this->input->post('nama_ayah');
		$data['nama_ibu']=$this->input->post('nama_ibu');
		$data['pekerjaan_ayah']=$this->input->post('pekerjaan_ayah');
		$data['pekerjaan_ibu']=$this->input->post('pekerjaan_ibu');
		$data['alamat_ayah']=$this->input->post('alamat_ayah');
		$data['no_hp_ayah']=$this->input->post('no_hp_ayah');
		//wali
		$data['nama_wali']=$this->input->post('nama_wali');
		$data['pekerjaan_wali']=$this->input->post('pekerjaan_wali');
		$data['alamat_wali']=$this->input->post('alamat_wali');
		$data['no_hp_wali']=$this->input->post('no_hp_wali');
        $data['status']=$this->input->post('status');
		$this->Crud_model->save_data('siswa',$data);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Siswa Tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('xsiswa');	
	}
	function edit_siswa($id)
	{
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$key['nis']=$id;
		$data['siswa']=$this->Crud_model->get_row_selected('siswa',$key);
		$data['list_status_siswa']=$this->Crud_model->get_all('status_siswa');
		$data['list_kelamin']=$this->Crud_model->get_all('kelamin');
		$data['list_agama']=$this->Crud_model->get_all('agama');
		$data['list_negara']=$this->Crud_model->get_all('negara');
        	$data['list_status_keluarga']=$this->Crud_model->get_all('status_dalam_keluarga');
		$this->template->load('vtemplate/'.$this->view, 'vsiswa/edit_siswa', $data);
	}
	function update_siswa()
	{
	    $this->cek();
		$key['nis']=$this->input->post('nislama');
		$nama = ($this->input->post('nis'));
		$config['upload_path']   = './foto_siswa/';
        $config['allowed_types'] = 'jpg|jpeg|png'; //mencegah upload backdor
        $config['file_name']     = $nama; 
         $config['max_size']     = '1024'; 
        
        $this->upload->initialize($config);
		if ($this->upload->do_upload('userfile')){
			$image = $this->upload->data();
			$data['image'] = $image['file_name'];
			$siswa=$this->Crud_model->get_row_selected('siswa',$key);
			
			    $configx['image_library']='gd2';
                $configx['source_image']='./foto_siswa/'.$image['file_name'];
                $configx['create_thumb']= FALSE;
                $configx['maintain_ratio']= FALSE;
                $configx['quality']= '50%';
                $configx['width']= 600;
                $configx['height']= 400;
                $configx['new_image']= './foto_siswa/'.$image['file_name'];
                $this->load->library('image_lib', $configx);
                $this->image_lib->resize();
			    unlink('foto_siswa'.'/'.$siswa->image);
			    
			    $data['nis']=$this->input->post('nis');
		$data['nisn']=$this->input->post('nisn');
		$data['nm_siswa']=$this->input->post('nm_siswa');
		$data['tempat']=$this->input->post('tempat');
		$data['tgl_lahir']=$this->input->post('tgl_lahir');
		$data['jk']=$this->input->post('kelamin');
		$data['agama']=$this->input->post('agama');
		$data['kewarganegaraan']=$this->input->post('kewarganegaraan');
		$data['alamat']=$this->input->post('alamat');
		$data['no_hp']=$this->input->post('no_hp');
        $data['asal_sekolah']=$this->input->post('asal_sekolah');
		$data['alamat_asal_sekolah']=$this->input->post('alamat_asal_sekolah');
		$data['tahun_ijazah']=$this->input->post('tahun_ijazah');
		$data['no_ijazah']=$this->input->post('no_ijazah');
		$data['anak_ke']=$this->input->post('anak_ke');
		$data['status_dalam_keluarga']=$this->input->post('status_dalam_keluarga');
		$data['nama_ayah']=$this->input->post('nama_ayah');
		$data['nama_ibu']=$this->input->post('nama_ibu');
		$data['pekerjaan_ayah']=$this->input->post('pekerjaan_ayah');
		$data['pekerjaan_ibu']=$this->input->post('pekerjaan_ibu');
		$data['alamat_ayah']=$this->input->post('alamat_ayah');
		$data['no_hp_ayah']=$this->input->post('no_hp_ayah');
		//wali
		$data['nama_wali']=$this->input->post('nama_wali');
		$data['pekerjaan_wali']=$this->input->post('pekerjaan_wali');
		$data['alamat_wali']=$this->input->post('alamat_wali');
		$data['no_hp_wali']=$this->input->post('no_hp_wali');
        $data['status']=$this->input->post('status');
        
        
		$datauser['username']=$this->input->post('nm_siswa');
		$keyuser['userid']=$this->input->post('nis');
		$this->Crud_model->update_data('user',$datauser,$keyuser);
		$this->Crud_model->update_data('siswa',$data,$key);
		
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Siswa Tersimpan.");
		$this->session->set_flashdata($pesan);
	
        }else
        {
             $error = $this->upload->display_errors();
            	$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>".$error."");
		        $this->session->set_flashdata($pesan);
          
        }
        	redirect('xsiswa');
	}
	function delete_siswa($id)
	{
	    $this->cek();
		$key['nis']=$id;
		$this->Crud_model->delete_data('siswa',$key);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Siswa Terhapus.");
		$this->session->set_flashdata($pesan);
		redirect('xsiswa');
	}
	function reset_password_siswa($nis)
	{
	    $this->cek();
	    $data['userid']=$nis;
	    $key['nis']=$nis;
	    $keyuser['userid']=$nis;
	    $siswa=$this->Crud_model->get_row_selected('siswa',$key);
	    
	    $data['username']=$siswa->nm_siswa;
	    $data['password']='merdeka';
	    $data['level']='siswa';
	    $data['homebase']=$siswa->kelas;
	    $data['status']=1;
	    if($siswa)
	    {
	        $this->Crud_model->update_data('user',$data,$keyuser);
	        
	    }else
	    {
	        $data['userid']=$nis;
	        $this->Crud_model->save_data('user',$data);
	       // echo 'berhasil';
	        
	    }
	    $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Reset Passsword Siswa Berhasil.");
		$this->session->set_flashdata($pesan);
		redirect ('xsiswa');
	}
	
	
	

	
	
	
	
	
   


    

}

?>