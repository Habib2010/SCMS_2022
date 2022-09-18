<?php $this->extend('/Common/admin_edit'); ?>
<?php echo $this->Form->create('Syllabus');?>
<fieldset>
	<div class="tabs">		

		<div id="role-main">
		<?php
			echo $this->Form->input('title');
			echo $this->Form->input('course_id');
			echo $this->Form->input('description', array('class' => 'content'));
		?>
		</div>
		<?php echo $this->Layout->adminTabs(); ?>
	</div>
</fieldset>

<div class="buttons">
<?php
	echo $this->Form->end(__('Save'));
	echo $this->Html->link(__('Cancel'), array(
		'action' => 'index',
	), array(
		'class' => 'cancel',
	));
?>
</div>