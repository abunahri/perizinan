<?php

namespace App\Models;

use CodeIgniter\Model;

class Modellogin extends Model
{
	protected $table                = 'users';
	protected $primaryKey           = 'userid';
	protected $allowedFields        = [
		'userid','nama_user','userpassword','userlevelid','useraktif','foto'
	];

	
	
}
