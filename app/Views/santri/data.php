<?= $this->extend('layout/menu') ?>
<?= $this->section('judul') ?>
<h3>Manajemen Data Santri</h3>
<?= $this->endSection() ?>
<?= $this->section('isi') ?>
<!-- DataTables -->
<link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<div class="card">
    <?= form_open('santri/hapusbanyak', ['class' => 'formhapusbanyak']) ?>
    <div class="card-header">
        <h3 class="card-title">
            <button type="button" class="btn btn-sm btn-primary" onclick="window.location='<?= site_url('santri/add') ?>'">
                <i class="fa fa-plus"></i> Tambah Data
            </button>

            <button type="submit" class="btn btn-danger btn-sm">
                <i class="fa fa-trash"></i> Multi Delete
            </button>

            <div class="btn-group">
                <button type="button" class="btn btn-success btn-sm">
                    <i class="fa fa-file-import"></i> Import Excel
                </button>
                <button type="button" class="btn btn-success btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu" role="menu">
                    <a class="dropdown-item" href="<?= site_url('siswa.xlsx') ?>">
                        <i class="fa fa-file-excel"></i> Download Example
                    </a>
                    <a class="dropdown-item" href="#" id="btnupload">
                        <i class="fa fa-file-import"></i> Upload Excel
                    </a>
                </div>
            </div>
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
        <div class="viewdata"></div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-hover display" id="datasantri">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="centangSemua">
                        </th>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama Santri</th>
                        <th>Jenkel</th>
                        <th>Kelas</th>
                        <th>Alamat</th>
                        <th>Telp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <?= form_close() ?>
</div>

<div class="viewmodal" style="display: none;"></div>
<script>
    $(document).ready(function(){

        listdatasantri();

        $('#centangSemua').click(function(e){

            if ($(this).is(':checked')) {
                $('.centangNis').prop('checked', true)
            }else{
                $('.centangNis').prop('checked', false)
            }
        });

        $('.formhapusbanyak').submit(function(e){
            e.preventDefault();
            let jmldata = $('.centangNis:checked');

            if (jmldata.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Perhatian',
                    text: 'Maaf Silahkan pilih data yang mau dihapus !'
                });

            }else{

                Swal.fire({
                    title: 'Hapus data banyak?',
                    text: `Yakin data santri dihapus sebanyak ${jmldata.length} data`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "post",
                            url: $(this).attr('action'),
                            data: $(this).serialize(),
                            dataType: "json",
                            success: function(response){

                                if (response.sukses) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: response.sukses,
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.reload();
                                        }
                                    })
                                }

                            },
                            error: function(xhr, thrownError) {
                                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                            }


                        });
                    }

                })

            }


            return false;
        });

        $('#btnupload').click(function(e){
            e.preventDefault();
            $.ajax({
                url:"/santri/formupload",
                success: function(response){
                    $('.viewmodal').html(response).show();
                    $('#modalimportsiswa').modal('show');

                }
            });
        });

    });

    function listdatasantri(){
        var table = $('#datasantri').DataTable({
            "processing": true,
            "serverSide": true,
            "autoWidth": false,
            "responsive": true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('santri/listdata') ?>",
                "type": "POST",
                "data": {
                  keywordnis: $('#keywordnis').val()
              }
          },
          "columnDefs": [{
            "targets": 0,
            "orderable": false,
        }],
    });
    }

    function hapus(nis, nama) {
        Swal.fire({
            title: 'Hapus Santri',
            html: `Yakin hapus nama santri <strong>${nama}</strong> ini ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus !',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('santri/hapus') ?>",
                    data: {
                        nis: nis
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                           Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            html: response.sukses,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        })
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            }
        })
    }

    function edit(nis){
        $.ajax({
            type: "post",
            url: "<?= site_url('santri/formedit') ?>",
            data: {
                nis:nis
            },
            dataType: "json",
            success: function(response){
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaledit').modal('show')
                }

            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }

        });
    }

    function foto(nis){
        $.ajax({
            type: "post",
            url:"/santri/formfoto",
            data: {
                nis: nis
            },
            
            success: function(response){
                $('.viewmodal').html(response).show();
                $('#modalupload').modal('show');

            },
            error: function(xhr, ajaxOption, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }


</script>

<?= $this->endSection() ?>