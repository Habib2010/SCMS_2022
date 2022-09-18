<?php if (!empty($actionEdit)) {//$this->action == 'admin_edit' ){  ?>
    <div class="blockWrapper">
        <div class="leftblock">
            <div class="idwrapper">
                <h4>Fees Payment ID:</h4>
                <div class="submit_Btn"><?php echo $this->request->data['BkashPayment']['id']; ?></div>
            </div><!-- end of idwrapper-->
        </div><!-- end of leftblock-->
        <div class="clear_both">&nbsp;</div>
    </div><!-- end of blockWrapper-->
<?php } ?>

<!-- ********************************** Father ***********************************************-->
<div class="blockWrapper">
    <div class="block">
        <div class="set_wrapper">
            <?php echo $this->Form->input('ref', array('type' => 'text', 'class' => 'input_Txt')); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('trxId', array('type' => 'text', 'class' => 'input_Txt')); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('sender', array('type' => 'text', 'class' => 'input_Txt')); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('receiver', array('type' => 'text', 'class' => 'input_Txt', 'default' => '01705806080')); ?>
        </div><!-- end of set_wrapper-->
        <div class="set_wrapper">
            <?php echo $this->Form->input('amount', array('type' => 'text', 'class' => 'input_Txt')); ?>
        </div><!-- end of set_wrapper-->
        <div class="clear_both">&nbsp;</div>
    </div><!-- end of block-->
    <div class="clear_both">&nbsp;</div>
</div><!-- end of blockWrapper-->


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
        <?php //echo $this->Form->submit('Save & Next', array( 'div' => false , 'class' => 'submit1' , 'value' => 'Save') ); ?>
    </div><!-- end of editwraper-->
</div>
