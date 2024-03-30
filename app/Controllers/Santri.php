<?php

namespace App\Controllers;
use App\Models\Modelkelas;
use App\Models\Modelkamar;
use App\Models\Modelsantri;
use App\Models\Modeldatasantri;
// use App\Models\Modelmusrif;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Config\Services;

class Santri extends BaseController
{
	public function __construct()
	{
		$this->santri = new Modelsantri();
		$this->kelas = new Modelkelas();
		$this->kamar = new Modelkamar();
		$this->db = db_connect();
	}

	public function index()
	{
		return view('santri/data');
	}

	public function add()
	{
		return view('santri/formtambah');
	}

	

	public function listdata()
	{
		if ($this->request->isAJAX()) {
			$keywordnis = $this->request->getPost('keywordnis');
			$request = Services::request();
			$datasantri = new Modeldatasantri($request);
			if ($request->getMethod(true) == 'POST') {
				$lists = $datasantri->get_datatables($keywordnis);
				$data = [];
				$no = $request->getPost("start");
				foreach ($lists as $list) {
					$no++;
					$row = [];

					$tomboledit = '<a href="'.site_url('santri/edit/'.$list->nis).'" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a>';

					$tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"hapus('".$list->nis."','" . $list->nama . "')\" title=\"Hapus\">
					<i class=\"fa fa-trash\"></i>
					</button>";
					$tombolupload = "<button type=\"button\" class=\"btn btn-info btn-sm\" onclick=\"foto('".$list->nis."')\" title=\"Ambil foto\">
					<i class=\"fa fa-camera\"></i>
					</button>";

					$row[] = "<input type=\"checkbox\" name=\"nis[]\" class=\"centangNis\" value=\"$list->nis\">";

					$row[] = $no;
					$row[] = $list->nis;
					$row[] = $list->nama;
					$row[] = $list->jenkel;
					$row[] = $list->nama_kelas;
					$row[] = $list->alamat;
					$row[] = $list->telp;
					$row[] = $tombolhapus . ' ' . $tomboledit . ' ' .$tombolupload;
					$data[] = $row;
				}
				$output = [
					"draw" => $request->getPost('draw'),
					"recordsTotal" => $datasantri->count_all($keywordnis),
					"recordsFiltered" => $datasantri->count_filtered($keywordnis),
					"data" => $data
				];
				echo json_encode($output);
			}
		}

		
	}

	public function ambilDataKelas()
	{
		if ($this->request->isAJAX()) {
			$datakelas = $this->db->table('kelas')->get();

			$isidata = "<option value='' selected>-Pilih-</option>";

			foreach ($datakelas->getResultArray() as $row) :
				$isidata .= '<option value="' . $row['id_kelas'] . '">' . $row['nama_kelas'] . '</option>';
			endforeach;

			$msg = [
				'data' => $isidata
			];
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

	public function data_kamar()
	{
		
		if ($this->request->isAJAX())
		{
			$id_kamar = $this->request->getVar('kamar');
			
			$data = $this->kamar->tampildata($id_kamar);
			
			$json['nama_musrif']	= ( ! empty($data['nama_musrif'])) ? $data['nama_musrif'] : "";
			$json['kode_musrif']	= ( ! empty($data['kode_musrif'])) ? $data['kode_musrif'] : "";
			
			echo json_encode($json);
		}
	}


	public function formtambah()
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

	public function simpandata()
	{
		if ($this->request->isAJAX()) {
			$nis = $this->request->getVar('nis');
			$nisn = $this->request->getVar('nisn');
			$nama = $this->request->getVar('nama');
			$tmp_lahir = $this->request->getVar('tmp_lahir');
			$tgl_lahir = $this->request->getVar('tgl_lahir');
			$jenkel = $this->request->getVar('jenkel');
			$kelas = $this->request->getVar('kelas');
			$kamar = $this->request->getVar('kamar');
			$musrif = $this->request->getVar('kode_musrif');
			$ortu = $this->request->getVar('ortu');
			$alamat = $this->request->getVar('alamat');
			$telp = $this->request->getVar('telp');
			$uploadgambar = $this->request->getVar('uploadgambar');

			$validation =  \Config\Services::validation();

			$doValid = $this->validate([
				'nis' => [
					'label' => 'NIS',
					'rules' => 'is_unique[santri.nis]|required',
					'errors' => [
						'is_unique' => '{field} sudah ada, coba dengan kode yang lain',
						'required' => '{field} tidak boleh kosong'
					]
				],

				'nisn' => [
					'label' => 'NISN',
					'rules' => 'is_unique[santri.nisn]|required',
					'errors' => [
						'is_unique' => '{field} sudah ada, coba dengan kode yang lain',
						'required' => '{field} tidak boleh kosong'
					]
				],
				'nama' => [
					'label' => 'Nama Santri',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'tmp_lahir' => [
					'label' => 'Tempat lahir santri',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'tgl_lahir' => [
					'label' => 'Tgl lahir santri',
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
				'kelas' => [
					'label' => 'Kelas',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} wajib dipilih'
					]
				],
				'kamar' => [
					'label' => 'Kamar',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} wajib dipilih'
					]
				],
				'ortu' => [
					'label' => 'Nama Orang Tua',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh Kosong',
					]
				],
				'alamat' => [
					'label' => 'Alamat',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh Kosong'
					]
				],

				'telp' => [
					'label' => 'Telp',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh Kosong'
					]
				],
				'uploadgambar' => [
					'label' => 'Upload Gambar',
					'rules' => 'mime_in[uploadgambar,image/png,image/jpg,image/jpeg]|ext_in[uploadgambar,png,jpg,jpeg]|is_image[uploadgambar]',
				]
			]);

			if (!$doValid) {
				$msg = [
					'error' => [
						'errorNis' => $validation->getError('nis'),
						'errorNisn' => $validation->getError('nisn'),
						'errorNama' => $validation->getError('nama'),
						'errorTmp' => $validation->getError('tmp_lahir'),
						'errorTgl' => $validation->getError('tgl_lahir'),
						'errorJenkel' => $validation->getError('jenkel'),
						'errorKelas' => $validation->getError('kelas'),
						'errorKamar' => $validation->getError('kamar'),
						'errorOrtu' => $validation->getError('ortu'),
						'errorAlamat' => $validation->getError('alamat'),
						'errorTelp' => $validation->getError('telp'),
						'errorUpload' => $validation->getError('uploadgambar')
					]
				];
			} else {
				$uploadGambar = $_FILES['uploadgambar']['name'];

				if ($uploadGambar != NULL) {
					$namaFileGambar = "$nis";
					$fileGambar = $this->request->getFile('uploadgambar');
					$fileGambar->move('assets/upload', $namaFileGambar . '.' . $fileGambar->getExtension());

					$pathGambar = 'assets/upload/' . $fileGambar->getName();
				} else {
					$pathGambar = '';
				}

				$this->santri->insert([
					'nis' => $nis,
					'nisn' => $nisn,
					'nama' => $nama,
					'tmp_lahir' => $tmp_lahir,
					'tgl_lahir' => $tgl_lahir,
					'jenkel' => $jenkel,
					'santri_idkelas' => $kelas,
					'santri_idkamar' => $kamar,
					'musrif_kamar' => $musrif,
					'nama_wali' => $ortu,
					'alamat' => $alamat,
					'telp' => $telp,
					'foto_santri' => $pathGambar
				]);

				$msg = [
					'sukses' => 'Santri berhasil ditambah'
				];
			}

			echo json_encode($msg);
		}
	}
	

	public function edit($nis)
	{
		$row = $this->santri->tampildata($nis)->getRowArray();

		if ($row) {
			$data = [
				'nis' => $nis,
				'nisn' => $row['nisn'],
				'nama' => $row['nama'],
				'jenkel' => $row['jenkel'],
				'santrikelas' => $row['santri_idkelas'],
				'datakelas' => $this->kelas->findAll(),
				'santrikamar' => $row['santri_idkamar'],
				'datakamar' => $this->kamar->findAll(),
				'musrif' => $row['nama_musrif'],
				'kode_musrif' => $row['kode_musrif'],
				'ortu' => $row['nama_wali'],
				'tmp_lahir' => $row['tmp_lahir'],
				'tgl_lahir' => $row['tgl_lahir'],
				'alamat' => $row['alamat'],
				'telp' => $row['telp'],
				'gambarsantri' => $row['foto_santri']
			];
			return view('santri/formedit', $data);
		}else{
			exit('Data tidak ada');
		}
	}

	public function updatedata()
	{
		if ($this->request->isAJAX()) {
			$nis = $this->request->getVar('nis');
			$nisn = $this->request->getVar('nisn');
			$nama = $this->request->getVar('nama');
			$tgl_lahir = $this->request->getVar('tgl_lahir');
			$tmp_lahir = $this->request->getVar('tmp_lahir');
			$jenkel = $this->request->getVar('jenkel');
			$kelas = $this->request->getVar('kelas');
			$kamar = $this->request->getVar('kamar');
			$musrif = $this->request->getVar('kode_musrif');
			$ortu = $this->request->getVar('ortu');
			$alamat = $this->request->getVar('alamat');
			$telp = $this->request->getVar('telp');
			$uploadgambar = $this->request->getVar('uploadgambar');

			$validation =  \Config\Services::validation();

			$doValid = $this->validate([

				'nama' => [
					'label' => 'Nama Santri',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],


				'uploadgambar' => [
					'label' => 'Upload Gambar',
					'rules' => 'mime_in[uploadgambar,image/png,image/jpg,image/jpeg]|ext_in[uploadgambar,png,jpg,jpeg]|is_image[uploadgambar]',
				]
			]);

			if (!$doValid) {
				$msg = [
					'error' => [
						'errorNama' => $validation->getError('nama'),
						'errorUpload' => $validation->getError('uploadgambar')
					]
				];
			} else {
				$cekData = $this->santri->find($nis);
				$pathGambarLama = $cekData['foto_santri'];
				$uploadGambar = $_FILES['uploadgambar']['name'];

				if ($uploadGambar != NULL) {
					($pathGambarLama == '' || $pathGambarLama == null) ? '' : unlink($pathGambarLama);
					
					$namaFileGambar = "$nis";
					$fileGambar = $this->request->getFile('uploadgambar');
					$fileGambar->move('assets/upload', $namaFileGambar . '.' . $fileGambar->getExtension());

					$pathGambar = 'assets/upload/' . $fileGambar->getName();
				} else {
					$pathGambar = $pathGambarLama;
				}

				$this->santri->update($nis,[
					'nisn' => $nisn,
					'nama' => $nama,
					'tmp_lahir' => $tmp_lahir,
					'tgl_lahir' => $tgl_lahir,
					'jenkel' => $jenkel,
					'santri_idkelas' => $kelas,
					'santri_idkamar' => $kamar,
					'musrif_kamar' => $musrif,
					'nama_wali' => $ortu,
					'alamat' => $alamat,
					'telp' => $telp,
					'foto_santri' => $pathGambar
				]);

				$msg = [
					'sukses' => 'Santri berhasil diupdate'
				];
			}

			echo json_encode($msg);
		}
	}

	function hapus()
	{
		if ($this->request->isAJAX()) {
			$nis = $this->request->getVar('nis');

			$rowDataSantri = $this->santri->find($nis);
			if ($rowDataSantri) {
				$pathGambarLama = $rowDataSantri['foto_santri'];
				($pathGambarLama == '' || $pathGambarLama == null) ? '' : unlink($pathGambarLama);
				$this->santri->delete($nis);
			}

			$msg = [
				'sukses' => "Data santri dengan nis $nis berhasil dihapus"
			];
			echo json_encode($msg);
		}
	}

	

	public function hapusbanyak()
	{
		if ($this->request->isAJAX()) {
			$nis = $this->request->getVar('nis');

			$jmldata = count($nis);


			for ($i=0; $i < $jmldata; $i++) { 
				$rowDataSantri = $this->santri->find($nis[$i]);
				if ($rowDataSantri) {
					$pathGambarLama = $rowDataSantri['foto_santri'];
					($pathGambarLama == '' || $pathGambarLama == null) ? '' : unlink($pathGambarLama);
					// $this->santri->delete($nis);
					$this->santri->delete($nis[$i]);
				}
			}
			$msg = [
				'sukses' => "$jmldata data santri berhasil dihapus"
			];
			echo json_encode($msg);


		}
	}

	function formupload()
	{
		if ($this->request->isAJAX()) {
			return view('santri/modalimportsiswa');
		}
	}

	public function import()
	{
		$file = $this->request->getFile('file_excel');
		$extension = $file->getClientExtension();
		if ($extension == 'xls' || $extension == 'xlsx') {
			if ($extension == 'xls') {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			}else{
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

			}
			$spreadsheet = $reader->load($file);
			$siswa = $spreadsheet->getActiveSheet()->toArray();
			foreach($siswa as $key => $value){
				if ($key == 0) {
					continue;
				}
				$data = [
					'nis' => $value[1],
					'nisn' => $value[2],
					'nama' => $value[3],
					'tmp_lahir' => $value[4],
					'tgl_lahir' => $value[5],
					'jenkel' => $value[6],
					'santri_idkelas' => $value[7],
					'santri_idkamar' => $value[8],
					'nama_wali' => $value[9],
					'alamat' => $value[10],
					'telp' => $value[11],
					
				];
				$this->santri->insert($data);
				$msg = [
					'sukses' => 'Data Berhasil disimpan'
				];
			}
		}else{
			$msg = [
				'error' => 'Format File Tidak Sesuai'
			];
		}
		echo json_encode($msg);
	}

	public function formfoto()
	{
		if ($this->request->isAJAX()) {
			$nis = $this->request->getVar('nis');

			$data = [
				'nis' => $nis
			];
			
			echo view('santri/modalupload', $data);
			
		}
	}

	public function doupload()
	{
		if ($this->request->isAJAX()) {
			$nis = $this->request->getVar('nis');

			$validation = \Config\Services::validation();

			if ($_FILES['foto']['name'] == NULL && $this->request->getPost('imagecam') == '') {
				$msg = ['error' => 'Silahkan pilih salah satu ya..'];
			}
			elseif ($_FILES['foto']['name'] == NULL) {
				$cekdata = $this->santri->find($nis);
				$fotolama = $cekdata['foto_santri'];
				if ($fotolama != NULL || $fotolama != "") {
					unlink($fotolama);
				}

				$image = $this->request->getPost('imagecam');
				$image = str_replace('data:image/jpeg;base64,', '', $image);

				$image = base64_decode($image, true);
				$filename = $nis . '.jpg';
				file_put_contents(FCPATH. '/assets/upload/' . $filename, $image);

				$updatedata = [
					'foto_santri' => './assets/upload/'. $filename
				];
				$this->santri->update($nis, $updatedata);
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
					$cekdata = $this->santri->find($nis);
					$fotolama = $cekdata['foto_santri'];
					if ($fotolama != NULL || $fotolama != "") {
						unlink($fotolama);
					}
					$filefoto = $this->request->getFile('foto');
					$filefoto->move('assets/upload', $nis.'.'.$filefoto->getExtension());
					$updatedata = [
						'foto_santri' => './assets/upload/'.$filefoto->getName()
					];
					$this->santri->update($nis, $updatedata);

					$msg = [
						'sukses' => 'Berhasil diupload'
					];
				}

			}
			
			echo json_encode($msg);
		}
	}

	

	
}
