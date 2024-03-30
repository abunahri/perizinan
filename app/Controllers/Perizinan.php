<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Modeldatasantri;
use App\Models\Modeldataizin;
use App\Models\Modeldataizinkeluar;
use App\Models\Modelizin;
use App\Models\Modelsantri;
use App\Models\Modelkelas;
use App\Models\Modelsetting;
use App\Models\Modelpriode;
use App\Models\Modelkamar;
use \DateTime;
// use App\Helpers\ConvertTgl;
use Config\Services;

class Perizinan extends BaseController
{
	private function buatNomor()
	{
		$tanggalSekarang = date('Y-m-d');
		$modelizin = new Modelizin();

		$hasil = $modelizin->noIzin($tanggalSekarang)->getRowArray();
		$data = $hasil['noizin'];

		$lastNoUrut = substr($data, -4);
		$nextNoUrut = intval($lastNoUrut) + 1;
		$noIzin = date('dmy', strtotime($tanggalSekarang)) . sprintf('%04s', $nextNoUrut);
		return $noIzin;
	}

	public function data()
	{
		return view('perizinan/data');
	}

	public function input()
	{

		$data = [
			'noizin' => $this->buatNomor()
		];
		return view('perizinan/input', $data);
	}

	public function viewdataPulang()
	{
		return view('perizinan/viewdataPulang');
	}

	public function viewdataKeluar()
	{
		return view('perizinan/viewdataKeluar');
	}

	public function buatNoIzin()
	{
		if ($this->request->getPost('jenisizin') == '') {
			$tanggalSekarang = $this->request->getPost('tanggal');
			$modelIzin = new Modelizin();

			$hasil = $modelIzin->noIzin($tanggalSekarang)->getRowArray();
			$data = $hasil['noizin'];

			$lastNoUrut = substr($data, -4);
			$nextNoUrut = intval($lastNoUrut) + 1;
			$noIzin = date('dmy', strtotime($tanggalSekarang)) . sprintf('%04s', $nextNoUrut);

			$json = [
				'noizin' => $noIzin
			];
			echo json_encode($json);
			

		}else if($this->request->getPost('jenisizin') == 'Pulang'){
			$tanggalSekarang = $this->request->getPost('tanggal');
			$modelIzin = new Modelizin();

			$hasil = $modelIzin->noIzin($tanggalSekarang)->getRowArray();
			$data = $hasil['noizin'];

			$lastNoUrut = substr($data, -4);
			$nextNoUrut = intval($lastNoUrut) + 1;
			$noIzin = "SIP".date('dmy', strtotime($tanggalSekarang)) . sprintf('%04s', $nextNoUrut);

			$json = [
				'noizin' => $noIzin
			];
			echo json_encode($json);
		}else{
			$tanggalSekarang = $this->request->getPost('tanggal');
			$modelIzin = new Modelizin();

			$hasil = $modelIzin->noIzin($tanggalSekarang)->getRowArray();
			$data = $hasil['noizin'];

			$lastNoUrut = substr($data, -4);
			$nextNoUrut = intval($lastNoUrut) + 1;
			$noIzin = "SIK".date('dmy', strtotime($tanggalSekarang)) . sprintf('%04s', $nextNoUrut);

			$json = [
				'noizin' => $noIzin
			];
			echo json_encode($json);
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

	function cariDataSiswa()
	{
		if ($this->request->isAJAX()) {
			$json = [
				'data' => view('perizinan/viewmodalcarisantri')
			];

			echo json_encode($json);

		}else{
			exit('Maaf Tidak bisa dipanggil');
		}
	}

	public function listDataSantri()
	{
		if ($this->request->isAJAX()) {
			$keywordnis = $this->request->getPost('keywordnis');
			$request = Services::request();
			$modelSantri = new Modeldatasantri($request);
			if($request->getMethod(true)=='POST'){
				$lists = $modelSantri->get_datatables($keywordnis);
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
				"recordsTotal" => $modelSantri->count_all($keywordnis),
				"recordsFiltered" => $modelSantri->count_filtered($keywordnis),
				"data" => $data];
				echo json_encode($output);
			}
		}
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

	public function listDataizin()
	{
		if ($this->request->isAJAX()) {
			$tglawal = $this->request->getPost('tglawal');
			$tglakhir = $this->request->getPost('tglakhir');


			$request = Services::request();
			$modelIzin = new Modeldataizin($request);
			if($request->getMethod(true)=='POST'){
				$lists = $modelIzin->get_datatables($tglawal,$tglakhir);
				$data = [];
				$no = $request->getPost("start");
				foreach ($lists as $list) {

					$no++;
					$row = [];

					$tombolCetak = "<button type=\"button\" class=\"btn btn-sm btn-info\" onclick=\"cetakpulang('".$list->izin_nomor."')\" title=\"Cetak\">
					<i class=\"fa fa-print\"></i>
					</button>";
					
					
					
					$tombolHapus = "<button type=\"button\" class=\"btn btn-sm btn-success\" onclick=\"kembali('".$list->izin_nomor."','".$list->nama."')\" title=\"Kembali\">
					<i class=\"fa fa-check\"></i>
					</button>";

					$telat = new DateTime($list->izin_tglkembali);
					$today = new DateTime();
					$lama = $today->diff($telat);

					$row[] = $no;
					$row[] = $list->izin_nomor;
					$row[] = $list->nama;
					$row[] = $list->nama_kelas;
					$row[] = $list->izin_tgl;
					$row[] = $list->izin_tglkembali;
					$row[] = $list->izin_keperluan;
					$row[] = $list->telp;
					$row[] = ($today > $telat) ? 'Telat ' . $lama->days . ' Hari' : $list->izin_status;
					$row[] = $tombolCetak.'  '.$tombolHapus;
					$data[] = $row;
				}
				$output = ["draw" => $request->getPost('draw'),
				"recordsTotal" => $modelIzin->count_all($tglawal,$tglakhir),
				"recordsFiltered" => $modelIzin->count_filtered($tglawal,$tglakhir),
				"data" => $data];
				echo json_encode($output);
			}
		}
	}

	public function listDataizinKeluar()
	{
		if ($this->request->isAJAX()) {
			$tglawal = $this->request->getPost('tglawal');
			$tglakhir = $this->request->getPost('tglakhir');

			$request = Services::request();
			$modelIzin = new Modeldataizinkeluar($request);
			if($request->getMethod(true)=='POST'){
				$lists = $modelIzin->get_datatables($tglawal,$tglakhir);
				$data = [];
				$no = $request->getPost("start");
				foreach ($lists as $list) {

					$no++;
					$row = [];
					
					$tombolCetak = "<button type=\"button\" class=\"btn btn-sm btn-info\" onclick=\"cetakkeluar('".$list->izin_nomor."')\" title=\"Cetak\">
					<i class=\"fa fa-print\"></i>
					</button>";
					
					
					
					$tombolHapus = "<button type=\"button\" class=\"btn btn-sm btn-success\" onclick=\"kembali('".$list->izin_nomor."','".$list->nama."')\" title=\"Kembali\">
					<i class=\"fa fa-check\"></i>
					</button>";
					$telat = new DateTime($list->izin_jamkmbli);
					$today = new DateTime();
					$lama = $today->diff($telat);

					$row[] = $no;
					$row[] = $list->izin_nomor;
					$row[] = $list->nama;
					$row[] = $list->nama_kelas;
					$row[] = $list->izin_tgl;
					$row[] = $list->izin_jam;
					$row[] = $list->izin_jamkmbli;
					$row[] = $list->izin_keperluan;
					$row[] = $list->telp;
					$row[] = ($today > $telat) ? 'Telat ' . $lama->h . ' Jam' : $list->izin_status;
					$row[] = $tombolCetak.'  '.$tombolHapus;
					$data[] = $row;
				}
				$output = ["draw" => $request->getPost('draw'),
				"recordsTotal" => $modelIzin->count_all($tglawal,$tglakhir),
				"recordsFiltered" => $modelIzin->count_filtered($tglawal,$tglakhir),
				"data" => $data];
				echo json_encode($output);
			}
		}
	}

	public function simpanIzin()
	{
		if ($this->request->isAJAX()) {
			$noizin = $this->request->getPost('noizin');
			$tgl_izin = $this->request->getPost('tgl_izin');
			$tgl_kembali = $this->request->getPost('tgl_kembali');
			$nis = $this->request->getPost('nis');
			$keperluan = $this->request->getPost('keperluan');
			$kelas = $this->request->getPost('kelas');
			$kamar = $this->request->getPost('kamar');
			$jam_izin = $this->request->getPost('jam_izin');
			$jam_kembali = $this->request->getPost('jam_kembali');
			$jenisizin = $this->request->getPost('jenisizin');
			$priode = $this->request->getPost('priode');
			
			$modelIzin = new Modelizin();
			if ($jenisizin == "Pulang") {
				$modelIzin->insert([
					'izin_nomor' => $noizin,
					'izin_tgl' => $tgl_izin,
					'izin_tglkembali' => $tgl_kembali,
					'izin_nis' => $nis,
					'izin_priode' => $priode,
					'izin_kelas' => $kelas,
					'izin_kamar' => $kamar,
					'izin_type' => $jenisizin,
					'izin_keperluan' => $keperluan,
					'izin_status' => 'Masih Izin',
				]);
				$json = [
					'sukses' => 'Izin berhasil diproses',
					'cetaksurat' => site_url('perizinan/cetaksurat/'.$noizin)
				];
			}else{
				$modelIzin->insert([
					'izin_nomor' => $noizin,
					'izin_tgl' => date('Y-m-d'),
					'izin_tglkembali' => date('Y-m-d'),
					'izin_jam' => $jam_izin,
					'izin_jamkmbli' => $jam_kembali,
					'izin_nis' => $nis,
					'izin_priode' => $priode,
					'izin_kelas' => $kelas,
					'izin_kamar' => $kamar,
					'izin_type' => $jenisizin,
					'izin_keperluan' => $keperluan,
					'izin_status' => 'Masih Izin',
				]);
				$json = [
					'sukses' => 'Izin berhasil diproses',
					'cetaksuratkeluar' => site_url('perizinan/cetaksuratkeluar/'.$noizin)
				];

			}

			echo json_encode($json);
		}
	}

	public function cetaksurat($noizin)
	{
		$modelIzin = new Modelizin();
		$modelSantri = new Modelsantri();
		$modelKelas = new Modelkelas();
		$modelKamar = new Modelkamar();

		$cekData = $modelIzin->find($noizin);
		$dataSantri = $modelSantri->find($cekData['izin_nis']);
		$dataKelas = $modelKelas->find($cekData['izin_kelas']);
		$dataKamar = $modelKamar->find($cekData['izin_kamar']);
		

		if ($cekData != null) {
			$data = [
				'izin_nomor' => $noizin,
				'nis' => $dataSantri['nis'],
				'nama' => $dataSantri['nama'],
				'kelas' => $dataKelas['nama_kelas'],
				'kamar' => $dataKamar['nama_kamar'],
				'ortu' => $dataSantri['nama_wali'],
				'tgl_izin' => $cekData['izin_tgl'],
				'tgl_kembali' => $cekData['izin_tglkembali'],
				'keperluan' => $cekData['izin_keperluan'],
				'jenkel' => $dataSantri['jenkel'],
				'dataizin' => $modelIzin->tampilCetakSurat($noizin),
				
			];
			return view('perizinan/cetaksurat', $data);
		}else{
			return redirect()->to(site_url('perizinan/input'));
		}
	}

	public function cetaksuratkeluar($noizin)
	{
		$modelIzin = new Modelizin();
		$modelSantri = new Modelsantri();
		$modelKelas = new Modelkelas();
		$modelKamar = new Modelkamar();

		$cekData = $modelIzin->find($noizin);
		$dataSantri = $modelSantri->find($cekData['izin_nis']);
		$dataKelas = $modelKelas->find($cekData['izin_kelas']);
		$dataKamar = $modelKamar->find($cekData['izin_kamar']);
		

		if ($cekData != null) {
			$data = [
				'izin_nomor' => $noizin,
				'nis' => $dataSantri['nis'],
				'nama' => $dataSantri['nama'],
				'kelas' => $dataKelas['nama_kelas'],
				'kamar' => $dataKamar['nama_kamar'],
				'ortu' => $dataSantri['nama_wali'],
				'tgl_izin' => $cekData['izin_tgl'],
				'jam_izin' => $cekData['izin_jam'],
				'jam_kembali' => $cekData['izin_jamkmbli'],
				'jenkel' => $dataSantri['jenkel'],
				'keperluan' => $cekData['izin_keperluan'],
				
				
			];
			return view('perizinan/cetaksuratkeluar', $data);
		}else{
			return redirect()->to(site_url('perizinan/input'));
		}
	}

	public function kembali()
	{
		if ($this->request->isAJAX()) {
			$noizin = $this->request->getVar('noizin');
			$modelIzin = new Modelizin();
			$modelIzin->update($noizin,[
				'izin_status' => 'Telah Kembali'

			]);
			$json = [
				'sukses' => 'Proses kembali berhasil disimpan!'
			];
			echo json_encode($json);
		}
	}

	public function cetakizinpulang()
	{
		$modelIzin = new Modelizin();
		$modelSetting = new Modelsetting();
		$dataizin = $modelIzin->tampilIzinPulang()->getRowArray();
		if ($dataizin != null) {
			$data = [
				
				'tampildata' => $modelIzin->tampilIzinPulang(),
				'setting' => $modelSetting->get()->getRowArray()
				
			];
			return view('perizinan/cetakdataizinpulang', $data);
		}else{
			return redirect()->to(site_url('perizinan/viewdataPulang'));
		}
		
	}

	public function cetakizinkeluar()
	{
		$modelIzin = new Modelizin();
		$modelSetting = new Modelsetting();
		$dataizin = $modelIzin->tampilIzinPulang()->getRowArray();
		if ($dataizin != null) {
			$data = [
				
				'tampildata' => $modelIzin->tampilIzinKeluar(),
				'setting' => $modelSetting->get()->getRowArray()
				
			];
			return view('perizinan/cetakdataizinkeluar', $data);
		}else{
			return redirect()->to(site_url('perizinan/viewdataKeluar'));
		}
		
	}
}
