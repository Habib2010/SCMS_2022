<?php 
if (empty($modelClass)) {
	$modelClass = Inflector::singularize($this->name);
}
if (!isset($className)) {
	$className = strtolower($this->name);
}
?>
<div class="<?php echo $className; ?> index">
	<h2><?php if ($titleBlock = $this->fetch('title')): ?>
		<?php echo $titleBlock; ?>
	<?php else: ?>
		<?php
		echo !empty($title_for_layout) ? $title_for_layout : $this->name;
		?>
	<?php endif; ?></h2>

	<div class="actions">
		<ul>
			<?php if ($tabsBlock = $this->fetch('tabs')): ?>
				<?php echo $tabsBlock; ?>
			<?php else: ?>
			<li>
				<?php
				echo $this->Html->link(__('New %s', Inflector::singularize($this->name)),
					array('action' => 'add')
				);
				?>
			</li>
			
		</ul>
	</div><?php endif; ?> 
	
	<?php if(!empty($events)): ?>
		<div id="ajax_con">
			<table cellpadding="0" cellspacing="0" >
				<?php
					$tableHeaders =  $this->Html->tableHeaders(array(
						$this->Paginator->sort('id'),
						$this->Paginator->sort('Title'),
						$this->Paginator->sort('Description'),
						$this->Paginator->sort('Start Date'),
						$this->Paginator->sort('End Date'),
						$this->Paginator->sort('Status'),
						$this->Paginator->sort('Created'),
						$this->Paginator->sort('Modified'),							               
						__('Actions', true),
					));
					echo $tableHeaders;
					$rows = array();
					foreach ($events AS $event) {
						$actions  = $this->Html->link(__('Edit', true), array('controller' => 'calendar_events', 'action' => 'edit', $event['CalendarEvent']['id']));
						$actions .= ' ' . $this->Layout->adminRowActions($event['CalendarEvent']['id']);
						$actions .= ' ' . $this->Form->postLink(__('Delete', true), array(
							'controller' => 'calendar_events',
							'action' => 'delete',
							$event['CalendarEvent']['id'],
						), null, __('Are you sure?', true));					
						
						//$created= $event['CalendarEvent']['created'];
						//$thumbnail= $this->Html->image('event/thumbnail/'.$event['CalendarEvent']['thumbnail']);
						$status=$event['CalendarEvent']['status'];     
						if($status==1){
							 $st = $this->Html->image('icons/tick.png');
						}
						else{
							$st = $st=$this->Html->image('icons/cross.png');
						}
						
						$rows[] = array(
							$event['CalendarEvent']['id'],
							$event['CalendarEvent']['title'],
							//$thumbnail,							
							$event['CalendarEvent']['description'],
							$event['CalendarEvent']['start_date'],
							$event['CalendarEvent']['end_date'],
							$st,
							$event['CalendarEvent']['created'],							
							$event['CalendarEvent']['modified'],                   
							$actions,
						);
					}
					echo $this->Html->tableCells($rows);
					echo $tableHeaders;
				?>
			</table>
		   
		   
		   
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
		</div>
	<?php endif ;?>
</div>
