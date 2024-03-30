<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelusers extends Model
{
	protected $table                = 'users';
	protected $primaryKey           = 'userid';
	protected $allowedFields        = [
		'userid','nama_user','userpassword','userlevelid','useraktif','foto','jenkel'
	];

	
	
}
