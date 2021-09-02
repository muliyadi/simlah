<div class="content">
    <div class="container-fluid">
        <div class="row">
             <div class="col-md-12">
                <div class="card">
                  
                    <div class="card-content table-responsive">
				         <h4 class="title">Form Import Nilai </h4>
                        <h4 class="title"><?php echo $pelajaran->nm_pelajaran?>  <?php echo $kelas ?></h4>
				        <form method="post" action="<?php echo base_url("guru/preview").'/'.$kd_jadwal; ?>" enctype="multipart/form-data">
                                <!-- 
                                -- Buat sebuah input type file
                                -- class pull-left berfungsi agar file input berada di sebelah kiri
                                -->
                                <input type="hidden" value="<?php echo $kd_jadwal?>" name="kd_jadwal">
                                <div class="form-group form-file-upload form-file-multiple">
					<input type="file" multiple="" onchange="tampilkanPreview(this,'preview')"  class="inputFileHidden" name="file" >
					<div class="input-group">
						<input type="text" class="form-control inputFileVisible"  accept=".xlsx" placeholder="Uplod File Nilai Excel">
						<span class="input-group-btn">
							<button type="button" class="btn  btn-sm btn-warning ">
								<i class="material-icons">attach_file</i>
							</button>
						</span>
					</div>
				  </div>
                               
                                
                                <!--
                                -- BUat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import
                                -->
                                <input type="submit" name="preview" value="Preview">
                              </form>
                        <?php
  if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form 
    if(isset($upload_error)){ // Jika proses upload gagal
      echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
      die; // stop skrip
    }
    
    // Buat sebuah tag form untuk proses import data ke database
    echo "<form method='post' action='".base_url("guru/import2")."'>";
    ?>
    
    <input type="hidden" value="<?php echo $kd_jadwal?>" name="kd_jadwal">
   
    <?php
    echo "<table border='1' cellpadding='8' class='table'>
    <tr>
      <th colspan='9' align='center'>DATA NILAI SISWA</th>
    </tr>
    <tr>
      <th>NIS</th>
      <th>NAMA SISWA</th>
      <th>KELAS</th>
      <th>NILAI SIKAP SPRITUAL</th>
      <th>NILAI SIKAP SOSIAL</th>
      <th>NILAI PENGETAHUAN</th>
      <th>DESKRIPSI NILAI PENGETAHUAN</th>
      <th>NILAI KETERAMPILAN</th>
      <th>DEKSRIPSI NILAI KETERAMPILAN</th>
      
    </tr>";
    
    $numrow = 1;
    $kosong = 0;
    
    // Lakukan perulangan dari data yang ada di excel
    // $sheet adalah variabel yang dikirim dari controller
    foreach($sheet as $row){ 
      // Ambil data pada excel sesuai Kolom
      $nis = $row['A']; // Ambil data NIS
      $nm_siswa = $row['B']; // Ambil data nama
      $kelas = $row['C'];
      $nilai_spritual = $row['D'];
      $nilai_sosial = $row['E'];
      $nilai_pengetahuan = $row['F'];
      $desc_nilai_pengetahuan = $row['G'];
      $nilai_keterampilan = $row['H'];
      $desc_nilai_keterampilan = $row['I'];// Ambil data kelas
      
      // Cek jika semua data tidak diisi
      if($nis == "" && $nilai_spritual=="" && $nm_siswa=="" && $kelas=="" && $nilai_spritual=="" && $nilai_sosial=="" && $nilai_pengetahuan=="" && $nilai_keterampilan=="" && $desc_nilai_pengetahuan=="" && $desc_nilai_keterampilan=="")
        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
      
      // Cek $numrow apakah lebih dari 1
      // Artinya karena baris pertama adalah nama-nama kolom
      // Jadi dilewat saja, tidak usah diimport
      if($numrow > 1){
        // Validasi apakah semua data telah diisi
        $nis_td = ( ! empty($nis))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
        $nm_siswa_td = ( ! empty($nm_siswa))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
        $kelas_td = ( ! empty($kelas))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
        $nilai_spritual_td = ( ! empty($nilai_spritual))? "" : " style='background: #E07171;'";
        $nilai_sosial_td = ( ! empty($nilai_sosial))? "" : " style='background: #E07171;'";
        $nilai_pengetahuan_td = ( ! empty($nilai_pengetahuan))? "" : " style='background: #E07171;'";
        $desc_nilai_pengetahuan_td = ( ! empty($desc_nilai_pengetahuan))? "" : " style='background: #E07171;'";
        $nilai_keterampilan_td = ( ! empty($nilai_keterampilan))? "" : " style='background: #E07171;'";
        $desc_nilai_keterampilan_td = ( ! empty($desc_nilai_keterampilan))? "" : " style='background: #E07171;'";
        
        // Jika salah satu data ada yang kosong
        if($nis == "" or $nm_siswa == ""){
          $kosong++; // Tambah 1 variabel $kosong
        }
        
        echo "<tr>";
        echo "<td".$nis_td." align='center'>".$nis."</td>";
        echo "<td".$nm_siswa_td.">".$nm_siswa."</td>";
        echo "<td".$kelas_td." align='center'>".$kelas."</td>";
        echo "<td".$nilai_spritual_td." align='center'>".$nilai_spritual."</td>";
        echo "<td".$nilai_sosial_td." align='center'>".$nilai_sosial."</td>";
        echo "<td".$nilai_pengetahuan_td." align='center'>".$nilai_pengetahuan."</td>";
        echo "<td".$desc_nilai_pengetahuan_td.">".$desc_nilai_pengetahuan."</td>";
        echo "<td".$nilai_keterampilan_td." align='center'>".$nilai_keterampilan."</td>";
        echo "<td".$desc_nilai_keterampilan_td.">".$desc_nilai_keterampilan."</td>";
        echo "</tr>";
      }
      
      $numrow++; // Tambah 1 setiap kali looping
    }
    
    echo "</table>";
    
    // Cek apakah variabel kosong lebih dari 0
    // Jika lebih dari 0, berarti ada data yang masih kosong
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
      echo "<a href='".base_url("guru")."' class='btn btn-warning'>Cancel</a>";
    }
    
    echo "</form>";
  }
  ?>

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

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/gmap.js"></script>
<!-- Material Dashboard javascript methods -->
<script src="<?php echo base_url(); ?>assets/js/material-dashboard.js?v=1.2.0"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="<?php echo base_url(); ?>assets/js/demo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
    <!-- panggil adapter jquery ckeditor -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/adapters/jquery.js"></script>

  

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