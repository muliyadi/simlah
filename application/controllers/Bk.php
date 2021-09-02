<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bk extends CI_Controller
{
    public $view='bk/template';
        
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
		if($level!='bk')
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
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$data['jumlah_siswa']=$this->Crud_model->totalRows('siswa');
		$filter['status']='Keluar';
		$data['jumlah_siswa_keluar']=$this->Crud_model->total_rows_filter('siswa',$filter);
		$filter2['status']='aktif';
		$data['jumlah_siswa_aktif']=$this->Crud_model->total_rows_filter('siswa',$filter2);
		$this->template->load($this->view, 'bk/dashboards', $data);
	}
	function point_siswa()
	{
	    $kd_ta=$this->session->userdata('kd_ta');
	    	$data['menu']=' '.$this->session->userdata('nm_sekolah');
	     $sql="SELECT siswa.nisn,siswa.image,point_siswa.nis,point_siswa.kd_ta,siswa.nm_siswa,siswa.kelas,siswa.nama_ayah,siswa.nama_ibu,siswa.nama_wali,point_siswa.debit,point_siswa.kredit,point_siswa.bulan,point_siswa.debit-point_siswa.kredit as saldo 
	     FROM `point_siswa`,siswa 
	     where point_siswa.nis=siswa.nis and kd_ta='".$kd_ta."' order by bulan,kelas,nis DESC";
	    $data['list']=$this->db->query($sql)->result();
	    $this->template->load($this->view, 'bk/point_siswa/list_point_siswa', $data);
	}
	
	function input_point_siswa()
	{
	    $this->cek();
	    $data['menu']=' '.$this->session->userdata('nm_sekolah');
	    $kd_ta=$this->session->userdata('kd_ta');
	
		$data['list_ta']=$this->Crud_model->get_all('thnajaran');
		$data['kd_ta']=$kd_ta;
		$keysiswa['status']='Aktif';
		$data['list_siswa']='';
		$data['list_kelas']=$this->Crud_model->get_all('kelas');
		$data['list_bulan']=$this->Crud_model->get_all('bulan');
		$this->template->load($this->view, 'bk/point_siswa/input_point_siswa', $data);
	}
	function nilai_ekstra()
	{
	    $kd_ta=$this->session->userdata('kd_ta');
	    $this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
	    $sql="SELECT distinct mnilai.angka, nilai_ekstrakurikuler.kd_ta, nilai_ekstrakurikuler.kd_ekstra,nilai_ekstrakurikuler.nis,siswa.nm_siswa,siswa.kelas,siswa.image,nilai_ekstrakurikuler.deskripsi,mnilai.nilai
	    from nilai_ekstrakurikuler,siswa,mnilai
	    where nilai_ekstrakurikuler.nis=siswa.nis and nilai_ekstrakurikuler.nilai=mnilai.angka and nilai_ekstrakurikuler.kd_ta='".$kd_ta."' 
	    ORDER BY kd_ekstra,siswa.kelas, `siswa`.`nm_siswa` ASC";
	    $data['kd_ta']=$kd_ta;
	     $data['list']=$this->db->query($sql)->result();
	    	$this->template->load($this->view, 'bk/nilai/view_nilai_ekstra', $data);
	}
	function finput_nilai_ekstra()
	{
	    	$data['menu']=' '.$this->session->userdata('nm_sekolah');
	    $data['list_kelas']=$this->Crud_model->get_all('kelas');
	    $data['list_ta']=$this->Crud_model->get_all('thnajaran');
	    $data['list_ekstra']=$this->Crud_model->get_all('ekstra_kurikuler');
	    $data['kd_ta']=$this->input->post('kd_ta');
	    
	    	$this->template->load($this->view, 'bk/nilai/list_kelas', $data);
	}
	function ajax_update_nilai_ekstra()
	{
		$pesan='Gagal';
		
	
		$data['nilai']=$this->input->post('nilai');
		$data['deskripsi']=$this->input->post('deskripsi');
	    
		$data['tgl_update']=date("Y-m-d h:i:s");
		$data['user']=$this->session->userdata('userid');
		$data['status']='aktif';
		
			$key['nis']=$this->input->post('nis');
			$key['kd_ta']=$this->input->post('kd_ta');
			$key['kd_ekstra']=$this->input->post('kd_ekstra');
		
		$cek=$this->Crud_model->get_row_selected('nilai_ekstrakurikuler',$key);
		if(!empty($cek))
		{
		    
			$this->Crud_model->update_data('nilai_ekstrakurikuler',$data,$key);
			$pesan="Updated";
		}
		else
		{
            		$data['nis']=$this->input->post('nis');
			$data['kd_ta']=$this->input->post('kd_ta');
			$data['kd_ekstra']=$this->input->post('kd_ekstra');
			$this->Crud_model->save_data('nilai_ekstrakurikuler',$data);
			$pesan="Saved";
		}
		echo $pesan;
	}
	function input_nilai_ekstra()
	{
		$this->cek();
		//$this->cek_status_nilai($jadwal);
	    $kd_ta=$this->input->post('kd_ta');
	    $kelas=$this->input->post('kelas');
	    $kd_ekstra=$this->input->post('kd_ekstra');
	    $data['kd_ta']=$kd_ta;
		$key['kelas']=$kelas;
		$key['status']='Aktif';
		
		//$key2['kd_jadwal']=$jadwal;
		
		$list=$this->Crud_model->get_list_selected('siswa',$key);
		
		
		foreach ($list as $row ) {
            $x['nis']=$row->nis;
			$x['kd_ta']=$kd_ta;
			$x['kd_ekstra']=$kd_ekstra;
			
			$cek=$this->Crud_model->get_row_selected('nilai_ekstrakurikuler',$x);
			if(empty($cek))
			{
			    $x['kelas']=$kelas;
			$x['nilai']=0;
				$this->Crud_model->save_data('nilai_ekstrakurikuler',$x);
				//echo json_encode(value)
			}
		}
		$keyekstra['kd_ekstra']=$kd_ekstra;
    //$data['ekstra']=$this->Crud_model->get_row_selected('ekstra_kurikuler',$keyekstra);
		$data['list_nilai']=$this->query_nilai_ekstra($kd_ta,$kelas,$kd_ekstra);
		$data['kelas']=$kelas;
		$data['kd_ekstra']=$kd_ekstra;
		$data['menu']=$this->session->userdata('nm_sekolah');
		$data['mnilai']=$this->Crud_model->get_all('mnilai');
		$this->template->load($this->view, 'bk/nilai/input_nilai', $data);
	}
	
	function query_nilai_ekstra($kd_ta,$kelas,$kd_ekstra)
	{
	    $sql="SELECT nilai_ekstrakurikuler.kd_ta,nilai_ekstrakurikuler.nis,nilai_ekstrakurikuler.kd_ekstra,nilai_ekstrakurikuler.nilai,nilai_ekstrakurikuler.deskripsi,siswa.nm_siswa,siswa.kelas 
	    FROM `nilai_ekstrakurikuler`,siswa 
	    WHERE  nilai_ekstrakurikuler.nis=siswa.nis and nilai_ekstrakurikuler.kd_ta='".$kd_ta."' and nilai_ekstrakurikuler.kd_ekstra='".$kd_ekstra."'  and siswa.kelas='".$kelas."'";
         $data=$this->db->query($sql)->result();
         return $data;
	}
	function input_nilai_ektra2()
	{
	    $data['menu']=' '.$this->session->userdata('nm_sekolah');
	    $kd_ta=$this->session->userdata('kd_ta');
		$keyta['kd_ta']=$kd_ta;
		$data['list_ta']=$this->Crud_model->get_list_selected('thnajaran',$keyta);
		$data['kd_ta']=$kd_ta;
		$keysiswa['status']='Aktif';
	    $data['list_siswa']=$this->Crud_model->get_list_selected('siswa',$keysiswa);
	    
		$data['list_ekstra']=$this->Crud_model->get_all('ekstra_kurikuler');
		$data['kd_ta']=$kd_ta;
		$data['list_kelas']=$this->Crud_model->get_all('kelas');
		$data['list_nilai']=$this->Crud_model->get_all('mnilai');
		$this->template->load($this->view, 'bk/nilai/input_nilai', $data);
	}
	function save_nilai_ekstra()
	{
	    //$data['menu']=' '.$this->session->userdata('nm_sekolah');
	    $data['nis']=$this->input->post('nis');
	    $data['kd_ta']=$this->input->post('kd_ta');
	    $data['kd_ekstra']=$this->input->post('kd_ekstra');
	    $data['nilai']=$this->input->post('nilai');
	  
	    $this->Crud_model->save_data('nilai_ekstrakurikuler',$data);
	    $pesan=array("cek_type"=>'info',"cek_pesan"=>"<h4>Nilai Ekstra Siswa ini berhasil tersimpan!</h4>");
			$this->session->set_flashdata($pesan);
	    redirect('bk/input_nilai_ektra');
	}
	
	public function get_siswa_kelas()
	{
	    $kd_ta=$this->input->post('kd_ta');
	    $kd_ekstra=$this->input->post('kd_ekstra');
	    $kelas=$this->input->post('kelas');
	    
	    $sql="select nis,nm_siswa from siswa where nis not in (select nis from nilai_ekstrakurikuler where kd_ta='".$kd_ta."' and kd_ekstra='".$kd_ekstra."') and siswa.kelas='".$kelas."'";
	     $data=$this->db->query($sql)->result();
	   
	    echo json_encode($data);
	}
	function absensi()
	{
	    $this->cek();
		$data['menu']=' '.$this->session->userdata('nm_sekolah');
		$kd_ta=$this->session->userdata('kd_ta');
		$keyta['kd_ta']=$kd_ta;
		$data['list_absensi']=$this->Crud_model->get_list_selected('absen_harian',$kd_ta);
		$data['list_ta']=$this->Crud_model->get_list_selected('thnajaran',$kd_ta);
	
		$this->template->load($this->view, 'bk/dashboards', $data);
	}

	function input_absen()
	{
	    $this->cek();
	    $data['menu']=' '.$this->session->userdata('nm_sekolah');
	    $kd_ta=$this->session->userdata('kd_ta');
	
		$data['list_ta']=$this->Crud_model->get_all('thnajaran');
		$data['kd_ta']=$kd_ta;
		$keysiswa['status']='Aktif';
		
		
		//$bulan=$this->get_bulan_terakhir_absen($kd_ta);
		//$bulan=$hasil->bulan;
		$data['list_siswa']='';
		$data['list_kelas']=$this->Crud_model->get_all('kelas');
		$data['list_bulan']=$this->Crud_model->get_all('bulan');
		$this->template->load($this->view, 'bk/absen/input_absen', $data);
	}
	public function save_absen()
	{
	    $data['nis']=$this->input->post('nis',true);
	    $data['bulan']=$this->input->post('bulan',true);
	    $data['kd_ta']=$this->input->post('kd_ta',true);
	    $data['hadir']=$this->input->post('hadir',true);
	    $data['izin']=$this->input->post('izin',true);
	    $data['sakit']=$this->input->post('sakit',true);
	    $data['alpa']=$this->input->post('alpa',true);
	    $data['bolos']=$this->input->post('bolos',true);
	    $data['tgl_update']=date("Y-m-d");
	    $this->Crud_model->save_data('absen_harian',$data);
	    	$pesan=array("cek_type"=>'info',"cek_pesan"=>"<h4>Absen Siswa Berhasil Tersimpan.!!</h4>");
				$this->session->set_flashdata($pesan);
	    redirect('bk/input_absen');
	    
	}
	function lap_absen_siswa_f()
	{
	    $this->cek();
	    $data['menu']=' '.$this->session->userdata('nm_sekolah');
	    $kd_ta=$this->session->userdata('kd_ta');
		$data['list_ta']=$this->Crud_model->get_all('thnajaran');
		$data['kd_ta']=$kd_ta;
		$data['list_kelas']=$this->Crud_model->get_all('kelas');
		$data['list_bulan']=$this->Crud_model->get_all('bulan');
		$this->template->load($this->view, 'bk/absen/lap_absen_siswa_f', $data);
	}
	function lap_absen_siswa()
	{
	   $this->cek();
	   $data['menu']=' '.$this->session->userdata('nm_sekolah');
	   $kelas=$this->input->post('kelas',true);
	   $bulan=$this->input->post('bulan',true);
	   $kd_ta=$this->input->post('kd_ta',true);
	   $data['kd_ta']=$kd_ta;
	   $keybulan['angka']=$bulan;
	   $hasil_bulan=$this->Crud_model->get_row_selected('bulan',$keybulan);
	   $data['bulan']=$hasil_bulan->huruf;
	   $data['kelas']=$kelas;
	   
	   $data['list']=$this->get_lap_absen_siswa($kd_ta,$bulan,$kelas);
	   $this->template->load($this->view, 'bk/absen/lap_absen_siswa_r', $data);
	    
	}
	function get_lap_absen_siswa($kd_ta,$bulan,$kelas)
	{
	    $sql="SELECT bulan.huruf as bulan,siswa.no_hp,absen_harian.kd_ta,absen_harian.nis,siswa.nm_siswa,siswa.kelas,hadir,izin,sakit,alpa FROM `absen_harian`,siswa,bulan WHERE absen_harian.nis=siswa.nis and absen_harian.bulan=bulan.angka and absen_harian.kd_ta='".$kd_ta."' and siswa.kelas='".$kelas."' and bulan='".$bulan."' ORDER by absen_harian.nis ASC";
	    $data=$this->db->query($sql)->result();
		return $data;
	}
	public function get_bulan_terakhir_absen($kd_ta)
	{
	    
	    $sql="select distinct bulan from absen_harian where kd_ta='".$kd_ta."' order by bulan desc limit 1";
	    $data=$this->db->query($sql)->row();
	    if($data)
	    {
	        $hasil=$data->bulan;
	    }else
	    {
	        $hasil='0';
	    }
		 //echo json_encode($data);
		 return $hasil;
	}
	function get_siswa_not_in_absen($kd_ta,$bulan)
	{
	    $sql="select nis,nm_siswa from siswa where nis not in (select nis from absen_harian where kd_ta='".$kd_ta."' and bulan='".$bulan."') and status='Aktif'";
	    $data=$this->db->query($sql)->result();
		 return $data;
	}
	public function ajax_get_siswa_not_in_absen()
	{
	    $kd_ta=$this->input->post('kd_ta',true);
	    $bulan=$this->input->post('bulan',true);
	     $kelas=$this->input->post('kelas',true);
	    
	    $sql="select nis,nm_siswa from siswa where nis not in (select nis from absen_harian where kd_ta='".$kd_ta."' and bulan='".$bulan."') and status='Aktif' and siswa.kelas='".$kelas."'";
	    $data=$this->db->query($sql)->result();
		 echo json_encode($data);
		 //return $data;
	}
	
	public function ajax_get_siswa_not_in_point()
	{
	    $kd_ta=$this->input->post('kd_ta',true);
	    $bulan=$this->input->post('bulan',true);
	     $kelas=$this->input->post('kelas',true);
	    
	    $sql="select nis,nm_siswa from siswa where nis not in (select nis from point_siswa where kd_ta='".$kd_ta."' and bulan='".$bulan."') and status='Aktif' and siswa.kelas='".$kelas."'";
	    $data=$this->db->query($sql)->result();
		 echo json_encode($data);
		 //return $data;
	}
	
	

	
	
	
	
	
   


    

}

?>