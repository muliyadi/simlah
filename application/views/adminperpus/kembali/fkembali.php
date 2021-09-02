<div class="content" style="margin-top: 25px;padding-right: 0px;">

    <div class="card">

        <div class="card-content">
            <H4 class="title" style="margin-top: 15px;margin-bottom: 0px; ">
                FORM PENGEMBALIAN BUKU </H4>




            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;" />

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="group_relawan">No Pinjam</label>
                    <input name="no_pinjam" id="no_pinjam" value="<?php echo $no_pinjam?>" class="form-control"
                        type="text" required>
                </div>
                <div class="form-group col-md-8">
                    <label for="lama">Tgl Pinjam </label>
                    <input name="tgl_pinjam" readonly id="tgl_pinjam" value="<?php echo $tgl_pinjam?>"
                        class="form-control" type="date">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="group_relawan">ID Anggota</label>
                    <input name="id_anggota" id="id_anggota" value="<?php echo $id_anggota?>" class="form-control"
                        type="text" required>
                </div>
                <div class="form-group col-md-8">
                    <label for="lama">Nama Anggota</label>
                    <input name="nm_anggota" readonly id="nm_anggota" value="<?php echo $nm_anggota?>"
                        class="form-control" type="text">
                </div>
            </div>


            <div class="row">
                <div class="form-group col-md-4">
                    <label for="lama">Tgl Batas Pengembalian</label>
                    <input name="tgl_jatuh_tempo" id="tgl_jatuh_tempo" value="<?php echo $tgl_jatuh_tempo?>"
                        class="form-control" type="date" required autofocus>
                </div>
                <div class="form-group col-md-4">
                    <label for="lama">Telat (Hari)</label>
                    <input name="telat" id="telat" value="<?php echo $telat?>" class="form-control" type="number"
                        required autofocus>
                </div>
            </div>




            <h4 class="title"> Detail Pinjaman</h4>
            <div class="card">
                <table id='tbuku' class="table table-responsive table-bordered"
                    style="margin-top: -45px;padding-right: 0px;">
                    <thead>
                        <tr>
                            <td>ISBN</td>
                            <td>JUDUL</td>
                            <td>PENULIS</td>
                            <td>JUMLAH PINJAM</td>
                            <td>JUMLAH KEMBALI</td>
                            <td>STATUS</td>
                            <td>AKSI</td>

                        </tr>
                    </thead>
                    <tbody id="detail_cart">
                        <?php
                        $jumlah_kembali=0;
                        foreach($list_pinjaman as $row)
                        {
                            foreach($list_kembali as $rowk)
                            {
                                if($rowk->kode_buku==$row->kd_buku)
                                {
                                    $jumlah_kembali=$rowk->jumlah;   
                                }else{
                                    $jumlah_kembali=0;
                                }
                            }
                        ?>
                        <tr>
                            <td id="kode_buku"><?php echo $row->isbn?></td>
                            <td><?php echo $row->judul?></td>
                            <td><?php echo $row->penulis?></td>
                            <td id="jumlah_pinjam"><?php echo $row->jumlah?></td>
                            <td><input type="number" name="jumlah" id="jumlah" value="<?php echo $jumlah_kembali?>">
                            </td>
                            <td><?php echo $row->status?></td>
                            <td>
                                <button class="btn btn-sm btn-info status" id="status">Kembali</button>
                            </td>

                        </tr>
                        <?php    
                            }
                            
                        

                            ?> 

                                        
                    </tbody>

                </table>


            </div>


            <a class="btn btn-info btn-sm" href="<?php echo base_url('adminperpus/pinjam')?>" role="button">
                <--- </a>




                    <br>

                    <br>

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
<script type="text/javascript">
$("#tbuku").on('click', '.status', function(e) {
    var currentRow = $(this).closest("tr");
    var no_pinjam = $("#no_pinjam").val();
    var telat = $("#telat").val();
    var jumlah = currentRow.find("#jumlah").val();
    var jumlah_pinjam = currentRow.find("#jumlah_pinjam").html();
    var kode_buku = currentRow.find("#kode_buku").html();
    $.ajax({
        url: "<?php echo base_url('adminperpus/save_kembali');?>",
        method: "POST",
        data: {
            telat: telat,
            no_pinjam: no_pinjam,
            kode_buku: kode_buku,
            jumlah: jumlah,
            jumlah_pinjam: jumlah_pinjam
        },
        success: function(data) {
            var url = "<?php echo base_url('adminperpus/pinjam')?>";
            alert('Data tersimpan...!');
            if (data == '1') {
                $(location).attr('href', url);
            }




        }
    });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    var table = $('#tbuku').DataTable({
        responsive: true
    });

    new $.fn.dataTable.FixedHeader(table);
});
</script>
</body>

</html>