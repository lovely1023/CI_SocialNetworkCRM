<?php namespace App\Models;

use CodeIgniter\Model;

class CountryModel extends Model
{
	protected $table = 'country';
	protected $primaryKey = 'id';
	protected $allowedFields = ['country_name','country_code','status','updated_at'];
	
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
   protected $updatedField  = 'updated_at';

	//--------------------------------------------------------------------

}
?>
