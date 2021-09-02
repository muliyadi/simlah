<div class="content">
    <div class="container-fluid">
        <div class="row">
             <div class="col-md-12">
                <div class="card">
                    
                    <div class="card-content table-responsive">
                    	<h4 class="title">Form Input Kalender Akademik </h4>
					<form action="<?php echo base_url().'wakasekkurikulum/save_kalender_akademik'?>" method="post" enctype="multipart/form-data">
					
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>

					<div class="form-group">
					<label for="group_relawan">Kode Tahun Pelajaran</label>
					<?php 
                   
				   $list=array();
				   
				   foreach($list_ta as $value)
				   {
					   $test=$value->kd_ta;
					   $list[$value->kd_ta]=$test;
					  
				   }
                    echo form_dropdown('kd_ta',$list,$kd_ta,"class='form-control id_desa'");    
                    ?>
					</div>
					<div class="form-group">
					<label for="group_relawan">Kegiatan</label>
					<?php 
                   
				   $list=array();
				   
				   foreach($list_kegiatan as $value)
				   {
					   $test=$value->kegiatan;
					   $list[$value->id]=$test;
					  
				   }
                    echo form_dropdown('kegiatan',$list,'',"class='form-control id_desa'");    
                    ?>
					</div>
					<div class="form-group">
					<label for="tahun">Tgl Mulai</label>
					<input name="tgl_mulai" class="form-control" type="date" required autofocus>
					</div>
					<div class="form-group">
					<label for="tahun">Tgl Selesai</label>
					<input  name="tgl_selesai" class="form-control" type="date" required autofocus>
					</div>
                    <div class="form-group">
					<label for="group_relawan">Status</label>
					<?php 
                   
				   $list=array();
				   
				   foreach($list_status as $value)
				   {
					   $test=$value->status;
					   $list[$value->status]=$test;
					  
				   }
                    echo form_dropdown('status',$list,'',"class='form-control id_desa'");    
                    ?>
					</div>
					
					
					
					<button type="submit" class="btn btn-warning btn-md"><i class="material-icons">save </i> Simpan </button>
					</form>
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