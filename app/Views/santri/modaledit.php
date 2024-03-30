<!-- Modal -->
<div class="modal fade" id="modaledit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Santri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <?= form_open('santri/updatedata',['class' => 'formsantri']) ?>
          <?= csrf_field() ?>
          <div class="modal-body">
            <div class="form-group row">
                <label for="nis" class="col-sm-4 col-form-label">NIS</label>
                <div class="col-sm-8">
                    <input type="text" name="nis" class="form-control" id="nis" value="<?= $nis ?>" readonly>
                    <div class="invalid-feedback errorNis">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="nisn" class="col-sm-4 col-form-label">NISN</label>
                <div class="col-sm-8">
                    <input type="text" name="nisn" class="form-control" id="nisn" value="<?= $nisn ?>" readonly>
                    <div class="invalid-feedback errorNisn">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-4 col-form-label">Nama</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $nama ?>">
                    <div class="invalid-feedback errorNama">
                    </div>
                </div>
            </div>
            
            <div class="form-group row">
                <label for="jenkel" class="col-sm-4 col-form-label">Jenkel</label>
                <div class="col-sm-8">
                    <select name="jenkel" id="jenkel" class="form-control">
                        <option value="Laki-laki" <?php if($jenkel == 'Laki-laki') echo "selected"; ?>>Laki-laki</option>
                        <option value="Perempuan" <?php if($jenkel == 'Perempuan') echo "selected"; ?>>Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="kelas" class="col-sm-4 col-form-label">Kelas</label>
                <div class="col-sm-8">
                    <select name="kelas" id="kelas" class="form-control">

                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="kelas" class="col-sm-4 col-form-label">Kelas</label>
                <div class="col-sm-8">
                    <select name="kelas" id="kelas" class="form-control">
                        <?php
                        foreach ($datakelas as $kls) :
                            if($k['santri_idkelas'] == $santrikelas) :
                                echo "<option value=\"$k[id_kelas]\" selected>$k[nama_kelas]</option>";
                            else :
                                echo "<option value=\"$k[id_kelas]\">$k[id_kelas]</option>";
                            endif;
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>


            <div class="form-group row">
                <label for="inputPassword" class="col-sm-4 col-form-label">Nama Wali</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="ortu" name="ortu" value="<?= $ortu ?>">
                    <div class="invalid-feedback errorOrtu">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="tgl" class="col-sm-4 col-form-label">Alamat</label>
                <div class="col-sm-8">
                    <textarea name="alamat" id="alamat" class="form-control"><?= $alamat ?></textarea>
                    <div class="invalid-feedback errorAlamat">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="telp" class="col-sm-4 col-form-label">Telp</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="telp" name="telp" value="<?= $telp ?>">
                    <div class="invalid-feedback errorTelp">
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btnsimpan">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      <?= form_close() ?>
  </div>
</div>
</div>
<script>
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
        $('.btnsimpan').html('Update');
    },
    success: function(response){

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
</script>