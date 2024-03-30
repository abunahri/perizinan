<?php namespace App\Models;

use CodeIgniter\Model;

class Modelpriode extends Model
{
	protected $table      = 'priode';
	protected $primaryKey = 'priode_id';

	protected $allowedFields = ['priode_id', 'tahun','priode','status'];


	public function tampildata()
	{
		return $this->table('priode')
		->orderBy('tahun', 'asc')
		->get();
	}

	public function tampildataAktif()
	{
		return $this->table('priode')
		->where('status', '1')
		->orderBy('tahun', 'asc')
		->get();
	}
}