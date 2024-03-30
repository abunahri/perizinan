<?= $this->extend('layout/menu') ?>

<?= $this->section('judul') ?>
<h3><i class="fa fa-fw fa-table"></i>Perizinan</h3>
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
		Informasi Perizinan & Tanggal
		<div class="card-tools">
			<button class="btn btn-warning btn-sm" type="button" id="" onclick="window.location='<?= site_url('perizinan/data') ?>'">
				<i class="fa fa-backward"></i> Kembali
			</button>
		</div>
	</div>
	<div class="card-body">
		<div class="form-row">
			<div class="form-group col-md-4">
				<label for="noizin">No Perizinan</label>
				<input type="text" class="form-control form-control-sm" style="color:red;font-weight:bold;" name="noizin" id="noizin" value="<?= $noizin ?>" readonly>
			</div>
			
			<div class="form-group col-md-4">
				<label for="tanggal" class="show" id="tgl_iz">Tanggal Izin</label>
				<input type="date" class="form-control form-control-sm" name="tgl_izin" id="tgl_izin" readonly value="<?= date('Y-m-d'); ?>">

				<label for="jam_izin" class="hidden" id="jam_iz">Jam Izin</label>
				<input type="time" class="form-control form-control-sm hidden" name="jam_izin" id="jam_izin" readonly value="<?= date('H:i'); ?>" >
			</div>
			<div class="form-group col-md-4">
				<label for="tanggal" class="show" id="tgl_kem">Tanggal Kembali</label>
				<input type="date" class="form-control form-control-sm" name="tgl_kembali" id="tgl_kembali">
				<label for="jam_kembali" class="hidden" id="jam_kem">Jam Kembali</label>
				<input type="time" class="form-control form-control-sm hidden" name="jam_kembali" id="jam_kembali" data-target="#timepicker" />
			</div>
			
			
		</div>
		<div class="form-row">
			
			<div class="form-group col-md-4">
				<label for="jenisizin">Jenis Izin</label>
				<select name="jenisizin" id="jenisizin" class="form-control form-control-sm">
					<option value="">-- Pilih--</option>
					<option value="Pulang">Pulang</option>
					<option value="Keluar">Keluar</option>
				</select>
			</div>
			<div class="form-group col-md-8">
				<label for="keperluan">Keperluan</label>
				<input type="text" class="form-control form-control-sm" name="keperluan" id="keperluan" placeholder="Keperluan Izin">
			</div>
			<!-- <input type="hidden" name="tahunajaran" id="tahunajaran" value=""> -->
		</div>

	</div>
</div>

<div class="card">
	<div class="card-header">
		Filter Pencarian Siswa
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
	
	<div class="card-body">
		<div class="row">
			
			<div class="col-md-6">
				<div class="form-group">
					
					<div class="input-group">
						<button class="btn btn-success" type="button" id="btnSimpanIzin">
							<i class="fa fa-save"></i> Simpan Izin
						</button>&nbsp;
						
						<button class="btn btn-default" type="button" id="btnBatalIzin">
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
	function cetakBayar(noizin){
		// let no_bayar = $('#no_bayar').val();

		let windowCetak = window.open('/perizinan/cetaksurat/'+noizin,"Cetak Surat Jalan","width=800, height=400");
		windowCetak.focus();
	}

	function simpanIzin(){
		if ($('#jenisizin').val() == "Pulang") {
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
			let nama = $('#nama').val();
			let keperluan = $('#keperluan').val();
			let jenisizin = $('#jenisizin').val();
			let tgl_kembali = $('#tgl_kembali').val();
			let tgl_izin = $('#tgl_izin').val();
			let noizin = $('#noizin').val();
			let kelas = $('#kelas').val();
			let kamar = $('#kamar').val();
			let priode = $('#priode').val();



			if (jenisizin.length == 0) {
				Toast.fire({
					icon: 'warning',
					title: 'jenis izin belum dipilih'

				});
				$('#jenisizin').focus();

			}else if(nis.length == 0){
				Toast.fire({
					icon: 'warning',
					title: 'NIS masih kosong'

				});
				$('#nis').focus();
			}else if(nama.length == 0){
				Toast.fire({
					icon: 'warning',
					title: 'NIS yang anda masukkan tidak valid'

				});
				$('#nis').focus();
			}else if(tgl_kembali.length == 0){
				Toast.fire({
					icon: 'warning',
					title: 'Tanggal kembali masih belum ditentukan'

				});
				$('#tgl_kembali').focus();
			}else if(keperluan.length == 0){
				Toast.fire({
					icon: 'warning',
					title: 'Keperluan izin tidak boleh kosong'

				});
				$('#keperluan').focus();
			}else{
				$.ajax({
					type: "post",
					url: "/perizinan/simpanIzin",
					data: {
						noizin: noizin,
						tgl_izin: tgl_izin,
						tgl_kembali: tgl_kembali,
						nis: nis,
						priode: priode,
						kelas: kelas,
						kamar: kamar,
						keperluan: keperluan,
						jenisizin: jenisizin
					},
					dataType: "json",
					success: function(response){
						if (response.sukses) {
							Swal.fire({
								title: 'Cetak Surat Jalan',
								text: response.sukses + ", cetak Surat Jalan ?",
								icon: 'warning',
								showCancelButton: true,
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
								confirmButtonText: 'Ya, Cetak'
							}).then((result) => {
								if (result.isConfirmed) {
									let windowCetak = window.open(response.cetaksurat,"Cetak Surat Jalan Pulang", "width=800, height=400");
									windowCetak.focus();

								}
							})
							kosong();
							buatNoIzin()
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
		}else{
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
			let keperluan = $('#keperluan').val();
			let jenisizin = $('#jenisizin').val();
			let noizin = $('#noizin').val();
			let kelas = $('#kelas').val();
			let kamar = $('#kamar').val();
			let jam_izin = $('#jam_izin').val();
			let jam_kembali = $('#jam_kembali').val();



			if (jenisizin.length == 0) {
				Toast.fire({
					icon: 'warning',
					title: 'jenis izin belum dipilih'

				});
				$('#jam_kembali').focus();

			}else if(nis.length == 0){
				Toast.fire({
					icon: 'warning',
					title: 'NIS yang anda masukkan tidak valid'

				});
				$('#nis').focus();
			}else if(jam_kembali.length == 0){
				Toast.fire({
					icon: 'warning',
					title: 'Jam Kembali masih kosong'

				});
				$('#jam_kembali').focus();
			}else if(jenisizin.length == 0){
				Toast.fire({
					icon: 'warning',
					title: 'Jenis  perizinan masih kosong'

				});
				$('#jenisizin').focus();
			}else if(keperluan.length == 0){
				Toast.fire({
					icon: 'warning',
					title: 'Keperluan izin tidak boleh kosong'

				});
				$('#keperluan').focus();
			}else{
				$.ajax({
					type: "post",
					url: "/perizinan/simpanIzin",
					data: {
						noizin: noizin,
						jam_izin: jam_izin,
						jam_kembali: jam_kembali,
						nis: nis,
						priode: priode,
						kelas: kelas,
						kamar: kamar,
						keperluan: keperluan,
						jenisizin: jenisizin
					},
					dataType: "json",
					success: function(response){
						if (response.sukses) {
							Swal.fire({
								title: 'Cetak Surat Jalan',
								text: response.sukses + ", cetak Surat Jalan ?",
								icon: 'warning',
								showCancelButton: true,
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
								confirmButtonText: 'Ya, Cetak'
							}).then((result) => {
								if (result.isConfirmed) {
									let windowCetak = window.open(response.cetaksuratkeluar,"Cetak Surat Jalan", "width=800, height=400");
									windowCetak.focus();

								}
							})
							kosong();
							buatNoIzin()
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

		

	}

	function buatNoIzin() {
		let tanggal = $('#tgl_izin').val();
		let jenisizin = $('#jenisizin').val();
		$.ajax({
			type: "post",
			url: "/perizinan/buatNoIzin",
			data: {
				tanggal:tanggal,
				jenisizin:jenisizin
			},
			dataType: "json",
			success: function(response){
				$('#noizin').val(response.noizin);
				
			},
			error: function(xhr, ajaxOptions, thrownError){
				alert(xhr.status +'\n'+ thrownError);
			}
		});
	}

	function kosong() {
		$('#nis').val('');
		$('#nisn').val('');
		$('#nama').val('');
		$('#kelas').val('');
		$('#kamar').val('');
		$('#nama_kamar').val('');
		$('#nama_kelas').val('');
		$('#keperluan').val('');
		$('#jenisizin').val('');
		$('#tgl_kembali').val('');
		$('#jam_kembali').val('');
		$("#img").attr("src", "");
		$('#nis').focus();

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
				url: "/perizinan/ambilDataSiswa",
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

	function tampilPriode() {
		$.ajax({
			url: "<?= site_url('perizinan/ambilDataPriode') ?>",
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
		tampilPriode();
		const Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000,
			timerProgressBar: true,
			didOpen: (toast) => {
				toast.addEventListener('mouseenter', Swal.stopTimer)
				toast.addEventListener('mouseleave', Swal.resumeTimer)
			}
		});

		$('body').addClass('sidebar-collapse');

		

		$('#tombolCariSiswa').click(function(e){
			e.preventDefault()
			$.ajax({
				url: "/perizinan/cariDataSiswa",
				dataType: "json",
				success: function(response){
					if (response.data) {
						$('.viewmodal').html(response.data).show();
						$('#modalsantri').modal('show');
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

		$('#btnBatalIzin').click(function(e){
			e.preventDefault();
			kosong();
			
		});

		$('#btnSimpanIzin').click(function(e){
			e.preventDefault();
			simpanIzin();

		});

		$('#jenisizin').change(function(e){
			e.preventDefault();
			buatNoIzin();
			let jenisizin = $(this).val();
			
			if (jenisizin == "") {
				$('#tgl_izin').addClass('show');
				$('#tgl_kembali').addClass('show');
				$('#tgl_izin').removeClass('hidden');
				$('#tgl_kembali').removeClass('hidden');

				$('#jam_izin').addClass('hidden');
				$('#jam_kembali').addClass('hidden');
				$('#jam_izin').removeClass('show');
				$('#jam_kembali').removeClass('show');

				$('#tgl_iz').removeClass('hidden');
				$('#tgl_kem').removeClass('hidden');
				$('#tgl_iz').addClass('show');
				$('#tgl_kem').addClass('show');

				$('#jam_iz').addClass('hidden');
				$('#jam_kem').addClass('hidden');
				$('#jam_iz').removeClass('show');
				$('#jam_kem').removeClass('show');

				

			} else if (jenisizin == "Pulang") {
				$('#tgl_izin').addClass('show');
				$('#tgl_kembali').addClass('show');
				$('#tgl_izin').removeClass('hidden');
				$('#tgl_kembali').removeClass('hidden');

				$('#jam_izin').addClass('hidden');
				$('#jam_kembali').addClass('hidden');
				$('#jam_izin').removeClass('show');
				$('#jam_kembali').removeClass('show');

				$('#tgl_iz').removeClass('hidden');
				$('#tgl_kem').removeClass('hidden');
				$('#tgl_iz').addClass('show');
				$('#tgl_kem').addClass('show');

				$('#jam_iz').addClass('hidden');
				$('#jam_kem').addClass('hidden');
				$('#jam_iz').removeClass('show');
				$('#jam_kem').removeClass('show');


				
			}else{
				$('#jam_izin').addClass('show');
				$('#jam_kembali').addClass('show');
				$('#jam_izin').removeClass('hidden');
				$('#jam_kembali').removeClass('hidden');

				$('#tgl_izin').addClass('hidden');
				$('#tgl_kembali').addClass('hidden');
				$('#tgl_izin').removeClass('show');
				$('#tgl_kembali').removeClass('show');

				$('#tgl_iz').removeClass('show');
				$('#tgl_kem').removeClass('show');
				$('#tgl_iz').addClass('hidden');
				$('#tgl_kem').addClass('hidden');

				$('#jam_iz').addClass('show');
				$('#jam_kem').addClass('show');
				$('#jam_iz').removeClass('hidden');
				$('#jam_kem').removeClass('hidden');
				
			}
		})

		
	});

	

	
</script>

<?= $this->endSection(); ?>