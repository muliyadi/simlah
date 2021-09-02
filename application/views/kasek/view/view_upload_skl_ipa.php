<div class="content">
    <div class="container-fluid">
        <div class="row">
             <div class="col-md-12">
                <div class="card">
                   
                    <div class="card-content table-responsive">
                       <h4 class="title">Form Upload Excel SKL</h4>
					<form action="<?php echo base_url().'kasek/import'?>" method="post" enctype="multipart/form-data">
					
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>
 
    
    <input type="text" value="<?php echo $namafile?>" name="namafile">
   <input type="text" value="<?php echo $kd_ta?>" name="kd_ta">
   DATA NILAI KELULUSAN SISWA <?php echo $program?> TAHUN AJARAN <?php echo $kd_ta?>
    <table class='table table-responsive table-striped table-bordered'>

    <tr>
      <th>NO SURAT</th>
      <th>NAMA SISWA</th>
      <th>TEMPAT LAHIR</th>
      <th>TANGGAL LAHIR</th>
      <th>NAMA ORANG TUA</th>
      <th>NIS</th>
      <th>NISN</th>
      <th>NO. PESERTA UJIAN</th>
      <th>SEKOLAH ASAL</th>
      
      <th>PAIPB</th>
      <th>PKN</th>
      <th>B.INDO</th>
      <th>MAT</th>
      <th>SJR.INDO</th>
      <th>B.ING</th>
      <th>SENI</th>
      <th>PJOK</th>
      <th>PKWU</th>
      <th>MULOK</th>
      <th>MAT.IPA</th>
      <th>BIO</th>
      <th>FIS</th>
      <th>KIM</th>
      <th>LTM1</th>
      <th>RATA2</th>
      <th>KELULUSAN</th>
      
    </tr>
    <?php
    $numrow = 1;
    $kosong = 0;
    
    // Lakukan perulangan dari data yang ada di excel
    // $sheet adalah variabel yang dikirim dari controller
    foreach($sheet as $row){ 
      // Ambil data pada excel sesuai Kolom
      $no_surat = $row['A']; // Ambil data NIS
      $nm_siswa = $row['B'];
      $tempat_lahir=$row['C'];
      $tgl_lahir=$row['D'];
      $nm_orang_tua=$row['E'];
      $nis=$row['F'];
        $nisn=$row['G'];
        $no_peserta_ujian=$row['H'];
        $sekolah_asal=$row['I'];
        
        $PAIPB=$row['J'];
        $PKN=$row['K'];
        $BINDO=$row['L'];
        $MAT=$row['M'];
        $SJRINDO=$row['N'];
        $BING=$row['O'];
        $SENI=$row['P'];
        $PJOK=$row['Q'];
        $PKWU=$row['R'];
        $MULOK=$row['S'];
        $MATIPA=$row['T'];
        $BIO=$row['U'];
        $FIS=$row['V'];
        $KIM=$row['W'];
        $LTM1=$row['X'];
        $RATA2=$row['Y'];
        $KELULUSAN=$row['Z'];
      
      // Cek jika semua data tidak diisi
      if($nis == "")
        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
      
      // Cek $numrow apakah lebih dari 1
      // Artinya karena baris pertama adalah nama-nama kolom
      // Jadi dilewat saja, tidak usah diimport
      if($numrow > 1){
        // Validasi apakah semua data telah diisi
        $no_peserta_ujian_td = ( ! empty($no_peserta_ujian))? "" : " style='background: #E07171;'"; 
        $nm_siswa_td = ( ! empty($nm_siswa))? "" : " style='background: #E07171;'"; 
        $nis_td = ( ! empty($nis))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
        $nisn_td = ( ! empty($nisn))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
        $PAIPB_td = ( ! empty($PAIPB))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
        $PKN_td = ( ! empty($PKN))? "" : " style='background: #E07171;'";
        $BINDO_td = ( ! empty($BINDO))? "" : " style='background: #E07171;'";
        $MAT_td = ( ! empty($MAT))? "" : " style='background: #E07171;'";
        $SJRINDO_td = ( ! empty($SJRINDO))? "" : " style='background: #E07171;'";
        $BING_td = ( ! empty($BING))? "" : " style='background: #E07171;'";
        $SENI_td = ( ! empty($SENI))? "" : " style='background: #E07171;'";
        $PJOK_td = ( ! empty($PJOK))? "" : " style='background: #E07171;'";
        $PKWU_td = ( ! empty($PKWU))? "" : " style='background: #E07171;'";
        $MULOK_td = ( ! empty($MULOK))? "" : " style='background: #E07171;'";
        $MATIPA_td = ( ! empty($MATIPA))? "" : " style='background: #E07171;'";
        $BIO_td = ( ! empty($BIO))? "" : " style='background: #E07171;'";
        $FIS_td = ( ! empty($FIS))? "" : " style='background: #E07171;'";
        $KIM_td = ( ! empty($KIM))? "" : " style='background: #E07171;'";
        $LTM1_td = ( ! empty($LTM1))? "" : " style='background: #E07171;'";
        $RATA2_td = ( ! empty($RATA2))? "" : " style='background: #E07171;'";
        $KELULUSAN_td = ( ! empty($KELULUSAN))? "" : " style='background: #E07171;'";
        
        
        // Jika salah satu data ada yang kosong
        if($nis == "" or $nm_siswa == ""){
          $kosong++; // Tambah 1 variabel $kosong
        }
        ?>
       <tr>
       <td><?php echo $no_surat?></td>
       <td <?php echo $nm_siswa_td?>><?php echo $nm_siswa?></td>
       <td><?php echo $tempat_lahir?></td>
       <td><?php echo $tgl_lahir?></td>
       <td><?php echo $nm_orang_tua?></td>
       <td<?php echo $nis_td?> align='center'><?php echo$nis?></td>
       <td<?php echo $nisn_td?>><?php echo $nisn?></td>
       <td<?php echo $no_peserta_ujian_td?> align='center'><?php echo $no_peserta_ujian?></td>
       <td><?php echo $sekolah_asal?></td>
       <td<?php echo $PAIPB_td?> align='center'><?php echo $PAIPB?></td>
       <td<?php echo $PKN_td?> align='center'><?php echo $PKN?></td>
       <td<?php echo $BINDO_td?> align='center'><?php echo $BINDO?></td>
       <td<?php echo $MAT_td?> align='center'><?php echo $MAT?></td>
       <td<?php echo $SJRINDO_td?> align='center'><?php echo $SJRINDO?></td>
       <td<?php echo $BING_td?> align='center'><?php echo $BING?></td>
       <td<?php echo $SENI_td?> align='center'><?php echo $SENI?></td>
       <td<?php echo $PJOK_td?> align='center'><?php echo $PJOK?></td>
       <td<?php echo $PKWU_td?> align='center'><?php echo $PKWU?></td>
       <td<?php echo $MULOK_td?> align='center'><?php echo $MULOK?></td>
       <td<?php echo $MATIPA_td?> align='center'><?php echo $MATIPA?></td>
       <td<?php echo $BIO_td?> align='center'><?php echo $BIO?></td>
       <td<?php echo $FIS_td?> align='center'><?php echo $FIS?></td>
       <td<?php echo $KIM_td?> align='center'><?php echo $KIM?></td>
       <td<?php echo $LTM1_td?> align='center'><?php echo $LTM1?></td>
       <td<?php echo $RATA2_td?> align='center'><?php echo $RATA2?></td>
       <td<?php echo $KELULUSAN_td?> align='center'><?php echo $KELULUSAN?></td>
        
       </tr>
      <?php 
      }
      
      $numrow++; // Tambah 1 setiap kali looping
    }?>
    
   </table>
   Keterangan:<br>Upload dapat dilakukan jika tidak ada lagi cell(row x colum) berwarna merah';
    
    <?php
    if($kosong > 0){
    ?>  
      <script>
      $(document).ready(function(){
        // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
        $("#jumlah_kosong").html('<?php echo $kosong; ?>');
        
        $("#kosong").show(); // Munculkan alert validasi kosong
      });
      </script>
    <?php
    }else{ // Jika semua data sudah diisi
      echo "<hr>";
      
      // Buat sebuah tombol untuk mengimport data ke database
      echo "<button type='submit' name='import' class='btn btn-success'> Import </button>";
     
    }
    ?>
    </form>;


					</div>
					
                </div>
				
            </div>
			
			

        </div>
    </div>
</div>
</body>
<!--   Core JS Files   -->
<script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/material.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="<?php echo base_url(); ?>assets/js/chartist.min.js"></script>
<!--  Dynamic Elements plugin -->
<script src="<?php echo base_url(); ?>assets/js/arrive.min.js"></script>
<!--  PerfectScrollbar Library -->
<script src="<?php echo base_url(); ?>assets/js/perfect-scrollbar.jquery.min.js"></script>
<!--  Notifications Plugin    -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap-notify.js"></script>
<script src="<?php echo base_url()?>assets/js/moment.min.js"></script>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>


<!-- Material Dashboard javascript methods -->
<script src="<?php echo base_url(); ?>assets/js/material-dashboard.js?v=1.2.0"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->


    <!-- panggil adapter jquery ckeditor -->
   

  

<script type="text/javascript">
<?php if ($this->session->flashdata('cek_type') != null){?>
		$.notify({
      message: "<?php echo $this->session->flashdata('cek_pesan')?>"
    },{
      type: "<?php echo $this->session->flashdata('cek_type')?>",
      timer: 200,
			placement: {
				from: "top",
				align: "right"
			}
     });
		<?php }?>
    
	
</script>

    
