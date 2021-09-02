<div class="content" style="padding-top: 5px;padding-bottom:5px">

    <div class="card" style="padding-bottom: 5px;padding-right: 0px;padding-top: 5px">

        <div class="card-content">
            <h4> <span class=" material-icons">hail</span>DATA ANGGOTA</h4>
            <div class="table-responsive">
                <table class="table table-hover table-responsive table-bordered" id="tabel">
                    <thead>
                        <tr>
                            <td>ID ANGGOTA</td>
                            <td>NAMA ANGGOTA</td>
                            <td>LEVEL</td>
                            <td>STATUS</td>
                            <td>AKSI</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
            if($list)
            {
                foreach ($list as $row) {
                    ?>
                        <tr>
                            <td><?php echo $row->id_anggota?></td>
                            <td><?php echo $row->nm_anggota?></td>
                            <td><?php echo $row->kategori?></td>
                            <td><?php echo $row->status?></td>
                            <td>
                                <a class="btn btn-sm  btn-success"
                                    href="<?php echo base_url('adminperpus/edit_anggota').'/'.$row->id_anggota?>"><span
                                        class="material-icons">edit</span></a>
                                <a class="btn btn-sm  btn-danger"
                                    href="<?php echo base_url('adminperpus/delete_anggota').'/'.$row->id_anggota?>"><span
                                        class="material-icons">delete</span></a>
                            </td>
                        </tr>
                        <?php        
                }
            }
        ?>
                    </tbody>
                </table>

            </div>
            <br>
            <a class="btn btn-sm  btn-info" href="<?php echo base_url('adminperpus/input_anggota')?>"><span
                    class="material-icons">add</span>TAMBAH</a>
            <a class="btn btn-sm  btn-warning" href="<?php echo base_url('adminperpus/sinkron_anggota')?>"><span
                    class="material-icons">autorenew</span>SINKRON</a>
            <a class="btn btn-sm  btn-danger" href="<?php echo base_url('adminperpus/delete_anggota_all')?>"><span
                    class="material-icons">delete</span>DELETE ALL</a>
            <br>

        </div>
    </div>
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