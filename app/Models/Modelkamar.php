<?php 
namespace App\Models;

use CodeIgniter\Model;

class Modelkamar extends Model
{
	protected $table      = 'kamar';
	protected $primaryKey = 'id_kamar';

	protected $allowedFields = ['id_kamar','nama_kamar'];



	public function tampildata($id_kamar)
	{
		return $this->table('kamar')
		->join('musrif', 'id_kamar=kamar_musrif')
		->where('id_kamar', $id_kamar)
		->get()->getRowArray();
	}
	
}