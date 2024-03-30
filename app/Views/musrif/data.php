<?= $this->extend('layout/menu') ?>

<?= $this->section('judul') ?>
<h3>Manajemen Data Musrif</h3>
<?= $this->endSection() ?>


<?= $this->section('isi') ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<script src="<?= base_url('assets') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<div class="card">
    <?= form_open('musrif/hapusbanyak', ['class' => 'formhapusbanyak']) ?>
    <div class="card-header">
        <h3 class="card-title">
            <button type="button" class="btn btn-sm btn-primary" onclick="window.location='<?= site_url('musrif/add') ?>'">
                <i class="fa fa-plus"></i> Tambah Data
            </button>

            <button type="submit" class="btn btn-danger btn-sm">
                <i class="fa fa-trash"></i> Multi Delete
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
        <table id="kamarmusrif" class="table table-bordered table-hover display">
            <thead>
                <tr>
                    <th>
                        <input type="checkbox" id="centangSemua">
                    </th>
                    <th>No</th>
                    <th>Kode Musrif</th>
                    <th>Nama Musrif</th>
                    <th>Jenkel</th>
                    <th>Nama Kamar</th>
                    <th>No Telp</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <?= form_close() ?>
</div>
<div class="viewmodal" style="display: none;"></div>
<script>
    $(document).ready(function(){
        listdatamusrif();

        $('#centangSemua').click(function(e){

            if ($(this).is(':checked')) {
                $('.centangId').prop('checked', true)
            }else{
                $('.centangId').prop('checked', false)
            }
        });

        $('.formhapusbanyak').submit(function(e){
            e.preventDefault();
            let jmldata = $('.centangId:checked');

            if (jmldata.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Perhatian',
                    text: 'Maaf Silahkan pilih data yang mau dihapus !'
                });

            }else{

                Swal.fire({
                    title: 'Hapus data banyak?',
                    text: `Yakin data musrif dihapus sebanyak ${jmldata.length} data`,
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


        $('.tombolTambah').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('musrif/formTambah') ?>",
                dataType: "json",
                type: 'post',
                
                success: function(response) {
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('#modaltambahmusrif').on('shown.bs.modal', function(event) {
                            $('#kodemusrif').focus();
                        });
                        $('#modaltambahmusrif').modal('show');
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    })
    function listdatamusrif(){
        var table = $('#kamarmusrif').DataTable({
            "processing": true,
            "serverSide": true,
            "autoWidth": false,
            "responsive": true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('musrif/listdata') ?>",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": 0,
                "orderable": false,
            }],
        });
    }

    

    function hapus(kode, nama) {
        Swal.fire({
            title: 'Hapus Satuan',
            html: `Yakin hapus nama musrif <strong>${nama}</strong> ini ?`,
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
                    url: "<?= site_url('musrif/hapus') ?>",
                    data: {
                        kode: kode
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

    function foto(kode_musrif){
        $.ajax({
            type: "post",
            url:"/musrif/formfoto",
            data: {
                kode_musrif: kode_musrif
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

    function resetpass(kode_musrif) {
        $.ajax({
            type: "post",
            url:"/musrif/formreset",
            data: {
                kode_musrif: kode_musrif
            },
            
            success: function(response){
                $('.viewmodal').html(response).show();
                $('#modalresetpass').modal('show');

            },
            error: function(xhr, ajaxOption, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>

<?= $this->endSection() ?>