
<!-- Modal -->
<div class="modal fade" id="modalupload" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Ambil Foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('', ['class' => 'formupload']) ?>
      <input type="hidden" name="kode_musrif" id="kode_musrif" value="<?= $kode_musrif ?>">
      <div class="modal-body">
        <div class="form-group">
          <label for="">Upload Foto</label>
          <input type="file" name="foto" id="foto" class="form-control form-control-sm">
          <div class="invalid-feedback errorfoto">
          </div>
        </div>
        <div class="form-group">
          <label for="">Ambil Foto</label>
          <div id="my_camera">

          </div>
          &nbsp;
          <p>
            <button type="button" class="btn btn-sm btn-info" onclick="take_picture();">Ambil Gambar</button>
          </p>
        </div>
        <div class="form-group">
          <label for="">Capture</label>
          <div id="results">

          </div>
          <input type="hidden" name="imagecam" class="image-tag">

        </div>

      </div>
      
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btnupload">Upload Foto</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    $('.btnupload').click(function(e){
      e.preventDefault();
      let form = $('.formupload')[0];
      let data = new FormData(form);
      $.ajax({
        type: "post",
        url:"/musrif/doupload",
        data: data,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        cache: false,
        dataType: "json",
        beforeSend : function(e){
          $('.btnupload').prop('disabled', 'disabled');
          $('.btnupload').html(`<i class="fa fa-spin fa-spinner"></i>`);
        },
        complete : function(e){
          $('.btnupload').removeAttr('disabled');
          $('.btnupload').html(`Upload Foto`);
        },
        success: function(response){
          if (response.error) {
            if (response.error.foto) {
              $('#foto').addClass('is-invalid');
              $('.errorfoto').html(response.error.foto);
            }
            Swal.fire({
              icon: 'error',
              title: 'Maaf',
              text: response.error,
              
            });
          }else{
            Swal.fire({
              icon: 'success',
              title: 'Berhasil diupload',
              text: response.sukses,
              
            });
            $('#modalupload').modal('hide');
          }

        },
        error: function(xhr, ajaxOption, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
    })

  });

  
</script>
<script>
  Webcam.set({
    width: 320,
    height: 240,
    image_format: 'jpeg',
    jpeg_quality: 100
  });

  Webcam.attach('#my_camera');

  function take_picture(){
    Webcam.snap(function(data_uri){
      $(".image-tag").val(data_uri);

      document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
    })
  }
</script>
