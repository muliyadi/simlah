
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/img/apple-icon.png" />
        <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/img/favicon.png" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>SIMLAH SMA N1 MAWASANGKA</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <!-- Bootstrap core CSS     -->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
        <!--  Material Dashboard CSS    -->
        <link href="<?php echo base_url(); ?>assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="<?php echo base_url(); ?>assets/css/demo.css" rel="stylesheet" />
        <!--     Fonts and icons     -->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/material-icon.css" rel="stylesheet" type="text/css">
         <link href="<?php echo base_url(); ?>assets/dropdown/css/multiple-select.min.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div class="wrapper">
            <div class="sidebar" data-color="green" data-image="<?php echo base_url(); ?>assets/img/sidebar-1.jpg">
                <?php $a=$this->session->userdata('img');?>
               <div class="logo text-center">
                    <h4><a href="<?php echo base_url()?>" class="">
                      <img src="<?php echo base_url('foto_siswa').'/'.$a?>" width="80px" >
                    </a></h4>
					<?php echo $this->session->userdata('nm_user');?>
					<br>
					<?php echo $this->session->userdata('userid');?>
					
                </div>
				
                <div class="sidebar-wrapper">
                    <ul class="nav">
                        <li class="">
                            <?php //echo anchor('welcome','<i class="material-icons"> Dashboard');?>

                            <a href="<?php echo base_url('siswa') ?>">
                                <i class="material-icons">dashboard</i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                                                <li class="default">
                        <a data-toggle="collapse" href="#buku">
                            <i class="material-icons">local_library</i>
                            <p>Library <b class="caret"></b></p>
                        </a>
                       
                        <div class="collapse" id="buku">
                            <ul class="nav">
                                 <li>
                                <a href="<?php echo base_url() . 'siswa/buku' ?>">
                                    <i class="material-icons">menu_book</i>
                                    <p>Buku</p>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() . 'siswa/ebook' ?>">
                                    <i class="material-icons">book_online</i>
                                    <p>E-Book</p>
                                </a>
                            </li>
                            </ul>
                        </div>
                        </li>
                       <li >
                            <a href="<?php echo base_url('siswa/biodata')?>">
                                <i class="material-icons">person</i>
                                <p>Biodata</p>
                            </a>
                        </li>
						 <li class="default">
                        <a data-toggle="collapse" href="#data">
                            <i class="material-icons">present_to_all</i>
                            <p>Permohonan <b class="caret"></b></p>
                        </a>
                        <div class="collapse" id="data">
                            <ul class="nav">
                            <li>
                            <a href="<?php echo base_url() . 'siswa/angket_peminatan' ?>">
                                <i class="material-icons">touch_app</i>
                                <p>Peminatan</p>
                            </a>
                            </li>
                            
                            <li >
                                <a href="<?php echo base_url('siswa/pindah_jurusan')?>">
                                    <i class="material-icons">trending_flat</i>
                                    <p>Pindah Jurusan</p>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() . 'siswa/pindah_sekolah' ?>">
                                    <i class="material-icons">nat</i>
                                    <p>Pindah Sekolah</p>
                                </a>
                            </li>
                            </ul>
                        </div>
                        </li>
                        
                       
                        <li >
                            <a href="<?php echo base_url('siswa/jadwal')?>">
                                <i class="material-icons">list_alt</i>
                                <p>Jadwal Pelajaran</p>
                            </a>
                        </li>
                       
                       
                        <li>
                            <a href="<?php echo base_url('siswa/kalender_akademik')?>">
                                <i class="material-icons">date_range</i>
                                <p>Kalender Akademik</p>
                            </a>
                        </li>
						<li class="default">
                        <a data-toggle="collapse" href="#datax">
                            <i class="material-icons">format_list_bulleted</i>
                            <p>Data <b class="caret"></b></p>
                        </a>
                        <div class="collapse" id="datax">
                            <ul class="nav">
                                            
                            <li>
                            <a href="<?php echo base_url() . 'siswa/siswa' ?>">
                                <i class="material-icons">person</i>
                                <p>Siswa</p>
                            </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() . 'siswa/matapelajaran' ?>">
                                    <i class="material-icons">book</i>
                                    <p>Mata Pelajaran</p>
                                </a>
                            </li>
                            <li >
                                <a href="<?php echo base_url('siswa/guru')?>">
                                    <i class="material-icons">group</i>
                                    <p>Guru</p>
                                </a>
                            </li>
                        
                            </ul>
                        </div>
                        </li>
                         <li >
                            <a href="<?php echo base_url('siswa/fpilih_ta_rapor')?>">
                                <i class="material-icons">receipt_long</i>
                                <p>Rapor </p>
                            </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url('siswa/print_skl')?>">
                                <i class="material-icons">receipt_long</i>
                                Surat Keterangan Lulus
                            </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url('siswa/ijazah_smp')?>">
                                <i class="material-icons">receipt_long</i>
                                <p>Upload Ijazah SMP/Setara </p>
                            </a>
                        </li>
                         <li>
                                <a href="<?php echo base_url() . 'siswa/reset_password' ?>">
                                    <i class="material-icons">lock</i>
                                    <p>Ubah Password</p>
                                </a>
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
      timer: 600,
			placement: {
				from: "top",
				align: "center"
			}
     });
		<?php }?>
    
	
</script>