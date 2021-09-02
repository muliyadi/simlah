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
			<img src="<?php echo base_url().'foto_siswa/'.$this->session->userdata('foto');?>" width="300px">
		</div>
		<div class="login-content">
			<form method="post" action="<?php echo base_url('absen/save_absen')?>">
				<img src="<?php echo base_url().'assets/style/img/avatar.svg'?>" >
				<h2 class="title">ABSENSI</h2>
					<h4 class="title">SMA NEGERI 1 MAWASANGKA</h4>
					<BR>
					    <h3 id="tgl"></h3>
				
					    	<h2 id="jam"></h2>

           	
                    	<input type="hidden" name="aksi"  value="<?php echo $aksi?>" required class="aksi">
           		
           		   	
           		            		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-card"></i>
           		   </div>
           		   <div class="div">
           		    	<h5></h5>
           		    	<input type="password" name="nis" autofocus="true" required class="input">
            	   </div>
            	</div>
           		 
      

            	<input type="submit" class="btn" value="Absen" id="btn">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url().'assets/style/js/main.js'?>"></script>
    
    <script type="text/javascript">
    	$('.btn').hide();
	window.setTimeout("waktu()", 1000);
 
	function waktu() {
		var waktu = new Date();
		setTimeout("waktu()", 1000);
        var tgl=waktu.getDate();
        var bulan=waktu.getMonth();
        var tahun=waktu.getFullYear();
        
		var jam=waktu.getHours();
		var menit=waktu.getMinutes();
		var detik=waktu.getSeconds();
		
		$('.aksi').val('datang');
			document.getElementById("tgl").innerHTML = 'Tanggal '+tgl+'-'+bulan+'-'+tahun;
		document.getElementById("jam").innerHTML = 'Jam '+jam+'-'+menit+'-'+detik;

	}
</script>
</body>
</html>
