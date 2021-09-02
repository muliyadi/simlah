<html>
<style type="text/css">
	body {
		padding: 20px;
		font-family: "Times New Roman";
		background-repeat: no-repeat;
		background-position: center;
	}

	.word-table {
		border: 1px solid black !important;
		border-collapse: collapse !important;
		width: 100%;
		align: center;
		font-family: "Times New Roman";
	}

	.word-table tr th,
	.word-table tr td {
		border: 1px solid black !important;
		padding: 5px 5px;
		font-family: "Times New Roman";
	}

	.wordx-table {
		border: 0px solid black !important;
		padding: 0px;
		width: 100%;
		align: center;
		font-family: "Times New Roman";
		font-size: 12px;
		margin-bottom: 0px;
	}

	.wordx-table tr th td,
	.wordx-table tr td {
		border: 0px solid black !important;
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

<body>
	<div class="container">
		<table align="center" class="wordx-table">
			<tr align="center">
				<td width="14%"><img src="<?php echo base_url(); ?>assets/img/logo.png" alt="..." width="80px"
						height="80px" align="top"> </td>
				<td>
					<p>
						<font size="3"><?php echo $this->config->item('kementerian');?><br />
							<b><?php echo $sekolah->nm_sekolah?></b><br /> <b>AKREDITASI
								<?php echo $sekolah->akreditasi?> </b><br> Kec. <?php echo $sekolah->kecamatan;?>,
							Kab.<?php echo $sekolah->kabupaten;?>, <?php echo $sekolah->provinsi;?> <br />
							<font size="3"><?php echo $sekolah->alamat;?><br /> Email:<?php echo $sekolah->email;?>;
								Website: <?php echo $sekolah->website;?> </font>
					</p>
				</td>
				<td width="10%"> </td>
			</tr>
		</table>
		<div>
			<hr class="style2">
		</div>
		<div>
			<p align="center"><b>LAPORAN DETAIL JATUH TEMPO PEMINJAMAN BUKU </b></p>
		</div>
		<table class="word-table" id="tabel">
			<thead>
				<tr>
					<th>No.</th>
					<th>Judul Buku</th>
					<th>Jumlah</th>
					<th>Anggota</th>
					<th>Tgl Pinjam</th>
						<th>Tgl J.Tempo</th>
					<th>Terlambat</th>
				</tr>
			</thead>
			<tbody>
				<?php              if($list_jatuh_tempo)             {                 $no=1;                 foreach ($list_jatuh_tempo as $row) {                                     ?>
				<tr>
					<td align="center"><?php echo $no++?></td>
					<td><?php echo $row->judul?></td>
						<td align="center"><?php echo $row->jumlah?></td>
					<td><?php echo $row->id_anggota.'-'.$row->nm_anggota?></td>
					<td><?php echo date('d-m-Y',strtotime($row->tgl_pinjam))?></td>
                    					<td><?php echo date('d-m-Y',strtotime($row->tgl_tempo))?></td>
					
					<td align="center"><?php echo $row->selisih?> Hari</td>
				</tr> <?php                         }             }         ?> </tbody>
		</table> <br>
		<div class="col-md-12" align="right"> Mawasangka, <?php echo date('d-M-Y'); ?> </div>
		<table class="wordx-table"> <br>
			<tr align="center">
				<td height="0" width="33%"></td>
				<td></td>
				<td width="33%">Kepala Perpustakaan</td>
			</tr>
			<tr height="110" align="center">
				<td></td>
				<td></td>
				<td><img src=" https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo base_url('adminperpus/print_rincian_jatuh_tempo')?>"
						width="100"></td>
			</tr>
			<tr align="center">
				<td height="0"></td>
				<td></td>
				<td>(____________________________)</td>
			</tr>
		</table>
	</div>
</body>

</html>
