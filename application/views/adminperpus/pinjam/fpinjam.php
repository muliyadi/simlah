<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-content table-responsive">
                        <h4 class="title"> FORM PINJAM BUKU </h4>



                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                            value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;" />

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="group_relawan">ID Anggota</label>
                                <input name="id_anggota" autofocus id="id_anggota" class="form-control" type="text"
                                    required>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="lama">Nama Anggota</label>
                                <input name="nm_anggota" readonly id="nm_anggota" class="form-control" type="text">
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="lama">Lama Pinjam(Hari)</label>
                                <input name="lama" id="lama" class="form-control" type="number" required autofocus>
                            </div>
                        </div>



                        <div class="card">


                            <div class="card-content">
                                <h4 class="title"> Detail Pinjaman</h4>
                                <div class="row">

                                    <div class="form-group col-md-2">
                                        <label for="group_relawan">ISBN</label>
                                        <input name="kode_buku" id="kode_buku" class="form-control" type="text"
                                            autofocus>
                                    </div>
                                    <div class="form-group col-md-5	">
                                        <label for="judul">Judul Buku</label>
                                        <input name="judul" id="judul" readonly class="form-control" type="text">
                                    </div>
                                    <div class="form-group col-md-3	">
                                        <label for="judul">Penulis</label>
                                        <input name="penulis" id="penulis" readonly class="form-control" type="text">
                                    </div>
                                    <div class="form-group col-md-1	">
                                        <label for="jumlah">Jumlah</label>
                                        <input name="jumlah" id="jumlah" class="form-control" type="number">
                                    </div>
                                    <div class="form-group col-md-1	">
                                        <label for="jumlah">Aksi</label>
                                        <a class="btn btn-sm btn-info tambah">+</a>
                                    </div>
                                </div>
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <td>ISBN</td>
                                            <td>JUDUL</td>
                                            <td>PENULIS</td>
                                            <td>JUMLAH</td>

                                            <td>AKSI</td>
                                        </tr>
                                    </thead>
                                    <tbody id="detail_cart">
                                         
                                                         </tbody>

                                </table>
                            </div>

                        </div>

                        <button type="button" class="btn btn-info btn-sm simpan"><i class="material-icons">save
                            </i> Simpan
                        </button>
                        </form>

                    </div>
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
function tampilkanPreview(userfile, idpreview) {
    var gb = userfile.files;
    for (var i = 0; i < gb.length; i++) {
        var gbPreview = gb[i];
        var imageType = /image.*/;
        var preview = document.getElementById(idpreview);
        var reader = new FileReader();
        if (gbPreview.type.match(imageType)) {
            //jika tipe data sesuai
            preview.file = gbPreview;
            reader.onload = (function(element) {
                return function(e) {
                    element.src = e.target.result;
                };
            })(preview);
            //membaca data URL gambar
            reader.readAsDataURL(gbPreview);
        } else {
            //jika tipe data tidak sesuai
            alert("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
        }
    }
}
</script>
<script>
function cek_isian() {
    var kode_buku = $("#kode_buku").val();
    var judul = $("#judul").val();
    var penulis = $("#penulis").val();
    var jumlah = $("#jumlah").val();
    var id_anggota = $("#id_anggota").val();
    if (kode_buku == ''
        or id_anggota == ''
        or jumlah == '') {
        alert('Kode Buku Tidak boleh kosong');
    }
}
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('.tambah').click(function() {

        var kode_buku = $("#kode_buku").val();
        var judul = $("#judul").val();
        var penulis = $("#penulis").val();
        var jumlah = $("#jumlah").val();
        var id_anggota = $("#id_anggota").val();
        if (kode_buku == '' || id_anggota == '' || jumlah == '') {
            alert('ID ANGGOTA,ISBN,JUMLAH Tidak boleh kosong');
            $("#id_anggota").focus();
        } else {
            $.ajax({
                url: "<?php echo base_url('adminperpus/api_add_buku')?>",
                method: "POST",
                data: {
                    id_anggota: id_anggota,
                    kode_buku: kode_buku,
                    judul: judul,
                    penulis: penulis,
                    jumlah: jumlah
                },
                success: function(data) {
                    $('#detail_cart').html(data);
                    $('#judul').val('');
                    $('#penulis').val('');
                    $('#kode_buku').val('');
                    $('#kode_buku').focus();

                }
            });
        }



    });

    // Load shopping cart
    $('#detail_cart').load("<?php echo base_url('adminperpus/load_cart');?>");

    //Hapus Item Cart
    $(document).on('click', '.hapus_cart', function() {
        var id = $(this).attr("id");
        var id_anggota = $("#id_anggota").val(); //mengambil row_id dari artibut id
        $.ajax({
            url: "<?php echo base_url('adminperpus/batal_pinjam');?>",
            method: "POST",
            data: {
                id: id,
                id_anggota: id_anggota
            },
            success: function(data) {
                $('#detail_cart').html(data);
            }
        });
    });

    $(document).on('click', '.simpan', function() {


        var id_anggota = $("#id_anggota").val();
        var lama = $("#lama").val();

        $.ajax({
            url: "<?php echo base_url('adminperpus/save_pinjam');?>",
            method: "POST",
            data: {
                lama: lama,
                id_anggota: id_anggota
            },
            success: function(data) {
                alert('Data berhasil tersimpan');
                $("#id_anggota").val('');
                $("#lama").val('');
                var url = "<?php echo base_url('adminperpus/pinjam')?>";
                $(location).attr('href', url);

            }
        });
    });
});
</script>




<script>
$(document).ready(function() {
    $("#id_anggota").keypress(function() {
        if (event.which == 13) {
            var id_anggota = $("#id_anggota").val();

            $.ajax({
                url: "<?php echo base_url('adminperpus/api_get_anggota');?>",
                method: "POST",
                data: {
                    id_anggota: id_anggota
                },
                success: function(data) {
                    if (data == '0') {
                        alert('Data Anggota tidak ada');
                        $("#nm_anggota").val('');
                        $("#id_anggota").focus();

                    } else if (data == 'x') {
                        alert('Masih ada pinjaman buku yang belum dikembalikan!');
                        $("#nm_anggota").val('');
                        $("#id_anggota").focus();
                    } else {
                        $("#nm_anggota").val(data);
                        $("#lama").focus();
                    }

                }
            });
        }

    });

    $("#kode_buku").keypress(function() {
        if (event.which == 13) {
            var kode_buku = $("#kode_buku").val();

            $.ajax({
                url: "<?php echo base_url('adminperpus/api_get_buku');?>",
                method: "POST",
                data: {
                    kode_buku: kode_buku
                },
                success: function(hasil) {
                    data = hasil.split("|");
                    if (data == '0') {
                        alert('Data Buku tidak ada');
                        $("#judul").val('');
                        $("#penulis").val('');
                        $("#kode_buku").focus();

                    } else {
                        $("#judul").val(data[0]);
                        $("#penulis").val(data[1]);
                        $("#jumlah").focus();
                    }

                }
            });
        }

    });



});
</script>