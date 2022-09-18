<?php
//pr($this->request->data);
?>
<div class="formTopWrapper">
    <div class="displayWrapper"<?php echo ' style="display:block"'; ?>>
        <?php echo $this->Form->create('Student', array('action' => 'index', 'type' => 'get')); ?>
        <div class="set_wrapper">
            <div class="infofoset itemfirstset">
                <?php echo $this->Form->input('name', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Name (%_%) :', 'style' => 'width:52%')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset">
                <?php
                echo $this->Form->input('level', array('id' => 'scms-class', 'class' => 'updateDrops', 'label' => 'Department', 'empty' => 'Select Department', 'data-belongs' => '#scms-group,#scms-section', 'data-depends' => ''));
                echo $this->Html->image("/images/loader/indicator.gif", array("alt" => "", 'class' => 'ajx-loading'));
                ?>
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset">
                <label for="session">Session :</label>
                <select name="session">
                    <option value="">Select Session</option>
                    <?php
                    foreach ($schoolSessions as $schoolSession):
                        $val = $schoolSession['SchoolSession']['id'] + 1;
                        ?>
                        <option value="<?php echo $schoolSession['SchoolSession']['id']; ?>"><?php echo $schoolSession['SchoolSession']['id'] . '-' . $val; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php
                //echo $this->Form->year('session',2000,date('Y'));
                ?>
            </div><!-- end of infofoset-->
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <div class="infofoset itemfirstset">
                <?php echo $this->Form->input('sid', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Student Id :', 'style' => 'width:52%')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset">
                <?php echo $this->Form->input('section', array('id' => 'scms-section', 'label' => 'Section', 'empty' => 'Select Section')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset">
                <!--<input type="submit" value="Search" class="submit_Btn" />-->
                <?php echo $this->Form->input('religion', array('label' => 'Religion', 'empty' => 'Select Religion')); ?>
            </div><!-- end of infofoset-->
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <div class="infofoset itemfirstset">
                <?php echo $this->Form->input('roll', array('type' => 'text', 'class' => 'input_Txt', 'label' => 'Roll :', 'style' => 'width:52%')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset">
                <?php echo $this->Form->input('group', array('id' => 'scms-group', 'label' => 'Semister', 'empty' => 'Select Semister')); ?>
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset">
                <!--<input type="submit" value="Search" class="submit_Btn" />-->
                <?php echo $this->Form->input('shift', array('label' => 'Shift', 'empty' => 'Select Shift'));  ?>
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

</div>
