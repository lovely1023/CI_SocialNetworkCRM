<?php namespace App\Models;

use CodeIgniter\Model;

class OrganizationModel extends Model
{
	protected $table = 'organization';
	protected $primaryKey = 'id';
	protected $allowedFields = ['org_id','org_name','status','updated_at'];
	
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

	//--------------------------------------------------------------------

}
?>
