<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ClientDtlModel extends Model
{
	protected $table = 'client_dtl';
	protected $primaryKey = 'id';
	protected $allowedFields = ['client_id','first_name','mid_name','last_name','birth_date','gender','phone_number','mobile_number','email_address','home_address','city','state','country','zip_code','alert','photo_path','is_deleted','updated_at'];
	
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
   protected $updatedField  = 'updated_at';

   protected $db;
	
	// function insert($data)
	// {
	// 	$this->db->insert($data);
	// }

	//--------------------------------------------------------------------

}
?>
