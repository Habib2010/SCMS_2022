<?php
?>
<div class="formTopWrapper">
    <div class="displayWrapper"<?php if (empty($payments) || !empty($this->request->data) || !empty($this->params->query)) echo ' style="display:block"'; ?>>
        <?php echo $this->Form->create('FeesPayment', array('controller'=>'FeesPayments', 'action' => 'bkash_fees_index', 'type'=>'get')); ?>
        <div class="set_wrapper">
            <div class="infofoset itemfirstset">
                <?php echo $this->Form->input('trxId', array('id' => 'payment', 'label' => 'trxId :',  'class' => 'input_Txt')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset">
                <?php echo $this->Form->input('registration', array('id' => 'payment', 'class' => 'input_Txt', 'label' => 'Student Registration :')); ?>
            </div><!-- end of infofoset-->
        </div><br><br>
        <div class="set_wrapper"> 
            <div class="infofoset itemfirstset">
                &nbsp;<?php //echo $this->Form->input('shift', array('empty' => 'Select Shift','options' => array('Morning' => 'Morning', 'Day' => 'Day', 'Evening' => 'Evening'),array('label'=>'Shift')));  ?>
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