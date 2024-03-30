<?= $this->extend('layout/menu') ?>

<?= $this->section('judul') ?>
<h3>Manajemen Absensi</h3>
<?= $this->endSection() ?>


<?= $this->section('isi') ?>
<!-- DataTables -->
<div class="row">
	<div class="col-lg-6">
		<div class="small-box bg-info">
			<div class="inner">
				<label for=""></label>
				<h4>Absen hari ini?</h4>

				<p><?= date('l, d F Y') ?></p>
			</div>
			<div class="icon">
				<i class="fa fa-print"></i>
			</div>
			<a href="<?= site_url('absen/input') ?>" class="small-box-footer">Input Absen <i class="fas fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="small-box bg-info">
			<div class="inner">
				<h4>Absen Kemarin</h4>
				<label for="">Silahkan pilih tanggal</label>
				<input type="date" class="form-control" name="tgl_absen" id="tgl_absen">
			</div>

			<a href="" class="small-box-footer" id="inputabsen">Input Absen <i class="fas fa-arrow-circle-right"></i></a>
		</div>
		
	</div>
	
</div>
<script>
	function tgl_kemarin(){
		
		let tgl_absen = $('#tgl_absen').val();
		let tgl = new Date();
		if (tgl_absen.length == 0) {
			Swal.fire('Error','Pilih tanggal dahulu','error');

		}else if(new Date(tgl_absen) > new Date()){
			Swal.fire('Error','Maaf anda salah pilih tanggal','error');

		}else{
			$.ajax({
				type: "post",
				url: "/absen/input",
				data: {
					tgl_absen: tgl_absen
				},
				dataType: "json",

				success: function(response){
					$('#tgl_absen').html(response.data);

				}
			});
		}

	}
	$(document).ready(function(){
		$('#inputabsen').click(function(e){
			e.preventDefault()
			let tgl_absen = $('#tgl_absen').val();
			let tgl = new Date();
			if (tgl_absen.length == 0) {
				Swal.fire('Error','Pilih tanggal dahulu','error');

			}else if(new Date(tgl_absen) > new Date()){
				Swal.fire('Error','Maaf anda salah pilih tanggal','error');

			}else{

				window.location.href='/absen/input/'+tgl_absen;
				
				
			}
			
			
			
		});
	});
</script>


<?= $this->endSection() ?>