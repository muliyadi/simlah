<div class="content" style="padding-top: 5px;padding-bottom:5px">

    <div class="card" style="padding-bottom: 5px;padding-right: 0px;padding-top: 5px">

        <div class="card-content">
            <div class="table-responsive">
                    	  <h4 class="title">Form Password </h4>
					<form action="<?php echo base_url().'xguru/save_password_guru'?>" method="post" enctype="multipart/form-data">
					
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>

					
        			<div class="form-group">
					
					<input name="id_guru" class="form-control"  placeholder="ID GURU" value="<?php echo $guru->id_guru?>"  required autofocus>
					</div>
					<div class="form-group">
					
					<input name="username" class="form-control" placeholder="Nama" value="<?php echo $guru->nm_guru?>" required autofocus>
					</div>
					<div class="form-group">
					
					<input name="password" type="password" class="form-control" placeholder="Password" autofocus>
					</div>
					
					
					<button type="submit" class="btn btn-info btn-xs"><i class="material-icons">save </i> Simpan </button>
					</form>
					</div>
					
                </div>
				
            </div>
			
			

        </div>
    </div>
</div>
