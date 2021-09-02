<div class="content" style="padding-top: 5px;padding-bottom:5px">

    <div class="card" style="padding-bottom: 5px;padding-right: 0px;padding-top: 5px">

        <div class="card-content">
            <div class="table-responsive">
                          <h4 class="title">	<a href="<?php echo base_url('xkurikulum/input_detail_kurikulum')?>" class="btn btn-xs btn-info">Data Baru</a> Data Matapelajaran Kurikulum </h4>
                        <table class="table table-responsive table-striped table-bordered" id="tabel_program">
                            <thead class="text-primary">
                                <tr>

                                <th>Kode Kurikulum</th>
                                <th>Matapelajaran</th>
                                <th>Tingkat</th>
                                <th>Semester</th>
                                <th>Kategori</th>
                               
                                
                                  <th>Alokasi Waktu</th>
								<th>Aksi</th>
								</tr>
							</thead>
                            <tbody>
							<?php foreach($list_kurikulum_detail as $row)
							{
								?>
							    <tr>
                                   
                                    <td><?php echo $row->kd_kurikulum?></td>
                                      <td><?php echo $row->nm_pelajaran?></td>
                                    <td><?php echo $row->tingkat?></td>
                                   
                                    <td><?php echo $row->semester?></td>
                                     <td><?php echo $row->group_kategori.'-'.$row->kategori?></td>
                                  
                                    
                                     <td><?php echo $row->waktu?></td>
                       
                                    <td>
                                          <a href="<?php echo base_url('xkurikulum/input_kompetensi').'/'.$row->id_kurikulum?>" class="btn btn-xs btn-info">Kompetensi</a>
                                       <a href="<?php echo base_url('xkurikulum/edit_kurikulum').'/'.$row->id_kurikulum?>" class="btn btn-xs btn-success">Edit</a>
									   <a href="<?php echo base_url('xkurikulum/delete_kurikulum').'/'.$row->id_kurikulum?>" class="btn btn-xs btn-danger">Delete</a>
                                    </td>
                                </tr>
                                
							<?php
							}
                            ?>
                            </tbody>
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
        var table = $('#tabel_program').DataTable( {
            responsive: false
        } );
     
      
    });
</script>


</html>

        

