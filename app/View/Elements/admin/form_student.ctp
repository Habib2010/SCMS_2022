<?php //pr($this->request->data); ?>
<div class="blockWrapper">
    <div class="leftblock">
      <?php if ($this->action == 'admin_edit'): ?>
            <div class="idwrapper">
                <h4>Student ID:</h4>
                <div class="submit_Btn"><?php echo $this->request->data['Student']['sid']; ?></div>
                <?php echo $this->Form->input('sid', array('type' => 'hidden')); ?>
            </div><!-- end of idwrapper-->
        <?php endif; ?>
        <div class="block">
            <div class="set_wrapper">
                <?php echo $this->Form->input('name', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Full Name :')); ?>
                <?php echo $this->Form->input('registration', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Registration No :')); ?>
                <?php echo $this->Form->input('StudentCycle.0.roll', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Roll :')); ?>
                <?php echo $this->Form->input('permanent_address', array('type' => 'textarea', 'class' => 'input_Txt', 'label' => 'Permanent Address :')); ?>
                <?php echo $this->Form->input('current_address', array('type' => 'textarea', 'class' => 'input_Txt', 'label' => 'Current Address :')); ?>
            </div><!-- end of set_wrapper-->
            <div class="clear_both">&nbsp;</div>
        </div><!-- end of block-->
    </div><!-- end of leftblock-->

    <div class="imageupload">
        <div class="image_wrapper">
            <div class="thumbwrapper">
                <?php
                //echo $this->Html->image("/students_tmp_design/images/image.png", array("alt" => ""));
                $thumbnail = empty($this->request->data['Student']['thumbnail']) ? '' : $this->request->data['Student']['thumbnail'];
                $gender = empty($this->request->data['Student']['gender']) ? '' : $this->request->data['Student']['gender'];
                $thumbPath = empty($thumbnail) ? '/students_tmp_design/images/default-' . ($gender == 'Female' ? 'girl' : 'boy') . '.png' : 'student/thumbnail/' . $thumbnail; //THUMBNAIL_LOCATION4
                echo $this->Html->image($thumbPath, array('alt' => '', 'class' => ''));
                ?>
            </div><!-- end of thumbwrapper-->
            <?php //echo $this->Form->input('thumbnail',array('type'=>'hidden')); ?>
            <input type="file"  name="image" class="fileupload" value="Upload a Photo">
        </div><!-- end of image_wrapper-->
    </div><!-- end of imageupload-->

    <div class="clear_both">&nbsp;</div>
</div><!-- end of blockWrapper-->

<!-- ********************************** Father ***********************************************-->
<div class="blockWrapper">
    <div class="block">
        <div class="set_wrapper">
            <?php echo $this->Form->input('Guardian.0.name', array('type' => 'text', 'class' => 'input_Txt', 'label' => "Father's name :")); ?>
            <?php echo $this->Form->input('Guardian.0.rtype', array('type' => 'hidden', 'value' => 'Father')); ?>
            <?php echo $this->Form->input('Guardian.0.relation', array('type' => 'hidden', 'value' => '')); ?>
            <?php echo $this->Form->input('Guardian.0.gender', array('type' => 'hidden', 'value' => 'Male')); ?>
            <?php echo $this->Form->input('Guardian.0.id'); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('Guardian.0.occupation', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Occupation :')); ?>
        </div><!-- end of set_wrapper-->
        <?php /* ?><div class="set_wrapper">
          <?php echo $this->Form->input('father_rtype',array('label'=>'Relation :','options' => array('Father'=>'Father','Mother'=>'Mother','Guardian'=>'Guardian'),'empty' => '--Select--')); ?>
          </div><!-- end of set_wrapper--><?php */ ?>
        <div class="set_wrapper">
            <?php echo $this->Form->input('Guardian.0.mobile', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Mobile :')); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('Guardian.0.yearly_income', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Yearly Income :')); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('Guardian.0.nationality', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Nationality :')); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('Guardian.0.religion', array('label' => 'Religion :', 'options' => array('Islam' => 'Islam', 'Hindu' => 'Hindu', 'Christian' => 'Christian'), 'empty' => '--Select--')); ?>
        </div><!-- end of set_wrapper-->
        <div class="clear_both">&nbsp;</div>
    </div><!-- end of block-->
    <div class="clear_both">&nbsp;</div>
</div><!-- end of blockWrapper-->

<!-- ******************** Mother ***************************** -->
<div class="blockWrapper">
    <div class="block">
        <div class="set_wrapper">
            <?php echo $this->Form->input('Guardian.1.name', array('type' => 'text', 'class' => 'input_Txt', 'label' => "Mother's name :")); ?>
            <?php echo $this->Form->input('Guardian.1.rtype', array('type' => 'hidden', 'value' => 'Mother')); ?>
            <?php echo $this->Form->input('Guardian.1.relation', array('type' => 'hidden', 'value' => '')); ?>
            <?php echo $this->Form->input('Guardian.1.gender', array('type' => 'hidden', 'value' => 'Female')); ?>
            <?php echo $this->Form->input('Guardian.1.id'); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('Guardian.1.occupation', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Occupation :')); ?>
        </div><!-- end of set_wrapper-->
        <?php /* ?><div class="set_wrapper">
          <?php echo $this->Form->input('mother_rtype',array('label'=>'Relation :','options' => array('Father'=>'Father','Mother'=>'Mother','Guardian'=>'Guardian'),'empty' => '--Select--')); ?>
          </div><!-- end of set_wrapper--><?php */ ?>
        <div class="set_wrapper">
            <?php echo $this->Form->input('Guardian.1.mobile', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Mobile :')); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('Guardian.1.yearly_income', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Yearly Income :')); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('Guardian.1.nationality', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Nationality :')); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('Guardian.1.religion', array('label' => 'Religion :', 'options' => array('Islam' => 'Islam', 'Hindu' => 'Hindu', 'Christian' => 'Christian'), 'empty' => '--Select--')); ?>
        </div><!-- end of set_wrapper-->
        <div class="clear_both">&nbsp;</div>
    </div><!-- end of block-->
    <div class="clear_both">&nbsp;</div>
</div><!-- end of blockWrapper-->

<!-- ******************** Guardian ***************************** -->
<div class="blockWrapper noPrint">
    <div class="block">
        <div class="set_wrapper radioSetLine">
            <?php echo $this->Form->radio('active_guardian', array('Father' => 'Father', 'Mother' => 'Mother', 'Other' => 'Other'), array('style' => 'float:left', 'label' => 'Active Guardian :', 'default' => 'Father')); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('Guardian.2.name', array('type' => 'text', 'class' => 'input_Txt', 'label' => "Guardian's name :")); ?>
            <?php echo $this->Form->input('Guardian.2.rtype', array('type' => 'hidden', 'value' => 'Guardian')); ?>
            <?php echo $this->Form->input('Guardian.2.id'); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('Guardian.2.occupation', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Occupation :')); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('Guardian.2.relation', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Relation :')); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('Guardian.2.mobile', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Mobile :')); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('Guardian.2.yearly_income', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Yearly Income :')); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('Guardian.2.nationality', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Nationality :')); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('Guardian.2.gender', array('label' => 'Gender :', 'options' => array('Male' => 'Male', 'Female' => 'Female'), 'empty' => '--Select--')); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('Guardian.2.religion', array('label' => 'Religion :', 'options' => array('Islam' => 'Islam', 'Hindu' => 'Hindu', 'Christian' => 'Christian'), 'empty' => '--Select--')); ?>
        </div><!-- end of set_wrapper-->
        <div class="clear_both">&nbsp;</div>
    </div><!-- end of block-->
    <div class="clear_both">&nbsp;</div>
</div><!-- end of blockWrapper-->


<div class="blockWrapper">
    <div class="block">
        <div class="set_wrapper">
            <?php echo $this->Form->input('past_school', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Past School :')); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('past_sch_address', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Past School Address :')); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('email', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Student Email :')); ?>
        </div><!-- end of set_wrapper-->

        <div class="set_wrapper">
            <?php echo $this->Form->input('smobile', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Student Mobile :')); ?>
        </div><!-- end of set_wrapper-->

        <div class="set_wrapper">
            <?php echo $this->Form->input('telephone', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Telephone :')); ?>
        </div><!-- end of set_wrapper-->

        <div class="set_wrapper">
            <?php echo $this->Form->input('religion', array('label' => 'Religion :', 'options' => array('Islam' => 'Islam', 'Hindu' => 'Hindu', 'Christian' => 'Christian'), 'empty' => '--Select--')); ?>
        </div><!-- end of set_wrapper-->

        <div class="set_wrapper">
            <?php echo $this->Form->input('nationality', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Nationality :')); ?>
        </div><!-- end of set_wrapper-->

        <div class="set_wrapper">
            <?php echo $this->Form->input('blood_group', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Blood Group :')); ?>
        </div><!-- end of set_wrapper-->

        <div class="set_wrapper">
            <?php
            echo $this->Form->input('date_of_birth', array(
                'type' => 'date',
                'label' => 'Date of Birth :',
                //'dateFormat' => 'DMY',
                'minYear' => date('Y') - 30,
                'maxYear' => date('Y') - 5,
            ));
            ?>
        </div><!-- end of set_wrapper-->

        <div class="set_wrapper">
            <?php echo $this->Form->input('enrolled', array('type' => 'date', 'label' => 'Date of Admission :')); ?>
        </div><!-- end of set_wrapper-->

        <div class="set_wrapper">
            <?php
            echo $this->Form->input('gender', array('type' => 'select', 'label' => 'Gender :',
                'options' => array('Male' => 'Male', 'Female' => 'Female'), 'empty' => '--Select--'));
            ?>
        </div>

        <div class="set_wrapper">
            <?php
            echo $this->Form->input('freedom_fighter', array('type' => 'select', 'label' => 'Freedom Fighter :',
                'options' => array('Yes' => 'Yes', 'No' => 'No'), 'empty' => '--Select--'));
            ?>
        </div>

        <div class="set_wrapper">
            <?php
            echo $this->Form->input('tribal', array('type' => 'select', 'label' => 'Tribal :',
                'options' => array('Yes' => 'Yes', 'No' => 'No'), 'empty' => '--Select--'));
            ?>
        </div>

        <div class="set_wrapper">
            <?php
            echo $this->Form->input('orphan', array('type' => 'select', 'label' => 'Orphan :',
                'options' => array('Yes' => 'Yes', 'No' => 'No'), 'empty' => '--Select--'));
            ?>
        </div>

        <div class="set_wrapper">
            <?php
            echo $this->Form->input('disabled', array('type' => 'select', 'label' => 'Disabled :',
                'options' => array('Yes' => 'Yes', 'No' => 'No'), 'empty' => '--Select--'));
            ?>
        </div>

        <div class="set_wrapper">
            <?php
            echo $this->Form->input('pertime_job', array('type' => 'select', 'label' => 'Pertime Job :',
                'options' => array('Yes' => 'Yes', 'No' => 'No'), 'empty' => '--Select--'));
            ?>
        </div>

        <div class="set_wrapper">
            <?php echo $this->Form->input('job_type', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Job Type :')); ?>
        </div>

        <div class="set_wrapper">
            <?php
            echo $this->Form->input('stipend', array('type' => 'select', 'label' => 'Stipend :',
                'options' => array('Yes' => 'Yes', 'No' => 'No'), 'empty' => '--Select--'));
            ?>
        </div>

        <div class="set_wrapper">
            <?php
            echo $this->Form->input('scholarship', array('type' => 'select', 'label' => 'Scholarship :',
                'options' => array('Yes' => 'Yes', 'No' => 'No'), 'empty' => '--Select--'));
            ?>
        </div>
        <?php /*
          <div class="set_wrapper">
          <?php echo $this->Form->input('terminated',array('type'=>'date','label'=>'Ending Date :')); ?>
          </div><!-- end of set_wrapper--> */ ?>

        <div class="clear_both">&nbsp;</div>
    </div><!-- end of block-->
    <div class="clear_both">&nbsp;</div>
</div><!-- end of blockWrapper-->

<!--*************************************** Studnet cycle part here **********************************************-->

<?php if (!empty($studentData['StudentCycle'])) { ?>
    <div class="blockWrapper">
        <div class="block">
            <div class="set_wrapper">
                <?php echo $this->Form->input('StudentCycle.0.id'); ?>
                <?php echo $this->Form->input('StudentCycle.0.level_id', array('id' => 'scms-class', 'label' => 'Department :', 'empty' => '--Select--', 'class' => 'updateDrops', 'data-belongs' => '#scms-group,#scms-section,#scms-course-3rd,#scms-course-4th', 'data-depends' => '')); ?>

                <?php echo $this->Html->image("/images/loader/indicator.gif", array("alt" => "", 'class' => 'ajx-loading')); ?>
            </div><!-- end of set_wrapper-->
            <div class="set_wrapper">
                <?php echo $this->Form->input('StudentCycle.0.group_id', array('id' => 'scms-group', 'label' => 'Semister :', 'empty' => '--Select--', 'class' => 'updateDrops', 'data-belongs' => '#scms-course-3rd,#scms-course-4th', 'data-depends' => 'scms-class')); ?>
                <!--'disabled'=>TRUE-->	
                <?php echo $this->Html->image("/images/loader/indicator.gif", array("alt" => "", 'class' => 'ajx-loading')); ?>
            </div><!-- end of set_wrapper-->
            <div class="set_wrapper">
                <?php echo $this->Form->input('StudentCycle.0.section_id', array('id' => 'scms-section', 'label' => 'Section :', 'empty' => '--Select--')); ?>
            </div><!-- end of set_wrapper-->

            <div class="set_wrapper">
                <label for="session">Session :</label>
                <select name="data[StudentCycle][0][school_session_id]">
                    <option value="">--Select--</option>
                    <?php
                    foreach ($schoolSessions as $schoolSession):
                        $val = $schoolSession['SchoolSession']['id'] + 1;
                        ?>
                        <option value="<?php echo $schoolSession['SchoolSession']['id']; ?>" <?php echo ($schoolSession['SchoolSession']['id'] == $this->request->data['StudentCycle'][0]['school_session_id']) ? ' selected="selected" ' : ' ';?>><?php echo $schoolSession['SchoolSession']['id'] . '-' . $val; ?></option>
                    <?php endforeach; ?>
                </select>
            </div><!-- end of set_wrapper-->
	    
	    <div class="set_wrapper">
                <label for="year">Year :</label>
                <select name="data[StudentCycle][0][year]">
                    <option value="">--Select--</option>
                    <?php
                    foreach ($schoolSessions as $schoolSession):
                    ?>
                        <option value="<?php echo $schoolSession['SchoolSession']['id']; ?>" <?php echo ($schoolSession['SchoolSession']['id'] == $this->request->data['StudentCycle'][0]['year']) ? ' selected="selected" ' : ' ';?>><?php echo $schoolSession['SchoolSession']['id']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div><!-- end of set_wrapper-->
            
            <div class="set_wrapper hasCheckbox">
                <label for="StudentStatus">Status:</label>
                <?php echo $this->Form->checkbox('status', array('class' => 'input_Txt', 'lebel' => 'Status:', 'value' => 1)); ?>
            </div><!-- end of set_wrapper-->
            <!-- end of set_wrapper-->
            <div class="clear_both">&nbsp;</div>
        </div><!-- end of block-->
        <div class="clear_both">&nbsp;</div>
    </div>
      <!-- Student Cycle part End here -->
     <div class="blockWrapper noPrint">
        <div class="block">
            <div class="set_wrapper">
                <?php echo $this->Form->input('course_fee', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Course Fee :')); ?>
            </div><!-- end of set_wrapper-->
            <div class="clear_both">&nbsp;</div>
        </div>
    </div>
     <div class="blockWrapper noPrint">
        <div class="block">
            <div class="set_wrapper">
                <?php echo $this->Form->input('note', array('type' => 'textarea', 'class' => 'input_Txt', 'label' => 'Note :')); ?>
            </div><!-- end of set_wrapper-->
            <div class="clear_both">&nbsp;</div>
        </div>
    </div>
    <div class="clear_both">&nbsp;</div>
    <div class="leftTop btmPrintwrapper">
        <div class="editwraper">
            <!--<a href="#" class="forword">Export</a>-->
            <!-- <a href="#" class="print">Print</a>-->
            <!-- <input type="submit" name="submit" class="submit_stu" value="Save" />-->
            <!--<a href="#">Save &amp; Next</a>-->
            <?php //echo $this->Form->submit('Export', array( 'div' => false , 'class' => 'forword submit1' , 'value' => 'Print') ); ?>
            <?php //echo $this->Form->submit('Print', array( 'div' => false , 'class' => 'print submit1' , 'value' => 'Print') ); ?>
            <?php
            echo $this->Form->submit('Save', array('div' => false, 'class' => 'submit1', 'value' => 'Save'));
            ?>
            <?php //echo $this->Form->submit('Save & Next', array( 'div' => false , 'class' => 'submit1' , 'value' => 'Save') );   ?>
        </div><!-- end of editwraper-->
    </div>
<?php } ?>