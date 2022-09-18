
                <div class="formTopWrapper">
                	<div class="displayWrapper"<?php if( empty($students) || !empty($this->request->data) ) echo ' style="display:block"'; ?>>
                    	<?php echo $this->Form->create('Admission',array('url' => array('controller'=>'admissions', 'action' => 'admission_room', 'admin'=>true))); ?>
                            <div class="set_wrapper">
                                <div class="infofoset itemfirstset">
                                         <?php echo $this->Form->input('room',array('type'=>'select','label'=>'Room','empty'=>'Select room', 'options'=>$list)); ?>
                                </div><!-- end of infofoset-->
                                <div class="infofoset">
                                    
                                </div><!-- end of infofoset-->
                                <div class="infofoset itemlastset">
                                    
                                </div><!-- end of infofoset-->
                            </div><!-- end of set_wrapper-->
                
                            <div class="set_wrapper">
                                <div class="infofoset itemlastset" id="admit">
                                    <!--<input type="submit" value="Search" class="submit_Btn" />-->
                                    <?php echo $this->Form->submit('Search', array( 'div' => false , 'class' => 'submit_Btn' , 'value' => 'Search') ); ?>
                                </div><!-- end of infofoset-->
                            
                        <?php echo $this->Form->end(); ?>
                       </div>     
                            <div class="clear_both">&nbsp;</div>
                    </div><!-- end of displayWrapper-->
                    <div class="arrowwrapper">
                    	<a class="close1" href="javascript:void(0);">&nbsp;</a>
                    </div><!-- end of arrowwrapper-->
               
                </div><!-- end of formTopWrapper-->
