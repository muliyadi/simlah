<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    
                    <div class="card-content table-responsive">
                         <h4 class="title">Data Nilai Siswa Kelas: <?php echo $jadwal->kelas?><br><b>Mata Pelajaran <?php echo $pelajaran->nm_pelajaran?></b></h4>
                        <table class="table table-responsive table-striped table-bordered " id="tabel" >
                            <thead class="text-primary">
                                <tr>
                                <th>No</th>   
                                <th width="4%" rowspan="2">NIS</th>
                                 <th >Nama Siswa  (Status)</th>
                                 <th>Kelas</th>
                                <th >Sikap Spritual</th>
                               <th >Sikap Sosial</th>
                              <th width="5%" >Nilai Pengetahuan</th>
                                    <th>Deskripsi</th>
                                    <th width="5%" >Nilai Keterampilan</th>
                                    <th >Deskripsi</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                            <?php 
                            $no=1;
                            foreach($list_nilai as $row)
                            {
                                if($row->nilai_spritual=='4')
                                {
                                    $predikats="Sangat Baik";
                                }elseif($row->nilai_spritual=='3')
                                {
                                    $predikats="Baik";
                                }elseif($row->nilai_spritual=='2')
                                {
                                    $predikats="Cukup";
                                }else{
                                    $predikats="Kurang";
                                } 
                                if($row->nilai_sosial=='4')
                                {
                                    $predikatsos="Sangat Baik";
                                }elseif($row->nilai_sosial=='3')
                                {
                                    $predikatsos="Baik";
                                }elseif($row->nilai_sosial=='2')
                                {
                                    $predikatsos="Cukup";
                                }else{
                                    $predikatsos="Kurang";
                                } 
                                    
                                ?>
                                <tr>
                                    <td align="center"><?php echo $no++?></td>
                                    <td align="center"><?php echo $row->nis?></td>
                                    <td><?php echo $row->nm_siswa.' ('.$row->status.')'?></td>
                                    <td align="center"><?php echo $row->kelas?></td>
                                    <td align="center"><?php echo $predikats?></td>
                                    <td align="center"><?php echo $predikatsos ?></td>
                                    <td align="center"><?php echo $row->nilai_pengetahuan ?></td>
                                    <td><?php echo $row->desc_nilai_pengetahuan ?></td>
                                    <td align="center"><?php echo $row->nilai_keterampilan ?></td>
                                    <td><?php echo $row->desc_nilai_keterampilan ?></td>
                                   
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
        var table = $('#tabel').DataTable( {
            responsive: false,
            paging:         false
        } );
     
        new $.fn.dataTable.FixedHeader( table );
    });
</script>

</html>

        

