<?php $this->extend('/Common/admin_edit'); ?>
<?php echo $this->Form->create('CalendarEvent');?>
<fieldset>
	<div class="tabs">
		
		<div id="role-main">
		<?php
			echo $this->Form->input('title');
			echo $this->Form->input('description');
			echo $this->Form->input('start_date');
			echo $this->Form->input('end_date');
			echo 'Status'; echo $this->Form->checkbox('status' , array('value' => 1)); 
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