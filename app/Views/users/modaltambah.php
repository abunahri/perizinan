<!-- Modal -->
<div class="modal fade" id="modaltambah" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('users/simpan', ['class' => 'frmsimpan']) ?>
      <div class="modal-body">
        <div class="form-group">
          <label for="">username</label>
          <input type="text" name="userid" id="userid" class="form-control form-control-sm" autocomplete="off">
          <div id="msg-userid" class="invalid-feedback">
          </div>
        </div>
        <div class="form-group">
          <label for="">Nama Lengkap</label>
          <input type="text" name="namalengkap" id="namalengkap" class="form-control form-control-sm" autocomplete="off">
          <div id="msg-namalengkap" class="invalid-feedback">
          </div>
        </div>

        <div class="form-group">
          <label for="">Level User</label>
          <select name="level" id="level" class="form-control">
            <option value="" selected>-- Pilih --</option>
            <?php foreach($datalevel->getResultArray() as $x) : ?>
              <option value="<?= $x['levelid'] ?>"><?= $x['levelnama'] ?></option>
            <?php endforeach; ?>

          </select>
          <div id="msg-level" class="invalid-feedback">
          </div>
          
        </div>
        <div class="form-group">
          <label for="jenkel">Jenkel</label>
          <select name="jenkel" id="jenkel" class="form-control">
            <option value="">-Pilih-</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
          <div id="msg-jenkel" class="invalid-feedback">
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
    $('.frmsimpan').submit(function(e){
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
          $('.btnsimpan').html('Simpan');
        },
        success: function(response){
          if (response.error) {
            let err = response.error;
            if (err.userid) {
              $('#userid').addClass('is-invalid');
              $('#msg-userid').html(err.userid);
            }else{
              $('#userid').removeClass('is-invalid');
              $('#userid').addClass('is-valid');
              $('#msg-userid').html('');
            }
            if (err.namalengkap) {
              $('#namalengkap').addClass('is-invalid');
              $('#msg-namalengkap').html(err.namalengkap);
            }else{
              $('#namalengkap').removeClass('is-invalid');
              $('#namalengkap').addClass('is-valid');
              $('#msg-namalengkap').html('');
            }
            if (err.level) {
              $('#level').addClass('is-invalid');
              $('#msg-level').html(err.level);
            }else{
              $('#level').removeClass('is-invalid');
              $('#level').addClass('is-valid');
              $('#msg-level').html('');
            }
            if (err.level) {
              $('#jenkel').addClass('is-invalid');
              $('#msg-jenkel').html(err.jenkel);
            }else{
              $('#jenkel').removeClass('is-invalid');
              $('#jenkel').addClass('is-valid');
              $('#msg-jenkel').html('');
            }

          }else{
            Swal.fire({
              icon: 'success',
              title: 'berhasil',
              text: response.sukses
            });
            $('#modaltambah').modal('hide');
            dataUser.ajax.reload();
          }

        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status +'\n'+ thrownError);
        }
      });
      return false

    })
  });
</script>