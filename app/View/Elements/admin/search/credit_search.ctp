<div class="formTopWrapper">
    <div class="displayWrapper"<?php if (!empty($credits) || !empty($this->request->data) || !empty($this->params->query)) echo ' style="display:block"'; ?>>
        <?php echo $this->Form->create('Credit', array('action' => 'index', 'type' => 'get')); ?>
        <div class="set_wrapper">
            <?php /* <div class="infofoset itemfirstset">
              <?php echo $this->Form->input('student_id',array('label'=>'Name','empty' => 'Select Name')); ?>
              </div><!-- end of infofoset--> */ ?>

            <div class="infofoset itemfirstset">
                <?php
                echo $this->Form->input('purpose_id', array('label' => ' Purpose :', 'options' => $purposeName, 'empty' => '-----Select Purpose-----'));
                ?>
            </div><!-- end of infofoset-->
            <div class="infofoset">
                <?php
                echo $this->Form->input('sid', array('label' => 'Student Id', 'type' => 'text', 'class' => 'input_Txt', 'style' => 'width:52%'));
                ?>
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset">
              <?php
                echo $this->Form->input('voucher_no', array('label' => 'Voucher No', 'type' => 'text', 'class' => 'input_Txt', 'style' => 'width:52%'));
                ?>
            </div><!-- end of infofoset-->
        </div><!-- end of set_wrapper-->
    
        <div class="set_wrapper">
            <div class="infofoset itemfirstset">
                <?php
                echo $this->Form->input('credit_date', array('label' => 'Date', 'type' => 'text', 'class' => 'input_Txt', 'style' => 'width:52%', 'id'=>'datepicker'));
                ?>
            </div><!-- end of infofoset-->
            <div class="infofoset">
               <?php
                echo $this->Form->input('money_receipt', array('label' => 'Money Receipt', 'type' => 'text', 'class' => 'input_Txt', 'style' => 'width:52%'));
                ?>
            </div><!-- end of infofoset-->
            <div class="infofoset itemlastset">
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

