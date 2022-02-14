<?php namespace App\Models;

use CodeIgniter\Model;

class MobileCarrierModel extends Model
{
	protected $table = 'mobile_carrier';
	protected $primaryKey = 'id';
	protected $allowedFields = ['mobile_carrier_name','country','status','updated_at'];
	
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
   protected $updatedField  = 'updated_at';

	//--------------------------------------------------------------------

}
?>
