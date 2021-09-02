<div class="content">
	<div class="container-fluid">
		<div class="row">
			
			<div class="col-md-12">
			    <div class="card">
			        <div class="card-content">
			    
            <p><?php echo $sekolah->visi?></p>
            </div>
            </div>
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
<script src="<?php echo base_url()?>assets/js/moment.min.js"></script>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/gmap.js"></script>
<!-- Material Dashboard javascript methods -->
<script src="<?php echo base_url(); ?>assets/js/material-dashboard.js?v=1.2.0"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="<?php echo base_url(); ?>assets/js/demo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
    <!-- panggil adapter jquery ckeditor -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/adapters/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
   

<script type="text/javascript">
 $(document).ready(function() {
     $('.kd_ta').select2();
 });
</script>

<script type="text/javascript">
 $(document).ready(function() {
     $('.nis').select2();
 });
</script>
<script type="text/javascript">
 $(document).ready(function() {
     $('.bulan').select2();
 });
</script>
<script type="text/javascript" >
$(document).ready(function(){
	
$(".bulan").change(function () {
	
	
   var bulan = $('.bulan').val();
   var kd_ta = $('.kd_ta').val();
    var form_data = {
                                        bulan: bulan,
                                        kd_ta: kd_ta,
                                        
                                       ajax: '1'
                                    };
  $.ajax({
                                        url: "<?php echo base_url().'bk/ajax_get_siswa_not_in_absen'?>",
                                        type: 'POST',
										dataType : 'json',
										cache:false,
                                        data: form_data,
                                        success: function(pesan) {
                                        
                                        var html = '';
										var i;
										for(i=0; i<pesan.length; i++){
											html += '<option value='+pesan[i].nis+'>'+pesan[i].nis+' - '+pesan[i].nm_siswa+'</option>';
										}
										$('.nis').html(html);
										$('.nis').focus();
										
                                         
                                        }
                                    });
  
  
  });

    
});  
 
</script>