<div class="content" style="padding-top: 0px;padding-bottom:5px">

    <div class="card" style="padding-bottom: 5px;padding-right: 0px;padding-top: 5px">

        <div class="card-content">
            <h3>Laporan Peminjaman Jatuh Tempo</h3>
             <a class="btn btn-info btn-sm" href="<?php echo base_url('adminperpus/print_jatuh_tempo')?>" role="button"><i
                    class="material-icons">print </i> PRINT</a>
                     <a class="btn btn-info btn-sm" href="<?php echo base_url('adminperpus/print_rincian_jatuh_tempo')?>" role="button"><i
                    class="material-icons">list </i> Rincian Buku</a>
            <div class="table-responsive">
                <table class="table table-hover table-responsive table-bordered table-condensed" id="tabel">
                    <thead>
                        <tr>
                            <td>No Tra.</td>
                            <td>Tgl Pinjam</td>
                            <td>Tgl J.Tempo</td>
                             <td>Selisih</td>
                            <td>Anggota</td>
                            <td>Level</td>
                             <td>Alamat</td>
                            <td>Status</td>
                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
            if($list_jatuh_tempo)
            {
                foreach ($list_jatuh_tempo as $row) {
               
                    ?>
                        <tr>
                            <td><?php echo $row->no_pinjam?></td>
                            <td><?php echo $row->tgl_pinjam?></td>
                            <td><?php echo $row->tgl_tempo?></td>
                            <td><?php echo $row->selisih?></td>
                            <td><?php echo $row->nm_anggota.'/'.$row->id_anggota?></td>
                            <td><?php echo $row->kategori?></td>
                            <td><?php echo $row->alamat?></td>
                             <td><?php echo $row->status?></td>
                           
                        </tr>
                        <?php        
                }
            }
        ?>
                    </tbody>
                </table>

            </div>
            <br>

            <a class="btn btn-info btn-sm" href="<?php echo base_url('adminperpus/fpinjam')?>" role="button"><i
                    class="material-icons">print </i> PRINT</a>

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