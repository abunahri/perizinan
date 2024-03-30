<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelsetting extends Model
{
	protected $table                = 'setting';
	protected $primaryKey           = 'setting_id';
	protected $allowedFields        = [
		'setting_id','nama_sekolah','app_nama','alamat','kec','kab','telp','logo','kepsek','nip','cap'
	];
	
}