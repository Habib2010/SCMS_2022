<?php echo $this->Form->create('Photo',array('type' => 'file'));?>
<fieldset>
	<div class="tabs">		
		
		<div id="role-main">
		<?php
			echo $this->Form->input('album_id');
			echo $this->Form->input('url');
			echo $this->Form->input('title');
			echo $this->Form->input('target', array('options' => array('_new','_blank'))); 
		?>
		<input type="file" name="large"/>
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