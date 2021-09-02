<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>logo_sekolah/40403039.png" />
        <link rel="icon" type="image/png" href="<?php echo base_url(); ?>logo_sekolah/40403039.png" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title><?php echo $title?></title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <!-- Bootstrap core CSS     -->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
        <!--  Material Dashboard CSS    -->
        <link href="<?php echo base_url(); ?>assets/css/material-dashboard.css" rel="stylesheet" />
        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="<?php echo base_url(); ?>assets/css/demo.css" rel="stylesheet" />
        <!--     Fonts and icons     -->
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/material-icon.css" rel="stylesheet" type="text/css">
    </head>

    <body class="content">
    
    <div class="wrapper wrapper-full-page">
        <div classclass="page-header login-page header-filter" filter-color="black" >
            <div class="container">
						
<div  class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">
	<form method="post" action="<?php echo base_url('login/loginx')?>">
	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>

		<div class="card card-login card-hidden">
			<div class="card-header text-center" data-background-color="blue">
				<h4 class="card-title"><img src="<?php echo base_url()?>assets/img/logo.png" style="width:110px !important"><center><?php echo '<h5>'.$title.'</h5>'.$nama_sekolah?></center></h4>
			</div>
			<div class="card-content ">
				<div class="input-group">
					<span class="input-group-addon"><i class="material-icons">person</i></span>
					<div class="form-group label-floating">
						<label class="control-label">User ID</label>
						<input type="text" name="userid" class="form-control" required>
					</div>
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="material-icons">lock</i></span>
					<div class="form-group label-floating">
						<label class="control-label">Password</label>
						<input type="password" name="password" class="form-control" required>
					</div>
				</div>
                <br>
			</div>
			<div class="footer text-center">
				<button type="submit" class="btn btn-info btn-round btn-md"><span class="material-icons">login</span> Login </button>
			     
				<br>
			     <br><br>
        
       
			</div>
		</div>
	</form>
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
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/gmap.js"></script>
<!-- Material Dashboard javascript methods -->
<script src="<?php echo base_url(); ?>assets/js/material-dashboard.js"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="<?php echo base_url(); ?>assets/js/demo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
    <!-- panggil adapter jquery ckeditor -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/adapters/jquery.js"></script>
    <!-- setup selector -->
    <script type="text/javascript">
        $('textarea.texteditor').ckeditor();
    </script>
<script type="text/javascript">
    $(document).ready(function() {

        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        if ($('.main-panel > .content').length == 0) {
            $('.main-panel').css('height', '100%');
        }


        // Javascript method's body can be found in assets/js/demos.js
        demo.initGoogleMaps();
    });
</script>
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
    $(document).ready(function() {
        if ($('.main-panel > .content').length == 0) {
            $('.main-panel').css('height', '100%');
        }


        // Javascript method's body can be found in assets/js/demos.js
        demo.initGoogleMaps();
    });
	
</script>
</html>