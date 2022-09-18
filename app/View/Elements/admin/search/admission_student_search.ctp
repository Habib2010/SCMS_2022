
                <div class="formTopWrapper">
                	<div class="displayWrapper"<?php if( empty($students) || !empty($this->request->data) || !empty($this->params->query) ) echo ' style="display:block"'; ?>>
                    	<?php echo $this->Form->create('Admission',array('action'=>'index','type'=>'get')); ?>
                            <div class="set_wrapper">
                                <?php /*<div class="infofoset itemfirstset">
                                    <?php echo $this->Form->input('student_id',array('label'=>'Name','empty' => 'Select Name')); ?>
                                </div><!-- end of infofoset-->*/ ?>
                                
                                <div class="infofoset itemfirstset">
                                    <?php //echo $this->Form->input('level_id',array('id'=>'scms-class','class'=>'updateDrops','label'=>'** Class','empty' => 'Select Class','data-belongs'=>'#scms-group,#scms-section','data-depends'=>'')); ?>
                                    <?php //echo $this->Html->image("/images/loader/indicator.gif", array("alt" =>"",'class'=>'ajx-loading')); ?>
                                    <?php echo $this->Form->input('ref',array('type'=>'text','class'=>'input_Txt', 'label'=>'Ref :','style'=>'width:52%')); ?>
                                </div><!-- end of infofoset-->
                                <div class="infofoset">
                                    <?php echo $this->Form->input('level',array('type'=>'select','label'=>'Class','empty' => 'Select Class')); ?>
                                </div><!-- end of infofoset-->
                                <div class="infofoset itemlastset">
                                    <?php echo $this->Form->input('roll',array('type'=>'text','class'=>'input_Txt top-search', 'label'=>'Roll :')); ?>
                                </div><!-- end of infofoset-->
                            </div><!-- end of set_wrapper-->
                            <div class="set_wrapper">
                            	<div class="infofoset itemfirstset">
                                    <?php //echo $this->Form->input('term_id',array('id'=>'scms-term','label'=>'** Term','empty' => 'Select Term')); ?>
                                    <?php echo $this->Form->input('Payment.trxId',array('type'=>'text','class'=>'input_Txt', 'label'=>'TrxId :','style'=>'width:52%')); ?>
                                </div><!-- end of infofoset-->
                                <div class="infofoset">
                                    <?php echo $this->Form->input('shift',array('label'=>'Shift','empty' => 'Select Shift')); ?>
                                </div><!-- end of infofoset-->
                                <div class="infofoset itemlastset">
                                    <?php echo $this->Form->input('mobile',array('type'=>'text','class'=>'input_Txt top-search', 'label'=>'Mobile :')); ?>
                                </div><!-- end of infofoset-->
                            </div><!-- end of set_wrapper-->
                            <div class="set_wrapper">
                                <div class="infofoset itemfirstset">
                                    <?php //echo $this->Form->input('school_session_id',array('label'=>'** Session','empty' => 'Select Session','default'=>date('Y'))); ?>
                                    <?php echo $this->Form->input('name',array('type'=>'text','class'=>'input_Txt', 'label'=>'Name (%_%) :','style'=>'width:52%')); ?>
                                </div><!-- end of infofoset-->
                                <div class="infofoset">
                                    <?php echo $this->Form->input('session',array('type'=>'date','label'=>'Session','empty'=>'Select Session','selected'=>array('year'=>date('Y',strtotime('+1 year'))),'dateFormat'=>'Y','minYear'=>2013,'maxYear'=>date('Y'),'name'=>'session')); ?>
                                </div><!-- end of infofoset-->
                                <div class="infofoset itemlastset">
                                    <?php echo $this->Form->input('room',array('type'=>'select','label'=>'Room','empty'=>'Select room', 'options'=>$list)); ?>
                                </div><!-- end of infofoset-->
                                <div class="infofoset itemlastset " style="float: right">
                                    <?php echo $this->Form->submit('Search', array( 'div' => false , 'class' => 'submit_Btn' , 'value' => 'Search') ); ?>
                                </div><!-- end of infofoset-->
                            </div><!-- end of set_wrapper-->
                         
                            <div class="clear_both">&nbsp;</div>
                        <?php echo $this->Form->end(); ?>
                    </div><!-- end of displayWrapper-->
                    <div class="arrowwrapper">
                    	<a class="close1" href="javascript:void(0);">&nbsp;</a>
                    </div><!-- end of arrowwrapper-->
               
                </div><!-- end of formTopWrapper-->
