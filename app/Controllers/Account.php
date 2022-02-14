<?php namespace App\Controllers;

use App\Models\AccountModel;
use App\Models\AccountClientsModel;
use App\Models\AccountDetailsModel;
use App\Models\UserDtlModel;

class Account extends BaseController{
	
	public function index()
	{
		$data = [];
		helper(['form']);

		if(session()->get('isLoggedIn')){
			return redirect()->to(base_url().'/dashboard');
		}else{
			if($this->request->getMethod() == 'post'){
				
				$rules =[
					'user_name' => 'required|min_length[5]|max_length[50]',
					'password' => 'required|min_length[6]|max_length[50]|validateUser[email,password]',
				];
				
				$errors = [
					'password' => [
						'validateUser' => 'Username or Password don\'t match.'
					]
				];
				
				if(! $this->validate($rules, $errors)){
					$data['validation'] = $this->validator;
				}else{
					//store the account to our database
					$model = new UserDtlModel();
					$user = $model->where('user_name',$this->request->getVar('user_name'))->where('status',1)->first();
					// $user['translation'] = $this->request->getVar('translation');
					if($user != null){
						$this->setUserSession($user);
						return redirect()->to(base_url().'/dashboard');
					}
				}
			}
			
			echo view('templates/header', $data);
			echo view('login');
			echo view('templates/footer');
		}
	}

	public function register()
	{
		$data = [];
		helper(['form']);

		if($this->request->getMethod() == 'post'){
				
			$rules =[
				'firstname' => 'required|min_length[3]|max_length[100]',
				'lastname' => 'required|min_length[3]|max_length[100]',
				'email' => 'required|min_length[6]|max_length[50]',
				'password' => 'required|min_length[6]|max_length[50]',
				'password_confirm' => 'matches[password]',
			];
			
			if(! $this->validate($rules)){
				$data['validation'] = $this->validator;
			}else{
				//store the account to our database
				$model = new AccountModel();
				
				$newData = [
					'firstname' => $this->request->getVar('firstname'),
					'lastname' => $this->request->getVar('lastname'),
					'email' => $this->request->getVar('email'),
					'password' => $this->request->getVar('password'),
					'role' => 'user',
					'status' => 1
				];

				$model->save($newData);
				$session = session();
				$session->setFlashData('success','Successful Registration');

				return redirect()->to(base_url());
			}
		}
		echo view('templates/header', $data);
		echo view('register');
		echo view('templates/footer');
	}
	
	public function login()
	{
		$data = [];
		helper(['form']);
	
		if(session()->get('isLoggedIn') == true && session()->get('isForOTP') == true){
			return redirect()->to(base_url().'/dashboard');
		}else{
			if($this->request->getMethod() == 'post'){
				
				$rules =[
					'id_number' => 'required|min_length[4]|max_length[20]',
				];
				
				if(! $this->validate($rules)){
					$data['validation'] = $this->validator;
				}else{
					//store the account to our database
					$model = new AccountClientsModel();
					$user = $model->where('id_number',$this->request->getVar('id_number'))->where('status',1)->first();
					$user['translation'] = $this->request->getVar('translation');
					
					if($user != null){
						//$client = new Client();
						//http://localhost/CRMplatform/messenger/sendmessage.php
						
						//Generate otp number
						$otpNumber = rand(1000,9999);
						$mobileNumber = $user['phone_number'];
						
						$message = [
							'phone_number' => $mobileNumber,
							'otp' => $otpNumber,
						];
						
						//Then send message to the client's mobile phone
						$ch = curl_init();
						$message = ' الخاص بك OTP هذا هو: '.$otpNumber;

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

						// echo $response;
						
						$user['otp_number'] = $otpNumber;
						$this->setClientSession($user);
						//if($response[0]['success']){
							return redirect()->to('/CRMplatform/public/account/otp');
						//}else{
						//}
						
					}
				}
				
			}
			
			echo view('templates/header', $data);
			echo view('client_login');
			echo view('templates/footer');
		}
			
	}
	
	public function otp()
	{
		$data = [];
		helper(['form']);
		
		if(session()->get('isLoggedIn') == true && session()->get('isForOTP') == true){
			return redirect()->to('/CRMplatform/public/dashboard');
		}elseif(session()->get('isLoggedIn') == false && session()->get('isForOTP') == false){
			return redirect()->to('/CRMplatform/public/login');
		}else{
			if($this->request->getmethod() == 'post'){
				
				$rules =[
					'otp' => 'required|min_length[4]|max_length[8]',
				];
				
				if(! $this->validate($rules)){
						$data['validation'] = $this->validator;
				}else{
					
					if($this->request->getVar('otp') == session()->get('otp')){
						$this->setOTPSession($this->request->getVar('otp'));
						return redirect()->to('/CRMplatform/public/dashboard');
					}
						return redirect()->to('/CRMplatform/public/account/otp');
					// if($user != null){
						// $this->setClientSession($user);
						// return redirect()->to('/CRMplatform/public/dashboard');
					// }
				}
				
			}
			
			echo view('templates/header', $data);
			echo view('otp_login');
			echo view('templates/footer');
		}
		
	}
	
	public function logout()
	{
		session()->destroy();
		return redirect()->to(base_url());
	}
	
	public function logout_client()
	{
		session()->destroy();
		return redirect()->to(base_url().'/login');
	}
	
	private function setUserSession($user){
		$data = [
			'id' => $user['id'],
			'user_name' => $user['user_name'],
			'access_rights_id' => $user['access_rights_id'],
			'status' => $user['status'],
			'isLoggedIn' => true,
		];

		session()->set($data);
		return true;
	}
	
	private function setOTPSession($otp){
		$data = [
			'isForOTP' => true,
			'isLoggedIn' => true
		];
		
		session()->set($data);
		return true;
	}
	
	private function setClientSession($user){
		$data = [
			'id' => $user['id'],
			'id_number' => $user['id_number'],
			'phone_number' => $user['phone_number'],
			'email' => $user['email'],
			'role' => 'client',
			'otp' => $user['otp_number'],
			'translation' => $user['translation'],
			'isForOTP' => true,
			'isLoggedIn' => false,
		];
		
		session()->set($data);
		return true;
	}
	
	private function httpPost($url, $data)
	{
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}

	//--------------------------------------------------------------------

}
