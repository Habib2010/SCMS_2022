<div class="albums index">
    <h2><?php echo $title_for_layout; ?></h2>
    <div class="formWrapper">
        <div class="parentwrapper">
            <?php echo $this->element('admin/search/text_search'); ?><br />
            <div class="actions">
                <ul>
                    <li><?php echo $this->Html->link(__('New Student Result Text', 'New Student Result Text', true), array('action' => 'add')); ?></li>
                </ul>
            </div>

            <table cellpadding="0" cellspacing="0">
                <?php
                $tableHeaders = $this->Html->tableHeaders(array(
                    $this->Paginator->sort('id'),
                    $this->Paginator->sort('Text.level_id', 'Department'),
                    $this->Paginator->sort('Text.group_id', 'Semister'),
                    $this->Paginator->sort('Text.school_term_id', 'Term'),
                    $this->Paginator->sort('Text.school_session_id', 'Session'),
                    __('Actions', true),
                        ));

                echo $tableHeaders;

                $rows = array();
                foreach ($texts as $text) {
                    $actions = ' ' . $this->Layout->adminRowActions($text['Text']['id']);
                    $actions .= ' ' . $this->Html->link(__('Edit', true), array('controller' => 'texts', 'action' => 'edit', $text['Text']['id']));
                    $actions .= ' ' . $this->Form->postLink(__('Delete', true), array('controller' => 'texts', 'action' => 'delete', $text['Text']['id']), null, __('Are you sure you want to delete this bank?', true));

                    $rows[] = array(
                        $text['Text']['id'],
                        $text['Level']['name'],
                        $text['Group']['name'],
                        $text['SchoolTerm']['name'],
                        $text['Text']['school_session_id'],
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
</div>

