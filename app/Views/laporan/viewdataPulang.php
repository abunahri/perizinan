<?= $this->extend('layout/menu') ?>

<?= $this->section('judul') ?>
<h3><i class="fa fa-fw fa-table"></i> Rekap Perizinan Pulang</h3>
<?= $this->endSection() ?>


<?= $this->section('isi') ?>

<!-- DataTables -->
<link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<div class="card">
	<div class="card-header">
		Filter Data
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-3">
				<div class="form-group row">
					<label for="kode_anggota" class="col-sm-3 col-form-label">Kelas</label>
					<div class="col-sm-9">
						<div class="input-group input-group-sm">
							<select name="kelas" id="kelas" class="form-control">
								
							</select>
						</div>
						
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group row">
					<label for="kode_anggota" class="col-sm-3 col-form-label">Kamar</label>
					<div class="col-sm-9">
						<div class="input-group input-group-sm">
							<select name="kamar" id="kamar" class="form-control">
								
							</select>
						</div>
						
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group row">
					<label for="kode_anggota" class="col-sm-5 col-form-label">Tahun Ajaran</label>
					<div class="col-sm-7">
						<div class="input-group input-group-sm">
							<select name="priode" id="priode" class="form-control">
								
							</select>
						</div>
						
					</div>
				</div>
			</div>
			<div class="col-md-3">
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
	<div class="col-md-12 tampilrekapPulang">

	</div>
	
</div>
<script>
	function tampilRekapPulang(){
		let kelas = $('#kelas').val();
		let kamar = $('#kamar').val();
		let priode = $('#priode').val();

		$.ajax({
			type: "post",
			url: "/laporan/tampilrekapPulang",
			data: {
				kelas: kelas,
				kamar: kamar,
				priode: priode
			},
			dataType: "json",
			beforeSend: function(){
				$('.tampilrekapPulang').html('<i class="fa fa-spin fa-spinner"></i>')
			},
			success: function(response){
				$('.tampilrekapPulang').html(response.data);
				
			},
			error: function(xhr, ajaxOptions, thrownError){
				alert(xhr.status +'\n'+ thrownError);
			}
		});
	}

	function tampilKelas() {
		$.ajax({
			url: "<?= site_url('laporan/ambilDataKelas') ?>",
			dataType: "json",
			success: function(response) {
				if (response.data) {
					$('#kelas').html(response.data);
				}
			},
			error: function(xhr, thrownError) {
				alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
			}
		});
	}

	function tampilKamar() {
		$.ajax({
			url: "<?= site_url('laporan/ambilDataKamar') ?>",
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

	function tampilPriode() {
		$.ajax({
			url: "<?= site_url('laporan/ambilDataPriode') ?>",
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

	$(document).ready(function(){
		tampilRekapPulang();
		tampilKelas();
		tampilKamar();
		tampilPriode();
		$('#tombolTampil').click(function(e){
			e.preventDefault();
			let kamar = $('#kamar').val();
			let kelas = $('#kelas').val();
			let priode = $('#priode').val();
			
			if (kelas.length == 0) {
				Swal.fire('Error','Maaf pilih dahulu kelas','error');
			}
			else if(kamar.length == 0){
				Swal.fire('Error','Maaf pilih dahulu kamar','error');
			}else{
				tampilRekapPulang();
			}

		});
	});
	
</script>

<?= $this->endSection(); ?>