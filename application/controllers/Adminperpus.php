<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Adminperpus extends CI_Controller
{
    public $view='adminperpus/template';
        
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
    //modul barcode
    	public function set_barcode($code)
    {
        
        $this->load->library('zend');
        //meload di folder Zend
        $this->zend->load('Zend/Barcode');
        //melakukan generate barcode
        Zend_Barcode::render('code39', 'image', array('text'=>$code, 'barHeight' => 25, 'factor'=>1.5), array());
    
	}
    function cek()
    {
        $level=$this->session->userdata('level');
        if($level!='adminperpus')
        {
            $this->session->sess_destroy();

            redirect(base_url('login'));
        }
        $key['aktif']='Ya';
        $data['profil']=$this->Crud_model->get_row_selected('profil',$key);
    }
    public function index()
    {
         $this->cek();
        $data['menu']=' '.$this->session->userdata('nm_sekolah');
        $data['jumlah_buku']=$this->get_jumlah_buku();
        $data['jumlah_anggota']=$this->get_jumlah_anggota();
         $data['pinjam']=$this->get_jumlah_by_status_pinjaman();
         $data['kembali']=$this->get_jumlah_by_status_kembali();
         $data['list_top_pengunjung']=$this->get_top_rank_pengunjung();
           $data['list_top_buku']=$this->get_top_rank_buku();
          $data['kembali_sebagian']=$this->get_jumlah_by_status_kembali_sebagian();
        $this->template->load($this->view, 'adminperpus/dashboards', $data);
    }
    function get_jumlah_anggota()
    {
        $sql="SELECT COUNT(*)as jumlah from anggota";
          $data=$this->db->query($sql)->row();
        return $data->jumlah;
    }
    public function get_top_rank_buku()
    {
        $sql="SELECT kd_buku,buku.judul,COUNT(*) as jumlah from pinjamd,buku where pinjamd.kd_buku=buku.kode_buku group by pinjamd.kd_buku order by jumlah DESC limit 10";
        $data=$this->db->query($sql)->result();
        //echo json_encode($data);
        return $data;
    }
    public function get_top_rank_pengunjung()
    {
        $sql="SELECT anggota.nm_anggota,pinjamh.id_anggota,COUNT(pinjamh.no_pinjam) as jumlah from pinjamh,anggota where pinjamh.id_anggota=anggota.id_anggota group by pinjamh.id_anggota order by jumlah desc limit 10";
        $data=$this->db->query($sql)->result();
        //echo json_encode($data);
        return $data;
    }
    public function get_jumlah_buku()
    {
          $sql="SELECT COUNT(*)as jumlah FROM `buku`";
        $data=$this->db->query($sql)->row();
        return $data->jumlah;
    }
    public function get_jumlah_by_status_pinjaman()
    {
       
        $sql="SELECT COUNT(*)as jumlah FROM `pinjamh` where status='Pinjam'";
        $data=$this->db->query($sql)->row();
        return $data->jumlah;
    }
     public function get_jumlah_by_status_kembali()
    {
        $list=array();
        $sql="SELECT COUNT(*)as jumlah FROM `pinjamh` where status='Kembali'";
        $data=$this->db->query($sql)->row();
        return $data->jumlah;
    }
    public function get_jumlah_by_status_kembali_sebagian()
    {
        $list=array();
        $sql="SELECT COUNT(*)as jumlah FROM `pinjamh` where status='Kembali Sebagian'";
        $data=$this->db->query($sql)->row();
        return $data->jumlah;
    }
    //modul anggota
    function delete_anggota_all()
    {
        $this->db->empty_table('anggota');
        
        redirect('adminperpus/anggota','refresh');
         
    }
    function sinkron_anggota()
    {
        //$key['status']='Aktif';
        $list_siswa=$this->Crud_model->get_all('siswa');
        $list_guru=$this->Crud_model->get_all('guru');
        foreach($list_siswa as $siswa)
        {
            $keys['id_anggota']=$siswa->nis;
           
            $data['nm_anggota']=$siswa->nm_siswa;
            $data['alamat']=$siswa->alamat;
            $data['no_hp']=$siswa->no_hp;
            $data['status']=$siswa->status;
            $data['kategori']='Siswa';
            $cek=$this->Crud_model->get_row_selected('anggota',$keys);
            if($cek)
            {
                $this->Crud_model->update_data('anggota',$data,$keys);
            }else{
                $data['id_anggota']=$siswa->nis;
                $this->Crud_model->save_data('anggota',$data);
            }
            
        }
        
        foreach($list_guru as $guru)
        {
            $keys['id_anggota']=$guru->id_guru;
           
            $data['nm_anggota']=$guru->nm_guru;
            $data['alamat']=$guru->alamat;
            $data['no_hp']=$guru->no_hp;
          
            $data['kategori']='Guru';
            $cek=$this->Crud_model->get_row_selected('anggota',$keys);
            if($cek)
            {
                $this->Crud_model->update_data('anggota',$data,$keys);
            }else{
                $data['id_anggota']=$guru->id_guru;
                $this->Crud_model->save_data('anggota',$data);
            }
            
        }
        $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data anggota berhasil diupdate.");
        $this->session->set_flashdata($pesan);
     // echo json_encode($list_siswa);
          redirect('adminperpus/anggota','refresh');
    }
    public function anggota()
    {
       
        $this->cek();
        $data['menu']=' '.$this->session->userdata('nm_sekolah');
        $data['list']=$this->Crud_model->get_all('anggota');
        $this->template->load($this->view, 'adminperpus/anggota/list_anggota', $data);
    }
    function input_anggota()
    {
        $this->cek();
        $data['menu']=' '.$this->session->userdata('nm_sekolah');
      
        $data['list_kategori']=$this->Crud_model->get_all_asc('jenis_anggota','jns_anggota');
        $data['kategori']='';
        $data['id_anggota']='';
        $data['nm_anggota']='';
        $data['alamat']='';
        $data['no_hp']='';
        $data['aksi']='input';
        
        $this->template->load($this->view, 'adminperpus/anggota/form_anggota', $data);
    }
    function edit_anggota($id)
    {
        $key['id_anggota']=$id;
       
        $this->cek();
        $data['aksi']='edit';
        $data['menu']=' '.$this->session->userdata('nm_sekolah');
        $data['list_kategori']=$this->Crud_model->get_all_asc('jenis_anggota','jns_anggota');
        $anggota=$this->Crud_model->get_row_selected('anggota',$key);
        $data['kategori']=$anggota->kategori;
        $data['id_anggota']=$anggota->id_anggota;
        $data['nm_anggota']=$anggota->nm_anggota;
        $data['alamat']=$anggota->alamat;
        $data['no_hp']=$anggota->no_hp;
        $data['aksi']='edit';
        $this->template->load($this->view,'adminperpus/anggota/form_anggota',$data);
    }
    function save_anggota()
    {
        $aksi=$this->input->post('aksi',true);
        $id_anggota=$this->input->post('id_anggota',true);
        $key['id_anggota']=$id_anggota;
        
      
        $data['nm_anggota']=$this->input->post('nm_anggota');
        $data['alamat']=$this->input->post('alamat');
        $data['no_hp']=$this->input->post('no_hp');
  
        $data['kategori']=$this->input->post('kategori');
        
        $cek=$this->Crud_model->get_row_selected('anggota',$key);
        if($cek)
        {
            if($aksi=='input')
            {
                $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>ID ANGGOTA ini sudah ada sebelumnya .");
                $this->session->set_flashdata($pesan);
                $this->input_anggota();
            }else{
                $this->Crud_model->update_data('anggota',$data,$key);
            $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Anggota berhasil diubah.");
            $this->session->set_flashdata($pesan);
            }
            
        }else{
            $data['id_anggota']=$id_anggota;
            $this->Crud_model->save_data('anggota',$data);
            $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Anggota berhasil disimpan.");
            $this->session->set_flashdata($pesan);
        }
        
        redirect('adminperpus/anggota','refresh');
    }
	function delete_anggota($id)
    {
        $key['id_anggota']=$id;
        $cek=$this->Crud_model->delete_data('anggota',$key);
        if($cek)
        {
            $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Anggota berhasil dihapus.");
        
        }else
        {
            $pesan=array("cek_type"=>'warning',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Anggota gagal dihapus.");
        
        }
        $this->session->set_flashdata($pesan);
        redirect('adminperpus/anggota','refresh');
    }
    //modul ftp
    
    
    //modul ebook
    function ebook()
    {
        
        $this->cek();
        $data['menu']=' '.$this->session->userdata('nm_sekolah');
        $data['list']=$this->Crud_model->get_all('ebook');
        $this->template->load($this->view, 'adminperpus/ebook/list_ebook', $data);
        
    }
    public function input_ebookx()
    {
        $data='';
          $this->template->load($this->view,'adminperpus/ebook/upload_ebook',$data);
    }
    public function input_ebook()
    {
        $key['status']=1;
        $this->cek();
        $data['aksi']='input';
        $data['menu']=' '.$this->session->userdata('nm_sekolah');
        $data['list_kategori']=$this->Crud_model->get_all_asc('kategori_buku','nm_kategori');
         $data['file']='';
        $data['isbn']='';
        $data['judul']='';
        $data['penulis']='';
        $data['penerbit']='';
        $data['thn_terbit']='';
        $data['edisi']='';
        $data['kode_ebook']='';
        $data['kategori']='';
        $this->template->load($this->view,'adminperpus/ebook/form_ebook',$data);
    }
    function auto_kode_ebook()
    {

        
        
        $q = $this->db->query("select MAX(RIGHT(kode_ebook,4)) as kd_max from ebook");
        $kd = "";

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        return 'E'.$kd;
    }
    function save_ebook()
    {
        // set_time_limit(6400); //
        $aksi=$this->input->post('aksi',true);
  
        $data['judul']=$this->input->post('judul');
        $data['penulis']=$this->input->post('penulis');
        $data['penerbit']=$this->input->post('penerbit');
        $data['thn_terbit']=$this->input->post('thn_terbit');
        $data['edisi']=$this->input->post('edisi');
        $data['kategori']=$this->input->post('kategori');
      
    
            if($aksi=='input')
            {
              
                
                $data['kode_ebook']=$this->auto_kode_ebook();
                $this->Crud_model->save_data('ebook',$data);
                $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data E-Book berhasil disimpan.");
           
            }else{
                  $key['kode_ebook']=$this->input->post('kode_ebook');
                $this->Crud_model->update_data('ebook',$data,$key);
                $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data E-Book  berhasil diubah.");
               
            }


    
         $this->session->set_flashdata($pesan);
        redirect('adminperpus/ebook','refresh');
        
    }
    function edit_ebook($id)
    {
        $key['kode_ebook']=$id;
       
        $this->cek();
        $data['aksi']='edit';
        $data['menu']=' '.$this->session->userdata('nm_sekolah');
        $data['list_kategori']=$this->Crud_model->get_all_asc('kategori_buku','nm_kategori');
        $buku=$this->Crud_model->get_row_selected('ebook',$key);
        $data['judul']=$buku->judul;
        $data['penulis']=$buku->penulis;
         $data['isbn']=$buku->isbn;
        $data['penerbit']=$buku->penerbit;
        $data['thn_terbit']=$buku->thn_terbit;
        $data['edisi']=$buku->edisi;
        $data['kode_ebook']=$buku->kode_ebook;
        $data['kategori']=$buku->kategori;
        $data['file']=$buku->file;
        $this->template->load($this->view,'adminperpus/ebook/form_ebook',$data);

    }
    function delete_ebook($id)
    {

        
        $key['kode_ebook']=$id;
        //$ebook=$this->Crud_model->get_row_selected('ebook',$key);
         //unlink($ebook->file);
        $cek=$this->Crud_model->delete_data('ebook',$key);
        if($cek)
        {
            $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data E-Book berhasil dihapus.");
            $this->session->set_flashdata($pesan);
        }else{
            
            $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data E-Book gagal dihapus.");
            $this->session->set_flashdata($pesan);
        }
        $this->ebook();
    }
    function fupload_ebook($kode_ebook)
    {
        $data['kode_ebook']=$kode_ebook;
        $this->template->load($this->view,'adminperpus/ebook/upload_ebook',$data);
        
    }
    function edit_link($kode_ebook)
    {
         $data['kode_ebook']=$kode_ebook;
         $key['kode_ebook']=$kode_ebook;
         $ebook=$this->Crud_model->get_row_selected('ebook',$key);
         $data['judul']=$ebook->judul;
        $this->template->load($this->view,'adminperpus/ebook/edit_link',$data);
    }
    function update_link_ebook()
    {
        $key['kode_ebook']=$this->input->post('kode_ebook');
        $data['file']=$this->input->post('link');
        $this->Crud_model->update_data('ebook',$data,$key);
        redirect('adminperpus/ebook');
    }
    function uploads()
    {
        // baca nama file
        $fileName = $_FILES["datafile"]["name"];
        // baca file temporary upload
        $fileTemp = $_FILES["datafile"]["tmp_name"];
        // baca tipe file
        $fileType = $_FILES["datafile"]["type"];
        // baca filesize
        $fileSize = $_FILES["datafile"]["size"];
         
         $kode_ebook=$this->input->post('kode');
        // proses upload file ke folder /upload
        if (move_uploaded_file($fileTemp, 'data/ebook/'.$fileName)){
            echo "Upload $fileName selesai";
        }
        $data['file']=base_url('data/ebook').'/'.$fileName;
        
        $key['kode_ebook']=$kode_ebook;
        $this->Crud_model->update_data('ebook',$data,$key);
    }
    
    	

	 //modul BUKU
    public function buku()
    {
        
        $this->cek();
        $data['menu']=' '.$this->session->userdata('nm_sekolah');
        $data['list']=$this->Crud_model->get_all('buku');
        $this->template->load($this->view, 'adminperpus/buku/list_buku', $data);
    }
    public function input_buku()
    {
        $key['status']=1;
        $this->cek();
        $data['aksi']='input';
        $data['menu']=' '.$this->session->userdata('nm_sekolah');
        $data['list_kategori']=$this->Crud_model->get_all_asc('kategori_buku','nm_kategori');
        $data['isbn']='';
        $data['judul']='';
        $data['penulis']='';
        $data['penerbit']='';
        $data['thn_terbit']='';
        $data['edisi']='';
        $data['lokasi']='';
        $data['jumlah']='';
        $data['kode_buku']='';
        $data['kategori']='';
        $this->template->load($this->view,'adminperpus/buku/form_buku',$data);
    }
    function save_buku()
    {
        $aksi=$this->input->post('aksi',true);
        $kode_buku=$this->input->post('isbn',true);
        $key['kode_buku']=$kode_buku;
        
        $data['isbn']=$kode_buku;
        $data['judul']=$this->input->post('judul');
        $data['penulis']=$this->input->post('penulis');
        $data['penerbit']=$this->input->post('penerbit');
        $data['thn_terbit']=$this->input->post('thn_terbit');
        $data['edisi']=$this->input->post('edisi');
        $data['lokasi']=$this->input->post('lokasi');
        $data['jumlah']=$this->input->post('jumlah');
        $data['kategori']=$this->input->post('kategori');
        
        $cek=$this->Crud_model->get_row_selected('buku',$key);
        if($cek)
        {
            if($aksi=='input')
            {
                
                $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>ISBN ini sudah ada sebelumnya .");
                $this->session->set_flashdata($pesan);
                $this->input_buku();
            }else{
                $this->Crud_model->update_data('buku',$data,$key);
            $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Buku berhasil diubah.");
            $this->session->set_flashdata($pesan);
            }
            
        }else{
            $data['kode_buku']=$kode_buku;
            $this->Crud_model->save_data('buku',$data);
            $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Buku berhasil disimpan.");
            $this->session->set_flashdata($pesan);
        }
        
        redirect('adminperpus/buku','refresh');
        
    }
    function edit_buku($id)
    {
        $key['kode_buku']=$id;
       
        $this->cek();
        $data['aksi']='edit';
        $data['menu']=' '.$this->session->userdata('nm_sekolah');
        $data['list_kategori']=$this->Crud_model->get_all_asc('kategori_buku','nm_kategori');
        $buku=$this->Crud_model->get_row_selected('buku',$key);
        $data['isbn']=$buku->isbn;
        $data['judul']=$buku->judul;
        $data['penulis']=$buku->penulis;
        $data['penerbit']=$buku->penerbit;
        $data['thn_terbit']=$buku->thn_terbit;
        $data['edisi']=$buku->edisi;
        $data['lokasi']=$buku->lokasi;
        $data['jumlah']=$buku->jumlah;
        $data['kode_buku']=$buku->kode_buku;
        $data['kategori']=$buku->kategori;
        $this->template->load($this->view,'adminperpus/buku/form_buku',$data);

    }
    function delete_buku($id)
    {
        $key['kode_buku']=$id;
        $cek=$this->Crud_model->delete_data('buku',$key);
        if($cek)
        {
            $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Buku berhasil dihapus.");
            $this->session->set_flashdata($pesan);
        }else{
            
            $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Buku gagal dihapus.");
            $this->session->set_flashdata($pesan);
        }
        $this->buku();
    }
	//MUDUL PINJAM/peminjaman
	public function pinjam()
	{
		
        $this->cek();
        $data['menu']=' '.$this->session->userdata('nm_sekolah');
		$kd_ta=$this->session->userdata('kd_ta');
		$keypinjam['kd_ta']=$kd_ta;
        $data['list_pinjam']=$this->Crud_model->get_list_selected('vpinjamanh',$keypinjam);
	
        $this->template->load($this->view, 'adminperpus/pinjam/list_pinjam', $data);
	}
	public function detail_pinjam()
	{
		$no_pinjam=$this->input->post('no_pinjam');
       
        
		$output=$no_pinjam;
		$keypinjam['no_pinjam']=$no_pinjam;
       
        $hasil= $this->Crud_model->get_list_selected('vpinjamand',$keypinjam);
        foreach ($hasil as $items) {
           
            $output .='
                <tr>
                    <td>'.$items->kd_buku.'</td>
                    <td>'.$items->judul.'</td>
                    <td>'.$items->penulis.'</td>
                    <td>'.$items->jumlah.'</td>
                    <td>'.$items->status.'</td>
                    
                </tr>
            ';
        }
        
        echo $output;
       
	}
	public function fpinjam()
	{
		$key['status']=1;
        $this->cek();
        $data['menu']=' '.$this->session->userdata('nm_sekolah');
        $data['list_buku']=$this->Crud_model->get_all('buku');
		 $data['list_anggota']=$this->Crud_model->get_all('anggota');
        $this->template->load($this->view, 'adminperpus/pinjam/fpinjam', $data);
	}
    function cek_pinjaman_anggota($id_anggota){
        $key['id_anggota']=$id_anggota;
        $key['status']='Pinjam';
        $cek=$this->Crud_model->get_row_selected('pinjamh',$key);
        if($cek)
        {
            return '1';
        }else{
            return '0';
        }
        
    }

    public function api_get_anggota()
    {
        $id_anggota=$this->input->post('id_anggota');
        
        $cek=$this->cek_pinjaman_anggota($id_anggota);
        if($cek=='1')
        {
            echo 'x';
        }else{
            $key['id_anggota']=$id_anggota;
            $hasil=$this->Crud_model->get_row_selected('anggota',$key);
            if($hasil) {
            echo $hasil->nm_anggota;
            }else{
                echo '0';
            }
        }
      
    }
    public function api_get_buku()
    {
        
        $kode_buku = $this->input->post('kode_buku');
       
        $hasil = $this->Crud_model->getBuku($kode_buku);
        //jika ada buku dalam database
        if($hasil->num_rows() > 0) {
            $dbuku = $hasil->row_array();
            echo $dbuku['judul']."|".$dbuku['penulis'];
        }else{
            echo '0';
        }
    }
	public function api_add_buku()
	{
		$x=false;
		$id_anggota=$this->input->post('id_anggota');
		$data['kode_buku']=$this->input->post('kode_buku');
		$data['id_anggota']=$this->input->post('id_anggota');
		$data['judul']=$this->input->post('judul');
		$data['penulis']=$this->input->post('penulis');
		$data['jumlah']=$this->input->post('jumlah');
		$hasil=$this->Crud_model->save_data('temp_pinjam',$data);
		if($hasil)
		{
			$x=$this->show_cart($id_anggota);
		}
		else{
			
			$x=false;
			
		}
		echo $x;
	}
	 public function show_cart($id_anggota){ //Fungsi untuk menampilkan Cart
        $output = '';
        $no = 0;
		$key['id_anggota']=$id_anggota;
		$hasil= $this->Crud_model->get_list_selected('temp_pinjam',$key);
        foreach ($hasil as $items) {
            $no++;
            $output .='
                <tr>
                    <td>'.$items->kode_buku.'</td>
                    <td>'.$items->judul.'</td>
                    <td>'.$items->penulis.'</td>
                    <td>'.$items->jumlah.'</td>
                    <td><button type="button" id="'.$items->id.'" class="hapus_cart btn btn-danger btn-xs">Batal</button></td>
                </tr>
            ';
        }
        
        return $output;
    }
	public function batal_pinjam(){
		$id=$this->input->post('id');
		$id_anggota=$this->input->post('id_anggota');
		
		$key['id']=$id;
		$cek=$this->Crud_model->delete_data('temp_pinjam',$key);
		if($cek)
		{
			echo $this->show_cart($id_anggota);
		}else
		{
			echo 'tidak ada';
		}
		
	}
	public function save_pinjam()
	{
		 $kd_ta=$this->session->userdata('kd_ta');
		 $no_pinjam=$this->no_pinjam($kd_ta);
		$id_anggota=$this->input->post('id_anggota');
		$data['lama']=$this->input->post('lama');
		$data['id_anggota']=$id_anggota;
		$data['tgl_pinjam']=date('Y-m-d');
		$data['no_pinjam']=$no_pinjam;
		$data['kd_ta']=$kd_ta;
        $data['status']='Pinjam';
		$key['id_anggota']=$id_anggota;
		$this->Crud_model->save_data('pinjamh',$data);
		$hasil=$this->Crud_model->get_list_selected('temp_pinjam',$key);
		foreach($hasil as $row)
		{
			$datax['no_pinjam']=$no_pinjam;
			$datax['kd_buku']=$row->kode_buku;
			$datax['jumlah']=$row->jumlah;
			$this->Crud_model->save_data('pinjamd',$datax);
		}
		$this->Crud_model->delete_data('temp_pinjam',$key);
		
        redirect('adminperpus/pinjam','refresh');
        
	}
	 private function no_pinjam($kd_ta) {
         $q = $this->db->query("select MAX(RIGHT(no_pinjam,4)) as kd_max from pinjamh where kd_ta='".$kd_ta."' ");
        $kd = "";
        $ta=$kd_ta;

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        return $ta.$kd;
    }
    function delete_pinjam($id)
    {
        $key['no_pinjam']=$id;
        $this->Crud_model->delete_data('pinjamh',$key);
        $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi.!!</h4>Data Pinjaman Buku berhasil dihapus.");
            $this->session->set_flashdata($pesan);
        redirect('adminperpus/pinjam');
    }
    //modul kembali/pengembalian 
    function kembali()
    {
        //$key['menu']=' '.$this->session->userdata('kd_ta');
        $hasil=$this->Crud_model->get_all('vkembali');


    }
    function fkembali($id)
    {
        $this->cek();
        $data['menu']=' '.$this->session->userdata('nm_sekolah');
        $key['no_pinjam']=$id;
       $pinjamh=$this->Crud_model->get_row_selected('vpinjamanh',$key);
        $data['list_pinjaman']=$this->Crud_model->get_list_selected('vpinjamand',$key);
        $data['list_kembali']=$this->Crud_model->get_list_selected('kembali',$key);
        
        $tgl_pinjam=$pinjamh->tgl_pinjam;
        $lama=$pinjamh->lama;
        $tgl_jatuh_tempo=date('Y-m-d', strtotime('+'.$lama. ' days', strtotime($tgl_pinjam))); 
        $data['tgl_jatuh_tempo']=date($tgl_jatuh_tempo);
        $data['lama']=$lama;
        $data['tgl_pinjam']=$tgl_pinjam;
        $data['id_anggota']=$pinjamh->id_anggota;
        $data['nm_anggota']=$pinjamh->nm_anggota;
        $data['no_pinjam']=$pinjamh->no_pinjam;
        $tgl1 = new DateTime($tgl_pinjam);
        $tgl2 = new DateTime($tgl_jatuh_tempo);
        $jarak = $tgl2->diff($tgl1);
        $data['telat']=$jarak->d;
        
        $this->template->load($this->view, 'adminperpus/kembali/fkembali', $data);

    }
    public function jumlah_buku_pinjam($no_pinjam)
    {
    $sql="select count(*) as jumlah
    from pinjamd where no_pinjam = '".$no_pinjam."'";
    $hasil = $this->db->query($sql)->row();
    return $hasil->jumlah;
    }
    public function jumlah_buku_kembali($no_pinjam)
    {
    $sql="select count(*) as jumlah
    from kembali where no_pinjam = '".$no_pinjam."'";
    $hasil = $this->db->query($sql)->row();
    return $hasil->jumlah;
    }
    public function save_kembali()
    {
        $hasilx=0;
        $status='';
        $keykembali['no_pinjam']=$this->input->post('no_pinjam');
        $keykembali['kode_buku']=$this->input->post('kode_buku');
        
        $jumlah_pinjam=$this->input->post('jumlah_pinjam');
        $jumlah_kembali=$this->input->post('jumlah');

        if($jumlah_kembali>=$jumlah_pinjam)
        {
            $status='Kembali';
        }else{
            $status='Kembali Sebagian';
        }
        $keyk['no_pinjam']=$this->input->post('no_pinjam');
        $keyk['kd_buku']=$this->input->post('kode_buku');
        $cek=$this->Crud_model->get_row_selected('kembali',$keykembali);     
        if($cek)
        {
           // echo 'ada'.'<br>';
            $data['tgl_kembali']=date('Y-m-d');
            $data['jumlah']=$this->input->post('jumlah');
            $data['telat']=$this->input->post('telat');
            $status_update_kembali=$this->Crud_model->update_data('kembali',$data,$keykembali);
            
            $datay['status']=$status;
            $this->Crud_model->update_data('pinjamd',$datay,$keyk);
           // echo 'status_update:'.$status_update_kembali;
        }else{
           // echo 'tidak ada';
            $data['no_pinjam']=$this->input->post('no_pinjam');
            $data['kode_buku']=$this->input->post('kode_buku');
            $data['tgl_kembali']=date('Y-m-d');
            $data['jumlah']=$this->input->post('jumlah');
            $data['telat']=$this->input->post('telat');
            $this->Crud_model->save_data('kembali',$data,$keykembali);
            $datay['status']=$status;
            $this->Crud_model->update_data('pinjamd',$datay,$keyk);
           // echo 'status_simpan:'.$status_simpan_kembali;
        }
        $no_pinjam=$this->input->post('no_pinjam');
        $pinjam=$this->jumlah_buku_pinjam($no_pinjam);
        $kembali=$this->jumlah_buku_kembali($no_pinjam);
        if($kembali>=$pinjam and $status=='Kembali')
        {
            $keyxx['no_pinjam']=$no_pinjam;
            $dataxx['status']='Kembali';
            $this->Crud_model->update_data('pinjamh',$dataxx,$keyxx);
            $hasilx='1';
        }else{
            $keyxx['no_pinjam']=$no_pinjam;
            $dataxx['status']='Kembali Sebagian';
            $this->Crud_model->update_data('pinjamh',$dataxx,$keyxx);
            $hasilx='0';
        }
      echo $hasilx;
    }
    //modul laporan-laporan
    
    
    function lap_jatuh_tempo()
    {
        
        $this->cek();
        $data['menu']=' '.$this->session->userdata('nm_sekolah');
        $data['list_jatuh_tempo']=$this->get_lap_jatuh_tempo();
        
        $this->template->load($this->view, 'adminperpus/laporan/lap_jatuh_tempo', $data);
    }
     function print_jatuh_tempo()
    {
        $key['status']=1;
        $this->cek();
        $data['menu']=' '.$this->session->userdata('nm_sekolah');
        $data['sekolah']=$this->Crud_model->get_row_selected('sekolah',$key);
        $data['list_jatuh_tempo']=$this->get_lap_jatuh_tempo();
        
        $this->load->view('adminperpus/laporan/print_jatuh_tempo', $data);
    }
    function print_rincian_jatuh_tempo()
    {
        $key['status']=1;
        $this->cek();
        $data['menu']=' '.$this->session->userdata('nm_sekolah');
        $data['sekolah']=$this->Crud_model->get_row_selected('sekolah',$key);
        $data['list_jatuh_tempo']=$this->get_lap_jatuh_tempo_detail();
        
        $this->load->view('adminperpus/laporan/print_jatuh_tempo_detail', $data);
    }
    function get_lap_jatuh_tempo()
    {
        //$data=false;
        $sql="SELECT pinjamh.*,date_add(tgl_pinjam,INTERVAL lama day)as tgl_tempo, datediff(current_date(), date_add(tgl_pinjam,INTERVAL lama day)) as selisih,anggota.nm_anggota,anggota.alamat,anggota.kategori,anggota.no_hp FROM `pinjamh`,anggota where (pinjamh.status='Pinjam' or pinjamh.status='Kembali Sebagian') and datediff(current_date(), date_add(tgl_pinjam,INTERVAL lama day))>0 and pinjamh.id_anggota=anggota.id_anggota order by selisih desc";
        $output=$this->db->query($sql)->result();
        if($output)
        {
            return $output;
        }else{
            return false;
        }
      
    }
        function get_lap_jatuh_tempo_detail()
    {
        //$data=false;
        $sql="SELECT * from vallpeminjamanbuku where selisih>0 and status_buku is null order by id_anggota asc";
        $output=$this->db->query($sql)->result();
        if($output)
        {
            return $output;
           // echo json_encode($output);
        }else{
            return false;
        }
      
    }
    
    
    
    
   


    

}

?>