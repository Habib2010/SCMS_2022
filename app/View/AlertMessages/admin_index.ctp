<div class="departments index">
    <h2>Departments</h2>

    <div class="actions">
        <ul>
            <li><?php echo $html->link(__('New Department', true), array('controller'=>'departments','action'=>'add')); ?></li>
        </ul>
    </div>
    
    <table cellpadding="0" cellspacing="0">
     <?php
        $tableHeaders =  $html->tableHeaders(array(
            $paginator->sort('Department'),
            __('Actions', true),
        ));
        echo $tableHeaders;
        
        $rows = array();
        foreach ($departments AS $department) {
            $actions  = $html->link(__('Edit', true), array('controller' => 'departments', 'action' => 'edit', $department['Department']['id']));
            $actions .= ' ' . $layout->adminRowActions($department['Department']['id']);
            $actions .= ' ' . $html->link(__('Delete', true), array(
                'controller' => 'departments',
                'action' => 'delete',
                $department['Department']['id'],
                'token' => $this->params['_Token']['key'],
            ), null, __('Are you sure?', true));

            $rows[] = array(
               $department['Department']['name'],
                $actions,
            );
        }

        echo $html->tableCells($rows);
        echo $tableHeaders;
    ?>
    </table>
</div>
<div class="paging"><?php echo $paginator->numbers(); ?></div>
<div class="counter"><?php echo $paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true))); ?></div>