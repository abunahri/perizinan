<?= $this->extend('layout/menu') ?>

<?= $this->section('judul') ?>
<h3><i class="fa fa-fw fa-table"></i> Form Edit Musrif</h3>
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
            <input type="text" name="kode" class="form-control form-control-sm" id="kode" onkeypress="return hanyaAngka(event)" value="<?= $kode ?>" readonly>
            <div class="invalid-feedback errorKode" style="display: none;">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="nisn" class="col-sm-4 col-form-label">Nama Musrif</label>
        <div class="col-sm-8">
            <input type="text" name="nama" class="form-control form-control-sm" id="nama" value="<?= $nama ?>">
            <div class="invalid-feedback errorNama" style="display: none;">
            </div>
        </div>
    </div>
    
    <div class="form-group row">
        <label for="jenkel" class="col-sm-4 col-form-label">Jenkel</label>
        <div class="col-sm-4">
            <select name="jenkel" id="jenkel" class="form-control form-control-sm">
                <option value="Laki-laki" <?php if($jenkel == 'Laki-laki') echo "selected"; ?>>Laki-laki</option>
                <option value="Perempuan" <?php if($jenkel == 'Perempuan') echo "selected"; ?>>Perempuan</option>
            </select>
            <div class="invalid-feedback errorJenkel" style="display: none;">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="tgl_lahir" class="col-sm-4 col-form-label">Telp Musrif</label>
        <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm" id="telp" name="telp" onkeypress="return hanyaAngka(event)" value="<?= $telp ?>">
            <div class="invalid-feedback errorTelp" style="display: none;">
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="kamar" class="col-sm-4 col-form-label">Kamar</label>
        <div class="col-sm-4">
            <select name="kamar" id="kamar" class="form-control form-control-sm">
                <?php
                foreach ($datakamar as $k) :
                    if($k['id_kamar'] == $kamar) :
                        echo "<option value=\"$k[id_kamar]\" selected>$k[nama_kamar]</option>";
                    else :
                        echo "<option value=\"$k[id_kamar]\">$k[nama_kamar]</option>";
                    endif;
                endforeach;
                ?>
            </select>
            <div class="invalid-feedback errorKamar" style="display: none;">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Foto Musrif</label>
        <div class="col-sm-4">
            <img src="<?= base_url($gambar) ?>" style="width: 100%;" class="img-thumbnail">
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

    $(document).ready(function() {

     $('.tombolSimpan').click(function(e) {
         e.preventDefault();
         let form = $('.formsimpan')[0];
         let data = new FormData(form);
         $.ajax({
            type: "post",
            url: "<?= site_url('musrif/updatedata') ?>",
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
                $('.tombolSimpan').html('Update');
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

                    if (msg.errorJenkel) {
                        $('.errorJenkel').html(msg.errorJenkel).show();
                        $('#jenkel').addClass('is-invalid');
                    } else {
                        $('.errorJenkel').fadeOut();
                        $('#jenkel').removeClass('is-invalid');
                        $('#jenkel').addClass('is-valid');
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
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: response.sukses,

                    }).then((result) => {

                        if (result.isConfirmed) {
                            window.location.reload()
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

    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
    return true;
}

</script>
<?= $this->endSection() ?>