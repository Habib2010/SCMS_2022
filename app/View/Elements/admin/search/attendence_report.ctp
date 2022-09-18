<div class="formTopWrapper">
    <div class="displayWrapper"<?php if (empty($students) || !empty($this->request->data)) echo ' style="display:block"'; ?>>
        <?php echo $this->Form->create('Attendences', array('action' => 'attendence_report')); ?>
        <div class="set_wrapper">
            <div class="infofoset itemfirstset">
                    <label for="session">* Session</label>
                    <select name="data[Attendences][school_session_id]"  id="grSession">
                        <option value="">Select Session</option>
                        <?php
                        foreach ($schoolSessions as $schoolSession):
                            $val = $schoolSession['SchoolSession']['id'] + 1;
                            ?>
                        <option value="<?php echo $schoolSession['SchoolSession']['id']; ?>" <?php if(!empty($sesId)){ echo ($schoolSession['SchoolSession']['id'] == $sesId ? 'Selected=Selected' : ' ');} ?>><?php echo $schoolSession['SchoolSession']['id'] . '-' . $val; ?></option>
                        <?php endforeach; ?>
                    </select>
            </div><!-- end of infofoset-->
            <div class="infofoset">
                <?php echo $this->Form->input('level_id', array('id' => 'scms-class-result', 'label' => '* Department', 'empty' => 'Select Department', 'class' => 'updateDrops', 'data-belongs' => '#scms-group,#scms-section,#scms-course-all', 'data-depends' => '')); ?>
                <?php echo $this->Html->image("/images/loader/indicator.gif", array("alt" => "", 'class' => 'ajx-loading')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset">
                &nbsp;
            </div><!-- end of infofoset-->
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <div class="infofoset itemfirstset">
                <?php echo $this->Form->input('group', array('id' => 'scms-group', 'class' => 'groupId', 'label' => 'Semister', 'empty' => 'Select Semister')); ?>
                <?php echo $this->Html->image("/images/loader/indicator.gif", array("alt" => "", 'id' => 'crs-loading', 'class' => 'ajx-loading')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset">
                <?php echo $this->Form->input('section_id', array('id' => 'scms-section', 'label' => '* Shift', 'empty' => '-- Select Shift --')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset">
                 &nbsp;
            </div><!-- end of infofoset-->
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <div class="infofoset itemfirstset">
                <?php echo $this->Form->input('date', array('type' => 'text ', 'id' => 'datepicker1', 'label' => 'Start Date :', 'style' => 'height: 25px; margin-top:10px;')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset">
                 <?php echo $this->Form->input('end_date', array('type' => 'text ', 'id' => 'datepicker', 'label' => 'End Date :', 'style' => 'height: 25px; margin-top:10px;')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset">
                &nbsp;
            </div><!-- end of infofoset-->
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <div class="infofoset itemfirstset">
                &nbsp;
            </div><!-- end of infofoset-->
            <div class="infofoset">
                &nbsp;
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset" style="float: right;">
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
        $( "#datepicker" ).datepicker({  maxDate: new Date(), dateFormat: 'yy-mm-dd' });
    });
</script>