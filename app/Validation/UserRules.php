<?php namespace App\Validation;
use App\Models\UserDtlModel;

class UserRules{
	
	public function validateUser(string $str, string $fields, array $data){
		$model = new UserDtlModel();
		$user = $model->where('user_name',$data['user_name'])->where('status',1)->first();
		if(!$user)
			return false;
		
		return password_verify($data['password'],$user['password']);
	}	
	
}