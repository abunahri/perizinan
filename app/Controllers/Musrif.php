<?php 
namespace App\Controllers;

use App\Models\Modelmusrif;
use App\Models\Modeldatamusrif;
use App\Models\Modelkamar;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Config\Services;

class Musrif extends BaseController
{
	public function __construct()
	{
		$this->musrif = new Modelmusrif();
		$this->kamar = new Modelkamar();
		$this->db = db_connect();
	}

	public function index()
	{
		return view('musrif/data');
	}

	public function add()
	{
		return view('musrif/formtambah');
	}

	public function listdata()
	{
		if ($this->request->isAJAX()) {
			$request = Services::request();
			$datamusrif = new Modeldatamusrif($request);
			if ($request->getMethod(true) == 'POST') {
				$lists = $datamusrif->get_datatables();
				$data = [];
				$no = $request->getPost("start");
				foreach ($lists as $list) {
					$no++;
					$row = [];

					$tomboledit = '<a href="'.site_url('musrif/edit/'.$list->kode_musrif).'" class="btn btn-warning btn-sm" title="Edit Data"><i class="fa fa-pencil-alt"></i></a>';
					$tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"hapus('".$list->kode_musrif."','" . $list->nama_musrif . "')\" title=\"Hapus Data\">
					<i class=\"fa fa-trash\"></i>
					</button>";
					$tombolupload = "<button type=\"button\" class=\"btn btn-success btn-sm\" onclick=\"foto('".$list->kode_musrif."')\" title=\"Ambil foto\">
					<i class=\"fa fa-camera\"></i>
					</button>";
					$tombolreset = "<button type=\"button\" class=\"btn btn-info btn-sm\" onclick=\"resetpass('".$list->kode_musrif."')\" title=\"Reset Password\">
					<i class=\"fa fa-times\"></i>
					</button>";

					$row[] = "<input type=\"checkbox\" name=\"kode[]\" class=\"centangId\" value=\"$list->kode_musrif\">";

					$row[] = $no;
					$row[] = $list->kode_musrif;
					$row[] = $list->nama_musrif;
					$row[] = $list->jenkel;
					$row[] = $list->nama_kamar;
					$row[] = $list->tlp_musrif;
					$row[] = $tombolhapus . ' ' . $tomboledit .' '. $tombolupload .' '. $tombolreset;
					$data[] = $row;
				}
				$output = [
					"draw" => $request->getPost('draw'),
					"recordsTotal" => $datamusrif->count_all(),
					"recordsFiltered" => $datamusrif->count_filtered(),
					"data" => $data
				];
				echo json_encode($output);
			}
		}

		
	}

	function formTambah()
	{
		if ($this->request->isAJAX()) {
			$aksi = $this->request->getPost('aksi');
			$msg = [
				'data' => view('santri/modaltambah',['aksi' => $aksi])
			];
			echo json_encode($msg);
		}else{
			exit('Maaf tidak dapat diproses');
		}

	}

	function simpandata()
	{
		if ($this->request->isAJAX()) {
			$kode = $this->request->getVar('kode');
			$nama = $this->request->getVar('nama');
			$jenkel = $this->request->getVar('jenkel');
			$kamar = $this->request->getVar('kamar');
			$telp = $this->request->getVar('telp');
			$gambar = $this->request->getVar('gambar');

			$validation =  \Config\Services::validation();

			$doValid = $this->validate([
				'kode' => [
					'label' => 'Kode Musrif',
					'rules' => 'is_unique[musrif.kode_musrif]|required',
					'errors' => [
						'is_unique' => '{field} sudah ada, coba dengan kode yang lain',
						'required' => '{field} tidak boleh kosong'
					]
				],
				'nama' => [
					'label' => 'Nama Musrif',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'jenkel' => [
					'label' => 'Jenis Kelamin',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				
				'kamar' => [
					'label' => 'Kamar',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} wajib dipilih'
					]
				],
				'telp' => [
					'label' => 'Telp',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh Kosong'
					]
				],
				'gambar' => [
					'label' => 'Upload Gambar',
					'rules' => 'mime_in[gambar,image/png,image/jpg,image/jpeg]|ext_in[gambar,png,jpg,jpeg]|is_image[gambar]',
					'errors' => [
						'required' => '{field} tidak boleh Kosong'
					]
				]
			]);

			if (!$doValid) {
				$msg = [
					'error' => [
						'errorKode' => $validation->getError('kode'),
						'errorNama' => $validation->getError('nama'),
						'errorJenkel' => $validation->getError('jenkel'),
						'errorKamar' => $validation->getError('kamar'),
						'errorTelp' => $validation->getError('telp'),
						'errorUpload' => $validation->getError('gambar')
					]
				];
			} else {
				$uploadGambar = $_FILES['gambar']['name'];

				if ($uploadGambar != NULL) {
					$namaFileGambar = "$kode";
					$fileGambar = $this->request->getFile('gambar');
					$fileGambar->move('assets/upload', $namaFileGambar . '.' . $fileGambar->getExtension());

					$pathGambar = 'assets/upload/' . $fileGambar->getName();
				} else {
					$pathGambar = '';
				}

				$this->musrif->insert([
					'kode_musrif' => $kode,
					'nama_musrif' => $nama,
					'jenkel' => $jenkel,
					'tlp_musrif' => $telp,
					'kamar_musrif' => $kamar,
					'foto' => $pathGambar,
					'pass_musrif' => password_hash(123, PASSWORD_DEFAULT)
				]);

				$msg = [
					'sukses' => 'Data Musrif berhasil ditambah'
				];
			}

			echo json_encode($msg);
		}
	}

	public function ambilDataKamar()
	{
		if ($this->request->isAJAX()) {
			$datakamar = $this->db->table('kamar')->get();

			$isidata = "<option value='' selected>-Pilih-</option>";

			foreach ($datakamar->getResultArray() as $row) :
				$isidata .= '<option value="' . $row['id_kamar'] . '">' . $row['nama_kamar'] . '</option>';
			endforeach;

			$msg = [
				'data' => $isidata
			];
			echo json_encode($msg);
		}
	}

	public function edit($kode)
	{
		$row = $this->musrif->find($kode);

		if ($row) {
			$data = [
				'kode' => $row['kode_musrif'],
				'nama' => $row['nama_musrif'],
				'jenkel' => $row['jenkel'],
				'kamar' => $row['kamar_musrif'],
				'datakamar' => $this->kamar->findAll(),
				'telp' => $row['tlp_musrif'],
				'gambar' => $row['foto']
			];
			return view('musrif/formedit', $data);
		}else{
			exit('Data tidak ada');
		}
	}

	

	function updatedata()
	{
		if ($this->request->isAJAX()) {
			$kode = $this->request->getVar('kode');
			$nama = $this->request->getVar('nama');
			$jenkel = $this->request->getVar('jenkel');
			$kamar = $this->request->getVar('kamar');
			$telp = $this->request->getVar('telp');
			$gambar = $this->request->getVar('gambar');

			$validation =  \Config\Services::validation();

			$doValid = $this->validate([

				'nama' => [
					'label' => 'Nama Musrif',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],


				'gambar' => [
					'label' => 'Upload Gambar',
					'rules' => 'mime_in[gambar,image/png,image/jpg,image/jpeg]|ext_in[gambar,png,jpg,jpeg]|is_image[gambar]',
				]
			]);

			if (!$doValid) {
				$msg = [
					'error' => [
						'errorNama' => $validation->getError('nama'),
						'errorTelp' => $validation->getError('telp'),
						'errorUpload' => $validation->getError('gambar')
					]
				];
			} else {
				$cekData = $this->musrif->find($kode);
				$pathGambarLama = $cekData['foto'];
				$uploadGambar = $_FILES['gambar']['name'];

				if ($uploadGambar != NULL) {
					($pathGambarLama == '' || $pathGambarLama == null) ? '' : unlink($pathGambarLama);
					
					$namaFileGambar = "$kode";
					$fileGambar = $this->request->getFile('gambar');
					$fileGambar->move('assets/upload', $namaFileGambar . '.' . $fileGambar->getExtension());

					$pathGambar = 'assets/upload/' . $fileGambar->getName();
				} else {
					$pathGambar = $pathGambarLama;
				}

				$this->musrif->update($kode,[
					'nama_musrif' => $nama,
					'jenkel' => $jenkel,
					'kamar_musrif' => $kamar,
					'tlp_musrif' => $telp,
					'foto' => $pathGambar
				]);

				$msg = [
					'sukses' => 'Data Musrif berhasil diupdate'
				];
			}

			echo json_encode($msg);
		}
	}

	function hapus()
	{
		if ($this->request->isAJAX()) {
			$kode = $this->request->getVar('kode');
			
			$rowDataMusrif = $this->musrif->find($kode);
			if ($rowDataMusrif) {
				$pathGambarLama = $rowDataMusrif['foto'];
				($pathGambarLama == '' || $pathGambarLama == null) ? '' : unlink($pathGambarLama);
				$this->musrif->delete($kode);
			}

			$msg = [
				'sukses' => 'Data musrif berhasil dihapus'
			];
			echo json_encode($msg);
		}
	}

	public function hapusbanyak()
	{
		if ($this->request->isAJAX()) {
			$kode = $this->request->getVar('kode');

			$jmldata = count($kode);

			for ($i=0; $i < $jmldata; $i++) {
				$rowDataMusrif = $this->musrif->find($kode[$i]);
				if ($rowDataMusrif) {
					$pathGambarLama = $rowDataMusrif['foto'];
					($pathGambarLama == '' || $pathGambarLama == null) ? '' : unlink($pathGambarLama);
					// $this->musrif->delete($kode);
					$this->musrif->delete($kode[$i]);
				} 
			}
			$msg = [
				'sukses' => "$jmldata data musrif berhasil dihapus"
			];
			echo json_encode($msg);


		}
	}

	public function formreset()
	{
		if ($this->request->isAJAX()) {
			$kode_musrif = $this->request->getVar('kode_musrif');
			$ambildatamusrif = $this->musrif->find($kode_musrif);

			$data = [
				'kode_musrif' => $kode_musrif,
				'nama_musrif' => $ambildatamusrif['nama_musrif']
			];
			
			echo view('musrif/modalresetpassword', $data);
			
		}
	}

	function resetPassword()
	{
		if ($this->request->isAJAX()) {
			$kode_musrif = $this->request->getPost('kode_musrif');

			$modelMusrif = new Modelmusrif();

			$passRandom = rand(1,99999);

			$passHashBaru = password_hash($passRandom, PASSWORD_DEFAULT);

			$modelMusrif->update($kode_musrif,[
				'pass_musrif' => $passHashBaru
			]);
			$json = [
				'sukses' => '',
				'passwordBaru' => $passRandom
			];
			echo json_encode($json);
		}
	}

	public function formfoto()
	{
		if ($this->request->isAJAX()) {
			$kode_musrif = $this->request->getVar('kode_musrif');

			$data = [
				'kode_musrif' => $kode_musrif
			];
			
			echo view('musrif/modalupload', $data);
			
		}
	}



	public function doupload()
	{
		if ($this->request->isAJAX()) {
			$kode_musrif = $this->request->getVar('kode_musrif');

			$validation = \Config\Services::validation();

			if ($_FILES['foto']['name'] == NULL && $this->request->getPost('imagecam') == '') {
				$msg = ['error' => 'Silahkan pilih salah satu ya..'];
			}
			elseif ($_FILES['foto']['name'] == NULL) {
				$cekdata = $this->musrif->find($kode_musrif);
				$fotolama = $cekdata['foto'];
				if ($fotolama != NULL || $fotolama != "") {
					unlink($fotolama);
				}

				$image = $this->request->getPost('imagecam');
				$image = str_replace('data:image/jpeg;base64,', '', $image);

				$image = base64_decode($image, true);
				$filename = $kode_musrif . '.jpg';
				file_put_contents(FCPATH. '/assets/upload/' . $filename, $image);

				$updatedata = [
					'foto' => './assets/upload/'. $filename
				];
				$this->musrif->update($kode_musrif, $updatedata);
				$msg = [
					'sukses' => 'Berhasil diupload'
				];
				
			}else{
				$valid = $this->validate([
					'foto' => [
						'label' => 'Upload Foto',
						'rules' => 'uploaded[foto]|mime_in[foto,image/png,image/jpg,image/jpeg]|is_image[foto]',
						'errors' => [
							'uploaded' => '{field} wajib diisi',
							'mime_in' => 'Harus dalam bentuk gambar'
						]
					]
				]);
				if(!$valid){
					$msg = [
						'error' => [
							'foto' => $validation->getError('foto')
						]
					];
				}else{
					// cek foto
					$cekdata = $this->musrif->find($kode_musrif);
					$fotolama = $cekdata['foto'];
					if ($fotolama != NULL || $fotolama != "") {
						unlink($fotolama);
					}
					$filefoto = $this->request->getFile('foto');
					$filefoto->move('assets/upload', $kode_musrif.'.'.$filefoto->getExtension());
					$updatedata = [
						'foto' => './assets/upload/'.$filefoto->getName()
					];
					$this->musrif->update($kode_musrif, $updatedata);

					$msg = [
						'sukses' => 'Berhasil diupload'
					];
				}

			}
			
			echo json_encode($msg);
		}
	}
}