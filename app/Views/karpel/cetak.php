<?= $this->extend('layout/menu') ?>
<?= $this->section('judul') ?>
<h3>Cetak Kartu Data Santri</h3>
<?= $this->endSection() ?>
<?= $this->section('isi') ?>
<!-- DataTables -->
<link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<div class="card">
    <?= form_open('karpel/cetakbanyak', ['class' => 'formcetakbanyak']) ?>
    <div class="card-header">
        <h3 class="card-title">

            <button type="submit" class="btn btn-info btn-sm">
                <i class="fa fa-print"></i> Cetak Kartu Banyak
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
                        <th>NISN</th>
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

        $('.formcetakbanyak').submit(function(e){
            e.preventDefault();
            let jmldata = $('.centangNis:checked');

            if (jmldata.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Perhatian',
                    text: 'Maaf Silahkan pilih data yang mau dicetak !'
                });

            }else{

                Swal.fire({
                    title: 'Cetak banyak?',
                    text: `Yakin Cetak Kartu sebanyak ${jmldata.length} data`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Cetak!',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "post",
                            url: $(this).attr('action'),
                            data: $(this).serialize(),
                            dataType: "json",
                            success: function(response){


                                let windowCetak = window.open(response.cetakbanyak,"Cetak Kartu Pelajar");
                                
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

        
        

    });

    function listdatasantri(){
        var table = $('#datasantri').DataTable({
            "processing": true,
            "serverSide": true,
            "autoWidth": false,
            "responsive": true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('karpel/listdata') ?>",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": 0,
                "orderable": false,
            }],
        });
    }

    function cetak(nis){
        let windowCetak = window.open('/karpel/cetakkarpel/'+nis,"Cetak kartu pelajar");
        windowCetak.focus();
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


</script>

<?= $this->endSection() ?>