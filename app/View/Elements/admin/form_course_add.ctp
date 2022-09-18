<?php
//pr($this->request->data);
//pr($cTypes);
?>
<div class="blockWrapper">
    <?php if ($this->action == 'admin_edit') { ?>
        <div class="leftblock">
            <div class="idwrapper">
                <h4>Course ID:</h4>
                <div class="submit_Btn"><?php echo $this->request->data['Course']['name'] . " (" . $this->request->data['Course']['code'] . ")"; ?></div>
            </div><!-- end of idwrapper-->
        </div><!-- end of leftblock-->
    <?php } ?>

    <div class="clear_both">&nbsp;</div>
</div><!-- end of blockWrapper-->

<!-- ********************************** Course ***********************************************-->
<div class="blockWrapper">
    <div class="block">
        <div class="set_wrapper">
            <?php echo $this->Form->input('name', array('type' => 'text', 'class' => 'input_Txt')); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('code', array('type' => 'text', 'class' => 'input_Txt')); ?>
            
             <?php  //echo $this->Form->input('session', array('type' => 'hidden', 'value'=>  date('Y'))); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('type', array('multiple' => 'multiple', 'id' => 'courseType', 'options' => array('Compulsory' => 'Compulsory', 'Selective' => 'Selective', 'Optional' => 'Optional', 'Islam' => 'Islam', 'Hindu' => 'Hindu', 'Christian' => 'Christian', 'Buddhist' => 'Buddhist', 'Co-Activites' => 'Co-Activites', 'Characteristics' => 'Characteristics'), 'empty' => '--Select--')); ?>
        </div><!-- end of set_wrapper-->
        <div class="clear_both">&nbsp;</div>
    </div><!-- end of block-->
    <div class="clear_both">&nbsp;</div>
</div><!-- end of blockWrapper-->

<!--*************************************** Course cycle part here **********************************************-->
<div class="blockWrapper">
    <div class="block">
        <div class="set_wrapper">
            <?php echo $this->Form->input('CourseCycle.0.id'); ?>
            <?php echo $this->Form->input('CourseCycle.0.level_id', array('id' => 'scms-class', 'label' => 'Class :', 'empty' => '--Select--', 'class' => 'updateDrops', 'data-belongs' => '#scms-group', 'data-depends' => '', 'after' => $this->Html->image("/images/loader/indicator.gif", array("alt" => "", 'class' => 'ajx-loading')))); ?>


            <?php //echo $this->Html->image("/images/loader/indicator.gif", array("alt" =>"",'class'=>'ajx-loading')); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('CourseCycle.0.group_id', array('id' => 'scms-group', 'label' => 'Group :', 'empty' => '--Select--')); ?>
            <!--'disabled'=>TRUE-->	
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
             <?php echo $this->Form->input('CourseCycle.0.school_session_id', array('type' => 'select','options'=>$schoolSessions, 'label'=>'Session')); ?>
            <?php //echo $this->Form->input('CourseCycle.0.school_session_id', array('type' => 'text', 'class' => 'input_Txt', 'readonly' => true, 'value' => (empty($this->request->data['CourseCycle'][0]['school_session_id']) ? date('Y') : $this->request->data['CourseCycle'][0]['school_session_id']))); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('status', array('type' => 'checkbox', 'label' => 'Status:', 'class' => 'input_Txt', 'value' => 1, 'format' => array('before', 'label', 'between', 'input', 'after', 'error'))); ?>
        </div><!-- end of set_wrapper-->
        <!-- end of set_wrapper-->
        <div class="clear_both">&nbsp;</div>
    </div><!-- end of block-->
    <div class="clear_both">&nbsp;</div>
</div>

<div class="blockWrapper">
    <?php
    $ind = array('1st', '2nd', '3rd', '4th');
    foreach ($cTypes as $i => $cType) {
        $j = -1;
        ?>
        <div class="block crsTypeSet" id="crsTypeSet-<?php echo $i; ?>"<?php echo $courseType == $i ? ' style="display:block"' : ''; ?>>
                <?php foreach ($cType as $k => $ttl): $j++; ?> 
                <div class="set_wrapper">
                    <?php
                    echo $this->Form->input("CoursePartsCycle.$i.$k.id");
                    echo $this->Form->input("CoursePartsCycle.$i.$k.title", array('label' => "Title ($ind[$j]) :", 'class' => 'input_Txt', 'value' => $ttl, 'readonly' => 'readonly'));
                    if ($i == 0) {
                        echo $this->Form->input("CoursePartsCycle.$i.$k.number", array('label' => "Number ($ind[$j]):", 'class' => 'input_Txt', 'default'=>0));
                        echo $this->Form->input("CoursePartsCycle.$i.$k.pass_number", array('label' => "Pass Number ($ind[$j]):", 'class' => 'input_Txt', 'default'=>0));
                    } else {
                        echo $this->Form->input("CoursePartsCycle.$i.$k.number", array('type' => 'hidden', 'value' => 1));
                        echo $this->Form->input("CoursePartsCycle.$i.$k.pass_number", array('type' => 'hidden', 'value' => 1));
                    }
                    ?>
                </div><!-- end of set_wrapper-->
    <?php endforeach; ?>
            <div class="clear_both">&nbsp;</div>
        </div><!-- end of block--><?php }
?>
    <div class="clear_both">&nbsp;</div>
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
        <?php echo $this->Form->submit('Save', array('div' => false, 'class' => 'submit1', 'value' => 'Save')); ?>
<?php //echo $this->Form->submit('Save & Next', array( 'div' => false , 'class' => 'submit1' , 'value' => 'Save') );  ?>
    </div><!-- end of editwraper-->
</div>

