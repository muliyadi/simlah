<div class="content" style="padding-top: 5px;padding-bottom:5px">

    <div class="card" style="padding-bottom: 5px;padding-right: 0px;padding-top: 5px">

        <div class="card-content">
            <div class="table-responsive">
                <table class="table table-hover table-responsive table-bordered table-condensed" id="tabel">
                    <thead>
                        <tr>
                            <td>No Tra.</td>
                            <td>Tgl Pinjam</td>
                            <td>Tgl Kembali</td>
                            <td>Nama Anggota</td>
                            <td>Level</td>
                            <td>Status</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $tgl_kembali='';
            if($list_pinjam)
            {
                foreach ($list_pinjam as $row) {
                    $tgl_kembali = date('Y-m-d', strtotime('+'.$row->lama. ' days', strtotime($row->tgl_pinjam))); 
                    ?>
                        <tr>
                            <td><?php echo $row->no_pinjam?></td>
                            <td><?php echo $row->tgl_pinjam?></td>
                            <td><?php echo $tgl_kembali?></td>
                            <td><?php echo $row->nm_anggota.'/'.$row->id_anggota?></td>
                            <td><?php echo $row->kategori?></td>
                            <td><?php echo $row->status?></td>
                            <td>
                                <a href="<?php echo base_url('adminperpus/fkembali').'/'.$row->no_pinjam?>"
                                    class="btn btn-primary btn-sm detail">Kembali</a>
                                <a href="<?php echo base_url('adminperpus/delete_pinjam').'/'.$row->no_pinjam?>"
                                    class="btn btn-danger btn-sm detail">Hapus</a>
                                <button id="<?php echo $row->no_pinjam?>"
                                    class="btn btn-success btn-sm detail">Detail</button>
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

            <a class="btn btn-info btn-sm" href="<?php echo base_url('adminperpus/fpinjam')?>" role="button"><i
                    class="material-icons">add </i> TAMBAH</a>

            <br>

        </div>
    </div>
</div>
</div>
</div>

<div id="dataModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Pinjaman</h4>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <td>ISBN</td>
                            <td>Judul Buku</td>
                            <td>Penuis</td>
                            <td>Jumlah</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <tbody id="detail">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Tutup</button>
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
<script>
$(document).ready(function() {
    $(document).on('click', '.detail', function() {
        var id = $(this).attr("id");

        $.ajax({
            url: "<?php echo base_url('adminperpus/detail_pinjam');?>",
            method: "POST",
            data: {
                no_pinjam: id
            },
            success: function(data) {
                $('#detail').html(data);
                $("#dataModal").modal('show');
            }
        });
    });
})
</script>
</body>

</html>