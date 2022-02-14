<?php namespace App\Controllers;

use App\Models\UserDtlModel;
use App\Models\ClientDtlModel;
use App\Models\AccessRightsModel;
use App\Models\LogsModel;
use App\Models\MobileCarrierModel;
use App\Models\CityModel;
use App\Models\CountryModel;
use App\Models\EmailCampaignTypeModel;
use App\Models\OrganizationModel;
use App\Models\EmailTemplateTypeModel;
use App\Models\EmailTemplateModel;

class Common_Fields extends BaseController
{
	
	public function index()
	{	
      return redirect()->to(base_url('/common_fields/main'));
   }

   public function main()
   {
      $org = new OrganizationModel();
      $country = new CountryModel();
      $userDtl = new UserDtlModel();
      if(session()->get('isLoggedIn'))
		{
         $data['dashboard_type'] = 'superadmin_dashboard'; // to be updated to be dynamic
         $data['pageTitle'] = 'Super Admin'; // to be updated to actual role
         $username = session()->get('user_name');
			$userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
			$data['user'] = $userLoggedIn;
         
		   $data['org_lists'] = $org->where('status', 1)->findAll();
		   $data['country_lists'] = $country->where('status', 1)->findAll();
         echo view('templates/dashboard_header', $data);
         echo view('common_fields/dashboard',$data);
         echo view('templates/dashboard_footer');
      }
      else
      {
         return redirect()->to(base_url('/account/logout'));
      }
   }

   public function email_template()
   {
      $userDtl = new UserDtlModel();
      $rights = new AccessRightsModel();
      $emailTemplate = new EmailTemplateModel();
      $templateType = new EmailTemplateTypeModel();
      if(session()->get('isLoggedIn'))
		{
         $data['dashboard_type'] = 'superadmin_dashboard';
         $data['pageTitle'] = 'Admin';

         $username = session()->get('user_name');
         $userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
         $data['user'] = $userLoggedIn;
         $data['email_templates'] = $emailTemplate->where('status',1)->findAll();
         $data['template_types'] = $templateType->where('status',1)->findAll();
         
         echo view('templates/dashboard_header', $data);
         echo view('common_fields/email_template/dashboard', $data);
         echo view('templates/dashboard_footer');
      }
      else
      {
         return redirect()->to(base_url('/account/logout'));
      }
   }

   public function load_email_template()
   {

   }

   public function add_email_template()
   {
      $emailTemplate = new EmailTemplateModel();
      $userDtl = new UserDtlModel();
      $logs = new LogsModel();
      
      helper(['form', 'url']);
		$username = session()->get('user_name');
		$userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
      
      $emailTemplate_dtl = [
         'org_id' => $userLoggedIn['org_id'],
         'email_template_type' => $this->request->getPost('template_type'),
         'subject' => $this->request->getPost('subject'),
         'content' => $this->request->getPost('content')
      ];

      $photoFile = $this->request->getFile('header_image');
      if ($photoFile->isValid() && !$photoFile->hasMoved()) 
		{
			$photoFile->move('./uploads/email_template');
			$emailTemplate_dtl += [
				'image' => ($photoFile) ? $photoFile->getName() : ''
			];
      }
      
      $emailTemplate_save = $emailTemplate->insert($emailTemplate_dtl);
      $logs->insert([
         'client_id' => $userLoggedIn['client_id'],
         'org_id' => $userLoggedIn['org_id'],// temporary, to confirm
			'action_taken' => 'INSERT',
			'action_taken_by' => $userLoggedIn['user_name'],
			'query_string' => (string)$emailTemplate->getLastQuery(),
			'table_name' => 'email_template'
      ]);
      
      return redirect()->to(base_url('/common_fields/email_template'));
   }

   public function get_email_template_dtl($id)
   {
      $emailTemplate = new EmailTemplateModel();

      $data = $emailTemplate->where('id',$id)->first();
      echo json_encode($data);
   }

   public function edit_email_template($id)
   {

   }

   public function delete_email_template($id)
   {
      $emailTemplate = new EmailTemplateModel();
      $userDtl = new UserDtlModel();
      $logs = new LogsModel();
      
      helper(['form', 'url']);
		$username = session()->get('user_name');
		$userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
      
      $emailTemplate_dtl = [
         'status' => 0
      ];
      
      $emailTemplate_save = $emailTemplate->update($id, $emailTemplate_dtl);
      $logs->insert([
         'client_id' => $userLoggedIn['client_id'],
         'org_id' => $userLoggedIn['org_id'],// temporary, to confirm
			'action_taken' => 'DELETE(soft)',
			'action_taken_by' => $userLoggedIn['user_name'],
			'query_string' => (string)$emailTemplate->getLastQuery(),
			'table_name' => 'email_template'
      ]);
      
      return redirect()->to(base_url('/common_fields/email_template'));
   }

   public function load_email_template_type()
   {
      $templateType = new EmailTemplateTypeModel();
      $userDtl = new UserDtlModel();

      $username = session()->get('user_name');
      $userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
      
      $data = $templateType->where('status',1)->findAll();
      echo json_encode($data);
   }

   public function add_email_template_type()
   {
      $templateType = new EmailTemplateTypeModel();
      $userDtl = new UserDtlModel();
      $logs = new LogsModel();

      $username = session()->get('user_name');
      $userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
		
      $data = [
         'template_type' => $this->request->getPost('template_type'),
      ];

      $templateType_save = $templateType->insert($data);

      $logs->insert([
         'client_id' => $userLoggedIn['client_id'],
         'org_id' => $userLoggedIn['org_id'],// temporary, to confirm
			'action_taken' => 'INSERT',
			'action_taken_by' => $userLoggedIn['user_name'],
			'query_string' => (string)$templateType->getLastQuery(),
			'table_name' => 'email_template_type'
		]);
   }

   public function get_email_template_type_dtl($id)
   {
      $templateType = new EmailTemplateTypeModel();
      $data = $templateType->where('id',$id)->first();
      echo json_encode($data);
   }

   public function edit_email_template_type($id)
   {
      $templateType = new EmailTemplateTypeModel();
      $userDtl = new UserDtlModel();
      $logs = new LogsModel();

      $username = session()->get('user_name');
      $userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
		
      $data = [
         'template_type' => $this->request->getPost('template_type'),
      ];

      $templateType_save = $templateType->update($id, $data);

      $logs->insert([
         'client_id' => $userLoggedIn['client_id'],
         'org_id' => $userLoggedIn['org_id'],// temporary, to confirm
			'action_taken' => 'UPDATE',
			'action_taken_by' => $userLoggedIn['user_name'],
			'query_string' => (string)$templateType->getLastQuery(),
			'table_name' => 'email_template_type'
		]);
   }

   public function delete_email_template_type($id)
   {
      $templateType = new EmailTemplateTypeModel();
      $userDtl = new UserDtlModel();
      $logs = new LogsModel();

      $username = session()->get('user_name');
      $userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
      
      $data = [
         'status' => 0
      ];
      $templateType->update($id, $data);
      
      $logs->insert([
         'client_id' => $userLoggedIn['client_id'],
         'org_id' => $userLoggedIn['org_id'], // temporary, to confirm
			'action_taken' => 'DELETE(soft)',
			'action_taken_by' => $userLoggedIn['user_name'],
			'query_string' => (string)$templateType->getLastQuery(),
			'table_name' => 'email_template_type'
		]);
   }

   public function load_campaign_type()
   {
      $campaignType = new EmailCampaignTypeModel();
      $userDtl = new UserDtlModel();
      $org_id = '';

      $username = session()->get('user_name');
      $userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
      if($userLoggedIn->access_rights_id == 1)
      {
         $org_id = $userLoggedIn->org_id;
      }
      $data = $campaignType->getCampaignTypeList($org_id);
      echo json_encode($data);
   }

   public function load_org_list()
   {
      $data = [];
		$org = new OrganizationModel();
		$data = $org->findAll();

		echo json_encode($data);
   }

   public function add_campaign_type()
   {
      $org = new OrganizationModel();
      $campaignType = new EmailCampaignTypeModel();
      $userDtl = new UserDtlModel();
      $logs = new LogsModel();

      $username = session()->get('user_name');
      $userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
		
      $data = [
         'client_id' => $userLoggedIn['client_id'],
         'org_id' => $this->request->getPost('org'),
         'campaign_type' => $this->request->getPost('campaign_type'),
         'added_by' => $userLoggedIn['user_name']
      ];

      $campaignType_save = $campaignType->insert($data);

      $logs->insert([
         'client_id' => $userLoggedIn['client_id'],
         'org_id' => $userLoggedIn['org_id'],// temporary, to confirm
			'action_taken' => 'INSERT',
			'action_taken_by' => $userLoggedIn['user_name'],
			'query_string' => (string)$campaignType->getLastQuery(),
			'table_name' => 'email_campaign_type'
		]);
   }

   public function get_campaign_type_dtl($id)
   {
      $campaignType = new EmailCampaignTypeModel();
      $data = $campaignType->where('id',$id)->first();
      echo json_encode($data);
   }

   public function edit_campaign_type($id)
   {
      $org = new OrganizationModel();
      $campaignType = new EmailCampaignTypeModel();
      $userDtl = new UserDtlModel();
      $logs = new LogsModel();

      $username = session()->get('user_name');
      $userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
		
      $data = [
         // 'client_id' => $userLoggedIn['client_id'],
         'org_id' => $this->request->getPost('org'),
         'campaign_type' => $this->request->getPost('campaign_type'),
      ];

      $campaignType_save = $campaignType->update($id, $data);

      $logs->insert([
         'client_id' => $userLoggedIn['client_id'],
         'org_id' => $userLoggedIn['org_id'],// temporary, to confirm
			'action_taken' => 'UPDATE',
			'action_taken_by' => $userLoggedIn['user_name'],
			'query_string' => (string)$campaignType->getLastQuery(),
			'table_name' => 'email_campaign_type'
		]);
   }

   public function delete_campaign_type($id)
   {
      $campaignType = new EmailCampaignTypeModel();
      $userDtl = new UserDtlModel();
      $logs = new LogsModel();

      $username = session()->get('user_name');
      $userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
      $campaignTypeDtl = $campaignType->where('id', $id)->first();
      
      $data = [
         'status' => 0
      ];
      $campaignType->update($id, $data);
      
      $logs->insert([
         'client_id' => $userLoggedIn['client_id'],
         'org_id' => $userLoggedIn['org_id'], // temporary, to confirm
			'action_taken' => 'DELETE(soft)',
			'action_taken_by' => $userLoggedIn['user_name'],
			'query_string' => (string)$campaignType->getLastQuery(),
			'table_name' => 'email_campaign_type'
		]);
   }

   public function load_mobile_carrier()
   {
      $mobileCarrier = new MobileCarrierModel();

      $data = $mobileCarrier->where('status',1)->findAll();
      echo json_encode($data);
   }

   public function add_mobile_carrier()
   {
      $mobileCarrier = new MobileCarrierModel();
      $userDtl = new UserDtlModel();
      $logs = new LogsModel();

      $username = session()->get('user_name');
      $userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
		
      $data = [
         'mobile_carrier_name' => $this->request->getPost('mobile_carrier'),
         'country' => $this->request->getPost('country'),
      ];

      $mobileCarrier_save = $mobileCarrier->insert($data);

      $logs->insert([
         'client_id' => $userLoggedIn['client_id'],
         'org_id' => $userLoggedIn['org_id'], //temporary user_dtl org_id
			'action_taken' => 'INSERT',
			'action_taken_by' => $userLoggedIn['user_name'],
			'query_string' => (string)$mobileCarrier->getLastQuery(),
			'table_name' => 'mobile_carrier'
		]);
   }

   public function get_mobile_carrier_dtl($id)
   {
      $mobileCarrier = new MobileCarrierModel();
      $data = $mobileCarrier->where('id',$id)->first();
      echo json_encode($data);
   }

   public function edit_mobile_carrier($id)
   {
      $mobileCarrier = new MobileCarrierModel();
      $userDtl = new UserDtlModel();
      $logs = new LogsModel();

      $username = session()->get('user_name');
      $userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
		
      $data = [
         'mobile_carrier_name' => $this->request->getPost('mobile_carrier'),
         'country' => $this->request->getPost('country'),
      ];

      $mobileCarrier_save = $mobileCarrier->update($id, $data);

      $logs->insert([
         'client_id' => $userLoggedIn['client_id'],
         'org_id' => $userLoggedIn['org_id'],
			'action_taken' => 'UPDATE',
			'action_taken_by' => $userLoggedIn['user_name'],
			'query_string' => (string)$mobileCarrier->getLastQuery(),
			'table_name' => 'mobile_carrier'
		]);
   }

   public function delete_mobile_carrier($id)
   {
      $mobileCarrier = new MobileCarrierModel();
      $userDtl = new UserDtlModel();
      $logs = new LogsModel();

      $username = session()->get('user_name');
      $userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
		
      $data = [
         'status' => 0
      ];
      
      $mobileCarrier->update($id, $data);

      $logs->insert([
         'client_id' => $userLoggedIn['client_id'],
         'org_id' => $userLoggedIn['org_id'],
			'action_taken' => 'DELETE(soft)', // to change
			'action_taken_by' => $userLoggedIn['user_name'],
			'query_string' => (string)$mobileCarrier->getLastQuery(),
			'table_name' => 'mobile_carrier'
		]);
   }

   public function load_country()
   {
      $country = new CountryModel();

      $data = $country->where('status',1)->findAll();
      echo json_encode($data);
   }

   public function add_country()
   {
      $country = new CountryModel();
      $userDtl = new UserDtlModel();
      $logs = new LogsModel();

      $username = session()->get('user_name');
      $userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
		
      $data = [
         'country_name' => $this->request->getPost('country_name'),
         'country_code' => $this->request->getPost('country_code'),
      ];

      $country_save = $country->insert($data);

      $logs->insert([
         'client_id' => $userLoggedIn['client_id'],
         'org_id' => $userLoggedIn['org_id'], //temporary user_dtl org_id
			'action_taken' => 'INSERT',
			'action_taken_by' => $userLoggedIn['user_name'],
			'query_string' => (string)$country->getLastQuery(),
			'table_name' => 'country'
		]);
   }

   public function get_country_dtl($id)
   {
      $country = new CountryModel();
      $data = $country->where('id',$id)->first();
      echo json_encode($data);
   }

   public function edit_country($id)
   {
      $country = new CountryModel();
      $userDtl = new UserDtlModel();
      $logs = new LogsModel();

      $username = session()->get('user_name');
      $userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
		
      $data = [
         'country_name' => $this->request->getPost('country_name'),
         'country_code' => $this->request->getPost('country_code'),
      ];

      $country_save = $country->update($id, $data);

      $logs->insert([
         'client_id' => $userLoggedIn['client_id'],
         'org_id' => $userLoggedIn['org_id'],
			'action_taken' => 'UPDATE',
			'action_taken_by' => $userLoggedIn['user_name'],
			'query_string' => (string)$country->getLastQuery(),
			'table_name' => 'country'
		]);
   }

   public function delete_country($id)
   {
      $country = new CountryModel();
      $userDtl = new UserDtlModel();
      $logs = new LogsModel();

      $username = session()->get('user_name');
      $userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
		
      $data = [
         'status' => 0
      ];
      
      $country->update($id, $data);

      $logs->insert([
         'client_id' => $userLoggedIn['client_id'],
         'org_id' => $userLoggedIn['org_id'],
			'action_taken' => 'DELETE(soft)', // to change
			'action_taken_by' => $userLoggedIn['user_name'],
			'query_string' => (string)$country->getLastQuery(),
			'table_name' => 'country'
		]);
   }

   public function load_city()
   {
      $city = new CityModel();

      $data = $city->where('status',1)->findAll();
      echo json_encode($data);
   }

   public function add_city()
   {
      $city = new CityModel();
      $userDtl = new UserDtlModel();
      $logs = new LogsModel();

      $username = session()->get('user_name');
      $userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
		
      $data = [
         'city_name' => $this->request->getPost('city_name'),
         'country' => $this->request->getPost('country'),
         'area_code' => $this->request->getPost('area_code'),
      ];

      $city_save = $city->insert($data);

      $logs->insert([
         'client_id' => $userLoggedIn['client_id'],
         'org_id' => $userLoggedIn['org_id'], //temporary user_dtl org_id
			'action_taken' => 'INSERT',
			'action_taken_by' => $userLoggedIn['user_name'],
			'query_string' => (string)$city->getLastQuery(),
			'table_name' => 'city'
		]);
   }

   public function get_city_dtl($id)
   {
      $city = new CityModel();
      $data = $city->where('id',$id)->first();
      echo json_encode($data);
   }

   public function edit_city($id)
   {
      $city = new CityModel();
      $userDtl = new UserDtlModel();
      $logs = new LogsModel();

      $username = session()->get('user_name');
      $userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
		
      $data = [
         'city_name' => $this->request->getPost('city_name'),
         'country' => $this->request->getPost('country'),
         'area_code' => $this->request->getPost('area_code'),
      ];

      $city_save = $city->update($id, $data);

      $logs->insert([
         'client_id' => $userLoggedIn['client_id'],
         'org_id' => $userLoggedIn['org_id'],
			'action_taken' => 'UPDATE',
			'action_taken_by' => $userLoggedIn['user_name'],
			'query_string' => (string)$city->getLastQuery(),
			'table_name' => 'city'
		]);
   }

   public function delete_city($id)
   {
      $city = new CityModel();
      $userDtl = new UserDtlModel();
      $logs = new LogsModel();

      $username = session()->get('user_name');
      $userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
		
      $data = [
         'status' => 0
      ];
      
      $city->update($id, $data);

      $logs->insert([
         'client_id' => $userLoggedIn['client_id'],
         'org_id' => $userLoggedIn['org_id'],
			'action_taken' => 'DELETE(soft)', // to change
			'action_taken_by' => $userLoggedIn['user_name'],
			'query_string' => (string)$city->getLastQuery(),
			'table_name' => 'city'
		]);
   }

   public function load_org()
   {
      $org = new OrganizationModel();

      $data = $org->where('status',1)->findAll();
      echo json_encode($data);
   }

   public function add_org()
   {
      $org = new OrganizationModel();
      $userDtl = new UserDtlModel();
      $logs = new LogsModel();

      $username = session()->get('user_name');
      $userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
		
      $data = [
         'org_id' => 3, // need to ask format
         'org_name' => $this->request->getPost('org_name')
      ];

      $org_save = $org->insert($data);

      $logs->insert([
         'client_id' => $userLoggedIn['client_id'],
         'org_id' => $userLoggedIn['org_id'], //temporary user_dtl org_id
			'action_taken' => 'INSERT',
			'action_taken_by' => $userLoggedIn['user_name'],
			'query_string' => (string)$org->getLastQuery(),
			'table_name' => 'organization'
		]);
   }

   public function get_org_dtl($id)
   {
      $org = new OrganizationModel();
      $data = $org->where('id',$id)->first();
      echo json_encode($data);
   }

   public function edit_org($id)
   {
      $org = new OrganizationModel();
      $userDtl = new UserDtlModel();
      $logs = new LogsModel();

      $username = session()->get('user_name');
      $userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
		
      $data = [
         'org_id' => '', // need to ask format
         'org_name' => $this->request->getPost('org_name')
      ];

      $org_save = $org->update($id, $data);

      $logs->insert([
         'client_id' => $userLoggedIn['client_id'],
         'org_id' => $userLoggedIn['org_id'],
			'action_taken' => 'UPDATE',
			'action_taken_by' => $userLoggedIn['user_name'],
			'query_string' => (string)$org->getLastQuery(),
			'table_name' => 'organization'
		]);
   }

   public function delete_org($id)
   {
      $org = new OrganizationModel();
      $userDtl = new UserDtlModel();
      $logs = new LogsModel();

      $username = session()->get('user_name');
      $userLoggedIn = $userDtl->where('user_name',$username)->where('status',1)->first();
		
      $data = [
         'status' => 0
      ];
      
      $org->update($id, $data);

      $logs->insert([
         'client_id' => $userLoggedIn['client_id'],
         'org_id' => $userLoggedIn['org_id'],
			'action_taken' => 'DELETE(soft)', // to change
			'action_taken_by' => $userLoggedIn['user_name'],
			'query_string' => (string)$org->getLastQuery(),
			'table_name' => 'organization'
		]);
   }

   public function get_userData($loggedUser, $userId)
	{
		$userDtl = new UserDtlModel();

		$data = $userDtl->getUserDetails($userId);

		echo json_encode($data);
	}

	//--------------------------------------------------------------------

}
