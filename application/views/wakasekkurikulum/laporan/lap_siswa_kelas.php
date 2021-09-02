<!doctype html>

<html>

    <head>

        <title>SIAKAD SMAN1MASTENG</title>

        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>

        <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/style-usulan.css">

        <style type="text/css">

            body{

                padding: 20px;

                font-family: "Times New Roman";





                background-repeat: no-repeat;

                background-position:center;

            }





            .word-table {

                border:1px solid black !important; 

                border-collapse: collapse !important;

                width: 100%;

                align:center;

                font-family: "Times New Roman";

            }

            .word-table tr th, .word-table tr td{

                border:1px solid black !important; 

                padding: 2px 3px;

                font-family: "Times New Roman";

            }

            .wordx-table {

                border:0px solid black !important; 

                padding: 0px;

                width: 100%;

                align:center;

                font-family: "Times New Roman";

                font-size: 12px;

                margin-bottom: 0px;

            }

            .wordx-table tr th td, .wordx-table tr td{

                border:0px solid black !important; 

                padding: 0px 0px;

                font-family: "Times New Roman";

                font-size: 12px;

                margin-bottom: 0px;

                padding: 0px;

            }

            hr.style2 {

                border-top: 3px double #8c8b8b;

                height: 1px;

                margin-top: 1px;

                margin-bottom: 1px;

                padding: 0px

            }





        </style>



    </head>

    <body background="">
            <table align="center" class="wordx-table"  >
                <tr align="center">

                    <td width="12%" ><img src="<?php echo base_url(); ?>assets/img/logo.jpg" alt="..." width="90px" height="90px"  align="top"> 



                    </td>

                    <td  >

                        <font size="3">PEMERINTAH PROVINSI SULAWESI TENGGARA<br/>
                                DINAS PENDIDIKAN DAN KEBUDAYAAN <br>
                            <b>SMA NEGERI 1 MAWASANGKA TENGAH</b><br />
                            <font size="3">Jl. Poros Mawasangka-Wamengkoli Nomor 23 Telp. ….. Lakorua 93762<br/>
                            Email:admin@sman1masteng.sch.id; Website: https://sman1masteng.sch.id

                            </font>



                    </td> 

                    <td width="10%">



                    </td>

                </tr>

            </table>

            <div>

                <hr class="style2">

            </div>





 <h4 align="center">LAPORAN DATA SISWA <br>
 KELAS <?php echo $kelas?></h4>

        <table class="word-table" style="margin-bottom: 5px"">
                            <thead class="text-primary">
                                <tr>
                               <th>No.</th>
                                <th>NIS/NISN</th>
								<th>Nama</th>
                                <th>Tempat / Tgl Lahir</th>
                                <th>Gender</th>
                                <th>Agama</th>
                                <th>Alamat</th>
                                <th>No HP</th>
                              
                                
                                
                                <th>Status</th>
							
								</tr>
							</thead>
                            <tbody>
							<?php 
							$no=1;
							$aktif=0;
							$keluar=0;
							foreach($list_siswa as $row)
							{
							    if($row->status=='Aktif')
							    {
							        $aktif++;
							    }
							    if($row->status=='Keluar')
							    {
							        $keluar++;
							    }
								?>
							    <tr>
							    <td align="center"><?php echo $no++?></td>
                                    <td align="center"><?php echo $row->nis.'/'.$row->nisn?></td>
                                    <td width="15%"><?php echo $row->nm_siswa?></td>
                                    <td><?php echo $row->tempat.', '.date("d-M-Y",strtotime($row->tgl_lahir))?></td>
                                    <td align="center"><?php echo $row->jk?></td>
                                    <td align="center"> <?php echo $row->agama?></td>
                                    <td><?php echo $row->alamat?></td>
                                    <td align="center"><?php echo $row->no_hp?></td>
                                    
                                    
                                    
                                    <td align="center"> <?php echo $row->status?></td>
                                    
                                </tr>
                                
							<?php
							}
                            ?>
                            </tbody>
                        </table>

<b><u>Keterangan:</u></b> <br>
Jumlah Aktif  = <?php echo $aktif?> <br>
Jumlah Keluar = <?php echo $keluar?>



               
        



    </body>

</html>



        

