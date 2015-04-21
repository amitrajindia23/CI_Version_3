<!DOCTYPE html>
<html>
<head>
	<title>MyDemoSite <?php echo $this->layouts->getTitle(); ?></title>
	<?php echo $this->layouts->print_includes(); ?>
</head>
<body>
	<?php echo $content_for_layout; ?>
</body>
</html>