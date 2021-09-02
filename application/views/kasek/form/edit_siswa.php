<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    
                    <div class="card-content ">
                    	  <h4 class="title"> Form Edit Data Siswa</h4>
                        <form action="<?php echo base_url().'kasek/update_siswa'?>" method="post" enctype="multipart/form-data">
								
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>
							<div class="row">
							<div class="form-group form-file-upload form-file-multiple col-md-6">
							<input type="file"  onchange="tampilkanPreview(this,'preview')"  class="inputFileHidden" name="userfile" >
							<div class="input-group">
								<input type="text" class="form-control inputFileVisible" placeholder="Foto Siswa (4x6)">
								<span class="input-group-btn">
									<button type="button" class="btn  btn-sm btn-warning ">
										<i class="material-icons">attach_file</i>
									</button>
								</span>
							</div>
						  </div>
						  <input name="nislama" class="form-control" value="<?php echo $siswa->nis?>" type="hidden"  required autofocus>
						  <div class="form-group col-md-6">
		           			<div >
				            <img id="preview" style="width: 15rem;height:17rem;"  src="<?php echo base_url('foto_siswa').'/'.$siswa->image?>" class="img-responsive img-thumbnail" alt="Preview Image">
				            </div>
				        	</div>
				        	</div>
		        			<div class="row">
							<div class="form-group col-md-6">
								<label for="nisn">NIS</label>
							<input name="nis" class="form-control" value="<?php echo $siswa->nis?>" type="text" readonly="true"  required autofocus>
							</div>
							<div class="form-group col-md-6">
							<label for="nisn">NISN</label>
							<input name="nisn" class="form-control" type="number" value="<?php echo $siswa->nisn?>"  autofocus>
							</div>
							</div>
							<div class="row">
							<div class="form-group col-md-6">
							<label for="tahun">Nama Siswa</label>
							<input name="nm_siswa" class="form-control" value="<?php echo $siswa->nm_siswa?>" type="text" required autofocus>
							</div>
							<div class="form-group col-md-6">
							<label for="group_relawan">Gender</label>
							<?php 
		                   
						   $list=array();
						   
						   foreach($list_kelamin as $value)
						   {
							   $test=$value->jk;
							   $list[$value->id]=$test;
							  
						   }
		                    echo form_dropdown('kelamin',$list,$siswa->jk,"class='form-control '");    
		                    ?>
							</div>
							</div>
							<div class="row">
							<div class="form-group col-md-6">
							<label for="tempat">Tempat Lahir</label>
							<input name="tempat" class="form-control" value="<?php echo $siswa->tempat?>"type="text" required autofocus>
							</div>
							<div class="form-group col-md-6">
							<label for="tgl_lahir">Tanggal Lahir</label>
							<input name="tgl_lahir" class="form-control" value="<?php echo $siswa->tgl_lahir?>" type="date" required autofocus>
							</div>
							</div>
							<div class="row">
							<div class="form-group col-md-6">
							<label for="group_relawan">Agama</label>
							<?php 
		                   
						   $list=array();
						   
						   foreach($list_agama as $value)
						   {
							   $test=$value->agama;
							   $list[$value->agama]=$test;
							  
						   }
		                    echo form_dropdown('agama',$list,$siswa->agama,"class='form-control '");    
		                    ?>
							</div>
							<div class="form-group col-md-6">
							<label for="group_relawan">Negara</label>
							<?php 
		                   
						   $list=array();
						   
						   foreach($list_negara as $value)
						   {
							   $test=$value->nm_negara;
							   $list[$value->nm_negara]=$test;
							  
						   }
		                    echo form_dropdown('kewarganegaraan',$list,$siswa->kewarganegaraan,"class='form-control '");    
		                    ?>
							</div>
							</div>
							<div class="row">
							<div class="form-group col-md-6">
							<label for="alamat">Alamat</label>
							<input name="alamat" class="form-control" value="<?php echo $siswa->alamat?>"type="text" required autofocus>
							</div>
							<div class="form-group col-md-6">
							<label for="no_hp">NO HP</label>
							<input name="no_hp" class="form-control" value="<?php echo $siswa->no_hp?>"type="text" required autofocus>
							</div>
							 </div>
							 <div class="row">
							 <div class="form-group col-md-6">
							<label for="alamat">Status Dalam Keluarga</label>
							
							<?php 
		                   
						   $list=array();
						   
						   foreach($list_status_keluarga as $value)
						   {
							   $test=$value->status;
							   $list[$value->status]=$test;
							  
						   }
		                    echo form_dropdown('status_dalam_keluarga',$list,$siswa->status_dalam_keluarga,"class='form-control '");    
		                    ?>
							</div>
							<div class="form-group col-md-6">
							<label for="alamat">Anak Ke</label>
							<input name="anak_ke" class="form-control" value="<?php echo $siswa->anak_ke?>" type="number" required autofocus>
							</div>
							</div>
							 <div class="row">
							<div class="form-group col-md-6">
							<label for="alamat">Nama Ayah</label>
							<input name="nama_ayah" class="form-control" value="<?php echo $siswa->nama_ayah?>"type="text" required autofocus>
							</div>
							<div class="form-group col-md-6">
							<label for="no_hp">Nama Ibu</label>
							<input name="nama_ibu" class="form-control" value="<?php echo $siswa->nama_ibu?>"type="text" required autofocus>
							</div>
							 </div>
							 <div class="row">
							<div class="form-group col-md-6">
							<label for="alamat">Alamat Orang Tua</label>
							<input name="alamat_ayah" class="form-control" value="<?php echo $siswa->alamat_ayah?>" type="text" required autofocus>
							</div>
							<div class="form-group col-md-6">
							<label for="no_hp">No HP Orang Tua</label>
							<input name="no_hp_ayah" class="form-control" value="<?php echo $siswa->no_hp_ayah?>" type="text" required autofocus>
							</div>
							 </div>
							 <div class="row">
							<div class="form-group col-md-6">
							<label for="alamat">Pekerjaan Ayah</label>
                							<input name="pekerjaan_ayah" class="form-control" value="<?php echo $siswa->pekerjaan_ayah?>"type="text" required autofocus>
							</div>
							<div class="form-group col-md-6">
							<label for="no_hp">Pekerjaan Ibu</label>
							<input name="pekerjaan_ibu" class="form-control" value="<?php echo $siswa->pekerjaan_ibu?>"type="text" required autofocus>
							</div>
							 </div>
							 		 <div class="row">
							<div class="form-group col-md-6">
							<label for="alamat">Nama Wali</label>
							<input name="nama_wali" class="form-control" value="<?php echo $siswa->nama_wali?>" type="text"  autofocus>
							</div>
							<div class="form-group col-md-6">
							<label for="no_hp">Pekerjaan Wali</label>
							<input name="pekerjaan_wali" class="form-control" value="<?php echo $siswa->pekerjaan_wali?>" type="text"  autofocus>
							</div>
							 </div>
							 		 <div class="row">
							<div class="form-group col-md-6">
							<label for="alamat">Alamat Wali</label>
							<input name="alamat_wali" class="form-control" value="<?php echo $siswa->alamat_wali?>" type="text"  autofocus>
							</div>
							<div class="form-group col-md-6">
							<label for="no_hp">No HP Wali</label>
							<input name="no_hp_wali" class="form-control" value="<?php echo $siswa->no_hp_wali?>" type="text"  autofocus>
							</div>
							 </div>
							<div class="form-group ">
							<label for="group_relawan">Kelas</label>
						    <?php 
		                   
						   $list=array();
						   
						   foreach($list_kelas as $value)
						   {
							   $test=$value->id_kelas;
							   $list[$value->id_kelas]=$test;
							  
						   }
		                    echo form_dropdown('kelas',$list,$siswa->kelas,"class='form-control '");    
		                    ?>
							</div>
							
							<div class="form-group ">
							<label for="group_relawan">Status</label>
							<?php 
		                   
						   $list=array();
						   
						   foreach($list_status_siswa as $value)
						   {
							   $test=$value->status;
							   $list[$value->status]=$test;
							  
						   }
		                    echo form_dropdown('status',$list,$siswa->status,"class='form-control '");    
		                    ?>
							</div>
		                   
							
							
							
							<button type="submit" class="btn btn-info btn-sm"><i class="material-icons">save </i> Simpan </button>
							</form>
						
						
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
        var table = $('#tabel_program').DataTable( {
            responsive: true
        } );
     
        new $.fn.dataTable.FixedHeader( table );
    });
</script>
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

</html>

        

