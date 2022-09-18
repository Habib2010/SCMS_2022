
<div class="formTopWrapper">
    <div class="displayWrapper"<?php if (empty($students) || !empty($this->request->data) || !empty($this->params->query)) echo ' style="display:block"'; ?>>
	<?php echo $this->Form->create('TempStudents', array('action' => 'admin_index', 'type' => 'get')); ?>
	<div class="set_wrapper">

	    <div class="infofoset itemfirstset">
		<?php echo $this->Form->input('serial', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Serial No :', 'style' => 'width:52%')); ?>
	    </div><!-- end of infofoset-->

	    <div class="infofoset">
		<?php echo $this->Form->input('mobile', array('type' => 'text', 'class' => 'input_Txt top-search', 'label' => 'Mobile :')); ?>
	    </div><!-- end of infofoset-->
	    
	    <div class="infofoset itemlastset">
		<?php echo $this->Form->input('admission_year', array('type' => 'date', 'label' => 'Year', 'empty' => '---Select---', 'selected' => array('year' => date('Y', strtotime('+1 year'))), 'dateFormat' => 'Y', 'minYear' => 2013, 'maxYear' => date('Y'))); ?>
	    </div><!-- end of infofoset-->
	</div><!-- end of set_wrapper-->
	<div class="set_wrapper">
	    <div class="infofoset itemfirstset">
		<?php echo $this->Form->input('name_english', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Name in English (%_%) :', 'style' => 'width:52%')); ?>
	    </div><!-- end of infofoset-->
	    
	    <div class="infofoset">
		<?php echo $this->Form->input('track', array('type' => 'text', 'class' => 'input_Txt top-search', 'label' => 'SSC Roll :'));?>
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
