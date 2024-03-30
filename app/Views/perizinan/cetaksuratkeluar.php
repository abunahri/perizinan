<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cetak Surat Jalan keluar</title>
	<link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">
</head>
<body onload="window.print();">
	<table style="width: 100%; border: 1px solid #000; line-height: 1.5; font-family: arial; padding: 20px;">
		<thead>
			<tr>
				<td colspan="5" style="text-align: center;">
					<img src="<?= base_url() ?>/upload/logo1.png" style="position: absolute;top: 50px; left: 50px; width: 100px;">
					<h5 style="font-family: arial; font-size: 20px;">YAYASAN PENDIDIKAN</h5>
					<h6 style="font-family: arial; margin-top: -30px; font-size: 16px;">Pondok Modern Al-aqsha</h6>
					<h6 style="font-family: arial; margin-top: -30px; font-size: 12px;">Jl. Raya Jatinangor No.2 Sumedang</h6>
				</td>
			</tr>
			<tr>
				<td colspan="6">
					<hr style="border-top: 1px solid #000; margin-top: -30px;" width="100%">
				</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="5" style="text-align: center;">
					<h5 style="font-family: arial; font-size: 14px; margin-top: -30px;"><u>Surat Perizinan Keluar</u></h5>
					<h5 style="font-family: arial; font-size: 12px; margin-top: -20px;">No.<?= $izin_nomor ?></h5>
				</td>
			</tr>
			<tr>
				<?php
				if ($jenkel == 'Laki-laki') {
					echo '<td colspan="5">Dengan ini kami pengurus Pondok Modern Al-aqsha memberikan izin keluar,<br> kepada santriwan:</td>';
				}else{
					echo '<td colspan="5">Dengan ini kami pengurus Pondok Modern Al-aqsha memberikan izin keluar,<br> kepada santriwati:</td>';
				}
				?>
				
			</tr>
			<tr >
				<td style="width: 150px;">Nama</td>
				<td>:</td>
				<td colspan="3"><?= $nama ?></td>
			</tr>
			<tr>
				<td>Kelas</td>
				<td>:</td>
				<td colspan="3"><?= $kelas ?></td>
			</tr>
			<tr>
				<td>Kamar</td>
				<td>:</td>
				<td colspan="3"><?= $kamar ?></td>
			</tr>
			<tr>
				<td>Tanggal Izin</td>
				<td>:</td>
				<td colspan="3"><?= $tgl_izin ?></td>
			</tr>
			<tr>
				<td>Jam Izin</td>
				<td>:</td>
				<td colspan="3"><?= $jam_izin ?></td>
			</tr>
			<tr>
				<td>Jam Kembali</td>
				<td>:</td>
				<td colspan="3"><?= $jam_kembali ?></td>
			</tr>
			<tr>
				<td>Keperluan</td>
				<td>:</td>
				<td colspan="3"><?= $keperluan ?></td>
			</tr>
			<tr>
				<td colspan="5">Demikian surat ijin keluar ini kami berikan untuk di gunakan seperlunya.<br>terima kasih<br></td>
			</tr>
			<tr>
				
				<td colspan="5" style="text-align: center; width: 50%">Jatinangor, <?= $tgl_izin ?></td>
			</tr>
			
			<tr>
				<td colspan="5" style="text-align: center;">
					Mengetahui,
				</td>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center; width: 50%">
					<p>Biro Kesantrian</p>
				</td>
				<td colspan="2" style="text-align: center;">
					<p>Pengasuhan Santri</p>
				</td>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;">
					<?php
					if ($jenkel == 'Laki-laki') {
						echo "Dono Sukiman, S.Ag";
					}else{
						echo "Neneng Syarifah Hasanah, S.Pd.I";
					} 
					?>
				</td>
				<td colspan="2" style="text-align: center;">(<?= session()->namauser ?>)</td>
			</tr>
			
			
			<tr>
				<td colspan="5">
					<h5 style="margin-top: 25px; font-size: 14px;"><i>NB. Surat wajib dikembalikan ke kantor pengasuhan setelah santri<br>yang bersangkutan kembali ke ponpes</i></h5>
				</td>
			</tr>
		</tbody>
	</table>

</body>
</html>