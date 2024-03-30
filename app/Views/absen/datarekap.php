<style>
.tg  {
	border-collapse:collapse;
	border-spacing:0;
	width: 100%;
}
.tg th{
	border-color:black;
	border-style:solid;
	border-width:1px;
	font-family:Arial, sans-serif;
	font-size:14px; 
	font-weight:normal;
	overflow:hidden;
	padding:10px 5px;
	word-break:normal;
	
}
.tg td{
	border-color:black;
	border-style:solid;
	border-width:1px;
	font-family:Arial, sans-serif;
	font-size:14px;
	overflow:hidden;
	padding:10px 5px;
	word-break:normal;
}
</style>
<?php if ($listSantri->getNumRows() > 0) { ?>
	
	<div class="card">
		<div class="card-header">
			<span><strong>Rekap Absensi Bulan <?= $bulan ?> Kamar <?= "{$kamar}" ?></strong></span>

			<div class="card-tools">
				<button type="button" class="btn btn-tool btn-primary" id="cetakrekapbulanan" title="Print Data">
					<i class="fas fa-print"></i> Print Absen
				</button>';

			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<div class="box-body table-responsive">

						<table class="tg">
							<thead>
								<tr>
									<th class="tg-9wq8" rowspan="2" style="text-align:center;vertical-align:middle">No</th>
									<th class="tg-9wq8" rowspan="2" style="text-align:center;vertical-align:middle;" width="300px">
										<?php if ($jenkel == "Laki-laki") {
											echo "Nama Santriwan";
										} else {
											echo "Nama Santriwati";
										} ?>
									</th>
									<th class="tg-9wq8" colspan="<?= count($tanggal) ?>" style="text-align:center;">Tanggal</th>
									<th class="tg-9wq8" colspan="2">Jumlah</th>
								</tr>
								<tr>
									<?php foreach ($tanggal as $value) : ?>
										<th align="center" style="background: lightgrey;"><?= $value->format('d'); ?></th>
									<?php endforeach; ?>
									<th class="tg-9wq8" style="background: lightgreen;"><center><b>H</b></center></th>
									<th class="tg-9wq8" style="background: red;"><center><b>P</b></center></th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 0; ?>
								<?php 


								foreach($listSantri->getResultArray() as $santri) : ?>
									<tr>
										<td class="tg-fymr"><?= $i + 1; ?></td>
										<td class="tg-fymr"><?= $santri['nama'] ?></td>
										<?php foreach ($listAbsen as $absen) : ?>
											<?=	kehadiran($absen[$i]['keterangan'] ?? ($absen['lewat'] ? 4 : 3)) ?>
										<?php endforeach; ?>
										<td class="tg-fymr"><center><b><?= $santri['hadir'] ?></b></center></td>
										<td class="tg-fymr"><center><b><?= $santri['pulang'] ?></b></center></td>
									</tr>

									<?php $i++;
								endforeach;  ?>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	</div>
<?php } ?>
<?php
function kehadiran($kehadiran){
	$text = '';
	switch ($kehadiran) {
		case 1:
		$text = "<td class=\"tg-fymr\" align='center' style='background-color:lightgreen;'><b>H</b></td>";
		break;
		case 2:
		$text = "<td class=\"tg-fymr\" align='center' style='background-color:red;'><b>P</b></td>";
		break;
		case 3:
		$text = "<td class=\"tg-fymr\" align='center' style='background-color:OldLace ;'>-</td>";
		break;
		case 4:
		default:
		$text = "<td class=\"tg-fymr\"></td>";
		break;
	}
	return $text;
}
?>
<script>
	$(document).ready(function(){
		$('#cetakrekapbulanan').click(function(e){
			let bulan = $('#bulan').val();
			let priode = $('#priode').val();

			if (bulan.length == 0) {
				Swal.fire('Error','Maaf..!, bulan belum dipilih','error');

			}
			else if(priode.length == 0){
				Swal.fire('Error','Maaf..!, priode belum dipilih','error');
			}

			else{
				let windowCetak = window.open('/laporan/cetakabsenbulanan/'+bulan+'/'+priode,"Cetak Rekap Absensi Kehadiran");
				windowCetak.focus();
			}

		});
	});
</script>
