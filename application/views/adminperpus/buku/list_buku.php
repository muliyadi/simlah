<div class="content" style="padding-top: 5px;padding-bottom:5px">

    <div class="card" style="padding-bottom: 5px;padding-right: 0px;padding-top: 5px">

        <div class="card-content">
            <div class="table-responsive">
                <h4 class=""> <span class=" material-icons">book</span> DATA BUKU
                </H4>
                <table class="table table-hover table-responsive table-bordered table-condensed" id="tabel">
                    <thead>
                        <tr>
                            <th>ISBN</th>
                            <th>JUDUL BUKU</th>
                            <th>PENULIS</th>
                            <th>PENERBIT</th>
                            <th>THN TERBIT/</th>
                            <th>EDISI/</th>
                            <th>KATEGORI</th>
                            <th>LOKASI</th>
                            <th>JUMLAH</th>
                            <th>KONDISI</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
            if($list)
            {
                foreach ($list as $row) {
                    ?>
                        <tr>
                            <td><?php echo $row->isbn?><br><img src="<?php echo site_url();?>adminperpus/set_barcode/<?php echo $row->isbn;?>" ></td>
                            <td><?php echo $row->judul?></td>
                            <td><?php echo $row->penulis?></td>
                            <td><?php echo $row->penerbit?></td>
                            <td><?php echo $row->thn_terbit?></td>
                            <td><?php echo $row->edisi?></td>
                            <td><?php echo $row->kategori?></td>
                            <td><?php echo $row->lokasi?></td>
                            <td><?php echo $row->jumlah?></td>
                            <td><?php echo $row->kondisi?></td>
                            <td>
                                <a class="btn btn- btn-sm btn-success"
                                    href="<?php echo base_url('adminperpus/edit_buku').'/'.$row->kode_buku?>"><span
                                        class="material-icons">edit</span></a>
                                <a class="btn btn- btn-sm btn-danger"
                                    href="<?php echo base_url('adminperpus/delete_buku').'/'.$row->kode_buku?>"><span
                                        class="material-icons">delete</span></a>
                            </td>
                        </tr>
                        <?php        
                }
            }
        ?>
                    </tbody>
                </table>
                <a class="btn btn- btn-sm btn-info" href="<?php echo base_url('adminperpus/input_buku')?>"><span
                        class="material-icons">add</span>TAMBAH</a>

            </div>
            <br>

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