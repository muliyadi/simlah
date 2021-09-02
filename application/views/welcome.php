<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>logo_sekolah/40403039.png" />
        <link rel="icon" type="image/png" href="<?php echo base_url(); ?>logo_sekolah/40403039.png" />
    <title>SIMLAH</title>
        <link href="<?php echo base_url(); ?>assets/bootstrap4/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <main  >
        <div class="container-fluid " >
            <div class="row" style="margin-top: 30px;">
                <div class="col text-center"><img src="logo/logo.jpg" style="width: 100px;height: 100px;margin-bottom: 10px;">
                    <p style="margin-bottom: 0px;font-size: 16px;color: #00ecfc;"><b>SIMLAH</b></p>
                    <p style="font-size: 14px;margin-bottom: 20px;">SMA NEGERI 1 MAWASANGKA <br></p>
                </div>
            </div>
            <div class="row" style="margin-left: 0px;margin-right: 0px;">

                <div class="col-md-3" style="padding-right: 5px;padding-left: 5px;">
                    <div class="card"><a href="<?php echo base_url('login/login_guru')?>"><img class="card-img-top w-100 d-block" src="logo/guru.svg" style="height: 120px;width: 120px;"></a>
                        <div >
                            <h4 class="text-center card-title"><a style="font-size: 12px" href="<?php echo base_url('login/login_guru')?>" class="btn btn-block btn-sm btn-info" type="button">Guru</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" style="padding-right: 5px;padding-left: 5px;">
                    <div class="card"><img class="card-img-top w-100 d-block" src="logo/staff3.svg" style="height: 120px;width: 120px;">
                        <div >
                            <h4 class="text-center card-title"><a style="font-size: 12px" href="<?php echo base_url('login/login_staff')?>" class="btn btn-block btn-sm btn-info" type="button">Staff</a></h4>
                        </div>
                    </div>
                </div>
                                <div class="col-md-3" style="padding-right: 5px;padding-left: 5px;">
                    <div class="card"><a href="<?php echo base_url('login/login_siswa')?>"><img class="card-img-top w-100 d-block" src="logo/siswa.svg" style="height: 120px;width: 120px;"></a>
                        <div >
                            <h4 class="text-center card-title"><a style="font-size: 12px"  href="<?php echo base_url('login/login_siswa')?>" class="btn btn-block btn-sm btn-info text-center" type="button">Siswa</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" style="padding-right: 5px;padding-left: 5px;">
                    <div class="card"><img class="card-img-top w-100 d-block" src="logo/orang_tua.svg" style="width: 120px;height: 120px;">
                        <div >
                            <p style="font-size: 11px" class="text-center card-title"><a style="font-size: 12px" href="<?php echo base_url('login/login_orang_tua')?>" class="btn btn-block btn-sm btn-info" >Orang Tua</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center align-items-center"  style="margin-top: 5px">
                                <div class="col-md-3" style="padding-right: 5px;padding-left: 5px;">
                    <div class="card"><img class="card-img-top w-100 d-block" src="logo/android.svg" style="width: 120px;height: 120px;">
                        <div >
                            <p style="font-size: 11px" class="text-center card-title"><a style="font-size: 12px" href="<?php echo base_url().'simlah.apk'?>" class="btn btn-block btn-sm btn-info" >Install </a></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
<script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap4/js/bootstrap.min.js" type="text/javascript"></script>
</body>

</html>