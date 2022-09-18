<div class="albums index">
    <h2><?php echo $title_for_layout; ?></h2>

    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New Album', 'New album', true), array('action' => 'add')); ?></li>
        </ul>
    </div>

    <table cellpadding="0" cellspacing="0">
        <?php
        $tableHeaders = $this->Html->tableHeaders(array(
            $this->Paginator->sort('id'),
            $this->Paginator->sort('title'),
            $this->Paginator->sort('location'),
            $this->Paginator->sort('type'),
            $this->Paginator->sort('position'),
            $this->Paginator->sort('status'),
            __('Actions', true),
                ));

        echo $tableHeaders;

        $rows = array();
        foreach ($albums as $album) {
            $actions = ' ' . $this->Layout->adminRowActions($album['Album']['id']);
            $actions .= ' ' . $this->Html->link(__('Edit', true), array('controller' => 'albums', 'action' => 'edit', $album['Album']['id']));
            $actions .= ' ' . $this->Form->postLink(__('Delete', true), array('controller' => 'albums', 'action' => 'delete', $album['Album']['id']), null, __('Are you sure you want to delete this album?', true));

            $rows[] = array(
                $album['Album']['id'],
                $album['Album']['title'],
                $album['Album']['location'],
                $album['Album']['type'],
                $album['Album']['position'],
                $this->Layout->status($album['Album']['status']),
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


