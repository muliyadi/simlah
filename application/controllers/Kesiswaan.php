<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kesiswaan extends CI_Controller
{
    public $view='kesiswaan/template';
        
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
		if($level!='kesiswaan')
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
		$this->template->load($this->view, 'kesiswaan/dashboards', $data);
	}
	function prestasi_siswa()
	{
	    $this->cek();
	    $kd_ta=$this->session->userdata('kd_ta');
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
	    $sql="SELECT siswa.image,prestasi.kd_ta,prestasi.nis,prestasi.jenis_prestasi,prestasi.keterangan,siswa.nm_siswa,siswa.kelas FROM `prestasi`,siswa where prestasi.nis=siswa.nis and prestasi.kd_ta='".$kd_ta."'";
	    $data['list']=$this->db->query($sql)->result();
	    $this->template->load($this->view, 'kesiswaan/prestasi/list_prestasi', $data);
	}
	function input_prestasi_siswa()
	{
	    $kd_ta=$this->session->userdata('kd_ta');
		$keysiswa['status']='Aktif';
	    $data['list_siswa']=$this->Crud_model->get_list_selected('siswa',$keysiswa);
	    $data['list_ta']=$this->Crud_model->get_all('thnajaran');
		$data['kd_ta']=$kd_ta;
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$this->template->load($this->view, 'kesiswaan/prestasi/input_prestasi_siswa', $data);
	}
	
	function save_prestasi_siswa()
	{
	    $key['kd_ta']=$this->input->post('kd_ta');
	    $key['nis']=$this->input->post('nis');
	    $key['jenis_prestasi']=$this->input->post('jenis_prestasi');
	    $data['keterangan']=$this->input->post('keterangan');
	    
	    $hasil=$this->Crud_model->get_row_selected('prestasi',$key);
	    if($hasil)
	    {
	        $this->Crud_model->update_data('prestasi',$data,$key);
	    }else
	    {
	        $data['kd_ta']=$this->input->post('kd_ta');
	        $data['nis']=$this->input->post('nis');
	         $data['jenis_prestasi']=$this->input->post('jenis_prestasi');
	        $this->Crud_model->save_data('prestasi',$data);
	        
	    }
	    $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Data berhasil disimpan...! </h4>");
		$this->session->set_flashdata($pesan);
	    	redirect('kesiswaan/input_prestasi_siswa');
	}
	function delete_prestasi_siswa($id)
	{
	    $key['id']=$id;
	   
	    $this->Crud_model->delete_data('prestasi',$key);
	    $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Data berhasil dihapus...! </h4>");
	    $this->session->set_flashdata($pesan);
	    	redirect('kesiswaan/prestasi_siswa');
	    
	}
	
	//modul siswa
	
	function siswa()
	{
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['list']=$this->Crud_model->get_all('siswa');
		$this->template->load($this->view, 'kesiswaan/siswa/list_siswa', $data);
	}
	function input_siswa()
	{
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['list_status_siswa']=$this->Crud_model->get_all('status_siswa');
		$data['list_kelamin']=$this->Crud_model->get_all('kelamin');
		$data['list_agama']=$this->Crud_model->get_all('agama');
		$data['list_negara']=$this->Crud_model->get_all('negara');
		$data['list_kelas']=$this->Crud_model->get_all('kelas');
		//$data['list_program']=$this->Crud_model->get_all('program');
		$this->template->load($this->view, 'kesiswaan/siswa/input_siswa', $data);
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
		$data['kelas']=$this->input->post('kelas');
	//	$data['program']=$this->input->post('program');
	//	$data['kelompok']=$this->input->post('kelompok');
		$data['status']=$this->input->post('status');
		$this->Crud_model->save_data('siswa',$data);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Siswa Tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('kesiswaan/siswa');	
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
		$this->template->load($this->view, 'kesiswaan/siswa/edit_siswa', $data);
	}
	function update_siswa()
	{
		$key['nis']=$this->input->post('nislama');
		$nama = ($this->input->post('nis'));
		$config['upload_path']   = './foto_siswa/';
        $config['allowed_types'] = 'jpg|jpeg|png'; //mencegah upload backdor
        $config['file_name']     = $nama; 
        $this->upload->initialize($config);
		if ($this->upload->do_upload('userfile')){
			$image = $this->upload->data();
			$data['image'] = $image['file_name'];
			$siswa=$this->Crud_model->get_row_selected('siswa',$key);
			unlink('foto_siswa'.'/'.$siswa->image);
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
		$data['kelas']=$this->input->post('kelas');
		
		$data['kelompok']=$this->input->post('kelompok');
		$data['status']=$this->input->post('status');
		$datauser['username']=$this->input->post('nm_siswa');
		$keyuser['userid']=$this->input->post('nis');
		$this->Crud_model->update_data('user',$datauser,$keyuser);
		$this->Crud_model->update_data('siswa',$data,$key);
		
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Siswa Tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect('kesiswaan/siswa');
	}
	function delete_siswa($id)
	{
		$key['nis']=$id;
		$this->Crud_model->delete_data('siswa',$key);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Siswa Terhapus.");
		$this->session->set_flashdata($pesan);
		redirect('kesiswaan/siswa');
	}
	
	
	

	
	
	
	
	
   


    

}

?>