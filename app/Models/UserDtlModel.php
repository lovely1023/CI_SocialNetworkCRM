<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class UserDtlModel extends Model
{
	protected $table = 'user_dtl';
	protected $primaryKey = 'id';
	protected $allowedFields = ['user_id','client_id','user_name','password','access_rights_id','status','updated_at'];
	protected $beforeInsert = ['beforeInsert'];
	protected $beforeUpdate = ['beforeUpdate'];
	
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

	protected function beforeInsert(array $data)
	{
		$data =  $this->passwordHash($data);
		
		return $data;
	}
	
	protected function beforeUpdate(array $data)
	{
		$data =  $this->passwordHash($data);
		
		return $data;
	}
	
	protected function passwordHash(array $data)
	{
		if(isset($data['data']['password'])){
			$data['data']['password'] = password_hash($data['data']['password'],PASSWORD_DEFAULT);
			
		} 
		return $data;
	}

	public function getAllUsers($accessRights) 
	{
		if ($accessRights == 1) {
			$sql = "SELECT user_dtl.id as user_id, client_dtl.id as client_id, user_dtl.user_name, client_dtl.*, access_level.access_name, user_dtl.status FROM `user_dtl` LEFT JOIN client_dtl ON client_dtl.id = user_dtl.client_id LEFT JOIN access_level ON access_level.access_rights_id = user_dtl.access_rights_id WHERE user_dtl.status = 1";
		} else if($accessRights == 2) {
			$sql = "SELECT user_dtl.id as user_id, client_dtl.id as client_id, user_dtl.user_name, client_dtl.*, access_level.access_name, user_dtl.status FROM `user_dtl` LEFT JOIN client_dtl ON client_dtl.id = user_dtl.client_id LEFT JOIN access_level ON access_level.access_rights_id = user_dtl.access_rights_id WHERE user_dtl.access_rights_id != 3 and user_dtl.status = 1";
		}
		
		$users = $this->db->query($sql);
		return $users->getResultArray();

	}

	public function getUserDetails($userId)
	{
		$sql = "SELECT user_dtl.id as user_id, client_dtl.id as client_id, user_dtl.*, client_dtl.*, user_dtl.access_rights_id as access_rights FROM `user_dtl` LEFT JOIN client_dtl ON client_dtl.id = user_dtl.client_id WHERE user_dtl.id = ? LIMIT 1";

		$users = $this->db->query($sql, $userId);
		return $users->getResultArray();
	}

	//--------------------------------------------------------------------

}
?>
