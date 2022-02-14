<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
date_default_timezone_set('Asia/Riyadh');

class CustomModel{
	
	protected $db;
	
	public function __construct(ConnectionInterface &$db){
		$this->db =& $db;	
	}
	
	function getAllUsers(){
		$builder = $this->db->table('account');
		$builder->select('*,account.id as id,account_details.id as adid,account.id_number as id_number');
		$builder->join('account_details','account.id_number = account_details.id_number');
		$accounts = $builder->get()->getResult();
		return $accounts;
	}

	function getManagerAllUsers(){
		$builder = $this->db->table('account');
		$builder->select('*,account.id as id,account_details.id as adid,account.id_number as id_number');
		$builder->join('account_details','account.id_number = account_details.id_number');
		$builder->where('account.role !=', 'admin');
		$builder->where('account.role !=', 'manager');
		$accounts = $builder->get()->getResult();
		return $accounts;
	}
	
	function getAllClients(){
		$builder = $this->db->table('account_clients');
		$builder->select('account_clients.*,account_details.*,account_clients.id as id,account_details.id as adid,account_clients.id_number as id_number');
		$builder->join('account_details','account_clients.id_number = account_details.id_number');
		$accounts = $builder->get()->getResult();
		return $accounts;
	}

	function getSalesAllClients($useremail){
		$builder = $this->db->table('account_clients');
		$builder->select('*,account_clients.id as id,account_details.id as adid,account_clients.id_number as id_number');
		$builder->join('account_details','account_clients.sale_email_personnel ='.$useremail);
		$accounts = $builder->get()->getResult();
		return $accounts;
	}

	function getAllWarranties(){
		$builder = $this->db->table('account_summary');
		$builder->select('id');
		$builder->where('status',1);
		$accounts = $builder->get()->getResult();
		return $accounts;
	}
	
	function getAllPendingWarranties(){
		$builder = $this->db->table('account_summary');
		$builder->select('id');
		$builder->where('approved',0);
		$builder->where('status',1);
		$accounts = $builder->get()->getResult();
		return $accounts;
	}
	
	function getAllActiveWarranties(){
		$builder = $this->db->table('account_summary');
		$builder->select('id');
		$builder->where('approved',1);
		$builder->where('status',1);
		$accounts = $builder->get()->getResult();
		return $accounts;
	}
	
	function getWarranties($email){
		$builder = $this->db->table('account_summary');
		$builder->select('*');
		$builder->where('sale_email_personnel',$email);
		$builder->where('status',1);
		$accounts = $builder->get()->getResult();
		return $accounts;
	}
	
	function getWarrantyType(){
		$builder = $this->db->table('account_summary');
		$builder->select('warranty_type');
		$builder->orderBy('warranty_type', 'DESC');
		$builder->limit(0, 20);
		$warranty = $builder->get()->getResult();
		return $warranty;
	}
	
	function getCarType(){
		$builder = $this->db->table('account_summary');
		$builder->select('car_type');
		$builder->orderBy('car_type', 'DESC');
		$builder->limit(0, 20);
		$warranty = $builder->get()->getResult();
		return $warranty;
	}
	
	function getCarModel(){
		$builder = $this->db->table('account_summary');
		$builder->select('car_model');
		$builder->orderBy('car_model', 'DESC');
		$builder->limit(0, 20);
		$warranty = $builder->get()->getResult();
		return $warranty;
	}
	
	function getShowroom(){
		$builder = $this->db->table('account_summary');
		$builder->select('showroom');
		$builder->orderBy('showroom', 'DESC');
		$builder->limit(0, 20);
		$warranty = $builder->get()->getResult();
		return $warranty;
	}
	
	function getCrmUser($id){
		$builder = $this->db->table('account_details');
		$builder->select('*,account.id as aid,account_details.id as adid');
		$builder->join('account','account.email = account_details.email');
		$builder->where('account.id',$id);
		$user = $builder->get()->getResult();
		return $user;
	}
	
	function getClientUser($id){
		$builder = $this->db->table('account_clients');
		$builder->select('*,account_clients.id as id,account_details.id as adid, account_clients.id_number as id_number','account_clients.email as email');
		$builder->join('account_details','account_clients.email = account_details.email');
		$builder->where('account_clients.id',$id);
		$user = $builder->get()->getResult();
		return $user;
	}
	
	function getAccountDetails($email){
		$builder = $this->db->table('account');
		$builder->select('*,account.id as id');
		$builder->join('account_details','account.email = account_details.email');
		$builder->where('account.email',$email);
		$account = $builder->get()->getResult();
		return $account;
	}
	
	function getAllSummary(){
		$builder = $this->db->table('account_summary');
		$accounts = $builder->get()->getResult();
		return $accounts;
	}
	
	function getClientSummary($idn){
		$builder = $this->db->table('account_summary');
		$builder->where('id_number',$idn);
		$accounts = $builder->get()->getResult();
		return $accounts;
	}
	
	function getSummary($id_number){
		$builder = $this->db->table('account_summary');
		$builder->select('*');
		$builder->where('id_number',$id_number);
		$summary = $builder->get()->getResult();
		return $summary;
	}
	
	function getSummaryApproved($id_number){
		$builder = $this->db->table('account_summary');
		$builder->select('approved');
		$builder->where('id_number',$id_number);
		$builder->orderBy('approved','DESC');
		$summary = $builder->get()->getResult();
		return $summary;
	}
	
	function getClientsWarranty($id){
		$builder = $this->db->table('account_summary');
		$builder->select('*');
		$builder->where('id',$id);
		$warranty = $builder->get()->getResult();
		return $warranty;
	}

	function getCrmIdNumber($idn){
		$builder = $this->db->table('account');
		$builder->select('id_number');
		$builder->where('id_number',$idn);
		$result = $builder->get()->getResult();
		return $result;
	}
	
	function getClientIdNumber($idn){
		$builder = $this->db->table('account_clients');
		$builder->select('id_number');
		$builder->where('id_number',$idn);
		$result = $builder->get()->getResult();
		return $result;
	}

	function getClientPhoneNumber($pn){
		$builder = $this->db->table('account_clients');
		$builder->select('id_number');
		$builder->where('phone_number',$pn);
		$result = $builder->get()->getResult();
		return $result;
	}

	function getPrintSummary($approved, $date1, $date2){

		$builder = $this->db->table('account_summary');
		$builder->select('*');
		if($approved != 'x'){
			$builder->where('approved',$approved);
		}
		if($date1 != null){
			$builder->where('warranty_start >=',$date1);
			$builder->where('warranty_start <=',$date2);
		}
		$result = $builder->get()->getResult();
		return $result;
	}
	

	//--------------------------------------------------------------------

}
?>
