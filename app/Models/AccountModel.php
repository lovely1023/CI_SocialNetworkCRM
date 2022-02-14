<?php namespace App\Models;

use CodeIgniter\Model;

class AccountModel extends Model
{
	protected $table = 'account';
	protected $primaryKey = 'id';
	protected $allowedFields = ['firstname','lastname','id_number','email','password','role','status','updated_at'];
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
			return $data;
		}
	}

	
	//--------------------------------------------------------------------

}
?>
