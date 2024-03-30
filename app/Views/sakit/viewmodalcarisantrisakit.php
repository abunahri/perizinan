<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<script src="<?= base_url('assets') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- Modal -->
<div class="modal fade" id="modalsantrisakit" data-backdrop="static" tabindex="-1" aria-labelledby="modalprodukLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalprodukLabel">Data Santri</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <table id="datasantrisakit" class="table table-bordered table-striped dataTable dtr-inline" role="grid">
          <thead>
            <tr>
              <th>No</th>
              <th>NIS</th>
              <th>Nama Santri</th>
              <th>Kelas</th>
              <th>Kamar</th>
              <th>Telp</th>
              <th></th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready( function () {
    var table = $('#datasantrisakit').DataTable({ 
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax": {
        "url": "<?= site_url('sakit/listDataSantri')?>",
        "type": "POST",
        "data": {
          keywordnis: $('#keywordnis').val()
        }
      },
    //optional
    "columnDefs": [
    { 
      "targets": [],
      "orderable": false,
    },],
  });
  });

  

  function pilihitem(nis){
    $('#nis').val(nis);
    $('#modalsantrisakit').on('hidden.bs.modal', function (event) {
      ambilDataSiswa();

      
    });

    $('#modalsantrisakit').modal('hide');

  }
</script>