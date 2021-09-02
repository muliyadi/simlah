<div class="content" style="padding-top: 5px;padding-bottom:5px">

    <div class="card" style="padding-bottom: 5px;padding-right: 0px;padding-top: 5px">

        <div class="card-content">
            <div class="table-responsive">
                    	 <h4 class="title">Form Guru </h4>
					<form action="<?php echo base_url().'xguru/save_guru'?>" method="post" enctype="multipart/form-data">
					
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
            <img id="preview" style="width: 25rem;height:30rem;"  src="" class="img-responsive img-thumbnail" alt="Preview Image">
            </div>
        </div>
        			<div class="form-group">
					
					<input name="id_guru" class="form-control" placeholder="ID GURU" value="<?php echo $id_guru?>" readonly="true" required >
					</div>
					<div class="form-group">
					
					<input name="nuptk" class="form-control" placeholder="NUPTK" required autofocus>
					</div>
					<div class="form-group">
					
					<input name="nik" class="form-control" placeholder="NIK" autofocus>
					</div>
					<div class="form-group">
					
					<input name="nip" class="form-control" placeholder="NIP"  autofocus>
					</div>
					<div class="form-group">
					
					<input name="nm_guru" class="form-control" required autofocus placeholder="Nama">
					</div>
					<div class="form-group">
					<label>Gelar Depan</label>
					<input name="gelar_depan"  class="form-control" placeholder="Gelar Depan"  >
					</div>
					<div class="form-group">
					<label>Gelar Belakang</label>
					<input name="gelar_belakang"  class="form-control" placeholder="Gelar Belakang"  >
					</div>
					<div class="form-group">
					<input name="tempat" class="form-control" required autofocus placeholder="Tempat Lahir">
					</div>
					<div class="form-group">
					
					<input name="tgl_lahir" class="form-control" type="text" required autofocus placeholder="Tgl Lahir">
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
                    echo form_dropdown('jk',$list,'',"class='form-control'");    
                    ?>
					</div>
					<div class="form-group">
					<input name="alamat" class="form-control" type="text"  autofocus placeholder="Alamat">
					</div>
					<div class="form-group">
					<input name="no_hp" class="form-control" type="text"  autofocus placeholder="No HP">
					</div>
					<div class="form-group">
					<input name="email" class="form-control" type="text"  autofocus placeholder="Email">
					</div>
					<div class="form-group">
					<input name="pendidikan" class="form-control" type="text"  autofocus placeholder="Pendidikan Terakhir">
					</div>
					
					<div class="form-group">
					<input name="pangkat" class="form-control" type="text"  autofocus placeholder="Pangkat">
					</div>
					<div class="form-group">
					<input name="golongan" class="form-control" type="text"  autofocus placeholder="Golongan">
					</div>
					<div class="form-group">
					<input name="bidang" class="form-control" type="text"  autofocus placeholder="Bidang Pengajaran">
					</div>
					<div class="form-group ">
					 <label >Status</label>

					  <?php 
                   
				   $list=array('','');
				   
				   foreach($list_status as $value)
				   {
					   $test=$value->status;
					   $list[$value->status]=$test;
					  
				   }
                    echo form_dropdown('status',$list,'',"class='form-control'");    
                    ?>
					</div>
					
					<button type="submit" class="btn btn-info btn-xs"><i class="material-icons">save </i> Simpan </button>
					</form>
					</div>
					
                </div>
				
            </div>
			
			

        </div>
    </div>
</div>

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
