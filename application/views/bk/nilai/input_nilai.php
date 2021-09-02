<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-content table-responsive">
                         <h4 class="title">Input Nilai Ekstra Kurikuler  <b><?php echo $kd_ekstra?>  <?php echo $kelas ?></b>  <br>Tahun Ajaran <?php echo $kd_ta?></h4>
                        <table class="table table-responsive table-striped table-bordered " id="tabel" >
                            <thead class="text-primary">
                                <tr>
                                   
                                <th width="4%" >NIS</th>
                                 <th >Nama Siswa</th>
                                 <th >Kelas</th>
                                <th >Nilai</th>
                              
                                <th  >Desckripsi</th>
                               
                                
                             
                              
                                <th >Aksi</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                            <?php 
                            $no=1;
                            foreach($list_nilai as $row)
                            {
                              
                                                
                                    
                                ?>
                                <tr>
                                    
                                    <td><input type="hidden" id="kd_ta" class="kd_ta" value="<?php echo $row->kd_ta?>">
                                        <input type="hidden" id="kd_ekstra" class="kd_ekstra" value="<?php echo $row->kd_ekstra?>">
                                       
                                        <input type="text" name="nis" style="width:60px;" readonly="true" id="nis" value="<?php echo $row->nis?>" class="nis"></td>
                                    <td><input value="<?php echo $row->nm_siswa?>" style="width:200px;"></td>
                                    <td><input type="text" name="kelas" style="width:80px;"  readonly="true" id="kelas" value="<?php echo $row->kelas?>" class="kelas"></td>
                                    <td>
                                        <?php 
                                       $list2=array();
                                       foreach($mnilai as $valuex)
                                       {
                                           $test=$valuex->nilai;
                                           $list2[$valuex->angka]=$test;
                                       }
                                        echo form_dropdown('nilai',$list2,$row->nilai,"class='nilai'");    
                                        ?>
                                        
                                    </td>
                                    
                                    <td><input type="text" value="<?php echo $row->deskripsi ?>" minlength="1" maxlength="120" id="deskripsi" name="deskripsi" style="width:350px;" class="deskripsi"></td>
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
    var nis = currentRow.find(".nis").val();
     var kelas = currentRow.find(".kelas").val();
    var kd_ta=currentRow.find(".kd_ta").val();
    var kd_ekstra=currentRow.find(".kd_ekstra").val();
    var deskripsi=currentRow.find(".deskripsi").val();
    var nilai = currentRow.find(".nilai").val();
       var form_data = {
        kd_ekstra: kd_ekstra,kd_ta:kd_ta,nis:nis,nilai:nilai,deskripsi:deskripsi,kelas:kelas,<?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',ajax: '1'
        };
        
    $.ajax({
        url: "<?php echo base_url('bk/ajax_update_nilai_ekstra')?>",
        type: 'POST',
        data: form_data,
        success: function(pesan) {
        alert(pesan);
        }
        });

});
</script>

</html>

        

