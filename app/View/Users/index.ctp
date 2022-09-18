<div class="users index">
	<h2 style="font-size:25px; padding-bottom:10px;"><?php echo $title_for_layout; ?></h2>

	<p><?php echo __('You are currently logged in as:') . ' ' . $this->Session->read('Auth.User.username'); ?></p>
</div>

<?php if($usertype == 'e'): ?>
	<?php echo $this->Html->link(__('View Profile', true), array('controller' => 'employees', 'action' => 'view')); ?>
	<br/>
	<?php echo $this->Html->link(__('Edit Profile', true), array('controller' => 'employees', 'action' => 'edit')); ?>
<?php elseif($usertype == 's'): ?>
	<?php echo $this->Html->link(__('View Profile', true), array('controller' => 'students', 'action' => 'view')); ?>
	<br/>
	<?php echo $this->Html->link(__('Edit Profile', true), array('controller' => 'students', 'action' => 'edit')); ?>
<?php elseif($usertype == 'g'): ?>
	<?php echo $this->Html->link(__('View Profile', true), array('controller' => 'guardians', 'action' => 'view')); ?>
	<br/>
	<?php echo $this->Html->link(__('Edit Profile', true), array('controller' => 'guardians', 'action' => 'edit')); ?>
<?php endif; ?>
