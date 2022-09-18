<?php
	$formUrl = array(
		'class' => 'fxHdrForm1',
		'controller' => 'comments',
		'action' => 'add_comment',						
	);
?>
<?php echo $this->Form->create('Comment', array('url' => $formUrl)); ?>	
<div class="fleft user_comment">
	<?php
       	echo $this->Form->input('name',array('label' => false, 'type' => 'text', 'value' => 'নাম :', 'class' => 'txtBox2','div' => false));							
		echo $this->Form->input('email',array('label' => false, 'type' => 'text', 'value' => 'ইমেল :', 'class' => 'txtBox2','div' => false));					
		echo $this->Form->input('phone',array('label' => false, 'type' => 'text', 'value' => 'ফোন :','class' => 'txtBox2','div' => false));										
	?>
</div>
			
<div class="fleft commnet_textarea">
	<?php
		echo $this->Form->input('body',array('label' => false, 'type' => 'textarea', 'value' => 'মন্তব্য :', 'class' => 'txtBox2', 'div' => false, 'escape' => false));
		$options = array('class' => 'subBtn2 submit_comment', 'div' => false);
		echo $this->Form->submit('পাঠান',$options);
	?>
</div>
<?php echo $this->Form->end(); ?>
