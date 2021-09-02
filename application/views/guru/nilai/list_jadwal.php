<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                   
                    <div class="card-content ">
                          <h4 class="title">Jadwal Pelajaran Tahun Ajaran <?php echo $kd_ta?> </h4>
                        <table class="table  table-striped table-bordered" id="tabel">
                            <thead class="text-primary">
                                <tr>
                                     <th>Guru</th>
                                <th>Hari</th>
                                <th>Waktu</th>
                                <th>Mata Pelajaran</th>
                               
                                <th>Kelas</th>
                                <th>Status</th>
                                <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($list_jadwal as $row)
                            {
                                ?>
                                <tr>
                                     <td><?php echo $row->id_guru?></td>
                                     <td><?php echo $row->hari?></td>
                                    <td><?php echo $row->jam_masuk.'-'.$row->jam_keluar?></td>
                                    <td><?php echo $row->nm_pelajaran.'/'.$row->kd_pelajaran?></td>
                                   
                                    <td><?php echo $row->kelas?></td>
                                     <td><?php echo $row->status?></td>
                                    <td>
                                        <?php 
                                            if($row->status=='Aktif')
                                            {
                                                ?>
                                                <a href="<?php echo base_url('guru/template_nilai').'/'.$row->kelas.'/'.$row->kd_jadwal?>" class="btn btn-xs btn-default"> <i class="material-icons">restore_page </i> Template Nilai</a>  
                                              <a href="<?php echo base_url('guru/preview').'/'.$row->kd_jadwal?>" class="btn btn-xs btn-primary"> <i class="material-icons">create </i>  Import Nilai</a>  
                                              <a href="<?php echo base_url('guru/input_nilai').'/'.$row->kelas.'/'.$row->kd_jadwal?>" class="btn btn-xs btn-info"> <i class="material-icons">create </i> Nilai </a>
                                            <?php   
                                            }else
                                            {
                                                ?>
                                                 <a href="<?php echo base_url('guru/view_nilai').'/'.$row->kd_jadwal?>" class="btn btn-xs btn-success"> <i class="material-icons">visibility </i> View Nilai </a>
                                                <a href="<?php echo base_url('guru/usul_akses_nilai').'/'.$row->kd_jadwal?>" class="btn btn-xs btn-warning"> <i class="material-icons">create </i> Izin Akses </a>
                                            <?php    
                                            }
                                        ?>
                                        
                                        
                                         
                                   
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
<!--   Core JS Files 
<a href="<?php echo base_url('guru/input_tugas_quiz').'/'.$row->kelas.'/'.$row->kd_jadwal?>" class="btn btn-xs btn-success"> <i class="material-icons">create </i> Tugas & Quiz</a>
         <a href="<?php echo base_url('guru/input_absen').'/'.$row->kelas.'/'.$row->kd_jadwal?>" class="btn btn-xs btn-warning"> <i class="material-icons">create </i>Absen</a>                               
                                        -->
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
        var table = $('#tabel').DataTable( {
            responsive: true
        } );
     
        new $.fn.dataTable.FixedHeader( table );
    });
</script>


</html>

        

