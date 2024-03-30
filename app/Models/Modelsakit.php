<?php 
namespace App\Models;

use CodeIgniter\Model;

class Modelsakit extends Model
{
	protected $table      = 'sakit';
	protected $primaryKey = 'id_sakit';

	protected $allowedFields = ['id_sakit','tanggal','priode_id','nis','kode_musrif','id_kamar','id_kelas','sakit','penanganan'];
	
}