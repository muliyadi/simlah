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
class Guru_model extends CI_Model {
    function __construct()
    {
        parent::__construct();

    }
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
	
		$data['menu']=$this->session->userdata('nm_sekolah');
		//$data['list']=$	return $data;
			$this->template->load($this->view, 'guru/kelas/list_kelas', $data);
	}
	function view_siswa_kelas($kelas)
	{
	    $key['kelas']=$kelas;
	   // $key2['id_kelas']=$kelas;
	    $data['list']=$this->get_list_selected('siswa',$key);
	    	$data['menu']=$this->session->userdata('nm_sekolah');
	    //	$data['kelas']=$this->get_row_selected('kelas',$key2);
	    $this->template->load($this->view, 'guru/view/list_all_siswa', $data);
	}
	
	function cek_nilai_siswa($ta,$kelas)
	{
	    
	    $keykelas['id_kelas']=$kelas;
	    $kelasi=$this->get_row_selected('kelas',$keykelas);
	    $tingkat=$kelasi->tingkat;
	    $keykkm['kd_ta']=$ta;
	    $keykkm['tingkat']=$tingkat;
	    
	    $kkm=$this->get_row_selected('kkm',$keykkm);
	    $nilai=$kkm->kkm;
	    
	    //$kkm_nilai=$this->get_row_selected('kkm_nilai',$keykkmnilai);
	    $sql="SELECT DISTINCT  guru.gelar_depan,guru.gelar_belakang,nilai.nilai_spritual,nilai_sosial,nilai_pengetahuan,nilai_keterampilan,desc_nilai_pengetahuan,desc_nilai_keterampilan,pelajaran.nm_pelajaran,pelajaran.kd_pelajaran,jadwal.id_guru,guru.nm_guru,guru.tgl_lahir,nilai.nis,siswa.nm_siswa,siswa.kelas as kelas_siswa,siswa.no_hp,jadwal.kelas as kelas_jadwal,jadwal.kd_ta FROM `nilai`,siswa,jadwal,pelajaran,guru,mnilai where (nilai.nilai_spritual<2 or nilai_sosial<2 or nilai_pengetahuan<$nilai or nilai_keterampilan<$nilai) and nilai.nis=siswa.nis and nilai.kd_jadwal=jadwal.kd_jadwal and jadwal.kd_pelajaran=pelajaran.kd_pelajaran and jadwal.id_guru=guru.id_guru 
	    and jadwal.kelas='".$kelas."' and jadwal.kd_ta='".$ta."' ORDER BY pelajaran.urutan,nis ASC";
	    $hasil = $this->db->query($sql)->result();
	    $data['list']=$hasil;
	    $data['menu']=$this->session->userdata('nm_sekolah');
	    $this->template->load($this->view, 'guru/view/list_siswa_nilai_rendah', $data);
	}
	
	function totalRows($table)
	{
		return $this->db->count_all_results($table);
    }
    function get_all($table)
    {
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
	
 
	 //output berupa array
     function get_list_selected($table,$data) 
     {
        return $this->db->get_where($table, $data)->result();
     }
    
    function update_data($table,$data,$field_key)
    {
        
            $this->db->trans_start();
            $this->db->update($table,$data,$field_key);
            $this->db->trans_complete();
            
        }

    public function save_multiple($tabel,$data){
        $this->db->trans_start();
    $this->db->insert_batch($tabel, $data);
     $this->db->trans_complete();
  }
    function save_data($table,$data){
        $this->db->trans_start();
       $this->db->insert($table, $data);
       $this->db->trans_complete();
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
}

?>