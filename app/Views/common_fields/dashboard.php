<div class="content col-lg-10 col-xs-12">
   <div class="row">
      <div class="col-lg-12 col-xs-12">
         <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
               <a class="nav-item nav-link active" id="nav-email-template-type-tab" data-toggle="tab" href="#nav-email-template-type" role="tab" aria-controls="nav-email-template-type" aria-selected="true">Email Template Type</a>
               <a class="nav-item nav-link" id="nav-campaign-type-tab" data-toggle="tab" href="#nav-campaign-type" role="tab" aria-controls="nav-campaign-type" aria-selected="false">Email Campaign Type</a>
               <a class="nav-item nav-link" id="nav-mobile-carrier-tab" data-toggle="tab" href="#nav-mobile-carrier" role="tab" aria-controls="nav-mobile-carrier" aria-selected="false">Mobile Carrier</a>
               <a class="nav-item nav-link" id="nav-country-tab" data-toggle="tab" href="#nav-country" role="tab" aria-controls="nav-country" aria-selected="false">Country</a>
               <a class="nav-item nav-link" id="nav-city-tab" data-toggle="tab" href="#nav-city" role="tab" aria-controls="nav-city" aria-selected="false">City</a>
               <a class="nav-item nav-link" id="nav-organization-tab" data-toggle="tab" href="#nav-organization" role="tab" aria-controls="nav-organization" aria-selected="false">Organization</a>
            </div>
         </nav>
         <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-email-template-type" role="tabpanel" aria-labelledby="nav-email-template-type-tab">
               <div class="row">
                  <div class="col-md-12">
                     <h4 class="input-title">Add New Email Template Type</p>
                  </div>
                  
                  <div class="form-group col-md-6">
                     <input name="template_type" id="template_type" class="form-control" placeholder="Enter Email Template Type Name" />
                  </div>
                  <div class="form-group col-md-2">
                     <button type="button" name="btn_add_emailTemplateType" id="btn_add_emailTemplateType" class="btn btn-xs btn-success"><i class="fas fa-plus"></i></button>
                     <button type="button" name="btn_save_emailTemplateType" id="btn_save_emailTemplateType" class="btn btn-xs btn-success hidden"><i class="fas fa-save"></i></button>
                     <button type="button" name="btn_cancel_emailTemplateType" id="btn_cancel_emailTemplateType" class="btn btn-xs btn-danger hidden"><i class="fas fa-times-circle"></i></button>
                  </div>
               </div>
               <table class="table table-striped table-bordered">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Email Template Type</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody id="email_template_type_table">
                  </tbody>
               </table>
            </div>
            <div class="tab-pane fade" id="nav-campaign-type" role="tabpanel" aria-labelledby="nav-campaign-type-tab">
               <div class="row">
                  <div class="col-md-12">
                     <h4 class="input-title">Add New Email Campaign Type</p>
                  </div>
                  <div class="form-group col-md-4">
                     <select class="form-control org_select" id="org_list">
                        <option value="">Select Organization</option>
                        <?php foreach($org_lists as $org_list):?>
                        <option value="<?=$org_list['org_id']?>"><?=$org_list['org_name']?></option>
                        <?php endforeach; ?>
                     </select>
                  </div>
                  <div class="form-group col-md-6">
                     <input name="campaign_type" id="campaign_type" class="form-control" placeholder="Enter Email Campaign Type Name" />
                  </div>
                  <div class="form-group col-md-2">
                     <button type="button" name="btn_add_campaignType" id="btn_add_campaignType" class="btn btn-xs btn-success"><i class="fas fa-plus"></i></button>
                     <button type="button" name="btn_save_campaignType" id="btn_save_campaignType" class="btn btn-xs btn-success hidden"><i class="fas fa-save"></i></button>
                     <button type="button" name="btn_cancel_campaignType" id="btn_cancel_campaignType" class="btn btn-xs btn-danger hidden"><i class="fas fa-times-circle"></i></button>
                  </div>
               </div>
               <table class="table table-striped table-bordered">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Organization</th>
                        <th>Campaign Type</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody id="campaign_type_table">
                  </tbody>
               </table>
            </div>
            <div class="tab-pane fade" id="nav-mobile-carrier" role="tabpanel" aria-labelledby="nav-mobile-carrier-tab">
               <div class="row">
                  <div class="col-md-12">
                     <h4 class="input-title">Add New Mobile Carrier</h4>
                  </div>
                  <div class="form-group col-md-4">
                     <input name="mobile_carrier" id="mobile_carrier" class="form-control" placeholder="Enter Mobile Carrier" />
                  </div>
                  <div class="form-group col-md-6">
                     <select class="form-control country_select" id="country_list">
                        <option value="">Select Country</option>
                        <?php foreach($country_lists as $country_list):?>
                        <option value="<?=$country_list['country_name']?>"><?=$country_list['country_name']?></option>
                        <?php endforeach; ?>
                     </select>
                  </div>
                  <div class="form-group col-md-2">
                     <button type="button" name="btn_add_mobileCarrier" id="btn_add_mobileCarrier" class="btn btn-xs btn-success"><i class="fas fa-plus"></i></button>
                     <button type="button" name="btn_save_mobileCarrier" id="btn_save_mobileCarrier" class="btn btn-xs btn-success hidden"><i class="fas fa-save"></i></button>
                     <button type="button" name="btn_cancel_mobileCarrier" id="btn_cancel_mobileCarrier" class="btn btn-xs btn-danger hidden"><i class="fas fa-times-circle"></i></button>
                  </div>
               </div>
               <table class="table table-striped table-bordered">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Carrier Name</th>
                        <th>Country</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody id="mobile_carrier_table">
                  </tbody>
               </table>
            </div>
            <div class="tab-pane fade" id="nav-country" role="tabpanel" aria-labelledby="nav-country-tab">
               <div class="row">
                  <div class="col-md-12">
                     <h4 class="input-title">Add Country</h4>
                  </div>
                  <div class="form-group col-md-4">
                     <input name="country_name" id="country_name" class="form-control" placeholder="Enter Country Name" />
                  </div>
                  <div class="form-group col-md-4">
                     <input name="country_code" id="country_code" class="form-control" placeholder="Enter Country Code" />
                  </div>
                  <div class="form-group col-md-2">
                     <button type="button" name="btn_add_country" id="btn_add_country" class="btn btn-xs btn-success"><i class="fas fa-plus"></i></button>
                     <button type="button" name="btn_save_country" id="btn_save_country" class="btn btn-xs btn-success hidden"><i class="fas fa-save"></i></button>
                     <button type="button" name="btn_cancel_country" id="btn_cancel_country" class="btn btn-xs btn-danger hidden"><i class="fas fa-times-circle"></i></button>
                  </div>
               </div>
               <table class="table table-striped table-bordered">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Country</th>
                        <th>Country Code</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody id="country_table">
                  </tbody>
               </table>
            </div>
            <div class="tab-pane fade" id="nav-city" role="tabpanel" aria-labelledby="nav-city-tab">
               <div class="row">
                  <div class="col-md-12">
                     <h4 class="input-title">Add City</h4>
                  </div>
                  <div class="form-group col-md-3">
                     <input name="city_name" id="city_name" class="form-control" placeholder="Enter City Name" />
                  </div>
                  <div class="form-group col-md-3">
                     <select class="form-control country_select" id="city_country">
                        <option value="">Select Country</option>
                        <?php foreach($country_lists as $country_list):?>
                        <option value="<?=$country_list['country_name']?>"><?=$country_list['country_name']?></option>
                        <?php endforeach; ?>
                     </select>
                  </div>
                  <div class="form-group col-md-3">
                     <input name="area_code" id="area_code" class="form-control" placeholder="Enter Area Code" />
                  </div>
                  <div class="form-group col-md-3">
                     <button type="button" name="btn_add_city" id="btn_add_city" class="btn btn-xs btn-success"><i class="fas fa-plus"></i></button>
                     <button type="button" name="btn_save_city" id="btn_save_city" class="btn btn-xs btn-success hidden"><i class="fas fa-save"></i></button>
                     <button type="button" name="btn_cancel_city" id="btn_cancel_city" class="btn btn-xs btn-danger hidden"><i class="fas fa-times-circle"></i></button>
                  </div>
               </div>
               <table class="table table-striped table-bordered">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>City Name</th>
                        <th>Country</th>
                        <th>Area Code</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody id="city_table">
                  </tbody>
               </table>
            </div>
            <div class="tab-pane fade" id="nav-organization" role="tabpanel" aria-labelledby="nav-organization-tab">
               <div class="row">
                  <div class="col-md-12">
                     <h4 class="input-title">Add Organization</h4>
                  </div>
                  <div class="form-group col-md-6">
                     <input name="organization" id="organization" class="form-control" placeholder="Enter Organization Name" />
                  </div>
                  
                  <div class="form-group col-md-3">
                     <button type="button" name="btn_add_org" id="btn_add_org" class="btn btn-xs btn-success"><i class="fas fa-plus"></i></button>
                     <button type="button" name="btn_save_org" id="btn_save_org" class="btn btn-xs btn-success hidden"><i class="fas fa-save"></i></button>
                     <button type="button" name="btn_cancel_org" id="btn_cancel_org" class="btn btn-xs btn-danger hidden"><i class="fas fa-times-circle"></i></button>
                  </div>
               </div>
               <table class="table table-striped table-bordered">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Organization Name</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody id="organization_table">
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<div id="modalConfirmDelete" class="modal-strip modal-top background-danger">
	<div class="container">
		<div class="text-center">Please confirm deletion. <br>
			<button class="m-l-10 btn btn-light" id="confirmDelete">Confirm</button>
		</div>
	</div>
</div>
