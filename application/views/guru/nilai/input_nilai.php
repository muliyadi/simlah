<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                   
                    <div class="card-content table-responsive">
                         <h4 class="title">Input Nilai Siswa <br><b>Mata Pelajaran <?php echo $pelajaran->nm_pelajaran?> Kelas: <?php echo $kelas?> </b></h4>
                          <a href="<?php echo base_url().'/guru/tutup_nilai/'.$kd_jadwal?>" class="btn btn-md btn-info" >Selesai</a>
                        <table class="table table-responsive table-striped table-bordered " id="tabel" >
                            <thead class="text-primary">
                                <tr>
                                 <th width="4%" rowspan="2">No</th>
                                <th width="4%" rowspan="2">NIS</th>
                                 <th rowspan="2">Nama Siswa</th>
                                 <th rowspan="2" width="10%">Kelas</th>
                                <th colspan="2" >Sikap</th>
                              
                                <th  colspan="2"> Pengetahuan</th>
                               
                                
                                <th colspan="2"> Keterampilan</th>
                              
                                <th rowspan="2">Aksi</th>
                                </tr>
                                <tr>
                                    <th width="5%" >Spritual</th>
                                    <th width="5%" >Sosial</th>
                                    <th width="5%" >N. Peng.</th>
                                    <th>Deskripsi</th>
                                    <th width="5%" >N. Ket.</th>
                                    <th width="5%">Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $no=1;
                            foreach($list_nilai as $row)
                            {
                              
                                                
                                    
                                ?>
                                <tr>
                                    <td><?php echo $no++?></td>
                                    <td><input type="hidden" name="kd_jadwal" id="kd_jadwal" value="<?php echo $kd_jadwal?>"><input type="text" name="nis" style="width:50px;" readonly="true" id="nis" value="<?php echo $row->nis?>" class="form-control"></td>
                                    <td><input type="text" name="nm_siswa"  readonly="true" id="nm_siswa" value="<?php echo $row->nm_siswa?>" class="form-control"></td>
                                    <td><input type="text" name="kelas" style="width:80px;"  readonly="true" id="kelas" value="<?php echo $row->kelas?>" class="form-control"></td>
                                    <td>
                                        <?php 
                                       $list2=array();
                                       foreach($mnilai as $valuex)
                                       {
                                           $test=$valuex->nilai;
                                           $list2[$valuex->angka]=$test;
                                       }
                                        echo form_dropdown('nspritual',$list2,$row->nilai_spritual,"class='form-control nspritual'");    
                                        ?>
                                        
                                    </td>
                                    <td>
                                        <?php 
                                       $list=array();
                                       foreach($mnilai as $value)
                                       {
                                           $test=$value->nilai;
                                           $list[$value->angka]=$test;
                                       }
                                        echo form_dropdown('nsosial',$list,$row->nilai_sosial,"class='form-control nsosial'");    
                                        ?>
                                    </td>
                                    <td><input type="number" style="width:50px;" value="<?php echo $row->nilai_pengetahuan ?>"   id="npengetahuan" class="form-control"></td>
                                    <td><input type="text" value="<?php echo $row->desc_nilai_pengetahuan ?>" id="dpengetahuan" minlength="1" maxlength="120"  style="width:300px;" class="form-control"></td>
                                    <td><input type="number" id="nketerampilan" value="<?php echo $row->nilai_keterampilan ?>" style="width:50px;"  class="form-control"></td>
                                    <td><input type="text" maxlength="100" value="<?php echo $row->desc_nilai_keterampilan ?>" minlength="1" maxlength="120" id="dketerampilan" style="width:300px;" class="form-control"></td>
                                    <td><button class="btn btn-sm btn-success  update">Simpan</button>
                                    <button class="btn btn-sm btn-danger  delete"  onclick="return confirm('Yakin baris ini akan dihapus?')">Hapus Baris</button>
                                    </td>
                                </tr>
                                
                            <?php
                            

                                }
                            
                            ?>
                            </tbody>
                        </table>
                        <a href="<?php echo base_url().'/guru/tutup_nilai/'.$kd_jadwal?>" class="btn btn-sm btn-info" >Selesai</a>
                        
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
    var nspritual = currentRow.find(".nspritual").val();
    var nsosial = currentRow.find(".nsosial").val();
    var npengetahuan = currentRow.find("#npengetahuan").val();
    var dpengetahuan = currentRow.find("#dpengetahuan").val();
    var nketerampilan = currentRow.find("#nketerampilan").val();
    var dketerampilan = currentRow.find("#dketerampilan").val();
    var kd_jadwal=currentRow.find("#kd_jadwal").val();
    var form_data = {
        nsosial: nsosial,
        nspritual: nspritual,
        npengetahuan: npengetahuan, 
        dpengetahuan: dpengetahuan,
        nketerampilan: nketerampilan, 
        dketerampilan: dketerampilan,
        kd_jadwal: kd_jadwal,
        nis: nis,
        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
        ajax: '1'
        };
        $.ajax({
        url: "<?php echo base_url('guru/ajax_save_nilai')?>",
        type: 'POST',
        data: form_data,
        success: function(pesan) {
        alert(pesan);
        }
        });

});
</script>
<script type="text/javascript">
$("#tabel").on('click', '.delete', function(e) {
var currentRow = $(this).closest("tr");
    var nis = currentRow.find("#nis").val();
    var kd_jadwal=currentRow.find("#kd_jadwal").val();
    var form_data = {
        kd_jadwal: kd_jadwal,
        nis: nis,
        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
        ajax: '1'
        };
        $.ajax({
        url: "<?php echo base_url('guru/x_baris_nilai')?>",
        type: 'POST',
        data: form_data,
        success: function(pesan) {
        alert(pesan);
        }
        });

});
</script>
</html>

        

