
<div class="content">
    <div class="container-fluid">
        <div class="row">
             <div class="col-md-12">
                <div class="card">

                    <div class="card-content table-responsive">
				
                        <h4 class="title">Form Input Catatan Wali Kelas </h4>
					
				

					<table class="table tabel" id="tabel">
					    <thead class="text-primary">
					        <tr>
					            <th width="5%">NIS</th>
					            <th>Nama Siswa</th>
					            <th>Kelas</th>
					            <th  width="50%">Catatan</th>
					            <th>Aksi</th>
					        </tr>
					        
					        </thead>
					        <?php
					        foreach($list_catatan as $row)
					        {
					            ?>
					            <tr>
					                <td><input type="text" value="<?php echo $row->nis?>" class="nis" style="width:50px;" readonly="true"></td>
					                <td><?php echo $row->nm_siswa?></td>
					                <td><?php echo $row->kelas?></td>
					                <td><input type="text" class="catatan" value="<?php echo $row->catatan?>" style="width:350px;" maxlength="120"></td>
					                <td><button class="btn btn-sm btn-success  update">Simpan</button></td>
					            </tr>
					            
					        <?php
					            
					        }
					        
					        ?>
					        
					        
					        
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
   


<script type="text/javascript">
$("#tabel").on('click', '.update', function(e) {
var currentRow = $(this).closest("tr");
    var nis = currentRow.find(".nis").val();
    var catatan=currentRow.find(".catatan").val();
    var form_data = {
        catatan: catatan,
        nis: nis,
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