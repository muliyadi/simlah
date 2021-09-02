<div class="content" style="padding-top: 5px;padding-bottom:5px">

    <div class="card" style="padding-bottom: 5px;padding-right: 0px;padding-top: 5px">

        <div class="card-content">
            <div class="table-responsive">
                    	 <h4 class="title">Pilih Tingkat</h4>
					<form action="<?php echo base_url().'xkurikulum/save_pilihan_kurikulum'?>" method="post" enctype="multipart/form-data">
					
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>
					<input type="hidden" name="kd_kurikulum" value="<?php echo $kd_kurikulum?>">
					<div class="form-group ">
					 <label >Tingkat</label>

					  <?php 
                   
				   $list=array();
				   
				   foreach($list_tingkat as $value)
				   {
					   $test=$value->tingkat;
					   $list[$value->tingkat]=$test;
					  
				   }
                    echo form_dropdown('tingkat',$list,'',"class='form-control dropdown'");    
                    ?>
					</div>
					
						<div class="form-group ">
					 <label >Semester</label>

					  <?php 
                   
				   $list=array();
				   
				   foreach($list_semester as $value)
				   {
					   $test=$value->semester;
					   $list[$value->semester]=$test;
					  
				   }
                    echo form_dropdown('semester',$list,'',"class='form-control dropdown'");    
                    ?>
					</div>
					

					
						<button type="submit" class="btn btn-info btn-xs"><i class="material-icons">save </i> Lanjut </button>
					</form>
					</div>
					
                </div>
				
            </div>
			
			

        </div>
    </div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    <script type="text/javascript">
 $(document).ready(function() {
     $('.dropdown').select2();
 });
</script>
