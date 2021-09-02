<div class="content" style="padding-top: 5px;padding-bottom:5px">

    <div class="card" style="padding-bottom: 5px;padding-right: 0px;padding-top: 5px">

        <div class="card-content">
            <h4> <span class=" material-icons">hail</span>FORM DATA ANGGOTA </h4>
            <form action="<?php echo base_url('adminperpus/save_anggota')?>" method="POST" role="form">
                <input type="hidden" name="aksi" value="<?php echo $aksi?>" class="form-control" id=""
                    placeholder="ID ANGGOTA">
                <div class="form-group">
                    <input type="text" name="id_anggota" required autofocus="true" value="<?php echo $id_anggota?>"
                        class="form-control" id="" placeholder="ID ANGGOTA">
                </div>
                <div class="form-group">
                    <input type="text" name="nm_anggota" required value="<?php echo $nm_anggota?>" class="form-control"
                        id="" placeholder="NAMA ANGGOTA">
                </div>
                <div class="form-group">
                    <input type="text" name="alamat" value="<?php echo $alamat?>" class="form-control" id=""
                        placeholder="ALAMAT">
                </div>
                <div class="form-group">
                    <input type="text" name="no_hp" required value="<?php echo $no_hp ?>" class="form-control" id=""
                        placeholder="NO HP">
                </div>
                <div class="form-group">
                    <label for="">Kategori</label>
                    <?php 
						             $list=array();
                                    foreach($list_kategori as $value)
                                    {
                                        $test=$value->jns_anggota;
                                        $list[$value->jns_anggota]=$test;
                                    }
                                    echo form_dropdown('kategori',$list,$kategori,"class='form-control '");    
                                    ?>
                </div>



                <button type="submit" class="btn btn-info btn-sm"><span class="material-icons">save</span>
                    Simpan</button>
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