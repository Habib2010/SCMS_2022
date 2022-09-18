<div class="formTopWrapper">
    <div class="displayWrapper"<?php if (empty($students) || !empty($this->request->data)) echo ' style="display:block"'; ?>>
        <?php echo $this->Form->create('Student', array('action' => 'course_part_promote')); ?>
        <div class="set_wrapper">
            <div class="infofoset itemfirstset">
                <?php echo $this->Form->input('school_session_id', array('label' => '** Previous Session', 'empty' => 'Select Previous Session')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset">
               
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset">
                 <div class="input chkBox">
                    <label<?php //for="StudentResultRe-calculate"   ?>>&nbsp;</label>
                    <div style="float:left"><?php echo $this->Form->checkbox('promote_parts', array('id' => 're-calc')); ?></div>
                    <label for="re-calc" class="reCalc noselect"><small>[Promote]</small></label>
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

