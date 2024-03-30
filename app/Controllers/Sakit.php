<?php

namespace App\Controllers;
use App\Models\Modeldatasantrisakit;
use App\Models\Modelsakit;
use App\Models\Modelsantri;
use App\Models\Modelkelas;
use App\Models\Modelsetting;
use App\Models\Modelpriode;
use App\Models\Modelkamar;
use \DateTime;
// use App\Helpers\ConvertTgl;
use Config\Services;

class Sakit extends BaseController
{
	public function index()
	{
		return view('sakit/input');
	}

	public function ambilDataPriode()
	{
		if ($this->request->isAJAX()) {
			$datapriode = $this->db->table('priode')->where('status', '1')->get();

			foreach ($datapriode->getResultArray() as $row) :
				$isidata = '<option value="' . $row['priode_id'] . '">' . $row['priode'] . '</option>';
			endforeach;

			$msg = [
				'data' => $isidata
			];
			echo json_encode($msg);
		}
	}

	function cariDataSiswa()
	{
		if ($this->request->isAJAX()) {
			$json = [
				'data' => view('sakit/viewmodalcarisantrisakit')
			];

			echo json_encode($json);

		}else{
			exit('Maaf Tidak bisa dipanggil');
		}
	}

	public function listDataSantri()
	{
		if ($this->request->isAJAX()) {
			$jenkel = session()->jenkel;
			$kode_musrif = session()->iduser;
			$request = Services::request();
			$modelSantri = new Modeldatasantrisakit($request);
			if($request->getMethod(true)=='POST'){
				$lists = $modelSantri->get_datatables($kode_musrif);
				$data = [];
				$no = $request->getPost("start");
				foreach ($lists as $list) {
					$no++;
					$row = [];
					$row[] = $no;
					$row[] = $list->nis;
					$row[] = $list->nama;
					$row[] = $list->nama_kelas;
					$row[] = $list->nama_kamar;
					$row[] = $list->telp;
					$row[] = "<button type=\"button\" class=\"btn btn-sm btn-primary\" onclick=\"pilihitem('".$list->nis."', '".$list->nama."', '".$list->nama_kelas."', '".$list->nama_kamar."')\">Pilih</button>";
					$data[] = $row;
				}
				$output = ["draw" => $request->getPost('draw'),
				"recordsTotal" => $modelSantri->count_all($jenkel, $kode_musrif),
				"recordsFiltered" => $modelSantri->count_filtered($jenkel, $kode_musrif),
				"data" => $data];
				echo json_encode($output);
			}
		}
	}

	function ambilDataSiswa()
	{
		if ($this->request->isAJAX()) {
			$nis = $this->request->getPost('nis');
			$modelSantri = new Modelsantri();
			$cekData = $modelSantri->tampildata($nis)->getRowArray();


			if ($cekData == null) {
				$json = [
					'error' => 'Maaf..! data santri tidak ditemukan..'
				];
			}else{
				$data = [
					'nisn' => $cekData['nisn'],
					'nama' => $cekData['nama'],
					'nama_kelas' => $cekData['nama_kelas'],
					'nama_kamar' => $cekData['nama_kamar'],
					'kamar' => $cekData['santri_idkamar'],
					'kelas' => $cekData['santri_idkelas'],
					
					'gambar' => $cekData['foto_santri']
				];

				$json = [
					'sukses' => $data
				];

			}

			echo json_encode($json);
		}
	}

	public function simpanSakit()
	{
		if ($this->request->isAJAX()) {
			
			$nis = $this->request->getPost('nis');
			$kelas = $this->request->getPost('kelas');
			$kamar = $this->request->getPost('kamar');
			$sakit = $this->request->getPost('sakit');
			$penanganan = $this->request->getPost('penanganan');
			$priode = $this->request->getPost('priode');
			
			$modelSakit = new Modelsakit();
			
			$modelSakit->insert([
				
				'tanggal' => date('Y-m-d'),
				'priode_id' => $priode,
				'nis' => $nis,
				'kode_musrif' => session()->iduser,
				'id_kamar' => $kamar,
				'id_kelas' => $kelas,
				'sakit' => $sakit,
				'penanganan' => $penanganan,
			]);
			$json = [
				'sukses' => 'Data sakit berhasil diproses'

			];

			echo json_encode($json);
		}
	}

	public function data()
	{
		return view('sakit/data');
	}
}
