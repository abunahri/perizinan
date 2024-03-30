<?= $this->extend('layout/menu') ?>

<?= $this->section('judul') ?>
<h3><i class="fa fa-fw fa-table"></i> Form Edit Santri</h3>
<?= $this->endSection() ?>


<?= $this->section('isi') ?>

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
        <label for="nis" class="col-sm-4 col-form-label">NIS</label>
        <div class="col-sm-4">
            <input type="text" name="nis" class="form-control form-control-sm" id="nis" value="<?= $nis; ?>" readonly>
            <div class="invalid-feedback errorNis" style="display: none;">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="nisn" class="col-sm-4 col-form-label">NISN</label>
        <div class="col-sm-4">
            <input type="text" name="nisn" class="form-control form-control-sm" id="nisn" value="<?= $nisn; ?>" readonly>
            <div class="invalid-feedback errorNisn" style="display: none;">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="nama" class="col-sm-4 col-form-label">Nama Santri</label>
        <div class="col-sm-8">
            <input type="text" class="form-control form-control-sm" id="nama" name="nama" value="<?= $nama; ?>">
            <div class="invalid-feedback errorNama" style="display: none;">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="tmp_lahir" class="col-sm-4 col-form-label">Tempat Lahir</label>
        <div class="col-sm-8">
            <input type="text" class="form-control form-control-sm" id="tmp_lahir" name="tmp_lahir" value="<?= $tmp_lahir ?>">
            <div class="invalid-feedback errorTmp" style="display: none;">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="tgl_lahir" class="col-sm-4 col-form-label">Tanggal Lahir</label>
        <div class="col-sm-8">
            <input type="date" class="form-control form-control-sm" id="tgl_lahir" name="tgl_lahir" value="<?= $tgl_lahir ?>">
            <div class="invalid-feedback errorTgl" style="display: none;">
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
        <label for="kelas" class="col-sm-4 col-form-label">Kelas</label>
        <div class="col-sm-4">
            <select class="form-control form-control-sm" name="kelas" id="kelas">
                <?php
                foreach ($datakelas as $kls) :
                    if($kls['id_kelas'] == $santrikelas) :
                        echo "<option value=\"$kls[id_kelas]\" selected>$kls[nama_kelas]</option>";
                    else :
                        echo "<option value=\"$kls[id_kelas]\">$kls[nama_kelas]</option>";
                    endif;
                endforeach;
                ?>

            </select>
            <div class="invalid-feedback errorSatuan" style="display: none;">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="kamar" class="col-sm-4 col-form-label">Kamar</label>
        <div class="col-sm-4">
            <select name="kamar" id="kamar" class="form-control form-control-sm">
                <?php
                foreach ($datakamar as $k) :
                    if($k['id_kamar'] == $santrikamar) :
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
        <label for="musrif" class="col-sm-4 col-form-label">Musrif Kamar</label>
        <div class="col-sm-8">
            <input type="text" class="form-control form-control-sm" value="<?= $musrif ?>" id="musrif" name="musrif" readonly>
            <input type="hidden" class="form-control form-control-sm" value="<?= $kode_musrif ?>" id="kode_musrif" name="kode_musrif" readonly>
            <div class="invalid-feedback errorOrtu" style="display: none;">
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="ortu" class="col-sm-4 col-form-label">Nama Wali</label>
        <div class="col-sm-8">
            <input type="text" class="form-control form-control-sm" id="ortu" name="ortu" value="<?= $ortu ?>">
            <div class="invalid-feedback errorOrtu" style="display: none;">
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="tgl" class="col-sm-4 col-form-label">Alamat</label>
        <div class="col-sm-8">
            <textarea name="alamat" id="alamat" class="form-control form-control-sm"><?= $alamat ?></textarea>
            <div class="invalid-feedback errorAlamat" style="display: none;">
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="telp" class="col-sm-4 col-form-label">Telp/HP Wali</label>
        <div class="col-sm-4">
            <input type="number" class="form-control form-control-sm" id="telp" name="telp" value="<?= $telp ?>">
            <div class="invalid-feedback errorTelp" style="display: none;">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-4 col-form-label">Foto Santri</label>
        <div class="col-sm-4">
            <img src="<?= base_url($gambarsantri) ?>" style="width: 100%;" class="img-thumbnail">
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

    $(document).ready(function() {

        $('.tombolSimpanSantri').click(function(e) {
         e.preventDefault();
         let form = $('.formsimpan')[0];
         let data = new FormData(form);
         $.ajax({
            type: "post",
            url: "<?= site_url('santri/updatedata') ?>",
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

</script>
<?= $this->endSection() ?>