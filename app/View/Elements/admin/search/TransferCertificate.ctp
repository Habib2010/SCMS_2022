<div class="formTopWrapper">
    <div class="displayWrapper"<?php if (empty($students) || !empty($this->request->data)) echo ' style="display:block"'; ?>>
        <?php echo $this->Form->create('TransferCertificate', array('action' => 'index')); ?>
        <div class="set_wrapper">
            <?php /* <div class="infofoset itemfirstset">
              <?php echo $this->Form->input('student_id',array('label'=>'Name','empty' => 'Select Name')); ?>
              </div><!-- end of infofoset--> */ ?>

            <div class="infofoset itemfirstset">
                <?php echo $this->Form->input('level_id', array('id' => 'scms-class', 'class' => 'updateDrops', 'label' => '** Class', 'empty' => 'Select Class', 'data-belongs' => '#scms-group,#scms-section', 'data-depends' => '')); ?>
                <?php echo $this->Html->image("/images/loader/indicator.gif", array("alt" => "", 'class' => 'ajx-loading')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset">
                <?php echo $this->Form->input('section_id', array('id' => 'scms-section', 'label' => '* Section', 'empty' => 'Select Section')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset">
                <?php echo $this->Form->input('registration', array('type' => 'text', 'class' => 'input_Txt top-search', 'label' => '* Registration :')); ?>
            </div><!-- end of infofoset-->
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <div class="infofoset itemfirstset">
                <?php echo $this->Form->input('group_id', array('id' => 'scms-group', 'label' => 'Group', 'empty' => 'Select Group')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset">
                <?php echo $this->Form->input('roll', array('type' => 'text', 'class' => 'input_Txt top-search', 'label' => 'Roll :')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset">
                <?php echo $this->Form->input('school_session_id', array('label' => '** Session', 'empty' => 'Select Session', 'default' => date('Y'))); ?>
            </div><!-- end of infofoset-->
        </div><!-- end of set_wrapper-->

        <div class="set_wrapper">
            <div class="infofoset itemfirstset">
                <?php echo '&nbsp'; ?>
            </div><!-- end of infofoset-->
            <div class="infofoset">
                <?php echo '&nbsp'; ?>
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset" >
                <!--<input type="submit" value="Search" class="submit_Btn" />-->
                <?php echo $this->Form->submit('Search', array('div' => false, 'class' => 'submit_Btn', 'value' => 'Search')); ?>
            </div><!-- end of infofoset-->

            <?php echo $this->Form->end(); ?>
        </div>     
        <div class="clear_both">&nbsp;</div>
    </div><!-- end of displayWrapper-->
    <div class="arrowwrapper">
        <a class="close1" href="javascript:void(0);">&nbsp;</a>
    </div><!-- end of arrowwrapper-->

</div><!-- end of formTopWrapper-->

