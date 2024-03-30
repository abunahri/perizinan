<?= $this->extend('layout/menu') ?>

<?= $this->section('judul') ?>
<h3><i class="fa fa-fw fa-table"></i> Menu Perizinan</h3>
<?= $this->endSection() ?>


<?= $this->section('isi') ?>
<div class="row">
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-warning">
			<div class="inner">
				<h4>Input</h4>

				<p>Input Perizinan</p>
			</div>
			<div class="icon">
				<i class="fa fa-tasks"></i>
			</div>
			<a href="<?= site_url('perizinan/input') ?>" class="small-box-footer">Input Perizinan <i class="fas fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-info">
			<div class="inner">
				<h4>Data Pulang</h4>

				<p>View Perizinan Pulang</p>
			</div>
			<div class="icon">
				<i class="fa fa-table"></i>
			</div>
			<a href="<?= site_url('perizinan/viewdataPulang') ?>" class="small-box-footer">Lihat Perizinan Pulang <i class="fas fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-info">
			<div class="inner">
				<h4>Data Keluar</h4>

				<p>View Perizinan Keluar</p>
			</div>
			<div class="icon">
				<i class="fa fa-table"></i>
			</div>
			<a href="<?= site_url('perizinan/viewdataKeluar') ?>" class="small-box-footer">Lihat Perizinan Keluar <i class="fas fa-arrow-circle-right"></i></a>
		</div>
	</div>
</div>

<?= $this->endSection(); ?>