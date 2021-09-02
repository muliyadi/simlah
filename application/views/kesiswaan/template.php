
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>logo_sekolah/40403039.png" />
        <link rel="icon" type="image/png" href="<?php echo base_url(); ?>logo_sekolah/40403039.png" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>SIAKAD</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <!-- Bootstrap core CSS     -->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
        <!--  Material Dashboard CSS    -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="<?php echo base_url(); ?>assets/css/demo.css" rel="stylesheet" />
        <!--     Fonts and icons     -->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
responsive.bootstrap.min.css">
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/material-icon.css" rel="stylesheet" type="text/css">
        
    </head>

    <body>
        <div class="wrapper">
            <div class="sidebar" data-color="green" data-image="<?php echo base_url(); ?>assets/img/sidebar-1.jpg">
               <div class="logo text-center">
                    <h4><a href="<?php echo base_url()?>" class="">
                      <img src="<?php echo base_url()?>assets/img/logo.png" height="90px" >
                    </a></h4>
					<?php echo $this->session->userdata('nm_user');?><br>
					Tahun Ajaran <?php echo $this->session->userdata('kd_ta');?>
                </div>
                <div class="sidebar-wrapper">
                    <ul class="nav">
                        <li class="">
                            <?php //echo anchor('welcome','<i class="material-icons"> Dashboard');?>
                            <a href="<?php echo base_url('kesiswaan') ?>">
                                <i class="material-icons">dashboard</i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() . 'kesiswaan/prestasi_siswa' ?>">
                                <i class="material-icons">person</i>
                                <p>Prestasi Siswa</p>
                            </a>
                        </li>
                        
                        <li class="default">
                        <a data-toggle="collapse" href="#data">
                            <i class="material-icons">book</i>
                            <p>Data <b class="caret"></b></p>
                        </a>
                        <div class="collapse" id="data">
                            <ul class="nav">
                             <li><a href="<?php echo base_url() . 'kesiswaan/siswa' ?>"><i class="material-icons">person</i><p>Siswa</p></a></li>
                        
                        
                       
                        
                        
                            </ul>
                        </div>
                        </li>
						
                        
                       
						
						
                       
						
						<li><hr></li>
                        <?php if($this->session->userdata('logged_in'))
						{
							$base='login/logout';
							$label='Logout';
							$icon='star';
						}else
						{
							$base='login/logout';
							$label='Login';
							$icon='login';
						}?>
						
                        <li class="active-pro">
                            <a href="<?php echo base_url($base)?>">
                                <i class="material-icons"><?php echo $icon?></i>
                                <p><?php echo $label?></p>
                            </a>
                        </li>
						
						
                    </ul>
                </div>
            </div>
            <div class="main-panel">
                <nav class="navbar navbar-transparent navbar-absolute">
                    <div class="container-fluid transparent">
					<div class="card">
						<div class="card-content">
						<img src="<?php echo base_url()?>assets/img/logo.png" style="width: 6rem;height:6rem;"  ><?php echo $menu;?>
						<button type="button" class="navbar-toggle" data-toggle="collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
						</div>
						</div>
                    </div>
                </nav>
				<br>
				<br>
                <?php echo $contents; ?>
            </div>
			</div>
            
            
            <script type="text/javascript">
<?php if ($this->session->flashdata('cek_type') != null){?>
		$.notify({
      message: "<?php echo $this->session->flashdata('cek_pesan')?>"
    },{
      type: "<?php echo $this->session->flashdata('cek_type')?>",
      timer: 200,
			placement: {
				from: "top",
				align: "right"
			}
     });
		<?php }?>
    
	
</script>