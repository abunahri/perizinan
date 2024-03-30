<?= $this->extend('layout/menu') ?>

<?= $this->section('judul') ?>
<h3>Data Santri Sakit</h3>
<?= $this->endSection() ?>


<?= $this->section('isi') ?>
<!-- DataTables -->
<div class="row">
	
	
	<div class="col-lg-6">
		<div class="small-box bg-info">
			<div class="inner">
				<h4>Data Santri Yang Sakit rentang tanggal</h4>
				<label for="">Dari Tanggal</label>
				<input type="date" class="form-control" name="tgl_absen" id="tgl_absen">
			</div>
			<div class="inner">
				<label for="">Sampai Tanggal</label>
				<input type="date" class="form-control" name="tgl_absen" id="tgl_absen">
			</div>

			<a href="" class="small-box-footer" id="inputabsen">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
		</div>
		
	</div>
	<div class="col-lg-6">
		<div class="small-box bg-info">
			<div class="inner">
				<h4>Data Santri Yang Sakit pertanggal</h4>
				<label for="">Silahkan pilih tanggal</label>
				<input type="date" class="form-control" name="tgl_absen" id="tgl_absen">
			</div>

			<a href="" class="small-box-footer" id="inputabsen">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
		</div>
		
	</div>
	
</div>



<?= $this->endSection() ?>