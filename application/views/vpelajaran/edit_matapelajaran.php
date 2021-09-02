<div class="content" style="padding-top: 5px;padding-bottom:5px">

    <div class="card" style="padding-bottom: 5px;padding-right: 0px;padding-top: 5px">

        <div class="card-content">
            <div class="table-responsive">
                    	   <h4 class="title">Form Mata Pelajaran </h4>
					<form action="<?php echo base_url().'xpelajaran/update_mata_pelajaran'?>" method="post" enctype="multipart/form-data">
					
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>

					
					
					<div class="form-group">
					<label for="kd_pelajaran">Kode Mata Pelajaran</label>
					<input name="kd_pelajaran" value="<?php echo $pelajaran->kd_pelajaran?>" class="form-control" readonly>
					</div>
					<div class="form-group">
					<label for="nm_relawan">Nama Mata Pelajaran </label>
					<input name="nm_pelajaran" value="<?php echo $pelajaran->nm_pelajaran?>" class="form-control" autofocus required />
					</div>
					<div class="form-group">
					<label for="program">Kelompok Mata Pelajaran</label>
					<?php 
                   
				   $list=array();
				   
				   foreach($list_kategori as $value)
				   {
					   $test=$value->group_kategori.'-'.$value->kategori;
					   $list[$value->kategori]=$test;
					  
				   }
                    echo form_dropdown('subkategori',$list,$pelajaran->subkategori,"class='form-control'");    
                    ?>
					</div>
                    
					
					
					<div class="form-group form-file-upload form-file-multiple"></div>
					<button type="submit" class="btn btn-info btn-xs"><i class="material-icons">save </i> Simpan </button>
					</form>
					</div>
					
                </div>
				
            </div>
			
			

        </div>
    </div>
</div>