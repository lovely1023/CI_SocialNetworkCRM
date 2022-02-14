<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card card-register">
			<div class="card-header">
				<h3>Register</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="far fa-dizzy"></i></span>
				</div>
			</div>
			<div class="card-body">
				<form class="" action="<?=base_url().'/account/register'?>" method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="First Name" name="firstname" id="firstname" value="<?= set_value('firstname'); ?>">
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="far fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Last Name" name="lastname" id="lastname" value="<?= set_value('lastname'); ?>">
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="far fa-envelope"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Email Address" name="email" id="email" value="<?= set_value('email'); ?>">
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="Password" name="password" id="password" value="<?= set_value('password'); ?>">
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="Confirm Password" name="password_confirm" id="password_confirm" value="<?= set_value('password'); ?>">
					</div>
					<div class="form-group">
						<input type="submit" value="Register" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Go back to <a href="<?=base_url()?>">login</a>.
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