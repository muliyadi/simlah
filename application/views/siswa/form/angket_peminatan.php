<div class="content">
    <div class="container-fluid">
        <div class="row">
             <div class="col-md-12">
                <div class="card">
                    
                    <div class="card-content table-responsive">
                       <h4 class="title">Form Angket Peminatan </h4>
					<form action="<?php echo base_url().'siswa/save_angket'?>" method="post" enctype="multipart/form-data">
					
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>
					<div class="form-group" >
                    <label >1. Alasan Memilih SMA Negeri 1 Mawasangka Tengah (Boleh memilih lebih dari satu)</label>
                    <br>
           				<input type="checkbox" name="alasan[]" value="Memperoleh pendidikan yang lebih tinggi">  Memperoleh pendidikan yang lebih tinggi<br>
           				<input type="checkbox" name="alasan[]" value="Persiapan memasuki  perguruan tinggi">Persiapan memasuki  perguruan tinggi<br>
           				

					</div>
					<div class="form-group ">
					 <label >2. Pilihan Peminatan</label>
					  <?php 
					   $list=array();
					   foreach($list_minat as $value)
					   {
						   $test=$value->program;
						   $list[$value->program]=$test;
					   }
                    echo form_dropdown('minat',$list,'',"class='form-control xminat' id='xminat'");    
                    ?>
					</div>
					<div class="form-group" >
                    <label >3. Pilih Mata Pelajaran Utama (Maksimal 3 Mata Pelajaran)</label>
                   		<div id="test">
                   		</div>
					</div>
					<div class="form-group" >
                    <label >4. Mata Pelajaran Pilihan Peminatan (Maksimal 2 Mata Pelajaran)</label>
                   		<div id="test2">
                   		</div>
					</div>
					<div class="form-group" >
                    <label >5. Harapan Keluarga setelah lulus sekolah</label>
                    	<input type="radio" name="harapan" value="kuliah">Kuliah<br>
                    	<input type="radio" name="harapan" value="bekerjla">Bekerja<br>
						<input type="radio" name="harapan" value="lainnya">Lainnya<br>
                    	                    	
					</div>

					<button type="submit" class="btn btn-warning btn-md"><i class="material-icons">save </i> Simpan </button>
					</form>
					</div>
					
                </div>
				
            </div>
			
			

        </div>
    </div>
</div>
</body>
<script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/material.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/chartist.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/arrive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/perfect-scrollbar.jquery.min.js"></script>
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
<script src="<?php echo base_url(); ?>assets/dropdown/js/multiple-select.min.js" type="text/javascript"></script>

    <script type="text/javascript">
function tampilkanPreview(userfile,idpreview)
{
  var gb = userfile.files;
  for (var i = 0; i < gb.length; i++)
  {
    var gbPreview = gb[i];
    var imageType = /image.*/;
    var preview=document.getElementById(idpreview);
    var reader = new FileReader();
    if (gbPreview.type.match(imageType))
    {
      //jika tipe data sesuai
      preview.file = gbPreview;
      reader.onload = (function(element)
      {
        return function(e)
        {
          element.src = e.target.result;
        };
      })(preview);
      //membaca data URL gambar
      reader.readAsDataURL(gbPreview);
    }
      else
      {
        //jika tipe data tidak sesuai
        alert("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
      }
  }
}
</script>



<script type="text/javascript">
$(document).ready(function(){
	
$("#xminat").change(function () {
   var kode = $('.xminat').val();
    var form_data = {
		kode: kode,
        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
       	ajax: '1'
        };
  		$.ajax({
          	url: "<?php echo base_url().'siswa/cari_wajib'?>",
            type: 'POST',
			dataType : 'json',
			cache:false,
            data: form_data,
            success: function(pesan) {
            var html = '';
			var i;
			for(i=0; i<pesan.length; i++){
			
				html+='<input type="checkbox" name="minat[]" value='+pesan[i].kd_pelajaran+'>'+' '+pesan[i].nm_pelajaran+'('+pesan[i].kategori+' '+pesan[i].subkategori+')<br>';
			}
			$('#test').html(html);
			
            }
         });
  });
});  
</script>
<script type="text/javascript">
$(document).ready(function(){
	
$("#xminat").click(function () {
   var kode = $('.xminat').val();
    var form_data = {
		kode: kode,
        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
       	ajax: '1'
        };
  		$.ajax({
          	url: "<?php echo base_url().'siswa/cari_minat'?>",
            type: 'POST',
			dataType : 'json',
			cache:false,
            data: form_data,
            success: function(pesan) {
            var html = '';
			var i;
			for(i=0; i<pesan.length; i++){
			
				html+='<input type="checkbox" name="minat[]" value='+pesan[i].kd_pelajaran+'>'+' '+pesan[i].nm_pelajaran+'('+pesan[i].kategori+' '+pesan[i].subkategori+')<br>';
			}
			
			$('#test2').html(html);
            }
         });
  });
});  
</script>