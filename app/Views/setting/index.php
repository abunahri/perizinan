<?= $this->extend('layout/menu') ?>

<?= $this->section('judul') ?>
<h3><i class="fa fa-fw fa-table"></i> Setting Aplikasi</h3>
<?= $this->endSection() ?>


<?= $this->section('isi') ?>

<div class="row">
	<div class="col-md-6">
		<?= form_open_multipart('',['class' => 'formsimpan']) ?>
		<?= csrf_field() ?>
		<div class="card card-default">
			<div class="card-body">
				<div class="form-group">
					<label for="exampleInputEmail1">Nama Sekolah</label>
					<input type="hidden" class="form-control" id="setting_id" name="setting_id" value="<?= $setting['setting_id'] ?>">
					<input type="text" class="form-control" id="nama" name="nama" value="<?= $setting['nama_sekolah'] ?>">
					<div class="invalid-feedback errorNama" style="display: none;">
					</div>

				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Nama Aplikasi</label>

					<input type="text" class="form-control" id="app" name="app" value="<?= $setting['app_nama'] ?>">
					<div class="invalid-feedback errorApp" style="display: none;">
					</div>

				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Alamat Sekolah</label>
					<input type="text" class="form-control" id="alamat" name="alamat" value="<?= $setting['alamat'] ?>">
					<div class="invalid-feedback errorAlamat" style="display: none;">
					</div>

				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Nama Kecamatan</label>
					<input type="text" class="form-control" id="kec" name="kec" value="<?= $setting['kec'] ?>">
					<div class="invalid-feedback errorKec" style="display: none;">
					</div>

				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Nama Kota/Kab</label>
					<input type="text" class="form-control" id="kota" name="kota" value="<?= $setting['kab'] ?>">
					<div class="invalid-feedback errorKota" style="display: none;">
					</div>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Telephone</label>
					<input type="text" class="form-control" id="telp" name="telp" value="<?= $setting['telp'] ?>">
					<div class="invalid-feedback errorTelp" style="display: none;">
					</div>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Nama Kepsek</label>
					<input type="text" class="form-control" id="kepsek" name="kepsek" value="<?= $setting['kepsek'] ?>">
					<div class="invalid-feedback errorKepsek" style="display: none;">
					</div>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Nip Kepsek</label>
					<input type="text" class="form-control" id="nip" name="nip" value="<?= $setting['nip'] ?>">
					<div class="invalid-feedback errorNip" style="display: none;">
					</div>
				</div>
				
				
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card card-default">
			<div class="card-body">
				<div class="form-group">
					<label>Cap Dan TTD Kepsek</label>
					<div class="col-sm-4">
						<img src="<?= base_url() .'/'. $setting['cap'] ?>" style="width: 100%;" class="img-thumbnail">
					</div>

				</div>
				<div class="form-group">
					<label></label>
					<input type="file" name="cap" id="cap" class="form-control form-control-md"
					accept=".jpg,.jpeg,.png">
					<div class="invalid-feedback errorCap" style="display: none;">
					</div>

				</div>

				<div class="form-group">
					<label>Logo</label>
					<div class="col-sm-4">
						<img src="<?= base_url() .'/'. $setting['logo'] ?>" style="width: 100%;" class="img-thumbnail">
					</div>

				</div>
				<div class="form-group">
					<label></label>
					<input type="file" name="logo" id="logo" class="form-control form-control-md"
					accept=".jpg,.jpeg,.png">
					<div class="invalid-feedback errorLogo" style="display: none;">
					</div>

				</div>
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary tombolSimpan">
						<i class="fa fa-save"></i> Simpan Konfigurasi
					</button>
				</div>
			</div>

		</div>
		<?= form_close() ?>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.tombolSimpan').click(function(e) {
			e.preventDefault();
			let form = $('.formsimpan')[0];
			let data = new FormData(form);
			$.ajax({
				type: "post",
				url: "/setting/updateSetting",
				data: data,
				dataType: "json",
				enctype: 'multipart/form-data',
				processData: false,
				contentType: false,
				cache: false,
				beforeSend: function() {
					$('.tombolSimpan').html('<i class="fa fa-spin fa-spinner"></i>');
					$('.tombolSimpan').prop('disabled', true);
				},
				complete: function() {
					$('.tombolSimpan').html('Simpan Konfigurasi');
					$('.tombolSimpan').prop('disabled', false);
				},

				success: function(response) {
					if (response.error) {
						let msg = response.error;
						if (msg.errorNama) {
							$('.errorNama').html(msg.errorNama).show();
							$('#nama').addClass('is-invalid');
						} else {
							$('.errorNama').fadeOut();
							$('#nama').removeClass('is-invalid');
							$('#nama').addClass('is-valid');
						}
						if (msg.errorApp) {
							$('.errorApp').html(msg.errorApp).show();
							$('#app').addClass('is-invalid');
						} else {
							$('.errorApp').fadeOut();
							$('#app').removeClass('is-invalid');
							$('#app').addClass('is-valid');
						}

						if (msg.errorAlamat) {
							$('.errorAlamat').html(msg.errorAlamat).show();
							$('#alamat').addClass('is-invalid');
						}else{
							$('.errorAlamat').fadeOut();
							$('#alamat').removeClass('is-invalid');
							$('#alamat').addClass('is-valid');
						}

						if (msg.errorKec) {
							$('.errorKec').html(msg.errorKec).show();
							$('#kec').addClass('is-invalid');
						}else{
							$('.errorKec').fadeOut();
							$('#kec').removeClass('is-invalid');
							$('#kec').addClass('is-valid');
						}

						if (msg.errorKota) {
							$('.errorKota').html(msg.errorKota).show();
							$('#kota').addClass('is-invalid');
						}else{
							$('.errorKota').fadeOut();
							$('#kota').removeClass('is-invalid');
							$('#kota').addClass('is-valid');
						}
						if (msg.errorTelp) {
							$('.errorTelp').html(msg.errorTelp).show();
							$('#telp').addClass('is-invalid');
						}else{
							$('.errorTelp').fadeOut();
							$('#telp').removeClass('is-invalid');
							$('#telp').addClass('is-valid');
						}
						if (msg.errorKepsek) {
							$('.errorKepsek').html(msg.errorKepsek).show();
							$('#kepsek').addClass('is-invalid');
						}else{
							$('.errorKepsek').fadeOut();
							$('#kepsek').removeClass('is-invalid');
							$('#kepsek').addClass('is-valid');
						}
						if (msg.errorNip) {
							$('.errorNip').html(msg.errorNip).show();
							$('#nip').addClass('is-invalid');
						}else{
							$('.errorNip').fadeOut();
							$('#nip').removeClass('is-invalid');
							$('#nip').addClass('is-valid');
						}

					}else{
						Swal.fire({
							icon: 'success',
							title: 'Berhasil',
							html: response.sukses,

						}).then((result) => {

							if (result.isConfirmed) {
								window.location.href="/setting/index";
							} 
						});

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