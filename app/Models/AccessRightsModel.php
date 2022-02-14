<?php namespace App\Models;

use CodeIgniter\Model;

class AccessRightsModel extends Model
{
	protected $table = 'access_level';
	protected $primaryKey = 'id';
	protected $allowedFields = ['access_rights_id','access_name','updated_at'];
	
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

	//--------------------------------------------------------------------

}
?>
