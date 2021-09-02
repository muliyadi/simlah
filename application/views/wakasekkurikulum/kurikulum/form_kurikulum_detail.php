<div class="content" style="padding-top: 5px;padding-bottom:5px">

    <div class="card" style="padding-bottom: 5px;padding-right: 0px;padding-top: 5px">

        <div class="card-content">
            <form action="<?php echo base_url('wakasekkurikulum/save_detail_kurikulum')?>" method="POST" role="form">
                    <input type="hidden" name="kd_kurikulum" value="<?php echo $kd_kurikulum?>">
                        <div class="row">
                            <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tingkat</label>
                          <?php 
                        $list=array();
                        foreach($list_tingkat as $value)
                        {
                            $test=$value->tingkat;
                            $list[$value->tingkat]=$test;
                        }
                        echo form_dropdown('tingkat',$list,$tingkat,"class='form-control '");    
                        ?>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Semester</label>
                          <?php 
                        $list=array();
                        foreach($list_semester as $value)
                        {
                            $test=$value->semester_huruf;
                            $list[$value->semester]=$test;
                        }
                        echo form_dropdown('semester',$list,$semester,"class='form-control '");    
                        ?>
                        </div>
                         </div>
                        </div>
                        
                        
                        <div class="row">
                                           <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Kategori</label>
                             <?php 
                        $list=array();
                        foreach($list_kategori as $value)
                        {
                            $test=$value->group_kategori.'-'.$value->kategori;
                            $list[$value->kategori]=$test;
                        }
                        echo form_dropdown('kategori',$list,'',"class='form-control '");    
                        ?>

                        </div>
                        </div>
                            <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama Pelajaran</label>
                             <?php 
                        $list=array();
                        foreach($list_pelajaran as $value)
                        {
                            $test=$value->nm_pelajaran;
                            $list[$value->kd_pelajaran]=$test;
                        }
                        echo form_dropdown('kd_pelajaran',$list,'',"class='form-control '");    
                        ?>

                        </div>
                        </div>
           
                                            <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Alokasi Waktu</label>
                             <input type="number" name="waktu" class="form-control">

                        </div>
                        </div>
                        </div>
                        
                       <button type="submit" class="btn btn-info btn-sm">Simpan</button>
                         <a href="<?php echo base_url('wakasekkurikulum/list_detail_kurikulum')?>" class="btn btn-warning btn-sm">Kembali</a>
        </form>
        </div>




    </div>
</div>
<!-- Required Jquery -->
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

<script src="<?php echo base_url(); ?>assets/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables-plugins/dataTables.bootstrap.min.js"></script>


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
    var table = $('#tabel').DataTable({
        responsive: true
    });

    new $.fn.dataTable.FixedHeader(table);
});
</script>

</body>

</html>