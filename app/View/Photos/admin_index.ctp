<h2><?php echo $title_for_layout; ?></h2>

<div class="index">	
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Add Gallery Image', 'Gallery image', true), array('action' => 'add')); ?></li>
        </ul>
    </div>

    <div id="ajax_con">
        <table cellpadding="0" cellspacing="0" >
            <?php
            $tableHeaders = $this->Html->tableHeaders(array(
                $this->Paginator->sort('id'),
                $this->Paginator->sort('Image'),
                $this->Paginator->sort('Gallery Name'),
                $this->Paginator->sort('Created'),
                __('Actions', true),
                    ));
            echo $tableHeaders;
            $rows = array();
            foreach ($photos AS $gallery) {
                $actions = $this->Html->link(__('Edit', true), array('controller' => 'photos', 'action' => 'edit', $gallery['Photo']['id']));
                $actions .= ' ' . $this->Layout->adminRowActions($gallery['Photo']['id']);
                $actions .= ' ' . $this->Form->postLink(__('Delete', true), array(
                            'controller' => 'photos',
                            'action' => 'delete',
                            $gallery['Photo']['id'],
                                ), null, __('Are you sure?', true));

                $created = $gallery['Photo']['created'];
                $thumbnail = $this->Html->image('gallery/thumbnail/' . $gallery['Photo']['thumbnail']);
                $rows[] = array(
                    $gallery['Photo']['id'],
                    $thumbnail,
                    $gallery['Album']['title'],
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
