<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cetak Faktur Pembayaran Infaq</title>
	<link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">
</head>
<body onload="window.print();">
	
	<style type="text/css">
	.tg  {border-collapse:collapse;border-spacing:0;}
	.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
		overflow:hidden;padding:10px 5px;word-break:normal;}
		.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
			font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
			.tg .tg-cly1{text-align:left;vertical-align:middle}
			.tg .tg-baqh{text-align:center;vertical-align:top}
			.tg .tg-nrix{text-align:center;vertical-align:middle}
			.tg .tg-0lax{text-align:left;vertical-align:top}
		</style>
		<table class="tg">
			<thead>
				<tr>
					<th class="tg-baqh" colspan="11">DAFTAR PERIJINAN KELUAR SANTRI<br>PONDOK MODERN AL-AQSHA<br></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="tg-nrix" rowspan="2">No</td>
					<td class="tg-cly1" rowspan="2">Nama</td>
					<td class="tg-cly1" rowspan="2">Kelas</td>
					<td class="tg-cly1" rowspan="2">Kamar</td>
					<td class="tg-cly1" rowspan="2">Keperluan</td>
					<td class="tg-baqh" colspan="3">Waktu</td>
					<td class="tg-cly1" rowspan="2">Admin</td>
					<td class="tg-cly1" rowspan="2">Keterangan</td>
					<td class="tg-cly1" rowspan="2">Petugas</td>
				</tr>
				<tr>
					<td class="tg-0lax">Tanggal</td>
					<td class="tg-0lax">Jam Keluar</td>
					<td class="tg-0lax">Jam Kembali</td>
				</tr>
				<tr>
					<td class="tg-0lax"></td>
					<td class="tg-0lax"></td>
					<td class="tg-0lax"></td>
					<td class="tg-0lax"></td>
					<td class="tg-0lax"></td>
					<td class="tg-0lax"></td>
					<td class="tg-0lax"></td>
					<td class="tg-0lax"></td>
					<td class="tg-0lax"></td>
					<td class="tg-0lax"></td>
					<td class="tg-0lax"></td>
				</tr>
			</tbody>
		</table>
	</body>
	</html>