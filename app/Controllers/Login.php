<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modellogin;

class Login extends BaseController
{
	public function index()
	{
		return view('login/index');
	}

	public function cekUser()
	{
		$iduser = $this->request->getPost('iduser');
		$pass = $this->request->getPost('pass');

		$validation = \config\Services::validation();

		$valid = $this->validate([
			'iduser' => [
				'label' => 'Username',
				'rules' => 'required',
				'errors' => [
					'required' => '{field} tidak boleh kosong'
				]
			],
			'pass' => [
				'label' => 'Passwords',
				'rules' => 'required',
				'errors' => [
					'required' => '{field} tidak boleh kosong'
				]
			]
		]);

		if (!$valid) {

			$sessError = [
				'errIdUser' => $validation->getError('iduser'),
				'errPassword' => $validation->getError('pass')
			];

			session()->setFlashdata($sessError);
			return redirect()->to(site_url('login/index'));
		}else{
			 //cek user dulu ke database
			$query_cekuser = $this->db->query("SELECT * FROM users JOIN levels ON levelid=userlevelid WHERE userid='$iduser'");

			$query_cekusermusrif = $this->db->query("SELECT * FROM musrif JOIN levels ON levelid=musrif_levelid WHERE kode_musrif='$iduser'");

			$result = $query_cekuser->getResult();
			$result_musrif = $query_cekusermusrif->getResult();
			if (count($result) > 0) {
                    // lanjutkan
				$row = $query_cekuser->getRow();
				$password_user = $row->userpassword;

				if (password_verify($pass, $password_user)) {
                        //buat session
					$simpan_session = [
						'login' => true,
						'iduser' => $iduser,
						'namauser' => $row->nama_user,
						'idlevel' => $row->userlevelid,
						'namalevel' => $row->levelnama,
						'foto' => $row->foto,
						'jenkel' => $row->jenkel
					];
					session()->set($simpan_session);
					return redirect()->to('/layout/index');
				} else {
					$sessError = [
						'errPassword' => 'Password anda salah'

					];

					session()->setFlashdata($sessError);
					return redirect()->to(site_url('login/index'));
				}
			} elseif (count($result_musrif) > 0) {
				$row_musrif = $query_cekusermusrif->getRow();
				$pass_musrif = $row_musrif->pass_musrif;

				if (password_verify($pass, $pass_musrif)) {
					$simpan_session = [
						'login' => true,
						'iduser' => $iduser,
						'namauser' => $row_musrif->nama_musrif,
						'idlevel' => $row_musrif->musrif_levelid,
						'namalevel' => $row_musrif->levelnama,
						'foto' => $row_musrif->foto
					];
					session()->set($simpan_session);
					return redirect()->to('/layout/index');
				} else {
					$sessError = [
						'errPassword' => 'Password anda salah'

					];

					session()->setFlashdata($sessError);
					return redirect()->to(site_url('login/index'));
				}
			} else {
				$sessError = [
					'errIdUser' => 'Maaf, user tidak terdaftar'

				];

				session()->setFlashdata($sessError);
				return redirect()->to(site_url('login/index'));
			}
		}

	}

	public function keluar()
	{
		session()->destroy();
		return redirect()->to('login/index');
	}
}
