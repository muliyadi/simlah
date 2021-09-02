<div class="content" style="margin-top: 25px;padding-right: 0px;">

    <div class="card">

        <div class="card-content">
            <P class="title" style="margin-top: 15px;margin-bottom: -30px; "><span
                    class=" material-icons">book</span>FORM LINK EBOOK</P>
            <form  method='POST' action="<?php echo base_url('adminperpus/update_link_ebook')?>" role="form" enctype="multipart/form-data">
                
                     <input type="hidden" name="kode_ebook" id="kode_ebook" value="<?php echo $kode_ebook ?>"  
                    class=" form-control" placeholder="" aria-describedby="helpId">
  

                <div class="form-group">
                     <label>Judul Ebook</label>
                    <input type="text" name="judul" value="<?php echo $judul ?>" id="judul" class="form-control"
                        placeholder="Judul Buku" aria-describedby="helpId">

                </div>
                <div class="form-group">
                    <label>Link Ebook</label>
                    <input type="text" name="link"  class="form-control"
                        placeholder="Paste Link Ebook" aria-describedby="helpId">

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


</body>

</html>