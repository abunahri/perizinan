<?php 
namespace App\Models;

use CodeIgniter\Model;

class Modelkelas extends Model
{
	protected $table      = 'kelas';
	protected $primaryKey = 'id_kelas';

	protected $allowedFields = ['id_kelas','nama_kelas'];
	
}