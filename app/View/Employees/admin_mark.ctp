<?php echo $this->Form->create('Employee'); ?>
<fieldset>
	<?php 
	echo $this->Form->input('id');
	echo $this->Form->input('end_date');
	?>
</fieldset>

<div class="buttons">
<?php
	echo $this->Form->end(__('Save'));
	echo $this->Html->link(__('Cancel'), 
	                         array('action' => 'index',), 
	                         array('class' => 'cancel',)
	                       );
?>
</div>