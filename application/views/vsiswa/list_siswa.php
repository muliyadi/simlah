<div class="content" style="padding-top: 5px;padding-bottom:5px">

    <div class="card" style="padding-bottom: 5px;padding-right: 0px;padding-top: 5px">

        <div class="card-content">
            <div class="table-responsive">
                         <h4 class="title"><a href="<?php echo base_url('xsiswa/input_siswa');?>" class="btn btn-sm btn-info " data-toggle="tooltip" data-placement="top" title="Data Siswa Baru"><i class="material-icons">add_box </i> </a> <b>Data Siswa </b>	</h4>
                         	
                        <table class="table table-responsive table-striped table-bordered" id="tabel_program">
                            <thead class="text-primary">
                                <tr>
                                    				<th>Aksi</th>
                                <th>Foto</th>
                                 <th>Nama Siswa</th>
                                <th>Tempat / Tgl Lahir</th>
                                <th>Gender</th>
                                <th>Agama</th>
                                <th>Alamat</th>
                                <th>No HP</th>
                                <th>Email</th>
                                <th>Tahun Masuk</th>
                                <th>Status</th>
				
								</tr>
							</thead>
                            <tbody>
							<?php foreach($list as $row)
							{
								?>
							    <tr>
							          <td>
                                   
                                    
                                    <a href="<?php echo base_url('xsiswa/reset_password_siswa').'/'.$row->nis?>" class="btn btn-xs btn-info " data-toggle="tooltip" data-placement="top" title="Password Siswa"><span class="material-icons">vpn_key</span> </a>
									<a href="<?php echo base_url('xsiswa/edit_siswa').'/'.$row->nis?>" class="btn btn-xs btn-info  btn-icon"  onclick="return confirm('Anda yakin akan mengedit data ini ?')"  data-toggle="tooltip" data-placement="top" title="Edit Siswa"><span class="material-icons">edit</span></a>
                                    
									<a href="<?php echo base_url('xsiswa/delete_siswa').'/'.$row->nis?>" class="btn btn-xs btn-info  "  onclick="return confirm('Anda yakin akan menghapus data ini ?')"  data-toggle="tooltip" data-placement="top" title="Delete Siswa"><span class="material-icons">delete</span></a>
                                    
                                    <td><img src="<?php echo base_url('foto_siswa').'/'.$row->image?>" style="width: 5rem;height:6rem;"><br>
                                   <?php echo $row->nis.' / '.$row->nisn?></td>
			                        <td> <?php echo $row->nm_siswa?></td>
                                    <td><?php echo $row->tempat.' / '.$row->tgl_lahir?></td>
                                    <td><?php echo $row->jk?></td>
                                    <td><?php echo $row->agama?></td>
                                    <td><?php echo $row->alamat?></td>
                                    <td><?php echo $row->no_hp?></td>
                                    <td><?php echo $row->email?></td>
                                    <td><?php echo $row->angkatan?></td>
                                    <td><?php echo $row->status?></td>
                                  
                                </tr>
                                
							<?php
							}
                            ?>
                            </tbody>
                        </table>
				
						
                    </div>
                </div>
            </div>
            </div>
			
        </div>
    </div>


        

