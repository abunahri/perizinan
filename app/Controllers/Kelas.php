<?php

namespace App\Controllers;

use App\Models\Modelkelas;
use App\Models\Modeldatakelas;
use Config\Services;

class Kelas extends BaseController
{
	public function __construct()
	{
		$this->kelas = new Modelkelas();
	}

	public function index()
	{
		return view('kelas/data');
	}

	function ambilDataKelas()
	{
		if ($this->request->isAJAX()) {
			$request = Services::request();
			$datakelas = new Modeldatakelas($request);
			if ($request->getMethod(true) == 'POST') {
				$lists = $datakelas->get_datatables();
				$data = [];
				$no = $request->getPost("start");
				foreach ($lists as $list) {
					$no++;

					$tombolHapus = "<button type=\"button\" class=\"btn btn-sm btn-danger\" onclick=\"hapus('" . $list->id_kelas . "','" . $list->nama_kelas . "')\"><i class=\"fa fa-trash-alt\"></i></button>";
					$tombolEdit = "<button type=\"button\" class=\"btn btn-sm btn-info\" onclick=\"edit('" . $list->id_kelas . "')\"><i class=\"fa fa-pencil-alt\"></i></button>";

					$row = [];
					$row[] = $no;
					$row[] = $list->nama_kelas;
					$row[] = $tombolHapus . ' ' . $tombolEdit;
					$data[] = $row;
				}
				$output = [
					"draw" => $request->getPost('draw'),
					"recordsTotal" => $datakelas->count_all(),
					"recordsFiltered" => $datakelas->count_filtered(),
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
				'data' => view('kelas/modalformtambah', ['aksi' => $aksi])
			];
			echo json_encode($msg);
		}
	}

	function simpandata()
	{
		if ($this->request->isAJAX()) {
			$namakelas = $this->request->getVar('namakelas');

			$this->kelas->insert([
				'nama_kelas' => $namakelas
			]);

			$msg = [
				'sukses' => 'Kelas berhasil ditambahkan'
			];
			echo json_encode($msg);
		}
	}

	function formEdit()
	{
		if ($this->request->isAJAX()) {
			$idkelas =  $this->request->getVar('idkelas');

			$ambildatakelas = $this->kelas->find($idkelas);
			$data = [
				'idkelas' => $idkelas,
				'namakelas' => $ambildatakelas['nama_kelas']
			];

			$msg = [
				'data' => view('kelas/modalformedit', $data)
			];
			echo json_encode($msg);
		}
	}

	function updatedata()
	{
		if ($this->request->isAJAX()) {
			$idKelas = $this->request->getVar('idkelas');
			$namaKelas = $this->request->getVar('namakelas');

			$this->kelas->update($idKelas, [
				'nama_kelas' => $namaKelas
			]);

			$msg = [
				'sukses' =>  'Data kelas berhasil diupdate'
			];
			echo json_encode($msg);
		}
	}

	function hapus()
    {
        if ($this->request->isAJAX()) {
        	$idKelas = $this->request->getVar('idkelas');

            $this->kelas->delete($idKelas);

            $msg = [
                'sukses' => 'Kelas berhasil dihapus'
            ];
            echo json_encode($msg);
        }
    }
}
