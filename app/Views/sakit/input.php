<?= $this->extend('layout/menu') ?>

<?= $this->section('judul') ?>
<h3><i class="fa fa-fw fa-table"></i>Input Data Sakit</h3>
<?= $this->endSection() ?>
<?= $this->section('isi') ?>
<style>
.colored-toast.swal2-icon-success {
	background-color: #a5dc86 !important;
}
.colored-toast.swal2-icon-warning {
	background-color: #f8bb86 !important;
}
.colored-toast .swal2-title {
	color: white;
}
.colored-toast .swal2-close {
	color: white;
}
.colored-toast.swal2-icon-error {
	background-color: #f27474 !important;
}

.colored-toast .swal2-html-container {
	color: white;
}
.hidden{
	display: none;
}
.show{
	display: inline-block;
}
</style>


<div class="card">
	<div class="card-header">
		Filter Pencarian Siswa
		<div class="card-tools">
			<button class="btn btn-warning btn-sm" type="button" id="" onclick="window.location='<?= site_url('layout') ?>'">
				<i class="fa fa-backward"></i> Kembali
			</button>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group row">
					<label for="nis" class="col-sm-2 col-form-label">NIS Siswa</label>
					<div class="col-sm-10">
						<div class="input-group input-group-sm">

							<input type="text" name="nis" id="nis" class="form-control" placeholder="">
							<span class="input-group-append">
								<button type="button" class="btn btn-info btn-flat" id="tombolCariSiswa">
									<i class="fa fa-search"></i>
								</button>
							</span>
						</div>
						<small id="emailHelp" class="form-text text-muted">Ketik NIS Siswa lalu tekan enter atau klik tombol cari</small>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group row">
					<label for="kode_anggota" class="col-sm-3 col-form-label">Tahun Ajaran</label>
					<div class="col-sm-9">
						<div class="input-group input-group-sm">
							<select name="priode" id="priode" class="form-control">
								
							</select>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>
<div class="card">
	<div class="card-header">
		Informasi Siswa
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-2">
				<table width="100%">
					<tr>
						<td class="text-center">
							<img src="" id="img" alt="" width="100px" height="100px">
						</td>
						<td><label for=""></label></td>
					</tr>
					<tr>
						<td><label for=""></label></td>
					</tr>
					
				</table>
			</div>
			<div class="col-md-5">
				<table width="100%">
					<tr>
						<td style="vertical-align: center; width: 30%">
							<label for="nis">NISN</label>
						</td>
						<td>
							<div class="form-group">
								<input type="text" name="nisn" id="nisn" class="form-control" readonly>
							</div>	
						</td>
					</tr>
					<tr>
						<td style="vertical-align: center;">
							<label for="nama">Nama Siswa</label>
						</td>
						<td>
							<div class="form-group">
								<input type="text" name="nama" id="nama" class="form-control" readonly>
							</div>	
						</td>
					</tr>
					
				</table>
			</div>
			<div class="col-md-5">
				<table width="100%">
					<tr>
						<td style="vertical-align: center; width: 30%">
							<label for="kelas">Kelas</label>
						</td>
						<td>
							<div class="form-group">
								<input type="text" name="nama_kelas" id="nama_kelas" class="form-control" readonly>
								<input type="hidden" name="kelas" id="kelas" class="form-control" readonly>
								
							</div>	
						</td>
					</tr>
					<tr>
						<td style="vertical-align: center;">
							<label for="kamar">Kamar</label>
						</td>
						<td>
							<div class="form-group">
								<input type="text" name="nama_kamar" id="nama_kamar" class="form-control" readonly>
								<input type="hidden" name="kamar" id="kamar" class="form-control" readonly>
							</div>	
						</td>
					</tr>

				</table>
			</div>
		</div>
	</div>
</div>
<div class="card">
	<div class="card-header">
		Informasi Sakit
		
	</div>
	<div class="card-body">
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="sakit">Sakit Yang di derita</label>
				<input type="text" class="form-control form-control-sm" name="sakit" id="sakit">
			</div>
			<div class="form-group col-md-6">
				<label for="penanganan">Penanganan</label>
				<textarea name="penanganan" id="penanganan" cols="30" class="form-control form-control-sm"></textarea>
			</div>
			
		</div>
		
	</div>
</div>
<div class="card">
	
	<div class="card-body">
		<div class="row">
			
			<div class="col-md-6">
				<div class="form-group">
					
					<div class="input-group">
						<button class="btn btn-success" type="button" id="btnSimpanSakit">
							<i class="fa fa-save"></i> Simpan Data
						</button>&nbsp;
						
						<button class="btn btn-default" type="button" id="btnBatal">
							<i class="fa fa-undo"></i> Batal
						</button>&nbsp;
						

					</div>
				</div>
			</div>
			<div class="col-md-6">
				
			</div>
		</div>
	</div>
</div>
<div class="viewmodal" style="display: none;"></div>
<script>
	$(document).ready(function(){
		tampilPriode();
		$('#tombolCariSiswa').click(function(e){
			e.preventDefault()
			$.ajax({
				url: "/sakit/cariDataSiswa",
				dataType: "json",
				success: function(response){
					if (response.data) {
						$('.viewmodal').html(response.data).show();
						$('#modalsantrisakit').modal('show');
					}
				},
				error: function(xhr, ajaxOptions, thrownError){
					alert(xhr.status +'\n'+ thrownError);
				}
			});

		});

		$('#nis').keydown(function(e){
			if (e.keyCode == 13) {
				e.preventDefault();
				ambilDataSiswa();
			}
		});

		$('#btnSimpanSakit').click(function(e){
			e.preventDefault();
			simpanSakit();

		});
		$('#btnBatal').click(function(e){
			e.preventDefault();
			kosong();
			
		});
		
	});

	function kosong() {
		$('#nis').val('');
		$('#nisn').val('');
		$('#nama').val('');
		$('#kelas').val('');
		$('#kamar').val('');
		$('#nama_kamar').val('');
		$('#nama_kelas').val('');
		$('#sakit').val('');
		$('#penangnan').val('');
		
		$("#img").attr("src", "");
		$('#nis').focus();

	}
	function tampilPriode() {
		$.ajax({
			url: "<?= site_url('sakit/ambilDataPriode') ?>",
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

	function ambilDataSiswa(){
		const Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			iconColor: 'white',
			customClass: {
				popup: 'colored-toast'
			},
			showConfirmButton: false,
			timer: 3000,
			timerProgressBar: true,
			didOpen: (toast) => {
				toast.addEventListener('mouseenter', Swal.stopTimer)
				toast.addEventListener('mouseleave', Swal.resumeTimer)
			}
		});

		let nis = $('#nis').val();
		let img = $("#img").attr("src", "");
		if (nis.length == 0) {
			Toast.fire({
				icon: 'error',
				title: 'NIS masih kosong'

			});
			kosong();
		}else{
			$.ajax({
				type: "post",
				url: "/sakit/ambilDataSiswa",
				data: {
					nis: nis
				},
				dataType: "json",
				success: function(response){
					if (response.error) {
						Toast.fire({
							icon: 'error',
							title: response.error

						});
						kosong();
					}

					if (response.sukses) {
						let data = response.sukses;
						$('#nisn').val(data.nisn);
						$('#nama').val(data.nama);
						$('#nama_kelas').val(data.nama_kelas);
						$('#nama_kamar').val(data.nama_kamar);
						$('#kamar').val(data.kamar);
						$('#kelas').val(data.kelas);
						$("#img").attr("src","<?= site_url() ?>"+data.gambar);
						
					}

				},
				error: function(xhr, ajaxOptions, thrownError){
					alert(xhr.status +'\n'+ thrownError);
				}
			});
		}
	}

	function simpanSakit(){
		
		const Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			iconColor: 'white',
			customClass: {
				popup: 'colored-toast'
			},
			showConfirmButton: false,
			timer: 3000,
			timerProgressBar: true,
			didOpen: (toast) => {
				toast.addEventListener('mouseenter', Swal.stopTimer)
				toast.addEventListener('mouseleave', Swal.resumeTimer)
			}
		});

		let nis = $('#nis').val();
		let priode = $('#priode').val();
		let nama = $('#nama').val();
		let penanganan = $('#penanganan').val();
		
		let sakit = $('#sakit').val();
		let kelas = $('#kelas').val();
		let kamar = $('#kamar').val();
		

		if(nis.length == 0){
			Toast.fire({
				icon: 'warning',
				title: 'Masukkan NIS terlebih dahulu'

			});
			$('#nis').focus();
		}else if(nama.length == 0){
			Toast.fire({
				icon: 'warning',
				title: 'NIS yang anda masukkan tidak valid'

			});
			$('#nama').focus();
		}else if(sakit.length == 0){
			Toast.fire({
				icon: 'warning',
				title: 'Masukkan terlebih dahulu sakit yang diderita'

			});
			$('#sakit').focus();
		}else if(penanganan.length == 0){
			Toast.fire({
				icon: 'warning',
				title: 'Penanganan tidak boleh kosong'

			});
			$('#penanganan').focus();
		}else{
			$.ajax({
				type: "post",
				url: "/sakit/simpanSakit",
				data: {
					nis: nis,
					priode: priode,
					kelas: kelas,
					kamar: kamar,
					sakit: sakit,
					penanganan: penanganan
				},
				dataType: "json",
				success: function(response){
					if (response.sukses) {
						Swal.fire({
							icon: 'success',
							title: 'Berhasil',
							text: response.sukses,
						}).then((result) => {
							if (result.isConfirmed) {
								window.location.reload();
							}
						})
						$('#nis').focus();
					}
					if (response.error) {
						Toast.fire({
							icon: 'error',
							title: response.error

						});

					}

				},
				error: function(xhr, ajaxOptions, thrownError){
					alert(xhr.status +'\n'+ thrownError);
				}
			});

		}
	}
</script>

<?= $this->endSection(); ?>