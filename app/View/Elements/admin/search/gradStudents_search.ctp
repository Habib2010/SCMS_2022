
<div class="formTopWrapper">
    <div class="displayWrapper"<?php if (empty($gradStudents) || !empty($this->request->data) || !empty($this->params->query)) echo ' style="display:block"'; ?>>
	<?php echo $this->Form->create('GradStudents', array('action' => 'admin_index', 'type' => 'get')); ?>
	<div class="set_wrapper">

	    <div class="infofoset itemfirstset">
		<?php echo $this->Form->input('roll', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Board Roll :', 'style' => 'width:52%')); ?>
	    </div><!-- end of infofoset-->

	    <div class="infofoset">
		<?php echo $this->Form->input('mobile', array('type' => 'text', 'class' => 'input_Txt top-search', 'label' => 'Mobile :')); ?>
	    </div><!-- end of infofoset-->
	    
	    <div class="infofoset itemlastset">
		<?php echo $this->Form->input('passing_year', array('type' => 'date', 'label' => 'Passing Year', 'empty' => '---Select---', 'dateFormat' => 'Y', 'minYear' => 1964, 'maxYear' => date('Y'))); ?>
	    </div><!-- end of infofoset-->
	</div><!-- end of set_wrapper-->
	<div class="set_wrapper">
	    <div class="infofoset itemfirstset">
		<?php echo $this->Form->input('name', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Name(%_%) :', 'style' => 'width:52%')); ?>
	    </div><!-- end of infofoset-->
	    
	    <div class="infofoset">
		<?php echo $this->Form->input('level_id', array('type' => 'select', 'class' => '', 'label' => 'Department :', 'empty' => '---SELECT---', 'options' => $depts));?>&nbsp;
	    </div><!-- end of infofoset-->

	    <div class="infofoset itemlastset " style="float: right; margin-right: 145px;">
		<?php echo $this->Form->submit('Search', array('div' => false, 'class' => 'submit_Btn', 'value' => 'Search')); ?>
	    </div><!-- end of infofoset-->
	</div><!-- end of set_wrapper-->

	<div class="clear_both">&nbsp;</div>
	<?php echo $this->Form->end(); ?>
    </div><!-- end of displayWrapper-->
    <div class="arrowwrapper">
	<a class="close1" href="javascript:void(0);">&nbsp;</a>
    </div><!-- end of arrowwrapper-->               
</div><!-- end of formTopWrapper-->
