<?= $this->extend('layout/menu') ?>

<?= $this->section('judul') ?>
<h3><i class="fa fa-fw fa-table"></i> Form Tambah Santri</h3>
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
            onclick="window.location='<?= site_url('santri/index') ?>'">
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
        <label for="nis" class="col-sm-4 col-form-label">NIS </label>
        <div class="col-sm-4">
            <input type="text" name="nis" class="form-control form-control-sm" id="nis" onkeypress="return hanyaAngka(event)">
            <div class="invalid-feedback errorNis" style="display: none;">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="nisn" class="col-sm-4 col-form-label">NISN</label>
        <div class="col-sm-4">
            <input type="text" name="nisn" class="form-control form-control-sm" id="nisn" onkeypress="return hanyaAngka(event)">
            <div class="invalid-feedback errorNisn" style="display: none;">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="nama" class="col-sm-4 col-form-label">Nama Santri</label>
        <div class="col-sm-8">
            <input type="text" class="form-control form-control-sm" id="nama" name="nama">
            <div class="invalid-feedback errorNama" style="display: none;">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="tmp_lahir" class="col-sm-4 col-form-label">Tempat Lahir</label>
        <div class="col-sm-8">
            <input type="text" class="form-control form-control-sm" id="tmp_lahir" name="tmp_lahir">
            <div class="invalid-feedback errorTmp" style="display: none;">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="tgl_lahir" class="col-sm-4 col-form-label">Tanggal Lahir</label>
        <div class="col-sm-8">
            <input type="date" class="form-control form-control-sm" id="tgl_lahir" name="tgl_lahir">
            <div class="invalid-feedback errorTgl" style="display: none;">
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
        <label for="kelas" class="col-sm-4 col-form-label">Kelas</label>
        <div class="col-sm-4">
            <select class="form-control form-control-sm" name="kelas" id="kelas">

            </select>
            <div class="invalid-feedback errorSatuan" style="display: none;">
            </div>
        </div>
        <div class="col-sm-2">
            <button type="button" class="btn btn-sm btn-primary tombolTambahKelas">
                <i class="fa fa-plus-circle"></i>
            </button>
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
        <label for="musrif" class="col-sm-4 col-form-label">Musrif Kamar</label>
        <div class="col-sm-8">
            <input type="text" class="form-control form-control-sm" id="musrif" name="musrif" readonly>
            <input type="hidden" class="form-control form-control-sm" id="kode_musrif" name="kode_musrif" readonly>
            <div class="invalid-feedback errorMusrif" style="display: none;">
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="ortu" class="col-sm-4 col-form-label">Nama Wali</label>
        <div class="col-sm-8">
            <input type="text" class="form-control form-control-sm" id="ortu" name="ortu">
            <div class="invalid-feedback errorOrtu" style="display: none;">
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="tgl" class="col-sm-4 col-form-label">Alamat</label>
        <div class="col-sm-8">
            <textarea name="alamat" id="alamat" class="form-control form-control-sm"></textarea>
            <div class="invalid-feedback errorAlamat" style="display: none;">
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="telp" class="col-sm-4 col-form-label">Telp/HP Wali</label>
        <div class="col-sm-4">
            <input type="number" class="form-control form-control-sm" id="telp" name="telp" onkeypress="return hanyaAngka(event)">
            <div class="invalid-feedback errorTelp" style="display: none;">
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="uploadgambar" class="col-sm-4 col-form-label">Upload Foto (Jika Ada)</label>
        <div class="col-sm-4">
            <input type="file" name="uploadgambar" id="uploadgambar" class="form-control form-control-md"
            accept=".jpg,.jpeg,.png">
            <div class="invalid-feedback errorUpload" style="display: none;">
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="uploadgambar" class="col-sm-4 col-form-label"></label>
        <div class="col-sm-4">
            <button type="submit" class="btn btn-success tombolSimpanSantri">
                Simpan
            </button>
        </div>
    </div>
    <?= form_close(); ?>

</div>
</div>
<div class="viewmodal" style="display:none;"></div>
<script>

    function tampilKelas() {
        $.ajax({
            url: "<?= site_url('santri/ambilDataKelas') ?>",
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('#kelas').html(response.data);
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    $('#kamar').change(function(){
        if($(this).val() !== '') {
            $.ajax({
                url: "<?= site_url('santri/data_kamar'); ?>",
                type: "POST",
                cache: false,
                data: "kamar="+$(this).val(),
                dataType:'json',
                success: function(data){
                    $('#musrif').val(data.nama_musrif);
                    $('#kode_musrif').val(data.kode_musrif);
                }
            });
        } else {
            $('#musrif').val("");
            $('#kode_musrif').val("");
        }
    });

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
        $('#nis').val('');
        $('#nisn').val('');
        $('#nama').val('');
        $('#jenkel').val('');
        $('#kelas').val('');
        $('#kamar').val('');
        $('#ortu').val('');
        $('#tmp_lahir').val('');
        $('#tgl_lahir').val('');
        $('#alamat').val('');
        $('#telp').val('');
        $('#uploadgambar').val('');
        $('#nis').focus();

    }

    $(document).ready(function() {
        tampilKelas();
        tampilKamar();


        $('.tombolTambahKelas').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('kelas/formTambah') ?>",
                dataType: "json",
                type: 'post',
                data: {
                    aksi: 1
                },
                success: function(response) {
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('#modaltambahkelas').on('shown.bs.modal', function(event) {
                            $('#namakelas').focus();
                        });
                        $('#modaltambahkelas').modal('show');
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

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

        $('.tombolSimpanSantri').click(function(e) {
            e.preventDefault();
            let form = $('.formsimpan')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: "<?= site_url('santri/simpandata') ?>",
                data: data,
                dataType: "json",
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function() {
                    $('.tombolSimpanSantri').html('<i class="fa fa-spin fa-spinner"></i>');
                    $('.tombolSimpanSantri').prop('disabled', true);
                },
                complete: function() {
                    $('.tombolSimpanSantri').html('Simpan');
                    $('.tombolSimpanSantri').prop('disabled', false);
                },

                success: function(response) {
                    if (response.error) {
                        let msg = response.error;
                        if (msg.errorNis) {
                            $('.errorNis').html(msg.errorNis).show();
                            $('#nis').addClass('is-invalid');
                        } else {
                            $('.errorNis').fadeOut();
                            $('#nis').removeClass('is-invalid');
                            $('#nis').addClass('is-valid');
                        }

                        if (msg.errorNisn) {
                            $('.errorNisn').html(msg.errorNisn).show();
                            $('#nisn').addClass('is-invalid');
                        } else {
                            $('.errorNisn').fadeOut();
                            $('#nisn').removeClass('is-invalid');
                            $('#nisn').addClass('is-valid');
                        }

                        if (msg.errorNama) {
                            $('.errorNama').html(msg.errorNama).show();
                            $('#nama').addClass('is-invalid');
                        } else {
                            $('.errorNama').fadeOut();
                            $('#nama').removeClass('is-invalid');
                            $('#nama').addClass('is-valid');
                        }
                        if (msg.errorTmp) {
                            $('.errorTmp').html(msg.errorTmp).show();
                            $('#tmp_lahir').addClass('is-invalid');
                        } else {
                            $('.errorTmp').fadeOut();
                            $('#tmp_lahir').removeClass('is-invalid');
                            $('#tmp_lahir').addClass('is-valid');
                        }
                        if (msg.errorTgl) {
                            $('.errorTgl').html(msg.errorTgl).show();
                            $('#tgl_lahir').addClass('is-invalid');
                        } else {
                            $('.errorTgl').fadeOut();
                            $('#tgl_lahir').removeClass('is-invalid');
                            $('#tgl_lahir').addClass('is-valid');
                        }

                        if (msg.errorJenkel) {
                            $('.errorJenkel').html(msg.errorJenkel).show();
                            $('#jenkel').addClass('is-invalid');
                        } else {
                            $('.errorJenkel').fadeOut();
                            $('#jenkel').removeClass('is-invalid');
                            $('#jenkel').addClass('is-valid');
                        }

                        if (msg.errorKelas) {
                            $('.errorKelas').html(msg.errorKelas).show();
                            $('#kelas').addClass('is-invalid');
                        } else {
                            $('.errorKelas').fadeOut();
                            $('#kelas').removeClass('is-invalid');
                            $('#kelas').addClass('is-valid');
                        }

                        if (msg.errorKamar) {
                            $('.errorKamar').html(msg.errorKamar).show();
                            $('#kamar').addClass('is-invalid');
                        } else {
                            $('.errorKamar').fadeOut();
                            $('#kamar').removeClass('is-invalid');
                            $('#kamar').addClass('is-valid');
                        }

                        if (msg.errorOrtu) {
                            $('.errorOrtu').html(msg.errorOrtu).show();
                            $('#ortu').addClass('is-invalid');
                        } else {
                            $('.errorOrtu').fadeOut();
                            $('#ortu').removeClass('is-invalid');
                            $('#ortu').addClass('is-valid');
                        }

                        if (msg.errorAlamat) {
                            $('.errorAlamat').html(msg.errorAlamat).show();
                            $('#alamat').addClass('is-invalid');
                        } else {
                            $('.errorAlamat').fadeOut();
                            $('#alamat').removeClass('is-invalid');
                            $('#alamat').addClass('is-valid');
                        }

                        if (msg.errorTelp) {
                            $('.errorTelp').html(msg.errorTelp).show();
                            $('#alamat').addClass('is-invalid');
                        } else {
                            $('.errorTelp').fadeOut();
                            $('#alamat').removeClass('is-invalid');
                            $('#alamat').addClass('is-valid');
                        }

                        if (msg.errorUpload) {
                            $('.errorUpload').html(msg.errorUpload).show();
                            $('#uploadgambar').addClass('is-invalid');
                        }else{
                            $('.errorUpload').fadeOut();
                            $('#uploadgambar').removeClass('is-invalid');
                            $('#uploadgambar').addClass('is-valid');
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