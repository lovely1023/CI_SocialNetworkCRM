<?php namespace App\Controllers;

use App\Models\UserDtlModel;
use App\Models\ClientDtlModel;
use App\Models\AccessRightsModel;
use App\Models\LogsModel;
use App\Models\CountryModel;
use App\Models\ClientLeadMineModel;

class Admin_Dashboard extends BaseController
{
	
	public function index()
	{
		$data = [];
		$userDtl = new UserDtlModel();
		$rights = new AccessRightsModel();
		$leads = new ClientLeadMineModel();
		$country = new CountryModel();

		helper(['form', 'url']);

		if(session()->get('isLoggedIn'))
		{
			$data['dashboard_type'] = 'admin_dashboard';
			$data['pageTitle'] = 'Admin';

			$username = session()->get('user_name');
			$userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
			$data['user'] = $userLoggedIn;
			$data['countries'] = $country->findAll();

			$data['leads'] = $leads->where('client_id',$userLoggedIn['client_id'])->findAll();
			
			echo view('templates/dashboard_header', $data);
			echo view('admin/dashboard', $data);
			// echo view('users/dashboard', $data);
			echo view('templates/dashboard_footer');
		}
		else
		{
			return redirect()->to(base_url());
		}
		
	}
	
	public function user_list($userId)
	{
		$data = [];
		$userDtl = new UserDtlModel();
		$rights = new AccessRightsModel();
		$country = new CountryModel();

		$current_logged_access_right = session()->get('access_rights_id');
		if(session()->get('isLoggedIn') && $current_logged_access_right == 2)
		{
			$userLoggedIn = $userDtl->where('id',$userId)->where('status',1)->first();
			$data['user'] = $userLoggedIn;
			$data['userList'] = $userDtl->getAllUsers(2);
			
			$data['pageTitle'] = 'Admin';
			$data['dashboard_type'] = 'admin_dashboard';
			$data['countries'] = $country->findAll();
			
			echo view('templates/dashboard_header', $data);
			echo view('users/dashboard', $data);
			echo view('templates/dashboard_footer');
		}
		else
		{
			return redirect()->to(base_url());
		}
	}

	public function load_users()
	{
		$data = [];
		$userDtl = new UserDtlModel();
		$data = $userDtl->getAllUsers(2);

		echo json_encode($data);
	}

	public function load_rights()
	{
		$data = [];
		$rights = new AccessRightsModel();
		$data = $rights->findAll();

		echo json_encode($data);
   }
   
   public function load_countries()
   {
      $data = [];
		$countries = new CountryModel();
		$data = $countries->findAll();

		echo json_encode($data);
   }

   public function save_user()
   {
		$clientDtl = new ClientDtlModel();
		$userDtl = new UserDtlModel();
		$logs = new LogsModel();

		helper(['form', 'url']);
		$username = session()->get('user_name');
		$userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
		
		$clientDtl_data = [
			'first_name' => $this->request->getPost('first_name'),
			'mid_name'  => $this->request->getPost('mid_name'),
			'last_name'  => $this->request->getPost('last_name'),
			'birth_date'  => $this->request->getPost('birth_date'),
			'gender'  => $this->request->getPost('gender'),
			'phone_number'  => $this->request->getPost('phone_number'),
			'mobile_number'  => $this->request->getPost('mobile_number'),
			'email_address'  => $this->request->getPost('email_address'),
			'home_address'  => $this->request->getPost('home_address'),
			'city'  => $this->request->getPost('city'),
			'zip_code'  => $this->request->getPost('zip_code'),
			'state'  => $this->request->getPost('state'),
			'country'  => $this->request->getPost('country'),
			'alert'  => $this->request->getPost('alert')
		];
		
		$photoFile = $this->request->getFile('upload_photo');
		if ($photoFile->isValid() && !$photoFile->hasMoved()) 
		{
			$photoFile->move('./uploads/images');
			$clientDtl_data += [
				'photo_path' => ($photoFile) ? $photoFile->getName() : ''
			];
		}
		$clientDtl_save = $clientDtl->insert($clientDtl_data);

		// insert query in user_logs
		$logs->save([
			'action_taken' => 'INSERT',
			'action_taken_by' => $loggedIn_user['user_name'],
			'query_string' => (string)$clientDtl->getLastQuery(),
			'table_name' => 'client_dtl'
		]);
		// insert user_dtl
		$userDtl_data = [
			'client_id' => $clientDtl_save,
			'user_name' => $this->request->getPost('user_name'),
			'password' => $this->request->getPost('password'),
			'access_rights_id' => $this->request->getPost('access_right')
		];
		$userDtl_save = $userDtl->save($userDtl_data);
		// insert query in user_logs
		$logs->insert([
			'action_taken' => 'INSERT',
			'action_taken_by' => $loggedIn_user['user_name'],
			'query_string' => (string)$userDtl->getLastQuery(),
			'table_name' => 'user_dtl'
		]);

		// return $this->response->setJSON($response);
		echo json_encode($response);
	}

	public function save_userProfile()
	{
		$clientDtl = new ClientDtlModel();
		$userDtl = new UserDtlModel();
		$logs = new LogsModel();

		helper(['form', 'url']);

		$username = session()->get('user_name');
		$userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
		$clientDtl_data = [
			'first_name' => $this->request->getPost('first_name'),
			'mid_name'  => $this->request->getPost('mid_name'),
			'last_name'  => $this->request->getPost('last_name'),
			'birth_date'  => $this->request->getPost('birth_date'),
			'gender'  => $this->request->getPost('gender'),
			'phone_number'  => $this->request->getPost('phone_number'),
			'mobile_number'  => $this->request->getPost('mobile_number'),
			'email_address'  => $this->request->getPost('email_address'),
			'home_address'  => $this->request->getPost('home_address'),
			'city'  => $this->request->getPost('city'),
			'zip_code'  => $this->request->getPost('zip_code'),
			'state'  => $this->request->getPost('state'),
			'country'  => $this->request->getPost('country'),
			'alert'  => $this->request->getPost('alert')
		];

		$photoFile = $this->request->getFile('file');
		if ($photoFile->isValid() && !$photoFile->hasMoved()) 
		{
			$photoFile->move('./uploads/images');
			$clientDtl_data += [
				'photo_path' => ($photoFile) ? $photoFile->getName() : ''
			];
		}

		$clientDtl_save = $clientDtl->insert($clientDtl_data);
		// insert query in user_logs
		$logs->insert([
			'action_taken' => 'INSERT',
			'action_taken_by' => $loggedIn_user['user_name'],
			'query_string' => (string)$clientDtl->getLastQuery(),
			'table_name' => 'client_dtl'
		]);		

		// insert user_dtl
		$userDtl_data = [
			'client_id' => $clientDtl_save,
			'user_name' => $this->request->getPost('user_name'),
			'password' => $this->request->getPost('password'),
			'access_rights_id' => $this->request->getPost('access_right')
		];
		$userDtl_save = $userDtl->insert($userDtl_data);
		// insert query in user_logs
		$logs->insert([
			'action_taken' => 'INSERT',
			'action_taken_by' => $loggedIn_user['user_name'],
			'query_string' => (string)$userDtl->getLastQuery(),
			'table_name' => 'user_dtl'
		]);
		
		echo json_encode(array('success'=>true));
	}

	public function get_userData($userId)
	{
		$userDtl = new UserDtlModel();

		$data = $userDtl->getUserDetails($userId);

		echo json_encode($data);
	}
	
	public function edit_user($userId) 
	{
		$rights = new AccessRightsModel();
		$clientDtl = new ClientDtlModel();
		$userDtl = new UserDtlModel();
		$logs = new LogsModel();
		
		helper(['form', 'url']);

		if($this->request->getMethod() == 'post'){
			$username = session()->get('user_name');
			$userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
			// update client_dtl
			$clientDtl_data = [
				'first_name' => $this->request->getVar('first_name'),
				'mid_name'  => $this->request->getVar('mid_name'),
				'last_name'  => $this->request->getVar('last_name'),
				'birth_date'  => $this->request->getVar('birth_date'),
				'gender'  => $this->request->getVar('gender'),
				'phone_number'  => $this->request->getVar('phone_number'),
				'mobile_number'  => $this->request->getVar('mobile_number'),
				'email_address'  => $this->request->getVar('email_address'),
				'home_address'  => $this->request->getVar('home_address'),
				'city'  => $this->request->getVar('city'),
				'state'  => $this->request->getVar('state'),
				'country'  => $this->request->getVar('country'),
				'zip_code'  => $this->request->getVar('zip_code'),
				'alert'  => $this->request->getVar('alert'),
				'access_rights' => $this->request->getVar('access_right')
			];

			$photoFile = $this->request->getFile('upload_photo');
			if ($photoFile->isValid() && !$photoFile->hasMoved()) 
			{
				$photoFile->move('./uploads/images');
				$clientDtl_data += [
					'photo_path' => ($photoFile) ? $photoFile->getName() : ''
				];
			}

			$clientDtl->update($userId, $clientDtl_data);
			
			// insert query in user_logs
			$logs_data1 = [
				'action_taken' => 'UPDATE',
				'action_taken_by' => $loggedIn_user['user_name'],
				'query_string' => (string)$clientDtl->getLastQuery(),
				'table_name' => 'client_dtl'
			];

			$logs->insert($logs_data1);
			
			// update user_dtl
			$userDtl_data = [
				'client_id' => $userId,
				'user_name' => $this->request->getVar('user_name'),
				'access_rights' => $this->request->getVar('access_right')
			];
			if(!empty($this->request->getVar('password'))) {
				$userDtl_data += [
					'password' => $this->request->getVar('password')
				];
			}
			$userDtl->update($userId, $userDtl_data);

			// insert query in user_logs
			$logs_data2 = [
				'action_taken' => 'UPDATE',
				'action_taken_by' => $loggedIn_user['user_name'],
				'query_string' => (string)$userDtl->getLastQuery(),
				'table_name' => 'user_dtl'
			];
			$logs->insert($logs_data2);

			return redirect()->to(base_url('admin_dashboard'));
		}

		$data['userId'] = $userId;
		$data['access_rights'] = $rights->findAll();
		$data['user_dtls'] = $userDtl->getUserDetails($userId);

		echo view('templates/header');
		echo view('users/edit_user',$data);
		echo view('templates/footer');
	}

	public function delete_user($loggedInUserId, $userId) 
	{
		$userDtl = new UserDtlModel();
		$clientDtl = new ClientDtlModel();
		$logs = new LogsModel();
		
		$userLoggedIn = $userDtl->where('id',$loggedInUserId)->where('status',1)->first();
		$userDetail = $userDtl->where('id',$userId)->first();
		
		// update client_dtl
		$is_deleted = array(
			'is_deleted' => 1
		);

		$clientDtl->update(array('id' => $userDetail['client_id']), $is_deleted);
		$logs_data = [
			'action_taken' => 'DELETE',
			'action_taken_by' => $userLoggedIn['user_name'],
			'query_string' => (string)$clientDtl->getLastQuery(),
			'table_name' => 'client_dtl'
		];
		$logs->insert($logs_data);

		$user_delete = array('status' => 0);
		$userDtl->update($userId, $user_delete);

		$logs_data2 = [
			'action_taken' => 'DELETE',
			'action_taken_by' => $userLoggedIn['user_name'],
			'query_string' => (string)$userDtl->getLastQuery(),
			'table_name' => 'user_dtl'
		];
		$logs->insert($logs_data2);
		echo json_encode(array("status" => TRUE));
	}

	public function add_new_lead($clientId) 
	{
		$rights = new AccessRightsModel();
		$clientDtl = new ClientDtlModel();
		$userDtl = new UserDtlModel();
		$logs = new LogsModel();
		$clientLead = new ClientLeadMineModel();
		
		helper(['form', 'url']);

		if($this->request->getMethod() == 'post'){
			// for validation
			$rules = [
				'full_name' => 'required|min_length[3]|max_length[100]',
				'email_address' => 'required|min_length[6]|max_length[50]',
			];

			if(! $this->validate($rules))
			{
				$data['validation'] = $this->validator;
			} 
			else 
			{
				$username = session()->get('user_name');
				$loggedIn_user = $userDtl->where('user_name',$username)->where('client_id',$clientId)->first();
				// insert client_dtl
				$lead_data = [
					'client_id' => $clientId,
					'customer_type' => $this->request->getVar('customer_type'),
					'source' => $this->request->getVar('source'),
					'full_name' => $this->request->getVar('full_name'),
					'email_address' => $this->request->getVar('email_address'),
					'company' => $this->request->getVar('company'),
					'home_address' => $this->request->getVar('home_address'),
					'city' => $this->request->getVar('city'),
					'state' => $this->request->getVar('state'),
					'country' => $this->request->getVar('country'),
					'zip_code' => $this->request->getVar('zip_code'),
					'phone_number' => $this->request->getVar('phone_number'),
					'mobile_number' => $this->request->getVar('mobile_number'),
					'birth_date' => $this->request->getVar('birth_date'),
					'occupation' => $this->request->getVar('occupation'),
					'benefits_looking_for' => $this->request->getVar('benefits_looking_for'),
					'first_question' => $this->request->getVar('first_question'),
					'first_question_answer' => $this->request->getVar('first_question_answer'),
					'second_question' => $this->request->getVar('second_question'),
					'second_question_answer' => $this->request->getVar('second_question_answer'),
					'third_question' => $this->request->getVar('third_question'),
					'third_question_answer' => $this->request->getVar('third_question_answer'),
					'fourth_question' => $this->request->getVar('fourth_question'),
					'fourth_question_answer' => $this->request->getVar('fourth_question_answer'),
					'fifth_question' => $this->request->getVar('fifth_question'),
					'fifth_question_answer' => $this->request->getVar('fifth_question_answer')
				];


				// get client id
				$lead_save = $clientLead->insert($lead_data);
				// insert query in user_logs
				$logs->insert([
					'action_taken' => 'INSERT',
					'action_taken_by' => $loggedIn_user['user_name'],
					'query_string' => (string)$clientLead->getLastQuery(),
					'table_name' => 'client_lead_mine'
				]);

				return redirect()->to(base_url('admin_dashboard'));
			}
		}
	}
	
	public function page1()
	{
		echo view('templates/header');
		echo view('page1');
		echo view('templates/footer');
	}
	
	public function page2()
	{
		echo view('templates/header');
		echo view('page2');
		echo view('templates/footer');
	}
	
	public function page3()
	{
		echo view('templates/header');
		echo view('page3');
		echo view('templates/footer');
	}

	//--------------------------------------------------------------------

}
