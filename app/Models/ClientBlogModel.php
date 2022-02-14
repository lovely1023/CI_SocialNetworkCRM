<?php namespace App\Models;

use CodeIgniter\Model;

class ClientBlogModel extends Model
{
	protected $table = 'client_blog';
	protected $primaryKey = 'id';
	protected $allowedFields = ['client_id','blog_link','category','title','summary','content','photo_path','published','updated_at'];
	
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

	//--------------------------------------------------------------------

}
?>
