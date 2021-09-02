<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ktu extends CI_Controller
{
    public $view='vtemplate/tktu';
        
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
	function cek()
	{
		$level=$this->session->userdata('level');
		if($level!='ktu')
		{
			$this->session->sess_destroy();
			//unset($_SESSION[$sess_data]);
			redirect(base_url());
		}
		$key['aktif']='Ya';
		$data['profil']=$this->Crud_model->get_row_selected('profil',$key);
	}
    public function index()
    {
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['jumlah_siswa']=$this->Crud_model->totalRows('siswa');
		$filter['status']='Keluar';
		$data['jumlah_siswa_keluar']=$this->Crud_model->total_rows_filter('siswa',$filter);
		$filter2['status']='aktif';
		$data['jumlah_siswa_aktif']=$this->Crud_model->total_rows_filter('siswa',$filter2);
		$key['status']=1;
		$data['sekolah']=$this->Crud_model->get_row_selected('sekolah',$key);
		$this->template->load($this->view, 'ktu/dashboards', $data);
	}
	function visi()
	{
	    $key['status']=1;
	    $this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['sekolah']=$this->Crud_model->get_row_selected('sekolah',$key);
		$this->template->load($this->view, 'ktu/visi/visi', $data);
	}
	
	function save_visi()
	{
	    $key['npsn']=$this->input->post('npsn');
	    
	    	$data['visi']=$this->input->post('visi');
		$this->Crud_model->update_data('sekolah',$data,$key);
			$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Visi-Misi Tersimpan.");
			$this->session->set_flashdata($pesan);
		redirect('ktu/visi');
	}
	function siswa()
	{
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['list']=$this->Crud_model->get_all('siswa');
		$this->template->load($this->view, 'ktu/siswa/list_siswa', $data);
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
		$data['list_kelas']=$this->Crud_model->get_all('kelas');
		$data['list_program']=$this->Crud_model->get_all('program');
		$data['list_status_keluarga']=$this->Crud_model->get_all('status_dalam_keluarga');
		$this->template->load($this->view, 'ktu/siswa/edit_siswa', $data);
	}
	
	function update_siswa()
	{
	   
		$key['nis']=$this->input->post('nis');
		$nama = ($this->input->post('nis'));
		$config['upload_path']   = './foto_siswa/';
        $config['allowed_types'] = 'jpg|jpeg|png'; //mencegah upload backdor
        $config['file_name']     = $nama; 
        $config['overwrite']	 = true;
        $this->upload->initialize($config);
         if (!empty($_FILES['userfile']['name'])) 
         {
             if ($this->upload->do_upload('userfile')){
        		    $image = $this->upload->data();
        			$data['image'] = $image['file_name'];
        		    
                }
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
		
		
		//$data['kelompok']=$this->input->post('kelompok');
		$data['status']=$this->input->post('status');
		$this->Crud_model->update_data('siswa',$data,$key);
		
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Siswa Tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect('ktu/siswa');
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
		$this->template->load($this->view, 'ktu/siswa/input_siswa', $data);
	}
		function save_siswa()
	{
		$nama = ($this->input->post('nis'));
		$config['upload_path']   = './foto_siswa/';
        $config['allowed_types'] = 'jpg|jpeg|png'; //mencegah upload backdor
        $config['file_name']     = $nama; 
        $this->upload->initialize($config);
		if ($this->upload->do_upload('userfile')){
			$image = $this->upload->data();
			$data['image'] = $image['file_name'];
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
	
		$data['status']=$this->input->post('status');
		$this->Crud_model->save_data('siswa',$data);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Siswa Berhasil Disimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('ktu/siswa');	
	}
		function delete_siswa($id)
	{
		$key['nis']=$id;
		$this->Crud_model->delete_data('siswa',$key);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"Data Siswa Berhasil Dihapus!");
		$this->session->set_flashdata($pesan);
		redirect('ktu/siswa');
	}
	
	 function reset_password_siswa($nis)
	{
	    $this->cek();
	    $data['userid']=$nis;
	    $key['nis']=$nis;
	    $keyuser['userid']=$nis;
	    $siswa=$this->Crud_model->get_row_selected('siswa',$key);
	    
	    $data['username']=$siswa->nm_siswa;
	    $data['password']='terbaik';
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
	        echo 'berhasil';
	        
	    }
	    $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Reset Passsword Siswa Berhasil.");
		$this->session->set_flashdata($pesan);
		redirect ('ktu/siswa');
	}
	//modul wali kelas
	function list_wali_kelas()
	{
	    $this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$sql="select kd_ta,kelas,guru.nm_guru,guru.nip from wali_kelas,guru where wali_kelas.id_guru=guru.id_guru";
		$hasil = $this->db->query($sql)->result();
		$data['list_wali_kelas']=$hasil;
		$this->template->load($this->view, 'ktu/walikelas/list_wali_kelas', $data);
	}
	function input_wali_kelas()
	{
	    $this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['list_ta']=$this->Crud_model->get_all('thnajaran');
		$data['list_guru']=$this->Crud_model->get_all('guru');
		$data['list_kelas']=$this->Crud_model->get_all('kelas');
			$data['kd_ta']='';
		$data['kelas']='';
		$data['id_guru']='';
		//$data['list_program']=$this->Crud_model->get_all('program');
		$this->template->load($this->view, 'ktu/walikelas/input_wali_kelas', $data);
	}
	function save_wali_kelas()
	{
	    
	    $key['kelas']=$this->input->post('kelas');
	    $key['kd_ta']=$this->input->post('kd_ta');
	    
	    $data['id_guru']=$this->input->post('id_guru');
	    $data['kelas']=$this->input->post('kelas');
	    $data['kd_ta']=$this->input->post('kd_ta');
	    $ada=$this->Crud_model->get_row_selected('wali_kelas',$key);
	    if($ada)
	    {
	        $this->Crud_model->update_data('wali_kelas',$data,$key);
	    	    $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Ubah Data Wali Kelas Sukses .");
		
	    }else
	    {
	        $this->Crud_model->save_data('wali_kelas',$data);
	        $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Simpan Data Wali Kelas Sukses .");
	    }
	    $keyx['id_kelas']=$this->input->post('kelas');
	    $datax['id_guru']=$this->input->post('id_guru');
	    $this->Crud_model->update_data('kelas',$datax,$keyx);
	    $this->session->set_flashdata($pesan);
		redirect ('ktu/list_wali_kelas');
	    
	}
	function edit_wali_kelas($kd_ta,$kelas)
	{
	    $this->cek();
	    $key['kelas']=$kelas;
	    $key['kd_ta']=$kd_ta;
	    $ada=$this->Crud_model->get_row_selected('wali_kelas',$key);
	    
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['list_ta']=$this->Crud_model->get_all('thnajaran');
		$data['list_guru']=$this->Crud_model->get_all('guru');
		$data['list_kelas']=$this->Crud_model->get_all('kelas');
		$data['kd_ta']=$kd_ta;
		$data['kelas']=$kelas;
		$data['id_guru']=$ada->id_guru;
		
		
			$this->template->load($this->view, 'ktu/walikelas/input_wali_kelas', $data);
	}
	function delete_wali_kelas($kd_ta,$kelas)
	{
	    $key['kelas']=$kelas;
	    $key['kd_ta']=$kd_ta;
	    $this->Crud_model->delete_data('wali_kelas',$key);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Hapus Data Wali Kelas Sukses .");
		$this->session->set_flashdata($pesan);
		redirect ('ktu/list_wali_kelas');
	}
	//modul kasek
	function list_kasek()
	{
	    $this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['list_kasek']=$this->Crud_model->get_all('kasek');
		//$data['list_program']=$this->Crud_model->get_all('program');
		$this->template->load($this->view, 'ktu/kasek/list_kasek', $data);
	}
	function input_kasek()
	{
	    $this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['list_ta']=$this->Crud_model->get_all('thnajaran');
		//$data['list_program']=$this->Crud_model->get_all('program');
		$this->template->load($this->view, 'ktu/kasek/input_kasek', $data);
	}
	
	function save_kasek()
	{
	    $key['kd_ta']=$this->input->post('kd_ta');
	    $data['kd_ta']=$this->input->post('kd_ta');
	    $data['nm_kasek']=$this->input->post('nm_kasek');
	    $data['nip_kasek']=$this->input->post('nip_kasek');
	    
	    $ada=$this->Crud_model->get_row_selected('kasek',$key);
	    if($ada)
	    {
	        $this->Crud_model->update_data('kasek',$data,$key);
	    	    $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Ubah Data Kepala Sekolah Sukses .");
		
	    }else
	    {
	        $this->Crud_model->save_data('kasek',$data);
	        $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Simpan Data Kepala Sekolah Sukses .");
	    }
	    $this->session->set_flashdata($pesan);
		redirect ('ktu/list_kasek');
	}
function delete_kasek($id)
{
    $this->cek();
        $key['kd_ta']=$id;
		$this->Crud_model->delete_data('kasek',$key);
		
		redirect ('ktu/list_kasek');
}
function edit_kasek($id)
{
    $this->cek();
        $key['kd_ta']=$id;
		$data['kasek']=$this->Crud_model->get_row_selected('kasek',$key);
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['list_ta']=$this->Crud_model->get_all('thnajaran');
		$data['kd_ta']=$id;
			$this->template->load($this->view, 'ktu/kasek/edit_kasek', $data);
}
	
	
	
	
	
   


    

}

?>