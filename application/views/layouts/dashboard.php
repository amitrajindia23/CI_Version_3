<!DOCTYPE html>
<html>
<head>
	<title>MyDemoSite <?php echo $this->layouts->getTitle(); ?></title>
	<?php echo $this->layouts->print_includes(); ?>
</head>
<body>
	<div class="container" id="header-container">
		<?php 
			$userData = $this->layouts->getUserData();
		?>
		<div class="row">
			<div class="col-sm-8">
				<h4><span class="userName">Welcome <strong><?php echo $userData->name;?></strong></span></h4>
			</div>
			<div class="col-sm-4" id="layoutbtn" align="right">
				<a class="btn btn-primary btn-sm" href="<?php echo site_url('account/editProfile');?>">Edit Profile</a>
				<a class="btn btn-primary btn-sm" href="<?php echo site_url('account/changePassword');?>">Change Password</a>
				<a class="btn btn-primary btn-sm" href="<?php echo site_url('account/signout');?>">Sign-Out</a>
			</div>
		</div>
		<hr>
	</div>
	<?php echo $content_for_layout; ?>
</body>
</html>