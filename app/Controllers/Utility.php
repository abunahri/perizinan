<?php

namespace App\Controllers;
use App\Models\Modelusers;
use App\Models\Modelmusrif;
use App\Models\Modelsetting;
use Ifsnop\Mysqldump\Mysqldump;

class Utility extends BaseController
{
	public function index()
	{
		$modelSetting = new Modelsetting();
		$data = [
			'setting' => $modelSetting->get()->getRowArray()
		];
		return view('utility/index', $data);
	}

	public function gantipassword()
	{
		$modelSetting = new Modelsetting();
		$data = [
			'setting' => $modelSetting->get()->getRowArray()
		];
		return view('utility/formgantipassword', $data);
	}

	public function gantipasswordMusrif()
	{
		$modelSetting = new Modelsetting();
		$data = [
			'setting' => $modelSetting->get()->getRowArray()
		];
		return view('utility/formgantipasswordMusrif', $data);
	}

	public function doBackup()
	{
		try {
			$tglSekarang = date('dym');

			$dump = new Mysqldump('mysql:host=localhost;dbname=perizinan;port=3306','root','');
			$dump->start('database/backup/dbbackup-' . $tglSekarang . '.sql');

			$pesan = "Backup berhasil";
			session()->setFlashdata('pesan', $pesan);
			return redirect()->to('/utility/index');

		} catch (\Exception $e) {
			$pesan = "mysqldump-php error " . $e->getMessage();
			session()->setFlashdata('pesan', $pesan);
			return redirect()->to('/utility/index');
		}
		
	}

	function updatepassowrd()
	{
		if ($this->request->isAJAX()) {
			$iduser = session()->iduser;
			$passlama = $this->request->getPost('passlama');
			$passbaru = $this->request->getPost('passbaru');
			$confirmpass = $this->request->getPost('confirmpass');

			$validation = \Config\Services::validation();

			$valid = $this->validate([
				'passlama' => [
					'rules' => 'required',
					'label' => 'Password Lama',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'passbaru' => [
					'rules' => 'required',
					'label' => 'Password baru',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'confirmpass' => [
					'rules' => 'required|matches[passbaru]',
					'label' => 'Confirmasi Password',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
						'matches' => '{field} tidak sama'
					]
				]
			]);
			if(!$valid){
				$error = [
					'passlama' => $validation->getError('passlama'),
					'passbaru' => $validation->getError('passbaru'),
					'confirmpass' => $validation->getError('confirmpass'),
				];

				$json = [
					'error' => $error
				];
				
			}else{
				$modelUser = new Modelusers();
				$rowData = $modelUser->find($iduser);
				$passUser = $rowData['userpassword'];

				if (password_verify($passlama,$passUser)) {
					$hashPasswordBaru = password_hash($passbaru, PASSWORD_DEFAULT);
					$modelUser->update($iduser,[
						'userpassword' => $hashPasswordBaru
					]);
					$json = [
						'sukses' => 'Password berhasil diganti'
					];
				}else{
					$error = [
						'passlama' => 'Password lama tidak sama'
					];

					$json = [
						'error' => $error
					];
				}
			}

			echo json_encode($json);
		}

	}

	function updatepassowrdMusrif()
	{
		if ($this->request->isAJAX()) {
			$iduser = session()->iduser;
			$passlama = $this->request->getPost('passlama');
			$passbaru = $this->request->getPost('passbaru');
			$confirmpass = $this->request->getPost('confirmpass');

			$validation = \Config\Services::validation();

			$valid = $this->validate([
				'passlama' => [
					'rules' => 'required',
					'label' => 'Password Lama',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'passbaru' => [
					'rules' => 'required',
					'label' => 'Password baru',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'confirmpass' => [
					'rules' => 'required|matches[passbaru]',
					'label' => 'Confirmasi Password',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
						'matches' => '{field} tidak sama'
					]
				]
			]);
			if(!$valid){
				$error = [
					'passlama' => $validation->getError('passlama'),
					'passbaru' => $validation->getError('passbaru'),
					'confirmpass' => $validation->getError('confirmpass'),
				];

				$json = [
					'error' => $error
				];
				
			}else{
				$modelMusrif = new Modelmusrif();
				$rowData = $modelMusrif->find($iduser);
				$passMusrif = $rowData['pass_musrif'];

				if (password_verify($passlama,$passMusrif)) {
					$hashPasswordBaru = password_hash($passbaru, PASSWORD_DEFAULT);
					$modelMusrif->update($iduser,[
						'pass_musrif' => $hashPasswordBaru
					]);
					$json = [
						'sukses' => 'Password berhasil diganti'
					];
				}else{
					$error = [
						'passlama' => 'Password lama tidak sama'
					];

					$json = [
						'error' => $error
					];
				}
			}

			echo json_encode($json);
		}

	}
}
