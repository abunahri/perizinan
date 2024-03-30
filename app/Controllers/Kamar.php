<?php

namespace App\Controllers;

use App\Models\Modelkamar;
use App\Models\Modeldatakamar;
use Config\Services;

class Kamar extends BaseController
{
	public function __construct()
	{
		$this->kamar = new Modelkamar();
	}

	public function index()
	{
		return view('kamar/data');
	}

	function ambilDataKamar()
	{
		if ($this->request->isAJAX()) {
			$request = Services::request();
			$datakamar = new Modeldatakamar($request);
			if ($request->getMethod(true) == 'POST') {
				$lists = $datakamar->get_datatables();
				$data = [];
				$no = $request->getPost("start");
				foreach ($lists as $list) {
					$no++;

					$tombolHapus = "<button type=\"button\" class=\"btn btn-sm btn-danger\" onclick=\"hapus('" . $list->id_kamar . "','" . $list->nama_kamar . "')\"><i class=\"fa fa-trash-alt\"></i></button>";
					$tombolEdit = "<button type=\"button\" class=\"btn btn-sm btn-info\" onclick=\"edit('" . $list->id_kamar . "')\"><i class=\"fa fa-pencil-alt\"></i></button>";

					$row = [];
					$row[] = $no;
					$row[] = $list->nama_kamar;
					$row[] = $tombolHapus . ' ' . $tombolEdit;
					$data[] = $row;
				}
				$output = [
					"draw" => $request->getPost('draw'),
					"recordsTotal" => $datakamar->count_all(),
					"recordsFiltered" => $datakamar->count_filtered(),
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
				'data' => view('kamar/modalformtambah', ['aksi' => $aksi])
			];
			echo json_encode($msg);
		}
	}

	function simpandata()
	{
		if ($this->request->isAJAX()) {
			$namakamar = $this->request->getVar('namakamar');

			$this->kamar->insert([
				'nama_kamar' => $namakamar
			]);

			$msg = [
				'sukses' => 'Kamar berhasil ditambahkan'
			];
			echo json_encode($msg);
		}
	}

	function formEdit()
	{
		if ($this->request->isAJAX()) {
			$idkamar =  $this->request->getVar('idkamar');

			$ambildatakamar = $this->kamar->find($idkamar);
			$data = [
				'idkamar' => $idkamar,
				'namakamar' => $ambildatakamar['nama_kamar']
			];

			$msg = [
				'data' => view('kamar/modalformedit', $data)
			];
			echo json_encode($msg);
		}
	}

	function updatedata()
	{
		if ($this->request->isAJAX()) {
			$idKamar = $this->request->getVar('idkamar');
			$namaKamar = $this->request->getVar('namakamar');

			$this->kamar->update($idKamar, [
				'nama_kamar' => $namaKamar
			]);

			$msg = [
				'sukses' =>  'Data kamar berhasil diupdate'
			];
			echo json_encode($msg);
		}
	}

	function hapus()
    {
        if ($this->request->isAJAX()) {
        	$idKamar = $this->request->getVar('idkamar');

            $this->kamar->delete($idKamar);

            $msg = [
                'sukses' => 'Kamar berhasil dihapus'
            ];
            echo json_encode($msg);
        }
    }
}
