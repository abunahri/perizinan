<!-- Modal -->
<div class="modal fade" id="modaltambah" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Santri</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('santri/simpandata',['class' => 'formsantri']) ?>
      <?= csrf_field() ?>
      <input type="hidden" name="aksi" id="aksi" value="<?= $aksi; ?>">
      <div class="modal-body">
        <div class="form-group row">
          <label for="nis" class="col-sm-4 col-form-label">NIS</label>
          <div class="col-sm-8">
            <input type="text" name="nis" class="form-control" id="nis">
            <div class="invalid-feedback errorNis">
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="nisn" class="col-sm-4 col-form-label">NISN</label>
          <div class="col-sm-8">
            <input type="text" name="nisn" class="form-control" id="nisn">
            <div class="invalid-feedback errorNisn">
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="nama" class="col-sm-4 col-form-label">Nama Santri</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="nama" name="nama">
            <div class="invalid-feedback errorNama">
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="jenkel" class="col-sm-4 col-form-label">Jenkel</label>
          <div class="col-sm-8">
            <select name="jenkel" id="jenkel" class="form-control">
              <option value="">-Pilih-</option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
            <div class="invalid-feedback errorJenkel">
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="kelas" class="col-sm-4 col-form-label">Kelas</label>
          <div class="col-sm-8">
            <select name="kelas" id="kelas" class="form-control">
              <option value="">-Pilih-</option>
              
            </select>
            <div class="invalid-feedback errorKelas">
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="kamar" class="col-sm-4 col-form-label">Kamar</label>
          <div class="col-sm-8">
            <select name="kamar" id="kamar" class="form-control">
              <option value="">-Pilih-</option>
              
            </select>
            <div class="invalid-feedback errorKamar">
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="ortu" class="col-sm-4 col-form-label">Nama Wali</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="ortu" name="ortu">
            <div class="invalid-feedback errorOrtu">
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="tgl" class="col-sm-4 col-form-label">Alamat</label>
          <div class="col-sm-8">
            <textarea name="alamat" id="alamat" class="form-control"></textarea>
            <div class="invalid-feedback errorAlamat">
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="telp" class="col-sm-4 col-form-label">Telp/HP Wali</label>
          <div class="col-sm-8">
            <input type="number" class="form-control" id="telp" name="telp">
            <div class="invalid-feedback errorTelp">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btnsimpan">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    kelas();
    kamar()
    $('.formsantri').submit(function(e){
      e.preventDefault();
      $.ajax({
        type: "post",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: "json",
        beforeSend: function(){
          $('.btnsimpan').attr('disable','disabled');
          $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
        },
        complete: function(){
          $('.btnsimpan').removeAttr('disable','disabled');
          $('.btnsimpan').html('Simpan');
        },
        success: function(response){
          if (response.error) {
            if (response.error.nis) {
              $('#nis').addClass('is-invalid');
              $('.errorNis').html(response.error.nis);
            }else{
              $('#nis').removeClass('is-invalid');
              $('.errorNis').html('');
            }
            if (response.error.nisn) {
              $('#nisn').addClass('is-invalid');
              $('.errorNisn').html(response.error.nisn);
            }else{
              $('#nisn').removeClass('is-invalid');
              $('.errorNisn').html('');
            }
            if (response.error.nama) {
              $('#nama').addClass('is-invalid');
              $('.errorNama').html(response.error.nama);
            }else{
              $('#nama').removeClass('is-invalid');
              $('.errorNama').html('');
            }
            if (response.error.jenkel) {
              $('#jenkel').addClass('is-invalid');
              $('.errorJenkel').html(response.error.jenkel);
            }else{
              $('#jenkel').removeClass('is-invalid');
              $('.errorJenkel').html('');
            }
            if (response.error.kelas) {
              $('#kelas').addClass('is-invalid');
              $('.errorKelas').html(response.error.kelas);
            }else{
              $('#kelas').removeClass('is-invalid');
              $('.errorKelas').html('');
            }
            if (response.error.kamar) {
              $('#kamar').addClass('is-invalid');
              $('.errorKamar').html(response.error.kamar);
            }else{
              $('#kamar').removeClass('is-invalid');
              $('.errorKamar').html('');
            }

            if (response.error.ortu) {
              $('#ortu').addClass('is-invalid');
              $('.errorOrtu').html(response.error.ortu);
            }else{
              $('#ortu').removeClass('is-invalid');
              $('.errorOrtu').html('');
            }

            if (response.error.alamat) {
              $('#alamat').addClass('is-invalid');
              $('.errorAlamat').html(response.error.alamat);
            }else{
              $('#alamat').removeClass('is-invalid');
              $('.errorAlamat').html('');
            }
            if (response.error.telp) {
              $('#telp').addClass('is-invalid');
              $('.errorTelp').html(response.error.telp);
            }else{
              $('#telp').removeClass('is-invalid');
              $('.errorTelp').html('');
            }
          }else{
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
                  $('#modaltambah').modal('hide');
                  listdatasantri();
                }
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

  function kelas() {
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

  function kamar() {
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
</script>