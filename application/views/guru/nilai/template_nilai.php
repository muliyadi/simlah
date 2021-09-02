<?php
 header("Content-type: application/msexcel");
 header("Content-Disposition: attachment; filename=".$file.".xlsx");
 header("Pragma: no-cache");
 header("Expires: 0");
 ?>

   
<table id="test" class="table table-bordered table-responsive">
<thead>
	<tr>
		<th>NIS</th>
        <th>NAMA</th>
		<th>KELAS</th>
		<th>NILAI SPRITUAL</th>
		<th>NILAI SOSIAL</th>
		<th>NILAI PENGETAHUAN</th>
		<th>DESC</th>
		<th>NILAI KETERAMPILAN</th>
		<th>DESC</th>
	</tr>
</thead>
<tbody>
<?php
	
	$start = 1;
    foreach ($list as $r) {
    ?>
	<tr>
		<td ><?php echo $r->nis?></td>
		<td><?php echo $r->nm_siswa?></td>
		<td><?php echo $r->kelas?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
        <td></td>
        <td></td>
        <td></td>
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>