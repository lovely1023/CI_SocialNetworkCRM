<?php namespace App\Models;

use CodeIgniter\Model;

class EmailModel extends Model
{
	protected $table = 'email';
	protected $primaryKey = 'id';
	protected $allowedFields = ['client_id','fullname','email_address','contact_number','main_link','campaign_type','subject','msg_content','send_sms','send_voice_msg','updated_at'];
	
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

	//--------------------------------------------------------------------

}
?>
