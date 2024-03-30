<?= $this->extend('layout/menu') ?>

<?= $this->section('judul') ?>
<h3><i class="fa fa-calendar"></i> Manajemen Tahun Ajaran</h3>
<?= $this->endSection() ?>


<?= $this->section('isi') ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<script src="<?= base_url('assets') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<div class="card">
	<div class="card-header">
		<h3 class="card-title">
			<button type="button" class="btn btn-sm btn-primary tombolTambah">
				<i class="fa fa-plus"></i> Tambah Data
			</button>
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
		<table id="datapriode" class="table table-bordered table-striped table-hover">
			<thead class="bg-primary">
				<tr>
					<th style="width: 10px">#</th>
					<th>Tahun</th>
					<th>Tahun Ajaran</th>
					<th>Status</th>
					<th>Aktifkan/non aktifkan</th>
					<th class="text-center" style="width: 150px;">Action</th>
				</tr>
			</thead>

		</table>
	</div>
</div>
<div class="viewmodal" style="display: none;"></div>
<script>
	function tampilDataPriode() {
		var table = $('#datapriode').DataTable({
			"processing": true,
			"serverSide": true,
			"autoWidth": false,
			"responsive": true,
			"order": [],
			"ajax": {
				"url": "<?= site_url('priode/ambilDataPriode') ?>",
				"type": "POST"
			},
			"columnDefs": [{
				"targets": [0, 4],
				"orderable": false,
			}, ],
		});
	}

	function hapus(id, priode) {
		Swal.fire({
			title: 'Hapus Kategori',
			html: `Yakin hapus nama tahun ajaran <strong>${priode}</strong> ini ?`,
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Hapus !',
			cancelButtonText: 'Tidak'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: "post",
					url: "<?= site_url('priode/hapus') ?>",
					data: {
						priode_id: id
					},
					dataType: "json",
					success: function(response) {
						if (response.sukses) {
							Swal.fire(
								'Berhasil',
								response.sukses,
								'success'
								).then((result) => {
									if (result.isConfirmed) {
										window.location.reload();
									}
								});
							}
						},
						error: function(xhr, thrownError) {
							alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
						}
					});
			}
		})
	}

	function edit(id) {
		$.ajax({
			type: "post",
			url: "<?= site_url('priode/formEdit') ?>",
			data: {
				priode_id: id
			},
			dataType: "json",
			success: function(response) {
				if (response.data) {
					$('.viewmodal').html(response.data).show();
					$('#modalformedit').on('shown.bs.modal', function(event) {
						
					});
					$('#modalformedit').modal('show');
					
				}
			},
			error: function(xhr, thrownError) {
				alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
			}
		});
	}

	function aktif(id,priode) {
		Swal.fire({
			title: 'Aktifkan TA',
			html: `Yakin ingin mengaktifkan nama tahun ajaran <strong>${priode}</strong> ini ?`,
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Aktifkan !',
			cancelButtonText: 'Tidak'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: "post",
					url: "<?= site_url('priode/aktif') ?>",
					data: {
						priode_id: id
					},
					dataType: "json",
					success: function(response) {
						if (response.sukses) {
							Swal.fire(
								'Berhasil',
								response.sukses,
								'success'
								).then((result) => {
									if (result.isConfirmed) {
										window.location.reload();
									}
								});
							}
						},
						error: function(xhr, thrownError) {
							alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
						}
					});
			}
		})
	}

	$(document).ready(function() {
		tampilDataPriode();

		$('.tombolTambah').click(function(e) {
			e.preventDefault();
			$.ajax({
				url: "<?= site_url('priode/formTambah') ?>",
				dataType: "json",
				type: 'post',
				data: {
					aksi: 0
				},
				success: function(response) {
					if (response.data) {
						$('.viewmodal').html(response.data).show();
						$('#modaltambahpriode').on('shown.bs.modal', function(event) {
							$('#priode').focus();
						});
						$('#modaltambahpriode').modal('show');
					}
				},
				error: function(xhr, thrownError) {
					alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
				}
			});
		});
	});


</script>

<?= $this->endSection(); ?>