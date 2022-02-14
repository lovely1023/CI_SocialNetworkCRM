<div class="container">
	<div class="card card-register">
		<div class="card-header">
			<div class="col-md-12">
				<h3>User Profile</h3>
			</div>
		</div>
		<div class="card-body">
			<form class="" role="form" action="<?=base_url().'/admin_dashboard/add_user'?>" method="post" enctype="multipart/form-data">
				<div class="row">
					<!-- First Name -->
					<div class="col-md-4 input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name" value="<?= set_value('first_name'); ?>">
					</div>
					<!-- Middle Name -->
					<div class="col-md-4 input-group form-group">
						<input type="text" class="form-control" placeholder="Middle Name" name="mid_name" id="mid_name" value="<?= set_value('mid_name'); ?>">
					</div>
					<!-- Last Name -->
					<div class="col-md-4 input-group form-group">
						<input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name" value="<?= set_value('last_name'); ?>">
					</div>
				</div>
				<div class="row">
					<!-- Birthdate -->
					<div class="col-md-6 input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="date" class="form-control" placeholder="Birth Date" name="birth_date" id="birth_date" value="<?= set_value('birth_date'); ?>">
					</div>
					<!-- Gender -->
					<div class="col-md-6 input-group form-group">
						<div class="form-check-inline">
							<label>Gender: </label>
						</div>
						<div class="form-check-inline">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" value="male" name="gender">Male
							</label>
						</div>
						<div class="form-check-inline">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" value="female" name="gender">Female
							</label>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- Phone Number -->
					<div class="col-md-6 input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-phone"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Phone Number" name="phone_number" id="phone_number" value="<?= set_value('phone_number'); ?>">
					</div>
					<!-- Mobile Number -->
					<div class="col-md-6 input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-mobile"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Mobile Number" name="mobile_number" id="mobile_number" value="<?= set_value('mobile_number'); ?>">
					</div>
					<!-- Email Address -->
					<div class="col-md-12 input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="far fa-envelope"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Email Address" name="email_address" id="email_address" value="<?= set_value('email_address'); ?>">
					</div>
				</div>
				<div class="row">
					<!-- Home Address -->
					<div class="col-md-12 input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="far fa-home"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Home Address" name="home_address" id="home_address" value="<?= set_value('home_address'); ?>">
					</div>
					<!-- City -->
					<div class="col-md-3 input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="far fa-home"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="City" name="city" id="city" value="<?= set_value('city'); ?>">
					</div>
					<!-- State -->
					<div class="col-md-3 input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="far fa-home"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="State" name="state" id="state" value="<?= set_value('state'); ?>">
					</div>
					<!-- Country -->
					<div class="col-md-3 input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="far fa-flag"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Country" name="country" id="country" value="<?= set_value('country'); ?>">
					</div>
					<!-- Zip Code -->
					<div class="col-md-3 input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="far fa-home"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Zip Code" name="zip_code" id="zip_code" value="<?= set_value('zip_code'); ?>">
					</div>
				</div>
				<!-- Access Rights -->
				<div class="row">
					<div class="col-md-3 input-group form-group">
						<select name="access_right" class="form-control">
							<option>Set Access Right</option>
							<?php foreach($access_rights as $access): ?>
							<option value="<?=$access['id']?>"><?=$access['label']?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-3 input-group form-group">
						<input class="form-check-input" type="checkbox" name="alert" value="1" id="alert">
						<label class="form-check-label" for="alert">
							Alert if there are new leads
						</label>
					</div>
					<div class="col-md-3 input-group form-group">
						<label for="photo">Upload Photo</label>
    					<input type="file" class="form-control-file" name="upload_photo" id="photo">
					</div>
				</div>
				<!-- Login details -->
				<div class="row">
					<div class="col-md-3 input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="far fa-envelope"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Username" name="user_name" id="user_name" value="<?= set_value('user_name'); ?>">
					</div>
					<div class="col-md-3 input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="Password" name="password" id="password" value="<?= set_value('password'); ?>">
					</div>
					<div class="col-md-3 input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="Confirm Password" name="password_confirm" id="password_confirm" value="<?= set_value('password'); ?>">
					</div>
				</div>
				<!-- Submit/Save -->
				<div class="form-group">
					<input type="submit" value="Register" class="btn float-right login_btn">
				</div>
			</form>
		</div>
		<div class="card-footer">
			<!-- <div class="col-md-12">
				<div class="d-flex justify-content-center links">
					Go back to &nbsp;<a href="<?=base_url()?>">Login</a>.
				</div>
			</div> -->
			<div class="col-md-12">
				<div class="d-flex justify-content-center links">
					Go back to &nbsp;<a href="<?=base_url().'/admin_dashboard'?>">Dashboard</a>.
				</div>
			</div>
			<div>
				<?php if(isset($validation)): ?>
					<div class="alert alert-danger" role="alert">
						<?= $validation->listErrors() ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>