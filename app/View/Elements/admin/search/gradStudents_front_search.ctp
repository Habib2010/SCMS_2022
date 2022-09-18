
<div class="infoWrap">
    <?php echo $this->Form->create('GradStudents', array('action' => 'index', 'type' => 'get')); ?>
    <div class="addFormWrap">
	<div class="addformCont">
	    <div class="addformLft" style="float: none;width: 85%;margin: 0 auto;">
		<div class="formHighlight">
			<div class="rowDivider">
			    <div class="leftside" >
				<label>Diploma Board Roll <?php echo $this->Form->text('roll', array('type' => 'text', 'class' => 'field1')); ?></label>
				<label>Name(%_%) <?php echo $this->Form->text('name', array('type' => 'text', 'class' => 'field1')); ?></label>
			    </div>
			    <div class="rightside" >
				<label>Passing Year 
				    <?php
				    echo $this->Form->input('passing_year', array(
					'div' => false,
					'label' => false,
					'type' => 'text',
					'id' => 'datepicker_year',
					'class' => 'field1'
				    ));
				    ?>
				</label>

				<label>Department <?php echo $this->Form->input('level_id', array('type' => 'select', 'div' => false, 'label' => false, 'empty' => '---SELECT DEPARTMENT---', 'options' => $depts, 'style' => 'margin-right:0;width:55%;')); ?></label>
			    </div>
			</div>
			<div class="" style="width: 30%;margin: 0 auto;">
			    <?php echo $this->Form->submit('Search', array('class' => 'upload', 'div' => false, 'style' => 'margin-bottom:5%;')); ?>
			<!--</div> end of infofoset-->
			<?php echo $this->Form->end(); ?>
		</div>
	    </div>
	</div>
    </div><!-- end of displayWrapper-->             
</div><!-- end of formTopWrapper-->

<script>
    
    (function() {
    $( "#datepicker_year" ).datepicker({
	    //changeMonth: true,
	    changeYear: true,
            showButtonPanel: true,
	    dateFormat: 'yy',
	    yearRange: "1964:" + new Date().getFullYear(), // max range set to current year.
	    onClose: function(dateText, inst) { 
		var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
		$(this).datepicker('setDate', new Date(year, 1));
	    }
	    
    });
     $("#datepicker_year").focus(function () {
        $(".ui-datepicker-month").hide();
        $(".ui-datepicker-calendar").hide();
    });
});

</script>
