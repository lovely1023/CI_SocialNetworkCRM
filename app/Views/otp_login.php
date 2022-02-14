<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Login</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-expeditedssl"></i></span>
				</div>
			</div>
			<div class="card-body">
			
				<?php if(session()->get('success')): ?>
					<?= session()->get('success'); ?>
				<?php endif; ?>
				
				<?php if(isset($validation)): ?>
					<div class="alert alert-danger" role="alert">
						<?= $validation->listErrors() ?>
					</div>
				<?php endif; ?>
				<form class="" action="/CRMplatform/public/account/otp" method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" name="otp" id="otp" placeholder="OTP" >
					</div>
					<div class="form-group">
						<input type="submit" value="Login" class="btn float-right btn-submit-login">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Please check the message on your mobile phone for the OTP number. Temp OTP: <?php echo session()->get('otp'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
