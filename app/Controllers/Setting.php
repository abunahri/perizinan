<?php

namespace App\Controllers;
use App\Models\Modelsetting;
use Config\Services;

class Setting extends BaseController
{
	public function __construct()
	{
		$this->setting = new Modelsetting();
		$this->db = db_connect();
	}

	public function index()
	{
		// $datasetting = $this->db->table('setting')->get()->getRowArray();
		$modelSetting = new Modelsetting();
		$data = [
			// 'tampil' => $datasetting,
			'setting' => $modelSetting->get()->getRowArray()
			
		];
		return view('setting/index', $data);
	}

	public function updateSetting()
	{
		if ($this->request->isAJAX()) {
			$setting_id = $this->request->getVar('setting_id');
			$nama = $this->request->getVar('nama');
			$app = $this->request->getVar('app');
			$alamat = $this->request->getVar('alamat');
			$kec = $this->request->getVar('kec');
			$kota = $this->request->getVar('kota');
			$telp = $this->request->getVar('telp');
			$logo = $this->request->getVar('logo');
			$kepsek = $this->request->getVar('kepsek');
			$nip = $this->request->getVar('nip');
			$cap = $this->request->getVar('cap');
			

			$validation =  \Config\Services::validation();

			$valid = $this->validate([

				'nama' => [
					'label' => 'Nama Sekolah',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'app' => [
					'label' => 'Nama Aplikasi',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'alamat' => [
					'label' => 'Alamat Sekolah',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'kec' => [
					'label' => 'Nama kecamatan',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'kota' => [
					'label' => 'Nama Kabupaten',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'telp' => [
					'label' => 'No Telp',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'logo' => [
					'label' => 'Logo Sekolah',
					'rules' => 'mime_in[logo,image/png,image/jpg,image/jpeg]|ext_in[logo,png,jpg,jpeg]',
					'errors' => [
						'required' => '{field} salah format'
					]
				],
				'kepsek' => [
					'label' => 'Nama Kepsek',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'nip' => [
					'label' => 'Nip Kepsek',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'cap' => [
					'label' => 'Cap Sekolah',
					'rules' => 'mime_in[logo,image/png,image/jpg,image/jpeg]|ext_in[logo,png,jpg,jpeg]',
					'errors' => [
						'required' => '{field} salah format'
					]
				]
			]);

			if (!$valid) {
				$msg = [
					'error' => [
						'errorNama' => $validation->getError('nama'),
						'errorApp' => $validation->getError('app'),
						'errorAlamat' => $validation->getError('alamat'),
						'errorKec' => $validation->getError('kec'),
						'errorKota' => $validation->getError('kota'),
						'errorTelp' => $validation->getError('telp'),
						'errorLogo' => $validation->getError('logo'),
						'errorKepsek' => $validation->getError('kepsek'),
						'errorNip' => $validation->getError('nip'),
						'errorCap' => $validation->getError('cap'),
					]
				];
			}else{
				$cekData = $this->setting->find($setting_id);
				$pathGambarLama = $cekData['logo'];
				$pathCapLama = $cekData['cap'];
				$uploadGambar = $_FILES['logo']['name'];
				$uploadCap = $_FILES['cap']['name'];
				if ($uploadGambar != NULL) {
					($pathGambarLama == '' || $pathGambarLama == null) ? '' : unlink($pathGambarLama);
					$namaFileGambar = "$logo";
					$fileGambar = $this->request->getFile('logo');
					$fileGambar->move('upload/logo', $namaFileGambar . '.' . $fileGambar->getExtension());
					$pathGambar = 'upload/logo/' . $fileGambar->getName();
					
				} else {
					$pathGambar = $pathGambarLama;
				}
				if ($uploadCap != NULL) {
					($pathCapLama == '' || $pathCapLama == null) ? '' : unlink($pathCapLama);
					$namaFileCap = "$cap";
					$fileCap = $this->request->getFile('cap');
					$fileCap->move('upload/cap', $namaFileCap . '.' . $fileCap->getExtension());
					$pathCap = 'upload/cap/' . $fileCap->getName();
				}else{
					$pathCap = $pathCapLama;
				}
				
				$this->setting->update($setting_id,[
					
					'nama_sekolah' => $nama,
					'app_nama' => $app,
					'alamat' => $alamat,
					'kec' => $kec,
					'kab' => $kota,
					'telp' => $telp,
					'logo' => $pathGambar,
					'kepsek' => $kepsek,
					'nip' => $nip,
					'cap' => $pathCap
				]);

				
				$msg = [
					'sukses' => 'Setting berhasil diupdate'
				];

			}
			echo json_encode($msg);
		}
	}
}
