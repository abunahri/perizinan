<?php

namespace App\Controllers;
use App\Models\Modelkelas;
use App\Models\Modelkamar;
use App\Models\Modelsantri;
use App\Models\Modelizin;
use App\Models\Modelsetting;
use App\Models\Modelpriode;
use App\Models\Modelabsen;
use App\Models\Modelmusrif;
use CodeIgniter\I18n\Time;
use DateTime;
use DateInterval;
use DatePeriod;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Config\Services;

class Laporan extends BaseController
{
	public function __construct()
	{
		$this->absen = new Modelabsen();
		$this->db = db_connect();
		
	}

	public function data()
	{
		return view('laporan/data');
	}

	public function viewdataPulang()
	{
		return view('laporan/viewdataPulang');
	}

	public function viewdataKeluar()
	{
		return view('laporan/viewdataKeluar');
	}

	public function ambilDataKelas()
	{
		if ($this->request->isAJAX()) {
			$datakelas = $this->db->table('kelas')->orderBy('nama_kelas', 'asc')->get();

			$isidata = "<option value='' selected>-- Pilih Kelas --</option>";

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
			$datakamar = $this->db->table('kamar')->orderBy('nama_kamar', 'asc')->get();

			$isidata = "<option value='' selected>-- Pilih Kamar --</option>";

			foreach ($datakamar->getResultArray() as $row) :
				$isidata .= '<option value="' . $row['id_kamar'] . '">' . $row['nama_kamar'] . '</option>';
			endforeach;

			$msg = [
				'data' => $isidata
			];
			echo json_encode($msg);
		}
	}

	public function ambilDataPriode()
	{
		if ($this->request->isAJAX()) {

			$datapriode = $this->db->table('priode')->orderBy('tahun', 'asc')->get();

			$isidata = "<option value='' selected>-- Pilih Tahun Ajaran --</option>";

			foreach ($datapriode->getResultArray() as $row) :
				$isidata .= '<option value="' . $row['priode_id'] . '">' . $row['priode'] . '</option>';
			endforeach;

			$msg = [
				'data' => $isidata
			];
			echo json_encode($msg);
		}
	}


	public function tampilrekapPulang()
	{
		if ($this->request->isAJAX()) {

			$kelas = $this->request->getPost('kelas');
			$kamar = $this->request->getPost('kamar');
			$priode = $this->request->getPost('priode');

			$modelIzin = new Modelizin();
			// $modelBayar = new Modelpembayaran();
			$modelSantri = new Modelsantri();
			$modelPriode = new Modelpriode();
			
			$dataRekapPulang = $modelIzin->tampilRekapPulang($kelas, $kamar, $priode);

			$data = [
				'tampildata' => $dataRekapPulang,
			];

			$json = [
				'data' => view('laporan/viewRekapPulang', $data)
			];

			echo json_encode($json);
			// return view('laporan/rekap', $data);
		}

	}

	public function tampilrekapKeluar()
	{
		if ($this->request->isAJAX()) {

			$kelas = $this->request->getPost('kelas');
			$kamar = $this->request->getPost('kamar');
			$priode = $this->request->getPost('priode');

			$modelIzin = new Modelizin();
			// $modelBayar = new Modelpembayaran();
			$modelSantri = new Modelsantri();
			
			$dataRekapKeluar = $modelIzin->tampilRekapKeluar($kelas, $kamar, $priode);

			$data = [
				'tampildata' => $dataRekapKeluar,
			];

			$json = [
				'data' => view('laporan/viewRekapKeluar', $data)
			];

			echo json_encode($json);
			// return view('laporan/rekap', $data);
		}

	}

	public function cetakrekappulang($kelas, $kamar, $priode)
	{
		
		$modelKelas = new Modelkelas();
		$modelSantri = new Modelsantri();
		$modelKamar = new Modelkamar();

		$modelIzin = new Modelizin();
		
		$modelSetting = new Modelsetting();
		
		$dataRekapPulang = $modelIzin->tampilRekapPulang($kelas, $kamar, $priode)->getRowArray();



		if ($dataRekapPulang != null) {
			$data = [
				'kelas' => $dataRekapPulang['nama_kelas'],
				'rekap' => $dataRekapPulang,
				'kamar' => $dataRekapPulang['nama_kamar'],
				'priode' => $dataRekapPulang['priode'],
				'tampildata' => $modelIzin->tampilRekapPulang($kelas, $kamar, $priode),
				'setting' => $modelSetting->get()->getRowArray()
				
			];
			return view('laporan/cetakrekappulang', $data);
		}else{
			return redirect()->to(site_url('laporan/viewdataPulang'));
		}
	}

	public function cetakrekapkeluar($kelas, $kamar, $priode)
	{
		
		$modelKelas = new Modelkelas();
		$modelSantri = new Modelsantri();
		$modelKamar = new Modelkamar();

		$modelIzin = new Modelizin();
		
		$modelSetting = new Modelsetting();
		
		$dataRekapKeluar = $modelIzin->tampilRekapKeluar($kelas, $kamar, $priode)->getRowArray();



		if ($dataRekapKeluar != null) {
			$data = [
				'kelas' => $dataRekapKeluar['nama_kelas'],
				'rekap' => $dataRekapKeluar,
				'kamar' => $dataRekapKeluar['nama_kamar'],
				'tampildata' => $modelIzin->tampilRekapKeluar($kelas, $kamar, $priode),
				'setting' => $modelSetting->get()->getRowArray()
				
			];
			return view('laporan/cetakrekapkeluar', $data);
		}else{
			return redirect()->to(site_url('laporan/viewdataKeluar'));
		}
	}

	public function cetakabsenbulanan($bulan, $tahun)
	{
		
		// $bulan = $this->request->getVar('bulan');
		// $kamar = $this->request->getPost('kamar');
		// $tahun = $this->request->getVar('priode');

		$modelMusrif = new Modelmusrif();
		$modelSantri = new Modelsantri();
		$modelAbsen = new Modelabsen();
		$modelSetting = new Modelsetting();
		$dataMusrif = $modelMusrif->tampilKamar(session()->iduser)->getRowArray();

		$begin = new DateTime($bulan);
		$interval = DateInterval::createFromDateString('1 day');
		$end = (new DateTime($begin->format('Y-m-t')))->modify('+1 day');
		$period = new DatePeriod($begin, $interval, $end);

		$dataSantri = $modelAbsen->tampilAbsensi($tahun, session()->iduser, $bulan)->getRowArray();

		$arrayTanggal = [];
		$dataAbsen = [];
		
		
		foreach ($period as $value) {

			if ($value->format('D')) {
				$lewat = Time::parse($value->format('Y-m-d'))->isAfter(Time::today());

				$absenByTanggal = $this->absen->getPresensi($tahun, session()->iduser, $value->format('Y-m-d'))->getResultArray();

				$absenByTanggal['lewat'] = $lewat;

				array_push($dataAbsen, $absenByTanggal);
				array_push($arrayTanggal, $value);

			}
		}
		
		$data = [
			'tanggal' => $arrayTanggal,
			'bulan' => $begin->format('F'),
			'listAbsen' => $dataAbsen,
			'listSantri' => $modelAbsen->tampilAbsensi($tahun, session()->iduser, $begin->format('F'))->getResultArray(),

			'kamar' => $dataMusrif['nama_kamar'],
			'musrif' => $dataMusrif['nama_musrif'],
			'jenkel' => $dataMusrif['jenkel'],
			'setting' => $modelSetting->get()->getRowArray(),
			'tahun' => $modelAbsen->tampilAbsensi($tahun, session()->iduser, $begin->format('F'))->getRowArray(),
			'siswa' => $modelSantri->get()->getRowArray()

		];
		return view('laporan/rekapabsen', $data);

	}
}
