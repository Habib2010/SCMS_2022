<div class="users form">
	<h2 style="font-size:25px;"><?php echo __('Login'); ?></h2>
	<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login')));?>
		<fieldset>
		<?php
			echo $this->Form->input('username');
			echo $this->Form->input('password');
		?>
		</fieldset>
	<?php echo $this->Form->end('Submit');?>
</div>
<?php echo $this->Html->link(__('Forgot Password', true), array('controller' => 'users', 'action' => 'forgot')); ?>