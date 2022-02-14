<?php namespace App\Models;

use CodeIgniter\Model;

class EmailCampaignTypeModel extends Model
{
	protected $table = 'email_campaign_type';
	protected $primaryKey = 'id';
	protected $allowedFields = ['client_id','org_id','campaign_type','status','added_by','updated_at'];
	
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	
	public function getCampaignTypeList($orgId)
	{
		if ($orgId == '') {
			$sql = "SELECT email_campaign_type.*, organization.org_name FROM `email_campaign_type` LEFT JOIN organization ON organization.org_id = email_campaign_type.org_id WHERE email_campaign_type.status = 1";
			$list = $this->db->query($sql);
		} else {
			$sql = "SELECT email_campaign_type.*, organization.org_name FROM `email_campaign_type` LEFT JOIN organization ON organization.org_id = email_campaign_type.org_id WHERE email_campaign_type.status = 1 AND email_campaign_type.org_id = ?";
			$list = $this->db->query($sql, $orgId);
		}
		
		return $list->getResultArray();
	}

	//--------------------------------------------------------------------

}
?>
