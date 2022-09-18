<?php $this->extend('/Common/admin_edit'); ?>
<?php echo $this->Form->create('Employee',array('type'=>'file'));?>
<fieldset>
	<div class="tabs">		
		<div id="role-main">
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('User.id');
			echo $this->Form->input('User.name',array('label' => 'নাম'));
			echo $this->Form->input('User.username',array('label' => 'ইউজার নাম'));
			echo $this->Form->input('User.email',array('label' => 'ইমেইল'));
			echo $this->Form->input('phone',array('label' => 'ফোন'));
			echo $this->Form->hidden('designation');
			echo $this->Form->hidden('degree');
			echo $this->Form->hidden('blood_group');
			echo $this->Form->hidden('date_of_birth');
			echo $this->Form->hidden('join_date');
			echo $this->Form->input('address',array('label' => 'ঠিকানা'));
			echo $this->Form->input('profile',array('class' => 'content','label' => 'প্রোফাইল'));
			echo $this->Form->input('quote_heading',array('class' => 'content','label' => 'বক্তব্য শিরোনাম'));
			echo $this->Form->input('quote',array('class' => 'content','label' => 'বেক্তিগত বক্তব্য'));	
			echo $this->Form->input('gender',array('label' => 'লিঙ্গ', 'options' => array('Male','Female')));
			echo $this->Form->input('marital_status' , array('options' => array('Married' , 'Unmarried'),'label' => 'বৈবাহিক অবস্থা'));					
			echo $this->Form->label('ছবি');
		?>
        <input type="file" name="image"/>
		<?php echo $thumbnail = $this->Html->image('employee/thumbnail/'.$this->request->data['Employee']['thumbnail']); ?>
		<?php echo $this->Form->input('status',array('label' => 'স্ট্যাটাস')); ?>
		</div>
		<?php echo $this->Layout->adminTabs(); ?>
	</div>
</fieldset>

<div class="buttons">
<?php
	echo $this->Form->end(__('Save'));
	echo $this->Html->link(__('Cancel'), array(
		'controller' => 'employees',
		'action' => 'view', 
	), array(
		'class' => 'cancel',
	));
?>
</div>	