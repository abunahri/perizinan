<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cetak Perizinan Keluar</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url() ?>/assets/dist/css/adminlte.min.css">
</head>
<body onload="window.print();">
	<table style="text-align:center; width: 100%;">
		<tr>
			<td colspan="9">
				<img src="<?= base_url() ?>/upload/logo1.png" style="width: 60px; margin-left: -900px; margin-bottom: -90px;">
				<h3 style="font-family: arial;">DATA PERIZINAN KELUAR</h3>
				<h5 style="margin-top: 10px; font-family: arial;"><?= $setting['nama_sekolah'] ?></h5>
				<hr style="border-top: 1px solid #000; margin-top: 30px; width:100%;">
			</td>
		</tr>

	</table>
	
	
	<table class="table table-hover table-sm table-bordered" style="width:100%">
		<thead>
			<tr>
				<th rowspan="2" style="text-align:center;vertical-align:middle">No</th>
				<th rowspan="2" style="text-align:center;vertical-align:middle">No Izin</th>
				<th rowspan="2" style="text-align:center;vertical-align:middle">Nama</th>
				<th rowspan="2" style="text-align:center;vertical-align:middle">Kelas</th>
				<th colspan="3" style="text-align:center;vertical-align:middle">Waktu Izin</th>
				<th rowspan="2" style="text-align:center;vertical-align:middle">Keperluan</th>
				<th rowspan="2" style="text-align:center;vertical-align:middle">No Telp</th>
				<th rowspan="2" style="text-align:center;vertical-align:middle">Status Izin</th>
			</tr>
			<tr>
				<th style="text-align:center;vertical-align:middle">Tgl Izin</th>
				<th style="text-align:center;vertical-align:middle">Jam izin</th>
				<th style="text-align:center;vertical-align:middle">Jam Kembali</th>
			</tr>
		</thead>
		<tbody>
			<?php
			
			$nomor=1;
			foreach($tampildata->getResultArray() as $row) :
				$telat = new DateTime($row['izin_tglkembali']);
				$today = new DateTime();
				$lama = $today->diff($telat);
				?>
				<tr>
					<td><?= $nomor++ ?></td>
					<td><?= $row['izin_nomor'] ?></td>
					<td><?= $row['nama'] ?><br></td>
					<td><?= $row['nama_kelas'] ?></td>
					<td><?= $row['izin_tgl'] ?></td>
					<td><?= $row['izin_jam'] ?></td>
					<td><?= $row['izin_jamkmbli'] ?></td>
					<td><?= $row['izin_keperluan'] ?></td>
					<td><?= $row['telp'] ?></td>
					<td>
						<?php 
						if ($today > $telat) {
							echo 'Telat '.$lama->h. ' Jam';
						}else{
							echo $row['izin_status'];
						}
						?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>

	</table>

	<!-- Bootstrap 4 -->
	<script src="<?= base_url() ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url() ?>/assets/dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="<?= base_url() ?>/assets/dist/js/demo.js"></script>
</body>
</html>