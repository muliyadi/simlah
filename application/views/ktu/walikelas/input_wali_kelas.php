<div class="content">
    <div class="container-fluid">
        <div class="row">
             <div class="col-md-12">
                <div class="card">
                   
                    <div class="card-content table-responsive">
                    	 <h4 class="title">Form Input Data Wali Kelas </h4>
                  <form action="<?php echo base_url().'ktu/save_wali_kelas'?>" method="post" enctype="multipart/form-data">
							
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>
			                <div class="form-group ">
					 <label >Tahun Ajaran</label>

					  <?php 
                   
				   $list=array();
				   
				   foreach($list_ta as $value)
				   {
					   $test=$value->kd_ta;
					   $list[$value->kd_ta]=$test;
					  
				   }
                    echo form_dropdown('kd_ta',$list,$kd_ta,"class='form-control kd_ta'");    
                    ?>
					</div>
	
							<div class="form-group ">
								<label for="nm_kasek">Kelas</label>
							 <?php 
                   
				   $list=array();
				   
				   foreach($list_kelas as $value)
				   {
					   $test=$value->id_kelas;
					   $list[$value->id_kelas]=$test;
					  
				   }
                    echo form_dropdown('kelas',$list,$kelas,"class='form-control kd_ta'");    
                    ?>
					</div>
	
							<div class="form-group ">
							<label for="nip_kasek">Guru Wali Kelas</label>
							 <?php 
                   
				   $list=array();
				   
				   foreach($list_guru as $value)
				   {
					   $test=$value->nm_guru.'-'.$value->nip;
					   $list[$value->id_guru]=$test;
					  
				   }
                    echo form_dropdown('id_guru',$list,$id_guru,"class='form-control kd_ta'");    
                    ?>
					</div>
					<button type="submit" class="btn btn-info btn-sm"><i class="material-icons">save </i> Simpan </button>
							</div>
				
							
		                    
							
							
							
							
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