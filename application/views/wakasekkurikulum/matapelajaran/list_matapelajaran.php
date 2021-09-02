<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                  
                    <div class="card-content table-responsive">
                         <h4 class="title"> Data Mata Pelajaran </h4>
                        <table class="table table-responsive table-striped table-bordered" id="tabel_pelajaran">
                            <thead class="text-primary">
                                <tr>
								
								<th>Kode Mata Pelajaran</th>
								<th>Nama Mata Pelajaran</th>
								<th>Kategori</th>
                                <th>Sub Kategori</th>
                                <th>Aksi</th>
								</tr>
							</thead>
                            <tbody>
							<?php 
							if($list_pelajaran)
							{
							foreach($list_pelajaran as $row)
							{
								?>
							    <tr>
									<td><?php echo $row->kd_pelajaran?></td>
									<td><?php echo $row->nm_pelajaran?></td>
									<td><?php echo $row->kategori?></td>
                                    <td><?php echo $row->subkategori?></td>
                                    <td> <a href="<?php echo base_url('wakasekkurikulum/fkompetensi').'/'.$row->kd_pelajaran?>"
                                            class="btn btn-xs btn-info">Kompetensi</a><a href="<?php echo base_url('wakasekkurikulum/edit_mata_pelajaran').'/'.$row->kd_pelajaran?>" class="btn btn-xs btn-success">Edit</a>
                                        <a href="<?php echo base_url('wakasekkurikulum/delete_mata_pelajaran').'/'.$row->kd_pelajaran?>" class="btn btn-xs btn-danger">Delete</a></td>
                                </tr>
                                
							<?php
							}
							}
                            ?>
                            </tbody>
                        </table>
						
						<a href="<?php echo base_url('wakasekkurikulum/input_mata_pelajaran');?>" class="btn btn-sm btn-info">Data Baru</a>
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
    $(document).ready(function() {
        var table = $('#tabel_pelajaran').DataTable( {
            responsive: true
        } );
     
        new $.fn.dataTable.FixedHeader( table );
    });
</script>


</html>

        

