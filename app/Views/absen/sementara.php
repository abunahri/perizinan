<div class="card">
	<div class="card-header">
		<span><strong>Rekap Absensi Bulan <?= $bulan ?> Kamar <?= $kamar ?></strong></span>
		<div class="card-tools">
			<button type="button" class="btn btn-tool btn-primary" id="cetakrekaplain" title="Print Data">
				<i class="fas fa-print"></i> Print Absen
			</button>';

		</div>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-12">
				<div class="box-body table-responsive">
					
					<table class="table table-bordered">
						<thead>
							<tr>
								<th rowspan="2" style="text-align:center;vertical-align:middle">No</th>
								<th rowspan="2" style="text-align:center;vertical-align:middle">NIS<br></th>
								<th rowspan="2" style="text-align:center;vertical-align:middle">Nama<br></th>
								<th colspan="<?= $tanggal ?>" style="text-align:center">Tanggal</th>
								<th colspan="2">Jumlah</th>
							</tr>
							<tr>
								<?php foreach ($tanggal as $value) : ?>
									<th align="center"><?= $value->format('d'); ?></th>
								<?php endforeach; ?>
								<th>H</th>
								<th>P</th>
							</tr>
						</thead>
						<tbody>

							<?php
							
							$no =1;
							foreach($tampildata->getResultArray() as $row) :
								$warna = ($no % 2 == 1) ? "#ffffff" : "#f0f0f0";
								
								?>
								<tr bgcolor="<?=$warna; ?>">
									<td><?= $no++ ?></td>
									<td><?= $row['absen_nis'] ?></td>
									<td><?= $row['nama'] ?></td>
									
									<?php for ($i=1; $i < date('t', strtotime($tanggal))+1; $i++) { ?>
										

										<td bgcolor='#EFEBE9' align='center'>
											<?php if ($i == date('d', strtotime($row['tanggal']))) {?>
												<?= $row['keterangan'] ?>


											<?php } ?>

										</td>
										
										
									<?php }?>
									

									<td><?= $row['Hadir'] ?></td>
									<td><?= $row['Pulang'] ?></td>

								</tr>

							<?php endforeach; ?>
							<tr>
								<td colspan="3" style="text-align:center">Jumlah</td>
								<?php
								for ($i=1; $i < $tanggal+1; $i++) { 
									echo "<td></td>";

								}
								?>
								<td></td>
								<td></td>

							</tr>
						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>
</div>
