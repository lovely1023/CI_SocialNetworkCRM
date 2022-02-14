<?php namespace App\Models;

use CodeIgniter\Model;

class LandingPageModel extends Model
{
	protected $table = 'landing_page';
	protected $primaryKey = 'id';
	protected $allowedFields = ['client_id','landing_page_link','tour_page','msg_campaign','custom_direct_page','status','paid','updated_at'];
	
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

	//--------------------------------------------------------------------

}
?>
