
<div class="formTopWrapper">
    <div class="displayWrapper"<?php if (empty($students) || !empty($this->request->data)) echo ' style="display:block"'; ?>>
        <?php echo $this->Form->create('studentResultSummations', array('action' => 'index')); ?>
        <div class="set_wrapper">
            <?php /* <div class="infofoset itemfirstset">
              <?php echo $this->Form->input('student_id',array('label'=>'Name','empty' => 'Select Name')); ?>
              </div><!-- end of infofoset--> */ ?>

            <div class="infofoset itemfirstset">
                <?php echo $this->Form->input('level_id', array('id' => 'scms-class', 'class' => 'updateDrops', 'label' => '** Department', 'empty' => 'Select Department', 'data-belongs' => '#scms-group,#scms-section', 'data-depends' => '')); ?>
                <?php echo $this->Html->image("/images/loader/indicator.gif", array("alt" => "", 'class' => 'ajx-loading')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset">
                <?php echo $this->Form->input('section_id', array('id' => 'scms-section', 'label' => '* Shift', 'empty' => 'Select Shift')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset">
                <?php //echo $this->Form->input('registration', array('type' => 'text', 'class' => 'input_Txt top-search', 'label' => '* Registration :')); ?>
            </div><!-- end of infofoset-->
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <div class="infofoset itemfirstset">
                <?php echo $this->Form->input('term_id', array('id' => 'scms-term', 'label' => '** Term', 'empty' => 'Select Term')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset">
                <?php echo $this->Form->input('group_id', array('id' => 'scms-group', 'label' => 'Semister', 'empty' => 'Select Semister')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset">
                <?php //echo $this->Form->input('roll', array('type' => 'text', 'class' => 'input_Txt top-search', 'label' => 'Roll :')); ?>
            </div><!-- end of infofoset-->
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <div class="infofoset itemfirstset">
                <label for="session">* Session</label>
                <select name="data[studentResultSummations][school_session_id]">
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
                <div class="input chkBox">
                    <label<?php //for="StudentResultRe-calculate"  ?>>&nbsp;</label>
                    <div style="float:left"><?php //echo $this->Form->checkbox('re-calculate',array('id'=>'re-calc'));  ?></div>
<!--                                        <label for="re-calc" class="reCalc noselect"><small>[Re-Calculate]</small></label>-->
                </div>
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
