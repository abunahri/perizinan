<?php

namespace App\Helpers;

class ConvertTgl

{

	public function get_tgl($tgl)

	{

		$bulan = [

			1 =>  'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'

		];



		$pecah_tgl = explode('-', $tgl);

		$tgl_indo = $pecah_tgl[2] .' ' . $bulan[(int)$pecah_tgl[1]] . ' ' . $pecah_tgl[0];

		return $tgl_indo;

	}

	function tgl_indonesia($date){
		$Bulan = array("Jan","Feb","Mar","Apr",
			"Mei","Jun","Jul","Agu","Sep",
			"Okt","Nov","Des");
		$Hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
		$tahun = substr($date, 0, 4);
		$bulan = substr($date, 5, 2);
		$tgl = substr($date, 8, 2);
		$waktu = substr($date, 11, 5);
		$hari = date("w", strtotime($date));
		return $result = $Hari[$hari].", ".$tgl." ".$Bulan[(int)$bulan-1]." ".$tahun." ".$waktu." WIB";
	}

	

}