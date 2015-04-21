<!-- container start -->
<div class="container">	
	<form class="form-signin" id="signin-form" name="signin-form" method="POST" action="<?php echo site_url('account/postSignin');?>">
		<h2 class="form-signin-heading">Sign-In</h2><hr>
		<div class="form-group">
			<input type="email" class="form-control" name="email" id="email" value="<?php echo set_value("email"); ?>" placeholder="Enter your email">
			<span id="email-error" class="signup-signin-error"></span>
		</div>
		<div class="form-group">
			<input type="password" class="form-control"  name="password" id="password" placeholder="Enter your password">
			<span id="password-error" class="signup-signin-error"></span>
		</div>
		<div class="form-group">
			<input type="checkbox" name="rememberMe" id="rememberMe">Remember Me
		</div>
		<div class="form-group">
			<input type="submit" name="btnSignin" id="btnSignin" value="Sign-In" class="btn btn-success" onclick="return signinFromValidation();">
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
<!-- container end -->
