<?php namespace App\Models;

use CodeIgniter\Model;

class CityModel extends Model
{
	protected $table = 'city';
	protected $primaryKey = 'id';
	protected $allowedFields = ['city_name','country','area_code','status','updated_at'];
	
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
   protected $updatedField  = 'updated_at';

	//--------------------------------------------------------------------

}
?>
