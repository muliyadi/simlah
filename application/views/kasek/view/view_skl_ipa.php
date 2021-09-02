<div class="content">
    <div class="container-fluid">
        <div class="row">
             <div class="col-md-12">
                <div class="card">
                    
                    <div class="card-content table-responsive">
                       <h4 class="title">Laporan Nilai Kelulusan Siswa <?php echo $program. ' Tahun Ajaran '.$kd_ta?></h4>
					<form action="<?php echo base_url().'kasek/import'?>" method="post" enctype="multipart/form-data">
					
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>
 
    
   
  
    <table class='table table-responsive table-striped table-bordered'>

    <tr><th>NO</th>
    <th>KELAS</th>
      <th>NAMA SISWA</th>
      <th>TEMPAT/TANGGAL LAHIR</th>
      <th>NIS / NISN</th>
      <th>NO. PESERTA UJIAN</th>
      
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
      <TH>AKSI</TH>
    </tr>
    <?php
    $numrow = 1;

    foreach($list as $row){ 
      $kd_ta=$row->kd_ta;
      ?>
       <tr>
       <td><?php echo $numrow++?></td>
       <td><?php echo $row->kelas?></td>
       <td ><?php echo $row->nm_siswa?></td>
       <td><?php echo $row->tempat.'/'.$row->tgl_lahir?></td>

       <td align='center'><?php echo$row->nis.' / '.$row->nisn?></td>
        
       <td align='center'><?php echo $row->no_peserta_ujian?></td>
       
       <td align='center'><?php echo $row->PAIPB?></td>
       <td align='center'><?php echo $row->PKN?></td>
       <td align='center'><?php echo $row->BINDO?></td>
       <td align='center'><?php echo $row->MAT?></td>
       <td align='center'><?php echo $row->SJRINDO?></td>
       <td align='center'><?php echo $row->BING?></td>
       <td align='center'><?php echo $row->SENI?></td>
       <td align='center'><?php echo $row->PJOK?></td>
       <td align='center'><?php echo $row->PKWU?></td>
       <td align='center'><?php echo $row->MULOK?></td>
       <td align='center'><?php echo $row->MATIPA?></td>
       <td align='center'><?php echo $row->BIO?></td>
       <td align='center'><?php echo $row->FIS?></td>
       <td align='center'><?php echo $row->KIM?></td>
       <td align='center'><?php echo $row->LTM1?></td>
       <td align='center'><?php echo $row->RATA2?></td>
       <td align='center'><?php echo $row->kelulusan?></td>
        <td align='center'><a href="<?php echo base_url('kasek/hapus_skl_ipa').'/'.$row->nis.'/'.$kd_ta?>"  class="btn btn-danger btn-sm">Delete</a><a href="<?php echo base_url('kasek/skl_ipa').'/'.$row->nis.'/'.$kd_ta?>"  class="btn btn-sm  btn-warning">Print</a></td>
       </tr>
      <?php 
      
      }?>
      
     

    
   </table>
  


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

    
