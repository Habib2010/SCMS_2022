<script type="text/javascript">
            $(document).ready(function() {$("#DepartmentAddForm").validate({
                    rules: {
			password_again: {
                        equalTo: "#UserPassword"
                }
	  }
            });});
</script>
<div class="contentiner">
        <div class="readmarked">
            <ul>
		<li><?php echo $this->Html->link(__('<span>List Departments</span>', true), array('action' => 'index'));?></li>
            </ul>
        </div>

        <?php
        echo $this->Form->create('Department',array('class'=>'regFrom'));
         echo $form->input('Department.id');
        echo $form->input('Department.company_id',array('type'=>'hidden','value'=>$company_id,'div'=>false));
        ?>
                <fieldset>
                    <?php  echo $form->input('Department.name',array('class'=>'inputtxt2 required','label'=>'Name:','div'=>false));?>
                    <em>*</em>
                    <span>(The name of department you wish to add)</span>
                </fieldset>
                <fieldset>
                    <?php  echo $form->input('Department.type',array('class'=>'required','label'=>'Type:','empty'=>'Select..','options'=>$type,'div'=>false));?>
                </fieldset>
                <fieldset>
                    <?php  echo $form->input('Department.leader_id',array('class'=>'required','label'=>'Leader:','empty'=>'Select..','options'=>$leader,'div'=>false));?>
                </fieldset>
                <fieldset>
                    <?php  echo $form->input('work_pattern',array('class'=>'required','label'=>'Work Pattern:','options'=>$pattern,'div'=>false));?>
                </fieldset>
                <fieldset>
                    <?php  echo $form->input('location',array('class'=>'required','label'=>'Location:','empty'=>'Select..','options'=>$location,'div'=>false));?>
                </fieldset>
                <fieldset>
                    <?php  echo $form->input('Department.maximum_staff_on_leave',array('class'=>'inputtxt3 required','label'=>'Maximum Staff on Leave:','div'=>false));?>
                </fieldset>
                <fieldset>
                    <?php  echo $form->input('Department.status',array('label'=>'Active:','div'=>false));?>
                    <span>(Check if you want to activate this department)</span>
                </fieldset>
                <fieldset>
                    <label>&nbsp;</label>
                    <?php echo $this->Form->submit(__('Submit', true)); ?>
                </fieldset>
        <?php echo $this->Form->end(); ?>
</div>