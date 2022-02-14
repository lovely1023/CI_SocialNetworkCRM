<div class="content col-lg-7 col-xs-12">
	<div class="row">
		<div class="col-lg-12 col-xs-12">
			<h2>My funnel lists <a href="#updateFunnel" data-lightbox="inline" type="button" class="btn btn-icon-holder btn-shadow btn-outline btn-rounded btn-modal">Update primary <i class="fas fa-at"></i></a></h2>
			<small class="text-primary">Primary Website</small>
			<div class="row team-members team-members-left team-members-shadow m-b-20">
				<div class="col-lg-12">
					<div class="team-member">
						<div class="team-image" style="overflow">
							<img class="link-featured" src="<?php echo base_url()."/images/26.jpg"; ?>">
						</div>
						<div class="team-desc">
							<h3>Website Title</h3>
							<span>Description of the website</span>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing tristique hendrerit laoreet. </p>
							<div class="align-center">
								<a class="btn btn-xs btn-slide btn-light" href="#">
									<i class="fab fa-facebook-f"></i>
									<span>Facebook</span>
								</a>
								<a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
									<i class="fab fa-twitter"></i>
									<span>Twitter</span>
								</a>
								<a class="btn btn-xs btn-slide btn-light" href="#" data-width="118">
									<i class="fab fa-instagram"></i>
									<span>Instagram</span>
								</a>
								<a class="btn btn-xs btn-slide btn-light active" href="mailto:#" data-width="80">
									<i class="fa fa-star"></i>
									<span>Link</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<small>Active Website</small>
			<div class="row team-members team-members-left team-members-shadow m-b-20">
				<div class="col-lg-12">
					<div class="team-member">
						<div class="team-image" style="overflow">
							<img class="link-featured" src="<?php echo base_url()."/images/26.jpg"; ?>">
						</div>
						<div class="team-desc">
							<h3>Website Title</h3>
							<span>Description of the website</span>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing tristique hendrerit laoreet. </p>
							<div class="align-center">
								<a class="btn btn-xs btn-slide btn-light" href="#">
									<i class="fab fa-facebook-f"></i>
									<span>Facebook</span>
								</a>
								<a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
									<i class="fab fa-twitter"></i>
									<span>Twitter</span>
								</a>
								<a class="btn btn-xs btn-slide btn-light" href="#" data-width="118">
									<i class="fab fa-instagram"></i>
									<span>Instagram</span>
								</a>
								<a class="btn btn-xs btn-slide btn-light active" href="mailto:#" data-width="80">
									<i class="fa fa-star"></i>
									<span>Link</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-lg-12 col-xs-12">
			<h2>Trainings</h2>
			<small>Guide 1</small>
			<iframe src="https://www.youtube.com/embed/cNwEVYkx2Kk" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>
	</div>
</div>

<div class="sidebar col-lg-3">
	<div class="widget text-center">
		<a href="#newLeads" data-lightbox="inline" class="btn btn-modal btn-shadow btn-rounded"><i class="fa fa-plus"></i> Add Contact</a>
	</div>
	
	<div class="widget">
		<div class="tabs">
			<ul class="nav nav-tabs" id="tabs-posts" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="home-tab" data-toggle="tab" href="#popular" role="tab" aria-controls="popular" aria-selected="true">Leads</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#featured" role="tab" aria-controls="featured" aria-selected="false">Emails</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="contact-tab" data-toggle="tab" href="#recent" role="tab" aria-controls="recent" aria-selected="false">SMS</a>
				</li>
			</ul>
			
			<div class="tab-content" id="tabs-posts-content">
				<div class="tab-pane widget widget-notification fade show active" id="popular" role="tabpanel" aria-labelledby="popular-tab">
					<h4 class="mb-0">Accounts</h4>
					<p class="text-muted">active accounts</p>
					<?php if(!empty($leads)) { 
					foreach($leads as $lead): ?>
					<div class="notification-item notification-new">
						<div class="notification-image"> <a href="#"><img src="<?php echo base_url()."/images/admin.png"; ?>"/></a></div>
							<div class="notification-meta">
								<a href="#"><?=$lead['full_name']?></a>
							<span><?=ucwords($lead['customer_type'])?></span>
						</div>
					</div>
					<?php endforeach; ?>
					<a href="#" class="text-theme">View all leads</a>
					<?php } else { ?>
						<p class="text-muted"> No leads yet. </p>
					<?php } ?>
				</div>
			
				<div class="tab-pane widget widget-notification fade" id="featured" role="tabpanel" aria-labelledby="featured-tab">
					<h4 class="mb-0">Email Campaigne</h4>
					<div class="notification-item notification-new">
						<div class="notification-image"> 
							<a href="#"><img src="<?php echo base_url()."/images/admin.png"; ?>"/></a>
						</div>
						<div class="notification-meta">
							<a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit...</a>
							<small>Nov 19 2020</small>
						</div>
					</div>
					<div class="notification-item notification-new">
						<div class="notification-image"> 
							<a href="#"><img src="<?php echo base_url()."/images/admin.png"; ?>"></a>
						</div>
						<div class="notification-meta">
							<a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit...</a>
							<small>Nov 18 2020</small>
						</div>
					</div>
					<div class="notification-item">
						<div class="notification-image"> 
							<a href="#"><img src="<?php echo base_url()."/images/admin.png"; ?>"></a>
						</div>
						<div class="notification-meta">
							<a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit...</a>
							<small>Nov 17 2020</small>
						</div>
					</div>
					<a href="#" class="text-theme">View all emails</a>
				</div>
			
				<div class="tab-pane widget widget-notification fade" id="recent" role="tabpanel" aria-labelledby="recent-tab">
					<h4 class="mb-0">SMS Campaigne</h4>
					<div class="notification-item notification-new">
						<div class="notification-image"> 
							<a href="#"><img src="<?php echo base_url()."/images/admin.png"; ?>"/></a>
						</div>
						<div class="notification-meta">
							<a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit...</a>
							<small>Nov 19 2020</small>
						</div>
					</div>
					<div class="notification-item">
						<div class="notification-image"> 
							<a href="#"><img src="<?php echo base_url()."/images/admin.png"; ?>"></a>
						</div>
						<div class="notification-meta">
							<a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit...</a>
							<small>Nov 18 2020</small>
						</div>
					</div>
					<div class="notification-item">
						<div class="notification-image"> 
							<a href="#"><img src="<?php echo base_url()."/images/admin.png"; ?>"></a>
						</div>
						<div class="notification-meta">
							<a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit...</a>
							<small>Nov 17 2020</small>
						</div>
					</div>
					<a href="#" class="text-theme">View all SMS</a>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Create New Contact -->
<div id="newLeads" class="modal no-padding mfp-hide" data-delay="2000" style="max-width: 700px;">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<span class="h4">Create New Contact</span>
					<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
				</div>
				<div class="card-body">
					<form id="form1" class="form-validate" action="<?=base_url().'/admin_dashboard/add_new_lead/'.$user['client_id']?>" method="post" novalidate="novalidate">
						<div class="h5 mb-4">Contact Profile</div>
						<div class="form-row" >
							<div class="form-group col-md-6">
								<label for="full_name">Name</label>
								<input type="text" class="form-control" name="full_name" placeholder="Enter name" required="">
							</div>
							<div class="form-group col-md-6">
								<label for="customer_type">Contact Type</label>
								<select class="form-control" name="customer_type" placeholder="Select Category" required="">
									<option value="prospect">Prospect</option>
									<option value="customer">Customer</option>
									<option value="promoters">Promoters</option>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="phone_number">Telephone Number</label>
								<input class="form-control" type="tel" name="phone_number" placeholder="Enter your telephone number" required="">
							</div>
							<div class="form-group col-md-6">
								<label for="phone_number">Mobile Number</label>
								<input class="form-control" type="tel" name="phone_number" placeholder="Enter your mobile number" required="">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="email_address">Email Address</label>
								<input type="text" class="form-control" name="email_address" placeholder="Enter your email address" required="">
							</div>
							<div class="form-group col-md-6">
								<label for="birth_date">Birth Date</label>
								<input type="date" class="form-control" name="birth_date" required="" />
							</div>
						</div>
						<hr />
						<div class="h5 mb-4">Contact Address Details</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="home_address">Home Address</label>
								<input type="text" class="form-control" name="home_address" placeholder="Enter your home address" />
							</div>
							<div class="form-group col-md-4">
								<label for="city">City</label>
								<input type="text" class="form-control" name="city" placeholder="Enter your city" />
							</div>
							<div class="form-group col-md-4">
								<label for="state">State</label>
								<input type="text" class="form-control" name="state" placeholder="Enter your state" />
							</div>
							<div class="form-group col-md-4">
								<label for="country">Country</label>
								<select class="form-control" name="country" required="">
									<option value="">Select your Country</option>
									<?php foreach($countries as $country): ?>
									<option value="<?=$country['country_name']?>"><?=$country['country_name']?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group col-md-4">
								<label for="zip_code">Zip Code</label>
								<input type="text" class="form-control" name="zip_code" placeholder="Enter your zip code" />
							</div>
						</div>
						<hr />
						<div class="h5 mb-4">Other Details</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="occupation">Occupation</label>
								<input type="text" class="form-control" name="occupation" placeholder="Enter current occupation" />
							</div>
							<div class="form-group col-md-6">
								<label for="company">Company</label>
								<input type="text" class="form-control" name="company" placeholder="Enter current company" />
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="benefits_looking_for">Benefits you are looking for</label>
								<input type="text" class="form-control" name="benefits_looking_for" placeholder="Enter here the benefits you are looking for" />
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="source">Source</label>
								<input type="text" class="form-control" name="source" placeholder="Enter your source" required="">
							</div>
						</div>
						<hr />
						<div class="h5 mb-4">Security Questions</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="first_question">Question 1: What ?</label>
								<input type="hidden" class="form-control" name="first_question" value="Question 1"/>
							</div>
							<div class="form-group col-md-12">
								<input type="text" class="form-control" name="first_question_answer" placeholder="Enter your answer here" />
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="second_question">Question 2: What ?</label>
								<input type="hidden" class="form-control" name="second_question" value="Question 2"/>
							</div>
							<div class="form-group col-md-12">
								<input type="text" class="form-control" name="second_question_answer" placeholder="Enter your answer here" />
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="third_question">Question 3: What ?</label>
								<input type="hidden" class="form-control" name="third_question" value="Question 3"/>
							</div>
							<div class="form-group col-md-12">
								<input type="text" class="form-control" name="third_question_answer" placeholder="Enter your answer here" />
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="fourth_question">Question 4: What ?</label>
								<input type="hidden" class="form-control" name="fourth_question" value="Question 4"/>
							</div>
							<div class="form-group col-md-12">
								<input type="text" class="form-control" name="fourth_question_answer" placeholder="Enter your answer here" />
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="fifth_question">Question 5: What ?</label>
								<input type="hidden" class="form-control" name="fifth_question" value="Question 5"/>
							</div>
							<div class="form-group col-md-12">
								<input type="text" class="form-control" name="fifth_question_answer" placeholder="Enter your answer here" />
							</div>
						</div>

						<button type="submit" class="btn m-t-30 mt-3">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Funnel Lists -->
<div id="updateFunnel" class="modal no-padding mfp-hide" data-delay="2000" style="max-width: 700px;">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Funnel lists
				</div>
				<div class="card-body">
					<table class="table">
					<thead class="thead-dark">
					<tr>
						<th scope="col"></th>
						<th scope="col">Funnel</th>
						<th scope="col">Description</th>
						<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr class="table-active">
						<th scope="row">1</th>
						<td>website 1</td>
						<td>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</td>
						<td>
							<div class="custom-control custom-checkbox">
							<input type="checkbox" name="reminders" id="primary-website" class="custom-control-input" value="1" required="" checked="true">
							<label class="custom-control-label" for="reminders"></label>
						</div>
						</td>
						</tr>
						<tr>
						<th scope="row">2</th>
						<td>website 2</td>
						<td>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</td>
						<td>
							<div class="custom-control custom-checkbox">
							<input type="checkbox" name="reminders" id="primary-website" class="custom-control-input" value="2" required="" >
							<label class="custom-control-label" for="reminders"></label>
						</td>
						</tr>
						<tr>
						<th scope="row">3</th>
						<td>website 3</td>
						<td>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</td>
						<td>
							<div class="custom-control custom-checkbox">
							<input type="checkbox" name="reminders" id="primary-website" class="custom-control-input" value="3" required="" >
							<label class="custom-control-label" for="reminders"></label>
						</td>
						</tr>
					</tbody>
					</table>
					<br>
					<button type="button" class="btn btn-rounded btn-outline">Confirm</button>
				</div>
			</div>
		</div>
	</div>
</div>