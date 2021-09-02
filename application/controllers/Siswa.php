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
class Siswa extends CI_Controller {

	public $view='siswa/template';
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
		if($level!='siswa')
		{
			$this->session->sess_destroy();
		//	unset($_SESSION[$sess_data]);
			redirect(base_url());
		}
		$data['title']='SIAKAD';
		
		$key['aktif']='Ya';
		$data['profil']=$this->Crud_model->get_row_selected('profil',$key);
	}
    function index()
    {
		$this->cek();
		$data['menu']=' Dashboard';
		$key['status']=1;
		$data['sekolah']=$this->Crud_model->get_row_selected('sekolah',$key);
		$this->template->load($this->view, 'siswa/dashboards', $data);
	}
	//skl
	
	function print_skl()
	{
	   $kd_ta=$this->session->userdata('kd_ta');
	   $keys['kegiatan']='7';
	   $keys['kd_ta']=$kd_ta;
	   $kalender=$this->Crud_model->get_row_selected('kalender_akademik',$keys);
	   
	   
	    $status=$kalender->status;
	    if($status=='Tidak Aktif')
	    {
	        echo 'Mohon maaf, menu ini belum bisa diakses';
	    }else
	    {
    	    $ta='20202';
    	    $nis=$this->session->userdata('userid');
    	    $key['nis']=$nis;
    	    $siswa=$this->Crud_model->get_row_selected('siswa',$key);
    	    $keykelas['id_kelas']=$siswa->kelas;
    	    $kelas=$this->Crud_model->get_row_selected('kelas',$keykelas);
    	    $program=$kelas->program;
    	    
    	    
    	    if($program=='IPS')
	        {   
	            $keyips['nis']=$nis;
	            $keyips['kd_ta']=$kd_ta;
	            
	            $cek=$this->Crud_model->get_row_selected('nilai_ujian_sekolah_ips',$keyips);
	            if($cek)
	            {
                 $this->Crud_model->skl_ips($nis,$ta);
	            }
	            else{
	                echo 'Mohon Maaf, Data SKL Anda belum ada dalam sistem...!';
	            }
	        }else
	        {
	            $keyips['nis']=$nis;
	            $keyips['kd_ta']=$kd_ta;
	            
	            $cek=$this->Crud_model->get_row_selected('nilai_ujian_sekolah_ipa',$keyips);
	            if($cek)
	            {
                 $this->Crud_model->skl_ipa($nis,$ta);
	            }
	            else{
	                echo 'Mohon Maaf, Data SKL Anda belum ada dalam sistem...!';
	            }
	             
	        }
	    }
	    //$this->Crud_model->skl_ips($nis,$ta);
	}
	function cek_biodata($nis)
	{
	    //$nis=$this->session->userdata('userid');
	    $key['nis']=$nis;
	    $siswa=$this->Crud_model->get_row_selected('siswa',$key);
	    if($siswa->ijazah_smp=='')
	    {
	       $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi</h4>Upload Ijazah SMP Anda....!");
		    $this->session->set_flashdata($pesan);
	        redirect('siswa/ijazah_smp');
	    }
	    if($siswa->image=='')
	    {
	        $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi</h4>Upload Pas Foto 3x4 Anda....!");
		    $this->session->set_flashdata($pesan);
	        redirect('siswa/biodata');
	    }
	    if($siswa->tempat=='' or $siswa->tempat=='-')
	    {
	        $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi</h4>Isi Kolom Tempat Lahir Anda....!");
		    $this->session->set_flashdata($pesan);
	        redirect('siswa/biodata');
	    }
	    if($siswa->nama_ayah=='' or $siswa->nama_ibu=='')
	    {
	        $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi</h4>Isi Kolom Nama Ayah/Ibu....!");
		    $this->session->set_flashdata($pesan);
	        redirect('siswa/biodata');
	    }
	    if($siswa->alamat_ayah=='' or $siswa->no_hp_ayah=='')
	    {
	        $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi</h4>Isi Kolom Alamat dan No HP Orang Tua...!");
		    $this->session->set_flashdata($pesan);
	        redirect('siswa/biodata');
	    }
	    if($siswa->status_dalam_keluarga=='' or $siswa->anak_ke=='')
	    {
	        $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi</h4>Isi Kolom:Status Dalam Keluarga dan Kolom: Anak Ke...!");
		    $this->session->set_flashdata($pesan);
	        redirect('siswa/biodata');
	    }
	    if($siswa->pekerjaan_ayah=='' or $siswa->pekerjaan_ibu=='')
	    {
	        $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi</h4>Isi Kolom: Pekerjaan Ayah dan Ibu...!");
		    $this->session->set_flashdata($pesan);
	        redirect('siswa/biodata');
	    }
	    
	   
	}
	function ijazah_smp()
	{
	    $id=$this->session->userdata('userid');
		$this->cek();
		$data['menu']=' '. $this->session->userdata('nm_sekolah');
		$key['nis']=$id;
		$data['siswa']=$this->Crud_model->get_row_selected('siswa',$key);
		 
			$this->template->load($this->view, 'siswa/form/ijazah_smp', $data);
	}
	function upload_ijazah()
	{
	    	$data['ijazah_smp'] ='';
		$key['nis']=$this->session->userdata('userid');
		$nama =$this->session->userdata('userid');
		$config['upload_path']   = './foto_ijazah/';
        $config['allowed_types'] = 'jpg|jpeg|png'; //mencegah upload backdor
        $config['file_name']     = $nama; 
        $config['overwrite']     = true; 
        
        $this->upload->initialize($config);
         if (!empty($_FILES['userfile']['name'])) 
         {
             
    		if ($this->upload->do_upload('userfile')){
    		    
    			$image = $this->upload->data();
    			$data['ijazah_smp'] = $image['file_name'];
    			$this->Crud_model->update_data('siswa',$data,$key);
            }
        
		
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi!</h4>Data Ijazah berhasil disimpan!");
		$this->session->set_flashdata($pesan);
		 }
       redirect('siswa/biodata');
        
	}
	function biodata()
	{
	    $id=$this->session->userdata('userid');
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
		$this->template->load($this->view, 'siswa/form/edit_siswa', $data);
	}
	function update_siswa()
	{
	   
		$key['nis']=$this->input->post('nis');
		$nama = ($this->input->post('nis'));
		$config['upload_path']   = './foto_siswa/';
        $config['allowed_types'] = 'jpg|jpeg|png'; //mencegah upload backdor
        $config['file_name']     = $nama; 
        $config['overwrite']	 = true;
          $config['max_size']     = '1024'; 
        $this->upload->initialize($config);
         if (!empty($_FILES['userfile']['name'])) 
         {
             if ($this->upload->do_upload('userfile')){
        		    $image = $this->upload->data();
        			$data['image'] = $image['file_name'];
        			//unlink('foto_siswa'.'/'.$siswa->image);
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
                }else
                {
                    $error = $this->upload->display_errors();
                	$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>".$error."");
    		        $this->session->set_flashdata($pesan);
          
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
		redirect('siswa/biodata');
	}
	function reset_password()
	{
		$nis=$this->session->userdata('userid');
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['title']=' SIAKAD';
		$keysiswa['nis']=$nis;
		$data['siswa']=$this->Crud_model->get_row_selected('siswa',$keysiswa);
		$this->template->load($this->view, 'siswa/form/set_password_siswa', $data);
	}
	function update_password()
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
		
			$this->Crud_model->update_data('user',$data,$keyuser);
	
		$pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Akun Siswa tersimpan.");
		$this->session->set_flashdata($pesan);
		redirect ('login/logout');
	}
	//modul ebook
	function ebook()
    {
        
        $this->cek();
        $data['menu']=' '.$this->session->userdata('nm_sekolah');
        $data['list']=$this->Crud_model->get_all('ebook');
        $this->template->load($this->view, 'siswa/ebook/list_ebook', $data);
        
    }
    	//modul buku
    function buku()
    {
        
        $this->cek();
        $data['menu']=' '.$this->session->userdata('nm_sekolah');
        $data['list']=$this->Crud_model->get_all('buku');
        $this->template->load($this->view, 'siswa/buku/list_buku', $data);
        
    }
	//modul view
	function guru()
	{
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['list']=$this->Crud_model->get_all('guru');
		$this->template->load($this->view, 'siswa/view/list_guru', $data);
	}
	function matapelajaran()
	{
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['list']=$this->Crud_model->get_all('pelajaran');
		$this->template->load($this->view, 'siswa/view/list_matapelajaran', $data);
	}
	function siswa()
	{
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['list']=$this->Crud_model->get_all('siswa');
		$this->template->load($this->view, 'siswa/view/list_siswa', $data);
	}
	//modul angket 
	function angket_peminatan()
	{
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['list_minat']=$this->Crud_model->get_all('program');

		$this->template->load($this->view, 'siswa/form/angket_peminatan', $data);
	}
	public function cari_minat()
	{
		$key=$this->input->post('kode');
		$data=$this->get_minat($key);
		echo json_encode($data);
		//echo 1;
	}
	function get_minat($kode)
	{
		$sql="select * from pelajaran where subkategori<>'".$kode."' and kategori='Minat' order by nm_pelajaran asc";
		 $data=$this->db->query($sql)->result();
		 return $data;
	}
	public function cari_wajib()
	{
		$key=$this->input->post('kode');
		$data=$this->get_wajib($key);
		echo json_encode($data);
		//echo 1;
	}
	function get_wajib($kode)
	{
		$sql="select * from pelajaran where subkategori='".$kode."'  order by nm_pelajaran asc";
		 $data=$this->db->query($sql)->result();
		 return $data;
	}

	function save_angket()
	{
		$data=$this->input->post('minat');
		echo json_encode($data);
	}

	function lreg()
	{
		$this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$userid=$this->session->userdata('userid');
		$key['nis']=$userid;
		$data['list']=$this->Crud_model->get_list_selected('registrasi',$key);
		$this->template->load($this->view, 'siswa/view/list_ta', $data);
	}
//modul kalender akademik
    function kalender_akademik()
    {
        $this->cek();
        $kd_ta=$this->session->userdata('kd_ta');
        $keyka['kd_ta']=$kd_ta;
        $data['menu']=' '.$this->session->userdata('nm_sekolah');
        $data['list']=$this->Crud_model->get_list_selected('kalender_akademik',$keyka);
        $this->template->load($this->view, 'siswa/view/list_kalender_akademik', $data);
    }

    //modul jadwal
    function jadwal()
    {
        $this->cek();
        $kd_ta=$this->session->userdata('kd_ta');
        $data['menu']=' '.$this->session->userdata('nm_sekolah');
         $keysiswa['nis']=$this->session->userdata('userid');
         $siswa=$this->Crud_model->get_row_selected('siswa',$keysiswa);
         $kelas=$siswa->kelas;
        $data['list']=$this->Crud_model->get_detail_jadwal2($kd_ta,$kelas);
        $this->template->load($this->view, 'siswa/view/list_jadwal', $data);
    }
function get_biodata($nis)
{
	$key['nis']=$nis;
	return ($this->Crud_model->get_row_selected('siswa',$key));
}
function get_sekolah()
{
	$key['npsn']='40403039';
	return $this->Crud_model->get_row_selected('sekolah',$key);
}
function get_semester($ta)
{
    $keyta['kd_ta']=$ta;
   // $keyta=$kd_ta;
   return $this->Crud_model->get_row_selected('thnajaran',$keyta);
    // $this->Crud_model->get_row_selected('sekolah',$key);
}

public function get_avg_sikap($kd_ta,$nis)
{
    $sql="SELECT
  `jadwal`.`kd_ta`,
  `nilai`.`nis`,
  round(Avg(`nilai`.`nilai_spritual`),0) AS `avg_spritual`,
  round(Avg(`nilai`.`nilai_sosial`),0) AS `avg_sosial`
FROM
  `nilai`
  INNER JOIN `jadwal` ON `jadwal`.`kd_jadwal` = `nilai`.`kd_jadwal`
WHERE
  `jadwal`.`kd_ta` = '".$kd_ta."' AND
  `nilai`.`nis` = '".$nis."'
GROUP BY
  `jadwal`.`kd_ta`,
  `nilai`.`nis`";
//echo json_encode($this->db->query($sql)->result());
    $data= $this->db->query($sql)->result();
   
        

   
   return $data;
   // echo json_encode($data);
}
function fpilih_ta_rapor()
{
 $this->cek();
	    $data['menu']=' '.$this->session->userdata('nm_sekolah');
	    $data['kd_ta']=$this->session->userdata('kd_ta');
	    $data['list_ta']=$this->Crud_model->get_all('thnajaran');
	     $this->template->load($this->view, 'siswa/form/pilih_ta_rapor', $data);
}
function rapor_nilai()
	{
	    $nis=$this->session->userdata('userid');
	    $tgl_sekarang=date('Y-m-d');
	    $tgl_sekarang=strtotime($tgl_sekarang);
	    $ta=$this->input->post('kd_ta');
	    $key['kd_ta']=$ta;
	    $tahun_ajaran=$this->Crud_model->get_row_selected('thnajaran',$key);
	    $semester=$tahun_ajaran->semester;
	    
	    if($semester==2)
	    {
	        $keykalender['kd_ta']=$ta;
	        $keykalender['kegiatan']='10';
	        $ka=$this->Crud_model->get_row_selected('kalender_akademik',$keykalender);
	        $tgl_rapor=strtotime($ka->tgl_mulai);
	        if($tgl_sekarang<$tgl_rapor)
	        {
	            echo 'Tanggal Penyerahan Rapor belum tiba, Cek Kalender Akademik untuk melihat waktu pembukaan akses Cetak Rapor';
	        }else
	        {
	            
	    $hasil=$this->Crud_model->cek_biodata($nis);
	    if($hasil==1)
	    {
	        $this->Crud_model->rapor_nilai($nis,$ta);
	    }else
	    {
	        redirect('siswa/lreg');
	    }
	        }
	        
	    }else
	    {
	        $this->Crud_model->rapor_nilai($nis,$ta);
	    }
	    
	    
	}
	
	function rapor($nis,$ta)
	{

	        $this->Crud_model->rapor($nis,$ta);

	    
	}
function raporx($nis,$ta){

    
	$biodata=$this->get_biodata($nis);
	$tgl=$this->Crud_model->date_indo($biodata->tgl_lahir);
	$sekolah=$this->get_sekolah();
    $semester=$this->get_semester($ta);
	if($biodata->jk=="L")
	{
		$jk="Laki-Laki";

	}else
	{
		$jk="Perempuan";

	}
	$anak_ke=$this->Crud_model->angka_to_huruf($biodata->anak_ke);
$tanggalcetak = date('Y-m-d');
        $tanggalcetak=$this->Crud_model->date_indo($tanggalcetak);
$this->load->library('cfpdf');
        //$pdf = new FPDF('P', 'mm', 'Legal');
        $pdf = new PDF_MC_Table();
        $pdf->AddPage();
        $pdf->SetMargins(15, 20, 10, 10);
        $pdf->SetFont('times', '', 13);

         $gambar1 = "assets/img/tutwuri.png";
        $gambar2 = "assets/img/logo.jpg";
       
        $pdf->image($gambar1, 89, 30, 35);
         $pdf->SetFont('times', 'B', 16);
        $pdf->ln(60);
        $pdf->Cell(0, 10, 'RAPOR', 0, 0, 'C');
        $pdf->ln(7);
       	$pdf->Cell(0, 10, 'SEKOLAH MENENGAH ATAS', 0, 0, 'C');
        $pdf->ln(7);
        $pdf->Cell(0, 10, $sekolah->nm_sekolah, 0, 0, 'C');
      	
        $pdf->image($gambar2, 89, 120, 35);
        $pdf->ln(80);
        $pdf->SetFont('times', '', 15);
        $pdf->Cell(0, 10, 'Nama Peserta Didik', 0, 0, 'C');
        $pdf->ln(7);
        $pdf->SetFont('times', 'B', 16);
        $pdf->Cell(0,10,$biodata->nm_siswa,'',1,'C');
        $pdf->ln(7);
        $pdf->SetFont('times', '', 15);
        $pdf->Cell(0, 10, 'N I S N', 0, 0, 'C');
        $pdf->ln(7);
        $pdf->SetFont('times', 'B', 16);
        $pdf->Cell(0,10,$biodata->nisn,'',1,'C');
        $pdf->ln(30);
        $pdf->Cell(0, 10, 'KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN', 0, 0, 'C');
        $pdf->ln(7);
        $pdf->Cell(0, 10, 'REPUBLIK INDONESIA', 0, 0, 'C');
        
      

    
       
        

       
        $pdf->AddPage();
        $pdf->SetMargins(20, 20, 10, 10);
        $pdf->SetFont('times', 'B', 15);
      	$pdf->ln(7);
        $pdf->Cell(0, 10, 'RAPOR', 0, 0, 'C');
        $pdf->ln(7);
        $pdf->Cell(0, 10, 'SEKOLAH MENENGAH ATAS', 0, 0, 'C');
        $pdf->ln(7);
      	$pdf->Cell(0, 10, '(SMA)', 0, 0, 'C');
        

        $pdf->SetFont('times', '', 13);
        $pdf->ln(25);
        $pdf->Cell(39, 10, 'Nama Sekolah', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
         $pdf->Cell(0, 10, $sekolah->nm_sekolah_kecil, 0, 0, 'L');
        $pdf->ln(7);
        $pdf->Cell(39, 10, 'NPSN', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
  		$pdf->Cell(0, 10, $sekolah->npsn, 0, 0, 'L');
       
        $pdf->ln(7);
        $pdf->Cell(10, 10, 'NIS/NSS/NDS', 0, 0, 'L');
        $pdf->Cell(60, 10, ':', 0, 0, 'C');

        $pdf->ln(7);
        $pdf->Cell(39, 10, 'Alamat Sekolah', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
        $pdf->Cell(0, 10, $sekolah->alamat, 0, 0, 'L');

        $pdf->ln(7);
        $pdf->Cell(39, 10, 'Kode Pos', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
         $pdf->Cell(0, 10, $sekolah->kode_pos, 0, 0, 'L');
        $pdf->ln(7);
        $pdf->Cell(39, 10, 'Telp', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
         $pdf->Cell(0, 10, $sekolah->tlp, 0, 0, 'L');
        $pdf->ln(7);
        

        $pdf->Cell(39, 10, 'Desa/Kelurahan', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
        $pdf->Cell(0, 10, $sekolah->kelurahan, 0, 0, 'L');
        $pdf->ln(7);

        $pdf->Cell(39, 10, 'Kecamatan', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
         $pdf->Cell(0, 10, $sekolah->kecamatan, 0, 0, 'L');
        $pdf->ln(7);
        $pdf->Cell(39, 10, 'Kota/Kabupaten', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
         $pdf->Cell(0, 10, $sekolah->kabupaten, 0, 0, 'L');
        $pdf->ln(7);

        $pdf->Cell(39, 10, 'Provinsi', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
        $pdf->Cell(0, 10, $sekolah->provinsi, 0, 0, 'L');
        $pdf->ln(7);
        $pdf->Cell(39, 10, 'Website', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
         $pdf->Cell(0, 10, $sekolah->website, 0, 0, 'L');
        $pdf->ln(7);
        $pdf->Cell(39, 10, 'Email', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
         $pdf->Cell(0, 10, $sekolah->email, 0, 0, 'L');

        //identitas peserta didik
        $pdf->AddPage();
        $pdf->SetMargins(20, 20, 10, 10);
        $pdf->SetFont('times', 'B', 15);
      	
        $pdf->Cell(0, 10, 'IDENTITAS PESERTA DIDIK', 0, 0, 'C');
        $pdf->ln(25);

        $pdf->SetFont('times', '', 12);

        $pdf->Cell(74, 8, '1. Nama Peserta Didik', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
         $pdf->Cell(0, 8, $biodata->nm_siswa, 0, 0, 'L');
        $pdf->ln(5);

        $pdf->Cell(74, 8, '2. Nomor Induk Sekolah (NIS)', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(0, 8, $biodata->nis, 0, 0, 'L');
        $pdf->ln(5);

        $pdf->Cell(74, 8, '3. Nomor Induk Sekolah Nasional (NISN)', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(0, 8, $biodata->nisn, 0, 0, 'L');
        $pdf->ln(5);

        $pdf->Cell(74, 8, '4. Tempat dan Tanggal Lahir', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(0, 8, $biodata->tempat.', '.$tgl, 0, 0, 'L');
        $pdf->ln(5);

        $pdf->Cell(74, 8, '5. Jenis Kelamin', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
         $pdf->Cell(0, 8, $jk, 0, 0, 'L');
        $pdf->ln(5);

        $pdf->Cell(74, 8, '6. Agama', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(0, 8, $biodata->agama, 0, 0, 'L');
        $pdf->ln(5);

        $pdf->Cell(74, 8, '7. Status dalam Keluarga', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(0, 8, $biodata->status_dalam_keluarga, 0, 0, 'L');
        $pdf->ln(5);

        $pdf->Cell(74, 8, '8. Anak ke', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(0, 8, $biodata->anak_ke.' ('.$anak_ke.') ', 0, 0, 'L');
        $pdf->ln(5);

		$pdf->Cell(74, 8, '9. Alamat Peserta Didik', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(0, 8, $biodata->alamat, 0, 0, 'L');
        $pdf->ln(5);

        $pdf->Cell(74, 8, '10. Diterima disekolah ini', 0, 0, 'L');
        $pdf->Cell(2, 8, '', 0, 0, 'C');
        $pdf->ln(5);

        $pdf->Cell(7);
        $pdf->Cell(67, 8, 'a. Di Kelas', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(0, 8, $biodata->kelas, 0, 0, 'L');
        $pdf->ln(5);
        
         $pdf->Cell(7);
        $pdf->Cell(67, 8, 'b. Pada Tanggal', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->ln(5);

        $pdf->Cell(7);
        $pdf->Cell(67, 8, 'c. Semester', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(0, 8, $biodata->semester_awal, 0, 0, 'L');
        $pdf->ln(5);

        $pdf->Cell(74, 8, '11. Sekolah Asal', 0, 0, 'L');
        $pdf->Cell(2, 8, '', 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(7);
        $pdf->Cell(67, 8, 'a. Nama Sekolah', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(0, 8, $biodata->asal_sekolah, 0, 0, 'L');
        $pdf->ln(5);
       

         $pdf->Cell(7);
        $pdf->Cell(67, 8, 'b. Alamat Sekolah', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(0, 8, $biodata->alamat_asal_sekolah, 0, 0, 'L');
        $pdf->ln(5);
       

        $pdf->Cell(10, 8, '12.  Ijazah (SMP/MTs/Paket B)', 0, 0, 'L');
        $pdf->Cell(130, 8, '', 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(7);
        $pdf->Cell(67, 8, 'a. Tahun', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
         $pdf->Cell(0, 8, $biodata->tahun_ijazah, 0, 0, 'L');
        $pdf->ln(5);
       

         $pdf->Cell(7);
        $pdf->Cell(67, 8, 'b. Nomor', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(0, 8, $biodata->no_ijazah, 0, 0, 'L');
        $pdf->ln(5);

        

        $pdf->Cell(10, 8, '13. Surat Keterangan Hasil Ujian Nasional (SKHUN) SMP/MTs/Paket B', 0, 0, 'L');
        $pdf->Cell(130, 8, '', 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(7);
        $pdf->Cell(67, 8, 'a. Tahun', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(0, 8, $biodata->tahun_ijazah, 0, 0, 'L');
        $pdf->ln(5);
       

         $pdf->Cell(7);
        $pdf->Cell(10, 8, 'b. Nomor', 0, 0, 'L');
        $pdf->Cell(116, 8, ':', 0, 0, 'C');
        $pdf->ln(5);

		$pdf->Cell(74, 8, '14. Nama Orang Tua', 0, 0, 'L');
        $pdf->Cell(2, 8, '', 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(7);
        $pdf->Cell(67, 8, 'a. Ayah', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(0, 8, $biodata->nama_ayah, 0, 0, 'L');
        $pdf->ln(5);
       

         $pdf->Cell(7);
        $pdf->Cell(67, 8, 'b. Ibu', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
         $pdf->Cell(0, 8, $biodata->nama_ibu, 0, 0, 'L');
        $pdf->ln(5);

        $pdf->Cell(74, 8, '15. Alamat Orang Tua', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(0, 8, $biodata->alamat_ayah, 0, 0, 'L');
        $pdf->ln(5);
        $pdf->Cell(7);
        $pdf->Cell(67, 8, 'Telepon/HP', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(0, 8, $biodata->no_hp_ayah, 0, 0, 'L');
        $pdf->ln(5);
       

       

        $pdf->Cell(10, 8, '16. Pekerjaan Orang Tua', 0, 0, 'L');
        $pdf->Cell(130, 8, '', 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(7);
        $pdf->Cell(67, 8, 'a. Ayah', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(0, 8, $biodata->pekerjaan_ayah, 0, 0, 'L');
        $pdf->ln(5);
       

        $pdf->Cell(7);
        $pdf->Cell(67, 8, 'b. Ibu', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
         $pdf->Cell(0, 8, $biodata->pekerjaan_ibu, 0, 0, 'L');
        $pdf->ln(5);

        $pdf->Cell(74, 8, '17. Nama Wali', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
         $pdf->Cell(0, 8, $biodata->nama_wali, 0, 0, 'L');
        $pdf->ln(5);

        $pdf->Cell(74, 8, '18. Pekerjaan Wali', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
         $pdf->Cell(0, 8, $biodata->pekerjaan_wali, 0, 0, 'L');
        $pdf->ln(5);

        $pdf->Cell(74, 8, '19. Alamat Wali', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
         $pdf->Cell(0, 8, $biodata->alamat_wali, 0, 0, 'L');
        $pdf->ln(5);
        $pdf->Cell(7);
        $pdf->Cell(67, 8, 'Telepon/HP', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
         $pdf->Cell(0, 8, $biodata->no_hp_wali, 0, 0, 'L');
        $pdf->ln(10);

        ///
        $pdf->Cell(120);
        $pdf->Cell(0, 8, 'Lakorua, '.$tanggalcetak, 0, 0, 'L');
        $pdf->ln(5);
         $pdf->Cell(120);
        $pdf->Cell(0, 8, 'Kepala Sekolah,', 0, 0, 'L');
        $pdf->ln(30);
        $jumlah=strlen($sekolah->nip_kasek);
        $pdf->Cell(120);
        $pdf->Cell(0, 8, $sekolah->kasek, 0, 0,'L');
        $pdf->ln(5);
        $pdf->Cell(120);
         $pdf->Cell(50, 1, '', 'B', 1, 'L');
        
          $pdf->Cell(120);
        $pdf->Cell(0, 8, 'NIP.'.$sekolah->nip_kasek, 0, 0,'L');
        $pdf->ln(5);


        $pdf->Output('$namaPDF','I');

    }
    
    
    public function testing($kd_ta)
   {
       
       $siswas=$this->Crud_model->get_all('siswa');
       foreach($siswas as $siswa)
       {
           $nis=$siswa->nis;
          // $kd_ta=$kd_ta;
            echo json_encode($this->get_avg_sikap($kd_ta,$nis)); 
            echo '<br>';
       }
       
   }

    function test($nis)
    {
        $biodata=$this->get_biodata($nis);
        $keykelas['id_kelas']='XII-IPS-2';
    	$tingkat=$this->Crud_model->get_row_selected('kelas',$keykelas);
        echo $tingkat->tingkat;
    }
    function get_wali_kelas($kelas)
    {
        $key['id_kelas']=$kelas;
        $kelas=$this->Crud_model->get_row_selected('kelas',$key);
        $keyguru['id_guru']=$kelas->id_guru;
        $guru=$this->Crud_model->get_row_selected('guru',$keyguru);
        return $guru;
        
    }
    function angka_to_grade($kd_ta,$kkm,$nilai)
    {
        $nilai=round($nilai,0);
        $key['kd_ta']=$kd_ta;
        $key['kkm']=$kkm;
        $grade='E';
        $hasil=$this->Crud_model->get_list_selected('kkm_nilai',$key);
        foreach($hasil as $row)
        {
            $b=$row->bawah;
            $a=$row->atas;
            if($nilai>=$b and $nilai<=$a)
            {
                $grade=$row->grade;
            }
        }
        return $grade;
        
    }
    
    public function rapor_nilaix($nis,$ta)
    {
         //$gambar2 = "assets/img/logo.jpg";
       
        //$pdf->image($gambar1, 89, 30, 35);
        
        $level = $this->session->userdata('level');
        if($level=='siswa')
        {
            $this->cek_biodata($nis);    
        }
        $ta_huruf='';
        $predikat='E';
    	$biodata=$this->get_biodata($nis);
    	$keykelas['id_kelas']=$biodata->kelas;
    	$tingkat=$this->Crud_model->get_row_selected('kelas',$keykelas);
    	$keykkm['tingkat']=$tingkat->tingkat;
    	$kkmx=$this->Crud_model->get_row_selected('kkm',$keykkm);
    	$kelompok=$this->Crud_model->get_all('kelompok_pelajaran');
    	$kd_ta=$ta;
    	$spri=0;
    	$sos=0;
	$sekolah=$this->get_sekolah();
    $ta=$this->get_semester($ta);
    $guru=$this->get_wali_kelas($biodata->kelas);
    $nm_wali_kelas=$guru->nm_guru;
    if($guru->gelar_depan!='' and $guru->gelar_belakang!='')
    {
        $nm_wali_kelas=$guru->gelar_depan.'.'.$nm_wali_kelas.', '.$guru->gelar_belakang;
    }elseif($guru->gelar_depan=='')
    {
        $nm_wali_kelas=$nm_wali_kelas.', '.$guru->gelar_belakang;
    }elseif($guru->gelar_belakang=='')
    {
        $nm_wali_kelas=$guru->gelar_depan.'.'.$nm_wali_kelas;
    }
    //$nm_wali_kelas=$guru->gelar_depan.'.'.$nm_wali_kelas.', '.$guru->gelar_belakang;
    //$nm_wali_kelas=strtolower($nm_wali_kelas);
    //$nm_wali_kelas=ucwords($nm_wali_kelas);
    $nip_wali_kelas=$guru->nip;
    $ta_huruf=$this->Crud_model->angka_to_huruf($biodata->semester);
    
	$B=$this->get_avg_sikap($kd_ta,$nis);
	if($B)
	{
        foreach ($B as $key ) {
        $spri=(($key->avg_spritual));
        $sos=(($key->avg_sosial));
        if(is_null($spri))
        {
            $spri=0;
        }
        if(is_null($sos))
        {
            $sos=0;
        }
        
     }
	}
   
   // echo ($spri);
    $keyss['angka']=$spri;
    $data=$this->Crud_model->get_row_selected('mnilai',$keyss);
    $keysos['angka']=$sos;
    $dataz=$this->Crud_model->get_row_selected('mnilai',$keysos);
    

//$this->load->library('cfpdf');
	
		 

	//$hasil=$this->Crud_model->get_all('nilai');
        $page=array(210,330);
        $pdf = new TCPDF('P', 'mm', $page);
      //  $pdf = new FPDF('P', 'mm', 'Legal');
       $pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
       // $pdf = new PDF_MC_Table('P', 'mm', 'A4');
     
     	 $pdf->AddPage();
       // $pdf->SetMargins(15, 20, 10, 10);
      //$pdf->SetFillColor(200,200,200);
        $pdf->SetFont('times', '', 12);
        //$pdf->ln(0);
        $pdf->Cell(28, 0, 'Nama Sekolah', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	$pdf->Cell(85, 0, $sekolah->nm_sekolah_kecil, 0, 0, 'L');
        $pdf->Cell(28, 0, 'Kelas', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
        $pdf->Cell(10,0,$biodata->kelas,0,0,'L');
        $pdf->ln(5);
      

        $pdf->Cell(28, 0, 'Alamat', 0, 0, 'L'); 
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
        $pdf->Cell(85,0,$sekolah->alamat,0,0,'L');
        
        $pdf->Cell(28, 0, 'Semester', 0, 0, 'L');
     
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	 $pdf->Cell(10,0,$biodata->semester.'('.$ta_huruf.')',0,0,'L');
       
        $pdf->ln(5);
      	
        $pdf->Cell(28, 0, 'Nama', 0, 0, 'L');
      	 
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
        $pdf->Cell(85,0,$biodata->nm_siswa,0,0,'L');
        
        $pdf->Cell(28, 0, 'Tahun Pelajaran', 0, 0, 'L');
      
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
        $pdf->Cell(10,0,$ta->thn_ajaran,0,0,'L');
        $pdf->ln(5);
      	
        $pdf->Cell(28, 0, 'NIS/NISN', 0, 0, 'L');
      	 
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       $pdf->Cell(90,0,$biodata->nis.'/'.$biodata->nisn,0,0,'L');
         $pdf->ln(2);
         $pdf->Cell(188, 1, '', 'B', 1, 'L');
       


        $pdf->SetFont('times', 'B', 14);
        $pdf->ln(4);
        $pdf->Cell(0, 10, 'CAPAIAN HASIL BELAJAR', 0, 0, 'C');
        $pdf->ln(15);
       

        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(10, 5, 'A. Sikap', 0, 0, 'L');
        $pdf->ln(10);
         $pdf->Cell(5);
       	$pdf->Cell(15, 5, '1. Sikap Spritual', 0, 0, 'L');

        
        $pdf->ln(10);
        $pdf->Cell(6);
        $pdf->SetFont('times', '', 12);
        $tabel = '
        <table border="1" cellpadding="3">
              <tr>
                    <th align="center" width="20%"> <b>Predikat</b> </th>
                    <th  width="80%"> <b>Deskripsi</b> </th>
              </tr>
 
              <tr>
                    <td align="center">'.$data->nilai.' </td>
                    <td>'.$data->desc_nilai_spritual.'</td>
              </tr>
      </table>
        ';
 $pdf->writeHTML($tabel);
       	


            

      	  $pdf->SetFont('times', 'B', 12);
         $pdf->Cell(5);
       	$pdf->Cell(15, 5, '2. Sikap Sosial', 0, 0, 'L');
    

        $pdf->ln(10);
        $pdf->Cell(6);
        $pdf->SetFont('times', '', 12);
         $tabel = '
        <table border="1" cellpadding="3">
              <tr>
                    <th align="center" width="20%"> <b>Predikat</b> </th>
                    <th  width="80%"> <b>Deskripsi</b> </th>
              </tr>
 
              <tr>
                    <td align="center">'.$dataz->nilai.' </td>
                    <td style="vertical-align: middle;">'.$dataz->desc_nilai_sosial.'</td>
              </tr>
      </table>
        ';
 $pdf->writeHTML($tabel);
        
       


       	$pdf->AddPage();
        //$pdf->SetMargins(15, 20, 10, 10);
      
        $pdf->SetFont('times', '', 12);
        $pdf->ln(0);
        $pdf->Cell(28, 0, 'Nama Sekolah', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	$pdf->Cell(85, 0, $sekolah->nm_sekolah_kecil, 0, 0, 'L');
        $pdf->Cell(28, 0, 'Kelas', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
        $pdf->Cell(10,0,$biodata->kelas,0,0,'L');
        $pdf->ln(5);
      

        $pdf->Cell(28, 0, 'Alamat', 0, 0, 'L'); 
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
        $pdf->Cell(85,0,$sekolah->alamat,0,0,'L');
        
        $pdf->Cell(28, 0, 'Semester', 0, 0, 'L');
     
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	 $pdf->Cell(10,0,$biodata->semester.'('.$ta_huruf.')',0,0,'L');
       
        $pdf->ln(5);
      	
        $pdf->Cell(28, 0, 'Nama', 0, 0, 'L');
      	 
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
        $pdf->Cell(85,0,$biodata->nm_siswa,0,0,'L');
        
        $pdf->Cell(28, 0, 'Tahun Pelajaran', 0, 0, 'L');
      
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       $pdf->Cell(10,0,$ta->thn_ajaran,0,0,'L');
      $pdf->ln(5);
      	
        $pdf->Cell(28, 0, 'NIS/NISN', 0, 0, 'L');
      	 
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       $pdf->Cell(90,0,$biodata->nis.'/'.$biodata->nisn,0,0,'L');
         $pdf->ln(2);
         
         $pdf->Cell(188, 1, '', 'B', 1, 'L');
          $pdf->ln(5);
          $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(10, 5, 'B. Pengetahuan', 0, 0, 'L');
        $pdf->ln(10);
 $pdf->SetFont('times', '', 12);
        $pdf->Cell(35, 0, 'Kriteria Ketuntasan Minimal = '.$kkmx->kkm, 0, 0, 'L');

        
        
        $pdf->ln(6);
       
 
        	
      
		$sql="SELECT `nilai`.`kd_jadwal`,`nilai`.`nilai_spritual`,`nilai`.`nilai_sosial`,`nilai`.`nilai_pengetahuan`,
			  `nilai`.`desc_nilai_pengetahuan`,`nilai`.`nilai_keterampilan`,`nilai`.`desc_nilai_keterampilan`,`jadwal`.`kd_pelajaran`,
			  `jadwal`.`id_guru`,`jadwal`.`kd_ta`,`pelajaran`.`nm_pelajaran`,`pelajaran`.`kategori`,`pelajaran`.`subkategori`,`nilai`.`nis`,kelompok
				FROM `nilai` INNER JOIN `jadwal` ON `nilai`.`kd_jadwal` = `jadwal`.`kd_jadwal` INNER JOIN `pelajaran` ON `jadwal`.`kd_pelajaran` = `pelajaran`.`kd_pelajaran` WHERE `nilai`.`nis`='".$nis."'  and jadwal.kd_ta='".$kd_ta."' and pelajaran.kelompok='A' order by pelajaran.urutan asc";
	 		$A=$this->db->query($sql)->result();
       	
       	
       		
       		 $header ='
        <table border="1" cellpadding="3">
              <tr>
                    <th align="center" width="4%"><b>No</b></th>
                    <th width="36%" align="left"><b>  Mata Pelajaran</b> </th>
                    <th align="center" width="7%"><b> Nilai</b> </th>
                    <th align="center" width="10%"><b>Predikat</b> </th>
                    <th width="43%" align="left"><b>Deskripsi</b> </th>
              </tr>'
             ;
              	
            $kkm=$kkmx->kkm;
            $interval=round((100-$kkm)/3,0);
            //$hb=100-$interval;
            
            $habawah=100-$interval+1;
            $hbbawah=$habawah-$interval;
            $hcbawah=$hbbawah-$interval;
            $hdbawah=$hcbawah-$interval;
            $hebawah=0;
            $hbatas=$habawah-1;
            $hcatas=$hbbawah-1;
            $hdatas=$hcbawah-1;
            $heatas=$hdbawah-1;
            $rowa=' <tr >
              <th colspan="5">Kelompok A (Umum)</th>
              </tr>';
             $a='';
              	$nox=1;
       		foreach ($A as $row) {
       		   $predikat= $this->angka_to_grade($kd_ta,$kkm,$row->nilai_pengetahuan);
       		    
       		    $outputa = '<tr>
    			<td align="center" align="center">'.$nox++.'</td>
    			<td align="left">'.$row->nm_pelajaran.'</td>
    			<td align="center">'.$row->nilai_pengetahuan.'</td>
    			<td align="center">'.$predikat.'</td>
    			<td align="left" >'.$row->desc_nilai_pengetahuan.'</td>
    			
    			</tr>';
    			
    			$a=$a.$outputa;
       		    
      
        	
       	
       		}
       		
       		$sql="SELECT `nilai`.`kd_jadwal`,`nilai`.`nilai_spritual`,`nilai`.`nilai_sosial`,`nilai`.`nilai_pengetahuan`,
			  `nilai`.`desc_nilai_pengetahuan`,`nilai`.`nilai_keterampilan`,`nilai`.`desc_nilai_keterampilan`,`jadwal`.`kd_pelajaran`,
			  `jadwal`.`id_guru`,`jadwal`.`kd_ta`,`pelajaran`.`nm_pelajaran`,`pelajaran`.`kategori`,`pelajaran`.`subkategori`,`nilai`.`nis`,kelompok
				FROM `nilai` INNER JOIN `jadwal` ON `nilai`.`kd_jadwal` = `jadwal`.`kd_jadwal` INNER JOIN `pelajaran` ON `jadwal`.`kd_pelajaran` = `pelajaran`.`kd_pelajaran` WHERE `nilai`.`nis`='".$nis."'  and jadwal.kd_ta='".$kd_ta."' and pelajaran.kelompok='B' order by pelajaran.urutan asc";
	 		$B=$this->db->query($sql)->result();
       	    $rowb=' <tr>
              <th colspan="5">Kelompok B (Umum)</th>
              </tr>';
              
              $nob=1;
              $b='';
              if($B)
              {
                  
                foreach ($B as $row) {
                    $predikat= $this->angka_to_grade($kd_ta,$kkm,$row->nilai_pengetahuan);
       			

                $outputb= '<tr>
    			<td align="center">'.$nob++.'</td>
    			<td align="left">'.$row->nm_pelajaran.'</td>
    			<td align="center">'.$row->nilai_pengetahuan.'</td>
    			<td align="center">'.$predikat.'</td>
    			<td align="left">'.$row->desc_nilai_pengetahuan.'</td>
    			
    			</tr>'
    			;
    			$b=$b. $outputb;
       		    } 
       		    $mulok='<tr>
    			<td align="center" align="center">'.$nob++.'</td>
    			<td align="left">Muatan Lokal *)</td>
    			<td align="center"></td>
    			<td align="center"></td>
    			<td align="left" ></td>
    			
    			</tr>';
    			$b=$b.$mulok;
              }
              else
              {
                  $outputb='';
              }
              
       		
       		$sql="SELECT `nilai`.`kd_jadwal`,`nilai`.`nilai_spritual`,`nilai`.`nilai_sosial`,`nilai`.`nilai_pengetahuan`,
			  `nilai`.`desc_nilai_pengetahuan`,`nilai`.`nilai_keterampilan`,`nilai`.`desc_nilai_keterampilan`,`jadwal`.`kd_pelajaran`,
			  `jadwal`.`id_guru`,`jadwal`.`kd_ta`,`pelajaran`.`nm_pelajaran`,`pelajaran`.`kategori`,`pelajaran`.`subkategori`,`nilai`.`nis`,kelompok
				FROM `nilai` INNER JOIN `jadwal` ON `nilai`.`kd_jadwal` = `jadwal`.`kd_jadwal` INNER JOIN `pelajaran` ON `jadwal`.`kd_pelajaran` = `pelajaran`.`kd_pelajaran` WHERE `nilai`.`nis`='".$nis."'  and jadwal.kd_ta='".$kd_ta."' and pelajaran.kelompok='C' order by pelajaran.urutan asc";
	 		$C=$this->db->query($sql)->result();
	 		 $rowc=' <tr >
              <th colspan="5">Kelompok C (Peminatan)</th>
              </tr>';
       	
       		$no=1;
       	    $c='';
       		foreach ($C as $row) {
       		  $predikat= $this->angka_to_grade($kd_ta,$kkm,$row->nilai_pengetahuan);  
       		
        		$outputc = '<tr>
    			<td align="center">'.$no++.'</td>
    			<td align="left">'.$row->nm_pelajaran.'</td>
    			<td align="center">'.$row->nilai_pengetahuan.'</td>
    			<td align="center">'.$predikat.'</td>
    			<td align="left">'.$row->desc_nilai_pengetahuan.'</td>
    			</tr>';
    				$c=$c. $outputc;
       	
       		}
       	$akhir='</table>';
       	$pdf->writeHTML($header.$rowa.$a.$rowb.$b.$rowc.$c.$akhir);
       $pdf->Cell(0, 0, '*) : Bila Ada', 0, 0, 'L');



        //page 4
$pdf->AddPage();
        //$pdf->SetMargins(15, 20, 10, 10);
      
        $pdf->SetFont('times', '', 12);
        $pdf->ln(0);
        $pdf->Cell(28, 0, 'Nama Sekolah', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	$pdf->Cell(85, 0, $sekolah->nm_sekolah_kecil, 0, 0, 'L');
        $pdf->Cell(28, 0, 'Kelas', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
        $pdf->Cell(10,0,$biodata->kelas,0,0,'L');
        $pdf->ln(5);
      

        $pdf->Cell(28, 0, 'Alamat', 0, 0, 'L'); 
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
        $pdf->Cell(85,0,$sekolah->alamat,0,0,'L');
        
        $pdf->Cell(28, 0, 'Semester', 0, 0, 'L');
     
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	 $pdf->Cell(10,0,$biodata->semester.'('.$ta_huruf.')',0,0,'L');
       
        $pdf->ln(5);
      	
        $pdf->Cell(28, 0, 'Nama', 0, 0, 'L');
      	 
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
        $pdf->Cell(85,0,$biodata->nm_siswa,0,0,'L');
        
        $pdf->Cell(28, 0, 'Tahun Pelajaran', 0, 0, 'L');
      
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
        $pdf->Cell(10,0,$ta->thn_ajaran,0,0,'L');
      $pdf->ln(5);
      	
        $pdf->Cell(28, 0, 'NIS/NISN', 0, 0, 'L');
      	 
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       $pdf->Cell(90,0,$biodata->nis.'/'.$biodata->nisn,0,0,'L');
         $pdf->ln(2);
         
         $pdf->Cell(188, 1, '', 'B', 1, 'L');
          $pdf->ln(5);

          $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(10, 5, 'C. Keterampilan', 0, 0, 'L');
        $pdf->ln(10);
      
      	 $pdf->SetFont('times', '', 12);
        $pdf->Cell(35, 0, 'Kriteria Ketuntasan Minimal = '.$kkmx->kkm, 0, 0, 'L');
       
        	
         $headerx ='
        <table border="1" cellpadding="3">
              <tr>
                    <th align="center" width="4%"><b>No</b></th>
                    <th width="36%" align="left"><b>  Mata Pelajaran</b> </th>
                    <th align="center" width="7%"><b> Nilai</b> </th>
                    <th align="center" width="10%"><b>Predikat</b> </th>
                    <th width="43%" align="left"><b>Deskripsi</b> </th>
              </tr>'
             ;

		$sqlka="SELECT `nilai`.`kd_jadwal`,`nilai`.`nilai_spritual`,`nilai`.`nilai_sosial`,`nilai`.`nilai_keterampilan`,`nilai`.`desc_nilai_keterampilan`,`jadwal`.`kd_pelajaran`,
			  `jadwal`.`id_guru`,`jadwal`.`kd_ta`,`pelajaran`.`nm_pelajaran`,`pelajaran`.`kategori`,`pelajaran`.`subkategori`,`nilai`.`nis`,kelompok
				FROM `nilai` INNER JOIN `jadwal` ON `nilai`.`kd_jadwal` = `jadwal`.`kd_jadwal` INNER JOIN `pelajaran` ON `jadwal`.`kd_pelajaran` = `pelajaran`.`kd_pelajaran` WHERE `nilai`.`nis`='".$nis."'  and jadwal.kd_ta='".$kd_ta."' and pelajaran.kelompok='A' order by pelajaran.urutan asc";
	 		$KA=$this->db->query($sqlka)->result();
       	 $rowax=' <tr >
              <th colspan="5">Kelompok A (Umum)</th>
              </tr>';
       		$no=1;
       		$aax='';
       		
       		foreach ($KA as $rka) {
       		    $predikat= $this->angka_to_grade($kd_ta,$kkm,$rka->nilai_keterampilan); 
       		 
        		
            	$outputax = '<tr>
    			<td align="center">'.$no++.'</td>
    			<td align="left">'.$rka->nm_pelajaran.'</td>
    			<td align="center">'.$rka->nilai_keterampilan.'</td>
    			<td align="center">'.$predikat.'</td>
    			<td align="left">'.$rka->desc_nilai_keterampilan.'</td>
    			
    			</tr>';
    				$aax=$aax.$outputax;
    				
               
               
  

       	
       		}
       		$sqlkb="SELECT `nilai`.`kd_jadwal`,`nilai`.`nilai_spritual`,`nilai`.`nilai_sosial`,`nilai`.`nilai_pengetahuan`,
			  `nilai`.`desc_nilai_pengetahuan`,`nilai`.`nilai_keterampilan`,`nilai`.`desc_nilai_keterampilan`,`jadwal`.`kd_pelajaran`,
			  `jadwal`.`id_guru`,`jadwal`.`kd_ta`,`pelajaran`.`nm_pelajaran`,`pelajaran`.`kategori`,`pelajaran`.`subkategori`,`nilai`.`nis`,kelompok
				FROM `nilai` INNER JOIN `jadwal` ON `nilai`.`kd_jadwal` = `jadwal`.`kd_jadwal` INNER JOIN `pelajaran` ON `jadwal`.`kd_pelajaran` = `pelajaran`.`kd_pelajaran` WHERE `nilai`.`nis`='".$nis."'  and jadwal.kd_ta='".$kd_ta."' and pelajaran.kelompok='B' order by pelajaran.urutan asc";
	 		$KB=$this->db->query($sqlkb)->result();
       	    $rowbx=' <tr >
              <th colspan="5">Kelompok B (Umum)</th>
              </tr>';
       		$no=1;
       		$bbx='';
       		foreach ($KB as $rkb) {
       		    $predikat= $this->angka_to_grade($kd_ta,$kkm,$rkb->nilai_keterampilan); 
                	$outputbx = '<tr>
    			<td align="center">'.$no++.'</td>
    			<td align="left">'.$rkb->nm_pelajaran.'</td>
    			<td align="center">'.$rkb->nilai_keterampilan.'</td>
    			<td align="center">'.$predikat.'</td>
    			<td align="left">'.$rkb->desc_nilai_keterampilan.'</td>
    			
    			</tr>';
    				$bbx=$bbx. $outputbx;
        		

       		}
       		$mulok='<tr>
    			<td align="center" align="center">'.$no++.'</td>
    			<td align="left">Muatan Lokal *)</td>
    			<td align="center"></td>
    			<td align="center"></td>
    			<td align="left" ></td>
    			
    			</tr>';
    			$bbx=$bbx.$mulok;
       		$sqlkc="SELECT `nilai`.`kd_jadwal`,`nilai`.`nilai_spritual`,`nilai`.`nilai_sosial`,`nilai`.`nilai_pengetahuan`,
			  `nilai`.`desc_nilai_pengetahuan`,`nilai`.`nilai_keterampilan`,`nilai`.`desc_nilai_keterampilan`,`jadwal`.`kd_pelajaran`,
			  `jadwal`.`id_guru`,`jadwal`.`kd_ta`,`pelajaran`.`nm_pelajaran`,`pelajaran`.`kategori`,`pelajaran`.`subkategori`,`nilai`.`nis`,kelompok
				FROM `nilai` INNER JOIN `jadwal` ON `nilai`.`kd_jadwal` = `jadwal`.`kd_jadwal` INNER JOIN `pelajaran` ON `jadwal`.`kd_pelajaran` = `pelajaran`.`kd_pelajaran` WHERE `nilai`.`nis`='".$nis."'  and jadwal.kd_ta='".$kd_ta."' and pelajaran.kelompok='C' order by pelajaran.urutan asc";
	 		$KC=$this->db->query($sqlkc)->result();
       		
       		$rowcx=' <tr >
              <th colspan="5">Kelompok C (Peminatan)</th>
              </tr>';
       		$pdf->ln(6);
       		$no=1;
       		$ccx='';
       		foreach ($KC as $rkc) {
       			$predikat= $this->angka_to_grade($kd_ta,$kkm,$rkc->nilai_keterampilan); 

               	$outputcx = '<tr>
    			<td align="center">'.$no++.'</td>
    			<td align="left">'.$rkc->nm_pelajaran.'</td>
    			<td align="center">'.$rkc->nilai_keterampilan.'</td>
    			<td align="center">'.$predikat.'</td>
    			<td align="left">'.$rkc->desc_nilai_keterampilan.'</td>
    			
    			</tr>';
    				$ccx=$ccx. $outputcx;
                
       	
       		}
       			$akhirx='</table>';
       	$pdf->writeHTML($headerx.$rowax.$aax.$rowbx.$bbx.$rowcx.$ccx.$akhirx);
         $pdf->Cell(0, 0, '*) : Bila Ada', 0, 0, 'L');
         
        //page
        $pdf->AddPage();
       // $pdf->SetMargins(15, 10, 10, 10);
      
        $pdf->SetFont('times', '', 12);
       
        $pdf->Cell(28, 0, 'Nama Sekolah', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	$pdf->Cell(85, 0, $sekolah->nm_sekolah_kecil, 0, 0, 'L');
        $pdf->Cell(28, 0, 'Kelas', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
        $pdf->Cell(10,0,$biodata->kelas,0,0,'L');
        $pdf->ln(5);
      

        $pdf->Cell(28, 0, 'Alamat', 0, 0, 'L'); 
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
        $pdf->Cell(85,0,$sekolah->alamat,0,0,'L');
        
        $pdf->Cell(28, 0, 'Semester', 0, 0, 'L');
     
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	 $pdf->Cell(10,0,$biodata->semester.'('.$ta_huruf.')',0,0,'L');
       
        $pdf->ln(5);
      	
        $pdf->Cell(28, 0, 'Nama', 0, 0, 'L');
      	 
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
        $pdf->Cell(85,0,$biodata->nm_siswa,0,0,'L');
        
        $pdf->Cell(28, 0, 'Tahun Pelajaran', 0, 0, 'L');
      
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
        $pdf->Cell(20,0,$ta->thn_ajaran,0,0,'L');
      $pdf->ln(5);
      	
        $pdf->Cell(28, 0, 'NIS/NISN', 0, 0, 'L');
      	 
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       $pdf->Cell(90,0,$biodata->nis.'/'.$biodata->nisn,0,0,'L');
         $pdf->ln(2);
         
         $pdf->Cell(188, 1, '', 'B', 1, 'L');
          $pdf->ln(5);

         $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(10, 5, 'D. Ekstra Kurikuler', 0, 0, 'L');
        $pdf->ln(6);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
       	$pdf->Cell(68, 10, '  Kegiatan Ekstra Kurikuler', 1, 0, 'L');
        $pdf->Cell(30, 10, 'Predikat', 1, 0, 'C');
       	$pdf->Cell(80, 10, 'Deskripsi', 1, 0, 'C');
       	$pdf->ln();
       	$pdf->SetFont('times', '', 12);
       	$pdf->Cell(10, 6, '1', 1, 0, 'C');
       	$pdf->Cell(68, 6, '  ', 1, 0, 'L');
        $pdf->Cell(30, 6, '', 1, 0, 'C');
       	$pdf->Cell(80, 6, '', 1, 0, 'C');
       	$pdf->ln(10);


         $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(10, 5, 'E. Prestasi', 0, 0, 'L');
       $pdf->ln(6);

        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
       	$pdf->Cell(80, 10, '  Jenis Prestasi', 1, 0, 'L');
       	$pdf->Cell(98, 10, 'Keterangan', 1, 0, 'C');
       	$pdf->ln();

       	$pdf->SetFont('times', '', 12);
       	 $pdf->Cell(10, 6, '1', 1, 0, 'C');
       	$pdf->Cell(80, 6, '  ', 1, 0, 'L');
       	$pdf->Cell(98, 6, '', 1, 0, 'L');
       	$pdf->ln(10);

       	$sqlx="SELECT  `absen`.`nis`,  `absen`.`izin`,  `absen`.`hadir`,  `absen`.`sakit`,  `absen`.`alpa`,  `jadwal`.`kd_ta`
			FROM  `absen`    INNER JOIN `jadwal` ON `absen`.`kd_jadwal` = `jadwal`.`kd_jadwal` WHERE  `absen`.`nis`='".$nis."' and jadwal.kd_ta='".$kd_ta."'";
			$absensi=$this->db->query($sqlx)->result();
			
			$sakit=0;
			$izin=0;
			$alpa=0;
			
			foreach($absensi as $absen)
			{
				$izin=$absen->izin;
				$sakit=$absen->sakit;
				$alpa=$absen->alpa;
			}

         $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(10, 5, 'F. Ketidak Hadiran', 0, 0, 'L');
       $pdf->ln(6);

        $pdf->SetFont('times', '', 12);
         $pdf->Cell(50, 6, 'Sakit', 1, 0, 'L');
         $pdf->Cell(20, 6, $sakit.' Hari', 1, 0, 'C');
         
		 $pdf->ln(6);
       	$pdf->Cell(50, 6, 'Izin', 1, 0, 'L');
       	$pdf->Cell(20, 6, $izin. ' Hari', 1, 0, 'C');
		 $pdf->ln(6);
		 $pdf->Cell(50, 6, 'Tanpa Keterangan', 1, 0, 'L');
		 $pdf->Cell(20, 6, $alpa.' Hari', 1, 0, 'C');
		 $pdf->ln(6);
       	$pdf->ln();

         $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(10, 5, 'G. Catatan Wali Kelas', 0, 0, 'L');
        $pdf->ln(6);
         $pdf->Cell(187,20 , '',1, 1, 'L');
        
         $pdf->SetFont('times', 'B', 12);
 $pdf->ln(5);
        $pdf->Cell(10, 5, 'H. Tanggapan Orang Tua / Wali', 0, 0, 'L');
         $pdf->ln(6);
        $pdf->Cell(187, 20,'' , 1, 1, 'L');
        
        $pdf->ln(4);
        //peringkat
         
         $tanggalcetak = date('Y-m-d');
        $tanggalcetak=$this->Crud_model->date_indo($tanggalcetak);

		$pdf->SetFont('times', '', 12);
         $pdf->Cell(6);
       	$pdf->Cell(80, 5, ' Mengetahui, ', 0, 0, 'C');
       		$pdf->Cell(15, 5, '  ', 0, 0, 'C');
       	$pdf->Cell(80, 5, ' Lakorua, '.$tanggalcetak, 0, 0, 'C');
       	$pdf->ln();
       	 $pdf->Cell(6);
       	$pdf->Cell(80, 5, ' Orang Tua/Wali, ', 0, 0, 'C');
       		$pdf->Cell(15, 5, '  ', 0, 0, 'C');
       	$pdf->Cell(80, 5, ' Wali Kelas,', 0, 0, 'C');
       	$pdf->ln(25);
       	  $pdf->Cell(6);
       	$pdf->Cell(80, 5, '  .........................., ', 0, 0, 'C');
       		$pdf->Cell(15, 5, '  ', 0, 0, 'C');
       	$pdf->Cell(80, 5, $nm_wali_kelas, 0, 0, 'C');
       	$pdf->ln(1);
       	 $pdf->Cell(116);
        $pdf->Cell(50, 1, '', 'B', 1, 'L');
       	//$pdf->ln(6);
       	  $pdf->Cell(6);
       	$pdf->Cell(80, 5, '  ', 0, 0, 'C');
       	$pdf->Cell(30, 5, '  ', 0, 0, 'C');
       	
       	$pdf->Cell(80, 5, 'NIP. '.$nip_wali_kelas, 0, 0, 'L');
       	 
       	$pdf->ln(15);
         $pdf->Cell(80);
       	$pdf->Cell(20, 5, ' Mengetahui, ', 0, 0, 'C');
       		$pdf->ln();
       		$pdf->Cell(80);
       	$pdf->Cell(20, 5, ' Kepala Sekolah, ', 0, 0, 'C');

       	$pdf->ln(25);
         $pdf->Cell(80);
       	$pdf->Cell(20, 5, $sekolah->kasek, 0, 0, 'C');
       	 $pdf->ln(1);
         $pdf->Cell(65);
         $pdf->Cell(50, 1, '', 'B', 1, 'L');
       //$pdf->Line(float x1, float y1, float x2, float y2)
      // $pdf->Line(80,276,150,276);
       	
       	
       		$pdf->Cell(80);
       	$pdf->Cell(20, 5, ' NIP. '.$sekolah->nip_kasek, 0, 0, 'C');


          $pdf->Output('e-Rapor-'.$biodata->nis.'-'.$biodata->nm_siswa.'.pdf','I');
    }
    
    function lap_bulanan_siswa($bulan,$nis)
    {
        
    }
    
    
    
}

?>
