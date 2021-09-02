<div class="content" style="margin-top: 50px;padding-bottom:5px">
     <div class="row" style="margin-top: 10px;">
             <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card ">
                <div class="card-header"data-background-color="blue">Koleksi Buku</div>
                <div class="card-content">
                <h3 align="center"><?php echo $jumlah_buku?> <small>Judul</small></h3>
              
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-danger">warning</i>
                    <a href="javascript:;">Detail...</a>
                  </div>
                </div>
              </div>
            </div>
                         <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card ">
                <div class="card-header"data-background-color="blue">Anggota</div>
                <div class="card-content">
                <h3 align="center"><?php echo $jumlah_anggota?> <small>Orang</small></h3>
              
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-danger">warning</i>
                    <a href="javascript:;">Detail...</a>
                  </div>
                </div>
              </div>
            </div>

         </div>
    <div class="row" style="margin-top: 0px;">
    <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card ">
                <div class="card-header"data-background-color="blue">
                Total Peminjaman
                 
                </div>
                <div class="card-content">
                <h3 align="center"><?php echo $pinjam+$kembali+$kembali_sebagian?> <small>Transaksi</small></h3>
              
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-danger">warning</i>
                    <a href="javascript:;">Detail...</a>
                  </div>
                </div>
              </div>
            </div>
<!--//-->
     
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card ">
                <div class="card-header"data-background-color="blue">
               Status Pinjam
                 
                </div>
                <div class="card-content">
                <h3 align="center"><?php echo $pinjam?> <small>Transaksi</small></h3>
              
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-danger">warning</i>
                    <a href="javascript:;">Detail...</a>
                  </div>
                </div>
              </div>
            </div>

        
                 <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card ">
                <div class="card-header"data-background-color="blue">
               Status Kembali Penuh
                 
                </div>
                <div class="card-content">
                <h3 align="center"><?php echo $kembali?> <small>Transaksi</small></h3>
              
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-danger">warning</i>
                    <a href="javascript:;">Detail...</a>
                  </div>
                </div>
              </div>
            </div>
     <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card ">
                <div class="card-header"data-background-color="blue">
                Status Kembali Sebagian
                 
                </div>
                <div class="card-content">
                <h3 align="center"><?php echo $kembali_sebagian?> <small>Transaksi</small></h3>
              
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-danger">warning</i>
                    <a href="javascript:;">Detail...</a>
                  </div>
                </div>
              </div>
            </div>
            
            </div>
            <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="card ">
                <div class="card-header"data-background-color="blue">Top Rank Pengunjung</div>
                <div class="card-content">
                      <ul class="list-group">
                    <?php
                    foreach($list_top_pengunjung as $pengunjung)
                    {
                        ?>
                         <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo $pengunjung->nm_anggota.'-'.$pengunjung->id_anggota?>
                    <span class="badge badge-info badge-pill"><?php echo $pengunjung->jumlah?></span>
                  </li>
                    <?php    
                    }
                    ?>
               
                </ul>  
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-danger">warning</i>
                    <a href="javascript:;">Detail...</a>
                  </div>
                </div>
              </div>
              </div>
                     <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="card ">
                <div class="card-header"data-background-color="blue">Top Rank Buku</div>
                <div class="card-content">
                      <ul class="list-group">
                    <?php
                    foreach($list_top_buku as $buku)
                    {
                        ?>
                         <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo $buku->judul?>
                    <span class="badge badge-info badge-pill"><?php echo $buku->jumlah?></span>
                  </li>
                    <?php    
                    }
                    ?>
               
                </ul>  
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-danger">warning</i>
                    <a href="javascript:;">Detail...</a>
                  </div>
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