<!-- Modal -->
<div class="modal fade" id="modaltambahbanyak" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Santri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <?= form_open('santri/simpandatabanyak', ['class' => 'formsimpanbanyak']) ?>
          <?= csrf_field() ?>

          <div class="modal-body">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>Nama Santri</th>
                        <th>Kelas</th>
                        <th>Jenkel</th>
                        <th>Alamat</th>
                        <th>Telp</th>
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody class="formtambah">

                    <tr>
                        <td>
                            <input type="text" name="nis[]" class="form-control" required>
                        </td>
                        <td>
                            <input type="text" name="nisn[]" class="form-control" required>
                        </td>

                        <td>
                            <input type="text" name="nama[]" class="form-control" required>
                        </td>

                        <td>
                            <input type="text" name="kelas[]" class="form-control" required>
                        </td>

                        <td>
                            <select name="jenkel[]" class="form-control">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select> 
                        </td>
                        <td>
                            <textarea name="alamat[]" class="form-control" required></textarea>
                        </td>

                        <td>
                            <input type="number" name="telp[]" class="form-control" required>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary btnaddform">
                                <i class="fa fa-plus"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary btnsimpanbanyak"><i class="fa fa-save"></i> Simpan</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        <?= form_close() ?>
    </div>
</div>
</div>

<script>

    $('document').ready(function(){
        $('.formsimpanbanyak').submit(function(e){
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function(){
                    $('.btnsimpanbanyak').attr('disable','disabled');
                    $('.btnsimpanbanyak').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function(){
                    $('.btnsimpanbanyak').removeAttr('disable','disabled');
                    $('.btnsimpanbanyak').html('Simpan');
                },
                success: function(response){
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            html: `${response.sukses}`,
                        }).then((result) => {
                            if (result.value) {
                                window.location.href=("<?= site_url('santri') ?>");
                            }
                        })

                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }

            });
            return false;

        });


        $('.btnaddform').click(function(e){
            e.preventDefault();

            $('.formtambah').append(`
                <tr>
                <td>
                <input type="text" name="nis[]" class="form-control" required>
                </td>
                <td>
                <input type="text" name="nisn[]" class="form-control" required>
                </td>

                <td>
                <input type="text" name="nama[]" class="form-control" required>
                </td>

                <td>
                <input type="text" name="kelas[]" class="form-control" required>
                </td>

                <td>
                <select name="jenkel[]" class="form-control" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
                </select> 
                </td>

                <td>
                <textarea name="alamat[]" class="form-control" required></textarea>
                </td>

                <td>
                <input type="number" name="telp[]" class="form-control" required>
                </td>

                <td>
                <button type="button" class="btn btn-danger btnhapusform">
                <i class="fa fa-trash"></i>
                </button>
                </td>
                </tr>

                `);

        });




    });

    $(document).on('click', '.btnhapusform', function(e){
        e.preventDefault();

        $(this).parents('tr').remove();
    })
</script>