<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ClientLeadMineModel extends Model
{
	protected $table = 'client_lead_mine';
	protected $primaryKey = 'id';
	protected $allowedFields = ['client_id', 'customer_type', 'source', 'full_name', 'email_address', 'company', 'home_address', 'city', 'state', 'country', 'zip_code', 'phone_number', 'mobile_number', 'birth_date', 'occupation', 'benefits_looking_for', 'first_question', 'first_question_answer', 'second_question', 'second_question_answer', 'third_question', 'third_question_answer', 'fourth_question', 'fourth_question_answer', 'fifth_question', 'fifth_question_answer', 'updated_at'];
	
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $db;

	//--------------------------------------------------------------------

}
?>
