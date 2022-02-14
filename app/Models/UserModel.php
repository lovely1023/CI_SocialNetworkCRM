<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $table = 'account';
	protected $primaryKey = 'id';
	protected $allowedFields = ['firstname','lastname','email','id_number','password','role','status','updated_at'];
	
	protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

	
	//--------------------------------------------------------------------

}
?>
