<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php echo $title_for_layout; ?></title>
	
	<?php
		echo $this->Html->css(array(
			//default
			//'reset',
			//student layout
			'/students_tmp_design/css/style',
			'/css/result', //common for both front & back;
			'/students_tmp_design/fonts/ROCKB/fonts',
			'/students_tmp_design/fonts/myriadProlight/stylesheet',
		));
		
		echo $this->Layout->js();
		echo $this->Html->script(array(
			//student layout
			'/students_tmp_design/js/jquery-1.8.2.min',
			'/students_tmp_design/js/js.js',
			'admin',
			
		)); 
		
		
		
		echo $this->Blocks->get('css');
		echo $this->Blocks->get('script');
		
	?>
</head>
<body class="scms-result-print">
	<?php //echo $this->element('admin/header'); ?>
	<?php
        echo $this->Layout->sessionFlash();
        echo $content_for_layout;
    ?>

	<?php //echo $this->element('admin/footer'); ?>
	<?php
		echo $this->Blocks->get('scriptBottom');
		echo $this->Js->writeBuffer();
	?>
</body><!-- end of fromwrapper-->
</html>
