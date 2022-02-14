<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CustomModel;
use App\Models\UserDtlModel;
use App\Models\AccountModel;
use App\Models\AccountClientsModel;
use App\Models\AccountDetailsModel;
use App\Models\AccountSummaryModel;
helper('date');
date_default_timezone_set('Asia/Riyadh');

class Dashboard extends BaseController
{
	public function index()
	{
		$data=[];
		$db = db_connect();
		$cmodel = new CustomModel($db);
		$userModel = new UserDtlModel($db);
		
		if(session()->get('isLoggedIn')){
			//temporary start
			$username = session()->get('user_name');

			$user = $userModel->where('user_name',$username)->where('status',1)->first();
			if($user['access_rights_id'] === '1') {
				return redirect()->to(base_url().'/superadmin_dashboard');
			} else if($user['access_rights_id'] === '2') {
				return redirect()->to(base_url().'/admin_dashboard');
			} else if($user['access_rights_id'] === '3') {
				return redirect()->to(base_url().'/coordinator_dashboard');
			} else if($user['access_rights_id'] === '4') {
				return redirect()->to(base_url().'/user_dashboard');
			}
			
			// temporary end
			$username = session()->get('user_name');
			$data['user'] = $cmodel->getAccountDetails($username);
			
			if('admin' == session()->get('role')){
				$data['allusers'] = $cmodel->getAllUsers();
				$data['allclients'] = $cmodel->getAllClients();
				$data['allwarranties'] = $cmodel->getAllWarranties();
				$data['allpendingwarranties'] = $cmodel->getAllPendingWarranties();
				$data['allactivewarranties'] = $cmodel->getAllActiveWarranties();
				
				echo view('templates/header2', $data);
				echo view('dashboard_general');
				echo view('templates/footer2');
			}
			if('manager' == session()->get('role')){
				$data['allusers'] = $cmodel->getManagerAllUsers();
				$data['allclients'] = $cmodel->getAllClients();
				$data['allwarranties'] = $cmodel->getAllWarranties();
				$data['allpendingwarranties'] = $cmodel->getAllPendingWarranties();
				$data['allactivewarranties'] = $cmodel->getAllActiveWarranties();

				echo view('templates/header2', $data);
				echo view('dashboard_manager');
				echo view('templates/footer2');
			}
			if('sales' == session()->get('role')){
				$data['allusers'] = $cmodel->getManagerAllUsers();
				$data['allclients'] = $cmodel->getAllClients();
				$data['allwarranties'] = $cmodel->getWarranties(session()->get('email'));

				echo view('templates/header2', $data);
				echo view('dashboard_sales');
				echo view('templates/footer2');
			}
			if('client' == session()->get('role')){
				$data['user'] = $cmodel->getClientUser(session()->get('id'));
				$data['summary'] = $cmodel->getClientSummary(session()->get('id_number'));
				echo view('templates/header2', $data);
				echo view('dashboard_client');
				echo view('templates/footer2');
			}
		}else{
			return redirect()->to(base_url());
		}
	}
	
	public function get_info_account($id){
		$db = db_connect();
		$cmodel = new CustomModel($db);
		
		if($id == Null || $id == 0){
			return false;
		}
		
		if('admin' == session()->get('role')){
			$data['user'] = $cmodel->getCrmUser($id);
			return $this->response->setJSON($data);
		}
		
		if('manager' == session()->get('role')){
			$data['user'] = $cmodel->getCrmUser($id);
			return $this->response->setJSON($data);
		}
		
		if('sales' == session()->get('role')){
			$data['user'] = $cmodel->getClientUser($id);
			return $this->response->setJSON($data);
		}
		
		return redirect()->to('/CRMplatform/public/');
	}
	
	public function get_client_info_account($id){
		$db = db_connect();
		$cmodel = new CustomModel($db);
		
		if($id == Null || $id == 0){
			return false;
		}
		if(session()->get('isLoggedIn')){
			if('admin' == session()->get('role')){
				$data['user'] = $cmodel->getClientUser($id);
				return $this->response->setJSON($data);
			}elseif('manager' == session()->get('role')){
				$data['user'] = $cmodel->getClientUser($id);
				return $this->response->setJSON($data);
			}elseif('sales' == session()->get('role')){
				$data['user'] = $cmodel->getClientUser($id);
				return $this->response->setJSON($data);
			}else{
				return redirect()->to('/CRMplatform/public/account/logout');
			}	
		}
		
		return false;
	}
	
	public function get_crm_account($id){
		$data = [];
		helper(['form']);
		
		if(session()->get('isLoggedIn')){
		if($this->request->getmethod() == 'post'){
			
			//store the account to our database
			$model = new AccountModel();
			$admodel = new AccountDetailsModel();
			
			$aData = [
				'firstname' => $this->request->getVar('firstname'),
				'lastname' => $this->request->getVar('lastname'),
				'id_number' => $this->request->getVar('id_number'),
				'email' => $this->request->getVar('email'),
				'password' => $this->request->getVar('password'),
				'role' => $this->request->getVar('role'),
				'status' => 0,
				
			];
			
			$adData = [
				'firstname' => $this->request->getVar('firstname'),
				'middlename' => $this->request->getVar('middlename'),
				'lastname' => $this->request->getVar('lastname'),
				'id_number' => $this->request->getVar('id_number'),
				'email' => $this->request->getVar('email')
			];
			
			$model->save($aData);
			$admodel->save($adData);
			$datareponse = [
			'success' => true,
			'data' => $model,
			'msg' => "Thanks for contact us. We get back to you"
		   ];
	 
		   return $this->response->setJSON($datareponse);
		}
		}else{
			return redirect()->to('/CRMplatform/public/');
		}
	}
	
	public function create_crm_account(){
		$data = [];
		helper(['form']);
		
		if(session()->get('isLoggedIn')){
			if($this->request->getmethod() == 'post'){
				
				//store the account to our database
				$model = new AccountModel();
				$admodel = new AccountDetailsModel();
				
				$aData = [
					'firstname' => $this->request->getVar('firstname'),
					'lastname' => $this->request->getVar('lastname'),
					'id_number' => $this->request->getVar('id_number'),
					'email' => $this->request->getVar('email'),
					'password' => $this->request->getVar('password'),
					'role' => $this->request->getVar('role'),
					'status' => 1,
					
				];
				
				$adData = [
					'firstname' => $this->request->getVar('firstname'),
					'lastname' => $this->request->getVar('lastname'),
					'id_number' => $this->request->getVar('id_number'),
					'email' => $this->request->getVar('email'),
					'phone_number' => $this->request->getVar('phone_number')
				];
				
				$model->save($aData);
				$admodel->save($adData);
				$datareponse = [
				'success' => true,
				'data' => $model,
				'msg' => "Thanks for contact us. We get back to you"
			   ];
		 
			   return $this->response->setJSON($datareponse);
			}
		}else{
			return redirect()->to(base_url());
		}
	}
	
	public function update_crm_details_account($id){
		$db = db_connect();
		$cmodel = new CustomModel($db);
		
		if(session()->get('isLoggedIn')){
			if($this->request->getmethod() == 'post'){
				
				//store the account to our database
				$model = new UserModel();
				$admodel = new AccountDetailsModel();
				
				$aData = [
					'id' => $id,
					'firstname' => $this->request->getVar('firstname'),
					'lastname' => $this->request->getVar('lastname'),
					'id_number' => $this->request->getVar('id_number'),
					'email' => $this->request->getVar('email'),
					'role' => $this->request->getVar('role'),
				];
				
				$adData = [
					'id' => $this->request->getVar('id_account_details'),
					'firstname' => $this->request->getVar('firstname'),
					'middlename' => $this->request->getVar('middlename'),
					'lastname' => $this->request->getVar('lastname'),
					'id_number' => $this->request->getVar('id_number'),
					'phone_number' => $this->request->getVar('phone_number'),
					'email' => $this->request->getVar('email'),
					'address' => $this->request->getVar('address'),
					'city' => $this->request->getVar('city'),
					'country' => $this->request->getVar('country'),
					'postal_code' => $this->request->getVar('postal_code')
				];
				
				$model->save($aData);
				$admodel->update($this->request->getVar('id_account_details'), $adData);
				$datareponse = [
				'success' => true,
				'data' => $model,
				'msg' => "CRM user accunt update is now complete."
			   ];
		 
			   return $this->response->setJSON($datareponse);
			}
		}else{
			return redirect()->to('/CRMplatform/public/');
		}
		
	}
	
	public function create_clients_account(){
		$data = [];
		helper(['form']);
		
		if(session()->get('isLoggedIn')){
			if($this->request->getmethod() == 'post'){
				
				//store the account to our database
				$acmodel = new AccountClientsModel();
				$admodel = new AccountDetailsModel();
				
				$acData = [
					'id_number' => $this->request->getVar('id_number'),
					'email' => $this->request->getVar('email'),
					'phone_number' => $this->request->getVar('phone_number'),
					'otp' => '0000',
					'sale_personnel' => $this->request->getVar('sale_personnel'),
					'sale_email_personnel' => $this->request->getVar('sale_email_personnel'),
					'status' => 1
					
				];
				
				$adData = [
					'firstname' => $this->request->getVar('firstname'),
					'middlename' => $this->request->getVar('middlename'),
					'lastname' => $this->request->getVar('lastname'),
					'id_number' => $this->request->getVar('id_number'),
					'email' => $this->request->getVar('email'),
					'phone_number' => $this->request->getVar('phone_number'),
					'address' => $this->request->getVar('address'),
					'city' => $this->request->getVar('city'),
					'country' => $this->request->getVar('country'),
					'postal_code' => $this->request->getVar('postal_code')
				];
				
				$acmodel->save($acData);
				$admodel->save($adData);
				$datareponse = [
				'success' => true,
				'data' => $acmodel,
				'msg' => "Thanks for contact us. We get back to you"
			   ];
		 
			   return $this->response->setJSON($datareponse);
			}
		}else{
			return redirect()->to('/CRMplatform/public/');
		}	
	}
	
	public function update_client_account($id){
		$db = db_connect();
		$cmodel = new CustomModel($db);
		
		if(session()->get('isLoggedIn')){
			if($this->request->getmethod() == 'post'){
				//$db = db_connect();
				//store the account to our database
				$acmodel = new AccountClientsModel();
				$admodel = new AccountDetailsModel();
				$asmodel = new AccountSummaryModel();
				
				$acData = [
					'id' => $this->request->getVar('id_account_clients'),
					'id_number' => $this->request->getVar('id_number'),
					'phone_number' => $this->request->getVar('phone_number'),
					'email' => $this->request->getVar('email'),
					'sale_personnel' => $this->request->getVar('sale_personnel'),
					'sale_email_personnel' => $this->request->getVar('sale_email_personnel'),
					'update_at' => date("Y-m-d H:i:s"),
				];
				
				$adData = [
					'id' => $this->request->getVar('id_account_details'),
					'firstname' => $this->request->getVar('firstname'),
					'middlename' => $this->request->getVar('middlename'),
					'lastname' => $this->request->getVar('lastname'),
					'id_number' => $this->request->getVar('id_number'),
					'phone_number' => $this->request->getVar('phone_number'),
					'email' => $this->request->getVar('email'),
					'address' => $this->request->getVar('address'),
					'city' => $this->request->getVar('city'),
					'country' => $this->request->getVar('country'),
					'postal_code' => $this->request->getVar('postal_code'),
					'update_at' => date("Y-m-d H:i:s"),
				];

				$asData = [
					'client_name' => $this->request->getVar('firstname').' '.$this->request->getVar('lastname'),
					'phone_number' => $this->request->getVar('phone_number'),
					'email' => $this->request->getVar('email'),
					'update_at' => date("Y-m-d H:i:s"),
				];
				
				
				$acmodel->update($this->request->getVar('id_account_clients'), $acData);
				$admodel->update($this->request->getVar('id_account_details'), $adData);
				$asmodel->where('id_number',$this->request->getVar('id_number'))
						->set($asData)
						->update();
				$datareponse = [
				'success' => true,
				'data' => $acmodel,
				'msg' => "CRM user accunt update is now complete."
			   ];
		 
			   return $this->response->setJSON($datareponse);
			}
		}else{
			return redirect()->to('/CRMplatform/public/');
		}
		
	}
	
	public function update_details($id){
		$db = db_connect();
		$cmodel = new CustomModel($db);

		if(session()->get('isLoggedIn')){
			$userModel->update($id, $data);
		}else{
			return redirect()->to('/CRMplatform/public/');
		}
	}
	
	public function update_warranty_file_account(){
		$data = [];
		helper(['form','url']);
		
		if(session()->get('isLoggedIn')){
			if($this->request->getmethod() == 'post'){
				
				$file = $this->request->getFile('the_file');
				$id = $this->request->getVar('id_fu');
				$idn = $this->request->getVar('id_number_fu');
				$newfilename = $file->getRandomName();
				//$newfilename = $id.'_'.$idn.'_filewarranty';
				
				//save file documents
				if(!$file->hasMoved()){
					$file->move('./documents',$id.'_'.$idn.'_'.$newfilename);
				}
				$filename = $file->getName();
				echo $filename.' '.$id;
				
				//update warranty database for file documents
				$asmodel = new AccountSummaryModel();
				$asData = [
					'id' => $id,
					'value_1' => $filename
				];
				$asmodel->update($id, $asData);
				
				return redirect()->to('/CRMplatform/public/dashboard');
			}
		}
	}
	
	public function add_new_warranty_account(){
		$data = [];
		helper(['form','url']);
		
		if(session()->get('isLoggedIn')){
			if($this->request->getmethod() == 'post'){
				
				//store the account to our database
				//$acmodel = new AccountClientsModel();
				$asmodel = new AccountSummaryModel();
				
				$date_ws = date("Y-m-d", strtotime($this->request->getVar('warranty_start')) );
				$date_we = date("Y-m-d", strtotime($this->request->getVar('warranty_end')) );
				$asData = [
					'policy_number' => $this->request->getVar('policy_number'),
					'client_name' => $this->request->getVar('client_name'),
					'email' => $this->request->getVar('email'),
					'id_number' => $this->request->getVar('id_number'),
					'phone_number' => $this->request->getVar('phone_number'),
					'warranty_type' => $this->request->getVar('warranty_type'),
					'warranty_period' => $this->request->getVar('warranty_period'),
					'warranty_start' => $date_ws,
					'warranty_end' => $date_we,
					'showroom' => $this->request->getVar('showroom'),
					'car_type' => $this->request->getVar('car_type'),
					'car_model' => $this->request->getVar('car_model'),
					'price' => $this->request->getVar('price'),
					'paid_amount' => $this->request->getVar('paid_amount'),
					'receipt_number' => $this->request->getVar('receipt_number'),
					'payment_method' => $this->request->getVar('payment_method'),
					'sale_personnel' => $this->request->getVar('sale_personnel'),
					'sale_email_personnel' => $this->request->getVar('sale_email_personnel'),
					'remarks' => $this->request->getVar('remarks'),
					'status' => 1,
				];
				
				$asmodel->save($asData);
				
				$datareponse = [
				'success' => true,
				'data' => $asmodel,
				'msg' => "Thanks for contact us. We get back to you"
			   ];
		 
			   return $this->response->setJSON($datareponse);
			}
		}else{
			return redirect()->to('/CRMplatform/public/');
		}
	}
	
	public function get_warranty_summary($idn){
		$data = [];
		
		$db = db_connect();
		$cmodel = new CustomModel($db);
		
		if(session()->get('isLoggedIn')){
			$data['summary'] = $cmodel->getSummary($idn);
	 
			return $this->response->setJSON($data);
		}else{
			return redirect()->to('/CRMplatform/public/');
		}
	}
	
	public function get_warranty_summary_approved($idn){
		$data = [];
		
		$db = db_connect();
		$cmodel = new CustomModel($db);
		
		if(session()->get('isLoggedIn')){
			$data['summary'] = $cmodel->getSummaryApproved($idn);
			return $this->response->setJSON($data);
		}else{
			return redirect()->to('/CRMplatform/public/');
		}
	}
	
	public function get_clients_warranty($id){
		$data = [];
		
		$db = db_connect();
		$cmodel = new CustomModel($db);

		if(session()->get('isLoggedIn')){
			
			$data['warranty'] = $cmodel->getClientsWarranty($id);
			return $this->response->setJSON($data);
			
		}else{
			return redirect()->to('/CRMplatform/public/');
		}
	}

	public function update_clients_warranty($id){
		$data = [];
		helper(['form']);
		
		if(session()->get('isLoggedIn')){
			if($this->request->getmethod() == 'post'){
				
				//store the account to our database
				//$acmodel = new AccountClientsModel();
				$asmodel = new AccountSummaryModel();
				
				// $acData = [
					// 'id_number' => $this->request->getVar('id_number'),
					// 'email' => $this->request->getVar('email'),
					// 'otp' => '0000',
					// 'sale_personnel' => $this->request->getVar('sale_personnel'),
					// 'sale_email_personnel' => $this->request->getVar('sale_email_personnel'),
					// 'status' => 1
					
				// ];
				
				$date_ws = date("Y-m-d", strtotime($this->request->getVar('warranty_start')) );
				$date_we = date("Y-m-d", strtotime($this->request->getVar('warranty_end')) );
				$asData = [
					'id' => $id,
					'policy_number' => $this->request->getVar('policy_number'),
					'client_name' => $this->request->getVar('client_name'),
					'email' => $this->request->getVar('email'),
					'id_number' => $this->request->getVar('id_number'),
					'phone_number' => $this->request->getVar('phone_number'),
					'warranty_type' => $this->request->getVar('warranty_type'),
					'warranty_period' => $this->request->getVar('warranty_period'),
					'warranty_start' => $date_ws,
					'warranty_end' => $date_we,
					'showroom' => $this->request->getVar('showroom'),
					'car_type' => $this->request->getVar('car_type'),
					'car_model' => $this->request->getVar('car_model'),
					'price' => $this->request->getVar('price'),
					'paid_amount' => $this->request->getVar('paid_amount'),
					'receipt_number' => $this->request->getVar('receipt_number'),
					'payment_method' => $this->request->getVar('payment_method'),
					'sale_personnel' => $this->request->getVar('sale_personnel'),
					'sale_email_personnel' => $this->request->getVar('sale_email_personnel'),
					'remarks' => $this->request->getVar('remarks'),
					'status' => 1,
				];
				
				$asmodel->update($id, $asData);
				
				$datareponse = [
				'success' => true,
				'data' => $asmodel,
				'msg' => "Thanks for contact us. We get back to you"
			   ];
		 
			   return $this->response->setJSON($datareponse);
			}
		}else{
			return redirect()->to('/CRMplatform/public/');
		}
	}
	
	public function activate_crm_user($id){
		//$db = db_connect();
		//$cmodel = new AccountModel($db);

		if(session()->get('isLoggedIn')){
			$model = new UserModel();
			$aData = [
				'id' => $id,
				'status' => 1,
			];
			$model->save($aData);
			$datareponse = [
				'success' => true,
				'data' => $model,
				'msg' => "Activate User Account."
			];

			return $this->response->setJSON($datareponse);
		}else{
			return redirect()->to('/CRMplatform/public/');
		}
	}

	public function deactivate_crm_user($id){
		//$db = db_connect();
		//$cmodel = new AccountModel($db);

		if(session()->get('isLoggedIn')){
			$model = new UserModel();
			$aData = [
				'id' => $id,
				'status' => 0,
			];
			$model->save($aData);
			$datareponse = [
				'success' => true,
				'data' => $model,
				'msg' => "Activate User Account."
			];

			return $this->response->setJSON($datareponse);
		}else{
			return redirect()->to('/CRMplatform/public/');
		}
	}
	
	public function change_password($id){
		$data = [];
		helper(['form']);
		
		if(session()->get('isLoggedIn')){
			if($this->request->getmethod() == 'post'){
				
				//store the account to our database
				$model = new AccountModel();
				
				$aData = [
					'password' => $this->request->getVar('password'),
				];
				
				$model->update($id,$aData);
				$datareponse = [
				'success' => true,
				'data' => $model,
				'msg' => "Password has been change."
			   ];
		 
			   return $this->response->setJSON($datareponse);
		}
		}else{
			return redirect()->to('/CRMplatform/public/');
		}
	}

	public function update_users_password($id){
		$data = [];
		helper(['form']);
		
		if(session()->get('isLoggedIn')){
			if($this->request->getmethod() == 'post'){
				
				//store the account to our database
				$model = new AccountModel();
				
				$aData = [
					'password' => $this->request->getVar('password'),
				];
				
				$model->update($id,$aData);
				$datareponse = [
				'success' => true,
				'data' => $model,
				'msg' => "Password has been change."
			   ];
		 
			   return $this->response->setJSON($datareponse);
		}
		}else{
			return redirect()->to('/CRMplatform/public/');
		}
	}
	
	public function crm_id_number($idn){
		$data = [];
		helper(['form']);
		$db = db_connect();

		if(session()->get('isLoggedIn')){
			if($this->request->getmethod() == 'post'){
				
				//store the account to our database
				$cmodel = new CustomModel($db);
				
				//$model->getCrmIdNumber($idn);
				$data['record'] = $cmodel->getCrmIdNumber($idn);
				//var_dump($data);
				
			   return $this->response->setJSON($data);
			}
		}else{
			return redirect()->to('/CRMplatform/public/');
		}
	}

	public function client_id_number($idn){
		$data = [];
		helper(['form']);
		$db = db_connect();

		if(session()->get('isLoggedIn')){
			if($this->request->getmethod() == 'post'){
				
				//store the account to our database
				$cmodel = new CustomModel($db);
				
				//$model->getCrmIdNumber($idn);
				$data['record'] = $cmodel->getClientIdNumber($idn);
				//var_dump($data);
				
			   return $this->response->setJSON($data);
			}
		}else{
			return redirect()->to('/CRMplatform/public/');
		}
	}

	public function client_phone_number($pn){
		$data = [];
		helper(['form']);
		$db = db_connect();

		if(session()->get('isLoggedIn')){
			if($this->request->getmethod() == 'post'){
				
				//store the account to our database
				$cmodel = new CustomModel($db);
				
				//$model->getCrmIdNumber($pn);
				$data['record'] = $cmodel->getClientPhoneNumber($pn);
				//var_dump($data);
				
			   return $this->response->setJSON($data);
			}
		}else{
			return redirect()->to('/CRMplatform/public/');
		}
	}
	
	public function approve_warranty($id,$mobileNumber){

		$asmodel = new AccountSummaryModel();

		if(session()->get('isLoggedIn')){
			$asData = [
				'id' => $id,
				'approved' => 1,
				'approved_by' => session()->get('email'),
				];
			$asmodel->update($id, $asData);

			//Send sms to the clients number
				$ch = curl_init();
				$message = 'تم تفعيل وثيقة الضمان لسيارتك.. شكراً لاختياركم ضمان أدماس https://admas.sa/CRMplatform/public/login.';

				curl_setopt($ch, CURLOPT_URL, "https://api.unifonic.com/rest/Messages/Send");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_HEADER, FALSE);

				curl_setopt($ch, CURLOPT_POST, TRUE);

				curl_setopt($ch, CURLOPT_POSTFIELDS, "AppSid=zOXkshoPjaPYCWCtZummXGkJiM7cXz&Recipient=".$mobileNumber."&Body=".$message);

				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				  "Content-Type: application/x-www-form-urlencoded"
				));

				$response = curl_exec($ch);
				curl_close($ch);
				//echo $response;

				return $response;
			//return true;
		}else{
			return redirect()->to('/CRMplatform/public/');
		}
	}
	
	public function remove_warranty($id){
		//$db = db_connect();
		$asmodel = new AccountSummaryModel();

		if(session()->get('isLoggedIn')){
			$asData = [
				'id' => $id,
				'approved' => 2,
				'approved_by' => session()->get('email'),
				];
			$asmodel->update($id, $asData);
			return true;
			
		}else{
			return redirect()->to('/CRMplatform/public/');
		}
	}
	
	public function get_print_warranty(){
		$db = db_connect();
		$cmodel = new CustomModel($db);

		if(session()->get('isLoggedIn')){
			$approved =  $this->request->getVar('approved');
			$date1 = null;
			$date2 = null;
			
			if(null != $this->request->getVar('start_date') || '' != $this->request->getVar('start_date')){
				$date1 = date('Y-m-d',strtotime($this->request->getVar('start_date')));
				$date2 = date('Y-m-d',strtotime($this->request->getVar('end_date')));
			}

			$data['summary'] = $cmodel->getPrintSummary($approved,$date1,$date2);
			return $this->response->setJSON($data);
			
		}else{
			return redirect()->to('/CRMplatform/public/');
		}
	}
	
	public function update_translation($trn){
		$data = [
			'translation' => $trn,
		];
		
		session()->set($data);
	}
	
	public function get_warranty_type(){
		$data = [];
		
		$db = db_connect();
		$cmodel = new CustomModel($db);
		
		if(session()->get('isLoggedIn')){
			$data['summary'] = $cmodel->getWarrantyType();

			return $this->response->setJSON($data);
		}else{
			return redirect()->to('/CRMplatform/public/');
		}
	}
	
	public function get_car_type(){
		$data = [];
		
		$db = db_connect();
		$cmodel = new CustomModel($db);
		
		if(session()->get('isLoggedIn')){
			$data['summary'] = $cmodel->getCarType();
	 
			return $this->response->setJSON($data);
		}else{
			return redirect()->to('/CRMplatform/public/');
		}
	}
	
	public function get_car_model(){
		$data = [];
		
		$db = db_connect();
		$cmodel = new CustomModel($db);
		
		if(session()->get('isLoggedIn')){
			$data['summary'] = $cmodel->getCarModel();
	 
			return $this->response->setJSON($data);
		}else{
			return redirect()->to('/CRMplatform/public/');
		}
	}
	
	public function get_showroom(){
		$data = [];
		
		$db = db_connect();
		$cmodel = new CustomModel($db);
		
		if(session()->get('isLoggedIn')){
			$data['summary'] = $cmodel->getShowroom();
	 
			return $this->response->setJSON($data);
		}else{
			return redirect()->to('/CRMplatform/public/');
		}
	}
	
	//--------------------------------------------------------------------

}
