<div class="content" style="padding-top: 5px;padding-bottom:5px">

    <div class="card" style="padding-bottom: 5px;padding-right: 0px;padding-top: 5px">

        <div class="card-content">
            <div class="table-responsive">
                <h4 class=""> <span class=" material-icons">book</span> DATA EBOOK
                </H4>
                <table class="table table-hover table-responsive table-bordered table-condensed" id="tabel">
                    <thead>
                        <tr>
                            <th>KODE EBOOK</th>
                            <th>JUDUL BUKU</th>
                            <th>PENULIS</th>
                            <th>PENERBIT</th>
                            <th>THN TERBIT/</th>
                            <th>EDISI/</th>
                            <th>KATEGORI</th>
                               <th>FILE</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
            if($list)
            {
                foreach ($list as $row) {
                    ?>
                        <tr>
                            <td><?php echo $row->kode_ebook?><br></td>
                            <td><?php echo $row->judul?></td>
                            <td><?php echo $row->penulis?></td>
                            <td><?php echo $row->penerbit?></td>
                            <td><?php echo $row->thn_terbit?></td>
                            <td><?php echo $row->edisi?></td>
                            <td><?php echo $row->kategori?></td>
                            <td>  
 
                                        <a href="<?php echo $row->file?>" target="_blank" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Download Ebook"><span
                                        class="material-icons">file_download</span></a>
                                         <a class="btn btn- btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Upload Ebook"
                                    href="<?php echo base_url('adminperpus/fupload_ebook').'/'.$row->kode_ebook?>"><span
                                        class="material-icons">file_upload</span></a>
                                        <a class="btn btn- btn-xs btn-success"
                                    href="<?php echo base_url('adminperpus/edit_link').'/'.$row->kode_ebook?>"  data-toggle="tooltip" data-placement="top" title="Link Ebook"><span
                                        class="material-icons">link</span></a>
             
                            </td>
                            <td>
                               
                                                     
                                <a class="btn btn- btn-xs btn-success"
                                    href="<?php echo base_url('adminperpus/edit_ebook').'/'.$row->kode_ebook?>" data-toggle="tooltip" data-placement="top" title="Edit Ebook"><span
                                        class="material-icons">edit</span></a>
                                <a class="btn btn- btn-xs btn-danger"
                                    href="<?php echo base_url('adminperpus/delete_ebook').'/'.$row->kode_ebook?>" data-toggle="tooltip" data-placement="top" title="Delete Ebook"><span
                                        class="material-icons">delete</span></a>
                            </td>
                        </tr>
                        <?php        
                }
            }
        ?>
                    </tbody>
                </table>
                <a class="btn btn- btn-sm btn-info" href="<?php echo base_url('adminperpus/input_ebook')?>" data-toggle="tooltip" data-placement="top" title="Tambah Data Ebook Baru"><span
                        class="material-icons">add</span>TAMBAH</a>

            </div>
            <br>

            <br>

        </div>
    </div>
</div>
</div>
</div>
<!-- Required Jquery -->
<!--   Core JS Files   -->