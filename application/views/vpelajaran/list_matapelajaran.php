<div class="content" style="padding-top: 5px;padding-bottom:5px">

    <div class="card" style="padding-bottom: 5px;padding-right: 0px;padding-top: 5px">

        <div class="card-content">
            <div class="table-responsive">
                     <h4> <a href="<?php echo base_url('xpelajaran/input_mata_pelajaran');?>" class="btn btn-xs btn-info " data-toggle="tooltip" data-placement="top" title="Data Siswa Baru"><i class="material-icons">add_box </i> </a><b> Data Matapelajaran </b>	</h4>
                        <table class="table table-responsive table-striped table-bordered" id="tabel_program">
                            <thead >
                                <tr>
								<th>Aksi</th>
								<th>Kode Mata Pelajaran</th>
								<th>Nama Mata Pelajaran</th>
								<th>Kategori</th>
                                <th>Sub Kategori</th>
                                
								</tr>
							</thead>
                            <tbody>
							<?php 
							if($list_pelajaran)
							{
							foreach($list_pelajaran as $row)
							{
								?>
							    <tr>
							          <td><a href="<?php echo base_url('xpelajaran/edit_mata_pelajaran').'/'.$row->kd_pelajaran?>" class="btn btn-xs btn-info"  data-toggle="tooltip" data-placement="top" title="Edit Mata Pelajaran"><span class="material-icons">edit</span></a>
                                        <a href="<?php echo base_url('xpelajaran/delete_mata_pelajaran').'/'.$row->kd_pelajaran?>" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Delete Mata Pelajaran"><span class="material-icons">delete</span></a>
                                        </td>
									<td><?php echo $row->kd_pelajaran?></td>
									<td><?php echo $row->nm_pelajaran?></td>
									<td><?php echo $row->kategori?></td>
                                    <td><?php echo $row->subkategori?></td>
                                  
                                </tr>
                                
							<?php
							}
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
	            
       
   


        

