<?php namespace App\Models;

use CodeIgniter\Model;

class LogsModel extends Model
{
	protected $table = 'logs';
	protected $primaryKey = 'id';
	protected $allowedFields = ['client_id','org_id','action_taken','action_taken_by','query_string','table_name','updated_at'];
	
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

	//--------------------------------------------------------------------

}
?>
