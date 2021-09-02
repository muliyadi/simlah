<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Akademika_model
 *
 * @author abd_salam
 */
class Crud_model extends CI_Model {
    function __construct()
    {
        parent::__construct();

    }

    
    function angka_to_huruf($angka)
    {
        $huruf='';
        if($angka=='1' or $angka==1)
        {
            $huruf='satu';
        }elseif($angka=='2' or $angka==2)
        {
            $huruf='dua';
        }
        elseif($angka=='3' or $angka==3)
        {
            $huruf='tiga';
        }
        elseif($angka=='4' or $angka==4)
        {
            $huruf='empat';
        }
        elseif($angka=='5' or $angka==5)
        {
            $huruf='lima';
        }
        elseif($angka=='6' or $angka==6)
        {
            $huruf='enam';
        }
        elseif($angka=='7' or $angka==7)
        {
            $huruf='tujuh';
        }
        elseif($angka=='8' or $angka==8)
        {
            $huruf='delapan';
        }elseif($angka=='9' or $angka==9)
        {
            $huruf='sembilan';
        }
        elseif($angka=='10' or $angka==10)
        {
            $huruf='sepuluh';
        }
        elseif($angka=='11' or $angka==11)
        {
            $huruf='sebelas';
        }
        elseif($angka=='12' or $angka==12)
        {
            $huruf='dua belas';
        }
        elseif($angka=='13' or $angka==13)
        {
            $huruf='tiga belas';
        }
        elseif($angka=='14' or $angka==14)
        {
            $huruf='empat belas';
        }
        elseif($angka=='15' or $angka==15)
        {
            $huruf='lima belas';
        }
        return $huruf;
    }
    function cek_biodata_siswa($nis)
	{
	    //$nis=$this->session->userdata('userid');
	    $key['nis']=$nis;
	    $siswa=$this->Crud_model->get_row_selected('siswa',$key);
	    if($siswa->ijazah_smp=='')
	    {
	       $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi</h4>Upload Ijazah SMP Anda....!");
		    $this->session->set_flashdata($pesan);
	        redirect($url.'/ijazah_smp');
	    }
	    if($siswa->image=='')
	    {
	        $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi</h4>Upload Pas Foto 3x4 Anda....!");
		    $this->session->set_flashdata($pesan);
	        redirect($url.'/biodata');
	    }
	    if($siswa->tempat=='' or $siswa->tempat=='-')
	    {
	        $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi</h4>Isi Kolom Tempat Lahir Anda....!");
		    $this->session->set_flashdata($pesan);
	        redirect($url.'/biodata');
	    }
	    if($siswa->nama_ayah=='' or $siswa->nama_ibu=='')
	    {
	        $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi</h4>Isi Kolom Nama Ayah/Ibu....!");
		    $this->session->set_flashdata($pesan);
	        redirect($url.'/biodata');
	    }
	    if($siswa->alamat_ayah=='' or $siswa->no_hp_ayah=='')
	    {
	        $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi</h4>Isi Kolom Alamat dan No HP Orang Tua...!");
		    $this->session->set_flashdata($pesan);
	        redirect($url.'/biodata');
	    }
	    if($siswa->status_dalam_keluarga=='' or $siswa->anak_ke=='')
	    {
	        $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi</h4>Isi Kolom:Status Dalam Keluarga dan Kolom: Anak Ke...!");
		    $this->session->set_flashdata($pesan);
	        redirect($url.'/biodata');
	    }
	    if($siswa->pekerjaan_ayah=='' or $siswa->pekerjaan_ibu=='')
	    {
	        $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi</h4>Isi Kolom: Pekerjaan Ayah dan Ibu...!");
		    $this->session->set_flashdata($pesan);
	        redirect($url.'/biodata');
	    }
	    
	   
	}
    function auto_id_guru()
    {
        $query = $this->db->query("SELECT MAX(id_guru) as id_guru from guru");
        $hasil = $query->row();
        $id_guru= $hasil->id_guru;
  
       
        // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
        $nourut = substr($id_guru, 1, 3);
        $kode = $nourut + 1;
        $data = array('id_guru' => $kode);
        
        echo $kode;
    }
    //result multi row....
	
	function totalRows($table)
	{

echo $this->db->count_all_results();
		return $this->db->count_all_results($table);
    }
    function total_rows_filter($tabel,$filter)
    {
        	    $this->db->where($filter);
            //$this->db->from($tabel);
       
       	return $this->db->count_all_results($tabel);
        
    }
    function get_all($table)
    {
        return $this->db->get($table)->result();
    }
    function get_all_asc($table,$order)
    {
        $this->db->order_by($order,'ASC');
        return $this->db->get($table)->result();
    }

    function get_row_selected($table,$data)
    {
        
        $hasil=$this->db->get_where($table, $data)->row();
       return $hasil;
          
    }
	
	function get_list_like($table,$kriteria1,$kriteria2)
	{
		//$kriteria['arti'] =  'setuju';
		$this->db->select('*');
		$this->db->from($table);
		$this->db->like($kriteria1);
		$this->db->or_like($kriteria2);
		$query = $this->db->get()->result();
		return $query;
	}
	
    function getBuku($kode)
    {
        $this->db->where("isbn", $kode);
		$this->db->where("kode_buku", $kode);
        return $this->db->get("buku");
    }
	 //output berupa array
     function get_list_selected($table,$data) 
     {
        return $this->db->get_where($table, $data)->result();
     }
    
    function update_data($table,$data,$field_key)
         {
            $status=FALSE;
            try {
                $this->db->trans_start();
                $this->db->update($table,$data,$field_key);
                $this->db->trans_complete();
                $status=TRUE;
            
            } catch (Exception $e) {
                
            }
            return $status;
           
            
        }

    public function save_multiple($tabel,$data){
        $this->db->trans_start();
    $this->db->insert_batch($tabel, $data);
     $this->db->trans_complete();
  }
    function save_data($table,$data){
		$status=FALSE;
        try {
           $this->db->trans_start();
		   $this->db->insert($table, $data);
		   $this->db->trans_complete();
            $status=TRUE;
        
        } catch (Exception $e) {
            
        }
        return $status;
        
    }

    function delete_data($table,$data)
    {
        $status=FALSE;
        try {
            $this->db->delete($table,$data);
            $status=TRUE;
        
        } catch (Exception $e) {
            
        }
        return $status;
    }
	//modul absen
	
	function get_rekap_absensi_siswa($kd_ta,$nis)
	{
	    $sql="SELECT absen_harian.kd_ta,absen_harian.nis, SUM(hadir) as hadir, SUM(izin) as izin, SUM(sakit) as sakit, SUM(alpa) as alpa,SUM(bolos) as bolos FROM `absen_harian` where absen_harian.kd_ta='".$kd_ta."' and absen_harian.nis='".$nis."' group by absen_harian.kd_ta,absen_harian.nis";
	    	$hasil = $this->db->query($sql)->row();
		return $hasil;
	    
	}
	
	//modul jadwal
    
	function get_detail_jadwal2($kd_ta,$kelas)
	{
		$sql="SELECT  
		`jadwal`.`kd_jadwal`, 
		`jadwal`.`id_kurikulum`,
		`pelajaran`.`nm_pelajaran`,
		  `pelajaran`.`kategori`,
		  `pelajaran`.`subkategori`,
		  `pelajaran`.`kelompok`,
		  `guru`.`nuptk`,
		  `guru`.`nip`,
		  `guru`.`nm_guru`,
		  `guru`.`jk`,
		  `guru`.`agama`,
		  `jadwal`.`id_guru`,
		  `jadwal`.`hari`,
		  `jadwal`.`kd_ta`,
		  `jadwal`.`kelas`,
		  `jadwal`.`jam_masuk`,
		  `jadwal`.`jam_keluar`,
		  `jadwal`.`status`,
		  `guru`.`image`,
		  `guru`.`no_hp`,
		  `guru`.`alamat`,
		  `guru`.`email`,
		  `guru`.`tempat`,
		  `guru`.`pendidikan`,
		  `guru`.`pangkat`,
		  `guru`.`golongan`,
		  `guru`.`status` AS `status1`,
		  `guru`.`tgl_lahir`,
		  `guru`.`nik`,
		  `guru`.`bidang`,
		  `guru`.`id_guru` AS `id_guru1`
		FROM
  			`jadwal`
  			INNER JOIN `pelajaran` ON `jadwal`.`kd_pelajaran` = `pelajaran`.`kd_pelajaran`
  			INNER JOIN `guru` ON `jadwal`.`id_guru` = `guru`.`id_guru` 
 		where `jadwal`.`kd_ta`='".$kd_ta."' and jadwal.kelas='".$kelas."' order by kd_jadwal asc";
		$hasil = $this->db->query($sql)->result();
		return $hasil;
	}
	function get_detail_jadwal($kd_ta)
	{
		$sql="SELECT  
		`jadwal`.`kd_jadwal`, 
		`jadwal`.`kd_pelajaran`,
		`pelajaran`.`nm_pelajaran`,
		  `pelajaran`.`kategori`,
		  `pelajaran`.`subkategori`,
		  `pelajaran`.`kelompok`,
		  `guru`.`nuptk`,
		  `guru`.`nip`,
		  `guru`.`nm_guru`,
		  `guru`.`jk`,
		  `guru`.`agama`,
		  `jadwal`.`id_guru`,
		  `jadwal`.`hari`,
		  `jadwal`.`kd_ta`,
		  `jadwal`.`kelas`,
		  `jadwal`.`jam_masuk`,
		  `jadwal`.`jam_keluar`,
		  `jadwal`.`status`,
		  `guru`.`image`,
		  `guru`.`no_hp`,
		  `guru`.`alamat`,
		  `guru`.`email`,
		  `guru`.`tempat`,
		  `guru`.`pendidikan`,
		  `guru`.`pangkat`,
		  `guru`.`golongan`,
		  `guru`.`status` AS `status1`,
		  `guru`.`tgl_lahir`,
		  `guru`.`nik`,
		  `guru`.`bidang`,
		  `guru`.`id_guru` AS `id_guru1`
		FROM
  			`jadwal`
  			INNER JOIN `kurikulum_detail` ON `jadwal`.`id_kurikulum` = `kurikulum_detail`.`id_kurikulum` inner join pelajaran on kurikulum_detail.kd_pelajaran=pelajaran.kd_pelajaran
  			INNER JOIN `guru` ON `jadwal`.`id_guru` = `guru`.`id_guru` inner join hari on jadwal.hari=hari.hari
 		where `jadwal`.`kd_ta`='".$kd_ta."' order by jadwal.kelas,hari.id asc";
		$hasil = $this->db->query($sql)->result();
		return $hasil;
	}
	
	
function bulan($bln)
	    {
	        switch ($bln)
	        {
	            case 1:
	                return "Januari";
	                break;
	            case 2:
	                return "Februari";
	                break;
	            case 3:
	                return "Maret";
	                break;
	            case 4:
	                return "April";
	                break;
	            case 5:
	                return "Mei";
	                break;
	            case 6:
	                return "Juni";
	                break;
	            case 7:
	                return "Juli";
	                break;
	            case 8:
	                return "Agustus";
	                break;
	            case 9:
	                return "September";
	                break;
	            case 10:
	                return "Oktober";
	                break;
	            case 11:
	                return "November";
	                break;
	            case 12:
	                return "Desember";
	                break;
	        }
	    }
function date_indo($tgl)
	    {
	        $ubah = gmdate($tgl, time()+60*60*8);
	        $pecah = explode("-",$ubah);
	        $tanggal = $pecah[2];
	        $bulan = $this->bulan($pecah[1]);
	        $tahun = $pecah[0];
	        return $tanggal.' '.$bulan.' '.$tahun;
	    }
	    
	    
	    function cek_biodata($nis)
	{
	    $status=1;
	    //$nis=$this->session->userdata('userid');
	    $key['nis']=$nis;
	    $siswa=$this->Crud_model->get_row_selected('siswa',$key);
	    if($siswa->ijazah_smp=='')
	    {
	       $pesan=array("cek_type"=>'danger',"cek_pesan"=>"<h4>Informasi</h4> Belum Upload Ijazah SMP...!");
		    $this->session->set_flashdata($pesan);
	        //redirect('siswa/ijazah_smp');
	        $status='';
	    }
	    if($siswa->image=='')
	    {
	        $pesan=array("cek_type"=>'danger',"cek_pesan"=>"<h4>Informasi</h4>Belum Upload Pas Foto...!");
		    $this->session->set_flashdata($pesan);
	        //redirect('siswa/biodata');
	        $status='';
	    }
	    if($siswa->tempat=='' or $siswa->tempat=='-')
	    {
	        $pesan=array("cek_type"=>'success',"cek_pesan"=>"<h4>Informasi</h4>Kolom Tempat Lahir masih kosong, Isi lengkap biodata siswa...!");
		    $this->session->set_flashdata($pesan);
	        //redirect('siswa/biodata');
	        $status='';
	    }
	    if($siswa->nama_ayah=='' or $siswa->nama_ibu=='')
	    {
	        $pesan=array("cek_type"=>'danger',"cek_pesan"=>"<h4>Informasi</h4> Kolom Nama Ayah/Ibu masih kosong, Isi lengkap biodata siswa...!");
		    $this->session->set_flashdata($pesan);
	       // redirect('siswa/biodata');
	       $status='';
	    }
	    if($siswa->alamat_ayah=='' or $siswa->no_hp_ayah=='')
	    {
	        $pesan=array("cek_type"=>'danger',"cek_pesan"=>"<h4>Informasi</h4> Kolom Alamat dan No HP Orang Tua masih kosong, Isi lengkap biodata siswa...!");
		    $this->session->set_flashdata($pesan);
	       // redirect('siswa/biodata');
	       $status='';
	    }
	    if($siswa->status_dalam_keluarga=='' or $siswa->anak_ke=='')
	    {
	        $pesan=array("cek_type"=>'danger',"cek_pesan"=>"<h4>Informasi</h4>Kolom Status Dalam Keluarga dan Kolom: Anak Ke masih kosong, Isi lengkap biodata siswa...!");
		    $this->session->set_flashdata($pesan);
	       // redirect('siswa/biodata');
	       $status='';
	    }
	    if($siswa->pekerjaan_ayah=='' or $siswa->pekerjaan_ibu=='')
	    {
	        $pesan=array("cek_type"=>'danger',"cek_pesan"=>"<h4>Informasi</h4>Kolom Pekerjaan Ayah dan Ibu masih kosong, Isi lengkap biodata siswa..!");
		    $this->session->set_flashdata($pesan);
		    $status='';
	       // redirect('siswa/biodata');
	    }
	    return $status;
	   
	}
	
	public function skl_ipss($ta)
	{
	     $this->load->library('Pdf');
          $page=array(210,360);
        $pdf = new Pdf();

		
		
	    $sekolah=$this->get_sekolah();
	    $keykasek['kd_ta']=$ta;
    $kasek=$this->Crud_model->get_row_selected('kasek',$keykasek);
    
    $keyxx['kelas']='XII-IPS-2';
    
 $list=$this->get_list_selected('siswa',$keyxx);
    foreach($list as $rowx)
    {
        
        $nis=$rowx->nis;
    
    $biodata=$this->get_biodata($nis);
    $key['nis']=$nis;
    $key['kd_ta']=$ta;
    $nilai=$this->Crud_model->get_row_selected('vskl_ips',$key);
    
    
    
    //qrcode
    $cc='http://siakad.sman1masteng.sch.id/kasek/skl_ips/'.$nis.'/'.$ta;
    $qrcode='<img src="https://api.qrserver.com/v1/create-qr-code/?size=250x300&data='.$cc.'" heigth="85" width="85">';
    
   
        //$pdf = new PDF_MC_Table();
        $pdf->AddPage('P', $page, '', true);
               $pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
        $pdf->SetMargins(17, 5, 15, 5);
        $pdf->SetFont('times', '', 12);

       // $pdf = new PDF_MC_Table('P', 'm
         $gambar1 = "assets/img/logo_sultra.png";
        //$gambar_siswa = "foto_siswa/".$biodata->image;
       
        $pdf->image($gambar1, 20, 19, 30);
        //$pdf->image($gambar_siswa, 50, 290, 25, 30, '', '', '', true, 150, '', false, false, 1, false, false, false);
        
        $pdf->SetFont('times', '', 12);
        $pdf->ln(5);
        $pdf->Cell(0, 10, 'PEMERINTAH PROVINSI SULAWESI TENGGARA', 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(0, 10, 'DINAS PENDIDIKAN DAN KEBUDAYAAN', 0, 0, 'C');
        $pdf->ln(5);
        $pdf->SetFont('times', 'B', 12);
       	$pdf->Cell(0, 10, $sekolah->nm_sekolah, 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(0, 10, 'TERAKREDITASI A', 0, 0, 'C');
      	$pdf->ln(4);
      	$pdf->SetFont('times', '', 12);
        $pdf->Cell(0, 10, $sekolah->alamat, 0, 0, 'C');
        $pdf->ln(4);
          $pdf->Cell(0, 10, 'Email:'.$sekolah->email, 0, 0, 'C');
        $pdf->ln(4);

        $pdf->Cell(0, 10, 'Website:'.$sekolah->website, 0, 0, 'C');
         $pdf->ln(2);
         $pdf->Cell(175, 1, '', 'B', 0, 'L');
        $pdf->ln(5);
        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(0, 8, 'SURAT KETERANGAN LULUS (SKL)', 0, 0, 'C');
        $pdf->ln(5);
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(0,5,'Program Studi: Ilmu Pengetahuan Sosial','',0,'C');
        $pdf->ln(6);
        $pdf->Cell(0, 5, 'Nomor: '.$nilai->no_surat, 0, 0, 'C');
        $pdf->ln(9);
        
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(10,8,'Yang bertanda tangan di bawah ini Kepala '. $sekolah->nm_sekolah_kecil.' menerangkan bahwa:','',0,'L');
        $pdf->ln(8);
        $pdf->Cell(15);
        $pdf->Cell(55, 0, 'Nama', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	$pdf->Cell(85, 0, $biodata->nm_siswa, 0, 0, 'L');
        $pdf->ln(5);
        $tgl_lahir=$this->date_indo($biodata->tgl_lahir);
        $pdf->Cell(15);
        $pdf->Cell(55, 0, 'Tempat Tanggal Lahir', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	$pdf->Cell(85, 0, $biodata->tempat.', '.$tgl_lahir, 0, 0, 'L');
       	$pdf->ln(5);
       	        $pdf->Cell(15);
        $pdf->Cell(55, 0, 'Nama Orang Tua', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	$pdf->Cell(85, 0, $biodata->nama_ayah, 0, 0, 'L');
       	$pdf->ln(5);
       	        $pdf->Cell(15);
        $pdf->Cell(55, 0, 'Nomor Induk Sekolah (NIS)', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	$pdf->Cell(85, 0, $biodata->nis, 0, 0, 'L');
       	$pdf->ln(5);
       	        $pdf->Cell(15);
        $pdf->Cell(55, 0, 'Nomor Induk Nasional (NISN)', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	$pdf->Cell(85, 0, $biodata->nisn, 0, 0, 'L');
       	$pdf->ln(5);
       	$pdf->Cell(15);
        $pdf->Cell(55, 0, 'Nomor Peserta Ujian', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	$pdf->Cell(85, 0, $nilai->no_peserta_ujian, 0, 0, 'L');
       	$pdf->ln(5);
       	
       	 
        $pdf->Cell(70,10,'dinyatakan:','',0,'L');$pdf->SetFont('times', 'B', 12);$pdf->Cell(10,10,$nilai->kelulusan,'',1,'L');$pdf->SetFont('times', '', 12);

       	 $pdf->Cell(0,0,'dari sekolah menengah berdasarkan hasil ujian sekolah serta telah memenuhi seluruh kriteria sesuai ','',0,'L');
       	$pdf->ln();
       	$pdf->Cell(0,0,'peraturan perundang-undangan dengan nilai sebagai berikut:','',1,'L');
       	$pdf->ln(2);
       	$pdf->SetFont('times', '', 12);
       	$mulok='-';
       	$total=$nilai->PAIPB+$nilai->PKN+$nilai->BINDO+$nilai->MAT+$nilai->SJRINDO+$nilai->BING+$nilai->SENI+$nilai->PJOK+$nilai->PKWU+$nilai->MULOK+$nilai->GEO+$nilai->SJR+$nilai->SOS+$nilai->EKO+$nilai->LTM1;
       	$rata=$total/14;
       	$rata2=round($rata,2);
       	if($nilai->MULOK=='0' or $nilai->MULOK==0)
       	{
       	    $mulok='-';
       	}else
       	{
       	    $mulok=$nilai->MULOK;
       	}
       	$tabel = '
        <table border="1" cellpadding="2">
              <tr>
                    <th align="center" width="6%"> <b>No</b> </th>
                    <th  width="79%" align="center"> <b>Mata Pelajaran</b><br>Kurikulum 2013 </th>
                    <th  width="15%" align="center"> <b>Nilai Ujian Sekolah</b> </th>
              </tr>
 
            <tr><td align="left" colspan="3"><b>Kelompok A</b></td></tr>
            <tr><td align="center">1</td><td>Pendidikan Agama dan Budi Pekerti</td><td align="center">'.$this->xnilai($nilai->PAIPB).'</td></tr>
            <tr><td align="center">2</td><td>Pendidikan Pancasila dan Kewarganegaraan</td><td align="center">'.$this->xnilai($nilai->PKN).'</td></tr>
            <tr><td align="center">3</td><td>Bahasa Indonesia</td><td align="center">'.$this->xnilai($nilai->BINDO).'</td></tr>
            <tr><td align="center">4</td><td>Matematika</td><td align="center">'.$this->xnilai($nilai->MAT).'</td></tr>
            <tr><td align="center">5</td><td>Sejarah Indonesia</td><td align="center">'.$this->xnilai($nilai->SJRINDO).'</td></tr>
            <tr><td align="center">6</td><td>Bahasa Inggris</td><td align="center">'.$this->xnilai($nilai->BING).'</td></tr>
            <tr><td align="left" colspan="3"><b>Kelompok B</b></td></tr>
            <tr><td align="center">1</td><td>Seni Budaya</td><td align="center">'.$this->xnilai($nilai->SENI).'</td></tr>
            <tr><td align="center">2</td><td>Pendidikan Jasmani Olahraga dan Kesehatan</td><td align="center">'.$this->xnilai($nilai->PJOK).'</td></tr>
            <tr><td align="center">3</td><td>Prakarya dan Kewirausahaan</td><td align="center">'.$this->xnilai($nilai->PKWU).'</td></tr>
            <tr><td align="center">4</td><td>Muatan Lokal</td><td align="center">'.$this->xnilai($nilai->MULOK).'</td></tr>
            <tr><td align="left" colspan="3"><b>Kelompok C (Peminatan)</b></td></tr>
            <tr><td align="center">1</td><td>Geografi</td><td align="center">'.$this->xnilai($nilai->GEO).'</td></tr>
            <tr><td align="center">2</td><td>Sejarah</td><td align="center">'.$this->xnilai($nilai->SJR).'</td></tr>
            <tr><td align="center">3</td><td>Sosiologi</td><td align="center">'.$this->xnilai($nilai->SOS).'</td></tr>
            <tr><td align="center">4</td><td>Ekonomi</td><td align="center">'.$this->xnilai($nilai->EKO).'</td></tr>
            <tr><td align="center">5</td><td>Bahasa dan Sastra Arab</td><td align="center">'.$this->xnilai($nilai->LTM1).'</td></tr>
            <tr><td align="center" colspan="2"><b>Rata-Rata</b></td><td align="center"><b>'.$rata2.'</b></td></tr>
      </table>
        ';
 $pdf->writeHTML($tabel);
        $pdf->Cell(0,0,'Demikian surat keterangan ini dibuat untuk dapat digunakan sesuai dengan kebutuhan dan hanya ','',0,'L');
       	$pdf->ln();
       	$pdf->Cell(0,0,'berlaku sampai dengan diterbitkannya Ijazah Asli.','',1,'L');
       	$pdf->ln(2);
        
        $pdf->Cell(110);
        $pdf->Cell(0, 0, 'Buton Tengah', 0, 0, 'L');
       	$pdf->ln(5);
       	$pdf->Cell(110);
        $pdf->Cell(0, 0, 'Kepala Sekolah,', 0, 0, 'L');
       	$pdf->ln(22);
       	$pdf->Cell(110);
        $pdf->Cell(0, 0, $kasek->nm_kasek, 0, 0, 'L');
        $pdf->ln(5);
        $pdf->Cell(110);
        $pdf->Cell(0, 0, 'NIP.'.$kasek->nip_kasek, 0, 0, 'L');
        
        $pdf->setY(290);
        $pdf->writeHTML($qrcode);
    }
        $nm_file='SKL_'.$ta.'_'.$nis;
        
        $pdf->Output($nm_file.'.PDF','I');
	}
public function skl_ips($nis,$ta)
{

    //resource
    $sekolah=$this->get_sekolah();
    $biodata=$this->get_biodata($nis);
    $key['nis']=$nis;
    $key['kd_ta']=$ta;
    $nilai=$this->Crud_model->get_row_selected('vskl_ips',$key);
    
    $keykasek['kd_ta']=$ta;
    $kasek=$this->Crud_model->get_row_selected('kasek',$keykasek);
    
    //qrcode
    $cc='http://siakad.sman1masteng.sch.id/kasek/skl_ips/'.$nis.'/'.$ta;
    $qrcode='<img src="https://api.qrserver.com/v1/create-qr-code/?size=250x300&data='.$cc.'" heigth="85" width="85">';
    
    $this->load->library('Pdf');
        //$pdf = new FPDF('P', 'mm', 'Legal');
          $page=array(210,360);
        
        $pdf = new Pdf();

        
       $pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
        //$pdf = new PDF_MC_Table();
        $pdf->AddPage('P', $page, '', true);
        
        $pdf->SetMargins(17, 5, 15, 5);
        $pdf->SetFont('times', '', 12);

       // $pdf = new PDF_MC_Table('P', 'm
         $gambar1 = "assets/img/logo_sultra.png";
        //$gambar_siswa = "foto_siswa/".$biodata->image;
       
        $pdf->image($gambar1, 20, 19, 30);
        //$pdf->image($gambar_siswa, 50, 290, 25, 30, '', '', '', true, 150, '', false, false, 1, false, false, false);
        
        $pdf->SetFont('times', '', 12);
        $pdf->ln(5);
        $pdf->Cell(0, 10, 'PEMERINTAH PROVINSI SULAWESI TENGGARA', 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(0, 10, 'DINAS PENDIDIKAN DAN KEBUDAYAAN', 0, 0, 'C');
        $pdf->ln(5);
        $pdf->SetFont('times', 'B', 12);
       	$pdf->Cell(0, 10, $sekolah->nm_sekolah, 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(0, 10, 'TERAKREDITASI A', 0, 0, 'C');
      	$pdf->ln(4);
      	$pdf->SetFont('times', '', 12);
        $pdf->Cell(0, 10, $sekolah->alamat, 0, 0, 'C');
        $pdf->ln(4);
          $pdf->Cell(0, 10, 'Email:'.$sekolah->email, 0, 0, 'C');
        $pdf->ln(4);

        $pdf->Cell(0, 10, 'Website:'.$sekolah->website, 0, 0, 'C');
         $pdf->ln(2);
         $pdf->Cell(175, 1, '', 'B', 0, 'L');
        $pdf->ln(5);
        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(0, 8, 'SURAT KETERANGAN LULUS (SKL)', 0, 0, 'C');
        $pdf->ln(5);
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(0,5,'Program Studi: Ilmu Pengetahuan Sosial','',0,'C');
        $pdf->ln(6);
        $pdf->Cell(0, 5, 'Nomor: '.$nilai->no_surat, 0, 0, 'C');
        $pdf->ln(9);
        
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(10,8,'Yang bertanda tangan di bawah ini Kepala '. $sekolah->nm_sekolah_kecil.' menerangkan bahwa:','',0,'L');
        $pdf->ln(8);
        $pdf->Cell(15);
        $pdf->Cell(55, 0, 'Nama', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	$pdf->Cell(85, 0, $biodata->nm_siswa, 0, 0, 'L');
        $pdf->ln(5);
        $tgl_lahir=$this->date_indo($biodata->tgl_lahir);
        $pdf->Cell(15);
        $pdf->Cell(55, 0, 'Tempat Tanggal Lahir', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	$pdf->Cell(85, 0, $biodata->tempat.', '.$tgl_lahir, 0, 0, 'L');
       	$pdf->ln(5);
       	        $pdf->Cell(15);
        $pdf->Cell(55, 0, 'Nama Orang Tua', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	$pdf->Cell(85, 0, $biodata->nama_ayah, 0, 0, 'L');
       	$pdf->ln(5);
       	        $pdf->Cell(15);
        $pdf->Cell(55, 0, 'Nomor Induk Sekolah (NIS)', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	$pdf->Cell(85, 0, $biodata->nis, 0, 0, 'L');
       	$pdf->ln(5);
       	        $pdf->Cell(15);
        $pdf->Cell(55, 0, 'Nomor Induk Nasional (NISN)', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	$pdf->Cell(85, 0, $biodata->nisn, 0, 0, 'L');
       	$pdf->ln(5);
       	$pdf->Cell(15);
        $pdf->Cell(55, 0, 'Nomor Peserta Ujian', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	$pdf->Cell(85, 0, $nilai->no_peserta_ujian, 0, 0, 'L');
       	$pdf->ln(5);
       	
       	 
        $pdf->Cell(70,10,'dinyatakan:','',0,'L');$pdf->SetFont('times', 'B', 12);$pdf->Cell(10,10,$nilai->kelulusan,'',1,'L');$pdf->SetFont('times', '', 12);

       	 $pdf->Cell(0,0,'dari sekolah menengah berdasarkan hasil ujian sekolah serta telah memenuhi seluruh kriteria sesuai ','',0,'L');
       	$pdf->ln();
       	$pdf->Cell(0,0,'peraturan perundang-undangan dengan nilai sebagai berikut:','',1,'L');
       	$pdf->ln(2);
       	$pdf->SetFont('times', '', 12);
       	$mulok='-';
       	$total=$nilai->PAIPB+$nilai->PKN+$nilai->BINDO+$nilai->MAT+$nilai->SJRINDO+$nilai->BING+$nilai->SENI+$nilai->PJOK+$nilai->PKWU+$nilai->MULOK+$nilai->GEO+$nilai->SJR+$nilai->SOS+$nilai->EKO+$nilai->LTM1;
       	$rata=$total/14;
       	$rata2=round($rata,2);
       	if($nilai->MULOK=='0' or $nilai->MULOK==0)
       	{
       	    $mulok='-';
       	}else
       	{
       	    $mulok=$nilai->MULOK;
       	}
       	$tabel = '
        <table border="1" cellpadding="2">
              <tr>
                    <th align="center" width="6%"> <b>No</b> </th>
                    <th  width="79%" align="center"> <b>Mata Pelajaran</b><br>Kurikulum 2013 </th>
                    <th  width="15%" align="center"> <b>Nilai Ujian Sekolah</b> </th>
              </tr>
 
            <tr><td align="left" colspan="3"><b>Kelompok A</b></td></tr>
            <tr><td align="center">1</td><td>Pendidikan Agama dan Budi Pekerti</td><td align="center">'.$this->xnilai($nilai->PAIPB).'</td></tr>
            <tr><td align="center">2</td><td>Pendidikan Pancasila dan Kewarganegaraan</td><td align="center">'.$this->xnilai($nilai->PKN).'</td></tr>
            <tr><td align="center">3</td><td>Bahasa Indonesia</td><td align="center">'.$this->xnilai($nilai->BINDO).'</td></tr>
            <tr><td align="center">4</td><td>Matematika</td><td align="center">'.$this->xnilai($nilai->MAT).'</td></tr>
            <tr><td align="center">5</td><td>Sejarah Indonesia</td><td align="center">'.$this->xnilai($nilai->SJRINDO).'</td></tr>
            <tr><td align="center">6</td><td>Bahasa Inggris</td><td align="center">'.$this->xnilai($nilai->BING).'</td></tr>
            <tr><td align="left" colspan="3"><b>Kelompok B</b></td></tr>
            <tr><td align="center">1</td><td>Seni Budaya</td><td align="center">'.$this->xnilai($nilai->SENI).'</td></tr>
            <tr><td align="center">2</td><td>Pendidikan Jasmani Olahraga dan Kesehatan</td><td align="center">'.$this->xnilai($nilai->PJOK).'</td></tr>
            <tr><td align="center">3</td><td>Prakarya dan Kewirausahaan</td><td align="center">'.$this->xnilai($nilai->PKWU).'</td></tr>
            <tr><td align="center">4</td><td>Muatan Lokal</td><td align="center">'.$this->xnilai($nilai->MULOK).'</td></tr>
            <tr><td align="left" colspan="3"><b>Kelompok C (Peminatan)</b></td></tr>
            <tr><td align="center">1</td><td>Geografi</td><td align="center">'.$this->xnilai($nilai->GEO).'</td></tr>
            <tr><td align="center">2</td><td>Sejarah</td><td align="center">'.$this->xnilai($nilai->SJR).'</td></tr>
            <tr><td align="center">3</td><td>Sosiologi</td><td align="center">'.$this->xnilai($nilai->SOS).'</td></tr>
            <tr><td align="center">4</td><td>Ekonomi</td><td align="center">'.$this->xnilai($nilai->EKO).'</td></tr>
            <tr><td align="center">5</td><td>Bahasa dan Sastra Arab</td><td align="center">'.$this->xnilai($nilai->LTM1).'</td></tr>
            <tr><td align="center" colspan="2"><b>Rata-Rata</b></td><td align="center"><b>'.$rata2.'</b></td></tr>
      </table>
        ';
 $pdf->writeHTML($tabel);
        $pdf->Cell(0,0,'Demikian surat keterangan ini dibuat untuk dapat digunakan sesuai dengan kebutuhan dan hanya ','',0,'L');
       	$pdf->ln();
       	$pdf->Cell(0,0,'berlaku sampai dengan diterbitkannya Ijazah Asli.','',1,'L');
       	$pdf->ln(2);
        
        $pdf->Cell(110);
        $pdf->Cell(0, 0, 'Buton Tengah', 0, 0, 'L');
       	$pdf->ln(5);
       	$pdf->Cell(110);
        $pdf->Cell(0, 0, 'Kepala Sekolah,', 0, 0, 'L');
       	$pdf->ln(22);
       	$pdf->Cell(110);
        $pdf->Cell(0, 0, $kasek->nm_kasek, 0, 0, 'L');
        $pdf->ln(5);
        $pdf->Cell(110);
        $pdf->Cell(0, 0, 'NIP.'.$kasek->nip_kasek, 0, 0, 'L');
        
        $pdf->setY(290);
        $pdf->writeHTML($qrcode);
        $nm_file='SKL_'.$ta.'_'.$nis;
        $pdf->Output($nm_file.'.PDF','I');
}

function xnilai($nilai)
{
    
    if($nilai==0 or $nilai=='0')
    {
        $nilai='-';
    }
    return $nilai;
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
        return $semester;
    }
public function skl_ipa($nis,$ta)
{

    //resource
    $sekolah=$this->get_sekolah();
    $biodata=$this->get_biodata($nis);
    $key['nis']=$nis;
    $key['kd_ta']=$ta;
    $nilai=$this->Crud_model->get_row_selected('vskl_ipa',$key);
    
    $keykasek['kd_ta']=$ta;
    $kasek=$this->Crud_model->get_row_selected('kasek',$keykasek);
    
    //qrcode
    $cc='http://siakad.sman1masteng.sch.id/kasek/skl_ips/'.$nis.'/'.$ta;
    $qrcode='<img src="https://api.qrserver.com/v1/create-qr-code/?size=250x300&data='.$cc.'" heigth="85" width="85">';
    
    $this->load->library('Pdf');
        //$pdf = new FPDF('P', 'mm', 'Legal');
          $page=array(210,360);
        
        $pdf = new Pdf();

        
       $pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
        //$pdf = new PDF_MC_Table();
        $pdf->AddPage('P', $page, '', true);
        
        $pdf->SetMargins(17, 5, 15, 5);
        $pdf->SetFont('times', '', 12);

       // $pdf = new PDF_MC_Table('P', 'm
         $gambar1 = "assets/img/logo_sultra.png";
        //$gambar_siswa = "foto_siswa/".$biodata->image;
       
        $pdf->image($gambar1, 18, 19, 30);
        //$pdf->image($gambar_siswa, 50, 290, 25, 30, '', '', '', true, 150, '', false, false, 1, false, false, false);
        
        $pdf->SetFont('times', '', 12);
        $pdf->ln(5);
        $pdf->Cell(0, 10, 'PEMERINTAH PROVINSI SULAWESI TENGGARA', 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(0, 10, 'DINAS PENDIDIKAN DAN KEBUDAYAAN', 0, 0, 'C');
        $pdf->ln(5);
        $pdf->SetFont('times', 'B', 12);
       	$pdf->Cell(0, 10, $sekolah->nm_sekolah, 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(0, 10, 'TERAKREDITASI A', 0, 0, 'C');
      	$pdf->ln(4);
      	$pdf->SetFont('times', '', 12);
        $pdf->Cell(0, 10, $sekolah->alamat, 0, 0, 'C');
        $pdf->ln(4);
          $pdf->Cell(0, 10, 'Email:'.$sekolah->email, 0, 0, 'C');
        $pdf->ln(4);

        $pdf->Cell(0, 10, 'Website:'.$sekolah->website, 0, 0, 'C');
         $pdf->ln(2);
         $pdf->Cell(175, 1, '', 'B', 0, 'L');
        $pdf->ln(5);
        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(0, 8, 'SURAT KETERANGAN LULUS (SKL)', 0, 0, 'C');
        $pdf->ln(6);
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(0,5,'Program Studi: Matematika dan Ilmu Pengetahuan Alam','',0,'C');
        $pdf->ln(6);
        $pdf->Cell(0, 5, $nilai->no_surat, 0, 0, 'C');
        $pdf->ln(9);
        
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(10,8,'Yang bertanda tangan di bawah ini Kepala '. $sekolah->nm_sekolah_kecil.' menerangkan bahwa:','',0,'L');
        $pdf->ln(8);
        $pdf->Cell(15);
        $pdf->Cell(55, 0, 'Nama', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	$pdf->Cell(85, 0, $biodata->nm_siswa, 0, 0, 'L');
        $pdf->ln(5);
        $tgl_lahir=$this->date_indo($biodata->tgl_lahir);
        $pdf->Cell(15);
        $pdf->Cell(55, 0, 'Tempat Tanggal Lahir', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	$pdf->Cell(85, 0, $biodata->tempat.', '.$tgl_lahir, 0, 0, 'L');
       	$pdf->ln(5);
       	        $pdf->Cell(15);
        $pdf->Cell(55, 0, 'Nama Orang Tua', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	$pdf->Cell(85, 0, $biodata->nama_ayah, 0, 0, 'L');
       	$pdf->ln(5);
       	        $pdf->Cell(15);
        $pdf->Cell(55, 0, 'Nomor Induk Sekolah (NIS)', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	$pdf->Cell(85, 0, $biodata->nis, 0, 0, 'L');
       	$pdf->ln(5);
       	        $pdf->Cell(15);
        $pdf->Cell(55, 0, 'Nomor Induk Nasional (NISN)', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	$pdf->Cell(85, 0, $biodata->nisn, 0, 0, 'L');
       	$pdf->ln(5);
       	$pdf->Cell(15);
        $pdf->Cell(55, 0, 'Nomor Peserta Ujian', 0, 0, 'L');
        $pdf->Cell(2, 0, ':', 0, 0, 'C');
       	$pdf->Cell(85, 0, $nilai->no_peserta_ujian, 0, 0, 'L');
       	$pdf->ln(5);
       	
       	 
        $pdf->Cell(70,10,'dinyatakan:','',0,'L');$pdf->SetFont('times', 'B', 12);$pdf->Cell(10,10,$nilai->kelulusan,'',1,'L');$pdf->SetFont('times', '', 12);

       	 $pdf->Cell(0,0,'dari sekolah menengah berdasarkan hasil ujian sekolah serta telah memenuhi seluruh kriteria sesuai ','',0,'L');
       	$pdf->ln();
       	$pdf->Cell(0,0,'peraturan perundang-undangan dengan nilai sebagai berikut:','',1,'L');
       	$pdf->ln(2);
       	$pdf->SetFont('times', '', 12);
       	
       	       	$total=$nilai->PAIPB+$nilai->PKN+$nilai->BINDO+$nilai->MAT+$nilai->SJRINDO+$nilai->BING+$nilai->SENI+$nilai->PJOK+$nilai->PKWU+$nilai->MULOK+$nilai->MATIPA+$nilai->BIO+$nilai->FIS+$nilai->KIM+$nilai->LTM1;
       	$rata=$total/14;
       	$rata2=round($rata,2);
       	$tabel = '
        <table border="1" cellpadding="2">
              <tr>
                    <th align="center" width="6%"> <b>No</b> </th>
                    <th  width="79%" align="center"> <b>Mata Pelajaran</b><br>Kurikulum 2013 </th>
                    <th  width="15%" align="center"> <b>Nilai Ujian Sekolah</b> </th>
              </tr>
 
            <tr><td align="left" colspan="3"><b>Kelompok A</b></td></tr>
            <tr><td align="center">1</td><td>Pendidikan Agama dan Budi Pekerti</td><td align="center">'.$this->xnilai($nilai->PAIPB).'</td></tr>
            <tr><td align="center">2</td><td>Pendidikan Pancasila dan Kewarganegaraan</td><td align="center">'.$this->xnilai($nilai->PKN).'</td></tr>
            <tr><td align="center">3</td><td>Bahasa Indonesia</td><td align="center">'.$this->xnilai($nilai->BINDO).'</td></tr>
            <tr><td align="center">4</td><td>Matematika</td><td align="center">'.$this->xnilai($nilai->MAT).'</td></tr>
            <tr><td align="center">5</td><td>Sejarah Indonesia</td><td align="center">'.$this->xnilai($nilai->SJRINDO).'</td></tr>
            <tr><td align="center">6</td><td>Bahasa Inggris</td><td align="center">'.$this->xnilai($nilai->BING).'</td></tr>
            <tr><td align="left" colspan="3"><b>Kelompok B</b></td></tr>
            <tr><td align="center">1</td><td>Seni Budaya</td><td align="center">'.$this->xnilai($nilai->SENI).'</td></tr>
            <tr><td align="center">2</td><td>Pendidikan Jasmani Olahraga dan Kesehatan</td><td align="center">'.$this->xnilai($nilai->PJOK).'</td></tr>
            <tr><td align="center">3</td><td>Prakarya dan Kewirausahaan</td><td align="center">'.$this->xnilai($nilai->PKWU).'</td></tr>
            <tr><td align="center">4</td><td>Muatan Lokal</td><td align="center">'.$this->xnilai($nilai->MULOK).'</td></tr>
            <tr><td align="left" colspan="3"><b>Kelompok C (Peminatan)</b></td></tr>
            <tr><td align="center">1</td><td>Matematika</td><td align="center">'.$this->xnilai($nilai->MATIPA).'</td></tr>
            <tr><td align="center">2</td><td>Biologi</td><td align="center">'.$this->xnilai($nilai->BIO).'</td></tr>
            <tr><td align="center">3</td><td>Fisika</td><td align="center">'.$this->xnilai($nilai->FIS).'</td></tr>
            <tr><td align="center">4</td><td>Kimia</td><td align="center">'.$this->xnilai($nilai->KIM).'</td></tr>
            <tr><td align="center">5</td><td>Bahasa dan Sastra Arab</td><td align="center">'.$this->xnilai($nilai->LTM1).'</td></tr>
            <tr><td align="center" colspan="2"><b>Rata-Rata</b></td><td align="center"><b>'.$rata2.'</b></td></tr>
      </table>
        ';
 $pdf->writeHTML($tabel);
        $pdf->Cell(0,0,'Demikian surat keterangan ini dibuat untuk dapat digunakan sesuai dengan kebutuhan dan hanya ','',0,'L');
       	$pdf->ln();
       	$pdf->Cell(0,0,'berlaku sampai dengan diterbitkannya Ijazah Asli.','',1,'L');
       	$pdf->ln(2);
        
        $pdf->Cell(110);
        $pdf->Cell(0, 0, 'Buton Tengah', 0, 0, 'L');
       	$pdf->ln(5);
       	$pdf->Cell(110);
        $pdf->Cell(0, 0, 'Kepala Sekolah,', 0, 0, 'L');
       	$pdf->ln(22);
       	$pdf->Cell(110);
        $pdf->Cell(0, 0, $kasek->nm_kasek, 0, 0, 'L');
        $pdf->ln(5);
        $pdf->Cell(110);
        $pdf->Cell(0, 0, 'NIP.'.$kasek->nip_kasek, 0, 0, 'L');
        
        $pdf->setY(290);
        $pdf->writeHTML($qrcode);
        $nm_file='SKL_'.$ta.'_'.$nis;
        $pdf->Output($nm_file.'.PDF','I');
}
public function rapor_nilai($nis,$ta)
    {
        $this->load->library('Pdf');
        // $gambar2 = "assets/img/logo.jpg";
      
            $cc='http://siakad.sman1masteng.sch.id/kasek/rapor_nilai/'.$nis.'/'.$ta;
        //$pdf->image($gambar1, 89, 30, 35);
        $level = $this->session->userdata('level');
        $qrcode='<img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data='.$cc.'" heigth="40" width="60">';
    $keykal['kd_ta']=$ta;
	    $keykal['kegiatan']='7';
	$tanggalcetak='';
	$kalender_akademik=$this->Crud_model->get_row_selected('kalender_akademik',$keykal);
	if($kalender_akademik)
	{
//$tanggalcetak = date('Y-m-d');
  $tanggalcetak = $kalender_akademik->tgl_selesai;
         
        // $tanggalcetak = date('Y-m-d');
        $tanggalcetak=$this->date_indo($tanggalcetak);
       // $absensi=$this->get_rekap_absensi_siswa($ta,$nis);
	}  
        if($level=='siswa')
        {
            $this->cek_biodata($nis);    
        }
        $ta_huruf='';
        $predikat='E';
    	$biodata=$this->get_biodata($nis);
    	
    	$semester_siswa=$this->get_semester_siswa($biodata->angkatan,$ta);
    	$keykasek['kd_ta']=$ta;
    	$kasek=$this->Crud_model->get_row_selected('kasek',$keykasek);
    	$keykelas['id_kelas']=$biodata->kelas;
    	$tingkat=$this->Crud_model->get_row_selected('kelas',$keykelas);
    	$keykkm['tingkat']=$tingkat->tingkat;
    	$kkmx=$this->Crud_model->get_row_selected('kkm',$keykkm);
    	$kelompok=$this->Crud_model->get_all('kelompok_pelajaran');
    	$kd_ta=$ta;
    	$spri=0;
    	$sos=0;
    	$sekolah=$this->get_sekolah();
       
        $guru=$this->get_wali_kelas($biodata->kelas,$ta);
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
        $ta=$this->get_semester($ta);
        $nip_wali_kelas=$guru->nip;
        $ta_huruf=$this->Crud_model->angka_to_huruf($semester_siswa);
        
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
    

        $page=array(210,330);
       $pdf = new Pdf('P', 'mm', $page);
     // $pdf = new Pdf ('P', 'mm', 'Legal');
       $pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
       // $pdf = new PDF_MC_Table('P', 'mm', 'A4');
     //$pdf->setFontSubsetting(true);

//$pdf->SetFont('dejavusans', '', 14, '', true);
     	 $pdf->AddPage();
        $pdf->SetMargins(10, 8, 10, 0);
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
       	 $pdf->Cell(10,0,$semester_siswa.'('.$ta_huruf.')',0,0,'L');
       
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
         $pdf->Cell(190, 1, '', 'B', 1, 'L');
       


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
        <table border="1" cellpadding="2">
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
        $pdf->SetFont('times', '', 11);
         $tabel = '
        <table border="1" cellpadding="2">
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
       
       
        $pdf->setY(250);
     
        
 $pdf->writeHTML($qrcode);
     
        
 //$pdf->writeHTML($qrcode);

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
       	 $pdf->Cell(10,0,$semester_siswa.'('.$ta_huruf.')',0,0,'L');
       
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
         
         $pdf->Cell(190, 1, '', 'B', 1, 'L');
          $pdf->ln(5);
          $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(10, 5, 'B. Pengetahuan', 0, 0, 'L');
        $pdf->ln(5);
 $pdf->SetFont('times', '', 11);
        $pdf->Cell(35, 0, 'Kriteria Ketuntasan Minimal = '.$kkmx->kkm, 0, 0, 'L');

        
        
        $pdf->ln(6);
       
 
        	
      
		$sql="SELECT `nilai`.`kd_jadwal`,`nilai`.`nilai_spritual`,`nilai`.`nilai_sosial`,`nilai`.`nilai_pengetahuan`,
			  `nilai`.`desc_nilai_pengetahuan`,`nilai`.`nilai_keterampilan`,`nilai`.`desc_nilai_keterampilan`,`jadwal`.`kd_pelajaran`,
			  `jadwal`.`id_guru`,`jadwal`.`kd_ta`,`pelajaran`.`nm_pelajaran`,`pelajaran`.`kategori`,`pelajaran`.`subkategori`,`nilai`.`nis`,kelompok
				FROM `nilai` INNER JOIN `jadwal` ON `nilai`.`kd_jadwal` = `jadwal`.`kd_jadwal` INNER JOIN `pelajaran` ON `jadwal`.`kd_pelajaran` = `pelajaran`.`kd_pelajaran` WHERE `nilai`.`nis`='".$nis."'  and jadwal.kd_ta='".$kd_ta."' and pelajaran.kelompok='A' order by pelajaran.urutan asc";
	 		$A=$this->db->query($sql)->result();
       	
       	
       		
       		 $header ='
        <table border="1" cellpadding="2">
              <tr>
                    <th align="center" width="4%"><b>No</b></th>
                    <th width="30%" align="left"><b>  Mata Pelajaran</b> </th>
                    <th align="center" width="7%"><b> Nilai</b> </th>
                    <th align="center" width="10%"><b>Predikat</b> </th>
                    <th width="49%" align="left"><b>Deskripsi</b> </th>
              </tr>'
             ;
              	
            $kkm=$kkmx->kkm;
            
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
       //$pdf->Cell(0, 0, '*) : Bila Ada', 0, 0, 'L');
$pdf->setY(250);
     
        
 $pdf->writeHTML($qrcode);
//$pdf->setY(330-45);
    // $pdf->setXY(120,330-42);
        
// $pdf->writeHTML($qrcode);

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
       	 $pdf->Cell(10,0,$semester_siswa.'('.$ta_huruf.')',0,0,'L');
       
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
         
         $pdf->Cell(190, 1, '', 'B', 1, 'L');
          $pdf->ln(5);

          $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(10, 5, 'C. Keterampilan', 0, 0, 'L');
        $pdf->ln(5);
      
      	 $pdf->SetFont('times', '', 11);
        $pdf->Cell(35, 0, 'Kriteria Ketuntasan Minimal = '.$kkmx->kkm, 0, 0, 'L');
       
        	
         $headerx ='
        <table border="1" cellpadding="2">
              <tr>
                    <th align="center" width="4%"><b>No</b></th>
                    <th width="30%" align="left"><b>  Mata Pelajaran</b> </th>
                    <th align="center" width="7%"><b> Nilai</b> </th>
                    <th align="center" width="10%"><b>Predikat</b> </th>
                    <th width="49%" align="left"><b>Deskripsi</b> </th>
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
        $pdf->setY(250);
     
        
 $pdf->writeHTML($qrcode);
 //$pdf->writeHTML($qrcode);
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
       	 $pdf->Cell(10,0,$semester_siswa.'('.$ta_huruf.')',0,0,'L');
       
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
         
         $pdf->Cell(190, 1, '', 'B', 1, 'L');
          $pdf->ln(5);

         $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(10, 5, 'D. Ekstra Kurikuler', 0, 0, 'L');
        $pdf->ln(6);
       

        $sql="SELECT kd_ta,nilai_ekstrakurikuler.kd_ekstra,nis,nilai_ekstrakurikuler.deskripsi,nilai_ekstrakurikuler.nilai from nilai_ekstrakurikuler where   kd_ta='".$kd_ta."' and nis='".$nis."'";
	 		$DEK=$this->db->query($sql)->result();
       	
       	
       		$pdf->SetFont('times', '', 11);
       		 $headerekstra ='
        <table border="1" cellpadding="1">
              <tr>
                    <th align="center" width="5%"><b>No</b></th>
                    <th width="35%" align="left"><b>  Kegiatan Ekstra Kurikuler</b> </th>
                    <th align="center" width="15%"><b>Predikat</b> </th>
                    <th width="45%" align="left"><b>Deskripsi</b> </th>
              </tr>'
             ;
             	$akhirx='</table>';
              	

             $ekstra='';
              	$noekstra=1;
             
            if($DEK)
            {
                foreach ($DEK as $rdek) {
       		    $predikatekstra= $this->angka_to_grade_ekstra($rdek->nilai);
       		    $outputekstra = '<tr>
    			<td align="center" align="center">'.$noekstra++.'</td>
    			<td align="left">'.$rdek->kd_ekstra.'</td>
    			<td align="center">'.$predikatekstra.'</td>
    			<td align="left" >'.$rdek->deskripsi.'</td>
    			</tr>';
    			$ekstra=$ekstra.$outputekstra;
       		    }
            }else
            {
                    $outputekstra='          <tr>
                    <td align="center" width="5%">1</td>
                    <td width="35%" align="left"></td>
                    <td align="center" width="15%"><b></b> </td>
                    <td width="45%" align="left"><b></b> </td>
              </tr>';
            }
       	$pdf->writeHTML($headerekstra.$outputekstra.$akhirx);

        
        
         $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(10, 5, 'E. Prestasi', 0, 0, 'L');
       $pdf->ln(6);

        $sql="SELECT * FROM prestasi WHERE kd_ta='".$kd_ta."' and nis='".$nis."'";
	 		$lprestasi=$this->db->query($sql)->result();
       	
       	
       		$pdf->SetFont('times', '', 12);
       		 $headerpres ='
        <table border="1" cellpadding="2">
              <tr>
                    <th align="center" width="5%"><b>No</b></th>
                    <th width="35%" align="left"><b> Jenis Prestasi</b> </th>
                    <th width="60%" align="left"><b> Keterangan</b> </th>
              </tr>'
             ;
             	
              	

            $outputpres='';
              	$nopres=1;
             $rpres='';
            if($lprestasi)
            {
                foreach ($lprestasi as $prestasi) {
       		   
       		    $outputpres= '<tr>
    			<td  width="5%" align="center" align="center">'.$nopres++.'</td>
    			<td width="35%" align="left">'.$prestasi->jenis_prestasi.'</td>
    			<td align="left" width="60%" >'.$prestasi->keterangan.'</td>
    			</tr>';
    			$rpres=$rpres.$outputpres;
       		    }
            }else
            {
                    $outputpres='          <tr>
                    <td align="center" width="5%">1</td>
                    <td width="35%" align="left"></td>
                    <td width="60%" align="left"> </td>
                    </tr>';
            }
            $akhirx='</table>';
       	$pdf->writeHTML($headerpres.$outputpres.$akhirx);

       	$sqlx="SELECT SUM(hadir) as tot_hadir,SUM(izin) as tot_izin,SUM(sakit) as tot_sakit,SUM(alpa) as tot_alpa,sum(bolos) as tot_bolos FROM `absen_harian` where kd_ta='".$kd_ta."' and nis='".$nis."' group by kd_ta,nis";
			$absensi=$this->db->query($sqlx)->row();
		
		$sakit=0;
		$izin=0;
		$alpa=0;
		
		if($absensi)
		{
		    $sakit=$absensi->tot_sakit;
	    	$izin=$absensi->tot_izin;
		    $alpa=$absensi->tot_alpa+$absensi->tot_bolos;
		
		}
		

         $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(10, 5, 'F. Ketidak Hadiran', 0, 0, 'L');
       $pdf->ln(6);

        $pdf->SetFont('times', '', 12);
         $pdf->Cell(50, 6, 'Sakit', 1, 0, 'L');
         $pdf->Cell(20, 6,$sakit.' Hari', 1, 0, 'C');
         
		 $pdf->ln(6);
       	$pdf->Cell(50, 6, 'Izin', 1, 0, 'L');
       	$pdf->Cell(20, 6, $izin. ' Hari', 1, 0, 'C');
		 $pdf->ln(6);
		 $pdf->Cell(50, 6, 'Tanpa Keterangan', 1, 0, 'L');
		 $pdf->Cell(20, 6, $alpa.' Hari', 1, 0, 'C');
		 $pdf->ln(6);
       	$pdf->ln();

        $sqlc="SELECT catatan from catatan_wali_kelas where nis='".$nis."' and kd_ta='".$kd_ta."'";
			$hasilc=$this->db->query($sqlc)->row();
			$catatan='';
			if($hasilc)
			{
			    $catatan=$hasilc->catatan;
			}
         $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(10, 5, 'G. Catatan Wali Kelas', 0, 0, 'L');
        $pdf->ln(6);
        $pdf->SetFont('times', '', 12);
        
         $outputcatatan= '<table border="1" cellpadding="6"><tr>
    			<td   align="left">'.$catatan.'</td>
    		
    			</tr></table>';
        $pdf->writeHTML($outputcatatan);
         
        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(10, 5, 'H. Tanggapan Orang Tua / Wali', 0, 0, 'L');
         $pdf->ln(6);
        $pdf->Cell(190, 20,'' , 1, 1, 'L');
        
        $pdf->ln(4);
        $genap=$ta->semester;
        if(($genap=='2' or $genap==2) and ($semester_siswa=='6' or $semester_siswa==6))
        {
            $pdf->SetFont('times', 'B', 11);
         $pdf->Cell(190, 7,'Keterangan Kelulusan: Lulus' , 1, 1, 'L');
         $pdf->ln(4);
        }
        elseif($genap=='2' or $genap==2)
        {
            $pdf->SetFont('times', 'B', 11);
         $pdf->Cell(190, 7,'Keterangan Kenaikan Kelas: Naik Kelas' , 1, 1, 'L');
         $pdf->ln(4);
        }//peringkat
        $ayah='';
         if($biodata->nama_ayah)
         {
             $ayah=$biodata->nama_ayah;
         }elseif($biodata->nama_ibu)
         {
             $ayah=$biodata->nama_ibu;
         }else
         {
             $ayah=$biodata->nama_wali;
         }
         
         

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
       	$pdf->Cell(80, 5,   $ayah , 0, 0, 'C');
       		$pdf->Cell(15, 5,'', 0, 0, 'C');
       	$pdf->Cell(80, 5, $nm_wali_kelas, 0, 0, 'C');
       	$pdf->ln(1);
       	 $pdf->Cell(116);
        $pdf->Cell(50, 1, '', 'B', 1, 'L');
       	//$pdf->ln(6);
       	  $pdf->Cell(6);
       	$pdf->Cell(80, 5, '  ', 0, 0, 'C');
       	$pdf->Cell(30, 5, '  ', 0, 0, 'C');
       	
       	$pdf->Cell(80, 5, 'NIP. '.$nip_wali_kelas, 0, 0, 'L');
       	 
       	$pdf->ln(10);
         $pdf->Cell(80);
       	$pdf->Cell(20, 5, ' Mengetahui, ', 0, 0, 'C');
       		$pdf->ln();
       		$pdf->Cell(80);
       	$pdf->Cell(20, 5, ' Kepala Sekolah, ', 0, 0, 'C');

       	$pdf->ln(25);
         $pdf->Cell(80);
       	$pdf->Cell(20, 5, $kasek->nm_kasek, 0, 0, 'C');
       	 $pdf->ln(1);
         $pdf->Cell(65);
         $pdf->Cell(50, 1, '', 'B', 1, 'L');
       //$pdf->Line(float x1, float y1, float x2, float y2)
      // $pdf->Line(80,276,150,276);
       	
       	
       		$pdf->Cell(80);
       	$pdf->Cell(20, 5, ' NIP. '.$kasek->nip_kasek, 0, 0, 'C');

$pdf->setY(250);
     
        
 $pdf->writeHTML($qrcode);
//ob_end_clean();

          $pdf->Output('rapor.pdf','I');
    }
    
    
    function rapor($nis,$ta){

    
	$biodata=$this->get_biodata($nis);
	$tgl=$this->date_indo($biodata->tgl_lahir);
	$sekolah=$this->get_sekolah();
    $semester=$this->get_semester($ta);
    $keykasek['kd_ta']=$ta;
    $kasek=$this->Crud_model->get_row_selected('kasek',$keykasek);
	if($biodata->jk=="L")
	{
		$jk="Laki-Laki";

	}else
	{
		$jk="Perempuan";

	}
	$anak_ke=$this->Crud_model->angka_to_huruf($biodata->anak_ke);
	$keykal['kd_ta']=$ta;
	$keykal['kegiatan']='7';
	
	$kalender_akademik=$this->Crud_model->get_row_selected('kalender_akademik',$keykal);
	
//$tanggalcetak = date('Y-m-d');
  $tanggalcetak = $kalender_akademik->tgl_selesai;
  
        $tanggalcetak=$this->date_indo($tanggalcetak);
//$this->load->library('pdf');
  
$this->load->library('Cfpdf');
        //$pdf = new FPDF('P', 'mm', 'Legal');
         
        $pdf = new Cfpdf('P', 'mm', 'Legal');

        //$pdf = new PDF_MC_Table();
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
        $pdf->Cell(0, 8, '', 0, 0, 'L');
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
        $jumlah=strlen($kasek->nip_kasek);
        $pdf->Cell(120);
        $pdf->Cell(0, 8, $kasek->nm_kasek, 0, 0,'L');
        $pdf->ln(5);
        $pdf->Cell(120);
         $pdf->Cell(50, 1, '', 'B', 1, 'L');
        
          $pdf->Cell(120);
        $pdf->Cell(0, 8, 'NIP.'.$kasek->nip_kasek, 0, 0,'L');
        $pdf->ln(5);

$pdf->Output('COVER_RAPOR.PDF','I');
        //$pdf->Output('$namaPDF','I');

    }
    
    function lap_bulanan_siswa($kd_ta,$bulan,$nis)
    {
        $page=array(210,330);
        $pdf = new TCPDF('P', 'mm', $page);
        $pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

     	$pdf->AddPage();
        $pdf->SetMargins(10, 10, 10, 0);
        $pdf->SetFont('times', '', 12);
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------
        //resource
        $biodata=$this->get_biodata($nis);
        $ta=$this->get_semester($kd_ta);
        $sekolah=$this->get_sekolah();
        $ta_huruf=$this->angka_to_huruf($biodata->semester);
        
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------
        //HEADER
        $pdf->SetFont('times', 'B', 16);
        $bulan_angka=$this->bulan($bulan);
        $pdf->Cell(0, 10, 'LAPORAN BULANAN PESERTA DIDIK', 0, 0, 'C');
        $pdf->ln(15);
         $pdf->SetFont('times', '', 12);
        //row1
        $pdf->Cell(28, 0, 'Nama Sekolah', 0, 0, 'L');$pdf->Cell(2, 0, ':', 0, 0, 'C');$pdf->Cell(85, 0, $sekolah->nm_sekolah_kecil, 0, 0, 'L');$pdf->Cell(28, 0, 'Kelas', 0, 0, 'L');$pdf->Cell(2, 0, ':', 0, 0, 'C');$pdf->Cell(10,0,$biodata->kelas,0,0,'L');$pdf->ln(5);
        //row2
        $pdf->Cell(28, 0, 'Alamat', 0, 0, 'L');$pdf->Cell(2, 0, ':', 0, 0, 'C');$pdf->Cell(85,0,$sekolah->alamat,0,0,'L');$pdf->Cell(28, 0, 'Semester', 0, 0, 'L');$pdf->Cell(2, 0, ':', 0, 0, 'C');$pdf->Cell(10,0,$semester_siswa.'('.$ta_huruf.')',0,0,'L');$pdf->ln(5);
      	
        $pdf->Cell(28, 0, 'Nama', 0, 0, 'L');$pdf->Cell(2, 0, ':', 0, 0, 'C');$pdf->Cell(85,0,$biodata->nm_siswa,0,0,'L');$pdf->Cell(28, 0, 'Tahun Pelajaran', 0, 0, 'L');$pdf->Cell(2, 0, ':', 0, 0, 'C');$pdf->Cell(10,0,$ta->thn_ajaran,0,0,'L');$pdf->ln(5);
      	
        $pdf->Cell(28, 0, 'NIS/NISN', 0, 0, 'L');$pdf->Cell(2, 0, ':', 0, 0, 'C');$pdf->Cell(85,0,$biodata->nis.'/'.$biodata->nisn,0,0,'L');$pdf->Cell(28, 0, 'Keadaan Bulan', 0, 0, 'L');$pdf->Cell(2, 0, ':', 0, 0, 'C');$pdf->Cell(10,0,$bulan_angka,0,0,'L');$pdf->ln(2);
        $pdf->Cell(190, 1, '', 'B', 1, 'L');
        $pdf->ln(6);
        //page 1
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------
        //sesi_a Rekapitulasi Kehadiran di Sekolah
        $row_a=$this->get_rekap_absensi_siswa_sekolah($kd_ta,$bulan,$nis);
        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(10, 5, 'A. Rekapitulasi Kehadiran di Sekolah', 0, 0, 'L');
        $pdf->ln(6);
         $pdf->SetFont('times', 'B', 12);
        $head_a='<table border="1" cellpadding="2">
        <tr>
        <td rowspan="2" align="center" width="5%">No</td>
        <td rowspan="2" width="47%" valign="middle" align ="Center">Uraian</td>
        <td colspan="6" align="center" width="48%">Kehadiran</td>
        </tr>
        <tr>
        <td align="center" width="8%">H</td>
        <td align="center" width="8%">S</td>
        <td align="center" width="8%">I</td>
        <td align="center" width="8%">A</td>
        <td align="center" width="8%">B</td>
        <td align="center" width="8%">%</td>
        </tr>';
        $bottom_a='';
        $no_a=1;
        $rows_a='';
        $isi_a='';
        $tot=1;
        $pdf->SetFont('times', '', 12);
        if($row_a)
        {
        $tot=$row_a->hadir+$row_a->sakit+$row_a->izin+$row_a->alpa+$row_a->bolos;
            $persen=($row_a->hadir/$tot)*100;
            $persen=round($persen,0);
        
        $rows_a='<tr>
            <td align="center" width="5%">'.$no_a++.'</td>
            <td align="left" width="47%">Berdasarkan Catatan Guru Bimbingan Konseling</td>
            <td align="center" width="8%">'.$row_a->hadir.'</td>
            <td align="center" width="8%">'.$row_a->sakit.'</td>
            <td align="center" width="8%">'.$row_a->izin.'</td>
            <td align="center" width="8%">'.$row_a->alpa.'</td>
            <td align="center" width="8%">'.$row_a->bolos.'</td>
            <td align="center" width="8%">'.$persen.'%</td></tr>';
             $isi_a=$isi_a.$rows_a;
        $bottom_a='</table>';
        }
        $pdf->writeHTML($head_a.$isi_a.$bottom_a);
        
       //------------------------------------------------------------------------------------------------------------------------------------------------------------------ 
    
        //sesi_b B. Rekapitulasi Kehadiran di Mata Pelajaran
         $pdf->SetFont('times', 'B', 12);
        
         $pdf->Cell(8, 5, 'B. Rekapitulasi Kehadiran di Mata Pelajaran', 0, 0, 'L');
         $pdf->ln(6);
         $pdf->SetFont('times', '', 12);
        $head_b='<table border="1" cellpadding="2">
        <tr>
        <td rowspan="2" align="center" width="5%">No</td>
        <td rowspan="2" width="47%" style="text-align: center; vertical-align: middle">Mata Pelajaran</td>
        <td colspan="6" align="center" width="48%">Kehadiran</td>
        </tr>
        <tr>
        <td align="center" width="8%">H</td>
        <td align="center" width="8%">S</td>
        <td align="center" width="8%">I</td>
        <td align="center" width="8%">A</td>
        <td align="center" width="8%">B</td>
        <td align="center" width="8%">%</td>
        </tr>';
       $tot_r_a='';
       $no_a=1;
        $kelompok_a='<tr><td colspan="8">Kelompok A (Umum)</td></tr>';
        $list_a=$this->get_rekap_absensi_siswa_pelajaran($kd_ta,$bulan,$nis,'A');
        foreach($list_a as $a)
        {
            $tota=$a->hadir+$a->sakit+$a->izin+$a->alpa+$a->bolos;
            $persena=($a->hadir/$tota)*100;
            $persena=round($persena,0);
            $r_a='<tr>
            <td align="center" width="5%">'.$no_a++.'</td>
            <td width="47%" >'.$a->nm_pelajaran.'</td>
            <td align="center" width="8%">'.$a->hadir.'</td>
            <td align="center" width="8%">'.$a->sakit.'</td>
            <td align="center" width="8%">'.$a->izin.'</td>
            <td align="center" width="8%">'.$a->alpa.'</td>
            <td align="center" width="8%">'.$a->bolos.'</td>
            <td align="center" width="8%">'.$persena.'%</td>
            </tr>';
            $tot_r_a=$tot_r_a.$r_a;
        }
     
        //$pdf->writeHTML($head_b.$kelompok_a.$tot_r_a.$bottom_a);
        
        
        $tot_r_b='';
       $no_b=1;
        $kelompok_b='<tr><td colspan="8">Kelompok B (Umum)</td></tr>';
        $list_b=$this->get_rekap_absensi_siswa_pelajaran($kd_ta,$bulan,$nis,'B');
        foreach($list_b as $b)
        {
            $totb=$b->hadir+$b->sakit+$b->izin+$b->alpa+$b->bolos;
            $persenb=($b->hadir/$totb)*100;
             $persenb=round($persenb,0);
            $r_b='<tr>
            <td align="center" width="5%">'.$no_b++.'</td>
            <td width="47%" valign="middle" align ="left">'.$b->nm_pelajaran.'</td>
            <td align="center" width="8%">'.$b->hadir.'</td>
            <td align="center" width="8%">'.$b->sakit.'</td>
            <td align="center" width="8%">'.$b->izin.'</td>
            <td align="center" width="8%">'.$b->alpa.'</td>
            <td align="center" width="8%">'.$b->bolos.'</td>
            <td align="center" width="8%">'.$persenb.'%</td>
            </tr>';
            $tot_r_b=$tot_r_b.$r_b;
        }
        
        
         $tot_r_c='';
       $no_c=1;
        $kelompok_c='<tr><td colspan="8">Kelompok C (Peminatan)</td></tr>';
        $list_c=$this->get_rekap_absensi_siswa_pelajaran($kd_ta,$bulan,$nis,'C');
        foreach($list_c as $c)
        {
            $totc=$c->hadir+$c->sakit+$c->izin+$c->alpa+$c->bolos;
            $persenc=($c->hadir/$totb)*100;
             $persenc=round($persenc,0);
            $r_c='<tr>
            <td align="center" width="5%">'.$no_c++.'</td>
            <td width="47%" valign="middle" align ="left">'.$c->nm_pelajaran.'</td>
            <td align="center" width="8%">'.$c->hadir.'</td>
            <td align="center" width="8%">'.$c->sakit.'</td>
            <td align="center" width="8%">'.$c->izin.'</td>
            <td align="center" width="8%">'.$c->alpa.'</td>
            <td align="center" width="8%">'.$c->bolos.'</td>
            <td align="center" width="8%">'.$persenc.'%</td>
            </tr>';
            $tot_r_c=$tot_r_c.$r_c;
        }
        
        $pdf->writeHTML($head_b.$kelompok_a.$tot_r_a.$kelompok_b.$tot_r_b.$kelompok_c.$tot_r_c.$bottom_a);
         
        
        //C. Informasi Pengumpulan Tugas dan Keikutsertaan dalam Ulangan/Ujian
        $pdf->SetFont('times', 'B', 12);
         $pdf->Cell(8, 5, 'C. Informasi Pengumpulan Tugas dan Keikutsertaan dalam Ulangan/Ujian', 0, 0, 'L');
         $pdf->ln(6);
         $pdf->SetFont('times', '', 12);
        $head_c='<table border="1" cellpadding="2">
        <tr>
        <td align="center" width="5%">No</td>
        <td width="47%" style="text-align: center; vertical-align: middle">Mata Pelajaran</td>
        <td align="center" width="24%">Kelengkapan Tugas</td>
        <td align="center" width="24%">Kelengkapan Ulangan/Ujian</td>
        </tr>';
        
        $tot_c_a='';
       $no_c_a=1;
        $kelompok_c_a='<tr><td colspan="4">Kelompok A (Umum)</td></tr>';
        $list_c_a=$this->get_rekap_tugas_quiz_siswa_pelajaran($kd_ta,$bulan,$nis,'A');
        foreach($list_c_a as $c_a)
        {
            $r_c_a='<tr>
            <td align="center" width="5%">'.$no_c_a++.'</td>
            <td width="47%" style="text-align: left">'.$c_a->nm_pelajaran.'</td>
            <td align="center" width="24%">'.$c_a->tugas.'</td>
            <td align="center" width="24%">'.$c_a->quiz.'</td>
            </tr>';
            $tot_c_a=$tot_c_a.$r_c_a;
        }
        
         $tot_c_b='';
       $no_c_b=1;
        $kelompok_c_b='<tr><td colspan="4">Kelompok B (Umum)</td></tr>';
        $list_c_b=$this->get_rekap_tugas_quiz_siswa_pelajaran($kd_ta,$bulan,$nis,'B');
        foreach($list_c_b as $c_b)
        {
            $r_c_b='<tr>
            <td align="center" width="5%">'.$no_c_b++.'</td>
            <td width="47%" valign="middle" align ="left">'.$c_b->nm_pelajaran.'</td>
            <td align="center" width="24%">'.$c_b->tugas.'</td>
            <td align="center" width="24%">'.$c_b->quiz.'</td>
            </tr>';
            $tot_c_b=$tot_c_b.$r_c_b;
        }
        $tot_c_c='';
       $no_c_c=1;
        $kelompok_c_c='<tr><td colspan="4">Kelompok C (Peminatan)</td></tr>';
        $list_c_c=$this->get_rekap_tugas_quiz_siswa_pelajaran($kd_ta,$bulan,$nis,'C');
        foreach($list_c_c as $c_c)
        {
            $r_c_c='<tr>
            <td align="center" width="5%">'.$no_c_c++.'</td>
            <td width="47%" valign="middle" align ="left">'.$c_c->nm_pelajaran.'</td>
            <td align="center" width="24%">'.$c_c->tugas.'</td>
            <td align="center" width="24%">'.$c_c->quiz.'</td>
            </tr>';
            $tot_c_c=$tot_c_c.$r_c_c;
        }
        $pdf->writeHTML($head_c.$kelompok_c_a.$tot_c_a.$kelompok_c_b.$tot_c_b.$kelompok_c_c.$tot_c_c.$bottom_a);
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // D. Rekapitulasi Kredit Poin Pelanggaran Tata Tertib di Sekolah
        $pdf->SetFont('times', 'B', 12);
         $pdf->Cell(8, 5, 'D. Rekapitulasi Kredit Poin Pelanggaran Tata Tertib di Sekolah', 0, 0, 'L');
         $pdf->ln(6);
         $pdf->SetFont('times', '', 12);
        $head_d='<table border="1" cellpadding="2">
        <tr>
        <td align="center" width="5%">No</td>
        <td width="47%" style="text-align: center; vertical-align: middle">Uraian</td>
        <td align="center" width="16%">Debet Point</td>
        <td align="center" width="16%">Kredit Point</td>
        <td align="center" width="16%">Saldo Point</td>
        </tr>';
        $r_dx='';
        $keypoint['nis']=$nis;
        $keypoint['bulan']=$bulan;
        $keypoint['kd_ta']=$kd_ta;
        $point=$this->get_row_selected('point_siswa',$keypoint);
        if($point)
        {
            $saldo=($point->debit)-($point->kredit);
        $r_dx='<tr>
            <td align="center" width="5%">1</td>
            <td width="47%" valign="middle" align ="left"> Berdasarkan Catatan Guru Bimbingan Konseling </td>
            <td align="center" width="16%">'.$point->debit.'</td>
            <td align="center" width="16%">'.$point->kredit.'</td>
            <td align="center" width="16%">'.$saldo.'</td>
            </tr>';
        }else
        {
            $r_d='<tr>
            <td align="center" width="5%">1/td>
            <td width="47%" valign="middle" align ="left">Berdasarkan Catatan Guru Bimbingan Konseling</td>
            <td align="center" width="16%">0</td>
            <td align="center" width="16%">0</td>
            <td align="center" width="16%">0</td>
            </tr>';
        }
        $pdf->writeHTML($head_d.$r_dx.$bottom_a);
        $pdf->Cell(0, 6, ' Keterangan:  *). Bila Ada,   H = Hadir, S = Sakit, I = Izin, A = Alpa, B = Bolos', 0, 0, 'L');
        
        
        
        
        $pdf->Output('LAP_BULANAN.PDF','I');
    }
    function get_rekap_tugas_quiz_siswa_pelajaran($kd_ta,$bulan,$nis,$kelompok)
    {
        $sql="SELECT pelajaran.nm_pelajaran,tugas_quiz.tugas,tugas_quiz.quiz,tugas_quiz.nis,jadwal.kd_ta,pelajaran.kelompok 
    FROM `tugas_quiz`,jadwal,pelajaran 
    WHERE tugas_quiz.kd_jadwal=jadwal.kd_jadwal and jadwal.id_kurikulum=pelajaran.kd_pelajaran and jadwal.kd_ta='".$kd_ta."' and nis='".$nis."' and bulan='".$bulan."' and pelajaran.kelompok='".$kelompok."' order by pelajaran.urutan asc";
    $hasil= $this->db->query($sql)->result();
       return $hasil;
    
    }
    function get_rekap_absensi_siswa_pelajaran($kd_ta,$bulan,$nis,$kelompok)
    {
        $sql="SELECT bulan,jadwal.kd_ta,absen.nis,hadir,alpa,bolos,izin,sakit,izin,round((hadir/(alpa+izin+sakit+bolos+hadir))*100,0) as total, pelajaran.nm_pelajaran,pelajaran.kelompok FROM `absen`,jadwal,pelajaran 
        where absen.kd_jadwal=jadwal.kd_jadwal and jadwal.id_kurikulum=pelajaran.kd_pelajaran and pelajaran.kelompok='".$kelompok."' and absen.nis='".$nis."' and bulan='".$bulan."' and kd_ta='".$kd_ta."'order by pelajaran.urutan asc";
        $hasil= $this->db->query($sql)->result();
       return $hasil;
    }
    function get_rekap_absensi_siswa_sekolah($kd_ta,$bulan,$nis)
    {
        $sql="SELECT * FROM `absen_harian` where kd_ta='".$kd_ta."' and nis='".$nis."' and bulan='".$bulan."'";
         return $this->db->query($sql)->row();
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
function get_wali_kelas($kelas,$ta)
    {
        $key['kelas']=$kelas;
        $key['kd_ta']=$ta;
        $kelas=$this->Crud_model->get_row_selected('wali_kelas',$key);
        $keyguru['id_guru']=$kelas->id_guru;
        $guru=$this->Crud_model->get_row_selected('guru',$keyguru);
        return $guru;
        
    }
    function angka_to_grade($kd_ta,$kkm,$nilai)
    {
        $nilai=round($nilai,0);
        //$key['kd_ta']=$kd_ta;
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
    function angka_to_grade_ekstra($angka)
    {
        $key['angka']=$angka;
        $hasil=$this->Crud_model->get_row_selected('mnilai',$key);
       
        return $hasil->nilai;
        
    }
    
    
    
}


?>