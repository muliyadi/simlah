<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wakasekkurikulum extends CI_Controller
{
    private $filename = "import_data";
    public $view='wakasekkurikulum/template';
        private $kd_jadwal0;
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
    //modul kurikulum
    function kurikulum()
    {
        $this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		$data['list_kurikulum']=$this->Crud_model->get_all('kurikulum');
		$this->template->load($this->view, 'wakasekkurikulum/kurikulum/list_kurikulum', $data);
    }
    function detail_kurikulum($kd_kurikulum)
    {
         $this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		
		$data['list_tingkat']=$this->Crud_model->get_all('tingkat');
		$data['list_semester']=$this->Crud_model->get_all('pelajaran_semester');
		$data['kd_kurikulum']=$kd_kurikulum;
	
		$this->template->load($this->view, 'wakasekkurikulum/kurikulum/pilih_tingkat_f', $data);
		
        
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
		
		$this->template->load($this->view, 'wakasekkurikulum/kurikulum/form_kurikulum_detail', $data);
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
	 
	 	redirect(base_url('wakasekkurikulum/list_detail_kurikulum'));
	//	$this->detail_kurikulum($kurikulum);
           
    }
    function edit_detail_kurikulum($id)
    {
         $this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		
		
        $key['id_kurikulum']=$id;
        $dk=$this->Crud_model->get_row_selected('kurikulum_detail',$key);
        
        
    }
	function cek()
	{
		$level=$this->session->userdata('level');
		if($level!='wakasek_kurikulum')
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
		$this->template->load($this->view, 'wakasekkurikulum/dashboards', $data);
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
		$this->template->load($this->view,'wakasekkurikulum/kompetensi/form_kompetensi',$data);
		
	}
	function edit_kompetensi($tingkat,$semester,$kd_pelajaran,$ke)
	{
	    $this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		 $key['status']=1;
		$data['sekolah']=$this->Crud_model->get_row_selected('sekolah',$key);
		$data['no_urut']=$this->Crud_model->get_all('nourut');
	    $keyk['kd_pelajaran']=$kd_pelajaran;
	    $keyk['kompetensi_ke']=$ke;
	    $keypel['kd_pelajaran']=$kd_pelajaran;
	    $data['pelajaran']=$this->Crud_model->get_row_selected('pelajaran',$keypel);
	    $kompetensi=$this->Crud_model->get_row_selected('pelajaran_kompetensi',$keyk);
	    $data['kompetensi_ke']=$kompetensi->kompetensi_ke;
	     $data['tingkat']=$kompetensi->tingkat;
	      $data['semester']=$kompetensi->semester;
	    $data['desk_pengetahuan']=$kompetensi->desk_pengetahuan;
	    $data['desk_keterampilan']=$kompetensi->desk_keterampilan;
	    
	    $data['list_kompetensi']=$this->Crud_model->get_list_selected('pelajaran_kompetensi',$keypel);
	    		$this->template->load($this->view,'wakasekkurikulum/kompetensi/form_kompetensi',$data);
	    
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
		redirect ('wakasekkurikulum/input_kompetensi'.'/'.$id,'refresh');
	
		
	}
	function delete_kompetensi($kd_pelajaran,$ke)
	{
	    $key['kd_pelajaran']=$kd_pelajaran;
	    $key['kompetensi_ke']=$ke;
	    $cek=$this->Crud_model->delete_data('pelajaran_kompetensi',$key);
	    if($cek){
	        	$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Kompetensi Pelajaran berhasil dihapus.");
		
	    }else{
	        	$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Kompetensi Pelajaran berhasil dihapus.");
	    }
	    $this->session->set_flashdata($pesan);
	 
		$this->fkompetensi($kd_pelajaran);
	    
	}
	//akhir modul kompetensi
	
	function update_nilai()
	{
		$hasil=$this->Crud_model->get_all('nilai');
		foreach($hasil as $row)
		{
			$data['kd_pelajaran']=$this->get_pelajaran($row->kd_jadwal);
			$data['id_guru']=$this->get_guru($row->kd_jadwal);
			$key['kd_jadwal']=$row->kd_jadwal;
			$this->Crud_model->update_data('nilai',$data,$key);
		}
	}
	function get_all_jadwal()
	{
		$hasil=$this->Crud_model->get_all('jadwal');
		echo json_encode ($hasil);
	}
	function get_pelajaran($kd_jadwal)
	{
		$key['kd_jadwal']=$kd_jadwal;
		$hasil=$this->Crud_model->get_row_selected('jadwal',$key);
		$data=$hasil->kd_pelajaran;

		return $data;
	}
	function get_guru($kd_jadwal)
	{
		$key['kd_jadwal']=$kd_jadwal;
		$hasil=$this->Crud_model->get_row_selected('jadwal',$key);

		$data=$hasil->id_guru;
		return $data;
	}
	function buka_akses_nilai($kd_jadwal)
	{
	    $key['kd_jadwal']=$kd_jadwal;
	    $data['status']='Aktif';
	    $this->Crud_model->update_data('jadwal',$data,$key);
	    $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Akses dibuka.");
		$this->session->set_flashdata($pesan);
	    redirect ('wakasekkurikulum/jadwal');
	}
	function sekolah()
	{
	    $this->cek();
	    $key['status']=1;
	    $data['list_akreditasi']=$this->Crud_model->get_all('akreditasi');
	    $data['list_status']=$this->Crud_model->get_all('status_data');
	    $data['sekolah']=$this->Crud_model->get_row_selected('sekolah',$key);
	    $data['menu']=$this->session->userdata('nm_sekolah');
		$this->template->load($this->view, 'wakasekkurikulum/sekolah/edit_sekolah', $data);
	}
	function update_sekolah()
	{
	    $key['npsn']=$this->input->post('npsn',true);
	    $data['nm_sekolah']=$this->input->post('nm_sekolah',true);
	    $data['akreditasi']=$this->input->post('akreditasi',true);
	    $data['alamat']=$this->input->post('alamat',true);
	    $data['kode_pos']=$this->input->post('kode_pos',true);
	    $data['tlp']=$this->input->post('tlp',true);
	    $data['kelurahan']=$this->input->post('kelurahan',true);
	    $data['kecamatan']=$this->input->post('kecamatan',true);
	    $data['provinsi']=$this->input->post('provinsi',true);
	    $data['kabupaten']=$this->input->post('kabupaten',true);
	    $data['kasek']=$this->input->post('kasek',true);
	    $data['nip_kasek']=$this->input->post('nip_kasek',true);
	    $data['nm_sekolah_kecil']=$this->input->post('nm_sekolah_kecil',true);
	    $data['status']=$this->input->post('status',true);
	    $data['website']=$this->input->post('website',true);
	    
	    //	$data['image']='';
	    $nama = ($this->input->post('npsn'));
		$config['upload_path']   = './logo_sekolah/';
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
	    
	    $this->Crud_model->update_data('sekolah',$data,$key);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Update Profil Sekolah Sukses...");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/sekolah');
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


	
	public function import($kd_jadwal){
	$data = array();
	$this->cek();
	
	$this->filename=$kd_jadwal;    
     // Buat variabel $data sebagai array
    $data['kd_jadwal']=$kd_jadwal;
    $keyjadwal['kd_jadwal']=$kd_jadwal;
    $jadwal=$this->Crud_model->get_row_selected('jadwal',$keyjadwal);
    $keypel['kd_pelajaran']=$jadwal->kd_pelajaran;
    $pelajaran=$this->Crud_model->get_row_selected('pelajaran',$keypel);
    $data['pelajaran']=$pelajaran;
    $data['kelas']=$jadwal->kelas;
    $data['menu']=' '.$this->session->userdata('nm_sekolah');
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
    
    $this->template->load($this->view, 'wakasekkurikulum/import/form_nilai', $data);
  }
	//modul registrasi_mahasiswa
	
	public function import2(){
	    $userid=$this->session->userdata('userid');
	$kd_jadwal=$this->input->post('kd_jadwal');

    // Load plugin PHPExcel nya
    include APPPATH.'libraries/PHPExcel/PHPExcel.php';
    
    $excelreader = new PHPExcel_Reader_Excel2007();
    $loadexcel = $excelreader->load('excel/'.$kd_jadwal.'.xlsx'); // Load file yang telah diupload ke folder excel
    $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
    
    // Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
    $datax = array();
    
    $numrow = 1;
    foreach($sheet as $row){
      if($numrow > 1){
        // Kita push (add) array data ke variabel data
        array_push($datax, array(
      'kd_jadwal'=>$kd_jadwal, // Insert data nis dari kolom A di excel
          'nis' => $row['A'], // Ambil data NIS
          'nilai_spritual' => $row['D'],
      'nilai_sosial' => $row['E'],
      'nilai_pengetahuan' => $row['F'],
      'desc_nilai_pengetahuan' => $row['G'],
      'nilai_keterampilan' => $row['H'],
      'desc_nilai_keterampilan' => $row['I'],
      'user'=>$userid,
      'status'=>'Aktif'
        ));
      }
      
      $numrow++; // Tambah 1 setiap kali looping
    }
    // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
    $this->Crud_model->save_multiple('nilai2',$datax);
    
    redirect("wakasekkurikulum/jadwal"); // Redirect ke halaman awal (ke controller siswa fungsi index)
  }
	
	function registrasi()
	{
	    $this->cek();
	    	$kd_ta=$this->session->userdata('kd_ta');
		$data['menu']= ' '.$this->session->userdata('nm_sekolah');
	
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
	    $this->template->load($this->view, 'wakasekkurikulum/registrasi/list_registrasi', $data);
	}
	function registrasi_siswa()
	{
	    $this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		$data['kd_ta']=$this->session->userdata('kd_ta');
		$kd_ta=$this->session->userdata('kd_ta');
	
	    $sql="select nis,nm_siswa from siswa where nis not in (select nis from registrasi where kd_ta='".$kd_ta."') and siswa.status='Aktif' ";
	    	$data['list_siswa']=$this->db->query($sql)->result();
		//$data['list_siswa']=$this->Crud_model->get_all('siswa');
		$data['list_status']=$this->Crud_model->get_all('status_siswa');
		$data['list_ta']=$this->Crud_model->get_all('thnajaran');
		
			$this->template->load($this->view, 'wakasekkurikulum/registrasi/form_registrasi', $data);
	}
	function hapus_siswa_nilai($kd_ta,$nis)
	{
	    $key['kd_ta']=$this->input->post('kd_ta');	
		$key['nis']=$this->input->post('nis');
		$this->Crud_model->delete_data('nilai',$key);
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
		redirect ('wakasekkurikulum/registrasi');
	}
	function edit_registrasi($nis,$kd_ta)
	{
	    $key['nis']=$nis;
	    $key['kd_ta']=$kd_ta;
	    $keyta['kd_ta']=$kd_ta;
	    $keysiswa['nis']=$nis;
	    	$data['menu']=$this->session->userdata('nm_sekolah');
	    $data['list_status']=$this->Crud_model->get_all('status_siswa');
		$data['list_siswa']=$this->Crud_model->get_list_selected('siswa',$keysiswa);
		$data['nisx']=$nis;
		$data['kd_ta']=$kd_ta;
		$data['list_ta']=$this->Crud_model->get_list_selected('thnajaran',$keyta);
		
			$this->template->load($this->view, 'wakasekkurikulum/registrasi/edit_registrasi', $data);
	}
	
	//modul matapelajaran
	//modul mata pelajaran
	public function matapelajaran()
	{
		$this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
	    	$data['list_pelajaran']=$this->Crud_model->get_all('pelajaran');
		
			$this->template->load($this->view, 'wakasekkurikulum/matapelajaran/list_matapelajaran', $data);
	}
	function save_pilihan_kurikulum()
	{
	      $sess_data['tingkat'] = $this->input->post('tingkat');
            $sess_data['semester'] = $this->input->post('semester');
			$sess_data['kd_kurikulum'] =$this->input->post('kd_kurikulum');
				$this->session->set_userdata($sess_data);
					redirect ('wakasekkurikulum/list_detail_kurikulum','refresh');
	}
	function list_detail_kurikulum()
	{
	    	$this->cek();
	    		$data['menu']=$this->session->userdata('nm_sekolah');

			
	    $key['tingkat']=$this->session->userdata('tingkat');
	    $key['semester']=$this->session->userdata('semester');
	    $key['kd_kurikulum']=$this->session->userdata('kd_kurikulum');
	    

	    	$data['list_kurikulum_detail']=$this->Crud_model->get_list_selected('vkurikulum_detail',$key);
	    	

	    
		$this->template->load($this->view, 'wakasekkurikulum/kurikulum/list_kurikulum_detail', $data);
	}
	function input_mata_pelajaran()
	{
		$this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
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
		$data['menu']=$this->session->userdata('nm_sekolah');
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
		$data['menu']=$this->session->userdata('nm_sekolah');
		$data['list_kkm']=$this->Crud_model->get_all('kkm');
		
		$this->template->load($this->view, 'wakasekkurikulum/kkm/list_kkm', $data);
	}
	function input_kkm()
	{
		$this->cek();
		$data['menu']=' Form KKM';
			$data['kd_ta']=$this->session->userdata('kd_ta');
		$data['list_thn_ajaran']=$this->Crud_model->get_all('thnajaran');
		$data['list_status']=$this->Crud_model->get_all('status_data');
		$data['list_tingkat']=$this->Crud_model->get_all('tingkat');
		
		$this->template->load($this->view, 'wakasekkurikulum/kkm/input_kkm', $data);
	}
	function save_kkm()
	{
		$data['kd_ta']=$this->input->post('kd_ta');
		$data['kkm']=$this->input->post('kkm');
		$data['status']=$this->input->post('status');
		$data['tingkat']=$this->input->post('tingkat');
		$keykkm['kd_ta']=$this->input->post('kd_ta');
			$keykkm['kd_ta']=$this->input->post('tingkat');
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
	function edit_kkm($kd_ta,$tingkat)
	{
		$keykkm['kd_ta']=$kd_ta;
			$keykkm['tingkat']=$tingkat;
		$data['kkm']=$this->Crud_model->get_row_selected('kkm',$keykkm);
		$this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		$data['list_thn_ajaran']=$this->Crud_model->get_all('thnajaran');
		$data['list_status']=$this->Crud_model->get_all('status_data');
			$data['list_tingkat']=$this->Crud_model->get_all('tingkat');
		$data['kd_ta']=$kd_ta;
		$this->template->load($this->view, 'wakasekkurikulum/kkm/edit_kkm', $data);
	}
	function update_kkm()
	{
		$this->cek();
		$data['kkm']=$this->input->post('kkm');
		$data['status']=$this->input->post('status');
			$data['tingkat']=$this->input->post('tingkat');
		$keykkm['kd_ta']=$this->input->post('kd_ta');
			$keykkm['tingkat']=$this->input->post('tingkat');
			$this->Crud_model->update_data('kkm',$data,$keykkm);
		
		
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data KKM tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/kkm');
	}
	function delete_kkm($kd_ta,$tingkat)
	{
		$this->cek();
		$keykkm['kd_ta']=$kd_ta;
		$keykkm['tingkat']=$tingkat;
		
		$this->Crud_model->delete_data('kkm',$keykkm);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data KKM sudah dihapus.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/kkm');
	}
    //modul kegiatan
    function kegiatan()
	{
		
		$this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		$data['list']=$this->Crud_model->get_all('kegiatan_akademik');
		$this->template->load($this->view, 'wakasekkurikulum/kegiatan/list_kegiatan', $data);
	}
		function input_kegiatan()
	{
		$this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		$this->template->load($this->view, 'wakasekkurikulum/kegiatan/input_kegiatan', $data);
	}
	function save_kegiatan()
	{
		$data['kegiatan']=$this->input->post('kegiatan');
	
		$this->Crud_model->save_data('kegiatan',$data);
		
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Kegiatan Tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/kegiatan');
	}
	function edit_kegiatan($id)
	{
		$this->cek();
		$key['id']=$id;
		$data['kegiatan']=$this->Crud_model->get_row_selected('kegiatan_akademik',$key);
		$data['menu']= $this->session->userdata('nm_sekolah');
		$this->template->load($this->view, 'wakasekkurikulum/kegiatan/edit_kegiatan', $data);
	}
	
	function update_kegiatan()
	{
		$key['id']=$this->input->post('id');
		$data['kegiatan']=$this->input->post('kegiatan');
	
		$this->Crud_model->update_data('kegiatan_akademik',$data,$key);
		
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Kegiatan Sudah Diupdate.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/kegiatan');
	}
		function delete_kegiatan($id)
	{
		$key['id']=$id;
		$this->Crud_model->delete_data('delete_kegiatan',$key);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Kegiatan sudah dihapus.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/kegiatan');
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
		$data['menu']=$this->session->userdata('nm_sekolah');
		//$data['list']=$this->Crud_model->get_all('kelas');
		$this->template->load($this->view, 'wakasekkurikulum/kelas/list_kelas', $data);
	}
	function input_kelas()
	{
		$this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
		$data['list_tingkat']=$this->Crud_model->get_all('tingkat');
		$data['list_program']=$this->Crud_model->get_all('program');
		$data['list_group']=$this->Crud_model->get_all('group');
		$this->template->load($this->view, 'wakasekkurikulum/kelas/input_kelas', $data);
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
	function edit_kelas($id)
	{
		$this->cek();
		$key['id_kelas']=$id;
		$data['kelas']=$this->Crud_model->get_row_selected('kelas',$key);
		$data['menu']= $this->session->userdata('nm_sekolah');
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
		$data['menu']=$this->session->userdata('nm_sekolah');
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
		$data['menu']=$this->session->userdata('nm_sekolah');
		$data['list']=$this->Crud_model->get_all('program');
		$this->template->load($this->view, 'wakasekkurikulum/program/list_program', $data);
	}
	function input_program()
	{
		$this->cek();
		$data['menu']=$this->session->userdata('nm_sekolah');
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
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
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
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['list']=$this->Crud_model->get_all('guru');
		$this->template->load($this->view, 'wakasekkurikulum/guru/list_guru', $data);
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
		redirect ('wakasekkurikulum/guru');
			
	}
	function edit_guru($id)
	{
		$key['id_guru']=$id;
		$data['guru']=$this->Crud_model->get_row_selected('guru',$key);
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
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
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
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
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['title']=' ';
		$data['list']=$this->Crud_model->get_all('thnajaran');
		$this->template->load($this->view, 'wakasekkurikulum/tahun_ajaran/list_thn_ajaran', $data);
	}
	function input_thn_ajaran()
	{
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
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
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
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
	function delete_thn_ajaran($id)
	{
		$key['kd_ta']=$id;
		$this->Crud_model->delete_data('thnajaran',$key);
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Tahun Ajaran Tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('wakasekkurikulum/thn_ajaran');
	}

	//modul ruang kelas

	function ruang_kelas()
	{
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['list']=$this->Crud_model->get_all('ruang_kelas');
		$this->template->load($this->view, 'wakasekkurikulum/ruang_kelas/list_ruang_kelas', $data);
	}
	function input_ruang_kelas()
	{
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
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
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
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

	//modul siswa
	function siswa()
	{
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['list']=$this->Crud_model->get_all('siswa');
		$this->template->load($this->view, 'wakasekkurikulum/siswa/list_siswa', $data);
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
		$this->template->load($this->view, 'wakasekkurikulum/siswa/edit_siswa', $data);
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
		redirect('wakasekkurikulum/siswa');
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
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['title']=' SIAKAD';
		$key['level']='siswa';
	    $data['list_akun']=$this->Crud_model->get_list_selected('user',$key);
		$this->template->load($this->view, 'wakasekkurikulum/siswa/list_akun_siswa', $data);
	
	}
	function password_siswa()
	{
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['title']=' SIAKAD';
	    $data['list_siswa']=$this->Crud_model->get_all('siswa');
		$this->template->load($this->view, 'wakasekkurikulum/siswa/password_siswa', $data);
	}
	function set_password_siswa($nis)
	{
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
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
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$key['kd_ta']=$this->session->userdata('kd_ta');
		$data['list']=$this->Crud_model->get_list_selected('vkalenderakademik',$key);
		$this->template->load($this->view, 'wakasekkurikulum/kalender_akademik/list_kalender_akademik', $data);
	}
	function input_kalender_akademik()
	{
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['list_ta']=$this->Crud_model->get_all('thnajaran');
		$data['kd_ta']=$this->session->userdata('kd_ta');
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
		$data['menu']=' ' .$this->session->userdata('nm_sekolah');
		$key['id_kalender']=$id;
		
		
		$data['kalender']=$this->Crud_model->get_row_selected('vkalenderakademik',$key);
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
	function jadwal()
	{
		$this->cek();
		$kd_ta=$this->session->userdata('kd_ta');
		$key['kd_ta']=$kd_ta;
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['list']=$this->Crud_model->get_list_selected('vjadwal',$key);
		$this->template->load($this->view, 'wakasekkurikulum/jadwal/list_jadwal', $data);
	}
	function input_jadwal()
	{
		$this->cek();
		
		$data['kelas']=$this->session->userdata('kelas');
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['list_guru']=$this->Crud_model->get_all('guru');
		$data['list_hari']=$this->Crud_model->get_all('hari');
		$data['list_kelas']=$this->Crud_model->get_all('kelas');
		$data['list_pelajaran']=$this->Crud_model->get_all('pelajaran');
		$this->template->load($this->view, 'wakasekkurikulum/jadwal/input_jadwal', $data);
	}
	function save_jadwal()
	{
	    $sess_data['kelas'] = $this->input->post('kelas');;
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
			$this->session->set_userdata($sess_data);
		redirect('wakasekkurikulum/input_jadwal');
	}
	function edit_jadwal($id)
	{
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
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
	function delete_jadwal($id)
	{
		$key['kd_jadwal']=$id;
		$this->Crud_model->delete_data('jadwal',$key);
		//$this->Crud_model->delete_data('jadwal',$key);
		
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Jadwal Terhapus.");
		$this->session->set_flashdata($pesan);
		redirect('wakasekkurikulum/jadwal');
	}
function rapor_nilai($nis,$ta)
	{
	    $hasil=$this->Crud_model->cek_biodata($nis);
	    if($hasil==1)
	    {
	        $this->Crud_model->rapor_nilai($nis,$ta);
	    }else
	    {
	        redirect('wakasekkurikulum');
	    }
	    
	}
	
	function rapor($nis,$ta)
	{

	        $this->Crud_model->rapor($nis,$ta);

	    
	}
	
 public function creae_id_kurikulum($kd_kurikulum)
 {
    $q = $this->db->query("select MAX(RIGHT(id_kurikulum,3)) as id_max from kurikulum_detail where kd_kurikulum='".$kd_kurikulum."'");
    $kd = "";
    if($q->num_rows()>0)
    {
      foreach($q->result() as $k)
      {
        $tmp = ((int)$k->id_max)+1;
        $kd = sprintf("%03s", $tmp);
      }
    }
    else
    {
      $kd = "001";
    } 
    return $kd_kurikulum.$kd; 
 }
 public function create_id_guru()
  {
    $q = $this->db->query("select MAX(RIGHT(id_guru,3)) as id_max from guru");
    $kd = "";
    if($q->num_rows()>0)
    {
      foreach($q->result() as $k)
      {
        $tmp = ((int)$k->id_max)+1;
        $kd = sprintf("%03s", $tmp);
      }
    }
    else
    {
      $kd = "001";
    } 
    return 'G'.$kd;
  }
	
	//modul laporan-laporan
	function form_laporan_siswa_kelas()
	{
	    $data['list_kelas']=$this->Crud_model->get_all('kelas');
	    $data['menu']=' '.$this->session->userdata('nm_sekolah');
	    $this->template->load($this->view, 'wakasekkurikulum/laporan/lap_siswa_kelas_form', $data);
	}
	function viw_laporan_siswa_kelas()
	{
	    $key['kelas']=$this->input->post('kelas');
	    $data['list_siswa']=$this->Crud_model->get_list_selected('siswa',$key);
	    $data['kelas']=$this->input->post('kelas');
	    $this->load->view('wakasekkurikulum/laporan/lap_siswa_kelas', $data);
	    
	}
	//modul backup
	
	
	
	function list_backup()
	{
	    $this->cek();
		
		//$data['kelas']=$this->session->userdata('kelas');
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		
		$data['list_backup']=$this->Crud_model->get_all('backup_data');
		$this->template->load($this->view, 'wakasekkurikulum/backup/list_backup', $data);
	}
	public function backup() {
	    
	    $this->load->dbutil();
		$this->load->helper('file');
		$config = array(
			'format'	=> 'zip',
			'filename'	=> 'database_smu1mawasangka.sql'
		);
		
		$backup = $this->dbutil->backup($config);
 
        $nama_database = 'database_smu1mawasangka_backup_on_'. date("Y-m-d-H-i-s") .'.zip';
        $simpan = 'backup/'.$nama_database;
 
        $this->load->helper('file');
        $hasil= write_file($simpan, $backup);
        if($hasil)
        {
            $data['nm_file']=$nama_database;
            $data['status']='backup';
            $data['tgl_backup']=date("Y-m-d-H-i-s");
            $this->Crud_model->save_data('backup_data',$data);
        }
        	redirect('wakasekkurikulum/list_backup');
	}
	
	
	
   


    

}

?>