<div class="container">
	<div class="row">
		<div class="col-sm-4" id="editProfile">
			<form class="form-edit-profile" id="edit-profile-form" name="edit-profile-form" method="POST" action="<?php echo site_url('account/updateProfile');?>">
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
				<div class="form-group" id="user-exist-error" style="display:none;">
					<div class="alert alert-danger">
				    	<a class="close" data-dismiss="alert">×</a>
				    	Email already Exist.
				 	</div>         
				</div>
				<h2 class="form-edit-profile">Edit Profile</h2><hr>
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control" name="name" id="name" value="<?php echo $this->layouts->getUserData()->name; ?>">
					<span id="name-error" class="signup-signin-error"></span>
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" readonly class="form-control" name="email" id="email" value="<?php echo $this->layouts->getUserData()->email; ?>">
					<span id="email-error" class="signup-signin-error"></span>
				</div>
				<div class="form-group">
					<label for="dob">Date of Birth</label>
					<input type="text" class="form-control" name="dob" id="dob" value="<?php echo $this->layouts->getUserData()->dob; ?>" >
					<span id="dob-error" class="signup-signin-error"></span>
				</div>
				<div class="form-group">
					<label for="dob">Gender</label><br>
					<input type="radio" checked name="gender" id="gender" value="male">Male
					<input type="radio" name="gender" id="gender" value="female">Female			
				</div>
				<div class="form-group">
					<input type="submit" name="btnEditProfile" id="btnEditProfile" value="Update" class="btn btn-success" onclick="return editProfileFromValidation();">
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