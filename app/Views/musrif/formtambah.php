<?= $this->extend('layout/menu') ?>

<?= $this->section('judul') ?>
<h3><i class="fa fa-fw fa-table"></i> Form Tambah Musrif</h3>
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

.colored-toast .swal2-html-container {
    color: white;
}
</style>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <button type="button" class="btn btn-sm btn-warning"
            onclick="window.location='<?= site_url('musrif/index') ?>'">
            <i class="fa fa-backward"></i> Kembali
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
    <?= form_open_multipart('',['class' => 'formsimpan']) ?>
    <?= csrf_field() ?>
    
    <div class="form-group row">
        <label for="nis" class="col-sm-4 col-form-label">Kode Musrif</label>
        <div class="col-sm-4">
            <input type="text" name="kode" class="form-control form-control-sm" id="kode" onkeypress="return hanyaAngka(event)">
            <div class="invalid-feedback errorKode" style="display: none;">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="nisn" class="col-sm-4 col-form-label">Nama Musrif</label>
        <div class="col-sm-8">
            <input type="text" name="nama" class="form-control form-control-sm" id="nama" >
            <div class="invalid-feedback errorNama" style="display: none;">
            </div>
        </div>
    </div>
    
    <div class="form-group row">
        <label for="jenkel" class="col-sm-4 col-form-label">Jenkel</label>
        <div class="col-sm-4">
            <select name="jenkel" id="jenkel" class="form-control form-control-sm">
                <option value="">-Pilih-</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
            <div class="invalid-feedback errorJenkel" style="display: none;">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="tgl_lahir" class="col-sm-4 col-form-label">Telp Musrif</label>
        <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm" id="telp" name="telp" onkeypress="return hanyaAngka(event)">
            <div class="invalid-feedback errorTelp" style="display: none;">
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="kamar" class="col-sm-4 col-form-label">Kamar</label>
        <div class="col-sm-4">
            <select name="kamar" id="kamar" class="form-control form-control-sm">


            </select>
            <div class="invalid-feedback errorKamar" style="display: none;">
            </div>
        </div>
        <div class="col-sm-2">
            <button type="button" class="btn btn-sm btn-primary tombolTambahKamar">
                <i class="fa fa-plus-circle"></i>
            </button>
        </div>
    </div>
    <div class="form-group row">
        <label for="gambar" class="col-sm-4 col-form-label">Upload Foto (Jika Ada)</label>
        <div class="col-sm-4">
            <input type="file" name="gambar" id="gambar" class="form-control form-control-md"
            accept=".jpg,.jpeg,.png">
            <div class="invalid-feedback errorUpload" style="display: none;">
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label"></label>
        <div class="col-sm-4">
            <button type="submit" class="btn btn-success tombolSimpan">
                Simpan
            </button>
        </div>
    </div>
    <?= form_close(); ?>

</div>
</div>
<div class="viewmodal" style="display:none;"></div>
<script>

    function tampilKamar() {
        $.ajax({
            url: "<?= site_url('santri/ambilDataKamar') ?>",
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('#kamar').html(response.data);
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function kosong() {
        $('#kode').val('');
        $('#nama').val('');
        $('#jenkel').val('');
        $('#kamar').val('');
        $('#telp').val('');
        $('#gambar').val('');
        $('#kode').focus();

    }

    $(document).ready(function() {

        tampilKamar();

        $('.tombolTambahKamar').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('kamar/formTambah') ?>",
                dataType: "json",
                type: 'post',
                data: {
                    aksi: 1
                },
                success: function(response) {
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('#modaltambahkamar').on('shown.bs.modal', function(event) {
                            $('#namakamar').focus();
                        });
                        $('#modaltambahkamar').modal('show');
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

        $('.tombolSimpan').click(function(e) {
            e.preventDefault();
            let form = $('.formsimpan')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: "<?= site_url('musrif/simpandata') ?>",
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
                    $('.tombolSimpan').html('Simpan');
                    $('.tombolSimpan').prop('disabled', false);
                },

                success: function(response) {
                    if (response.error) {
                        let msg = response.error;
                        if (msg.errorKode) {
                            $('.errorKode').html(msg.errorKode).show();
                            $('#kode').addClass('is-invalid');
                        } else {
                            $('.errorKode').fadeOut();
                            $('#kode').removeClass('is-invalid');
                            $('#kode').addClass('is-valid');
                        }
                        if (msg.errorNama) {
                            $('.errorNama').html(msg.errorNama).show();
                            $('#nama').addClass('is-invalid');
                        } else {
                            $('.errorNama').fadeOut();
                            $('#nama').removeClass('is-invalid');
                            $('#nama').addClass('is-valid');
                        }

                        if (msg.errorJenkel) {
                            $('.errorJenkel').html(msg.errorJenkel).show();
                            $('#jenkel').addClass('is-invalid');
                        } else {
                            $('.errorJenkel').fadeOut();
                            $('#jenkel').removeClass('is-invalid');
                            $('#jenkel').addClass('is-valid');
                        }

                        if (msg.errorKamar) {
                            $('.errorKamar').html(msg.errorKamar).show();
                            $('#kamar').addClass('is-invalid');
                        } else {
                            $('.errorKamar').fadeOut();
                            $('#kamar').removeClass('is-invalid');
                            $('#kamar').addClass('is-valid');
                        }

                        if (msg.errorTelp) {
                            $('.errorTelp').html(msg.errorTelp).show();
                            $('#telp').addClass('is-invalid');
                        } else {
                            $('.errorTelp').fadeOut();
                            $('#telp').removeClass('is-invalid');
                            $('#telp').addClass('is-valid');
                        }

                        if (msg.errorUpload) {
                            $('.errorUpload').html(msg.errorUpload).show();
                            $('#gambar').addClass('is-invalid');
                        }else{
                            $('.errorUpload').fadeOut();
                            $('#gambar').removeClass('is-invalid');
                            $('#gambar').addClass('is-valid');
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
                        Toast.fire({
                            icon: 'success',
                            title: response.sukses

                        });
                        kosong();

                    }

                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }

            });
});

});

function hanyaAngka(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))

    return false;
return true;
}

</script>
<?= $this->endSection() ?>