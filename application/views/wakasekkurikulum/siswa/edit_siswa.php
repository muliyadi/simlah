<div class="content">
    <div class="container-fluid">
        <div class="row">
        	 <div class="col-md-12">
              <div class="card">
                <div class="card-header ">
                  <h4 class="card-title">Form Siswa
                    <small class="description"></small>
                  </h4>
                </div>
                <div class="card-body ">
                	<div class="card-content">
                  <ul class="nav nav-pills nav-pills-warning" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active btn" data-toggle="tab" href="#link1" role="tablist">
                        Biodata
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link btn" data-toggle="tab" href="#link2" role="tablist">
                        Sekolah
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link btn" data-toggle="tab" href="#link3" role="tablist">
                        Keluarga
                      </a>
                    </li>
                  </ul>
                  </div>
                  <div class="tab-content tab-space">
                    <div class="tab-pane active" id="link1">
		                    	<div class="card-content">
		                    	
		                      <form action="<?php echo base_url().'wakasekkurikulum/update_siswa'?>" method="post" enctype="multipart/form-data">
								<input name="nislama" class="form-control" value="<?php echo $siswa->nis?>" type="hidden"  required autofocus>
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>
							<div class="row">
							<div class="form-group form-file-upload form-file-multiple col-md-6">
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
						  <div class="form-group col-md-6">
		           			<div >
				            <img id="preview" style="width: 15rem;height:17rem;"  src="<?php echo base_url('foto_siswa').'/'.$siswa->image?>" class="img-responsive img-thumbnail" alt="Preview Image">
				            </div>
				        	</div>
				        	</div>
		        			<div class="row">
							<div class="form-group col-md-6">
								<label for="nisn">NIS</label>
							<input name="nis" class="form-control" value="<?php echo $siswa->nis?>" type="text"  required autofocus>
							</div>
							<div class="form-group col-md-6">
							<label for="nisn">NISN</label>
							<input name="nisn" class="form-control" type="number" value="<?php echo $siswa->nisn?>" required autofocus>
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
		                   
							
							
							
							<button type="submit" class="btn btn-warning btn-md"><i class="material-icons">save </i> Simpan </button>
							</form>
		                    </div>
		                    </div>
                    <div class="tab-pane" id="link2">
                      <div class="card-content">
                      Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas.
                      <br />
                      <br />Dramatically maintain clicks-and-mortar solutions without functional solutions.
                      </div>
                    </div>
                    <div class="tab-pane" id="link3">
                    	<div class="card-content">
                      Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas.
                      <br />
                      <br />Dynamically innovate resource-leveling customer service for state of the art customer service.
                      </div>
                    </div>
                  </div>
                </div>
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