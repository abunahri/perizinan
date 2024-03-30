<?= $this->extend('layout/menu') ?>

<?= $this->section('judul') ?>
<h3>Input Absensi</h3>
<?= $this->endSection() ?>


<?= $this->section('isi') ?>
<link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<style>

body{
	font-family: sans-serif;
}
table {
	border-collapse: collapse;
	border-spacing: 0;
	width: 100%;
	border: 1px solid #ddd;
	white-space: nowrap;
}
th, td {
	text-align: left;
	padding: 8px;
	
}
tr:nth-child(even){background-color: #dedcdc}
input[type="radio"] {
	width: 30px;
	height: 30px;
	border-radius: 15px;
	border: 1px solid #1FBED6;
	background-color: white;
	cursor: pointer;
	-webkit-appearance: none; /*to disable the default appearance of radio button*/
	-moz-appearance: none;
}
input[type="radio"]:focus { /*no need, if you don't disable default appearance*/
outline: none; /*to remove the square border on focus*/
}
input[type="radio"]:checked { /*no need, if you don't disable default appearance*/
background-color: #1FBED6;
}
input[type="radio"]:checked ~ span:first-of-type {
	color: white;
}
label span:first-of-type {
	position: relative;
	left: -21px;
	font-size: 15px;
	color: #1FBED6;
}
label span {
	position: relative;
	top: -9px;
}
</style>

<section class="content">
	<div class="container-fluid">

		<div class="row">
			<div class="col-md-12">
				<!-- Form Element sizes -->
				<div class="card card-default">
					<div class="card-header">
						<h3 class="card-title">Kamar <?= $kamar ?></h3><br>
						<h4 class="card-title">
							<?php
							if ($tgl_absen == "") {
								
								echo date('l, d  F  Y');
							}else{
								echo date('l, d  F  Y',strtotime($tgl_absen));

							}
							?>
							<!-- <input type="date" class="form-control" name="tgl_absen" id="tgl_absen"> -->

						</h4>
						
					</div>
					<div class="card-body">
						<div class="box-body table-responsive">
							<?= form_open('absen/simpanabsen', ['class' => 'formsimpan']) ?>
							<?= csrf_field() ?>

							<input type="hidden" name="kamar" value="<?= $datamusrif['kamar_musrif'] ?>">
							<input type="hidden" name="musrif" value="<?= $datamusrif['kode_musrif'] ?>">
							<input type="hidden" name="priode" value="<?= $priode ?>">
							<?php
							if ($tgl_absen == "") {
								echo '<input type="hidden" class="form-control" name="tgl_absen" id="tgl_absen" value="'.date('Y-m-d').'">';
								
							}else{
								echo '<input type="hidden" class="form-control" name="tgl_absen" id="tgl_absen" value="'.date('Y-m-d',strtotime($tgl_absen)).'">';
								

							}
							?>
							
							<table>

								<tbody><tr style="background-color: #403f3f; color: #edebeb;">
									<th>No</th>
									<th>NIS</th>
									<?php if($jenkel == 'Laki-laki') {
										echo '<th>Nama Santri</th>';
									}else{
										echo '<th>Nama Santriwati</th>';
									}
									?>
									<th>Keterangan</th>
									
									
								</tr>

								<?php
								$no =0;
								foreach($tampildata->getResultArray() as $row) :
									$no++;
									?>
									
									<tr>
										<td><?= $no ?></td>
										<td>
											<?= $row['nis'] ?>
											<input type="hidden" name="nis[]" value="<?= $row['nis'] ?>">
										</td>
										<td><?= $row['nama'] ?></td>
										<td>
											<label style="cursor: pointer;">
												<input type="radio" name="ket[]<?= $no ?>" id="ket[]" value="1" checked=""><span>H</span>
											</label>

											&nbsp;&nbsp;

											<label style="cursor: pointer;">
												<input type="radio" name="ket[]<?= $no ?>" id="ket[]" value="2"><span>P</span>
											</label>
										</td>
									</tr>
								<?php endforeach; ?>

							</tbody>
						</table>

						<div class="d-grid gap-2">

							<!-- <input type="submit" value="Simpan Absensi" name="simpanabsen" class="btn btn-primary  btn-lg mt-4 mb-4 "> -->
							<button type="submit" class="btn btn-primary  btn-lg mt-4 mb-4 btnsimpan" id="simpanabsen">
								<i class="fa fa-save"></i> Simpan absen
							</button>
							<a class="btn btn-warning  btn-lg mt-4 mb-4" href="/absen/index">
								<i class="fa fa-undo"></i> Kembali
							</a>

						</div>	

						<?= form_close() ?>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
</section>

<script>
	$(document).ready(function(){
		$('.formsimpan').submit(function(e){
			e.preventDefault();
			Swal.fire({
				title: 'Simpan absensi',
				text: "Yakin simpan absensi!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, simpan!'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						type: "post",
						url: $(this).attr('action'),
						data: $(this).serialize(),
						dataType: "json",
						beforeSend: function(){
							$('.btnsimpan').attr('disable','disabled');
							$('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
						},
						complete: function(){
							$('.btnsimpan').removeAttr('disable','disabled');
							$('.btnsimpan').html('<i class="fa fa-save"></i> Simpan absen');
						},
						success: function(response){
							if (response.sukses) {
								Swal.fire({
									icon: 'success',
									title: 'Berhasil',
									html: `${response.sukses}`,
								}).then((result) => {
									if (result.value) {
										window.location.href=("<?= site_url('absen/index') ?>");
									}
								})

							}
							if (response.error) {
								Swal.fire({
									icon: 'error',
									title: 'Gagal',
									html: `${response.error}`,
								}).then((result) => {
									if (result.value) {
										window.location.href=("<?= site_url('absen/index') ?>");
									}
								})

							}
						},
						error: function(xhr, thrownError) {
							alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
						}

					});
				}
			})

			return false;
		});
	});
</script>

<?= $this->endSection() ?>