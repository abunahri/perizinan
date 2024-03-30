<?php

namespace App\Controllers;
use App\Models\Modelpriode;
use App\Models\Modeldatapriode;
use App\Models\Modelsetting;
use Config\Services;

class Priode extends BaseController
{
	public function __construct()
	{
		$this->priode = new Modelpriode();
	}

	public function index()
	{
		$modelSetting = new Modelsetting();
		$data = [
			'setting' => $modelSetting->get()->getRowArray()
		];
		
		return view('priode/data', $data);
	}

	function ambilDataPriode()
	{
		if ($this->request->isAJAX()) {
			$request = Services::request();
			$datapriode = new Modeldatapriode($request);
			if ($request->getMethod(true) == 'POST') {
				$lists = $datapriode->get_datatables();
				$data = [];
				$no = $request->getPost("start");
				foreach ($lists as $list) {
					$no++;

					$tombolHapus = "<button type=\"button\" class=\"btn btn-sm btn-danger\" onclick=\"hapus('" . $list->priode_id . "','" . $list->priode . "')\"><i class=\"fa fa-trash-alt\"></i></button>";
					$tombolEdit = "<button type=\"button\" class=\"btn btn-sm btn-info\" onclick=\"edit('" . $list->priode_id . "')\"><i class=\"fa fa-pencil-alt\"></i></button>";
					
					$tombolaktif = "<button type=\"button\" class=\"btn btn-sm btn-success\" title=\"Aktifkan\" onclick=\"aktif('" . $list->priode_id . "','" . $list->priode . "')\"><i class=\"fa fa-check\"></i></button>";
					$tomboltakaktif = "<button type=\"button\" class=\"btn btn-sm btn-danger\" title=\"Non Aktifkan\" onclick=\"nonaktif('" . $list->priode_id . "','" . $list->priode . "')\"><i class=\"fa fa-times\"></i></button>";

					$row = [];
					$row[] = $no;
					$row[] = $list->tahun;
					$row[] = $list->priode;
					$row[] = ($list->status == 1) ? "Aktif" : "Tidak Aktif";
					$row[] = ($list->status != 1) ? $tombolaktif : $tomboltakaktif;
					$row[] = $tombolHapus .' '. $tombolEdit;
					$data[] = $row;
				}
				$output = [
					"draw" => $request->getPost('draw'),
					"recordsTotal" => $datapriode->count_all(),
					"recordsFiltered" => $datapriode->count_filtered(),
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
				'data' => view('priode/formtambah', ['aksi' => $aksi])
			];

			echo json_encode($msg);
		} else {
			exit('Maaf tidak ada halaman yang bisa ditampilkan');
		}
	}

	public function simpandata()
	{
		if ($this->request->isAJAX()) {
			$tahun = $this->request->getVar('tahun');
			$priode = $this->request->getVar('priode');

			$this->priode->insert([
				'tahun' => $tahun,
				'priode' => $priode,
				'status' => '0',
			]);

			$msg = [
				'sukses' => 'Tahun Ajaran berhasil ditambahkan'
			];
			echo json_encode($msg);
		}
	}

	function formEdit()
	{
		if ($this->request->isAJAX()) {
			$priode_id =  $this->request->getVar('priode_id');

			$ambildatapriode = $this->priode->find($priode_id);
			$data = [
				'priode_id' => $priode_id,
				'tahun' => $ambildatapriode['tahun'],
				'priode' => $ambildatapriode['priode'],
			];

			$msg = [
				'data' => view('priode/formedit', $data)
			];
			echo json_encode($msg);
		}
	}

	function updatedata()
	{
		if ($this->request->isAJAX()) {
			$priode_id = $this->request->getVar('priode_id');
			$tahun = $this->request->getVar('tahun');
			$priode = $this->request->getVar('priode');

			$this->priode->update($priode_id, [
				'tahun' => $tahun,
				'priode' => $priode
			]);

			$msg = [
				'sukses' =>  'Tahun Ajaran berhasil diupdate'
			];
			echo json_encode($msg);
		}
	}

	function hapus()
	{
		if ($this->request->isAJAX()) {
			$priode_id = $this->request->getVar('priode_id');

			$this->priode->delete($priode_id);

			$msg = [
				'sukses' => 'Tahun Ajaran berhasil dihapus'
			];
			echo json_encode($msg);
		}
	}

	function aktif()
	{
		if ($this->request->isAJAX()) {
			$priode_id = $this->request->getVar('priode_id');
			// $status = $this->request->getVar('status');

			$db = \Config\Database::connect();
			$db->table('priode')->update(['status' => 0]);
			

			$this->priode->update($priode_id, [
				'status' => '1'
			]);

			$msg = [
				'sukses' => 'Tahun Ajaran berhasil diaktifkan'
			];
			echo json_encode($msg);
		}
	}
}
