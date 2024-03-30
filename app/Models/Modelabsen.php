<?php 
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;
use App\Libraries\enums\Kehadiran;

class Modelabsen extends Model
{
	protected $table      = 'absen';
	protected $primaryKey = 'id_absen';

	protected $allowedFields = ['id_absen','absen_nis','absen_kamar','absen_musrif','tanggal','keterangan','absen_priode','bulan'];



	public function tampilAbsensi($priode, $musrif, $bulan)
	{
		return $this->table('absen')
		->select('*')
		->select('COUNT(IF(keterangan="1",keterangan,null)) AS hadir')
		->select('COUNT(IF(keterangan="2",keterangan,null)) AS pulang')
		->join('santri', 'nis=absen_nis', 'left')
		->join('kamar', 'id_kamar=absen_kamar', 'left')
		->join('priode', 'priode_id=absen_priode', 'left')
		->join('musrif', 'kode_musrif=absen_musrif', 'left')
		->where('absen_musrif', $musrif)
		->where('absen_priode', $priode)
		->where('bulan', $bulan)
		->groupBy('nama')
		->orderBy('nama', 'asc')
		->get();
		// ->findAll();
	}

	public function getPresensi($priode, $kode_musrif, $tanggal)
	{
		return $this->setTable('santri')
		->select('*')

		->join("(SELECT id_absen, absen_nis AS nis_absen, tanggal, absen_priode, keterangan FROM absen)absen","{$this->table}.nis = absen.nis_absen AND absen.tanggal = '$tanggal'",'left')
		->join('kehadiran', 'id_kehadiran = keterangan')
		->join('priode', 'priode_id = absen_priode')
		->where("{$this->table}.musrif_kamar = $kode_musrif")
		->where('absen.absen_priode', $priode)
		->orderBy('nama', 'asc')
		->get();
	}

	public function getPresensiByKehadiran(string $idKehadiran, $tanggal)
	{
		$this->join('santri',"absen.absen_nis = santri.nis AND absen.tanggal = '$tanggal'");

		if ($idKehadiran == '4') {
			$result = $this->findAll();

			$filteredResult = [];

			foreach ($result as $value) {
				if ($value['id_kehadiran'] != ('1' || '2' || '3')) {
					array_push($filteredResult, $value);
				}
			}

			return $filteredResult;
		} else {
			$this->where(['keterangan' => $idKehadiran]);
			return $this->findAll();
		}
	}

	public function tampilTotal($keterangan, $tanggal)
	{
		return $this->table('absen')
		->join('santri', 'nis=absen_nis', 'left')
		->join('kamar', 'id_kamar=absen_kamar', 'left')
		->join('priode', 'priode_id=absen_priode', 'left')
		->join('musrif', 'kode_musrif=absen_musrif', 'left')
		->get()->getResultArray();
		
	}

}