<div class="content" style="margin-top: 25px;padding-right: 0px;">

    <div class="card">

        <div class="card-content">
<h2> Upload File Ebook</h2>
            
            <form id="upload_form" enctype="multipart/form-data">
   <input type="file" name="datafile" id="fileku"><br>
   <input type="hidden" name="kode_ebook" id="kode_ebook" value="<?php echo $kode_ebook?>">
   <input type="button" value="Upload File" onclick="uploadFile()">
   <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
   <h3 id="status"></h3>
   <p id="total"></p>
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
    var kode = document.getElementById("kode_ebook").value;
    
    let formdata = new FormData();
    formdata.append("datafile", file);
       formdata.append("kode", kode);

  
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