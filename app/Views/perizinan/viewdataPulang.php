<?= $this->extend('layout/menu') ?>

<?= $this->section('judul') ?>
<h3><i class="fa fa-fw fa-table"></i> Data Perizinan Pulang</h3>
<?= $this->endSection() ?>


<?= $this->section('isi') ?>

<!-- DataTables -->
<link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col-md-2">
				<label>Filter</label>
			</div>
			
			<div class="col-md-2">
				<input type="date" name="tglawal" id="tglawal" class="form-control form-control-sm">
			</div>
			<div class="col-md-2">
				<input type="date" name="tglakhir" id="tglakhir" class="form-control form-control-sm">
			</div>
			<div class="col-md-2">
				<button type="button" class="btn btn-block btn-primary btn-sm" id="tombolTampil">
					<i class="fa fa-eye"></i> Tampilkan
				</button>
			</div>
			<div class="col-md-2">
				<button type="button" class="btn btn-block btn-info btn-sm" id="cetakizinpulang">
					<i class="fa fa-print"></i> Cetak
				</button>
			</div>
			<div class="col-md-2">
				<button type="button" class="btn btn-block btn-warning btn-sm" onclick="window.location='<?= site_url('perizinan/data') ?>'">
					<i class="fa fa-undo"></i> Kembali
				</button>
			</div>
		</div>
	</div>
	<div class="box-body table-responsive">
		<div class="card-body">
			<table class="table table-bordered table-striped" id="datasantri" width="100%">
				<thead>
					<tr>
						<th>No</th>
						<th>No Izin</th>
						<th>Nama Santri</th>
						<th>Kelas</th>
						<th>Tgl Izin</th>
						<th>Tgl Kembali</th>
						<th>Keperluan</th>
						<th>No Telp</th>
						<th>Status Izin</th>
						<th>#</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	function cetakpulang(noizin){
		let windowCetak = window.open('/perizinan/cetaksurat/'+noizin,"Cetak Surat Jalan Pulang", "width=800, height=400");
		windowCetak.focus();
	}
	
	function listDataSantri(){
		var table = $('#datasantri').DataTable({
			destroy: true,
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "/perizinan/listDataizin",
				"type": "POST",
				"data": {
					tglawal: $('#tglawal').val(),
					tglakhir: $('#tglakhir').val(),
					
				}
			},
			"columnDefs": [{
				"targets": [0,9],
				"orderable": false,
			}, ],
		});
	}

	function kembali(noizin,nama){
		Swal.fire({
			title: 'Kembali',
			text: "Yakin santri dengan nama "+nama+" sudah kembali?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Sudah Kembali'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: "post",
					url: "/perizinan/kembali",
					data: {
						noizin: noizin
					},
					dataType: "json",
					success: function(response){
						if(response.sukses){
							Swal.fire({
								icon: 'success',
								title: 'Proses Data',
								text: response.sukses,

							});
							listDataSantri();
						}

					},
					error: function(xhr, ajaxOptions, thrownError){
						alert(xhr.status +'\n'+ thrownError);
					}
				});
			}
		})
	}

	$(document).ready(function(){
		listDataSantri();
		$('#tombolTampil').click(function(e){
			e.preventDefault();
			listDataSantri();

		});
		$('#cetakizinpulang').click(function(e){
			e.preventDefault();
			let tglawal = $('#tglawal').val();
			let tglakhir = $('#tglakhir').val();

			let windowCetak = window.open('/perizinan/cetakizinpulang/',"Cetak Data Perizinan Pulang");
			windowCetak.focus();

		});
	})
</script>

<?= $this->endSection(); ?>