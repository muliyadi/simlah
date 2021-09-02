<div class="content" style="padding-top: 5px;padding-bottom:5px">

    <div class="card" style="padding-bottom: 5px;padding-right: 0px;padding-top: 5px">

        <div class="card-content">
            <h4> Form Kompetensi Matapelajaran </h4>
            <form action="<?php echo base_url('xkurikulum/save_kompetensi')?>" method="POST" role="form">
 <input type="hidden" class="form-control " readonly value="<?php echo $id_kurikulum?>" name="id_kurikulum"
                                id="id_kurikulum">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama Pelajaran</label>
                            <input type="text" class="form-control " readonly value="<?php echo $nm_pelajaran?>" name="nm_pelajaran"
                                id="desk_pengetahuan">

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Tingkat</label>
                            <input type="text" class="form-control " readonly value="<?php echo $tingkat?>" name="tingkat"
                                id="desk_pengetahuan">

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Semester</label>
                            <input type="text" class="form-control " readonly value="<?php echo $semester?>" name="semester"
                                id="desk_pengetahuan">

                        </div>
                    </div>
                    </div>
                <div class="row">
                                   
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Kompetensi Ke</label>
                            <?php 
                        $list=array();
                        foreach($no_urut as $value)
                        {
                            $test=$value->no;
                            $list[$value->no]=$test;
                        }
                        echo form_dropdown('kompetensi_ke',$list,$kompetensi_ke,"class='form-control '");    
                        ?>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Deskripsi Kompetensi Pengetahuan</label>
                            <input type="text" class="form-control " value="<?php echo $desk_pengetahuan?>" name="desk_pengetahuan"
                                id="desk_pengetahuan">

                        </div>
                    </div>
                                      <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Deskripsi Kompetensi Keterampilan</label>
                           
                            <input name="desk_keterampilan" type="text" value="<?php echo $desk_keterampilan?>" class="form-control "
                                id="desk_keterampilan">

                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-info btn-sm"><i class="material-icons">save</i> Simpan</button>
            </form>

            <br>
            <br>
            <h4 class="title"> Detail Kompetensi </h4>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kompetensi Ke</th>
                        <th>Deskripsi Pengetahuan</th>
                        <th>Deskripsi Keterampilan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                    foreach($list_kompetensi as $row)
                    {
                        ?>

                    <tr>
                        <td scope="row"><?php echo $row->kompetensi_ke?></td>
                        <td><?php echo $row->desk_pengetahuan?></td>
                        <td><?php echo $row->desk_keterampilan?></td>
                        <td><a href="<?php echo base_url('xkurikulum/edit_kompetensi').'/'.$row->id_kurikulum.'/'.$row->kompetensi_ke?>" class="btn-sm btn-success btn">Edit</a>
                            <a href="<?php echo base_url('xkurikulum/delete_kompetensi').'/'.$row->id_kurikulum.'/'.$row->kompetensi_ke?>"
                                class="btn-sm btn-danger btn">Delete</a>
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