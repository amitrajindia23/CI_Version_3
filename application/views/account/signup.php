<div class="container">	
	<form class="form-signup" id="signup-form" name="signup-form" method="POST" action="<?php echo site_url('account/postSignup');?>">
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
		<h2 class="form-signup-heading">Sign-Up</h2><hr>
		<div class="form-group">
			<input type="text" class="form-control" name="name" id="name" value="<?php echo set_value("name"); ?>" placeholder="Enter your name">
			<span id="name-error" class="signup-signin-error"></span>
		</div>
		<div class="form-group">
			<input type="email" class="form-control signup-email" name="email" id="email" value="<?php echo set_value("email"); ?>" placeholder="Enter your email">
			<span id="email-error" class="signup-signin-error"></span>
		</div>
		<div class="form-group">
			<input type="password" class="form-control"  name="password" id="password" placeholder="Enter your password">
			<span id="password-error" class="signup-signin-error"></span>
		</div>
		<div class="form-group">
			<input type="password" class="form-control"  name="repassword" id="repassword" placeholder="Re-enter your password">
			<span id="repassword-error" class="signup-signin-error"></span>
			<span id="password-notmatched-error" class="signup-signin-error"></span>
		</div>
		<div class="form-group">
			<input type="text" class="form-control" name="dob" id="dob" value="<?php echo set_value("dob"); ?>" placeholder="Enter your Date of Birth">
			<span id="dob-error" class="signup-signin-error"></span>
		</div>
		<div class="form-group">
			<input type="radio" checked name="gender" id="gender" value="male">Male
			<input type="radio" name="gender" id="gender" value="female">Female			
		</div>
		<!-- <div class="form-group">
			<input type="checkbox" name="rememberMe" id="rememberMe">Remember Me
		</div> -->
		<div class="form-group">
			<input type="submit" name="btnSignup" id="btnSignup" value="Sign-Up" class="btn btn-success" onclick="return signupFromValidation();">
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