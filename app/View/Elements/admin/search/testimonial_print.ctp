<div class="formTopWrapper" id="testimonial">
    <div class="displayWrapper"<?php if (empty($testimonials) || !empty($this->request->data) || !empty($this->params->query)) echo ' style="display:block"'; ?>>
        <?php echo $this->Form->create('Testimonial', array('action' => 'all_print', 'type' => 'get')); ?>
        <div class="set_wrapper">
           
            <div class="infofoset itemfirstset">
                <?php
                $group = array(
		'67-ELECTRICAL TECHNOLOGY' => '67-ELECTRICAL TECHNOLOGY',
		'MECHANICAL TECHNOLOGY' => 'MECHANICAL TECHNOLOGY',
		'COMPUTER TECHNOLOGY' => 'COMPUTER TECHNOLOGY',
		'CIVIL TECHNOLOGY' => 'CIVIL TECHNOLOGY',
		'ELECTRONICS TECHNOLOGY' => 'ELECTRONICS TECHNOLOGY',
		'TEXTILE TECHNOLOGY' => 'TEXTILE TECHNOLOGY',
		'ARCHITECTURE AND INTERIOR DESIGN TECHNOLOGY' => 'ARCHITECTURE AND INTERIOR DESIGN TECHNOLOGY',
		'POWER TECHNOLOGY' => 'POWER TECHNOLOGY'
		);
                echo $this->Form->input('group', array('label' => 'Group', 'options'=>$group, 'empty'=>'Select Group'));
                ?>
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset">
<?php echo $this->Form->input('exam_year', array('type' => 'text', 'label' => 'Exam Year', 'class' => 'input_Txt')); ?>
            </div><!-- end of infofoset-->
        </div></br></br>
        <div class="set_wrapper"> 
            <div class="infofoset itemfirstset">
                &nbsp;<?php //echo $this->Form->input('shift', array('empty' => 'Select Shift','options' => array('Morning' => 'Morning', 'Day' => 'Day', 'Evening' => 'Evening'),array('label'=>'Shift')));      ?>
            </div><!-- end of infofoset-->
            <div class="infofoset">
                &nbsp;<?php //echo $this->Form->input('shift', array('empty' => 'Select Shift','options' => array('Morning' => 'Morning', 'Day' => 'Day', 'Evening' => 'Evening'),array('label'=>'Shift')));      ?>
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset">
                <!--<input type="submit" value="Search" class="submit_Btn" />-->
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
