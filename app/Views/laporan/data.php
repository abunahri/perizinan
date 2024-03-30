<?= $this->extend('layout/menu') ?>

<?= $this->section('judul') ?>
<h3><i class="fa fa-fw fa-table"></i> Menu Laporan</h3>
<?= $this->endSection() ?>


<?= $this->section('isi') ?>
<div class="row">
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-warning">
			<div class="inner">
				<h4>Rekap Pulang</h4>

				<p>Perizinan Pulang</p>
			</div>
			<div class="icon">
				<i class="fa fa-print"></i>
			</div>
			<a href="<?= site_url('laporan/viewDataPulang') ?>" class="small-box-footer">Cetak Rekap Pulang <i class="fas fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-info">
			<div class="inner">
				<h4>Rekap Keluar</h4>

				<p>Perizinan Keluar</p>
			</div>
			<div class="icon">
				<i class="fa fa-print"></i>
			</div>
			<a href="<?= site_url('laporan/viewdataKeluar') ?>" class="small-box-footer">Cetak Rekap Keluar <i class="fas fa-arrow-circle-right"></i></a>
		</div>
	</div>
	
</div>


<?= $this->endSection(); ?>