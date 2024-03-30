<?php 
namespace App\Models;

use CodeIgniter\Model;

class Modelizin extends Model
{
	protected $table      = 'izin';
	protected $primaryKey = 'izin_nomor';

	protected $allowedFields = ['izin_nomor','izin_tgl','izin_tglkembali','izin_jam','izin_jamkmbli','izin_nis','izin_priode','izin_kelas','izin_kamar','izin_type','izin_keperluan','izin_status'];


	public function noIzin($tanggalSekarang)
	{
		return $this->table('izin')->select('max(izin_nomor) as noizin')->where('izin_tgl', $tanggalSekarang)->get();
	}

	public function tampilCetakSurat($noizin)
	{
		return $this->table('izin')
		->join('santri', 'nis=izin_nis')
		->join('kelas', 'id_kelas=izin_kelas')
		->join('kamar', 'id_kamar=izin_kamar')
		->join('priode', 'priode_id=izin_priode')
		->where('izin_nomor', $noizin)
		->get();
	}

	public function tampilDataIzin($jenis,$tglawal,$tglakhir)
	{
		return $this->table('izin')
		->join('santri', 'nis=izin_nis')
		->join('kelas', 'id_kelas=izin_kelas')
		->join('kamar', 'id_kamar=izin_kamar')
		->join('priode', 'priode_id=izin_priode')
		->where('izin_type', $jenis)
		->where('izin_tgl >=',$tglawal)
		->where('izin_tgl <=',$tglakhir)
		->where('status', 1)
		->where('izin_status', 'Masih Izin')
		->get();
	}

	public function tampilIzinPulang()
	{
		return $this->table('izin')
		->join('santri', 'nis=izin_nis')
		->join('kelas', 'id_kelas=izin_kelas')
		->join('kamar', 'id_kamar=izin_kamar')
		->join('priode', 'priode_id=izin_priode')
		->where('izin_type', 'Pulang')
		->where('status', 1)
		->where('izin_status', 'Masih Izin')
		->get();
	}

	public function tampilIzinKeluar()
	{
		return $this->table('izin')
		->join('santri', 'nis=izin_nis')
		->join('kelas', 'id_kelas=izin_kelas')
		->join('kamar', 'id_kamar=izin_kamar')
		->join('priode', 'priode_id=izin_priode')
		->where('izin_type', 'Keluar')
		->where('status', 1)
		->where('izin_status', 'Masih Izin')
		->get();
	}

	public function tampilRekapPulang($kelas, $kamar, $priode)
	{
		return $this->table('izin')
		->select('*')
		->select('COUNT(IF(MONTH(izin_tgl)=7,izin_nis,null)) AS Juli')
		->select('COUNT(IF(MONTH(izin_tgl)=8,izin_nis,null)) AS Agustus')
		->select('COUNT(IF(MONTH(izin_tgl)=9,izin_nis,null)) AS September')
		->select('COUNT(IF(MONTH(izin_tgl)=10,izin_nis,null)) AS Oktober')
		->select('COUNT(IF(MONTH(izin_tgl)=11,izin_nis,null)) AS November')
		->select('COUNT(IF(MONTH(izin_tgl)=12,izin_nis,null)) AS Desember')
		->select('COUNT(IF(MONTH(izin_tgl)=1,izin_nis,null)) AS Januari')
		->select('COUNT(IF(MONTH(izin_tgl)=2,izin_nis,null)) AS Februari')
		->select('COUNT(IF(MONTH(izin_tgl)=3,izin_nis,null)) AS Maret')
		->select('COUNT(IF(MONTH(izin_tgl)=4,izin_nis,null)) AS April')
		->select('COUNT(IF(MONTH(izin_tgl)=5,izin_nis,null)) AS Mei')
		->select('COUNT(IF(MONTH(izin_tgl)=6,izin_nis,null)) AS Juni')
		->select('COUNT(izin_nis) AS Total')
		->join('santri', 'nis=izin_nis')
		->join('kelas', 'id_kelas=izin_kelas')
		->join('kamar', 'id_kamar=izin_kamar')
		->join('priode', 'priode_id=izin_priode')
		->where('izin_type', 'Pulang')
		->where('id_kelas', $kelas)
		->where('id_kamar', $kamar)
		->where('priode_id', $priode)
		->groupBy('nis')
		// ->orderBy('detail_id', 'asc')
		->get();
	}

	public function tampilRekapKeluar($kelas, $kamar, $priode)
	{
		return $this->table('izin')
		->select('*')
		->select('COUNT(IF(MONTH(izin_tgl)=7,izin_nis,null)) AS Juli')
		->select('COUNT(IF(MONTH(izin_tgl)=8,izin_nis,null)) AS Agustus')
		->select('COUNT(IF(MONTH(izin_tgl)=9,izin_nis,null)) AS September')
		->select('COUNT(IF(MONTH(izin_tgl)=10,izin_nis,null)) AS Oktober')
		->select('COUNT(IF(MONTH(izin_tgl)=11,izin_nis,null)) AS November')
		->select('COUNT(IF(MONTH(izin_tgl)=12,izin_nis,null)) AS Desember')
		->select('COUNT(IF(MONTH(izin_tgl)=1,izin_nis,null)) AS Januari')
		->select('COUNT(IF(MONTH(izin_tgl)=2,izin_nis,null)) AS Februari')
		->select('COUNT(IF(MONTH(izin_tgl)=3,izin_nis,null)) AS Maret')
		->select('COUNT(IF(MONTH(izin_tgl)=4,izin_nis,null)) AS April')
		->select('COUNT(IF(MONTH(izin_tgl)=5,izin_nis,null)) AS Mei')
		->select('COUNT(IF(MONTH(izin_tgl)=6,izin_nis,null)) AS Juni')
		->select('COUNT(izin_nis) AS Total')
		->join('santri', 'nis=izin_nis')
		->join('kelas', 'id_kelas=izin_kelas')
		->join('kamar', 'id_kamar=izin_kamar')
		->join('priode', 'priode_id=izin_priode')
		->where('izin_type', 'Keluar')
		->where('id_kelas', $kelas)
		->where('id_kamar', $kamar)
		->where('priode_id', $priode)
		->groupBy('nis')
		// ->orderBy('detail_id', 'asc')
		->get();
	}

	
	
}