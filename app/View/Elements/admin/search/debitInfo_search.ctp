<div class="formTopWrapper">
    <div class="displayWrapper"<?php  echo ' style="display:block"'; ?>>
        <?php echo $this->Form->create('Debit', array('action' => 'debit_report', 'admin' => true, 'type' => 'get')); ?>
        <div class="set_wrapper">
            <div class="infofoset itemfirstset">
                <?php echo $this->Form->input('start_date', array('type' => 'text ', 'id' => 'datepicker', 'label' => '** Debit Date From :')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset">
                <?php
                echo $this->Form->input('bank_id', array('label' => 'Debit From: ', 'empty' => 'All', 'options' => $bankId));
                ?>
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset">

                <?php
                echo $this->Form->input('sid', array('label' => 'Student Id:', 'id' => 'registration', 'style'=>'width:52%'));
                ?>
            </div><!-- end of infofoset-->
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <div class="infofoset itemfirstset">
                <?php echo $this->Form->input('end_date', array('type' => 'text ', 'id' => 'datepicker1', 'label' => '** Debit Date To:')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset">
                <?php echo $this->Form->input('employee_id', array('label' => 'Staff:',  'options' => $empId, 'empty' => 'All')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset">
               <?php echo $this->Form->input('other', array('label' => 'Other', 'style'=>'width:52%')); ?>
            </div><!-- end of infofoset-->
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <div class="infofoset itemfirstset">
                <?php echo $this->Form->input('purpose_id', array('label' => 'Purpose:', 'options' => $purposeName, 'empty' => 'All', 'style' => 'width:40%; height:10%', 'class' => 'input_Txt'));
                ?>
            </div><!-- end of infofoset-->
            <div class="infofoset">
                <?php //echo $this->Form->input('section', array('id' => 'scms-section', 'label' => 'Section', 'empty' => 'Select Section')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset">
                <!--<input type="submit" value="Search" class="submit_Btn" />-->
                <?php //echo $this->Form->input('religion', array('label' => 'Religion', 'empty' => 'Select Religion')); ?>
            </div><!-- end of infofoset-->
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <div class="infofoset itemfirstset">
                &nbsp;
            </div><!-- end of infofoset-->
            <div class="infofoset">
                &nbsp;
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

</div>

