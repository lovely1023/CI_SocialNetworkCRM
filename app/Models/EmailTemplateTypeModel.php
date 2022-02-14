<?php namespace App\Models;

use CodeIgniter\Model;

class EmailTemplateTypeModel extends Model
{
	protected $table = 'email_template_type';
	protected $primaryKey = 'id';
	protected $allowedFields = ['template_type','status','updated_at'];
	
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	
	//--------------------------------------------------------------------

}
?>
