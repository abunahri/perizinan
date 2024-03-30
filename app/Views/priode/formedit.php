<div class="modal fade" id="modalformedit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalformeditLabel">Edit Tahun Ajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('priode/updatedata', ['class' => 'formsimpan']) ?>
            <input type="hidden" name="priode_id" id="priode_id" value="<?= $priode_id; ?>">
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Tahun</label>
                    <select name="tahun" id="tahun" class="form-control">
                        <?php $now = date('Y');
                        for ($i=2018; $i <= $now; $i++) { ?>
                            <option value="<?= $i ?>" <?= ($i == $tahun) ? 'selected' : '' ?>><?= $i ?></option>;
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Tahun Ajaran</label>
                    <input type="text" name="priode" id="priode" value="<?= $priode ?>" class="form-control form-control-sm"
                    required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary tombolUpdate">Update</button>
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
                    $('.tombolUpdate').prop('disabled', true);
                    $('.tombolUpdate').html('<i class="fa fa-spin fa-spinner"></i>')
                },
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
            return false;
        });
    });
</script>