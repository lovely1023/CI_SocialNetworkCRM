<?php namespace App\Controllers;

use App\Models\UserDtlModel;
use App\Models\ClientDtlModel;
use App\Models\AccessRightsModel;
use App\Models\LogsModel;

class Coordinator_Dashboard extends BaseController
{
	
	public function index()
	{
		$data = [];
		$userDtl = new UserDtlModel();
		$rights = new AccessRightsModel();

		if(session()->get('isLoggedIn'))
		{
			$data['dashboard_type'] = 'coordinator_dashboard';
			$data['pageTitle'] = 'Coordinator';

			$username = session()->get('user_name');
			$userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
			$data['user'] = $userLoggedIn;

			echo view('templates/dashboard_header');
			echo view('coordinator/dashboard', $data);
			// echo view('users/dashboard', $data);
			echo view('templates/dashboard_footer');
		}
		else
		{
			return redirect()->to(base_url());
		}
		
	}
	
	public function user_list()
	{
		
	}
}
