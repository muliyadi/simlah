<div class="content" style="padding-top: 5px;padding-bottom:5px">

    <div class="card" style="padding-bottom: 5px;padding-right: 0px;padding-top: 5px">

        <div class="card-content">
            <div class="table-responsive">
                          <h4 class="title"><a href="<?php echo base_url('xguru/input_guru');?>" class="btn btn-sm btn-info " data-toggle="tooltip" data-placement="top" title="Data Guru Baru"><i class="material-icons">add_box </i> </a> <b>Data Guru </b>	</h4>
                       
                        <table class="table table-responsive table-striped table-bordered" id="tabel_program">
                            <thead class="text-primary">
                                <tr>
                                    	<th>Aksi</th>
                                <th>Foto</th>
                                  <th>Nama</th>
                                <th>NIK/NIP</th>
                              
                                <th>Tempat / Tgl Lahir</th>
                                <th>Gender</th>
                                <th>Agama</th>
                                <th>Alamat</th>
                                <th>No HP</th>
                                <th>Email</th>
                                <th>Pendidikan Terakhir</th>
                                <th>Pangkat / Golongan</th>
                                <th>Bidang Pengajaran</th>
                                <th>Status</th>
							
								</tr>
							</thead>
                            <tbody>
							<?php foreach($list as $row)
							{
								?>
							    <tr>
							                           <td>
                                       <a href="<?php echo base_url('xguru/password_guru').'/'.$row->id_guru?>" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Password Guru "><i class="material-icons">vpn_key </i></a>
                                       <a href="<?php echo base_url('xguru/edit_guru').'/'.$row->id_guru?>" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Edit Data Baru"><i class="material-icons">edit </i></a>
									   <a href="<?php echo base_url('xguru/delete_guru').'/'.$row->id_guru?>" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Delete Data Guru"><i class="material-icons">delete </i></a>
                                    </td>
                                    <td><img src="<?php echo base_url('foto_guru').'/'.$row->image?>" ><br><?php echo $row->id_guru.'/'.$row->nuptk?></td>
								    <td width="240"><?php echo $row->gelar_depan.'. '.$row->nm_guru.', '.$row->gelar_belakang?></td>
									<td><?php echo $row->nik.' /'.$row->nip?></td>
                                    
                                    <td><?php echo $row->tempat.' / '.$row->tgl_lahir?></td>
                                    <td><?php echo $row->jk?></td>
                                    <td><?php echo $row->agama?></td>
                                    <td><?php echo $row->alamat?></td>
                                    <td><?php echo $row->no_hp?></td>
                                    <td><?php echo $row->email?></td>
                                    <td><?php echo $row->pendidikan?></td>
                                    <td><?php echo $row->pangkat.' / '. $row->golongan?></td>
                                    <td><?php echo $row->bidang?></td>
                                    <td><?php echo $row->status?></td>
                 
                                </tr>
                                
							<?php
							}
                            ?>
                            </tbody>
                        </table>
						<a href="<?php echo base_url('xguru/input_guru');?>" class="btn btn-md btn-info">Insert</a>
						
                    </div>
                </div>
            </div>
            </div>
			
        </div>
    </div>
	            
       
 
        

