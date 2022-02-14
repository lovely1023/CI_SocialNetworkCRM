<div class="content col-lg-7 col-xs-12">
   <div class="row">
      <div class="col-lg-12 col-xs-12">
			<h4>User Profile List</h4>
         <table class="table" dashboard-type="<?=$dashboard_type?>">
				<thead class="thead-dark">
					<tr>
						<th scope="col"></th>
						<th scope="col">Name</th>
						<th scope="col">Rights</th>
						<th scope="col">Mobile No.</th>
						<th scope="col">Email</th>
						<th scope="col">Status</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody id="userData">
					<?php $i = 1;
					foreach($userList as $users): ?>
					<tr>
						<td><?=$i++?></td>
						<td><?=$users['first_name']?></td>
						<td><?=$users['access_name']?></td>
						<td><?=$users['mobile_number']?></td>
						<td><?=$users['email_address']?></td>
						<td><?=($users['status'] == 1) ? 'Active' : 'Inactive'?></td>
						<td>
							<a href="#userProfileForm" type="button" class=" btn-modal btn-update-profile" data-lightbox="inline" data-loggedUser="<?=$user['id']?>" data-userId="<?=$users['user_id']?>" id="updateUser"><i class='fas fa-user-edit'></i></a>
							<a href="#modalDeleteUser" type="button" class=" btn-modal text-danger btn-delete-profile" data-lightbox="inline" id="deleteUser" data-loggedUser="<?=$user['id']?>" data-userId="<?=$users['user_id']?>" onclick="append_data(<?=$user['id'].','.$users['user_id']?>)"><i class='fas fa-user-minus'></i></a>
						</td>
					</tr>
					<?php endforeach; ?>
            </tbody>
      	</table>
      </div>  
   </div>
</div>

<div class="sidebar col-lg-3">
    <div class="col-lg-12 col-xs-12">
        <br>
        <a href="#newProfile" id="createProfile" data-lightbox="inline" type="button" class="btn btn-icon-holder btn-shadow btn-outline btn-rounded btn-modal">Create New Profile <i class="far fa-user"></i></a>
        <br>
        <br>
    </div>
    <div class="widget widget-mycart p-cb">
        <h4>Total Users</h4>
        <div class="cart-item">
            <div class="cart-image"> <a href="#"><img src="<?php echo base_url()."/images/admin.png"; ?>"></a></div>
            <div class="cart-product-meta">
            <a href="#">Promoters </a>
            <span>90 </span>
            </div>
        </div>
        <div class="cart-item">
            <div class="cart-image"> <a href="#"><img src="<?php echo base_url()."/images/admin.png"; ?>"></a></div>
            <div class="cart-product-meta">
            <a href="#">Customers <i class="fas fa-voicemail"></i></a>
            <span>10 </span>
            </div>
        </div>
        <div class="cart-item">
            <div class="cart-image"> <a href="#"><img src="<?php echo base_url()."/images/admin.png"; ?>"></a></div>
            <div class="cart-product-meta">
            <a href="#">Leads <i class="fas fa-voicemail"></i></a>
            <span>9 </span>
            </div>
        </div>
        <br>
        <br>
    </div>
</div>

<div id="userProfileForm" class="modal no-padding fade" data-delay="2000" style="max-width: 700px;" role="dialog">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<span class="h4 modal-title">Create User Profile</span>
				</div>
				<div class="card-body">
					<form id="userForm" method="post" class="form-validate" novalidate="novalidate" enctype="multipart/form-data">
					<div class="h5 mb-4">Contact Profile</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="first_name">Firstname</label>
								<input type="text" class="form-control" name="first_name" placeholder="Enter First Name" required="">
							</div>
							<div class="form-group col-md-4">
								<label for="mid_name">Middlename</label>
								<input type="text" class="form-control" name="mid_name" placeholder="Enter Middle Name" required="">
							</div>
							<div class="form-group col-md-4">
								<label for="last_name">Lastname</label>
								<input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" required="">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="birth_date">Birth Date</label>
								<input type="date" class="form-control" name="birth_date" />
							</div>
							<!-- Gender -->
							<div class="col-md-4 form-group">
								<div class="form-check-inline">
									<label>Gender: </label>
								</div>
								<div class="form-group text-center">
									<div class="form-check-inline">
										<label class="form-check-label">
											<input type="radio" class="form-check-input form-control" value="male" name="gender">Male
										</label>
									</div>
									<div class="form-check-inline">
										<label class="form-check-label">
											<input type="radio" class="form-check-input form-control" value="female" name="gender">Female
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="phone_number">Phone No</label>
								<input type="text" class="form-control" name="phone_number" placeholder="Enter your phone number" required="">
							</div>
							<div class="form-group col-md-6">
								<label for="mobile_number">Mobile No</label>
								<input type="text" class="form-control" name="mobile_number" placeholder="Enter your mobile number" required="">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="email_address">Email</label>
								<input type="email" class="form-control" name="email_address" placeholder="Enter your email" required="">
							</div>
							<div class="form-group col-md-6">
								<label for="access_right">Access Right</label>
								<select name="access_right" class="form-control" id="access_right" class="form-control">
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-6">
								<input type="checkbox" name="alert" class="form-control" value="1" id="addAlert">
								<label class="form-check-label" for="addAlert">
									Alert if there are new leads
								</label>
							</div>
							<div class="form-group col-md-6">
								<label for="upload_photo">Upload Photo</label>
								<input type="file" class="form-control-file form-control" name="upload_photo" id="upload_photo">
							</div>
						</div>
						<div class="h5 mb-4">Contact Address</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="home_address">Address</label>
								<input type="text" class="form-control" name="home_address" placeholder="Enter your Home Address" required="">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="city">City</label>
								<input type="text" class="form-control" name="city" placeholder="Enter your City" required="">
							</div>
							<div class="form-group col-md-6">
								<label>Zip Code:</label>
								<input type="number" class="form-control" name="zip_code" placeholder="Enter Zip Code" required="">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="state">State</label>
								<input type="text" class="form-control" name="state" placeholder="Enter your State" required="">
							</div>
							<div class="form-group col-md-6">
								<label for="country">Country</label>
								<select name="country" id="addCountry" class="form-control" required="">	
								</select>
							</div>
						</div>
						<!-- Login details -->
						<div class="row">
							<div class="col-md-4 input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="far fa-envelope"></i></span>
								</div>
								<input type="text" class="form-control" placeholder="Username" name="user_name" id="user_name" value="">
							</div>
							<div class="col-md-4 input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-key"></i></span>
								</div>
								<input type="password" class="form-control" placeholder="Password" name="password" id="password" value="">
							</div>
							<div class="col-md-4 input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
								</div>
								<input type="password" class="form-control" placeholder="Confirm Password" name="password_confirm" id="password_confirm" value="">
							</div>
						</div>
						<button type="submit" id="userSave" data-method="insert" class="btn m-t-30 mt-3 submitBtn">Submit</button>
					</form>	
				</div>
			</div>
		</div>
	</div>
</div>

<div id="modalDeleteUser" class="modal-strip modal-top background-danger">
	<div class="container">
		<div class="text-center">Please confirm deletion. <br>
			<input type="hidden" name="logged_user" class="form-control" value="" />
			<input type="hidden" name="user_id" class="form-control" value="" />
			<button class="m-l-10 btn btn-light" id="confirmDelete">Confirm</button>
		</div>
	</div>
</div>
