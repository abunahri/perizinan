<?= $this->extend('layout/menu') ?>
<?= $this->section('judul') ?>
<h3>Manajemen Ganti Password</h3>
<?= $this->endSection() ?>

<?= $this->section('isi') ?>
<div class="card">
    <div class="card-header">
     <div class="card-header">
        <h3 class="card-title">
            form Ganti Password
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
        <?= form_open('utility/updatepassowrd', ['class' => 'frmupdatepassword']) ?>
        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-label">Password Lama</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" name="passlama" id="passlama" autocomplete="off">
                <div id="msg-passlama" class="invalid-feedback">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-label">Password Baru</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" name="passbaru" id="passbaru" autocomplete="off">
                <div id="msg-passbaru" class="invalid-feedback">
                </div>

            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-label">Confirm Password Baru</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" name="confirmpass" id="confirmpass" autocomplete="off">
                <div id="msg-confirmpass" class="invalid-feedback">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-label"></label>
            <div class="col-sm-4">
                <button type="submit" class="btn btn-success btnsimpan">
                    Ganti Password
                </button>
            </div>
        </div>

        <?= form_close() ?>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.frmupdatepassword').submit(function(e){
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                cache: false,
                beforesend: function(){
                    $('.btnsimpan').prop('disabled',true);
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner></i>');

                },
                complete: function(){
                    $('.btnsimpan').prop('disabled',false);
                    $('.btnsimpan').html('Ganti Password');
                },
                success: function(response){
                    if (response.error) {
                        let err = response.error;
                        if (err.passlama) {
                            $('#passlama').addClass('is-invalid');
                            $('#msg-passlama').html(err.passlama);
                        }else{
                            $('#passlama').removeClass('is-invalid');
                            $('#passlama').addClass('is-valid');
                            $('#msg-passlama').html('');
                        }
                        if (err.passbaru) {
                            $('#passbaru').addClass('is-invalid');
                            $('#msg-passbaru').html(err.passbaru);
                        }else{
                            $('#passbaru').removeClass('is-invalid');
                            $('#passbaru').addClass('is-valid');
                            $('#msg-passbaru').html('');
                        }
                        if (err.confirmpass) {
                            $('#confirmpass').addClass('is-invalid');
                            $('#msg-confirmpass').html(err.confirmpass);
                        }else{
                            $('#confirmpass').removeClass('is-invalid');
                            $('#confirmpass').addClass('is-valid');
                            $('#msg-confirmpass').html('');
                        }

                    }else{
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                            
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = '/login/keluar';
                            } 
                        });
                    }
                    

                },
                error: function(xhr, ajaxOptions, thrownError){
                    alert(xhr.status +'\n'+ thrownError);
                }
            });
            return false

        });
    });
</script>
<?= $this->endSection('isi') ?>