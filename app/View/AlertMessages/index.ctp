<script type="text/javascript">
        $(document).ready(
            function() {
                //clicking the parent checkbox should check or uncheck all child checkboxes
                $(".chkBox_2").click(
                    function() {
                        $(this).parents('fieldset:eq(0)').find('.chkBox_1').attr('checked', this.checked);
                    }
                );
                //clicking the last unchecked or checked checkbox should check or uncheck the parent checkbox
                $('.chkBox_1').click(
                    function() {
                        if ($(this).parents('fieldset:eq(0)').find('.chkBox_2').attr('checked') == true && this.checked == false)
                            $(this).parents('fieldset:eq(0)').find('.chkBox_2').attr('checked', false);
                        if (this.checked == true) {
                            var flag = true;
                            $(this).parents('fieldset:eq(0)').find('.chkBox_1').each(
                              function() {
                                  if (this.checked == false)
                                      flag = false;
                              }
                            );
                            $(this).parents('fieldset:eq(0)').find('.chkBox_2').attr('checked', flag);
                        }
                    }
                );
            }
        );
        function submitMarkForm()
        {
            var value = document.getElementById("mark").value;
            $("#action").html("<input id='AlertMessageAction' type='hidden' value='" + value + "' name='data[action]'>");
            document.forms["AlertMessageIndexForm"].submit();
        }
        function submitUnmarkForm()
        {
            var value = document.getElementById("unmark").value;
            $("#action").html("<input id='AlertMessageAction' type='hidden' value='" + value + "' name='data[action]'>");
            document.forms["AlertMessageIndexForm"].submit();
        }
        function submitDeleteForm()
        {
            var value = document.getElementById("delete").value;
            $("#action").html("<input id='AlertMessageAction' type='hidden' value='" + value + "' name='data[action]'>");
            document.forms["AlertMessageIndexForm"].submit();
        }
</script>
<div class="contentiner container2">
      <div class="readmarked">
            <ul>
                 <li><a href="javascript: submitMarkForm()"><span>Mark as Read</span></a></li>
                 <li><a href="javascript: submitUnmarkForm()"><span>Mark as Unread</span></a></li>
                 <li><a href="javascript: submitDeleteForm()"><span>Delete</span></a></li>
            </ul>
      </div><!--end of readmarked-->

      <?php echo $this->Form->create('AlertMessage',array('action'=>'index','class'=>'inboxFrm')); ?>
            <fieldset><legend></legend>
            <div id="action">
                <input type="hidden" id="mark" value="mark">
                <input type="hidden" id="unmark" value="unmark">
                <input type="hidden" id="delete" value="delete">
            </div>
            <table width="" cellpadding="0" cellspacing="0" border="0" class="tbl">
                   <tr class="thead">
                       <th  class="first" width="20" align="left"><input type="checkbox" class="chkBox_2" /></th>
                       <th width="300" align="left"><?php echo $this->Paginator->sort('from'); ?></th>
                       <th width="500" align="left"><?php echo $this->Paginator->sort('subject'); ?></th>
                       <th width="145" align="left" class="last"><?php echo $this->Paginator->sort('Received','created'); ?></th>
                   </tr>
                   <?php $i=0; foreach($alertMessages as $alertMessage){ ?>
                   <tr>
                       <td  class="first" width="20" align="left"><?php echo $this->Form->input('message_id'.$i,array('label'=>false,'type'=>'checkbox','class'=>'chkBox_1','value'=>$alertMessage['AlertMessage']['id'])); ?></td>
                       <td width="300" align="left"><?php if(isset($alertMessage['Employee']['name'])) echo $alertMessage['Employee']['name']; else echo 'System Administrator'; ?>&nbsp;</td>
                       <td width="500" align="left"><span><a href="<?php echo $this->Html->url('/alert_messages/preview/'.$alertMessage['AlertMessage']['id']); ?>"><?php if($alertMessage['AlertMessage']['status']==0) echo '<b>'.$alertMessage['AlertMessage']['subject'].'</b>'; else echo $alertMessage['AlertMessage']['subject']; ?></a></span>&nbsp;</td>
                       <td width="145" align="left" class="last"><?php
                       if(!empty($alertMessage['AlertMessage']['created'])) { 
                           echo $this->Time->format('d-m-Y h:i:s A', $alertMessage['AlertMessage']['created'], null, $time_zone); 
                       }
                       ?>&nbsp;</td>
                    </tr>
                    <?php $i++; } ?>
                    <tr class="media">
                        <td colspan="4" class="full">
						<?php if ($pagingBlock = $this->fetch('paging')): ?>
							<?php echo $pagingBlock; ?>
						<?php else: ?>
							<?php if (isset($this->Paginator) && isset($this->request['paging'])): ?>
								<div class="paging">
									<?php echo $this->Paginator->first('< ' . __('first')); ?>
									<?php echo $this->Paginator->prev('< ' . __('prev')); ?>
									<?php echo $this->Paginator->numbers(); ?>
									<?php echo $this->Paginator->next(__('next') . ' >'); ?>
									<?php echo $this->Paginator->last(__('last') . ' >'); ?>
								</div>
								<div class="counter"><?php echo $this->Paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%'))); ?></div>
							<?php endif; ?>
						<?php endif; ?>
					    </td>
                     </tr>
            </table>
		</fieldset>
      <?php echo $this->Form->end(); ?>
      <div class="readmarked">
          <ul>
                <li><a href="javascript: submitMarkForm()"><span>Mark as Read</span></a></li>
                <li><a href="javascript: submitUnmarkForm()"><span>Mark as Unread</span></a></li>
                <li><a href="javascript: submitDeleteForm()"><span>Delete</span></a></li>
          </ul>
      </div><!--end of readmarked-->
</div><!--end of contentiner-->