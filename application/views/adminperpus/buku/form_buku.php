<div class="content" style="margin-top: 25px;padding-right: 0px;">

    <div class="card">

        <div class="card-content">
            <P class="title" style="margin-top: 15px;margin-bottom: -30px; "><span
                    class=" material-icons">book</span>FORM DATA BUKU</P>
            <form action="<?php echo base_url('adminperpus/save_buku')?>" method='POST' role="form">
                <input type="hidden" name="aksi" id="aksi" value="<?php echo $aksi ?>" required autofocus
                    class=" form-control" placeholder="" aria-describedby="helpId">
               
                <div class="form-group">

                    <input type="text" name="judul" value="<?php echo $judul ?>" id="judul" class="form-control"
                        placeholder="Judul Buku" aria-describedby="helpId">

                </div>
                <div class="form-group">

                    <input type="text" name="penulis" value="<?php echo $penulis ?>" id="penulis" class="form-control"
                        placeholder="Penulis" aria-describedby="helpId">

                </div>
                <div class="form-group">

                    <input type="text" name="penerbit" id="penerbit" value="<?php echo $penerbit ?>"
                        class="form-control" placeholder="Penerbit" aria-describedby="helpId">

                </div>
                <div class="form-group">

                    <input type="number" name="thn_terbit" id="thn_terbit" value="<?php echo $thn_terbit ?>"
                        class="form-control" placeholder="Tahun Terbit" aria-describedby="helpId">

                </div>
                <div class="form-group">

                    <input type="number" name="edisi" id="edisi" value="<?php echo $edisi ?>" class="form-control"
                        placeholder="Edisi" aria-describedby="helpId">

                </div>

                <div class="form-group">
                    <label for="">Kategori</label>
                    <?php 
						             $list=array();
                                    foreach($list_kategori as $value)
                                    {
                                        $test=$value->nm_kategori;
                                        $list[$value->id]=$test;
                                    }
                                    echo form_dropdown('kategori',$list,$kategori,"class='form-control '");    
                                    ?>
                </div>
                <div class="form-group">

                    <input type="text" name="lokasi" id="lokasi" value="<?php echo $lokasi ?>" class="form-control"
                        placeholder="Lokasi" aria-describedby="helpId">

                </div>
                <div class="form-group">

                    <input type="number" name="jumlah" id="jumlah" value="<?php echo $jumlah ?>" class="form-control"
                        placeholder="Jumlah" aria-describedby="helpId">

                </div>
 <div class="form-group">

                    <input type="text" name="isbn" id="isbn" value="<?php echo $isbn ?>" required autofocus
                        class="form-control" placeholder="ISBN" aria-describedby="helpId">

                </div>



                <button type="submit" class="btn btn-info btn-xs"><i class="material-icons">save </i>
                    Simpan </button>
                <button type="reset" class="btn btn-danger btn-xs"><i class="material-icons">autorenew </i>
                    Batal </button>
            </form>


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

</body>

</html>