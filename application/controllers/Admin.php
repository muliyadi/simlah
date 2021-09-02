<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public $view='admin/template';
        
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
    public function laporan_pdf(){
$this->load->library('pdf');
  $data['users']=array(
   array('firstname'=>'I am','lastname'=>'Programmer','email'=>'iam@programmer.com'),
   array('firstname'=>'I am','lastname'=>'Designer','email'=>'iam@designer.com'),
   array('firstname'=>'I am','lastname'=>'User','email'=>'iam@user.com'),
   array('firstname'=>'I am','lastname'=>'Quality Assurance','email'=>'iam@qualityassurance.com')
  );
    $html = $this->load->view('welcome_message', $data, true);
    $filename = 'report_'.time();
    $this->pdf->generate($html, $filename, true, 'A4', 'portrait');
        

}
    function test()
    {
        $warna=array();
        $sql="SELECT DISTINCT kd_pelajaran,nm_pelajaran FROM `vjadwalpelajaran` where tahun='2020' AND kelas='X-MIPA-1'";
        $pelajaran=$this->db->query($sql)->result();
        
        
        foreach ($pelajaran as $x)
        {
            $data['kd_pelajaran']=$x->kd_pelajaran;
                    $data['nm_pelajaran']=$x->nm_pelajaran;
            $key['nis']='1400';
            $key['tahun']='2020';
            $key['semester']='1';
            $key['kd_pelajaran']=$x->kd_pelajaran;
            $nilai=$this->Crud_model->get_row_selected('vnilai_rekap',$key);
            if($nilai)
            {
                    
                    
                        $data['nilai_spritual_1']=$nilai->nilai_spritual;
                        $data['nilai_sosial_1']=$nilai->nilai_sosial;
                        $data['nilai_pengetahuan_1']=$nilai->nilai_pengetahuan;
                        $data['nilai_keterampilan_1']=$nilai->nilai_keterampilan;
                        
                    
            }
            $key2['nis']='1400';
            $key2['tahun']='2020';
            $key2['semester']='2';
            $key2['kd_pelajaran']=$x->kd_pelajaran;
            $nilai=$this->Crud_model->get_row_selected('vnilai_rekap',$key2);
            if($nilai)
            {
       
                    
                        $data['nilai_spritual_2']=$nilai->nilai_spritual;
                        $data['nilai_sosial_2']=$nilai->nilai_sosial;
                        $data['nilai_pengetahuan_2']=$nilai->nilai_pengetahuan;
                        $data['nilai_keterampilan_2']=$nilai->nilai_keterampilan;
                        
                    
            }
            $data['rata_pengetahuan']=round(($data['nilai_pengetahuan_1']+$data['nilai_pengetahuan_2'])/2,0);
             $data['rata_keterampilan']=round(($data['nilai_keterampilan_1']+$data['nilai_keterampilan_2'])/2,0);
            array_push($warna,$data); 
            
           
        }
        echo json_encode($warna);
         echo '<br>';
          echo '<br>';
     echo json_encode($nilai);
        
      
       
       
   
        
    }
 
    public function skl_ipss($ta)
	{
	     $this->Crud_model->skl_ipss($ta);
	}
	function cek()
	{
		$level=$this->session->userdata('level');
		if($level!='admin')
		{
			$this->session->sess_destroy();
			unset($_SESSION[$sess_data]);
			redirect(base_url());
		}
	}
	function get_semester_siswa($angkatan,$ta)
    {
        $semester=0;
        $tahun=substr($ta,0,4);
       // //$tahun=intval($tahun);
        $selisih=$tahun-$angkatan;
        $akhir=substr($ta,-1);
       if($akhir=='1')
       {
           $semester=$selisih+1+$selisih;
       }else
       {
           $semester=$selisih+2+$selisih;
       }
        echo $semester;
    }
	
    public function index()
    {
		$this->cek();
		$data['title']='SIAKAD';
		$data['menu']=' admin';
		
		$key['aktif']='Ya';
		$data['profil']=$this->Crud_model->get_row_selected('profil',$key);
		$this->template->load('admin/template', 'admin/dashboards', $data);
	}
	
    public function backup() {
	    
	    $this->load->dbutil();
		$this->load->helper('file');
		$config = array(
			'format'	=> 'zip',
			'filename'	=> 'database_smu1masteng.sql'
		);
		
		$backup = $this->dbutil->backup($config);
 
        $nama_database = 'database_smu1masteng_backup_on_'. date("Y-m-d-H-i-s") .'.zip';
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
        	//redirect('wakasekkurikulum/list_backup');
	}

	function koreksi_siswa_kelas()
    {
         $this->backup();
        $list_jadwal=$this->Crud_model->get_all('jadwal');
        foreach($list_jadwal as $rows)
        {
            echo $this->koreksi_kelas($rows->kd_jadwal).'<br>';
           
        }
    }
    
    function koreksi_kelas($kd_jadwal)
    {
       
        $nis='';
        $kelassiswa='';
        $keyjadwal['kd_jadwal']=$kd_jadwal;
        $jadwal=$this->Crud_model->get_row_selected('jadwal',$keyjadwal);
        $kelas=$jadwal->kelas;
        $keysiswa['kd_jadwal']=$kd_jadwal;
        $list=$this->Crud_model->get_list_selected('nilai',$keysiswa);
        foreach($list as $row)
        {
            $keys['nis']=$row->nis;
            
            $siswa=$this->Crud_model->get_row_selected('siswa',$keys);
            if($siswa)
            {
                $kelassiswa=$siswa->kelas;
                if($kelassiswa != $kelas)
                {
                 $nis= $row->nis;
                 $keydelete['nis']=$nis;
                 $keydelete['kd_jadwal']=$kd_jadwal;
                 $this->Crud_model->delete_data('nilai',$keydelete);
                 return 'NIS: '.$nis.'/ Kode Jadwal: '.$kd_jadwal;
                }
            }
            
        }
       
    }
	
	
	
	
	
   


    

}

?>