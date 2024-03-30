<?php 
namespace App\Models;

use CodeIgniter\Model;

class Modelsantri extends Model
{
	protected $table      = 'santri';
	protected $primaryKey = 'nis';

	protected $allowedFields = ['nis','nisn','nama','tmp_lahir','tgl_lahir','jenkel','santri_idkelas','santri_idkamar','nama_wali','alamat','telp','musrif_kamar','foto_santri'];


	public function tampildata($nis)
	{
		return $this->table('santri')
		->join('kelas', 'id_kelas=santri_idkelas')
		->join('kamar', 'id_kamar=santri_idkamar')
		->join('musrif', 'musrif_kamar=kode_musrif')
		// ->orderBy('nama', 'asc')
		->where('nis', $nis)
		->get();
	}

	public function tampilAbsen($kode_musrif)
	{
		return $this->table('santri')
		
		->join('kamar', 'id_kamar=santri_idkamar')
		->join('musrif', 'musrif_kamar=kode_musrif')
		// ->join('absen', 'absen_nis=nis')
		// ->where('tanggal', $tanggal)
		->orderBy('nama', 'asc')
		// ->groupBy('nama')
		->where('musrif_kamar', $kode_musrif)
		->get();
	}

	public function tampirekaplAbsen($priode, $kode_musrif, $tanggal)
	{
		return $this->table('santri')
		->select('*')
		->select('tanggal, COUNT(IF(keterangan=1,keterangan,null)) AS hadir')
		->select('tanggal, COUNT(IF(keterangan=2,keterangan,null)) AS pulang')

		->join('kamar', 'id_kamar=santri_idkamar')
		->join('musrif', 'musrif_kamar=kode_musrif')
		->join('absen', 'absen_nis=nis')
		->where('absen_priode', $priode)
		// ->where('MONTH(tanggal)', $tanggal)
		->orderBy('nama', 'asc')
		->groupBy('nama')
		->where('musrif_kamar', $kode_musrif)
		->get();
	}
}