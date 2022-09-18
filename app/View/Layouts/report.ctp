<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php echo $title_for_layout; ?> - <?php echo __('NGO'); ?></title>
	
	<?php
		echo $this->Html->css(array(
			'reset',
			'960',
			'/ui-themes/smoothness/jquery-ui.css',
			'admin',
			'thickbox',
			'report',
		));
		echo $this->Layout->js();
		echo $this->Html->script(array(
			'jquery/jquery.min',
			'jquery/jquery.slug',
			'jquery/jquery.cookie',
			'jquery/jquery.hoverIntent.minified',
			'jquery/superfish',
			'jquery/supersubs',
			'jquery/jquery.tipsy',
			'jquery/jquery.elastic-1.6.1.js',
			'jquery/thickbox-compressed',
			'jquery/jquery.validate',
			'ngo',
			'ngo/report',
		)); 
		
		
		echo $this->Blocks->get('css');
		echo $this->Blocks->get('script');
		
	?>
	
	<script type="text/javascript">	
		function getTableRows(pid,tid, prokolpo, rs){ 
			if(!rs){
				rs= 1;
			}
			var headRow = '<tr class="rowHead pid_'+ pid +' tid_'+ tid +'" pid="'+pid+'" tid="'+tid+'">';
			headRow =  headRow + '<td class="rowspan" rowspan="'+ rs +'"> <div class="minusHead"><span>-</span></div><?php echo $this->Form->input('Prokolpo.0.title',array('div' => false, 'value'=>'', 'class' => 'input required', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 30 )); ?></td>' +
					'<td class="rowspan" rowspan="'+ rs +'"><?php echo $this->Form->input('Prokolpo.0.district_name',array('div' => false,  'value'=>'', 'label' => false , 'class' => 'input required', 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td class="rowspan" rowspan="'+ rs +'"><?php echo $this->Form->input('Prokolpo.0.start_date',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td class="rowspan" rowspan="'+ rs +'"><?php echo $this->Form->input('Prokolpo.0.end_date',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.kormosuchi',array('div' => false, 'label' => false , 'value'=>'', 'class' => 'input required', 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><div class="apnd"><span>+</span></div><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.prokolpo_ka',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.annual_kha',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.month_ga',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.considerate_month',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.pr1',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.annual_ka',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.pr2',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.prokolpo_ga',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.pr3',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td class="rowspan" rowspan="'+ rs +'"><?php echo $this->Form->input('Prokolpo.0.money_source',array('div' => false, 'value'=>'', 'class' => 'input required', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.alocated_money',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.current_month_cost',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.cromopunji_cost',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.pr4',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.rest_part',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td class="rowspan" rowspan="'+ rs +'"><?php echo $this->Form->input('Prokolpo.0.comment',array('div' => false, 'value'=>'', 'class' => 'input required', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>';
				
				
			headRow =  headRow + '</tr>';
			headRow = headRow.split('ProkolpoTask0').join('ProkolpoTask'+tid+'');
			headRow = headRow.split('[ProkolpoTask][0]').join('[ProkolpoTask]['+tid+']');
			headRow = headRow.split('Prokolpo0').join('Prokolpo'+pid+'');
			headRow = headRow.split('[Prokolpo][0]').join('[Prokolpo]['+pid+']');
			
			var subRow = '<tr class="pid_'+ pid +' tid_'+ tid +'" pid="'+pid+'" tid="'+tid+'">' +
					'<td><div class="minus"><span></span></div> <?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.kormosuchi',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.prokolpo_ka',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.annual_kha',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.month_ga',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.considerate_month',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.pr1',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.annual_ka',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.pr2',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.prokolpo_ga',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.pr3',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.alocated_money',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.current_month_cost',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.cromopunji_cost',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.pr4',array('div' => false, 'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +
					'<td><?php echo $this->Form->input('Prokolpo.0.ProkolpoTask.0.rest_part',array('div' => false,'value'=>'', 'label' => false , 'type' => 'textarea' , 'rows' => 2 , 'cols' => 20 )); ?></td>' +	
				'</tr>';
				
			subRow = subRow.split('ProkolpoTask0').join('ProkolpoTask'+tid+'');
			subRow = subRow.split('[ProkolpoTask][0]').join('[ProkolpoTask]['+tid+']');
			subRow = subRow.split('Prokolpo0').join('Prokolpo'+pid+'');
			subRow = subRow.split('[Prokolpo][0]').join('[Prokolpo]['+pid+']');	
			if(prokolpo){ 
				return headRow;
			}
			else{
				return subRow;
			}
		}
	</script>

</head>

<body>

	<div id="wrapper">
		<?php echo $this->element('admin/header'); ?>

		<div id="nav-container">
			<div class="container_16">
				<?php echo $this->element("admin/navigation"); ?>
			</div>
		</div>

		<div id="main" class="container_16">
			<div class="grid_16">
				<div id="content">
					<?php
						echo $this->Layout->sessionFlash();
						echo $content_for_layout;
					?>
				</div>
			</div>
			<div class="clear">&nbsp;</div>
		</div>
		
		<div class="push"></div>
	</div>

	<?php echo $this->element('ngo/footer'); ?>
	<?php
		echo $this->Blocks->get('scriptBottom');
		echo $this->Js->writeBuffer();
	?>
	</body>
</html>