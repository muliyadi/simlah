<div class="content" style="padding-top: 5px;padding-bottom:5px">

    <div class="card" style="padding-bottom: 5px;padding-right: 0px;padding-top: 5px">

        <div class="card-content">
            <div class="table-responsive">
                           <h4 class="title"><a href="<?php echo base_url('xkurikulum/input_kurikulum');?>" class="btn btn-sm btn-info " data-toggle="tooltip" data-placement="top" title="Data Kurikulum Baru"><i class="material-icons">add_box </i> </a> <b>Data Kurikulum </b>	</h4>
                        <table class="table table-responsive table-striped table-bordered" id="tabel_program">
                            <thead class="text-primary">
                                <tr>

                                <th>Kode Kurikulum</th>
                                <th>Nama Kurikulum</th>
                                <th>Tahun Berlaku</th>
                                <th>Tahun Berakhir HP</th>
                                <th>Aktif</th>
       
								<th>Aksi</th>
								</tr>
							</thead>
                            <tbody>
							<?php foreach($list_kurikulum as $row)
							{
								?>
							    <tr>
                                   
                                    <td><?php echo $row->kd_kurikulum?></td>
                                    <td><?php echo $row->nm_kurikulum?></td>
                                    <td><?php echo $row->thn_berlaku?></td>
                                    <td><?php echo $row->thn_berakhir?></td>
                                    <td><?php echo $row->aktif?></td>
                       
                                    <td>
                                          <a href="<?php echo base_url('xkurikulum/detail_kurikulum').'/'.$row->kd_kurikulum?>" class="btn btn-xs btn-info">Detail</a>
                                      
                                    </td>
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
	            
   

        

