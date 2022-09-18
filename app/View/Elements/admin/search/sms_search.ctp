
<div class="formTopWrapper">
    <div class="displayWrapper"<?php if (empty($students) || !empty($this->request->data)) echo ' style="display:block"'; ?>>
        <?php echo $this->Form->create('Setting', array('action' => 'sms_log', 'type'=>'get')); ?>
        <div class="set_wrapper">
            <div class="infofoset itemfirstset">
                <?php  $option = array(
                    'general'=>'general',
                    'absent'=>'absent',
                    'halfAbsent'=>'halfAbsent',
                    'result-publish'=>'result-publish',
                    'fees'=>'fees',
                    'generate_fees'=>'generate_fees',
                );
                echo $this->Form->input('type', array( 'label' => 'Type :', 'empty' => '--Select Type--', 'class' => 'updateDrops', 'options'=>$option)); ?>
            </div><!-- end of infofoset-->

            <div class="infofoset itemlastset">
                  <?php echo $this->Form->input('date', array('type' => 'text ', 'id' => 'datepicker', 'label' => 'Date :', 'style' => 'height: 25px; margin-top:0px; width: 208px')); ?>
            </div><!-- end of infofoset-->
        </div>
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
<script>
    $(function() {
        $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd' });
    });
</script>