<!DOCTYPE html>
<html>
<head>
	<title>SIMLAH</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/style/css/style.css'?>">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="<?php echo base_url().'assets/style/img/wave.png'?>">
	<div class="container">
		<div class="img">
			<img src="<?php echo base_url().'logo/guru.svg'?>">
		</div>
		<div class="login-content">
			<form method="post" action="<?php echo base_url('login/loginx')?>">
				<img src="<?php echo base_url().'assets/style/img/avatar.svg'?>">
				<h2 class="title">SIMLAH</h2>
					<h4 class="title">SMA NEGERI 1 MAWASANGKA</h4>
					<BR>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" name="userid" class="input">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" name="password" class="input">
            	   </div>
            	</div>
            	<a href="#">Forgot Password?</a>
            	<input type="submit" class="btn" value="Login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url().'assets/style/js/main.js'?>"></script>
</body>
</html>
