
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/img/apple-icon.png" />
        <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/img/favicon.png" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>SIMLAH</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <!-- Bootstrap core CSS     -->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
        <!--  Material Dashboard CSS    -->
        <link href="<?php echo base_url(); ?>assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="<?php echo base_url(); ?>assets/css/demo.css" rel="stylesheet" />
        <!--     Fonts and icons     -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/material-icon.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div class="wrapper">
             <div class="sidebar" data-color="green" data-image="<?php echo base_url(); ?>assets/img/sidebar-1.jpg">
                <?php $a=$this->session->userdata('img');?>
               <div class="logo text-center">
                    <h4><a href="<?php echo base_url()?>" class="">
                      <img src="<?php echo base_url('foto_guru').'/'.$a?>" height="90px" >
                    </a></h4>
					<?php echo $this->session->userdata('nm_user');?><br>
						Tahun Ajaran <?php echo $this->session->userdata('kd_ta');?>
                </div>
                <div class="sidebar-wrapper">
                    <ul class="nav">
                        <li class="">
                            <?php //echo anchor('welcome','<i class="material-icons"> Dashboard');?>
                            <a href="<?php echo base_url('guru') ?>">
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
                                <a href="<?php echo base_url() . 'guru/buku' ?>">
                                    <i class="material-icons">menu_book</i>
                                    <p>Buku</p>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() . 'guru/ebook' ?>">
                                    <i class="material-icons">book_online</i>
                                    <p>E-Book</p>
                                </a>
                            </li>
                            </ul>
                        </div>
                        </li>
						<li class="default">
                        <a data-toggle="collapse" href="#data">
                            <i class="material-icons">storage</i>
                            <p>Data <b class="caret"></b></p>
                        </a>
                       
                        <div class="collapse" id="data">
                            <ul class="nav">
                            
                           
                           <li>
                                <a href="<?php echo base_url() . 'guru/edit_guru' ?>">
                                    <i class="material-icons">person</i>
                                    <p>Biodata</p>
                                </a>
                            </li>
							<li>
                                <a href="<?php echo base_url() . 'guru/siswa' ?>">
                                    <i class="material-icons">person</i>
                                    <p>Siswa Bimbingan</p>
                                </a>
                            </li>
							 <li>
                                <a href="<?php echo base_url() . 'guru/all_siswa' ?>">
                                    <i class="material-icons">person</i>
                                    <p>Semua Siswa</p>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() . 'guru/view_kelas' ?>">
                                    <i class="material-icons">person</i>
                                    <p>Kelas</p>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() . 'guru/guru' ?>">
                                    <i class="material-icons">person</i>
                                    <p>Guru</p>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() . 'guru/matapelajaran' ?>">
                                    <i class="material-icons">book</i>
                                    <p>Mata Pelajaran</p>
                                </a>
                            </li>
                            </ul>
                        </div>
                        </li>
						<li class="default">
                        <a data-toggle="collapse" href="#transaksi">
                            <i class="material-icons">data_usage</i>
                            <p>Transaksi <b class="caret"></b></p>
                        </a>
                       
                        <div class="collapse" id="transaksi">
                            <ul class="nav">
                            
                           
                             <li >
                            <a href="<?php echo base_url('guru/registrasi')?>">
                               <i class="material-icons">sync</i>
                                <p>Registrasi Siswa</p>
                            </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url('guru/form_input_nilai')?>">
                                <i class="material-icons">list</i>
                                <p>Input Nilai</p>
                            </a>
                        </li>
                        <li>
                                <a href="<?php echo base_url() . 'guru/form_input_catatan_rapot' ?>">
                                    <i class="material-icons">book</i>
                                    <p>Catatan Wali Kelas </p>
                                </a>
                            </li>
                            </ul>
                        </div>
                        </li>
                        <li class="default">
                        <a data-toggle="collapse" href="#kelas">
                            <i class="material-icons">control_point</i>
                            <p>Kontrol <b class="caret"></b></p>
                        </a>
                       
                        <div class="collapse" id="kelas">
                            <ul class="nav">
                                 
                            
                           
                            
                            <li>
                                <a href="<?php echo base_url() . 'guru/absen_siswa' ?>">
                                    <i class="material-icons">person</i>
                                    <p>Absensi</p>
                                </a>
                            </li>
							 <li>
                            <a href="<?php echo base_url('guru/kalender_akademik')?>">
                                <i class="material-icons">date_range</i>
                                <p>Kalender Akademik</p>
                            </a>
                        </li>    
                            <li>
                                <a href="<?php echo base_url() . 'guru/kontrol_nilaif' ?>">
                                    <i class="material-icons">person</i>
                                    <p>Nilai Pelajaran</p>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() . 'guru/nilai_ekstraf' ?>">
                                    <i class="material-icons">person</i>
                                    <p>Nilai Ekskul</p>
                                </a>
                            </li>
                            
                            <li>
                                <a href="<?php echo base_url() . 'guru/siswa_nilai_rendahf' ?>">
                                    <i class="material-icons">person</i>
                                    <p>Nilai Rendah</p>
                                </a>
                            </li>
                            </ul>
                        </div>
                        </li>
   
					<li class="default">
                        <a data-toggle="collapse" href="#pengaturan">
                            <i class="material-icons">settings_suggest</i>
                            <p>Pengaturan <b class="caret"></b></p>
                        </a>
                       
                        <div class="collapse" id="pengaturan">
                            <ul class="nav">
                                 <li>
                                <a href="<?php echo base_url() . 'guru/reset_password' ?>">
                                    <i class="material-icons">lock</i>
                                    <p>Ubah Password</p>
                                </a>
                            </li>
                            </ul>
                        </div>
                        </li>
						
                       
                        
                            
                                             
                            <li class="default">
                        <a data-toggle="collapse" href="#laporan">
                            <i class="material-icons">receipt_long</i>
                            <p>Laporan <b class="caret"></b></p>
                        </a>
                       
                        <div class="collapse" id="laporan">
                            <ul class="nav">
                            <li>
                                <a href="<?php echo base_url() . 'guru/frapor' ?>">
                                    <i class="material-icons">person</i>
                                    <p>Rapor</p>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() . 'guru/flaporan_bulanan_siswa' ?>">
                                    <i class="material-icons">person</i>
                                    <p>Lap. Bulanan Siswa</p>
                                </a>
                            </li>
                            </ul>
                        </div>
                        </li>    
				
                        <?php if($this->session->userdata('logged_in'))
						{
							$base='login/logout';
							$label='Logout';
							$icon='logout';
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
						<div class="card-content"><H4>
						<img src="<?php echo base_url()?>assets/img/logo.png" style="width: 6rem;height:6rem;"  > <?php echo $menu;?></H4>
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
            