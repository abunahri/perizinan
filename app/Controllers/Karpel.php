<?php

namespace App\Controllers;
use App\Models\Modelkelas;
use App\Models\Modelkamar;
use App\Models\Modelsantri;
use App\Models\Modeldatasantri;
use App\Helpers\ConvertTgl;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use App\Models\Modelsetting;

use Config\Services;

class Karpel extends BaseController
{
	public function __construct()
	{
		$this->ConvertTgl = new ConvertTgl();
	}

	public function data()
	{
		return view('karpel/cetak');
	}

	public function listdata()
	{
		if ($this->request->isAJAX()) {
			$keywordnis = $this->request->getPost('keywordnis');
			$request = Services::request();
			$datasantri = new Modeldatasantri($request);
			if ($request->getMethod(true) == 'POST') {
				$lists = $datasantri->get_datatables($keywordnis);
				$data = [];
				$no = $request->getPost("start");
				foreach ($lists as $list) {
					$no++;
					$row = [];

					// $tombolCetak = '<a href="'.site_url('santri/edit/'.$list->nis).'" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a>';

					$tombolCetak = "<button type=\"button\" class=\"btn btn-info btn-sm\" onclick=\"cetak('".$list->nis."','" . $list->nama . "')\" title=\"Cetak Kartu\">
					<i class=\"fa fa-print\"></i>
					</button>";
					$tombolCetakpdf = "<button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"cetakpdf('".$list->nis."','" . $list->nama . "')\" title=\"Cetak Kartu\">
					<i class=\"fa fa-file-pdf\"></i>
					</button>";

					$row[] = "<input type=\"checkbox\" name=\"nis[]\" class=\"centangNis\" value=\"$list->nis\">";

					$row[] = $no;
					$row[] = $list->nis;
					$row[] = $list->nisn;
					$row[] = $list->nama;
					$row[] = $list->jenkel;
					$row[] = $list->nama_kelas;
					$row[] = $list->alamat;
					$row[] = $list->telp;
					$row[] = $tombolCetak;
					$data[] = $row;
				}
				$output = [
					"draw" => $request->getPost('draw'),
					"recordsTotal" => $datasantri->count_all($keywordnis),
					"recordsFiltered" => $datasantri->count_filtered($keywordnis),
					"data" => $data
				];
				echo json_encode($output);
			}
		}

		
	}

	function cetakkarpel($nis)
	{
		$modelSantri = new Modelsantri();
		$modelSetting = new Modelsetting();
		$cekData = $modelSantri->find($nis);
		
		$writer = new PngWriter();

        // Create QR code
		$qrCode = QrCode::create($nis)
		->setEncoding(new Encoding('UTF-8'))
		->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
		->setSize(300)
		->setMargin(10)
		->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
		->setForegroundColor(new Color(0, 0, 0))
		->setBackgroundColor(new Color(255, 255, 255));

        // Create generic logo
		$logo = Logo::create('upload'.'/logo1.png')
		->setResizeToWidth(50);

        // Create generic label
		$label = Label::create($nis)
		->setTextColor(new Color(255, 0, 0));

		$result = $writer->write($qrCode, $logo);
		$result->saveToFile('upload/qrcode/' .$nis.'.png');

		$dataUri = $result->getDataUri();
		
		
		if ($cekData != null) {
			$data = [
				'nis' => $nis,
				'nisn' => $cekData['nisn'],
				'nama' => $cekData['nama'],
				'tmp_lahir' => $cekData['tmp_lahir'],
				'tgl_lahir' => $this->ConvertTgl->get_tgl($cekData['tgl_lahir']),
				'jenkel' => $cekData['jenkel'],
				'alamat' => $cekData['alamat'],
				'foto' => $cekData['foto_santri'],
				'qrcode' => $dataUri,
				'setting' => $modelSetting->get()->getRowArray()

			];
			return view('karpel/cetakkarpel', $data);
		}else{
			return redirect()->to(site_url('karpel/data'));
		}

	}

	function cetakbanyak()
	{

		if ($this->request->isAJAX()) {
			$nis = $this->request->getVar('nis');
			$modelSantri = new Modelsantri();
			$jmldata = count($nis);

			for ($i=0; $i < $jmldata; $i++) { 
				$data = [
					'detailData' => $modelSantri->tampildata($nis[$i])
				];

				
				
			}
			$json = [
				'data' => view('karpel/cetakkarpelbanyak', $data)

			];

			
			echo json_encode($json);


		}

	}
}
