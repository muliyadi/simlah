<div class="content">
    <div class="container-fluid">
        <div class="row">
             <div class="col-md-12">
                <div class="card">
                    
                    <div class="card-content table-responsive">
                    	  <h4 class="title">Form Profil Sekolah </h4>
					<form action="<?php echo base_url().'wakasekkurikulum/update_sekolah'?>" method="post" enctype="multipart/form-data">
					
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>

					<div class="form-group form-file-upload form-file-multiple">
					<input type="file" multiple="" onchange="tampilkanPreview(this,'preview')"  class="inputFileHidden" name="userfile" >
					<div class="input-group">
						<input type="text" class="form-control inputFileVisible" placeholder="Logo Sekolah">
						<span class="input-group-btn">
							<button type="button" class="btn  btn-sm btn-warning ">
								<i class="material-icons">attach_file</i>
							</button>
						</span>
					</div>
				  </div>
				  <div class="form-group">
                     <div>
                    <img id="preview" style="width: 25rem;height:28rem;"  src="<?php echo base_url('logo_sekolah').'/'.$sekolah->image;?>" class="img-responsive img-thumbnail" alt="Preview Image">
                    </div>
                </div>
        			<div class="form-group">
					<label>NPSN (Nomor Pokok Sekolah Nasional</label>
					<input name="npsn" value="<?php echo $sekolah->npsn?>" class="form-control" placeholder="NPSN" required readonly="true">
					</div>
					<div class="form-group">
					<label>Nama Sekolah (Kapital)</label>
					<input name="nm_sekolah" value="<?php echo $sekolah->nm_sekolah?>" class="form-control" placeholder="Nama Sekolah"  >
					</div>
					<div class="form-group">
					<label>Nama Sekolah (Kecil/Lower Case)</label>
					<input name="nm_sekolah_kecil" value="<?php echo $sekolah->nm_sekolah_kecil?>"class="form-control" placeholder="Nama Sekolah Non Kapital" autofocus>
					</div>
					
					<div class="form-group">
					<label>Nama Kepala Sekolah</label>
					<input name="kasek" value="<?php echo $sekolah->kasek?>" class="form-control" required autofocus placeholder="Nama Kepala Sekolah">
					</div>
					<div class="form-group">
					<label>NIP Kepala Sekolah</label>
					<input name="nip_kasek" value="<?php echo $sekolah->nip_kasek?>"class="form-control" placeholder="NIP Kepala Sekolah"  autofocus>
					</div>
					<div class="form-group">
					<label>Provinsi</label>
					<input name="provinsi" value="<?php echo $sekolah->provinsi?>" class="form-control" placeholder="Provinsi"  >
					</div>
					<div class="form-group">
					<label>Kabupaten/Kota</label>
					<input name="kabupaten" value="<?php echo $sekolah->kabupaten?>" class="form-control" placeholder="Kabupaten/Kota"  >
					</div>
					<div class="form-group">
					<label>Kecamatan</label>
					<input name="kecamatan" value="<?php echo $sekolah->kecamatan?>"class="form-control" required autofocus placeholder="Kecamatan">
					</div>
					<div class="form-group">
					<label>Kelurahan/Desa</label>
					<input name="kelurahan" value="<?php echo $sekolah->kelurahan?>"class="form-control" type="text" required autofocus placeholder="Kelurahan">
					</div>
					<div class="form-group">
						<label>Jalan</label>
					<input name="alamat" value="<?php echo $sekolah->alamat?>"class="form-control" type="text"  autofocus placeholder="Alamat Jalan">
					</div>
					<div class="form-group">
					<label>No Telepon Kantor</label>
					<input name="tlp" value="<?php echo $sekolah->tlp?>"class="form-control" type="text"  autofocus placeholder="No Telepon">
					</div>
					<div class="form-group">
						<label>Email</label>
					<input name="email" value="<?php echo $sekolah->email?>"class="form-control" type="text"  autofocus placeholder="Email">
					</div>
						<div class="form-group">
						<label>Website</label>
					<input name="website" value="<?php echo $sekolah->website?>"class="form-control" type="text"  autofocus placeholder="Website">
					</div>
					<div class="form-group">
						<label>Kode Pos</label>
					<input name="kode_pos" value="<?php echo $sekolah->kode_pos?>"class="form-control" type="text"  autofocus placeholder="Kode Pos">
					</div>
					<div class="form-group ">
					 <label >Akreditasi</label>

					  <?php 
                   
				   $list=array();
				   
				   foreach($list_akreditasi as $value)
				   {
					   $test=$value->akreditasi;
					   $list[$value->akreditasi]=$test;
					  
				   }
                    echo form_dropdown('akreditasi',$list,$sekolah->akreditasi,"class='form-control'");    
                    ?>
					</div>
					
					<div class="form-group ">
					 <label >Status</label>

					  <?php 
                   
				   $list=array();
				   
				   foreach($list_status as $value)
				   {
					   $test=$value->status;
					   $list[$value->id]=$test;
					  
				   }
                    echo form_dropdown('status',$list,$sekolah->status,"class='form-control'");    
                    ?>
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