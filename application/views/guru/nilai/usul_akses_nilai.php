<div class="content">
    <div class="container-fluid">
        <div class="row">
             <div class="col-md-12">
                <div class="card">
                   
                    <div class="card-content table-responsive">
                    	 <h4 class="title">Form Permohonan Akses Input Nilai </h4>
					<form action="<?php echo base_url().'guru/simpan_usul_akses_nilai'?>" method="post" enctype="multipart/form-data">
					
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>
                    <input name="kd_jadwal" class="form-control" readonly="true" placeholder="ID GURU" value="<?php echo $jadwal->kd_jadwal?>"  type="hidden">
					
        			<div class="form-group label-floating">
					<label class="control-label ">Kelas</label>
					<input name="kelas" class="form-control" readonly="true" placeholder="Kelas" value="<?php echo $jadwal->kelas?>" required autofocus>
					</div>
					<div class="form-group label-floating">
					<label class="control-label">Mata Pelajaran</label>
					<input name="nm_pelajaran" class="form-control" readonly="true" type="text" placeholder="Nama Pelajaran"  value="<?php echo $jadwal->nm_pelajaran?>" autofocus>
					</div>
					<div class="form-group">
					<label class="control-label">Penjelasan</label>
				<input name="penjelasan" class="form-control"  placeholder="Penjelasan"  minlength="10" maxlength="150" required autofocus>
                            					    
					</textarea>
					</div>
					
					
					<button type="submit" class="btn btn-info btn-sm"><i class="material-icons">save </i> Simpan </button>
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
