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
class Login extends CI_Controller {

	public $view='siswa/template';
    function __construct() {
		parent::__construct();
	 $this->load->model('Crud_model');
        $this->load->library('form_validation');
        $this->load->library('user_agent');
	
    }

    function index() {
	$cek = $this->session->userdata('logged_in');
	if (empty($cek)) {
	    
	    
        $data='';
	    $this->load->view('welcome', $data);
	} else {
	   $this->logout();
	}
    }
    
    public function login_guru()
    {
        	    $data = array('userid' => '', 'password' => '');
		$data['title']='Sistem Informasi Manajemen Sekolah';
		$data['nama_sekolah']='SMA NEGERI 1 MAWASANGKA';
		$keysekolah['status']=1;
		$sekolah=$this->Crud_model->get_row_selected('sekolah',$keysekolah);
		 $sess_data['nm_sekolah'] = $sekolah->nm_sekolah_kecil;
        $this->session->set_userdata($sess_data);
        $this->load->view('login_guru', $data);
    }
     public function login_siswa()
    {
        	    $data = array('userid' => '', 'password' => '');
		$data['title']='Sistem Informasi Manajemen Sekolah';
		$data['nama_sekolah']='SMA NEGERI 1 MAWASANGKA';
		$keysekolah['status']=1;
		$sekolah=$this->Crud_model->get_row_selected('sekolah',$keysekolah);
		 $sess_data['nm_sekolah'] = $sekolah->nm_sekolah_kecil;
        $this->session->set_userdata($sess_data);
        $this->load->view('login_siswa', $data);
    }
    public function login_staff()
    {
        	    $data = array('userid' => '', 'password' => '');
		$data['title']='Sistem Informasi Manajemen Sekolah';
		$data['nama_sekolah']='SMA NEGERI 1 MAWASANGKA';
		$keysekolah['status']=1;
		$sekolah=$this->Crud_model->get_row_selected('sekolah',$keysekolah);
		 $sess_data['nm_sekolah'] = $sekolah->nm_sekolah_kecil;
        $this->session->set_userdata($sess_data);
        $this->load->view('login_staff', $data);
    }
   
	
    public function loginx() {
        $this->load->helper('security');
		$this->load->model('Crud_model');
        $u =$this->input->post('userid', TRUE);
        $p =$this->input->post('password', TRUE);

        $data['userid']=$u;
		$data['password']=($p);
		$data['status']='1';
		
        $user = $this->Crud_model->get_row_selected('user',$data);
        $keyta['status']='Aktif';
        $ta=$this->Crud_model->get_row_selected('thnajaran',$keyta);

        //echo json_encode($user);
       //$this->get_useri();
        $homebase='ALL';
        if ($user) {
            
            $sess_data['userid'] = $user->userid;
            $sess_data['nm_user'] = $user->username;
			$sess_data['kd_ta'] = $ta->kd_ta;
			$sess_data['level']=$user->level;
			$sess_data['logged_in']=1;

			if($user->level=='guru')
			{
				$keykelas['id_guru']=$u;
				$keyguru['id_guru']=$u;
				$kelas=$this->Crud_model->get_row_selected('kelas',$keykelas);
				if($kelas)
				{
				    $homebase=$kelas->id_kelas;
				}$tujuan='guru';
				$guru=$this->Crud_model->get_row_selected('guru',$keyguru);
				$sess_data['img']=$guru->image;
				$sess_data['template']='tguru';
				$sess_data['home']='hguru';
				
				
			}elseif($user->level=='siswa')
			{
			    	$keysiswa['nis']=$u;
				$siswa=$this->Crud_model->get_row_selected('siswa',$keysiswa);
				$sess_data['img']=$siswa->image;
					$sess_data['template']='tsiswa';
						$sess_data['home']='hsiswa';
				$tujuan='siswa';
			}elseif($user->level=='kesiswaan')
			{
			    $tujuan='kesiswaan';
			    $sess_data['template']='tkesiswaan';
			    $sess_data['home']='hkesiswaan';
			}
			elseif($user->level=='admin')
			{
				$tujuan='admin';
				 $sess_data['template']='tadmin';
				  $sess_data['home']='hadmin';

			}elseif($user->level=='kasek')
			{
				$tujuan='kasek/jadwal';
				$sess_data['template']='tkasek';
					$sess_data['home']='hkasek';
			}elseif($user->level=='wali_kelas')
			{
				$keyu['id_guru']=$u;
			    $kelas=$this->get_row_selected('kelas',$keyu);
			    if($kelas)
			    {
			        $sess_data['kelas']=$kelas->id_kelas;
			    }
			    
				$tujuan='walikelas/jadwal';
					$sess_data['template']='walikelas';
			}elseif($user->level=='wakasek_kurikulum')
			{
				$tujuan='wakasekkurikulum/jadwal';
					$sess_data['template']='wakasek_kurikulum';
					$sess_data['home']='wakasek_kurikulum';
			}elseif($user->level=='bk')
			{
			    $tujuan='bk';
			    	$sess_data['template']='tbk';
			    	$sess_data['home']='vbk';
			}
			elseif($user->level=='ktu')
			{
			        $tujuan='home';
			    	$sess_data['template']='tktu';
			    	$sess_data['home']='hktu';
			}
			elseif($user->level=='adminperpus')
			{
			    $tujuan='adminperpus';
			    $sess_data['template']='tadminperpus';
			    $sess_data['home']='hadminperpus';
			}
				$sess_data['homebase']=$homebase;
				//$sess_data['kd_tahun_ajaran']=$ta;
				$cekuser=array("cek_type"=>'info',"cek_pesan"=>"<h4>Selamat Datang.!!</h4>");
				$this->session->set_flashdata($cekuser);
				$this->session->set_userdata($sess_data);
				redirect($tujuan);

		} else {
			$cekuser=array("cek_type"=>'danger',"cek_pesan"=>"<h4>User ID atau Password Anda Salah...! </h4>");
				$this->session->set_flashdata($cekuser);
           // header('location:' . base_url() );
            redirect('login');
			}
    }
    public function logout()
    {
		$this->session->sess_destroy();
	
	 redirect(base_url());
    }

}

?>
