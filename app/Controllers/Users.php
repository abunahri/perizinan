<?php

namespace App\Controllers;
use App\Models\Modelusers;
use App\Models\Modelsetting;
use \Hermawan\DataTables\DataTable;

class Users extends BaseController
{
	public function __construct()
	{
		$this->users = new Modelusers();
		$this->db = db_connect();
	}

	public function data()
	{
		
		return view('users/data');
	}

	function listData()
	{
		if ($this->request->isAJAX()) {
			$db = \Config\Database::connect();
			$builder = $db->table('users')
			->select('userid, nama_user, levelnama, useraktif, userlevelid')
			->join('levels', 'levelid = userlevelid');

			return DataTable::of($builder)
			->addNumbering('nomor')
			->add('status', function($row){
				if ($row->useraktif == '1') {
					return '<span class="badge badge-success">Active</span>';
				} else{
					return '<span class="badge badge-danger">Non Active</span>';
				}
				
			})
			
			->add('aksi', function($row){
				if ($row->userlevelid == '1') {
					return "<button type=\"button\" class=\"btn btn-sm btn-warning\" onclick=\"foto('".$row->userid."')\">
					<i class=\"fa fa-camera\"></i> Foto
					</button>";
				}elseif ($row->userlevelid != '1') {
					return "<button type=\"button\" class=\"btn btn-sm btn-info\" onclick=\"view('".$row->userid."')\">
					<i class=\"fa fa-eye\"></i> View
					</button> &nbsp;&nbsp;
					<button type=\"button\" class=\"btn btn-sm btn-warning\" onclick=\"foto('".$row->userid."')\">
					<i class=\"fa fa-camera\"></i> Foto
					</button>";
				}
				
			})
			->toJson(true);
		}
	}
	function formtambah()
	{
		if ($this->request->isAJAX()) {
			$db = \Config\Database::connect();
			$data = [
				'datalevel' => $db->table('levels')->where('levelid !=','1')->get()
			];
			echo view('users/modaltambah', $data);
		}
	}

	function simpan()
	{
		if ($this->request->isAJAX()) {
			$userid = $this->request->getVar('userid');
			$namalengkap = $this->request->getVar('namalengkap');
			$level = $this->request->getVar('level');
			$jenkel = $this->request->getVar('jenkel');

			$validation = \Config\Services::validation();

			$valid = $this->validate([
				'userid' => [
					'rules' => 'required|is_unique[users.userid]',
					'label' => 'Username',
					'errors' => [
						'required' => '{field} harus diisi',
						'is_unique' => '{field} Tidak boleh ada yang sama',
					]
				],
				'namalengkap' => [
					'rules' => 'required',
					'label' => 'Nama Lengkap',
					'errors' => [
						'required' => '{field} harus diisi',
					]
				],
				'level' => [
					'rules' => 'required',
					'label' => 'Level User',
					'errors' => [
						'required' => '{field} harus diisi',
					]
				],
				'jenkel' => [
					'rules' => 'required',
					'label' => 'Jenis kelamin',
					'errors' => [
						'required' => '{field} harus diisi',
					]
				]
			]);

			if(!$valid){
				$error = [
					'userid' => $validation->getError('userid'),
					'namalengkap' => $validation->getError('namalengkap'),
					'level' => $validation->getError('level'),
					'jenkel' => $validation->getError('jenkel'),
				];

				$json = [
					'error' => $error
				];
				
			}else{
				$modelUser = new Modelusers();
				$modelUser->insert([
					'userid' => $userid,
					'nama_user' => $namalengkap,
					'userlevelid' => $level,
					'jenkel' => $level
				]);
				$json = [
					'sukses' => 'Simpan data user berhasil'
				];

			}
			echo json_encode($json);
		}
	}
	function formedit()
	{
		if ($this->request->isAJAX()) {
			$iduser = $this->request->getPost('userid');
			$modelUser = new Modelusers();
			$rowUser = $modelUser->find($iduser);
			if ($rowUser) {
				$db = \Config\Database::connect();
				$data = [
					'datalevel' => $db->table('levels')->where('levelid !=','1')->get(),
					'userid' => $iduser,
					'namalengkap' => $rowUser['nama_user'],
					'level' => $rowUser['userlevelid'],
					'status' => $rowUser['useraktif'],
					'foto' => $rowUser['foto']
				];
				echo view('users/modaledit', $data);
			}
			
		}
	}

	function update()
	{
		if ($this->request->isAJAX()) {
			$iduser = $this->request->getVar('userid');
			
			$namalengkap = $this->request->getVar('namalengkap');
			$level = $this->request->getVar('level');
			
			$modelUser = new Modelusers();
			$modelUser->update($iduser,[
				'nama_user' => $namalengkap,
				'userlevelid' => $level,
			]);
			$json = [
				'sukses' => 'Update data user berhasil'
			];

			echo json_encode($json);
		}
	}
	function updateStatus()
	{
		if ($this->request->isAJAX()) {
			$iduser = $this->request->getVar('iduser');
			$modelUser = new Modelusers();

			$rowuser = $modelUser->find($iduser);

			$useraktif = $rowuser['useraktif'];
			if ($useraktif == '1') {
				$modelUser->update($iduser,[
					'useraktif' => '0'
				]);
			}else{
				$modelUser->update($iduser,[
					'useraktif' => '1'
				]);
			}
			$json = [
				'sukses' => ''
			];
			echo json_encode($json);
		}
	}

	function hapus()
	{
		if ($this->request->isAJAX()) {
			$iduser = $this->request->getPost('iduser');
			$modelUser = new Modelusers();
			$modelUser->delete($iduser);

			$json = [
				'sukses' => 'User berhasil dihapus'
			];
			echo json_encode($json);

		}
	}

	function resetPassword()
	{
		if ($this->request->isAJAX()) {
			$iduser = $this->request->getPost('iduser');

			$modelUser = new Modelusers();

			$passRandom = rand(1,99999);

			$passHashBaru = password_hash($passRandom, PASSWORD_DEFAULT);

			$modelUser->update($iduser,[
				'userpassword' => $passHashBaru
			]);
			$json = [
				'sukses' => '',
				'passwordBaru' => $passRandom
			];
			echo json_encode($json);
		}
	}
	public function formupload()
	{
		if ($this->request->isAJAX()) {
			$userid = $this->request->getVar('userid');

			$data = [
				'userid' => $userid
			];
			
			echo view('users/modalupload', $data);
			
		}
	}

	public function doupload()
	{
		if ($this->request->isAJAX()) {
			$iduser = $this->request->getVar('iduser');

			$validation = \Config\Services::validation();

			if ($_FILES['foto']['name'] == NULL && $this->request->getPost('imagecam') == '') {
				$msg = ['error' => 'Silahkan pilih salah satu ya..'];
			}
			elseif ($_FILES['foto']['name'] == NULL) {
				$cekdata = $this->users->find($iduser);
				$fotolama = $cekdata['foto'];
				if ($fotolama != NULL || $fotolama != "") {
					unlink($fotolama);
				}

				$image = $this->request->getPost('imagecam');
				$image = str_replace('data:image/jpeg;base64,', '', $image);

				$image = base64_decode($image, true);
				$filename = $iduser . '.jpg';
				file_put_contents(FCPATH. '/assets/images/foto/' . $filename, $image);

				$updatedata = [
					'foto' => './assets/images/foto/'. $filename
				];
				$this->users->update($iduser, $updatedata);
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
					$cekdata = $this->users->find($iduser);
					$fotolama = $cekdata['foto'];
					if ($fotolama != NULL || $fotolama != "") {
						unlink($fotolama);
					}
					$filefoto = $this->request->getFile('foto');
					$filefoto->move('assets/images/foto', $iduser.'.'.$filefoto->getExtension());
					$updatedata = [
						'foto' => './assets/images/foto/'.$filefoto->getName()
					];
					$this->users->update($iduser, $updatedata);

					$msg = [
						'sukses' => 'Berhasil diupload'
					];
				}

			}
			
			echo json_encode($msg);
		}
	}

	
}
