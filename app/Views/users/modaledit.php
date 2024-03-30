<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<!-- Modal -->
<div class="modal fade" id="modaledit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('users/update', ['class' => 'frmsimpan']) ?>
      <div class="modal-body">
        <div class="form-group">
          <label for="">username</label>
          <input type="text" name="userid" id="userid" class="form-control form-control-sm" autocomplete="off" value="<?= $userid ?>" readonly>
        </div>
        <div class="form-group">
          <label for="">Nama Lengkap</label>
          <input type="text" name="namalengkap" id="namalengkap" class="form-control form-control-sm" autocomplete="off" value="<?= $namalengkap ?>">
        </div>
        <div class="form-group">
          <label for="">Level User</label>
          <select name="level" id="level" class="form-control">
            <?php foreach($datalevel->getResultArray() as $x) : ?>
              <?php if ($level == $x['levelid']): ?>
               <option selected value="<?= $x['levelid'] ?>"><?= $x['levelnama'] ?></option>
             <?php else: ?>
               <option value="<?= $x['levelid'] ?>"><?= $x['levelnama'] ?></option>
             <?php endif ?>
           <?php endforeach; ?>
         </select>
       </div>
       <div class="form-group">
        <label for="jenkel">Jenkel</label>
        <select name="jenkel" id="jenkel" class="form-control">
          <option value="">-Pilih-</option>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
        <div id="msg-level" class="invalid-feedback">
        </div>
      </div>
      
      <div class="form-group">
        <label for="">Status User  :</label>
        <input type="checkbox" <?= ($status == '1') ? 'checked' : '' ?> data-toggle="toggle" data-on="Active" data-off="Non Active" data-onstyle="success" data-offstyle="danger" data-width="150" data-size="xs" class="chStatus">
      </div>

      <div class="form-group viewresetPassword" style="display:none;">
        <label for="">Password baru anda  :</label>
        <br>
        <h3 class="passreset"></h3>
      </div>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn bg-purple btnreset">
        Reset Password
      </button>
      <button type="submit" class="btn btn-danger btnhapus">Hapus</button>
      <button type="submit" class="btn btn-primary btnsimpan">Update</button>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
    <?= form_close() ?>
  </div>
</div>
</div>
<script>
  $(document).ready(function() {
    $('.btnreset').click(function(e){
      e.preventDefault();
      let iduser = $('#userid').val();
      // let username = $('#username').val();
      Swal.fire({
        title: 'Reset Password',
        html: `Yakin User <strong>${iduser}</strong> ini direset password`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Reset!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "post",
            url:"/users/resetPassword",
            data: {
              iduser: iduser
            },
            dataType: "json",
            success: function(response){
              if (response.sukses == '') {
                $('.viewresetPassword').show();
                $('.passreset').html(response.passwordBaru);
              }
              
            }
          });
        }
      })
      
    });

    $('.btnhapus').click(function(e){
      e.preventDefault();
      let iduser = $('#userid').val();
      let username = $('#username').val();
      Swal.fire({
        title: 'Hapus User',
        html: `Yakin User <strong>${username}</strong> ini dihapus`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "post",
            url:"/users/hapus",
            data: {
              iduser: iduser
            },
            dataType: "json",
            success: function(response){
              if (response.sukses) {
                Swal.fire({
                  icon: 'success',
                  title: 'berhasil',
                  text: response.sukses,
                  
                });
                $('#modaledit').modal('hide');
                dataUser.ajax.reload();
              }
              
            }
          });
        }
      })
      
    });

    $('.chStatus').change(function(e){
      e.preventDefault();
      $.ajax({
        type: "post",
        url:"/users/updateStatus",
        data: {
          iduser: $('#userid').val()
        },
        dataType: "json",
        success: function(response){
          if (response.sukses == '') {
            dataUser.ajax.reload();
          }

        }
      });

    });

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
          $('.btnsimpan').html('Update');
        },
        success: function(response){
          Swal.fire({
            icon: 'success',
            title: 'berhasil',
            text: response.sukses
          });
          $('#modaledit').modal('hide');
          dataUser.ajax.reload();

        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status +'\n'+ thrownError);
        }
      });
      return false

    });
  });
</script>