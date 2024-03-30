<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cetak Kartu Pelajar</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">
	<style>
	img {
		width: 100%;
		height: auto;
	}
</style>
</head>
<body onload="window.print();">

	<div style="width: 850px;height: 260px;margin-bottom: -12px;padding:; background-image: url('<?= base_url() ?>/upload/balangko.png');">

		<img style="border-radius: 6px;border: 1px solid #222; position: absolute;margin-left: 30px;margin-top: 90px; width: 90px; height: 100px;overflow: hidden;" class="img-responsive img" src="<?= base_url($foto) ?>">

		<img style="position: absolute;margin-left: 40px;margin-top: 15px; width: 50px;" src="<?= base_url($setting['logo']) ?>">

		<p style="color: #fff;position: absolute;padding-left: 85px;padding-top: 3px; width:300px; height: 40px;text-transform: uppercase;text-align: center;letter-spacing: 2px;"><?= $setting['nama_sekolah'] ?> <br><?= $setting['kec'] ?> - <?= $setting['kab'] ?><b></b></p>

		<p style="letter-spacing: 2px;margin-left: 150px;padding-top: 90px;width: 240px; text-align: left; font-size: 15px"><b>KARTU PELAJAR</b></p>

		<p style="font-family: arial;font-size: 9px;position: absolute;margin-left: 35px;margin-top: 80px;width: 83px;height:30px;text-align:center;position: center;float: center"><?php
		$tanggal = date ("j");
		$bulan = array(1=>"Januari","Februari","Maret", "April", "Mei", "Juni","Juli","Agustus","September","Oktober", "November","Desember");
		$bulan = $bulan[date("n")];
		$tahun = date("Y");
		$thn = $tahun+5;
	?>Berlaku Hingga:<br><span style="font-size: 8px">selama menjadi siswa</span></p>
	<!-- <img style="border:2px solid #fff;position: absolute;margin-left: 50px;margin-top: 65px;width: 50px; height: 50px;" src="../assets/img/qrcode/"> -->
	<table cellspacing="0em" style="margin-top: -10px; padding-left: 150px; position: relative;font-family: arial;font-size: 10px;transition-property: 500px;width: 390px;height: 130px;"> 
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><?= $nama ?></td>
		</tr> 
		<tr>
			<td>NIS</td>
			<td>:</td>
			<td><?= $nis ?></td>
		</tr>
		<tr>
			<td>NISN</td>
			<td>:</td>
			<td><?= $nisn ?></td>
		</tr>
		<tr>
			<td>TTL</td>
			<td>:</td>
			<td><?= ucfirst($tmp_lahir) ?>, <?= $tgl_lahir ?></td>
		</tr>
		<tr>
			<td>JK</td>
			<td>:</td>
			<td><?= $jenkel ?></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td><?= $alamat ?></td>
		</tr>
		<tr>
			<td style="display:none;">Kelurahan/Desa</td>
			<td>:</td>
			<td></td>
		</tr>
		<tr>
			<td style="display:none;">Kecamatan</td>
			<td>:</td>
			<td></td>
		</tr>
		<tr>
			<td style="display:none;">Kota/Kabupaten</td>
			<td>:</td>
			<td></td>
		</tr>

	</table>
	<p style="margin-top: -220px;padding-left: 544px;padding-top: 10px;font-size: 11px;"> 
		<b style="font-size: 12px;">VISI PONDOK MODERN PLUS AL-AQSHA</b>
		<ul style="padding-left: 480px;font-family: arial;font-size: 10px;text-align: justify;padding-right: 25px;margin-top: -8px; list-style: none;">
			<li>Mencetak para santri menjadi sholeh dan sholehah yang Qurrota A'yun</li>
		</ul>
	</p>
	<p style="margin-top: -20px;padding-left: 544px;padding-top: 10px;font-size: 11px;">
		<b style="font-size: 12px;">MISI PONDOK MODERN PLUS AL-AQSHA</b>
		<ol style="padding-left: 480px;font-family: arial;font-size: 10px;text-align: justify;padding-right: 25px;margin-top: -8px;">
			<li>Menanamkan nilai-nilai Islam dan akhlakul karimah</li>
			<li>Membekali ilmu-ilmu agama dan ilmu umum</li>
			<li>Membentuk karakter yang siap memimpin dan siap dipimpin</li>
			<li>Mencetak kader da'i dan da'iyah</li>
		</ol>
		<p style="margin-left: 490px;font-family: arial;font-size: 10px;text-align: justify;padding-right: 25px;width: 35%;text-align: right;">Jatinangor,<?php echo $tanggal ." ". $bulan ." ". $tahun;?></p>
		<p style="padding-left: 650px;font-family: arial;font-size: 10px;text-align: justify;padding-right: 25px;width: 35%;margin-top: -6px;">Mengetahui,<br><b>Kepala Sekolah<br><br><br><br><?= $setting['kepsek'] ?></b><br>NIP. <?= $setting['nip'] ?></p>
		<img style="padding-left: 580px;font-family: arial;font-size: 10px;text-align: justify;padding-right: 25px;width: 15%;margin-top: -80px;position: absolute;" src="<?= base_url($setting['cap']) ?>">
		<img style="border-radius: 2px;border:4px solid #fff;margin-left: 500px;font-family: arial;font-size: 10px;text-align: justify;width: 70px;margin-top: -90px;position: absolute;" src="<?= base_url('upload/qrcode/' .$nis.'.png') ?>">
	</p>
</div>


<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>/dist/js/demo.js"></script>
</body>
</html>