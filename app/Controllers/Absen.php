<?php

namespace App\Controllers;
use App\Models\Modelkamar;
use App\Models\Modelsantri;
use App\Models\Modelmusrif;
use App\Models\Modelabsen;
use App\Models\Modelpriode;
// use App\Models\Modelmusrif;
use CodeIgniter\I18n\Time;
use DateTime;
use DateInterval;
use DatePeriod;
use Config\Services;

class Absen extends BaseController
{
	public function __construct()
	{
		$this->absen = new Modelabsen();
		$this->db = db_connect();
		
	}
	
	public function index()
	{
		
		return view('absen/data');
	}

	public function input()
	{
		$request = \Config\Services::request();
		$kode_musrif = session()->iduser;
		$modelMusrif = new Modelmusrif();
		$modelSantri = new Modelsantri();
		$dataMusrif = $modelMusrif->tampilKamar($kode_musrif)->getRowArray();
		$dataAbsen = $modelSantri->tampilAbsen($kode_musrif);
		$modelPriode = new Modelpriode();
		$datapriode = $modelPriode->tampildataAktif()->getRowArray();
		$tgl_absen = $this->request->getPost('tgl_absen');
		$data = [
			'kamar' => $dataMusrif['nama_kamar'],
			'datamusrif' => $dataMusrif,
			'tampildata' => $dataAbsen,
			'jenkel' => $dataMusrif['jenkel'],
			'priode' => $datapriode['priode_id'],
			'tgl_absen' => $request->uri->getSegment(3)

		];
		return view('absen/input', $data);

		
	}

	public function simpanabsen()
	{
		if ($this->request->isAJAX()) {
			
			$ket = $this->request->getVar('ket');
			$kamar = $this->request->getVar('kamar');
			$musrif = $this->request->getVar('musrif');
			$nis = $this->request->getVar('nis');
			$priode = $this->request->getVar('priode');
			$tgl_absen = $this->request->getVar('tgl_absen');

			$modelSantri = new Modelsantri();
			$modelMusrif = new Modelmusrif();
			$dataAbsen = $modelSantri->tampilAbsen(session()->iduser);
			// $dataMusrif = $modelMusrif->tampilKamar($kode_musrif)->getRowArray();
			$modelAbsen = new Modelabsen();
			
			$jmldata = count($ket);
			for ($i=0; $i < $jmldata; $i++) { 
				$cekData = $modelAbsen->getWhere(['tanggal' => $tgl_absen, 'absen_nis' => $nis[$i]]);

				if ($cekData->getNumRows() > 0) {
					$json = [
						'error' => 'Upp..!, Tanggal '.date('d  F  Y',strtotime($tgl_absen)).' Sudah Absen'
					];
				}else if($tgl_absen == ""){
					$modelAbsen->insert([
						'absen_nis' => $nis[$i],
						'absen_kamar' => $kamar,
						'absen_musrif' => $musrif,
						'tanggal' => date('Y-m-d'),
						'keterangan' => $ket[$i],
						'absen_priode' => $priode,
						'bulan' => date('F'),
					]);
					$json = [
						'sukses' => 'Absen berhasil disimpan'
					];
				}else{
					$modelAbsen->insert([
						'absen_nis' => $nis[$i],
						'absen_kamar' => $kamar,
						'absen_musrif' => $musrif,
						'tanggal' => date('Y-m-d',strtotime($tgl_absen)),
						'keterangan' => $ket[$i],
						'absen_priode' => $priode,
						'bulan' => date('F',strtotime($tgl_absen)),
					]);
					$json = [
						'sukses' => 'Absen berhasil disimpan'
					];

				}
				
			}
			echo json_encode($json);

		}

	}

	public function rekap()
	{
		return view('absen/rekap');
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

	public function tampilRekap()
	{
		if ($this->request->isAJAX()) {
			$bulan = $this->request->getPost('bulan');
			$kamar = $this->request->getPost('kamar');
			$ta = $this->request->getPost('priode');
			$modelAbsen = new Modelabsen();
			// $now = Time::now();
			// $today = $now->toDateString();
			$i = 0;
			$arrayTanggal = [];
			$dataAbsen = [];

			$tahun = date('Y');
			// $tgl = $modelAbsen->findAll();
			// $bln = date('F', mktime(0, 0, 0, $bulan, 10));

			// $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
			// $dataRekap = $modelAbsen->tampilAbsen($ta, session()->iduser, $bulan)->get();

			// $dataRekaptgl = $modelAbsen->tampilAbsentgl($priode, session()->iduser, $bulan)->getResultArray();

			$modelMusrif = new Modelmusrif();
			$modelSantri = new Modelsantri();
			$dataMusrif = $modelMusrif->tampilKamar(session()->iduser)->getRowArray();


			

			$begin = new DateTime($bulan);
			$interval = DateInterval::createFromDateString('1 day');
			$end = (new DateTime($begin->format('Y-m-t')))->modify('+1 day');
			$period = new DatePeriod($begin, $interval, $end);
			
			// $dataSantri = $modelAbsen->tampilAbsensi($ta, session()->iduser, $begin->format('F'));

			foreach ($period as $value) {

				if ($value->format('D')) {
					$lewat = Time::parse($value->format('Y-m-d'))->isAfter(Time::today());

					$absenByTanggal = $this->absen->getPresensi($ta, session()->iduser, $value->format('Y-m-d'))->getResultArray();

					$absenByTanggal['lewat'] = $lewat;

					array_push($dataAbsen, $absenByTanggal);
					array_push($arrayTanggal, $value);

				}
			}

			$data = [
				'tanggal' => $arrayTanggal,
				'bulan' => $begin->format('F'),
				'listAbsen' => $dataAbsen,
				'listSantri' => $modelAbsen->tampilAbsensi($ta, session()->iduser, $begin->format('F')),
				// 'bulan' =>  date('F', mktime(0, 0, 0, $bulan, 10)),
				// 'tanggal' => cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun),
				// 'tampildata' => $modelAbsen->tampilAbsensi($ta, session()->iduser, $value->format('Y-m-d'))->getRowArray(),
				// 'tampilabsen' => $dataRekaptgl,
				'kamar' => $dataMusrif['nama_kamar'],
				'jenkel' => $dataMusrif['jenkel']
			];

			$json = [
				'data' => view('absen/datarekap', $data)
			];
			echo json_encode($json);
		}
	}


}
