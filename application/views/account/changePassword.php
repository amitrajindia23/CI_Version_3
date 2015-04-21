<div class="container">
	<div class="row">
		<div class="col-sm-4" id="changePassword">
			<form class="form-change-password" id="change-password-form" name="change-password-form" method="POST" action="<?php echo site_url('account/updatePassword');?>">
				<input type="hidden" name="siteUrl" id="siteUrl" value="<?php echo site_url(); ?>">
				<?php 
					if($this->layouts->getMessage()){
				?>
					<div class="form-group">
						<div class="alert alert-success">
					    	<a class="close" data-dismiss="alert">×</a>
					    	<?php echo $this->layouts->getMessage(); ?>
					 	</div>         
					</div>
				<?php
					}
				?>
				<h2 class="form-change-password">Change Password</h2><hr>
				<div class="form-group">
					<label for="old-password">Old Password</label>	
					<input type="password" class="form-control" name="oldPassword" id="oldPassword" placeholder="Enter old password">
					<span id="oldPassword-error" class="signup-signin-error"></span>
				</div>
				<div class="form-group">
					<label for="newPassword">New Password</label>
					<input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="Enter new password">
					<span id="newPassword-error" class="signup-signin-error"></span>
				</div>
				<div class="form-group">
					<label for="renewPassword">Re-enter New Password</label>		
					<input type="password" class="form-control" name="renewPassword" id="renewPassword" placeholder="Re-enter new password">			
					<span id="renewPassword-error" class="signup-signin-error"></span>
				</div>
				<div class="form-group">
					<input type="submit" name="btnchangePassword" id="btnchangePassword" value="Update" class="btn btn-success" onclick="return changePasswordFromValidation();">
				</div>
				<?php 
					if($this->layouts->getError()){
				?>
					<div class="form-group">
						<div class="alert alert-error">
					    	<a class="close" data-dismiss="alert">×</a>
					    	<?php echo $this->layouts->getError(); ?>
					 	</div>         
					</div>
				<?php
					}
				?>
			</form>
		</div>
		<div class="col-sm-8">
			
		</div>		
	
	</div>	
</div>	