<?php namespace App\Models;

use CodeIgniter\Model;

class ClientVideoLinkModel extends Model
{
	protected $table = 'client_video_link';
	protected $primaryKey = 'id';
	protected $allowedFields = ['client_id','video_name','youtube_link','auto_play','landing_page_link','updated_at'];
	
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

	//--------------------------------------------------------------------

}
?>
