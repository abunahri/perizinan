<div class="modal fade" id="modaltambahkelas" tabindex="-1" aria-labelledby="modaltambahkelasLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modaltambahkelasLabel">Tambah Kelas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?= form_open('kelas/simpandata', ['class' => 'formsimpan']) ?>
        <?= csrf_field() ?>
        <input type="hidden" name="aksi" id="aksi" value="<?= $aksi; ?>">
        <div class="modal-body">
            <div class="form-group">
                <label for="">Nama Kelas</label>
                <input type="text" name="namakelas" id="namakelas" class="form-control form-control-sm" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary tombolSimpan">Simpan</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        <?= form_close(); ?>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        $('.formsimpan').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function(e) {
                    $('.tombolSimpan').prop('disabled', true);
                    $('.tombolSimpan').html('<i class="fa fa-spin fa-spinner"></i>')
                },
                success: function(response) {
                    let aksi = $('#aksi').val();
                    if (response.sukses) {
                        if (aksi == 0) {
                            Swal.fire(
                                'Berhasil',
                                response.sukses,
                                'success'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    }
                                });
                            } else {
                                $('#modaltambahkelas').modal('hide');
                                tampilKelas();
                            }
                        }
                    },
                    error: function(xhr, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            return false;
        });
    });
</script>