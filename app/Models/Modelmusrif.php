<?php 
namespace App\Models;

use CodeIgniter\Model;

class Modelmusrif extends Model
{
	protected $table      = 'musrif';
	protected $primaryKey = 'kode_musrif';

	protected $allowedFields = ['kode_musrif','nama_musrif','jenkel','tlp_musrif','kamar_musrif','foto','pass_musrif','musrif_levelid'];


	public function tampilDataKamar($kamar)
	{
		return $this->table('musrif')
		->join('kamar', 'kamar_musrif=id_kamar')
		
		->where('kamar_musrif', $kamar)
		->get();
	}

	public function tampilKamar($kode_musrif)
	{
		return $this->table('musrif')
		->join('kamar', 'id_kamar=kamar_musrif')
		->join('santri', 'musrif_kamar=kode_musrif')
		->where('kode_musrif', $kode_musrif)
		->get();
	}


}