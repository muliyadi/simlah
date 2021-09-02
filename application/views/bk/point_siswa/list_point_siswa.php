<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                   
                    <div class="card-content table-responsive">
                         <h4 class="title"> Data Point Siswa </h4>
                        <table class="table table-responsive table-striped table-bordered" id="tabel_program">
                            <thead class="text-primary">
                                <tr>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Debit</th>
                                <th>Kredit</th>
                                <th>Saldo</th>
                                <th>Tahun Ajaran</th>
                                <th>Bulan</th>
                              	<th>Aksi</th>
								</tr>
							</thead>
                            <tbody>
							<?php foreach($list as $row)
							{
							    $ta='20201';
								?>
							    <tr>
                                    <td  width="120" align="center"><img src="<?php echo base_url('foto_siswa').'/'.$row->image?>" style="width: 10rem;height:12rem;"><br><?php echo $row->nis.'/'.$row->nisn?></td>
								    
                                    <td><?php echo $row->nm_siswa?></td>
                                    <td><?php echo $row->kelas?></td>
                                    <td><?php echo $row->debit?></td>
                                    <td><?php echo $row->kredit?></td>
                                    <td><?php echo $row->saldo?></td>
                                    <td><?php echo $row->kd_ta?></td>
                                    <td><?php echo $row->bulan?></td>
                                    <td>
                                    <a href="<?php echo base_url('bk/edit_point_siswa').'/'.$row->nis.'/'.$ta?>" class="btn btn-info btn-sm"> UBAH</a>
                                    </td>
                                </tr>
                                
							<?php
							}
                            ?>
                            </tbody>
                        </table>
						
						<a href="<?php echo base_url('bk/input_point_siswa')?>" class="btn btn-info btn-sm"> TAMBAH</a>
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
            responsive: true
        } );
     
        new $.fn.dataTable.FixedHeader( table );
    });
</script>


</html>

        

