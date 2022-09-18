<?php

$this->extend('/Common/admin_edit'); ?>
<div class="users form">
<?php echo $this->Form->create('Text', array('id'=>'accountForm')); ?>
    <div class="blockWrapper">
        <div class="block">
            <div class="set_wrapper">
            <?php echo $this->Form->input('level_id', array('id' => 'scms-class', 'label' => 'Department :', 'empty' => '--Select--', 'class' => 'updateDrops', 'data-belongs' => '#scms-group,#scms-section,#scms-course-3rd,#scms-course-4th', 'data-depends' => '')); ?>
            <?php echo $this->Html->image("/images/loader/indicator.gif", array("alt" => "", 'class' => 'ajx-loading')); ?>
            </div><!-- end of set_wrapper-->
            <div class="set_wrapper">
            <?php echo $this->Form->input('group_id', array('id' => 'scms-group', 'label' => 'Semister :', 'empty' => '--Select--', 'class' => 'updateDrops', 'data-belongs' => '#scms-course-3rd,#scms-course-4th', 'data-depends' => 'scms-class')); ?>
                <!--'disabled'=>TRUE-->	
            <?php //echo $this->Html->image("/images/loader/indicator.gif", array("alt" => "", 'class' => 'ajx-loading')); ?>
            </div><!-- end of set_wrapper-->
            <div class="set_wrapper">
                <?php echo $this->Form->input('term_id', array('id' => 'scms-term', 'label' => '** Term', 'empty' => 'Select Term')); ?>
            </div><!-- end of set_wrapper-->
            <div class="set_wrapper">
                <label for="session">Session :</label>
                <select name="data[Text][school_session_id]">
                    <option value="">--Select--</option>
                <?php foreach ($schoolSessions as $schoolSession):
                    $val = $schoolSession['SchoolSession']['id']+1;
                    ?>
                    <option value="<?php echo $schoolSession['SchoolSession']['id']; ?>"><?php echo $schoolSession['SchoolSession']['id'].'-'.$val; ?></option>
                <?php endforeach;?>
                </select>
            </div><!-- end of set_wrapper-->
            
            <div class="set_wrapper">
               <?php echo $this->Form->input('text1', array('type' => 'text', 'label' => 'Student Result Text1(Final-Term: Pass Students Text) :')); ?>
            </div><!-- end of set_wrapper-->
            <div class="set_wrapper">
               <?php echo $this->Form->input('text2', array('type' => 'text', 'label' => 'Student Result Text2(Final-Term: Referred Students Text) :')); ?>
            </div><!-- end of set_wrapper-->
            <div class="set_wrapper">
               <?php echo $this->Form->input('text3', array('type' => 'text', 'label' => 'Student Result Text3(Final-Term: Fail Students Text) :')); ?>
            </div><!-- end of set_wrapper-->
            <div class="set_wrapper">
               <?php echo $this->Form->input('text4', array('type' => 'text', 'label' => 'Student Result Text4(Supplementary-Term: Pass Students Text) :')); ?>
            </div><!-- end of set_wrapper--> 
            <div class="set_wrapper">
               <?php echo $this->Form->input('text5', array('type' => 'text', 'label' => 'Student Result Text5(Supplementary-Term: Fail Students Text/Header for Mark Sheet Final-Term) :')); ?>
            </div><!-- end of set_wrapper-->
            <div class="set_wrapper">
               <?php echo $this->Form->input('text6', array('type' => 'text', 'label' => 'Student Result Text6(Header for Mark Sheet Supplementary-Term) :')); ?>
            </div><!-- end of set_wrapper-->
            <!-- end of set_wrapper-->
            <div class="clear_both">&nbsp;</div>
        </div><!-- end of block-->
        <div class="clear_both">&nbsp;</div>
    </div>
</div>
<div class="buttonsAccount">
    <?php
    echo $this->Form->end(__('Save'));
    echo $this->Html->link(__('Cancel'), array(
        'action' => 'index',
            ), array(
        'class' => 'cancel',
    ));
    ?>
</div>