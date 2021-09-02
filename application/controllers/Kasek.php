<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kasek extends CI_Controller
{
    public $view='kasek/template';
        
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
		$this->cek();
		$data['menu']=' Dashboard';
		$key['status']=1;
		$data['sekolah']=$this->Crud_model->get_row_selected('sekolah',$key);
		$this->template->load($this->view, 'kasek/dashboards', $data);
	}
	function cek()
	{
		$level=$this->session->userdata('level');
		if($level!='kasek')
		{
			$this->session->sess_destroy();
			//unset($_SESSION[$sess_data]);
			redirect(base_url());
		}
		$data['title']='SIAKAD';
		
		$key['aktif']='Ya';
		$data['profil']=$this->Crud_model->get_row_selected('profil',$key);
	}
	//modul skl
	public function hapus_skl_ipa($nis,$kd_ta)
	{
	    $key['nis']=$nis;
	    $key['kd_ta']=$kd_ta;
	    $hasil=$this->Crud_model->delete_data('nilai_ujian_sekolah_ipa',$key);
	    if($hasil)
	    {
	        $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4> Data SKL Sukses dihapus...!");
	        $this->session->set_flashdata($pesan);
	    }
	    redirect('kasek/skl_lap');
	    
	}
	public function hapus_skl_ips($nis,$kd_ta)
	{
	    $key['nis']=$nis;
	    $key['kd_ta']=$kd_ta;
	    $hasil=$this->Crud_model->delete_data('nilai_ujian_sekolah_ips',$key);
	    if($hasil)
	    {
	        $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4> Data SKL Sukses dihapus...!");
	        $this->session->set_flashdata($pesan);
	    }
	    redirect('kasek/skl_lap');
	    
	}
	public function skl_lap()
	{
	    $data['menu']=' SMA Negeri 1 Mawasangka Tengah';
        $data['list_ta']=$this->Crud_model->get_all('thnajaran');
        $this->template->load($this->view, 'kasek/form/skl_lap', $data);
	}
	public function preview_lap_skl()
	{
	     $data['menu']=' SMA Negeri 1 Mawasangka Tengah';
	    $kd_ta=$this->input->post('kd_ta');
        $program=$this->input->post('program');
        $data['program']=$program;
        $data['kd_ta']=$kd_ta;
        
        $key['kd_ta']=$kd_ta;
        if($program=='ips')
        {
            $data['list']=$this->Crud_model->get_list_selected('vskl_ips',$key);
            
            $this->template->load($this->view, 'kasek/view/view_skl_ips', $data);
        }else
        {
            
            $data['list']=$this->Crud_model->get_list_selected('vskl_ipa',$key);
            $this->template->load($this->view, 'kasek/view/view_skl_ipa', $data);
        }
	}
	public function upload_skl()
	{
	    $data['menu']=' SMA Negeri 1 Mawasangka Tengah';
        $data['list_ta']=$this->Crud_model->get_all('thnajaran');
        $this->template->load($this->view, 'kasek/form/skl_f', $data);
	}
	public function upload_file_skl(){
	    
    $this->load->library('upload'); // Load librari upload
    
    $kd_ta=$this->input->post('kd_ta');
    $program=$this->input->post('program');
    $nama='SKL_'.$program.'_'.$kd_ta;
    $config['upload_path'] = 'skl/';
    $config['allowed_types'] = 'xlsx';
    $config['max_size']  = '2048';
    $config['overwrite'] = true;
    $config['file_name'] = $nama;
  
    $this->upload->initialize($config); // Load konfigurasi uploadnya
    if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
        $this->view_file_skl($nama,$kd_ta,$program);
    }else{
      // Jika gagal :
      $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
      return $return;
    }
  }
  public function view_file_skl($nama,$kd_ta,$program)
  {
      include APPPATH.'libraries/PHPExcel/PHPExcel.php';
        $data['menu']=' SMA Negeri 1 Mawasangka Tengah';
        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('skl/'.$nama.'.xlsx'); // Load file yang tadi diupload ke folder excel
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
        // Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
        // Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
        $data['sheet'] = $sheet; 
        $data['namafile'] = $nama; 
        $data['kd_ta']=$kd_ta;
         $data['program']=$program;
        if($program=='ips')
        {
            $this->template->load($this->view, 'kasek/view/view_upload_skl', $data);
        }else
        {
            $this->template->load($this->view, 'kasek/view/view_upload_skl_ipa', $data);
        }
  }
  
	
  	public function import()
  	{
	    $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4> Import Data SKL Gagal...!");
	$namafile=$this->input->post('namafile');
    $kd_ta=$this->input->post('kd_ta');
     $program=$this->input->post('program');
    // Load plugin PHPExcel nya
    include APPPATH.'libraries/PHPExcel/PHPExcel.php';
    
    $excelreader = new PHPExcel_Reader_Excel2007();
    $loadexcel = $excelreader->load('skl/'.$namafile.'.xlsx'); // Load file yang telah diupload ke folder excel
    $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
    
    // Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
   // $data = array();
  $numrow = 1;
    foreach($sheet as $row){
      if($row['B']!='NAMA' and $row['F']!=''){
          if($program=='ips')
          {
            $key['nis']=$row['F'];
            $key['kd_ta']=$kd_ta;
            
            $data['kd_ta'] = $kd_ta;
            $data['no_surat'] = $row['A']; // Ambil data NIS
            //$data['nm_siswa ']= $row['B'];
            //$data['tempat_lahir']=$row['C'];
            //$data['tgl_lahir']=$row['D'];
            //$data['nm_orang_tua']=$row['E'];
            $data['nis']=$row['F'];
            //$data['nisn']=$row['G'];
            $data['no_peserta_ujian']=$row['H'];
           // $data['sekolah_asal']=$row['I'];
            $data['PAIPB']=$row['J'];
            $data['PKN']=$row['K'];
            $data['BINDO']=$row['L'];
            $data['MAT']=$row['M'];
            $data['SJRINDO']=$row['N'];
            $data['BING']=$row['O'];
            $data['SENI']=$row['P'];
            $data['PJOK']=$row['Q'];
            $data['PKWU']=$row['R'];
            $data['MULOK']=$row['S'];
            $data['GEO']=$row['T'];
            $data['SJR']=$row['U'];
            $data['SOS']=$row['V'];
            $data['EKO']=$row['W'];
            $data['LTM1']=$row['X'];
            $data['RATA2']=$row['Y'];
            $data['kelulusan']=$row['Z'];
            $hasil=$this->Crud_model->get_row_selected('nilai_ujian_sekolah_ips',$key);
            if($hasil)
            {
                $this->Crud_model->update_data('nilai_ujian_sekolah_ips',$data,$key);
                $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4> Import/Update Data SKL Sukses...!");
            }else
            {
                $this->Crud_model->save_data('nilai_ujian_sekolah_ips',$data);
                $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4> Import Data SKL Sukses...!");
               
            }
              
        }else
            {
                $key['nis']=$row['F'];
            $key['kd_ta']=$kd_ta;
            
            $data['kd_ta'] = $kd_ta;
            $data['no_surat'] = $row['A']; // Ambil data NIS
            //$data['nm_siswa ']= $row['B'];
            //$data['tempat_lahir']=$row['C'];
            //$data['tgl_lahir']=$row['D'];
            //$data['nm_orang_tua']=$row['E'];
            $data['nis']=$row['F'];
            //$data['nisn']=$row['G'];
            $data['no_peserta_ujian']=$row['H'];
           // $data['sekolah_asal']=$row['I'];
            $data['PAIPB']=$row['J'];
            $data['PKN']=$row['K'];
            $data['BINDO']=$row['L'];
            $data['MAT']=$row['M'];
            $data['SJRINDO']=$row['N'];
            $data['BING']=$row['O'];
            $data['SENI']=$row['P'];
            $data['PJOK']=$row['Q'];
            $data['PKWU']=$row['R'];
            $data['MULOK']=$row['S'];
            $data['MATIPA']=$row['T'];
            $data['BIO']=$row['U'];
            $data['FIS']=$row['V'];
            $data['KIM']=$row['W'];
            $data['LTM1']=$row['X'];
            $data['RATA2']=$row['Y'];
            $data['kelulusan']=$row['Z'];
            $hasily=$this->Crud_model->get_row_selected('nilai_ujian_sekolah_ipa',$key);
                if($hasily)
                {
                    $this->Crud_model->update_data('nilai_ujian_sekolah_ipa',$data,$key);
                     $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4> Import/Update Data SKL Sukses...!");
                }else
                {
                    $this->Crud_model->save_data('nilai_ujian_sekolah_ipa',$data);
                       $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4> Import Data SKL Sukses...!");
                }
            }
        
   
      // Tambah 1 setiap kali looping
    }
    $numrow++;
}
		 
		$this->session->set_flashdata($pesan);
		
			redirect('kasek/upload_skl');
   
  }
	
	function skl_ips($nis,$ta)
	{
	    $this->Crud_model->skl_ips($nis,$ta);
	}
	function skl_ipa($nis,$ta)
	{
	    $this->Crud_model->skl_ipa($nis,$ta);
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
		$this->template->load($this->view, 'kasek/form/edit_siswa', $data);
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
		$data['kelas']=$this->input->post('kelas');
		
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
		redirect('kasek/siswa');
	}
	
   
	function frapor()
	{
	    $this->cek();
	    $data['menu']=' '.$this->session->userdata('nm_sekolah');

	    $keysiswa['status']='Aktif';
	    
	    $data['list_siswa']=$this->Crud_model->get_list_selected('siswa',$keysiswa);
	    $data['kd_ta']=$this->session->userdata('kd_ta');
	    $data['list_ta']=$this->Crud_model->get_all('thnajaran');
	    $this->template->load($this->view, 'kasek/form/rapor_f', $data);
	}
	
	function rapor()
	{
	    $nis=$this->input->post('nis');
	    $kd_ta=$this->input->post('kd_ta');
	    $jrapor=$this->input->post('jrapor');
	    if($jrapor=='cover')
	    {
	        $this->Crud_model->rapor($nis,$kd_ta);
	    }elseif($jrapor=='nilai')
	    {
	       $this->Crud_model->rapor_nilai($nis,$kd_ta);
	    }
	}
	public function rapor_nilai($nis,$kd_ta)
	{
	    $this->Crud_model->rapor_nilai($nis,$kd_ta);
	}

	
	function flaporan_bulanan_siswa()
	{
	    $this->cek();
	    $data['menu']=' '.$this->session->userdata('nm_sekolah');


	    $keysiswa['status']='Aktif';
	    
	    $data['list_siswa']=$this->Crud_model->get_list_selected('siswa',$keysiswa);
	    $data['list_ta']=$this->Crud_model->get_all('thnajaran');
	    $data['list_bulan']=$this->Crud_model->get_all('bulan');
	    $data['kd_ta']=$this->session->userdata('kd_ta');
	    $this->template->load($this->view, 'guru/form/lap_bulanan_siswa_f', $data);
	}
	function lap_bulanan_siswa()
	{
	    $kd_ta=$this->input->post('kd_ta');
	    $bulan=$this->input->post('bulan');
	    $nis=$this->input->post('nis');
	    
	    $this->Crud_model->lap_bulanan_siswa($kd_ta,$bulan,$nis);
	}
	function usulan_akses_nilai()
	{
	    $this->cek();
	    $kd_ta=$this->session->userdata('kd_ta');
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
	    $sql="SELECT akses_nilai.kd_jadwal,akses_nilai.id_usul,jadwal.kelas,guru.nm_guru,jadwal.id_guru,jadwal.kd_pelajaran,pelajaran.nm_pelajaran,akses_nilai.tgl_usul,akses_nilai.penjelasan,akses_nilai.status FROM `akses_nilai`,jadwal,guru,pelajaran where akses_nilai.kd_jadwal=jadwal.kd_jadwal and jadwal.id_guru=guru.id_guru and jadwal.kd_pelajaran=pelajaran.kd_pelajaran and jadwal.kd_ta='".$kd_ta."' order by akses_nilai.status asc";
	    $data['list']=$this->db->query($sql)->result();
	    $this->template->load($this->view, 'kasek/view/list_usulan_akses_nilai', $data);
	}
	function setujui_akses_nilai($kd_jadwal,$id)
	{
	    $key['kd_jadwal']=$kd_jadwal;
	    $key2['id_usul']=$id;
	    $jadwal['status']='Aktif';
	    $data['disetujui_oleh']=$this->session->userdata('userid');
	    $data['tgl_disetujui']=date("Y-m-d");
	    $data['status']='Disetujui';
	    $this->Crud_model->update_data('jadwal',$jadwal,$key);
	    $this->Crud_model->update_data('akses_nilai',$data,$key2);
	    	$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Pelajaran tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('kasek/usulan_akses_nilai');
	}
	function tolak_akses_nilai($kd_jadwal,$id)
	{
	    $key['kd_jadwal']=$kd_jadwal;
	    $key2['id_usul']=$id;
	    $jadwal['status']='Tutup';
	    $data['disetujui_oleh']=$this->session->userdata('userid');
	    $data['tgl_disetujui']=date("Y-m-d");
	    $data['status']='Ditolak';
	    $this->Crud_model->update_data('jadwal',$jadwal,$key);
	    $this->Crud_model->update_data('akses_nilai',$data,$key2);
	    	$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Pelajaran tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('kasek/usulan_akses_nilai');
	}
	function registrasi()
	{
	    $this->cek();
	    	$kd_ta=$this->session->userdata('kd_ta');
	$data['menu']=$this->session->userdata('nm_sekolah');
	
		$data['kd_ta']=$this->session->userdata('kd_ta');
	   
	    $sql="SELECT
  `registrasi`.`kd_ta`,
  `registrasi`.`tgl_reg`,
  `registrasi`.`nis`,
  `registrasi`.`jns_reg`,
  `siswa`.`nm_siswa`,
  `siswa`.`kelas`,
  `siswa`.`jk`,
  `siswa`.`tempat`,
  `siswa`.`tgl_lahir`,
  `siswa`.`no_hp`,
  `siswa`.`nisn`,
  `siswa`.`image`
FROM
  `registrasi`
  INNER JOIN `siswa` ON `siswa`.`nis` = `registrasi`.`nis`where registrasi.kd_ta='".$kd_ta."'";
  $data['list_registrasi']=$this->db->query($sql)->result();
	//	$data['list_registrasi']=$this->Crud_model->get_list_selected('registrasi',$keyreg);
	    $this->template->load($this->view, 'kasek/view/list_registrasi', $data);
	}
	function view_nilai($jadwal)
	{
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
	
		$key2['kd_jadwal']=$jadwal;
		
	
		$data['mnilai']=$this->Crud_model->get_all('mnilai');
		
		
		
		$rowjadwal=$this->Crud_model->get_row_selected('jadwal',$key2);
		$keypelajaran['kd_pelajaran']=$rowjadwal->kd_pelajaran;
		$data['pelajaran']=$this->Crud_model->get_row_selected('pelajaran',$keypelajaran);
		$data['list_nilai']=$this->query_nilai($jadwal);
	    $data['jadwal']=$this->Crud_model->get_row_selected('jadwal',$key2);
		$data['kd_jadwal']=$jadwal;
		$this->template->load($this->view, 'kasek/view/view_nilai', $data);
	}
	
	function query_nilai($kd_jadwal)
	{
		$sql="select siswa.status,nilai.nis,siswa.nm_siswa,siswa.kelas,nilai.nilai_spritual,nilai_sosial,nilai_pengetahuan,desc_nilai_pengetahuan,nilai_keterampilan,desc_nilai_keterampilan from nilai,siswa where nilai.nis=siswa.nis and nilai.kd_jadwal='".$kd_jadwal."' order by siswa.nm_siswa asc";
		$hasil=$this->db->query($sql)->result();
		return $hasil;
	}
	function nilai_rendah_siswa_guru()
	{
	    $data['menu']=$this->session->userdata('nm_sekolah');
	    $data['list_guru']=$this->Crud_model->get_all('guru');
	    $data['list_ta']=$this->Crud_model->get_all('thnajaran');
	    $data['kd_ta']=$this->session->userdata('kd_ta');
	    	$this->template->load($this->view, 'kasek/form/f_rekap_nilai_rendah_siswa_guru', $data);
	}
	function rekap_nilai_rendah_siswa_guru()
	{
	    $ta=$this->input->post('kd_ta');
	    
	    $id_guru=$this->input->post('id_guru');
	    $sql="SELECT DISTINCT  guru.gelar_depan,guru.gelar_belakang,nilai.nilai_spritual,nilai_sosial,nilai_pengetahuan,nilai_keterampilan,desc_nilai_pengetahuan,desc_nilai_keterampilan,pelajaran.nm_pelajaran,pelajaran.kd_pelajaran,jadwal.id_guru,guru.nm_guru,guru.tgl_lahir,nilai.nis,siswa.nm_siswa,siswa.kelas as kelas_siswa,siswa.no_hp,jadwal.kelas as kelas_jadwal,jadwal.kd_ta FROM `nilai`,siswa,jadwal,pelajaran,guru,mnilai where (nilai.nilai_spritual<2 or nilai_sosial<2 or nilai_pengetahuan<70 or nilai_keterampilan<70) and nilai.nis=siswa.nis and nilai.kd_jadwal=jadwal.kd_jadwal and jadwal.kd_pelajaran=pelajaran.kd_pelajaran and jadwal.id_guru=guru.id_guru 
	    and jadwal.id_guru='".$id_guru."' and jadwal.kd_ta='".$ta."' ORDER BY pelajaran.urutan,nis ASC";
	    $hasil = $this->db->query($sql)->result();
	    $data['list']=$hasil;
	    $data['menu']=$this->session->userdata('nm_sekolah');
	    $this->template->load($this->view, 'kasek/view/list_siswa_nilai_rendah', $data);
	}
	//modul registrasi_mahasiswa
	
	
	
	
	
	//modul matapelajaran
	//modul mata pelajaran
	public function matapelajaran()
	{
		$this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		$data['list']=$this->Crud_model->get_all('pelajaran');
		$this->template->load($this->view, 'kasek/view/list_matapelajaran', $data);
	}
	function input_mata_pelajaran()
	{
		$this->cek();
		$data['menu']=' Input Mata Pelajaran';
		$data['list_kategori']=$this->Crud_model->get_all('kategori');
		
		
		$this->template->load($this->view, 'wakasekkurikulum/matapelajaran/input_matapelajaran', $data);
	
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
		
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Pelajaran tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/matapelajaran');
		
	}
	public function edit_mata_pelajaran($kd)
	{
		$this->cek();
		$data['menu']=' Edit Mata Pelajaran';
		$key['kd_pelajaran']=$kd;
		$data['pelajaran']=$this->Crud_model->get_row_selected('pelajaran',$key);
		$data['list_kategori']=$this->Crud_model->get_all('kategori');
		$this->template->load($this->view, 'wakasekkurikulum/matapelajaran/edit_matapelajaran', $data);
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
		
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Pelajaran sudah dirubah.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/matapelajaran');
	}

	//modul kkm
	function kkm()
	{
		$this->cek();
		$data['menu']=' KKM';
		$data['list_kkm']=$this->Crud_model->get_all('kkm');
		$this->template->load($this->view, 'wakasekkurikulum/kkm/list_kkm', $data);
	}
	function input_kkm()
	{
		$this->cek();
		$data['menu']=' Form KKM';
		$data['list_thn_ajaran']=$this->Crud_model->get_all('thnajaran');
		$data['list_status']=$this->Crud_model->get_all('status_data');
		$this->template->load($this->view, 'wakasekkurikulum/kkm/input_kkm', $data);
	}
	function save_kkm()
	{
		$data['kd_ta']=$this->input->post('kd_ta');
		$data['kkm']=$this->input->post('kkm');
		$data['status']=$this->input->post('status');
		$keykkm['kd_ta']=$this->input->post('kd_ta');
		$cek=$this->Crud_model->get_row_selected('kkm',$keykkm);
		if($cek)
		{
			$this->Crud_model->update_data('kkm',$data,$keykkm);
		}
		else
			{
				$this->Crud_model->save_data('kkm',$data);
			}
		
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data KKM tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/kkm');
	}
	function edit_kkm($kd_ta)
	{
		$keykkm['kd_ta']=$kd_ta;
		$data['kkm']=$this->Crud_model->get_row_selected('kkm',$keykkm);
		$this->cek();
		$data['menu']=' Form KKM';
		$data['list_thn_ajaran']=$this->Crud_model->get_all('thnajaran');
		$data['list_status']=$this->Crud_model->get_all('status_data');
		$data['kd_ta']=$kd_ta;
		$this->template->load($this->view, 'wakasekkurikulum/kkm/edit_kkm', $data);
	}
	function update_kkm()
	{
		$this->cek();
		$data['kkm']=$this->input->post('kkm');
		$data['status']=$this->input->post('status');
		$keykkm['kd_ta']=$this->input->post('kd_ta');
		
			$this->Crud_model->update_data('kkm',$data,$keykkm);
		
		
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data KKM tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/kkm');
	}
	function delete_kkm($kd_ta)
	{
		$this->cek();
		$keykkm['kd_ta']=$kd_ta;
		$this->Crud_model->delete_data('kkm',$keykkm);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data KKM sudah dihapus.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/kkm');
	}

	//modul kelas
	function kelas()
	{
		$sql="SELECT
		  `kelas`.`id_kelas`,
		  `kelas`.`tingkat`,
		  `kelas`.`group`,
		  `kelas`.`program`,
		  `kelas`.`id_guru`,
		  `guru`.`nm_guru`,
		  `guru`.`status`
			FROM
  			`kelas`
  		LEFT JOIN `guru` ON `kelas`.`id_guru` = `guru`.`id_guru`";
  		$data['list']=$this->db->query($sql)->result();
		$this->cek();
		$data['menu']=' Kelas';
		//$data['list']=$this->Crud_model->get_all('kelas');
		$this->template->load($this->view, 'wakasekkurikulum/kelas/list_kelas', $data);
	}
	function input_kelas()
	{
		$this->cek();
		$data['menu']=' Input Kelas';
		$data['list_tingkat']=$this->Crud_model->get_all('tingkat');
		$data['list_program']=$this->Crud_model->get_all('program');
		$data['list_group']=$this->Crud_model->get_all('group');
		$this->template->load($this->view, 'wakasekkurikulum/kelas/input_kelas', $data);
	}
	function edit_kelas($id)
	{
		$this->cek();
		$key['id_kelas']=$id;
		$data['kelas']=$this->Crud_model->get_row_selected('kelas',$key);
		$data['menu']=' Edit Kelas';
		$data['list_tingkat']=$this->Crud_model->get_all('tingkat');
		$data['list_program']=$this->Crud_model->get_all('program');
		$data['list_group']=$this->Crud_model->get_all('group');
		$this->template->load($this->view, 'wakasekkurikulum/kelas/edit_kelas', $data);
	}
	function update_kelas()
	{
		$key['id_kelas']=$this->input->post('id_kelas');
		$data['program']=$this->input->post('program');
		$data['tingkat']=$this->input->post('tingkat');
		$data['group']=$this->input->post('group');
		$data['id_kelas']=$this->input->post('tingkat').$this->input->post('program').$this->input->post('group');
		$this->Crud_model->update_data('kelas',$data,$key);
		
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Kelas Sudah Diupdate.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/kelas');
	}
	function save_kelas()
	{
		$data['program']=$this->input->post('program');
		$data['tingkat']=$this->input->post('tingkat');
		$data['group']=$this->input->post('group');
		$data['id_kelas']=$this->input->post('tingkat').'-'.$this->input->post('program').'-'.$this->input->post('group');
		$this->Crud_model->save_data('kelas',$data);
		
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Kelas tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/kelas');
	}

	function delete_kelas($id)
	{
		$key['id_kelas']=$id;
		$this->Crud_model->delete_data('kelas',$key);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Kelas sudah dihapus.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/kelas');
	}

	//modul registrasi siswa

	function wali_kelas($id_kelas)
	{
		$this->cek();
		$data['menu']=' Form Wali Kelas';
		$data['id_kelas']=$id_kelas;
		$data['list_guru']=$this->Crud_model->get_all('guru');
		$this->template->load($this->view, 'wakasekkurikulum/wali_kelas/input_wali_kelas', $data);
	}
	function update_wali_kelas()
	{
		$this->cek();
		$key['id_kelas']=$this->input->post('id_kelas');
		$data['id_guru']=$this->input->post('id_guru');
		$this->Crud_model->update_data('kelas',$data,$key);
		
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Wali Kelas sudah disimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/kelas');
	}
	//modul program

	function program()
	{
		$this->cek();
		$data['menu']=' Program';
		$data['list']=$this->Crud_model->get_all('program');
		$this->template->load($this->view, 'wakasekkurikulum/program/list_program', $data);
	}
	function input_program()
	{
		$this->cek();
		$data['menu']=' Input Program';
		$this->template->load($this->view, 'wakasekkurikulum/program/input_program', $data);
	}
	function save_program()
	{
		$data['program']=$this->input->post('program');
		
		$this->Crud_model->save_data('progam',$data);
		
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Program tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/program');
	}
	function edit_program($key)
	{
		$data['program']=$key;
		$this->cek();
		$data['menu']=' Edit Program';
		$this->template->load($this->view, 'wakasekkurikulum/program/edit_program', $data);
	}
	function update_program()
	{
		$data['program']=$this->input->post('program');
		$key['program']=$this->input->post('programx');
		$this->Crud_model->update_data('program',$data,$key);
		
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Program sudah dirubah.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/program');

	}
	function delete_program($id)
	{
		$key['program']=$id;
		$this->Crud_model->delete_data('program',$key);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Program sudah dihapus.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/program');
	}

	

	function guru()
	{
		$this->cek();
	$data['menu']=$this->session->userdata('nm_sekolah');
		$data['list']=$this->Crud_model->get_all('guru');
		$this->template->load($this->view, 'kasek/view/list_guru', $data);
	}
	function input_guru()
	{
		$this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		$data['title']=' SIAKAD';
		$data['list_agama']=$this->Crud_model->get_all('agama');
		$data['list_jk']=$this->Crud_model->get_all('kelamin');
		$data['list_status']=$this->Crud_model->get_all('status');
		$this->template->load($this->view, 'wakasekkurikulum/guru/input_guru', $data);
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
		$data['pangkat']=$this->input->post('pangkat');
		$data['golongan']=$this->input->post('golongan');
		$data['tgl_lahir']=$this->input->post('tgl_lahir');
		$data['status']=$this->input->post('status');
		$data['nik']=$this->input->post('nik');
		$data['bidang']=$this->input->post('bidang');

		$this->Crud_model->save_data('guru',$data);
		
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Guru tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/guru');
			
	}
	function edit_guru($id)
	{
		$key['id_guru']=$id;
		$data['guru']=$this->Crud_model->get_row_selected('guru',$key);
		$this->cek();
	    $data['menu']=$this->session->userdata('nm_sekolah');
		$data['title']=' SIAKAD';
		$data['list_agama']=$this->Crud_model->get_all('agama');
		$data['list_jk']=$this->Crud_model->get_all('kelamin');
		$data['list_status']=$this->Crud_model->get_all('status');
		$this->template->load($this->view, 'wakasekkurikulum/guru/edit_guru', $data);
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
		$data['pangkat']=$this->input->post('pangkat');
		$data['golongan']=$this->input->post('golongan');
		$data['tgl_lahir']=$this->input->post('tgl_lahir');
		$data['status']=$this->input->post('status');
		$data['nik']=$this->input->post('nik');
		$data['bidang']=$this->input->post('bidang');
		
		$this->Crud_model->update_data('guru',$data,$keys);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Guru tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/guru');
	}
	function delete_guru($id)
	{
		$keys['id_guru']=$id;
		$guru=$this->Crud_model->get_row_selected('guru',$keys);
		unlink('foto_guru/'.$guru->image);
		$this->Crud_model->delete_data('guru',$keys);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Guru terhapus.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/guru');
	}
	function password_guru($id)
	{
		$this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		$data['title']=' SIAKAD';
		$keyguru['id_guru']=$id;
		$data['guru']=$this->Crud_model->get_row_selected('guru',$keyguru);
		$this->template->load($this->view, 'wakasekkurikulum/guru/password', $data);
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
	    $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Reset Passsword Berhasil.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/siswa');
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
		redirect ('wakasekkurikulum/guru');
	}
	
	//modul tahun ajaran
	function thn_ajaran()
	{
		$this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		$data['title']=' SIAKAD';
		$data['list']=$this->Crud_model->get_all('thnajaran');
		$this->template->load($this->view, 'wakasekkurikulum/tahun_ajaran/list_thn_ajaran', $data);
	}
	function input_thn_ajaran()
	{
		$this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		$data['title']=' SIAKAD';
		$data['list_semester']=$this->Crud_model->get_all('semester');
		$data['list_status']=$this->Crud_model->get_all('status_data');
		$this->template->load($this->view, 'wakasekkurikulum/tahun_ajaran/input_thn_ajaran', $data);
	}
	function save_thn_ajaran()
	{
		

		$semester=$this->input->post('semester');
		$data['tahun']=$this->input->post('tahun');
		$data['semester']=$semester;
		$data['status']=$this->input->post('status');
		if($semester=='Ganjil')
		{
			$angka=1;
		}else
		{
			$angka=2;
		}
		$key['kd_ta']=$this->input->post('tahun').$angka;
		$data['kd_ta']=$this->input->post('tahun').$angka;
		$cek=$this->Crud_model->get_row_selected('thnajaran',$key);
		if($cek)
		{
			$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Tahun Ajaran Sudah Ada.");
			$this->session->set_flashdata($pesan);
		}else
		{
			$this->Crud_model->save_data('thnajaran',$data);
			$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Tahun Ajaran Tersimpan.");
		$this->session->set_flashdata($pesan);

		}

		redirect ('wakasekkurikulum/thn_ajaran');
		

			
	}
	function edit_thn_ajaran($id)
	{
		$key['kd_ta']=$id;
		$this->cek();
	$data['menu']=$this->session->userdata('nm_sekolah');
		$data['title']=' SIAKAD';
		$data['list_semester']=$this->Crud_model->get_all('semester');
		$data['list_status']=$this->Crud_model->get_all('status_data');
		$data['ta']=$this->Crud_model->get_row_selected('thnajaran',$key);
		$this->template->load($this->view, 'wakasekkurikulum/tahun_ajaran/edit_thn_ajaran', $data);

	}
	function update_thn_ajaran()
	{
		$key['kd_ta']=$this->input->post('kd_ta');
		$semester=$this->input->post('semester');
		$data['tahun']=$this->input->post('tahun');
		$data['semester']=$semester;
		$data['status']=$this->input->post('status');
		
		
		$data['kd_ta']=$this->input->post('tahun').$semester;
		$this->Crud_model->update_data('thnajaran',$data,$key);
			$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Tahun Ajaran Tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/thn_ajaran');
	}
	

	//modul ruang kelas

	function ruang_kelas()
	{
		$this->cek();
	$data['menu']=$this->session->userdata('nm_sekolah');
		$data['list']=$this->Crud_model->get_all('ruang_kelas');
		$this->template->load($this->view, 'wakasekkurikulum/ruang_kelas/list_ruang_kelas', $data);
	}
	function input_ruang_kelas()
	{
		$this->cek();
	$data['menu']=$this->session->userdata('nm_sekolah');
		$data['list_status']=$this->Crud_model->get_all('status_data');
		$this->template->load($this->view, 'wakasekkurikulum/ruang_kelas/input_ruang_kelas', $data);
	}
	function save_ruang_kelas()
	{
		$data['nm_ruang']=$this->input->post('nm_ruang');
		$data['kapasitas']=$this->input->post('kapasitas');
		$data['fasilitas']=$this->input->post('fasilitas');
		$data['gedung']=$this->input->post('gedung');
		$data['status']=$this->input->post('status');
		$this->Crud_model->save_data('ruang_kelas',$data);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Ruang Kelas Tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/ruang_kelas');	
	}
	function edit_ruang_kelas($id)
	{
		$key['id_ruang']=$id;
		$data['menu']=$this->session->userdata('nm_sekolah');
		$data['ruang']=$this->Crud_model->get_row_selected('ruang_kelas',$key);
		$data['list_status']=$this->Crud_model->get_all('status_data');
		$this->template->load($this->view, 'wakasekkurikulum/ruang_kelas/edit_ruang_kelas', $data);
	}
	function update_ruang_kelas()
	{
		$key['id_ruang']=$this->input->post('id_ruang');
		$data['nm_ruang']=$this->input->post('nm_ruang');
		$data['kapasitas']=$this->input->post('kapasitas');
		$data['fasilitas']=$this->input->post('fasilitas');
		$data['gedung']=$this->input->post('gedung');
		$data['status']=$this->input->post('status');
		$this->Crud_model->update_data('ruang_kelas',$data,$key);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Ruang Kelas Tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/ruang_kelas');	
	}
	
	function delete_ruang_kelas($id)
	{
		$key['id_ruang']=$id;
		$this->Crud_model->delete_data('ruang_kelas',$key);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Ruang Kelas terhapus.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/ruang_kelas');	
	}
    //modul sekolah
    //modul menu
    
    function menu()
    {
        $key['status']=1;
		$sekolah=$this->Crud_model->get_row_selected('sekolah',$key);
		//$data['sekolah']=$sekolah;
		$menu['menu']=' '.$sekolah->nm_sekolah;
		return $menu;
    }
    function sekolah()
    {
        $this->cek();
		$key['status']=1;
		$sekolah=$this->Crud_model->get_row_selected('sekolah',$key);
		$data['menu']=$this->session->userdata('nm_sekolah');
		$data['sekolah']=$sekolah;
	
		$this->template->load($this->view, 'kasek/view/view_sekolah', $data);
    }
    function update_sekolah()
    {
        	$nama = "logo";
        	$key['npsn']=$this->input->post('npsn',true);
		$config['upload_path']   = './assets/img/';
        $config['allowed_types'] = 'jpg|jpeg|png'; //mencegah upload backdor
        $config['file_name']     = $nama; 
        $this->upload->initialize($config);
		if ($this->upload->do_upload('userfile')){
			$image = $this->upload->data();
			
			$sekolah=$this->Crud_model->get_row_selected('sekolah',$key);
				if(!empty($sekolah->image)){
			    unlink('assets/img/'.$sekolah->image);
			}
			$data['image'] = $image['file_name'];
        }
        
        $data['nm_sekolah']=$this->input->post('nm_sekolah',true);
        $data['nm_sekolah_kecil']=$this->input->post('nm_sekolah_kecil',true);
        $data['akreditasi']=$this->input->post('akreditasi',true);
        $data['provinsi']=$this->input->post('provinsi',true);
        $data['kabupaten']=$this->input->post('kabupaten',true);
        $data['kecamatan']=$this->input->post('kecamatan',true);
        $data['kelurahan']=$this->input->post('kelurahan',true);
        $data['alamat']=$this->input->post('alamat',true);
        $data['kode_pos']=$this->input->post('kode_pos',true);
        $data['email']=$this->input->post('email',true);
        $data['website']=$this->input->post('website',true);
        $data['kasek']=$this->input->post('kasek',true);
        $data['nip_kasek']=$this->input->post('nip_kasek',true);

        $this->Crud_model->update_data('sekolah',$data,$key);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Profil Sekolah Tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('kasek/sekolah');	
    }
	//modul siswa
	function siswa()
	{
		$this->cek();
	    $data['menu']=$this->session->userdata('nm_sekolah');
		$data['list']=$this->Crud_model->get_all('siswa');
		$this->template->load($this->view, 'kasek/view/list_siswa', $data);
	}
	function input_siswa()
	{
		$this->cek();
	$data['menu']=$this->session->userdata('nm_sekolah');
		$data['list_status_siswa']=$this->Crud_model->get_all('status_siswa');
		$data['list_kelamin']=$this->Crud_model->get_all('kelamin');
		$data['list_agama']=$this->Crud_model->get_all('agama');
		$data['list_negara']=$this->Crud_model->get_all('negara');
		$data['list_kelas']=$this->Crud_model->get_all('kelas');
		//$data['list_program']=$this->Crud_model->get_all('program');
		$this->template->load($this->view, 'wakasekkurikulum/siswa/input_siswa', $data);
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
		redirect ('wakasekkurikulum/siswa');	
	}
	
	
	function delete_siswa($id)
	{
		$key['nis']=$id;
		$this->Crud_model->delete_data('siswa',$key);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Siswa Terhapus.");
		$this->session->set_flashdata($pesan);
		redirect('wakasekkurikulum/siswa');
	}
	
	function akun_siswa()
	{
	    $this->cek();
	$data['menu']=$this->session->userdata('nm_sekolah');
		$data['title']=' SIAKAD';
		$key['level']='siswa';
	    $data['list_akun']=$this->Crud_model->get_list_selected('user',$key);
		$this->template->load($this->view, 'wakasekkurikulum/siswa/list_akun_siswa', $data);
	
	}
	function password_siswa()
	{
		$this->cek();
	$data['menu']=$this->session->userdata('nm_sekolah');
		$data['title']=' SIAKAD';
	    $data['list_siswa']=$this->Crud_model->get_all('siswa');
		$this->template->load($this->view, 'wakasekkurikulum/siswa/password_siswa', $data);
	}
	function set_password_siswa($nis)
	{
		$this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		$data['title']=' SIAKAD';
		$keysiswa['nis']=$nis;
		$data['siswa']=$this->Crud_model->get_row_selected('siswa',$keysiswa);
		$this->template->load($this->view, 'wakasekkurikulum/siswa/set_password_siswa', $data);
	}
	function save_password_siswa()
	{
		$data['userid']=$this->input->post('userid');
		$keysiswa['nis']=$this->input->post('userid');
		$siswa=$this->Crud_model->get_row_selected('siswa',$keysiswa);
		$data['username']=$siswa->nm_siswa;
		$p=$this->input->post('password');
		$data['password']=($p);
		$data['level']='siswa';
		$data['status']='1';

		$keyuser['userid']=$this->input->post('userid');
		$cek=$this->Crud_model->get_row_selected('user',$keyuser);
		if($cek)
		{
			$this->Crud_model->update_data('user',$data,$keyuser);
		}else
		{
			$this->Crud_model->save_data('user',$data);
		}
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Akun Siswa tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/akun_siswa');
	}

	//modul kalender akademik
	function kalender_akademik()
	{
		$this->cek();

	$data['menu']=$this->session->userdata('nm_sekolah');
		$keyta['kd_ta']=$this->session->userdata('kd_ta');
		$data['list']=$this->Crud_model->get_list_selected('kalender_akademik',$keyta);
		$this->template->load($this->view, 'kasek/view/list_kalender_akademik', $data);
	}
	function input_kalender_akademik()
	{
		$this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		$data['list_ta']=$this->Crud_model->get_all('thnajaran');
		$data['list_kegiatan']=$this->Crud_model->get_all('kegiatan_akademik');
		$data['list_status']=$this->Crud_model->get_all('status_data');
		$this->template->load($this->view, 'wakasekkurikulum/kalender_akademik/input_kalender_akademik', $data);
	}
	function save_kalender_akademik()
	{
		$this->cek();
		$data['kd_ta']=$this->input->post('kd_ta');
		$data['kegiatan']=$this->input->post('kegiatan');
		$data['tgl_mulai']=$this->input->post('tgl_mulai');
		$data['tgl_selesai']=$this->input->post('tgl_selesai');
		$data['status']=$this->input->post('status');
		$this->Crud_model->save_data('kalender_akademik',$data);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Kalender Akademik Tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect('wakasekkurikulum/kalender_akademik');
			
	}
	function edit_kalender_akademik($id)
	{
		$this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		$key['id_kalender']=$id;
		
		
		$data['kalender']=$this->Crud_model->get_row_selected('kalender_akademik',$key);
		$data['list_ta']=$this->Crud_model->get_all('thnajaran');
		$data['list_kegiatan']=$this->Crud_model->get_all('kegiatan_akademik');
		$data['list_status']=$this->Crud_model->get_all('status_data');
		//echo json_encode($key);
		$this->template->load($this->view, 'wakasekkurikulum/kalender_akademik/edit_kalender_akademik', $data);
	}
	function update_kalender_akademik()
	{
		$this->cek();
		$key['id_kalender']=$this->input->post('id_kalender');
		$data['kd_ta']=$this->input->post('kd_ta');
		$data['kegiatan']=$this->input->post('kegiatan');
		$data['tgl_mulai']=$this->input->post('tgl_mulai');
		$data['tgl_selesai']=$this->input->post('tgl_selesai');
		$data['status']=$this->input->post('status');
		$this->Crud_model->update_data('kalender_akademik',$data,$key);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Kalender Akademik Tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect('wakasekkurikulum/kalender_akademik');
	}
	function delete_kalender_akademik($id)
	{
		$this->cek();
		$key['id_kalender']=$id;
		$this->Crud_model->delete_data('kalender_akademik',$key);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Kalender Akademik Terhapus.");
		$this->session->set_flashdata($pesan);
		redirect('wakasekkurikulum/kalender_akademik');		
	}
	//modul jadwal
	function jadwal()
	{
	    	$this->cek();

	$data['menu']=$this->session->userdata('nm_sekolah');
	
		$kd_ta=$this->session->userdata('kd_ta');
		//$data['menu']=' Jadwal Pelajaran';
		$data['list']=$this->Crud_model->get_detail_jadwal($kd_ta);
		$this->template->load($this->view, 'kasek/view/list_jadwal', $data);
	}
	function input_jadwal()
	{
		$this->cek();
	$data['menu']=$this->session->userdata('nm_sekolah');
		$data['list_guru']=$this->Crud_model->get_all('guru');
		$data['list_hari']=$this->Crud_model->get_all('hari');
		$data['list_kelas']=$this->Crud_model->get_all('kelas');
		$data['list_pelajaran']=$this->Crud_model->get_all('pelajaran');
		$this->template->load($this->view, 'wakasekkurikulum/jadwal/input_jadwal', $data);
	}
	function save_jadwal()
	{
		$data['hari']=$this->input->post('hari');
		$data['jam_masuk']=$this->input->post('jam_masuk');
		$data['jam_keluar']=$this->input->post('jam_keluar');
		$data['id_guru']=$this->input->post('id_guru');
		$data['kd_pelajaran']=$this->input->post('kd_pelajaran');
		$data['kelas']=$this->input->post('kelas');
		$data['kd_ta']=$this->session->userdata('kd_ta');
		$data['status']='Aktif';
		$this->Crud_model->save_data('jadwal',$data);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Jadwal Tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect('wakasekkurikulum/jadwal');
	}
	function edit_jadwal($id)
	{
		$this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		 $key['kd_jadwal']=$id;
		$data['jadwal']=$this->Crud_model->get_row_selected('jadwal',$key);
		$data['list_guru']=$this->Crud_model->get_all('guru');
		$data['list_hari']=$this->Crud_model->get_all('hari');
		$data['list_kelas']=$this->Crud_model->get_all('kelas');
		$data['list_pelajaran']=$this->Crud_model->get_all('pelajaran');
		$this->template->load($this->view, 'wakasekkurikulum/jadwal/edit_jadwal', $data);
	}
	function update_jadwal()
	{
		 $key['kd_jadwal']=$this->input->post('kd_jadwal');
		$data['hari']=$this->input->post('hari');
		$data['jam_masuk']=$this->input->post('jam_masuk');
		$data['jam_keluar']=$this->input->post('jam_keluar');
		$data['id_guru']=$this->input->post('id_guru');
		$data['kd_pelajaran']=$this->input->post('kd_pelajaran');
		$data['kelas']=$this->input->post('kelas');
		$data['kd_ta']=$this->session->userdata('kd_ta');
		$this->Crud_model->update_data('jadwal',$data,$key);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Jadwal Tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect('wakasekkurikulum/jadwal');
	}
	

	

	
	
	
	
	
   


    

}

?>