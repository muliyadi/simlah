<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                   
                    <div class="card-content table-responsive">
                          <h4 class="title">Input Catatan Rapor Siswa Tahun Ajaran <?php echo $kd_ta?> <br><b></b></h4>
                        <table class="table table-responsive table-striped table-bordered " id="tabel" >
                            <thead class="text-primary">
                                <tr>
                                   
                                <th width="4%" >NIS</th>
                                 <th >Nama Siswa</th>
                                 <th >Kelas</th>
                                <th >Catatan</th>
                              
         
                              
                                <th >Aksi</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                            <?php 
                            $no=1;
                            foreach($list_catatan as $row)
                            {
                              
                                                
                                    
                                ?>
                                <tr>
                                    
                                    <td><input type="hidden" name="kd_ta" id="kd_ta" value="<?php echo $row->kd_ta?>" class="kd_ta">
                                    <input type="text" name="nis" style="width:50px;" readonly="true" id="nis" value="<?php echo $row->nis?>" class="form-control nis"></td>
                                    <td><input type="text" name="nm_siswa" style="width:120px;"   readonly="true" id="nm_siswa" value="<?php echo $row->nm_siswa?>" class="form-control"></td>
                                    <td><input type="text" name="kelas" style="width:80px;"  readonly="true" id="kelas" value="<?php echo $row->kelas?>" class="form-control"></td>
                                   
                                   
                                    <td><input type="text" id="catatan" value="<?php echo $row->catatan ?>" minlength="1" maxlength="120" style="width:350px;"  class="form-control"></td>
                                   
                                    <td><button class="btn btn-sm btn-info  update">Simpan</button>
                                   
                                    </td>
                                </tr>
                                
                            <?php
                            

                                }
                            
                            ?>
                            </tbody>
                        </table>
                        
                        
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
    $(document).ready(function() {
        var table = $('#tabel').DataTable( {
            responsive: false,
            paging:         false
        } );
     
        new $.fn.dataTable.FixedHeader( table );
    });
</script>

<script type="text/javascript">
$("#tabel").on('click', '.update', function(e) {
var currentRow = $(this).closest("tr");
    var nis = currentRow.find("#nis").val();
    var kd_ta=currentRow.find("#kd_ta").val();
     var catatan=currentRow.find("#catatan").val();
    var form_data = {
        kd_ta: kd_ta,
        nis: nis,
         catatan: catatan,
        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
        ajax: '1'
        };
        $.ajax({
        url: "<?php echo base_url('guru/ajax_save_catatan')?>",
        type: 'POST',
        data: form_data,
        success: function(pesan) {
        alert(pesan);
        }
        });

});
</script>
</html>

        

