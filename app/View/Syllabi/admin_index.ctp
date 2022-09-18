<?php
//pr($attendances);
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
   
   

    <div id="ajax_con">
        <table cellpadding="0" cellspacing="0" >
            <?php
                $tableHeaders =  $this->Html->tableHeaders(array(
                    $this->Paginator->sort('id'),
					$this->Paginator->sort('Name'),
                    $this->Paginator->sort('Course'),					
                    $this->Paginator->sort('Created'),					               
                    __('Actions', true),
                ));
                echo $tableHeaders;
                $rows = array();
                foreach ($syllabuses AS $syllabus) {
                    $actions  = $this->Html->link(__('Edit', true), array('controller' => 'syllabi', 'action' => 'edit', $syllabus['Syllabus']['id']));
                    $actions .= ' ' . $this->Layout->adminRowActions($syllabus['Syllabus']['id']);
                    $actions .= ' ' . $this->Form->postLink(__('Delete', true), array(
                        'controller' => 'Syllabi',
                        'action' => 'delete',
                        $syllabus['Syllabus']['id'],
                    ), null, __('Are you sure?', true));
					
					
					$id = $syllabus['Syllabus']['id'];               
                    $name = $syllabus['Syllabus']['title'];
                    $created= $syllabus['Syllabus']['created'];
                    $rows[] = array(
                        $id,
                        $name,
						$syllabus['Course']['name'],
                        $created,                   
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
</div>