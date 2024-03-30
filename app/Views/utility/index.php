<?= $this->extend('layout/menu') ?>

<?= $this->section('judul') ?>
Utility System
<?= $this->endSection('judul') ?>


<?= $this->section('isi') ?>


<div class="card">
	<div class="card-header">
		<div class="card-header">
			<h3 class="card-title">
				Backup Database
			</h3>

			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
					<i class="fas fa-minus"></i>
				</button>
				<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
					<i class="fas fa-times"></i>
				</button>
			</div>
		</div>
		<div class="card-body">
			<?= session()->getFlashdata('pesan'); ?>
			<button type="button" class="btn btn-primary" onclick="location.href=('/utility/doBackup')">
				Click to backup database
			</button>
		</div>
	</div>
</div>
<?= $this->endSection('isi') ?>