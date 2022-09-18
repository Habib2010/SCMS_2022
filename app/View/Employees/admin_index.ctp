<?php
//pr($employees);
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
            echo!empty($title_for_layout) ? $title_for_layout : $this->name;
            ?>
        <?php endif; ?></h2>

    <div class="actions">
        <ul>
            <?php if ($tabsBlock = $this->fetch('tabs')): ?>
                <?php echo $tabsBlock; ?>
            <?php else: ?>
                <li>
                    <?php
                    echo $this->Html->link(__('New %s', Inflector::singularize($this->name)), array('action' => 'add')
                    );
                    ?>
                </li>

            </ul>
        </div><?php endif; ?> 
    <div class="filter">
        <?php
        echo $this->Form->create('Employee');
        echo $this->Form->input('User.username');
        echo $this->Form->input('User.role_id', array('empty' => ''));
        echo $this->Form->input('Employee.status', array('empty' => '', 'options' => array(1 => 'কর্মরত', 2 => 'প্রাক্তন')));
        echo $this->Form->end(__('Search'));
        ?>
        <div class="clear"> </div>
    </div>
    <?php if (!empty($employees)): ?>
        <div id="ajax_con">
            <table cellpadding="0" cellspacing="0" >
                <?php
                $tableHeaders = $this->Html->tableHeaders(array(
                    $this->Paginator->sort('id'),
                    $this->Paginator->sort('name'),
                    $this->Paginator->sort('picture'),
                    $this->Paginator->sort('designation'),
                    $this->Paginator->sort('phone'),
                    $this->Paginator->sort('email'),
                    $this->Paginator->sort('join_date'),
                    $this->Paginator->sort('status'),
                    $this->Paginator->sort('created'),
                    __('Actions', true),
                        ));
                echo $tableHeaders;
                $rows = array();
                foreach ($employees AS $employee) {

                    $status = $employee['Employee']['status'];
                    if ($status == 1) {
                        $st = $this->Html->image('icons/tick.png');
                        $mark = 'কর্মরত';
                    } else {
                        $st = $st = $this->Html->image('icons/cross.png');
                        $mark = 'প্রাক্তন';
                    }

                    $actions = $this->Html->link(__($mark, true), array('controller' => 'employees', 'action' => 'mark', $employee['Employee']['id']));
                    $actions .= '<br/>';
                    $actions .= $this->Html->link(__('Move up'), array('controller' => 'employees', 'action' => 'moveup', $employee['Employee']['id']));
                    $actions .= ' ' . $this->Html->link(__('Move down'), array('controller' => 'employees', 'action' => 'movedown', $employee['Employee']['id']));
                    $actions .= $this->Html->link(__('Edit', true), array('controller' => 'employees', 'action' => 'edit', $employee['Employee']['id']));
                    $actions .= ' ' . $this->Layout->adminRowActions($employee['Employee']['id']);
                    $actions .= ' ' . $this->Form->postLink(__('Delete', true), array(
                                'controller' => 'employees',
                                'action' => 'delete',
                                $employee['Employee']['id'],
                                    ), null, __('Are you sure?', true));

                    $created = $employee['Employee']['created'];
                    $thumbnail = $this->Html->image('employee/thumbnail/' . $employee['Employee']['thumbnail']);

                    $rows[] = array(
                        $employee['Employee']['id'],
                        $employee['Employee']['name'],
                        $thumbnail,
                        $employee['Employee']['designation'],
                        $employee['Employee']['phone'],
                        $employee['User']['email'],
                        $employee['Employee']['join_date'],
                        $st,
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
    <?php endif; ?>
</div>
