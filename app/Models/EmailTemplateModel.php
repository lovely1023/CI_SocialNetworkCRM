<?php namespace App\Models;

use CodeIgniter\Model;

class EmailTemplateModel extends Model
{
	protected $table = 'email_template';
	protected $primaryKey = 'id';
	protected $allowedFields = ['org_id','email_template_type','subject','image','content','status','updated_at'];
	
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	
	//--------------------------------------------------------------------

}
?>
