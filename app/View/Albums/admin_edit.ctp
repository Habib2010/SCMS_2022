<?php $this->extend('/Common/admin_edit'); ?>
<?php echo $this->Form->create('Album');?>
<fieldset>
    <?php
	echo $this->Form->input('id');
    echo $this->Form->input('title',array('label' => __('Title', true)));
    echo $this->Form->input('slug');
	echo $this->Form->input('location', array('type' => 'select','options' => $location,'selected' => 'home'));
	echo $this->Form->input('description',array('label' => __('Description', true)));
	echo $this->Form->input('type',array('label' => __('Type', true)));
	echo $this->Form->input('params',array('label' => __('Parameters', true)));
	echo $this->Form->input('status');
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