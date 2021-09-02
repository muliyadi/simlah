<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                  
                    <div class="card-content table-responsive">
                          <h4 class="title"> Data Guru </h4>
                        <table class="table table-responsive table-striped table-bordered" id="tabel_program">
                            <thead class="text-primary">
                                <tr>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Tempat / Tgl Lahir</th>
                                <th>NUPTK</th>
                                <th>NIK</th>
                                <th>NIP</th>
                                <th>Gender</th>
                                <th>Agama</th>
                                <th>Alamat</th>
                                <th>No HP</th>
                                <th>Email</th>
                                <th>Pendidikan Terakhir</th>
                                <th>Pangkat / Golongan</th>
                                <th>Bidang Pengajaran</th>
                                <th>Status</th>
                               
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($list as $row)
                            {
                                ?>
                                <tr>
                                    <td><img src="<?php echo base_url('foto_guru').'/'.$row->image?>" style="width: 6rem;height:6rem;"></td>
                                     <td><?php echo $row->nm_guru?></td>
                                    <td><?php echo $row->tempat.' / '.$row->tgl_lahir?></td>
                                    <td><?php echo $row->nuptk?></td>
                                    <td><?php echo $row->nik?></td>
                                    <td><?php echo $row->nip?></td>
                                    <td><?php echo $row->jk?></td>
                                    <td><?php echo $row->agama?></td>
                                    <td><?php echo $row->alamat?></td>
                                    <td><?php echo $row->no_hp?></td>
                                    <td><?php echo $row->email?></td>
                                    <td><?php echo $row->pendidikan?></td>
                                    <td><?php echo $row->pangkat.' / '. $row->golongan?></td>
                                    <td><?php echo $row->bidang?></td>
                                    <td><?php echo $row->status?></td>
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
            responsive: true
        } );
     
        new $.fn.dataTable.FixedHeader( table );
    });
</script>


</html>

        

