<div class="content" style="margin-top: 25px;padding-right: 0px;">

    <div class="card">

        <div class="card-content">
            <P class="title" style="margin-top: 15px;margin-bottom: -30px; "><span
                    class=" material-icons">book</span>FORM DATA EBOOK</P>
            <form  method='POST' action="<?php echo base_url('adminperpus/save_ebook')?>" role="form" enctype="multipart/form-data">
                <input type="hidden" name="aksi" id="aksi" value="<?php echo $aksi ?>" required autofocus
                    class=" form-control" placeholder="" aria-describedby="helpId">
                     <input type="hidden" name="kode_ebook" id="kode_ebook" value="<?php echo $kode_ebook ?>"  
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

                    <input type="text" name="isbn" id="isbn" value="<?php echo $isbn ?>"  autofocus
                        class="form-control" placeholder="ISBN" aria-describedby="helpId">

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
                <button type="submit" class="btn btn-info btn-xs" onclick="uploadFile()"><i class="material-icons">save </i>
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



<!-- Material Dashboard javascript methods -->
<script src="<?php echo base_url(); ?>assets/js/material-dashboard.js?v=1.2.0"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<!-- panggil adapter jquery ckeditor -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/adapters/jquery.js"></script>

<script>
 
function uploadFile() {
    // membaca data file yg akan diupload, dari komponen 'fileku'
    var file = document.getElementById("fileku").files[0];
    var formdata = new FormData();
    formdata.append("datafile", file);


     
    // proses upload via AJAX disubmit ke 'upload.php'
    // selama proses upload, akan menjalankan progressHandler()
    var ajax = new XMLHttpRequest();
    ajax.upload.addEventListener("progress", progressHandler, false);
    ajax.open("POST", "<?php echo base_url('adminperpus/uploads')?>", true);
    ajax.send(formdata);
}
 
function progressHandler(event){
    // hitung prosentase
    var percent = (event.loaded / event.total) * 100;
    // menampilkan prosentase ke komponen id 'progressBar'
    document.getElementById("progressBar").value = Math.round(percent);
    // menampilkan prosentase ke komponen id 'status'
    document.getElementById("status").innerHTML = Math.round(percent)+"% telah terupload";
    // menampilkan file size yg tlh terupload dan totalnya ke komponen id 'total'
    document.getElementById("total").innerHTML = "Telah terupload "+event.loaded+" bytes dari "+event.total;
}
 
</script>

</body>

</html>