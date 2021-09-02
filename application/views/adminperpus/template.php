<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/img/favicon.png" />
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>SMU N1 MAWASANGKA</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="<?php echo base_url(); ?>assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap.min.css">

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?php echo base_url(); ?>assets/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/material-icon.css" rel="stylesheet" type="text/css">
    <!--     Dropdown     -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dropdown/css/select2.min.css" />
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-color="green" data-image="<?php echo base_url(); ?>assets/img/sidebar-5.jpg">
            <!--
            Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"
    
            Tip 2: you can also add an image using data-image tag
                -->
            <br>
            <br>
            <div class="card card-profile">
                <div class="logo card-avatar">
                    <h4 align="center"><a href="https://smn1mawasangka.sch.id" class="">

                            <img class="avatar"
                                src="<?php echo base_url('foto_user').'/'.$this->session->userdata('foto');?>"
                                style="width: 7rem;height:8rem;"><br><?php echo $this->session->userdata('nm_user');?>
                        </a></h4>
                </div>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="">
                        <a href="<?php echo base_url('adminperpus') ?>">
                            <i class="material-icons">dashboard</i>
                            <p>Depan</p>
                        </a>
                    </li>

                    <li class="default">
                        <a data-toggle="collapse" href="#data">
                            <i class="material-icons">list</i>
                            <p>Data<b class="caret"></b></p>
                        </a>
                        <div class="collapse" id="data">
                            <ul class="nav">
                                <li><a href="<?php echo base_url('adminperpus/buku')?>"><i class="material-icons">ebook</i><p> Buku</p></a></li>
                                 <li><a href="<?php echo base_url('adminperpus/ebook')?>"><i class="material-icons">ebooks</i><p> EBook</p></a></li>
                                <li><a href="<?php echo base_url('adminperpus/anggota')?>"><i class="material-icons">person</i><p> Anggota</p></a></li>
                            </ul>
                        </div>
                    </li>




                    <li class="">
                        <a href="<?php echo base_url('adminperpus/pinjam') ?>">
                            <i class="material-icons">dashboard</i>
                            <p>Pinjam/Kembali</p>
                        </a>
                    </li>


                    <li class="default">
                        <a data-toggle="collapse" href="#pengaturan">
                            <i class="material-icons">settings</i>
                            <p>Pengaturan<b class="caret"></b></p>
                        </a>
                        <div class="collapse" id="pengaturan">
                            <ul class="nav">



                            </ul>
                        </div>
                    </li>
                    <li class="default">
                        <a data-toggle="collapse" href="#laporan">
                            <i class="material-icons">table_view</i>
                            <p>Laporan<b class="caret"></b></p>
                        </a>
                        <div class="collapse" id="laporan">
                            <ul class="nav">

                                <li>
                                    <a href="<?php echo base_url('adminperpus/lap_jatuh_tempo') ?>">
                                        <i class="material-icons">event_note</i>
                                        <p>Jatuh Tempo</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('adminperpus')  ?>">
                                        <i class="material-icons">person</i>
                                        <p>Kunjungan</p>
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
                            $base='login';
                            $label='Login';
                            $icon='login';
                        }?>
                    <li class="">
                        <a href="<?php echo base_url($base)?>">
                            <i class="material-icons"><?php echo $icon?></i>
                            <p><?php echo $label?></p>
                        </a>
                    </li>


                </ul>
            </div>
        </div>
        <div class="main-panel" style="margin-top: -30px;padding-bottom:0px">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid transparent">
                    <div class="card">
                        <div class="card-content">
                            <img src="<?php echo base_url()?>assets/img/logo.png" style="width: 30px;height:30px; ">
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

<script src="<?php echo base_url(); ?>assets/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables-plugins/dataTables.bootstrap.min.js"></script>



<!-- Material Dashboard javascript methods -->
<script src="<?php echo base_url(); ?>assets/js/material-dashboard.js?v=1.2.0"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="<?php echo base_url(); ?>assets/js/demo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<!-- panggil adapter jquery ckeditor -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/adapters/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script>
	$(document).ready(function(){
	  $('[data-toggle="tooltip"]').tooltip();
	});
</script>
</body>

</html>