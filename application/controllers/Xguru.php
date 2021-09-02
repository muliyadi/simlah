<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Xguru extends CI_Controller
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
		$data['list']=$this->Crud_model->get_all('guru');
		$this->template->load('vtemplate/'.$this->view, 'vguru/list_guru', $data);
	}
	
	function input_guru()
	{
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['title']=' SIAKAD';
		$data['list_agama']=$this->Crud_model->get_all('agama');
		$data['list_jk']=$this->Crud_model->get_all('kelamin');
		$data['list_status']=$this->Crud_model->get_all('status');
		$data['id_guru']=$this->create_id_guru();
		$this->template->load('vtemplate/'.$this->view, 'vguru/input_guru', $data);
	}
	 function save_guru()
	{
		$nama = ($this->input->post('id_guru'));
		$config['upload_path']   = './foto_guru/';
        $config['allowed_types'] = 'jpg|jpeg|png'; //mencegah upload backdor
        $config['file_name']     = $nama; 
        $this->upload->initialize($config);
		if ($this->upload->do_upload('userfile')){
			$image = $this->upload->data();
			$data['image'] = $image['file_name'];
        }
		$data['nuptk']=$this->input->post('nuptk');
		$data['id_guru']=$this->input->post('id_guru');
		$data['nip']=$this->input->post('nip');
		$data['nm_guru']=$this->input->post('nm_guru');
		$data['jk']=$this->input->post('jk');
		$data['agama']=$this->input->post('agama');
		$data['no_hp']=$this->input->post('no_hp');
		$data['alamat']=$this->input->post('alamat');
		$data['email']=$this->input->post('email');
		$data['tempat']=$this->input->post('tempat');
		$data['pendidikan']=$this->input->post('pendidikan');
		$data['gelar_depan']=$this->input->post('gelar_depan');
		$data['gelar_belakang']=$this->input->post('gelar_belakang');
		$data['pangkat']=$this->input->post('pangkat');
		$data['golongan']=$this->input->post('golongan');
		$data['tgl_lahir']=$this->input->post('tgl_lahir');
		$data['status']=$this->input->post('status');
		$data['nik']=$this->input->post('nik');
		$data['bidang']=$this->input->post('bidang');

		$this->Crud_model->save_data('guru',$data);
		
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Guru tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('xguru');
			
	}
	function edit_guru($id)
	{
		$key['id_guru']=$id;
		$data['guru']=$this->Crud_model->get_row_selected('guru',$key);
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['list_agama']=$this->Crud_model->get_all('agama');
		$data['list_jk']=$this->Crud_model->get_all('kelamin');
		$data['list_status']=$this->Crud_model->get_all('status');
		$this->template->load('vtemplate/'.$this->view, 'vguru/edit_guru', $data);
	}
	public function update_guru()
	{
		$keys['id_guru']=$this->input->post('id_guru');
		$nama = ($this->input->post('id_guru'));
		$config['upload_path']   = './foto_guru/';
        $config['allowed_types'] = 'jpg|jpeg|png'; //mencegah upload backdor
        $config['file_name']     = $nama; 
        $this->upload->initialize($config);
		if ($this->upload->do_upload('userfile')){
			$image = $this->upload->data();
			$data['image'] = $image['file_name'];
			$guru=$this->Crud_model->get_row_selected('guru',$keys);
			if(!empty($guru->image)){
			   	unlink('foto_guru/'.$guru->image);
			}
		
        }
		$data['nuptk']=$this->input->post('nuptk');
		$data['nip']=$this->input->post('nip');
		$data['nm_guru']=$this->input->post('nm_guru');
		$data['jk']=$this->input->post('jk');
		$data['agama']=$this->input->post('agama');
		$data['no_hp']=$this->input->post('no_hp');
		$data['alamat']=$this->input->post('alamat');
		$data['email']=$this->input->post('email');
		$data['tempat']=$this->input->post('tempat');
		$data['pendidikan']=$this->input->post('pendidikan');
		$data['gelar_depan']=$this->input->post('gelar_depan');
		$data['gelar_belakang']=$this->input->post('gelar_belakang');
		$data['pangkat']=$this->input->post('pangkat');
		$data['golongan']=$this->input->post('golongan');
		$data['tgl_lahir']=$this->input->post('tgl_lahir');
		$data['status']=$this->input->post('status');
		$data['nik']=$this->input->post('nik');
		$data['bidang']=$this->input->post('bidang');
		
		$this->Crud_model->update_data('guru',$data,$keys);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Guru tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('xguru');
	}
	function delete_guru($id)
	{
		$keys['id_guru']=$id;
		$guru=$this->Crud_model->get_row_selected('guru',$keys);
		unlink('foto_guru/'.$guru->image);
		$this->Crud_model->delete_data('guru',$keys);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Guru terhapus.");
		$this->session->set_flashdata($pesan);
		redirect ('xguru');
	}
	function password_guru($id)
	{
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$keyguru['id_guru']=$id;
		$data['guru']=$this->Crud_model->get_row_selected('guru',$keyguru);
		$this->template->load('vtemplate/'.$this->view, 'vguru/password', $data);
	}
	
	function save_password_guru()
	{
		$data['userid']=$this->input->post('id_guru');
		$data['username']=$this->input->post('username');
		$data['password']=$this->input->post('password');
		$data['level']='guru';
		$data['status']='1';

		$keyuser['userid']=$this->input->post('id_guru');
		$cek=$this->Crud_model->get_row_selected('user',$keyuser);
		if($cek)
		{
			$this->Crud_model->update_data('user',$data,$keyuser);
		}else
		{
			$this->Crud_model->save_data('user',$data);
		}
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Akun Guru tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('xguru');
	}
	
	
	

	
	
	
	
	
   


    

}

?>