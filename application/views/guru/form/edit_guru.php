<div class="content">
    <div class="container-fluid">
        <div class="row">
             <div class="col-md-12">
                <div class="card">
                    
                    <div class="card-content table-responsive">
                    	 <h4 class="title">Form Guru </h4>
					<form action="<?php echo base_url().'guru/update_guru'?>" method="post" enctype="multipart/form-data">
					
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>

					<div class="form-group form-file-upload form-file-multiple">
					<input type="file" multiple="" onchange="tampilkanPreview(this,'preview')"  class="inputFileHidden" name="userfile" >
					<div class="input-group">
						<input type="text" class="form-control inputFileVisible" placeholder="Foto">
						<span class="input-group-btn">
							<button type="button" class="btn  btn-sm btn-warning ">
								<i class="material-icons">attach_file</i>
							</button>
						</span>
					</div>
				  </div>
				  <div class="form-group">
           
           
            <div >
            <img id="preview" style="width: 25rem;height:28rem;"  src="<?php echo base_url('foto_guru').'/'.$guru->image;?>" class="img-responsive img-thumbnail" alt="Preview Image">
            </div>
        </div>
        			<div class="form-group">
					<label>ID Guru</label>
					<input name="id_guru" value="<?php echo $guru->id_guru?>" class="form-control" placeholder="ID Guru" required readonly="true">
					</div>
					<div class="form-group">
					<label>NUPTK</label>
					<input name="nuptk" value="<?php echo $guru->nuptk?>" class="form-control" placeholder="NUPTK"  >
					</div>
					<div class="form-group">
					<label>NIK</label>
					<input name="nik" value="<?php echo $guru->nik?>"class="form-control" placeholder="NIK" autofocus>
					</div>
					<div class="form-group">
					<label>NIP</label>
					<input name="nip" value="<?php echo $guru->nip?>"class="form-control" placeholder="NIP"  autofocus>
					</div>
					<div class="form-group">
					<label>Nama</label>
					<input name="nm_guru" value="<?php echo $guru->nm_guru?>" class="form-control" required autofocus placeholder="Nama">
					</div>
					<div class="form-group">
					<label>Gelar Depan</label>
					<input name="gelar_depan" value="<?php echo $guru->gelar_depan?>" class="form-control" placeholder="Gelar Depan"  >
					</div>
					<div class="form-group">
					<label>Gelar Belakang</label>
					<input name="gelar_belakang" value="<?php echo $guru->gelar_belakang?>" class="form-control" placeholder="Gelar Belakang"  >
					</div>
					<div class="form-group">
						<label>Tempat Lahir</label>
					<input name="tempat" value="<?php echo $guru->tempat?>"class="form-control" required autofocus placeholder="Tempat Lahir">
					</div>
					<div class="form-group">
					<label>Tanggal Lahir</label>
					<input name="tgl_lahir" value="<?php echo $guru->tgl_lahir?>"class="form-control" type="text" required autofocus placeholder="Tgl Lahir">
					</div>
					<div class="form-group ">
					 <label >Gender</label>

					  <?php 
                   
				   $list=array();
				   
				   foreach($list_jk as $value)
				   {
					   $test=$value->jk;
					   $list[$value->id]=$test;
					  
				   }
                    echo form_dropdown('jk',$list,$guru->jk,"class='form-control'");    
                    ?>
					</div>
					<div class="form-group">
						<label>Alamat</label>
					<input name="alamat" value="<?php echo $guru->alamat?>"class="form-control" type="text"  autofocus placeholder="Alamat">
					</div>
					<div class="form-group">
						<label>NO HP</label>
					<input name="no_hp" value="<?php echo $guru->no_hp?>"class="form-control" type="text"  autofocus placeholder="No HP">
					</div>
					<div class="form-group">
						<label>Email</label>
					<input name="email" value="<?php echo $guru->email?>"class="form-control" type="text"  autofocus placeholder="Email">
					</div>
					<div class="form-group">
						<label>Pendidikan Terakhir</label>
					<input name="pendidikan" value="<?php echo $guru->pendidikan?>"class="form-control" type="text"  autofocus placeholder="Pendidikan Terakhir">
					</div>
					
					<div class="form-group">
						<label>Pangkat</label>
					<input name="pangkat" value="<?php echo $guru->pangkat?>"class="form-control" type="text"  autofocus placeholder="Pangkat">
					</div>
					<div class="form-group">
						<label>Golongan</label>
					<input name="golongan" value="<?php echo $guru->golongan?>"class="form-control" type="text"  autofocus placeholder="Golongan">
					</div>
					<div class="form-group">
						<label>Bidang Pengajaran</label>
					<input name="bidang" value="<?php echo $guru->bidang?>"class="form-control" type="text"  autofocus placeholder="Bidang Pengajaran">
					</div>
					<div class="form-group ">
					 <label >Status</label>

					  <?php 
                   
				   $list=array();
				   
				   foreach($list_status as $value)
				   {
					   $test=$value->status;
					   $list[$value->status]=$test;
					  
				   }
                    echo form_dropdown('status',$list,$guru->status,"class='form-control'");    
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