<?php
if ($tampildata->getNumRows() >0) { ?>
	<div class="card">
		<div class="card-header">
			Rekap Perizinan Pulang 
			<div class="card-tools">
				<button type="button" class="btn btn-tool btn-primary" id="cetakSemuarekapPulang" title="Print Data">
					<i class="fas fa-print"></i> Print Semua Data
				</button>&nbsp;

				<button type="button" class="btn btn-tool btn-warning" onclick="window.location='<?= site_url('laporan/data') ?>'">
					<i class="fa fa-undo"></i> Kembali
				</button>

			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<div class="box-body table-responsive">
						<table class="table table-responsive table-bordered" style="white-space: nowrap;" width="100%">
							<thead>
								<tr>
									<th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
									<th rowspan="2" style="text-align: center; vertical-align: middle;">Nama Siswa</th>
									<th rowspan="2" style="text-align: center; vertical-align: middle;">NIS</th>
									<th rowspan="2" style="text-align: center; vertical-align: middle;">Kelas</th>
									<th rowspan="2" style="text-align: center; vertical-align: middle;">Kamar</th>
									<th colspan="12" style="text-align: center; vertical-align: middle;">Bulan</th>
									<th rowspan="2" style="text-align: center; vertical-align: middle;">Total Izin</th>
								</tr>
								<tr>
									<th>Jul</th>
									<th>Aug</th>
									<th>Sep</th>
									<th>Okt</th>
									<th>Nov</th>
									<th>Des</th>
									<th>Jan</th>
									<th>Feb</th>
									<th>Mar</th>
									<th>Apr</th>
									<th>Mei</th>
									<th>Jun</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$nomor = 1;

								foreach ($tampildata->getResultArray() as $row) :

									?>
									<tr>
										<td><?= $nomor++ ?></td>
										<td><?= $row['nama'] ?></td>
										<td><?= $row['nis'] ?></td>
										<td><?= $row['nama_kelas'] ?></td>
										<td><?= $row['nama_kamar'] ?></td>
										<td><?= ($row['Juli'] > 0) ? $row['Juli'] : '-' ?></td>
										<td><?= ($row['Agustus'] > 0) ? $row['Agustus'] : '-' ?></td>
										<td><?= ($row['September'] > 0) ? $row['September'] : '-'  ?></td>
										<td><?= ($row['Oktober'] > 0) ? $row['Oktober'] : '-' ?></td>
										<td><?= ($row['November'] > 0) ? $row['November'] : '-' ?></td>
										<td><?= ($row['Desember'] > 0) ? $row['Desember'] : '-' ?></td>
										<td><?= ($row['Januari'] > 0) ? $row['Januari'] : '-' ?></td>
										<td><?= ($row['Februari'] > 0) ? $row['Februari'] : '-' ?></td>
										<td><?= ($row['Maret'] > 0) ? $row['Maret'] : '-' ?></td>
										<td><?= ($row['April'] > 0) ? $row['April'] : '-' ?></td>
										<td><?= ($row['Mei'] > 0) ? $row['Mei'] : '-' ?></td>
										<td><?= ($row['Juni'] > 0) ? $row['Juni'] : '-' ?></td>
										<td><?= ($row['Total'] > 0) ? $row['Total'] : '-' ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

<script>
	$(document).ready(function(){
		$('#cetakSemuarekapPulang').click(function(e){
			let kelas = $('#kelas').val();
			let kamar = $('#kamar').val();
			let priode = $('#priode').val();

			if (kelas.length == 0) {
				Swal.fire('Error','Maaf..!, kelas belum dipilih','error');

			}
			else if(kamar.length == 0){
				Swal.fire('Error','Maaf..!, kamar belum dipilih','error');
			}

			else{
				let windowCetak = window.open('/laporan/cetakrekappulang/'+kelas+'/'+kamar+'/'+priode,"Cetak Rekap Perizinan Pulang");
				windowCetak.focus();
			}

		});
	});
</script>