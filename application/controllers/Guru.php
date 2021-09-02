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
class Guru extends CI_Controller {

	public $view='guru/template';
    function __construct()
    {
        parent::__construct();
        $this->load->model('Crud_model');
        $this->load->model('Guru_model');
		$this->load->helper('url', 'form','security'); 
        $this->load->library('form_validation');
        //$this->load->library('table');
		$level = $this->session->userdata('level');
		
		//session_start();
    }
    
    
    function test2($kd_ta,$bulan,$nis,$kelompok)
    {
        $this->Crud_model->get_rekap_absensi_siswa_pelajaran($kd_ta,$bulan,$nis,$kelompok);
    }
    
	function cek()
	{
		$level=$this->session->userdata('level');
		if($level!='guru')
		{
			$this->session->sess_destroy();
			//unset($_SESSION[$sess_data]);
			redirect(base_url());
		}
		$data['title']='SIAKAD';
		
		$key['aktif']='Ya';
		$data['profil']=$this->Crud_model->get_row_selected('profil',$key);
	}
    public function index()
    {
		$this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		$key['status']=1;
		$data['sekolah']=$this->Crud_model->get_row_selected('sekolah',$key);
	//$this->template->load($this->view, 'siswa/dashboards', $data);
		$this->template->load($this->view, 'guru/dashboards', $data);
	}
	public function set_barcode($code)
    {
        
        $this->load->library('zend');
        //meload di folder Zend
        $this->zend->load('Zend/Barcode');
        //melakukan generate barcode
        Zend_Barcode::render('code39', 'image', array('text'=>$code, 'barHeight' => 25, 'factor'=>1.5), array());
    
	}
	//modul ekstra kurikuler
	function nilai_ekstraf()
	{
	     $this->cek();
	    $data['menu']=' '.$this->session->userdata('nm_sekolah');
	    $data['kd_ta']=$this->session->userdata('kd_ta');
	    $data['list_ta']=$this->Crud_model->get_all('thnajaran');
	    $this->template->load($this->view, 'guru/form/nilai_ekstraf', $data);
	}
	function nilai_ekstra()
	{
	    $this->cek();
	    $id_guru=$this->session->userdata('userid');
	    $kd_ta=$this->input->post('kd_ta');
	    
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$keykelas['id_guru']=$id_guru;
	    $hasil=$this->Crud_model->get_row_selected('kelas',$keykelas);
	    $kelas=$hasil->id_kelas;
	    $sql="SELECT siswa.no_hp,mnilai.angka, nilai_ekstrakurikuler.kd_ta, nilai_ekstrakurikuler.kd_ekstra,ekstra_kurikuler.nm_ekstra,nilai_ekstrakurikuler.nis,siswa.nm_siswa,siswa.kelas,siswa.image,nilai_ekstrakurikuler.deskripsi,mnilai.nilai
	    from nilai_ekstrakurikuler,ekstra_kurikuler,siswa,mnilai
	    where nilai_ekstrakurikuler.kd_ekstra=ekstra_kurikuler.kd_ekstra and nilai_ekstrakurikuler.nis=siswa.nis and nilai_ekstrakurikuler.nilai=mnilai.angka and nilai_ekstrakurikuler.kd_ta='".$kd_ta."' and siswa.kelas='".$kelas."'
	    ORDER BY siswa.kelas, `siswa`.`nm_siswa` ASC";
	    $data['kd_ta']=$kd_ta;
	     $data['kelas']=$kelas;
	     $data['list']=$this->db->query($sql)->result();
	    	$this->template->load($this->view, 'guru/view/view_nilai_ekstra', $data);
	}
	function form_input_catatan_rapot()
	{
	    $this->cek();
	    $data['menu']=' '.$this->session->userdata('nm_sekolah');
	    $data['kd_ta']=$this->session->userdata('kd_ta');
	    $data['list_ta']=$this->Crud_model->get_all('thnajaran');
	    $this->template->load($this->view, 'guru/form/catatan_raporf', $data);
	}
	function input_catatan_rapor()
	{
	    $this->cek();
	    $data['menu']=' '.$this->session->userdata('nm_sekolah');
	    $kd_ta=$this->input->post('kd_ta');
		
	
		$kelas='';
		$keyu['id_guru']=$this->session->userdata('userid');
	    $hasil=$this->Crud_model->get_row_selected('kelas',$keyu);
		if($hasil)
		{
		    $kelas=$hasil->id_kelas;
		}
		
		
		$keysiswa['status']='Aktif';
		$keysiswa['kelas'] =$kelas;
		$list_siswa=$this->Crud_model->get_list_selected('siswa',$keysiswa);
		foreach ($list_siswa as $row ) {
		    $x['nis']=$row->nis;
			$x['kd_ta']=$kd_ta;
			$cek=$this->Crud_model->get_row_selected('catatan_wali_kelas',$x);
			if(empty($cek))
			{
				$this->Crud_model->save_data('catatan_wali_kelas',$x);
			}
		}

		$data['list_catatan']=$this->query_catatan($kd_ta,$kelas);
		$data['kd_ta']=$kd_ta;
	
		$this->template->load($this->view, 'guru/form/input_catatan_wali_kelas', $data);
	}
	
	function frapor()
	{
	    $this->cek();
	    $data['menu']=' '.$this->session->userdata('nm_sekolah');
	    	$id_guru=$this->session->userdata('userid');
		$keykelas['id_guru']=$id_guru;
		$kelas=$this->Crud_model->get_row_selected('kelas',$keykelas);
		if($kelas)
		{
	    $keysiswa['kelas']=$kelas->id_kelas;
	    $keysiswa['status']='Aktif';
		
	    $data['list_siswa']=$this->Crud_model->get_list_selected('siswa',$keysiswa);
	    $data['kd_ta']=$this->session->userdata('kd_ta');
	    $data['list_ta']=$this->Crud_model->get_all('thnajaran');
	    $this->template->load($this->view, 'guru/form/rapor_f', $data);
		}else
		{
		    echo 'Mohon maaf, Fitur ini untuk Guru yang memiliki perwalian...';
		}
	}
	function rapor()
	{
	    $nis=$this->input->post('nis');
	    $kd_ta=$this->input->post('kd_ta');
	    $jrapor=$this->input->post('jrapor');
	    if($jrapor=='cover')
	    {
	        $this->rapor_cover($nis,$kd_ta);
	    }elseif($jrapor=='nilai')
	    {
	        $this->rapor_nilai($nis,$kd_ta);
	    }
	}
	function rapor_nilai($nis,$ta)
	{

	        $this->Crud_model->rapor_nilai($nis,$ta);

	}
	
	function rapor_cover($nis,$ta)
	{

	        $this->Crud_model->rapor($nis,$ta);

	    
	}
	function flaporan_bulanan_siswa()
	{
	    $this->cek();
	    $data['menu']=' '.$this->session->userdata('nm_sekolah');
	    $id_guru=$this->session->userdata('userid');
		$keykelas['id_guru']=$id_guru;
		$kelas=$this->Crud_model->get_row_selected('kelas',$keykelas);
		if($kelas)
		{
	    $keysiswa['kelas']=$kelas->id_kelas;
	    $keysiswa['status']='Aktif';
	    
	    $data['list_siswa']=$this->Crud_model->get_list_selected('siswa',$keysiswa);
	    $data['list_ta']=$this->Crud_model->get_all('thnajaran');
	    $data['list_bulan']=$this->Crud_model->get_all('bulan');
	    $data['kd_ta']=$this->session->userdata('kd_ta');
	    $this->template->load($this->view, 'guru/form/lap_bulanan_siswa_f', $data);
		}else{
		    echo "Mohon maaf, fitur ini hanya untuk Guru yang memiliki kelas Perwalian...";
		}
	}
	function lap_bulanan_siswa()
	{
	    $kd_ta=$this->input->post('kd_ta');
	    $bulan=$this->input->post('bulan');
	    $nis=$this->input->post('nis');
	    
	    $this->Crud_model->lap_bulanan_siswa($kd_ta,$bulan,$nis);
	}
	function usul_akses_nilai($kd_jadwal)
	{
	    $this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
	    $sql="SELECT  `jadwal`.`kd_pelajaran`,  `pelajaran`.`nm_pelajaran`,  `jadwal`.`hari`,  `jadwal`.`kd_ta`,kd_jadwal,guru.nm_guru,
  			`jadwal`.`kelas`,  `jadwal`.`jam_masuk`,  `jadwal`.`jam_keluar`,  `jadwal`.`status`,  `pelajaran`.`kategori`,
  			`pelajaran`.`subkategori`,  `jadwal`.`id_guru` FROM `jadwal`  INNER JOIN `pelajaran` ON `pelajaran`.`kd_pelajaran` = `jadwal`.`kd_pelajaran` 
  			inner join guru on guru.id_guru=jadwal.id_guru
  			WHERE   `jadwal`.`kd_jadwal` = '".$kd_jadwal."'";
		$data['jadwal']=$this->db->query($sql)->row();
		$this->template->load($this->view, 'guru/nilai/usul_akses_nilai', $data);
	}
	function simpan_usul_akses_nilai()
	{
	    
	    $data['penjelasan']=$this->input->post('penjelasan');
	    $data['tgl_usul']=date("Y-m-d");
	    $data['kd_jadwal']=$this->input->post('kd_jadwal');
	    $data['kd_ta']=$this->session->userdata('kd_ta');
	    $data['userid']=$this->session->userdata('userid');
	    $data['status']='Belum diproses';
	    $this->Crud_model->save_data('akses_nilai',$data);
	   
	    $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Tunggu Konfirmasi Akses Dari Wakasek Akademik/Kepala Sekolah. Terimakasih");
		$this->session->set_flashdata($pesan);
		    redirect ('guru/jadwal');
	    
	}
	function cek_status_nilai($kd_jadwal)
	{
	    $key['kd_jadwal']=$kd_jadwal;
	    $hasil=$this->Crud_model->get_row_selected('jadwal',$key);
	    $status=$hasil->status;
	    if($status=='Tutup')
	    {
	        $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Penginputan Nilai telah ditutup, konfirmasi ke Admin SIAKAD Sekolah/Wakasek Kurikulum/KTU, jika ada perubahan nilai. Terimakasih");
		    $this->session->set_flashdata($pesan);
		    redirect ('guru/jadwal');
	    }
	}
	public function upload_file($filename){
    $this->load->library('upload'); // Load librari upload
    
    $config['upload_path'] = 'excel/';
    $config['allowed_types'] = 'xlsx';
    $config['max_size']  = '2048';
    $config['overwrite'] = true;
    $config['file_name'] = $filename;
  
    $this->upload->initialize($config); // Load konfigurasi uploadnya
    if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
      // Jika berhasil :
      $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
      return $return;
    }else{
      // Jika gagal :
      $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
      return $return;
    }
  }


	
	public function preview($kd_jadwal){
	$data = array();
	$this->cek();
	$this->cek_status_nilai($kd_jadwal);
	
	$this->filename=$kd_jadwal;    
     // Buat variabel $data sebagai array
    $data['kd_jadwal']=$kd_jadwal;
    $keyjadwal['kd_jadwal']=$kd_jadwal;
    $jadwal=$this->Crud_model->get_row_selected('jadwal',$keyjadwal);
    $keypel['kd_pelajaran']=$jadwal->kd_pelajaran;
    $pelajaran=$this->Crud_model->get_row_selected('pelajaran',$keypel);
    $data['pelajaran']=$pelajaran;
    $data['kelas']=$jadwal->kelas;
    $data['menu']=' SMA Negeri 1 Mawasangka Tengah';
    if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
      // lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
      $upload = $this->upload_file($this->filename);
      
    
      if($upload['result'] == "success"){ // Jika proses upload sukses
       
        include APPPATH.'libraries/PHPExcel/PHPExcel.php';
        
        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
        
        // Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
        // Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
        $data['sheet'] = $sheet; 
      }else{ // Jika proses upload gagal
        $data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
      }
    }
    
    $this->template->load($this->view, 'guru/form/import_nilai', $data);
  }
    //modul reset password siswa
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
		redirect ('guru/siswa');
	}
	
	//modul registrasi siswa
	
	function registrasi()
	{
	    $this->cek();
	    $kd_ta=$this->session->userdata('kd_ta');
	    
	    
		$data['menu']= ' '.$this->session->userdata('nm_sekolah');
		
		$id_guru=$this->session->userdata('userid');
		$keykelas['id_guru']=$id_guru;
		$kelas=$this->Crud_model->get_row_selected('kelas',$keykelas);
		if($kelas)
		{
		$id_kelas=$kelas->id_kelas;
		
		$data['kd_ta']=$kd_ta;
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
  INNER JOIN `siswa` ON `siswa`.`nis` = `registrasi`.`nis`where registrasi.kd_ta='".$kd_ta."' and siswa.kelas='".$id_kelas."'";
  $data['list_registrasi']=$this->db->query($sql)->result();
	//	$data['list_registrasi']=$this->Crud_model->get_list_selected('registrasi',$keyreg);
	    $this->template->load($this->view, 'guru/registrasi/list_registrasi', $data);
		}
	}
	function registrasi_siswa()
	{
	    $this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		$kd_ta=$this->session->userdata('kd_ta');
		$data['kd_ta']=$kd_ta;
		$id_guru=$this->session->userdata('userid');
		$keykelas['id_guru']=$id_guru;
		
		$kelas=$this->Crud_model->get_row_selected('kelas',$keykelas);
		if($kelas)
		{
		$id_kelas=$kelas->id_kelas;
	
	    $sql="select nis,nm_siswa,kelas from siswa where nis not in (select nis from registrasi where kd_ta='".$kd_ta."') and siswa.status='Aktif' and siswa.kelas='".$id_kelas."' ";
	    	$data['list_siswa']=$this->db->query($sql)->result();
		//$data['list_siswa']=$this->Crud_model->get_all('siswa');
		$data['list_status']=$this->Crud_model->get_all('status_siswa');
		$data['list_ta']=$this->Crud_model->get_all('thnajaran');
		
			$this->template->load($this->view, 'guru/registrasi/form_registrasi', $data);
		}
	}

	function save_registrasi_siswa()
	{
	    
	    $keyreg['nis']=$this->input->post('nis');
	    $keyreg['kd_ta']=$this->input->post('kd_ta');
	    $cek=$this->Crud_model->get_row_selected('registrasi',$keyreg);
	    $status=$this->input->post('status');
	    $key['nis']=$this->input->post('nis');
	    $data['kd_ta']=$this->input->post('kd_ta');
		$data['nis']=$this->input->post('nis');
	    $data['jns_reg']=$this->input->post('status');
		$data['tgl_reg']=date('Y-m-d');
		
		if(!empty($cek))
		{
		    $this->Crud_model->update_data('registrasi',$data,$keyreg);
		    
		}else
		{
		    $this->Crud_model->save_data('registrasi',$data);
		
		}
		
		if($status=='Keluar' or $status=='Tida Aktif')
		{
		    	$keynilai['kd_ta']=$this->input->post('kd_ta');	
		        $keynilai['nis']=$this->input->post('nis');
		        $this->Crud_model->delete_data('nilai',$keynilai);
		}
		//$this->hapus_siswa_nilai($)
		
	    //update semester siswa
	    
	    $siswa=$this->Crud_model->get_row_selected('siswa',$key);
	    $datax['semester']=$siswa->semester+1;
	    
	
		
		$datax['status']=$this->input->post('status');
			
		$this->Crud_model->update_data('siswa',$datax,$key);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Registrasi Siswa Sukses<br>Update Status Siswa <br>Hapus Record Nilai Siswa.");
		$this->session->set_flashdata($pesan);
		redirect ('guru/registrasi');
	}
	function edit_registrasi($nis,$kd_ta)
	{
	    $key['nis']=$nis;
	    $key['kd_ta']=$kd_ta;
	    $keyta['kd_ta']=$kd_ta;
	    
	    $id_guru=$this->session->userdata('userid');
		$keykelas['id_guru']=$id_guru;
		$kelas=$this->Crud_model->get_row_selected('kelas',$keykelas);
		$id_kelas=$kelas->id_kelas;
	
	    $keysiswa['nis']=$nis;
	    $keysiswa['kelas']=$id_kelas;
	    $data['menu']=$this->session->userdata('nm_sekolah');
	    $data['list_status']=$this->Crud_model->get_all('status_siswa');
		$data['list_siswa']=$this->Crud_model->get_list_selected('siswa',$keysiswa);
		$data['nisx']=$nis;
		$data['kd_ta']=$kd_ta;
		$data['list_ta']=$this->Crud_model->get_list_selected('thnajaran',$keyta);
		
			$this->template->load($this->view, 'guru/registrasi/edit_registrasi', $data);
	}
	//modul registrasi_mahasiswa
	function konversi_huruf_angka($huruf)
	{
	    $angka='';
	    if($huruf=='A')
	    {
	        $angka=4;
	    }elseif($huruf=='B')
	    {
	        $angka=3;
	    }
	    elseif($huruf=='C')
	    {
	        $angka=2;
	    }
	    elseif($huruf=='D')
	    {
	        $angka=1;
	    }else
	    {
	        $angka=0;
	    }
	    return $angka;
	}
	
	public function import2(){
	    $userid=$this->session->userdata('userid');
	$kd_jadwal=$this->input->post('kd_jadwal');

    // Load plugin PHPExcel nya
    include APPPATH.'libraries/PHPExcel/PHPExcel.php';
    
    $excelreader = new PHPExcel_Reader_Excel2007();
    $loadexcel = $excelreader->load('excel/'.$kd_jadwal.'.xlsx'); // Load file yang telah diupload ke folder excel
    $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
    
    // Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
   // $data = array();
    
    $numrow = 1;
    foreach($sheet as $row){
      if($numrow > 1 and $row['A']!=''){
          
          
         
          if($row['D']=='A' or $row['D']=='B' or $row['D']=='C' or $row['D']=='D' )
          {
               $data['nilai_spritual']=$this->konversi_huruf_angka($row['D']);
          }else
          {
              $data['nilai_spritual']=$row['D'];
          }
         if($row['E']=='A' or $row['E']=='B' or $row['E']=='C' or $row['E']=='D' )
          {
               $data['nilai_sosial']=$this->konversi_huruf_angka($row['E']);
          }else
          {
              $data['nilai_sosial']=$row['E'];
          }
          
          $data['nilai_pengetahuan']=$row['F'];
          $data['desc_nilai_pengetahuan']=$row['G'];
          $data['nilai_keterampilan']=$row['H'];
          $data['desc_nilai_keterampilan']=$row['I'];
          $data['user']=$userid;
          
           $key['kd_jadwal']=$kd_jadwal;
          $key['nis']=$row['A'];
          $cek=$this->Crud_model->get_row_selected('nilai',$key);
          if(!empty($cek))
          {
               $this->Crud_model->update_data('nilai',$data,$key);
          }
          //else
          //{
        //      $data['kd_jadwal']=$kd_jadwal;
         //   $data['nis']=$row['A'];
         //   $keyj['kd_jadwal']=$kd_jadwal;
         //   $jadwal=$this->Crud_model->get_row_selected('jadwal',$keyj);
         //   $data['kd_ta']=$jadwal->kd_ta;
         //   $this->Crud_model->save_data('nilai',$data);
         // }
          
      }
      
      $numrow++; // Tambah 1 setiap kali looping
    }
    // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
    //$this->Crud_model->save_multiple('nilai',$datax);
    
    //redirect base_url('guru/input_nilai').'/'.$jadwal->kelas.'/'.$kd_jadwal;
    redirect(base_url('guru/input_nilai').'/'.$jadwal->kelas.'/'.$kd_jadwal);
  }
  
  //modul ebook
	function ebook()
    {
        
        $this->cek();
        $data['menu']=' '.$this->session->userdata('nm_sekolah');
        $data['list']=$this->Crud_model->get_all('ebook');
        $this->template->load($this->view, 'guru/ebook/list_ebook', $data);
        
    }
    	//modul buku
    function buku()
    {
        
        $this->cek();
        $data['menu']=' '.$this->session->userdata('nm_sekolah');
        $data['list']=$this->Crud_model->get_all('buku');
        $this->template->load($this->view, 'guru/buku/list_buku', $data);
        
    }
	//modul biodata
	function reset_password()
	{
	    $id=$this->session->userdata('userid');
	    $this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
	
		$keyguru['userid']=$id;
		$data['guru']=$this->Crud_model->get_row_selected('user',$keyguru);
	    $this->template->load($this->view, 'guru/form/reset_password', $data);
	}
	function update_password()
	{
	    $data['userid']=$this->input->post('id_guru');
		$data['username']=$this->input->post('username');
		$data['password']=$this->input->post('password');
		$data['level']='guru';
		$data['status']='1';
		$data['homebase']='ALL';

		$keyuser['userid']=$this->input->post('id_guru');
		
		$this->Crud_model->update_data('user',$data,$keyuser);
	
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Akun Guru tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('guru');
	}
	function guru()
	{
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['list']=$this->Crud_model->get_all('guru');
		$this->template->load($this->view, 'siswa/view/list_guru', $data);
	}
	function edit_guru()
	{
	    $id=$this->session->userdata('userid');
		$key['id_guru']=$id;
		$data['guru']=$this->Crud_model->get_row_selected('guru',$key);
		$this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		$data['title']=' SIAKAD';
		$data['list_agama']=$this->Crud_model->get_all('agama');
		$data['list_jk']=$this->Crud_model->get_all('kelamin');
		$data['list_status']=$this->Crud_model->get_all('status');
		$this->template->load($this->view, 'guru/form/edit_guru', $data);
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
		     unlink('foto_guru/'.$image['file_name']);
			$image = $this->upload->data();
			//$data['image'] = $image['file_name'];
		    
			$data['image']=$image['file_name'];
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
		redirect ('guru');
	}
	//jadwal kelas bimbingan
	
	public function kontrol_nilaif()
	{
	    $this->cek();
	    $data['menu']=' '.$this->session->userdata('nm_sekolah');
	    $data['kd_ta']=$this->session->userdata('kd_ta');
	    $data['list_ta']=$this->Crud_model->get_all('thnajaran');
	    $this->template->load($this->view, 'guru/form/kontrol_nilaif', $data);
	}
	public function jadwal_kelas()
	{
		$this->cek();
		$kd_ta=$this->input->post('kd_ta');
		$data['list_jadwal']='';
	$data['menu']=$this->session->userdata('nm_sekolah');
		$id_guru=$this->session->userdata('userid');
		$keykelas['id_guru']=$id_guru;
		$x='';
		$x=$this->Crud_model->get_row_selected('kelas',$keykelas);
		if($x)
		{
		    $kelas=$x->id_kelas;
		}else
		{
		    $kelas='';
		}
		//$data['list_jadwal']=$this->Crud_model->get_list_selected('jadwal',$key);
		$sql="SELECT  `jadwal`.`kd_pelajaran`,  `pelajaran`.`nm_pelajaran`,  `jadwal`.`hari`,  `jadwal`.`kd_ta`,kd_jadwal,guru.nm_guru,
  			`jadwal`.`kelas`,  `jadwal`.`jam_masuk`,  `jadwal`.`jam_keluar`,  `jadwal`.`status`,  `pelajaran`.`kategori`,
  			`pelajaran`.`subkategori`,  `jadwal`.`id_guru` FROM `jadwal`  INNER JOIN `pelajaran` ON `pelajaran`.`kd_pelajaran` = `jadwal`.`kd_pelajaran` 
  			inner join guru on guru.id_guru=jadwal.id_guru
  			WHERE   `jadwal`.`kelas` = '".$kelas."' and jadwal.kd_ta='".$kd_ta."' order by hari asc";
		$data['list_jadwal']=$this->db->query($sql)->result();
		$this->template->load($this->view, 'guru/view/list_jadwal', $data);
	}
	function view_kelas()
	{
	    $this->cek();
	    $this->Guru_model->kelas();
	}
	
	function siswa_nilai_rendahf()
	{
	     $this->cek();
	    $data['menu']=' '.$this->session->userdata('nm_sekolah');
	    $data['kd_ta']=$this->session->userdata('kd_ta');
	    $data['list_ta']=$this->Crud_model->get_all('thnajaran');
	    $this->template->load($this->view, 'guru/form/siswa_nilai_rendahf', $data);
	}
	function siswa_nilai_rendah()
	{
	     $this->cek();
	    $kelas=$this->session->userdata('kelas');
	    $kelas='X-IPS-1';
	    $kd_ta=$this->input->post('kd_ta');
	    $this->Guru_model->cek_nilai_siswa($kd_ta,$kelas);
	}
	function view_siswa_kelas($kelas)
	{
	    $this->cek();
	    $this->Guru_model->view_siswa_kelas($kelas);
	}
	function view_nilai($jadwal)
	{
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
	
		$key2['kd_jadwal']=$jadwal;
		
	
		$data['mnilai']=$this->Crud_model->get_all('mnilai');
		
		$data['jadwal']=$this->Crud_model->get_row_selected('jadwal',$key2);
		
		$rowjadwal=$this->Crud_model->get_row_selected('jadwal',$key2);
		$keypelajaran['kd_pelajaran']=$rowjadwal->kd_pelajaran;
		$data['pelajaran']=$this->Crud_model->get_row_selected('pelajaran',$keypelajaran);
		$data['list_nilai']=$this->query_nilai($jadwal);
		$data['kd_jadwal']=$jadwal;
		$this->template->load($this->view, 'guru/view/view_nilai', $data);
	}
	function verifikasi_nilai($kd_jadwal)
	{
	    $key['kd_jadwal']=$kd_jadwal;
	}
	
	
	
	
	//modul nilai
	
	function form_input_nilai()
	{
	    $this->cek();
	    $data['menu']=' '.$this->session->userdata('nm_sekolah');
	    $data['kd_ta']=$this->session->userdata('kd_ta');
	    $data['list_ta']=$this->Crud_model->get_all('thnajaran');
	    $this->template->load($this->view, 'guru/nilai/pilih_ta_jadwal', $data);
	}
	//modul kelas
	public function jadwal()
	{
		$this->cek();
		$kd_ta=$this->input->post('kd_ta');
	$data['menu']=$this->session->userdata('nm_sekolah');
		$id_guru=$this->session->userdata('userid');
		//$data['list_jadwal']=$this->Crud_model->get_list_selected('jadwal',$key);
		$sql="SELECT  `jadwal`.`kd_pelajaran`,  `pelajaran`.`nm_pelajaran`,  `jadwal`.`hari`,  `jadwal`.`kd_ta`,kd_jadwal,
  			`jadwal`.`kelas`,  `jadwal`.`jam_masuk`,  `jadwal`.`jam_keluar`,  `jadwal`.`status`,  `pelajaran`.`kategori`,
  			`pelajaran`.`subkategori`,  `jadwal`.`id_guru` FROM `jadwal`  INNER JOIN `pelajaran` ON `pelajaran`.`kd_pelajaran` = `jadwal`.`kd_pelajaran` WHERE   `jadwal`.`id_guru` = '".$id_guru."' and jadwal.kd_ta='".$kd_ta."'";
		$data['list_jadwal']=$this->db->query($sql)->result();
		$data['kd_ta']=$kd_ta;
		$this->template->load($this->view, 'guru/nilai/list_jadwal', $data);
	}

    //modul kontrol
    function view_absensi($kd_jadwal)
    {
        $this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
        $sql="SELECT `absen`.`kd_jadwal`,`absen`.`nis`,`guru`.`nm_guru`,`guru`.`id_guru`,`guru`.`image`,`guru`.`no_hp`,`absen`.`hadir`,`absen`.`izin`,`absen`.`sakit`,`absen`.`alpa`,`siswa`.`nm_siswa`,
      `siswa`.`tempat`,`siswa`.`tgl_lahir`,`siswa`.`agama`,`siswa`.`jk`,`siswa`.`kelas`,`siswa`.`alamat`,`siswa`.`no_hp` AS `no_hp1`,`siswa`.`nisn`,`siswa`.`nama_ayah`,`siswa`.`nama_ibu`,`siswa`.`nama_wali`,
      `siswa`.`no_hp_ayah`,`siswa`.`no_hp_ibu`,`siswa`.`no_hp_wali`,`siswa`.`alamat_wali`,`siswa`.`alamat_ayah`,`siswa`.`alamat_ibu` FROM
      `absen` INNER JOIN `siswa` ON `siswa`.`nis` = `absen`.`nis`, `guru` where absen.kd_jadwal='".$kd_jadwal."'";
        $data['list']=$this->db->query($sql)->result();
        $key2['kd_jadwal']=$kd_jadwal;
        $rowjadwal=$this->Crud_model->get_row_selected('jadwal',$key2);
		$keypelajaran['kd_pelajaran']=$rowjadwal->kd_pelajaran;
		$data['pelajaran']=$this->Crud_model->get_row_selected('pelajaran',$keypelajaran);
        $this->template->load($this->view, 'guru/view/view_absensi', $data);
  
    }
    
    function test($kd_ta)
    {
        $key['kd_ta']=$kd_ta;
        $list_jadwal=$this->Crud_model->get_list_selected('jadwal',$key);
        foreach($list_jadwal as $row)
        {
            $kelas=$row->kelas;
            $kd_jadwal=$row->kd_jadwal;
            $this->siswa_kelas_nilai($kelas,$kd_jadwal);
        }
    }
    
    
    function siswa_kelas_nilai($kelas,$kd_jadwal)
    {
        
        $key['kelas']=$kelas;
        $list=$this->Crud_model->get_list_selected('siswa',$key);
		//$data['mnilai']=$this->Crud_model->get_all('mnilai');
		
		foreach ($list as $row ) {
			$x['kd_jadwal']=$kd_jadwal;
			$x['nis']=$row->nis;
			$cek=$this->Crud_model->get_row_selected('nilai',$x);
			if(empty($cek))
			{
				$this->Crud_model->save_data('nilai',$x);
				//echo json_encode(value)
			}
		}
    }
    
	//modul input nilai
	function input_nilai($kelas,$jadwal)
	{
		$this->cek();
		$this->cek_status_nilai($jadwal);
		$data['menu']=$this->session->userdata('nm_sekolah');
		$key['kelas']=$kelas;
		$key['status']='Aktif';
		$key2['kd_jadwal']=$jadwal;
		
		$list=$this->Crud_model->get_list_selected('siswa',$key);
		$data['mnilai']=$this->Crud_model->get_all('mnilai');
		
		foreach ($list as $row ) {
			$x['kd_jadwal']=$jadwal;
			$x['nis']=$row->nis;
			$x['kd_ta']=$this->session->userdata('kd_ta');
			$cek=$this->Crud_model->get_row_selected('nilai',$x);
			if(empty($cek))
			{
				$this->Crud_model->save_data('nilai',$x);
				//echo json_encode(value)
			}
		}
		
		$rowjadwal=$this->Crud_model->get_row_selected('jadwal',$key2);
		$keypelajaran['kd_pelajaran']=$rowjadwal->kd_pelajaran;
		$data['pelajaran']=$this->Crud_model->get_row_selected('pelajaran',$keypelajaran);
		$data['list_nilai']=$this->query_nilai($jadwal);
		//$data['list_nilai']=$this->Crud_model->get_list_selected('nilai',$key2);
        $data['kelas']=$kelas;
		//$data['list_nilai']=$this->Crud_model->get_list_selected('nilai',$key2);
		$data['kd_jadwal']=$jadwal;
		$this->template->load($this->view, 'guru/nilai/input_nilai', $data);
	}
	function tutup_nilai($kd_jadwal)
	{
	    $key['kd_jadwal']=$kd_jadwal;
	    $data['status']="Selesai";
	    $this->Crud_model->update_data('jadwal',$data,$key);
	    $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Penginputan Nilai Selesai.");
		$this->session->set_flashdata($pesan);
		$keyj['kd_jadwal']=$kd_jadwal;
		$jadwal=$this->Crud_model->get_row_selected('jadwal',$keyj);
		redirect (base_url('guru/jadwal').'/'.$jadwal->kd_ta);
		
	}
	
	function query_catatan($kd_ta,$kelas)
	{
	    $sql="SELECT catatan_wali_kelas.kd_ta,catatan_wali_kelas.nis,catatan_wali_kelas.catatan,siswa.nm_siswa,siswa.kelas FROM `catatan_wali_kelas`,siswa WHERE catatan_wali_kelas.nis=siswa.nis and siswa.kelas='".$kelas."' and catatan_wali_kelas.kd_ta='".$kd_ta."'";
	    $hasil=$this->db->query($sql)->result();
		return $hasil;
	}
	function query_nilai($kd_jadwal)
	{
		$sql="select siswa.status,nilai.nis,siswa.nm_siswa,siswa.kelas,nilai.nilai_spritual,nilai_sosial,nilai_pengetahuan,desc_nilai_pengetahuan,nilai_keterampilan,desc_nilai_keterampilan from nilai,siswa where nilai.nis=siswa.nis and nilai.kd_jadwal='".$kd_jadwal."' order by siswa.nm_siswa asc";
		$hasil=$this->db->query($sql)->result();
		return $hasil;
	}

    function x_baris_nilai()
    {
        $key['kd_jadwal']=$this->input->post('kd_jadwal');	
		$key['nis']=$this->input->post('nis');
		$this->Crud_model->delete_data('nilai',$key);
	echo 'Berhasil dihapus';
    }
   
	function ajax_save_nilai()
	{
		$pesan='Gagal';
		$key['kd_jadwal']=$this->input->post('kd_jadwal');	
		$key['nis']=$this->input->post('nis');
		$data['nilai_spritual']=$this->input->post('nspritual');
		$data['nilai_sosial']=$this->input->post('nsosial');
		$data['nilai_pengetahuan']=$this->input->post('npengetahuan');
		$data['desc_nilai_pengetahuan']=$this->input->post('dpengetahuan');
		$data['nilai_keterampilan']=$this->input->post('nketerampilan');
		$data['desc_nilai_keterampilan']=$this->input->post('dketerampilan');
		$data['tgl_update']=date("Y-m-d H:i:s");
		$data['user']=$this->session->userdata('userid');
		$data['status']='aktif';
		$cek=$this->Crud_model->get_row_selected('nilai',$key);
		if(!empty($cek))
		{
			$this->Crud_model->update_data('nilai',$data,$key);
			$pesan="Updated";
		}
		else
		{
			$data['kd_jadwal']=$this->input->post('kd_jadwal');
			$data['nis']=$this->input->post('nis');
			$this->Crud_model->save_data('nilai',$data);
			$pesan="Saved";
		}
		echo $pesan;
	}
	function template_nilai($kelas,$kd_jadwal)
	{
	    $key['kelas']=$kelas;
	    $key['status']='Aktif';
	    $keyx['kd_jadwal']=$kd_jadwal;
	    $jadwal=$this->Crud_model->get_row_selected('vjadwalpelajaran',$keyx);
	    $data['jadwal']=$jadwal;
	    $hasil=$this->Crud_model->get_list_selected('siswa',$key);
	    $data['list']=$hasil;
	    $data['file']='template_nilai_'.$jadwal->nm_pelajaran.'_'.$kelas.'_'.$jadwal->kd_ta;
	    	$this->load->view('guru/nilai/template_nilai', $data);
	}
	function ajax_save_catatan()
	{
		$pesan='Gagal';
		$key['kd_ta']=$this->input->post('kd_ta');
		$key['nis']=$this->input->post('nis');
		$data['catatan']=$this->input->post('catatan');
		
		$data['tgl_update']=date("Y-m-d H:i:s");
		$data['userid']=$this->session->userdata('userid');
	
		$cek=$this->Crud_model->get_row_selected('catatan_wali_kelas',$key);
		if(!empty($cek))
		{
			$this->Crud_model->update_data('catatan_wali_kelas',$data,$key);
			$pesan="Updated";
		}
		else
		{
			$data['kd_ta']=$this->input->post('kd_ta');
		$data['nis']=$this->input->post('nis');
			$this->Crud_model->save_data('catatan_wali_kelas',$data);
			$pesan="Saved";
		}
		echo $pesan;
	}
	//modul input kehadiran/absen
	function input_absen($kelas,$jadwal)
	{
		$this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		$key['kelas']=$kelas;
		$key2['kd_jadwal']=$jadwal;
		$list=$this->Crud_model->get_list_selected('siswa',$key);
		$data['list_absen']=$this->Crud_model->get_list_selected('absen',$key2);
		$data['kd_jadwal']=$jadwal;
		foreach ($list as $row ) {
			$x['kd_jadwal']=$jadwal;
			$x['nis']=$row->nis;
			$cek=$this->Crud_model->get_row_selected('absen',$x);
			if(empty($cek))
			{
				$this->Crud_model->save_data('absen',$x);
			}
		}
		$data['list_siswa']=$this->query_absen($jadwal);
		//echo json_encode($data);
		$this->template->load($this->view, 'guru/absen/input_absen', $data);
	}
	function query_absen($kd_jadwal)
	{
		$sql="select siswa.kelas,absen.nis,siswa.nm_siswa,hadir,izin,sakit,alpa from absen,siswa where absen.nis=siswa.nis and absen.kd_jadwal='".$kd_jadwal."' order by siswa.nm_siswa asc";
		$hasil=$this->db->query($sql)->result();
		return $hasil;
	}
	function ajax_save_absen()
	{
		$pesan='Gagal';
		$key['kd_jadwal']=$this->input->post('kd_jadwal');	
		$key['nis']=$this->input->post('nis');

		$data['hadir']=$this->input->post('hadir');
		$data['izin']=$this->input->post('izin');
		$data['sakit']=$this->input->post('sakit');
		$data['alpa']=$this->input->post('alpa');
		
		$data['tgl_edit']=date('yyy-mm-dd');
		$data['userid']=$this->session->userdata('userid');
		
		$cek=$this->Crud_model->get_row_selected('absen',$key);
		
		if(empty($cek))
		{
			$data['kd_jadwal']=$this->input->post('kd_jadwal');
			$data['nis']=$this->input->post('nis');
			$this->Crud_model->save_data('absen',$data);
			$pesan="Saved";
		}else
		{
			$this->Crud_model->update_data('absen',$data,$key);
			$pesan="Updated";
		}

		echo $pesan;
	}

	//modul input tugas_quiz
	function input_tugas_quiz($kelas,$jadwal)
	{
		$this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		$key['kelas']=$kelas;
		$key2['kd_jadwal']=$jadwal;
		$list=$this->Crud_model->get_list_selected('siswa',$key);
		//$data['list_absen']=$this->Crud_model->get_list_selected('absen',$key2);
		$data['kd_jadwal']=$jadwal;
		foreach ($list as $row ) {
			$x['kd_jadwal']=$jadwal;
			$x['nis']=$row->nis;
			$cek=$this->Crud_model->get_row_selected('tugas_quiz',$x);
			if(empty($cek))
			{
				$this->Crud_model->save_data('tugas_quiz',$x);
			}
		}
		$data['ltugas']=$this->Crud_model->get_all('status_tugas');
		$data['lquiz']=$this->Crud_model->get_all('status_tugas');
		$data['list_siswa']=$this->query_tugas_quiz($jadwal);
		//echo json_encode($data);
		$this->template->load($this->view, 'guru/tugas/input_tugas_quiz', $data);
	}
	function query_tugas_quiz($kd_jadwal)
	{
		$sql="select siswa.kelas,tugas_quiz.nis,siswa.nm_siswa,tugas,quiz from tugas_quiz,siswa where tugas_quiz.nis=siswa.nis and tugas_quiz.kd_jadwal='".$kd_jadwal."' order by siswa.nm_siswa asc";
		$hasil=$this->db->query($sql)->result();
		return $hasil;
	}
	function ajax_save_quiz()
	{
		$pesan='Gagal';
		$key['kd_jadwal']=$this->input->post('kd_jadwal');	
		$key['nis']=$this->input->post('nis');

		$data['tugas']=$this->input->post('tugas');
		$data['quiz']=$this->input->post('quiz');
		$data['tgl_edit']=date('yyy-mm-dd');
		$data['userid']=$this->session->userdata('userid');
		
		$cek=$this->Crud_model->get_row_selected('tugas_quiz',$key);
		
		if(empty($cek))
		{
			$data['kd_jadwal']=$this->input->post('kd_jadwal');
			$data['nis']=$this->input->post('nis');
			$this->Crud_model->save_data('tugas_quiz',$data);
			$pesan="Saved";
		}else
		{
			$this->Crud_model->update_data('tugas_quiz',$data,$key);
			$pesan="Updated";
		}

		echo $pesan;
	}

//modul data 	
function siswa()
	{
		$this->cek();
		$homebase = $this->session->userdata('homebase');
		
		$data['menu']=$this->session->userdata('nm_sekolah');
		$keysiswa['kelas']=$homebase;
		$data['list']=$this->Crud_model->get_list_selected('siswa',$keysiswa);
		$this->template->load($this->view, 'guru/view/list_siswa', $data);
	}
	function all_siswa()
	{

		$this->cek();
	    $data['menu']=$this->session->userdata('nm_sekolah');
		$data['list']=$this->Crud_model->get_all('siswa');
		$this->template->load($this->view, 'guru/view/list_all_siswa', $data);

	}
function matapelajaran()
	{
		$this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		$data['list']=$this->Crud_model->get_all('pelajaran');
		$this->template->load($this->view, 'guru/view/list_pelajaran', $data);
	}
function kalender_akademik()
	{
		$this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		$key['kd_ta']=$this->session->userdata('kd_ta');
		$data['list']=$this->Crud_model->get_list_selected('vkalenderakademik',$key);
		$this->template->load($this->view, 'guru/kalender_akademik/list_kalender_akademik', $data);
	}
}

?>
