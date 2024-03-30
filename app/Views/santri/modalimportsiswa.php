<div class="modal fade" id="modalimportsiswa">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Import Data Santri</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open_multipart('',['class' => 'formupload']) ?>
			<?= csrf_field() ?>
			<div class="modal-body">
				<label>File Excel</label>
				<div class="custom-file">

					<input type="file" name="file_excel" class="custom-file-input" id="file_excel" required>
					<label for="file_excel" class="custom-file-label">Pilih File</label>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary" id="importFile">Submit</button>
			</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {

		$('#importFile').click(function(e) {
			e.preventDefault();
			let form = $('.formupload')[0];
			let data = new FormData(form);
			$.ajax({
				type: "post",
				url: "/santri/import",
				data: data,
				dataType: "json",
				enctype: 'multipart/form-data',
				processData: false,
				contentType: false,
				cache: false,

				success: function(response) {
					if (response.sukses) {
						Swal.fire({
							icon: 'success',
							title: 'Berhasil',
							html: response.sukses,
						}).then((result) => {
							if (result.isConfirmed) {
								$('#modalimportsiswa').modal('hide');
								window.location.reload();
							} 
						});
					}
					if (response.error) {
						Swal.fire('Error',response.error,'error');
					}

				},
				error: function(xhr, thrownError) {
					alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
				}

			});
		});

	});
</script>