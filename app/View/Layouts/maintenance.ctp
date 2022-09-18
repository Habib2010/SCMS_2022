<!DOCTYPE HTML>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title_for_layout; ?></title>
	<style>
		p { text-align:center; font:bold 1.1em sans-serif; }
		a { color:#444; text-decoration:none; }
		a:hover { text-decoration: underline; color:#44E; }
	</style>
</head>
<body>
	<p><?php echo __('Site down for maintenance.'); ?></p>
</body>
</html>
<?php Configure::write('debug', 0); ?>