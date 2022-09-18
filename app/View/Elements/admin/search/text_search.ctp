<div class="formTopWrapper">
    <div class="displayWrapper"<?php if (!empty($texts) || !empty($this->request->data)) echo ' style="display:block"'; ?>>
        <?php echo $this->Form->create('Text', array('action' => 'index', 'type'=>'get')); ?>
        <div class="set_wrapper">
            <div class="infofoset itemfirstset">
                <?php echo $this->Form->input('level_id', array('id' => 'scms-class', 'class' => 'updateDrops', 'label' => '** Department', 'empty' => 'Select Department', 'data-belongs' => '#scms-group,#scms-section', 'data-depends' => '')); ?>
                <?php echo $this->Html->image("/images/loader/indicator.gif", array("alt" => "", 'class' => 'ajx-loading')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset">
                <?php echo $this->Form->input('group_id', array('id' => 'scms-group', 'label' => '** Semister', 'empty' => 'Select Semister')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset">
                <?php echo $this->Form->input('term_id', array('id' => 'scms-term', 'label' => '** Term', 'empty' => 'Select Term')); ?>
            </div><!-- end of infofoset-->
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <div class="infofoset itemfirstset">
                <?php 
                echo $this->Form->input('school_session_id', array('type' => 'date', 'label' => 'Session', 'empty' => 'Select Session', 'selected' => array('year' => isset($this->request->data['Text']['school_session_id']) ? $this->request->data['Text']['school_session_id'] : date('Y')), 'dateFormat' => 'Y', 'minYear' => 2011, 'maxYear' => date('Y'), 'name' => 'school_session_id'));
                ?>
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
