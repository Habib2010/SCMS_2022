<?php //pr($schoolSessions); die();           ?>
<div class="formTopWrapper">
    <div class="displayWrapper"<?php if (empty($students) || !empty($this->request->data)) echo ' style="display:block"'; ?>>
        <?php echo $this->Form->create('StudentResult', array('action' => 'refered_addedit')); ?>
        <div class="set_wrapper">
            <div class="infofoset itemfirstset">
                    <label for="session">* Session</label>
                    <select name="data[StudentResult][school_session_id]"  id="grSession">
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
                <?php echo $this->Form->input('group', array('id' => 'scms-group', 'class' => 'rgroupId', 'label' => 'Semister', 'empty' => 'Select Semister')); ?>
                <?php echo $this->Html->image("/images/loader/indicator.gif", array("alt" => "", 'id' => 'crs-loading', 'class' => 'ajx-loading')); ?>
            </div><!-- end of infofoset-->
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <div class="infofoset itemfirstset">
                <?php echo $this->Form->input('section_id', array('id' => 'scms-section', 'label' => '* Shift', 'empty' => '-- Select Shift --')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset">
                <?php echo $this->Form->input('term_id', array('id' => 'scms-term', 'label' => '* Term', 'empty' => '-- Select Term --')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset">
                <?php
                if (!empty($courseInfo)) {
                    $empCrs = array($courseInfo['Course']['id'] => $courseInfo['Course']['name']);
                    echo $this->Form->input('studentCourse_id', array('id' => 'course-all', 'label' => '* Course', 'empty' => $empCrs));
                } else {
                    echo $this->Form->input('studentCourse_id', array('id' => 'course-all', 'label' => '* Course', 'empty' => '-- Select Course --'));
                }
                ?>
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
</div><!-- end of formTopWrapper-->
