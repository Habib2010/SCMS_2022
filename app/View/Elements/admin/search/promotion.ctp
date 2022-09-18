<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="formTopWrapper">
    <div class="displayWrapper"<?php if (empty($students) || !empty($this->request->data)) echo ' style="display:block"'; ?>>
        <?php echo $this->Form->create('StudentPromotion', array('action' => 'index')); ?>
        <div class="set_wrapper">
            <div class="infofoset itemfirstset">
                <?php echo $this->Form->input('level_id', array('id' => 'scms-class', 'class' => 'updateDrops', 'label' => '** Department', 'empty' => 'Select Department', 'data-belongs' => '#scms-group,#scms-section', 'data-depends' => '')); ?>
                <?php echo $this->Html->image("/images/loader/indicator.gif", array("alt" => "", 'class' => 'ajx-loading')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset">
                <?php echo $this->Form->input('section_id', array('id' => 'scms-section', 'label' => '* Shift', 'empty' => 'Select Shift')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset">
                 <?php echo $this->Form->input('group_id', array('id' => 'scms-group', 'label' => '** Semister', 'empty' => 'Select Semister')); ?>
            </div><!-- end of infofoset-->
        </div><!-- end of set_wrapper-->
        
        <div class="set_wrapper">
            <div class="infofoset itemfirstset">
               <label for="session">** Session </label>
                <select name="data[StudentPromotion][school_session_id]">
                    <option value="">Select Session</option>
                    <?php
                    foreach ($schoolSessions as $schoolSession):
                        $val = $schoolSession['SchoolSession']['id'] + 1;
                        ?>
                        <option value="<?php echo $schoolSession['SchoolSession']['id']; ?>" <?php if ($schoolSession['SchoolSession']['id'] == date('Y')) echo ' selected="selected"'; ?>><?php echo $schoolSession['SchoolSession']['id'] . '-' . $val; ?></option>
                    <?php endforeach; ?>
                </select>
            </div><!-- end of infofoset-->
            <div class="infofoset">
               
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset">
                 <div class="input chkBox">
                    <label<?php //for="StudentResultRe-calculate"   ?>>&nbsp;</label>
                    <div style="float:left"><?php echo $this->Form->checkbox('promotion', array('id' => 're-calc')); ?></div>
                    <label for="re-calc" class="reCalc noselect"><small>[Promotion]</small></label>
                </div>
                <!--<input type="submit" value="Search" class="submit_Btn" />-->
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset" style="margin-left: 709px;">
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