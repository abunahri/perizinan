<?= $this->extend('layout/menu') ?>
<?= $this->section('judul') ?>
<h3>Manajemen Data Users</h3>
<?= $this->endSection() ?>
<?= $this->section('isi') ?>
<!-- DataTables -->
<link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <!-- Form Element sizes -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Data Users</h3>
                        <div class="float-right">
                            <button type="button" class="btn btn-sm btn-primary btntambah">
                                <i class="fa fa-plus"></i> Tambah User
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="box-body table-responsive">
                            <table id="datauser" class="table table-bordered table-striped table-hover">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>username</th>
                                        <th>Nama User</th>
                                        <th>Level</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<div class="viewmodal" style="display:none;"></div>

<script>
    $(document).ready(function() {
        $('.btntambah').click(function(e){
            e.preventDefault();
            $.ajax({
                url:"/users/formtambah",
                
                success: function(response){
                    $('.viewmodal').html(response).show();
                    $('#modaltambah').modal('show');
                    $('#modaltambah').on('shown.bs.modal', function (event) {
                        $('#iduser').focus();
                    })


                }
            });
        });

        dataUser = $('#datauser').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/users/listData',
            order:[],
            columns: [{
                data: 'nomor', 
                width: 10
            },
            {
                data: 'userid'
            },
            {
                data: 'nama_user'
            },
            {
                data: 'levelnama'
            },
            {
                data: 'status', 
                oderable: false, 
                width: 25
            },
            {
                data: 'aksi', 
                oderable: false, 
                width: 150
            },
            ]
        });
    });

    function view(userid){
        $.ajax({
            type: "post",
            url:"/users/formedit",
            data: {
                userid: userid
            },
            
            success: function(response){
                $('.viewmodal').html(response).show();
                $('#modaledit').modal('show');
                $('#modaledit').on('shown.bs.modal', function (event) {
                    $('#namalengkap').focus();
                })

            }
        });
    }

    function foto(userid){
        $.ajax({
            type: "post",
            url:"/users/formupload",
            data: {
                userid: userid
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