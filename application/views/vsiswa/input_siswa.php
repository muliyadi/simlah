<div class="content" style="padding-top: 5px;padding-bottom:5px">

    <div class="card" style="padding-bottom: 5px;padding-right: 0px;padding-top: 5px">

        <div class="card-content">
            <div class="table-responsive">
                    	<h4 class="title"> Form Edit Data Siswa</h4>
                        <form action="<?php echo base_url().'ktu/save_siswa'?>" method="post" enctype="multipart/form-data">
								
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
						 
						  <div class="form-group col-md-6">
		           			<div >
				            <img id="preview" style="width: 15rem;height:17rem;"  src="" class="img-responsive img-thumbnail" alt="Preview Image">
				            </div>
				        	</div>
				        	</div>
		        			<div class="row">
							<div class="form-group col-md-6">
								<label for="nisn">NIS</label>
							<input name="nis" class="form-control" type="text" required autofocus>
							</div>
							<div class="form-group col-md-6">
							<label for="nisn">NISN</label>
							<input name="nisn" class="form-control" type="number" autofocus>
							</div>
							</div>
							<div class="row">
							<div class="form-group col-md-6">
							<label for="tahun">Nama Siswa</label>
							<input name="nm_siswa" class="form-control"  type="text" required autofocus>
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
		                    echo form_dropdown('kelamin',$list,'',"class='form-control '");    
		                    ?>
							</div>
							</div>
							<div class="row">
							<div class="form-group col-md-6">
							<label for="tempat">Tempat Lahir</label>
							<input name="tempat" class="form-control" type="text" required autofocus>
							</div>
							<div class="form-group col-md-6">
							<label for="tgl_lahir">Tanggal Lahir</label>
							<input name="tgl_lahir" class="form-control" type="date" required autofocus>
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
		                    echo form_dropdown('agama',$list,'',"class='form-control '");    
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
		                    echo form_dropdown('kewarganegaraan',$list,'',"class='form-control '");    
		                    ?>
							</div>
							</div>
							<div class="row">
							<div class="form-group col-md-6">
							<label for="alamat">Alamat</label>
							<input name="alamat" class="form-control" type="text" required autofocus>
							</div>
							<div class="form-group col-md-6">
							<label for="no_hp">NO HP</label>
							<input name="no_hp" class="form-control" type="text" required autofocus>
							</div>
							 </div>
							 <div class="row">
							<div class="form-group col-md-6">
							<label for="alamat">Sekolah Asal (SMP/MTs/Paket B)</label>
							<input name="asal_sekolah" class="form-control"  type="text"   autofocus>
							</div>
							<div class="form-group col-md-6">
							<label for="no_hp">Alamat Sekolah Asal</label>
							<input name="alamat_asal_sekolah" class="form-control" type="text"  autofocus>
							</div>
							 </div>
							 <div class="row">
							<div class="form-group col-md-6">
							<label for="alamat">Tahun Ijazah</label>
							<input name="tahun_ijazah" class="form-control"  type="text"   autofocus>
							</div>
							<div class="form-group col-md-6">
							<label for="no_hp">No Ijazah</label>
							<input name="no_ijazah" class="form-control"  type="text"  autofocus>
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
		                    echo form_dropdown('status_dalam_keluarga',$list,'',"class='form-control '");    
		                    ?>
							</div>
							<div class="form-group col-md-6">
							<label for="alamat">Anak Ke</label>
							<input name="anak_ke" class="form-control"  type="number" required autofocus>
							</div>
							</div>
							 <div class="row">
							<div class="form-group col-md-6">
							<label for="alamat">Nama Ayah</label>
							<input name="nama_ayah" class="form-control" type="text" required autofocus>
							</div>
							<div class="form-group col-md-6">
							<label for="no_hp">Nama Ibu</label>
							<input name="nama_ibu" class="form-control" type="text" required autofocus>
							</div>
							 </div>
							 <div class="row">
							<div class="form-group col-md-6">
							<label for="alamat">Alamat Orang Tua</label>
							<input name="alamat_ayah" class="form-control"  type="text" required autofocus>
							</div>
							<div class="form-group col-md-6">
							<label for="no_hp">No HP Orang Tua</label>
							<input name="no_hp_ayah" class="form-control" type="text" required autofocus>
							</div>
							 </div>
							 <div class="row">
							<div class="form-group col-md-6">
							<label for="alamat">Pekerjaan Ayah</label>
                							<input name="pekerjaan_ayah" class="form-control" type="text" required autofocus>
							</div>
							<div class="form-group col-md-6">
							<label for="no_hp">Pekerjaan Ibu</label>
							<input name="pekerjaan_ibu" class="form-control" type="text" required autofocus>
							</div>
							 </div>
							 		 <div class="row">
							<div class="form-group col-md-6">
							<label for="alamat">Nama Wali</label>
							<input name="nama_wali" class="form-control"  type="text"  autofocus>
							</div>
							<div class="form-group col-md-6">
							<label for="no_hp">Pekerjaan Wali</label>
							<input name="pekerjaan_wali" class="form-control"  type="text"  autofocus>
							</div>
							 </div>
							 		 <div class="row">
							<div class="form-group col-md-6">
							<label for="alamat">Alamat Wali</label>
							<input name="alamat_wali" class="form-control"  type="text"  autofocus>
							</div>
							<div class="form-group col-md-6">
							<label for="no_hp">No HP Wali</label>
							<input name="no_hp_wali" class="form-control" type="text"  autofocus>
							</div>
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
		                    echo form_dropdown('status',$list,'',"class='form-control '");    
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



        

