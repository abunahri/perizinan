<?= $this->extend('layout/menu') ?>

<?= $this->section('judul') ?>
<h3>Rekap Absensi</h3>
<?= $this->endSection() ?>


<?= $this->section('isi') ?>
<!-- DataTables -->

<div class="card">
	<div class="card-header">
		Filter Data
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-3">
				<div class="form-group row">
					<label for="kode_anggota" class="col-sm- col-form-label">Bulan</label>
					<div class="col-sm-8">
						
						<input type="month" value="<?= date('Y-m'); ?>" name="bulan" id="bulan" class="form-control">

					</div>
				</div>
			</div>
			<?php if (session()->idlevel == 2) : ?>
				<div class="col-md-3">
					<div class="form-group row">
						<label for="kode_anggota" class="col-sm-3 col-form-label">Kamar</label>
						<div class="col-sm-8">
							<div class="input-group input-group-sm">
								<select name="kamar" id="kamar" class="form-control">


								</select>
							</div>

						</div>
					</div>
				</div>
			<?php endif; ?>
			<div class="col-md-4">
				<div class="form-group row">
					<label for="kode_anggota" class="col-sm-4 col-form-label">Tahun Ajaran</label>
					<div class="col-sm-6">
						<div class="input-group input-group-sm">
							<select name="priode" id="priode" class="form-control">
							</select>
						</div>

					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group row">
					<div class="input-group input-group-sm">
						<button class="btn btn-primary btn-flat btn-sm" id="tombolTampil">
							Tampilkan Data
						</button>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-md-12 tampilDataRekap">
		
	</div>
</div>


<script>
	// $('#bulan').on('change', function(){
	// 	const selecBulan = $('#bulan').val();
	// 	$('#bln').val(selecBulan);
	// });
	function tampilRekapAbsensi(){
		
		let bulan = $('#bulan').val();
		let priode = $('#priode').val();
		let kamar = $('#kamar').val();
		$.ajax({
			type: "post",
			url: "/absen/tampilRekap",
			data: {
				bulan: bulan,
				priode: priode,
				kamar: kamar
			},
			dataType: "json",
			beforeSend: function(){
				$('.tampilDataRekap').html('<i class="fa fa-spin fa-spinner"></i>')
			},
			success: function(response){
				$('.tampilDataRekap').html(response.data);
				
			},
			error: function(xhr, ajaxOptions, thrownError){
				alert(xhr.status +'\n'+ thrownError);
			}
		});
	}

	function tampilPriode() {
		$.ajax({
			url: "<?= site_url('absen/ambilDataPriode') ?>",
			dataType: "json",
			success: function(response) {
				if (response.data) {
					$('#priode').html(response.data);
				}
			},
			error: function(xhr, thrownError) {
				alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
			}
		});
	}

	function tampilKamar() {
		$.ajax({
			url: "<?= site_url('absen/ambilDataKamar') ?>",
			dataType: "json",
			success: function(response) {
				if (response.data) {
					$('#kamar').html(response.data);
				}
			},
			error: function(xhr, thrownError) {
				alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
			}
		});
	}

	$(document).ready(function(){
		tampilPriode();
		tampilKamar();
		// tampilRekapAbsensi();
		$('#tombolTampil').click(function(e){
			e.preventDefault();
			let kamar = $('#kamar').val();
			let bulan = $('#bulan').val();
			let priode = $('#priode').val();
			
			if (bulan.length == 0) {
				Swal.fire('Error','Maaf pilih dahulu bulan','error');
			}
			else if(priode.length == 0){
				Swal.fire('Error','Maaf pilih dahulu priode','error');
			}else {
				tampilRekapAbsensi();
			}

		});
	});
</script>
<?= $this->endSection() ?>