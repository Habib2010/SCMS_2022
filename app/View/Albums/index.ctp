<h2>গ্যালারি</h2>
<?php if (!count($albums)): ?>
    <?php echo __('No album found.'); ?>
<?php else: ?>
    <ul class="gallery">
        <?php foreach ($albums as $album): ?>
            <li>
                <a href="<?php echo $this->Html->url(array('controller' => 'albums', 'action' => 'view', $album['Album']['slug'])); ?>" class="boxalbum">
                    <span><img src="<?php echo $this->webroot; ?>img/gallery/thumbnail/<?php if (isset($album['Photo'][0]['thumbnail'])) echo $album['Photo'][0]['thumbnail']; else echo 'default.jpg'; ?>" alt="<?php echo $album['Album']['title']; ?>" /></span>
                    <big><em><?php echo count($album['Photo']); ?></em> <?php echo $album['Album']['title']; ?></big>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php $count = $this->request['paging']['Album']['pageCount']; ?>
    <?php if ($count >= 2): ?>
        <?php if ($pagingBlock = $this->fetch('paging')): ?>
            <?php echo $pagingBlock; ?>
        <?php else: ?>
            <?php if (isset($this->Paginator) && isset($this->request['paging'])): ?>
                <div class="paging">
                    <?php echo $this->Paginator->first('< ' . __('first')); ?>
                    <?php echo $this->Paginator->prev('< ' . __('prev')); ?>
                    <?php echo $this->Paginator->numbers(array('separator' => '-')); ?>
                    <?php echo $this->Paginator->next(__('next') . ' >'); ?>
                    <?php echo $this->Paginator->last(__('last') . ' >'); ?>
                </div>
            <?php endif; ?>
        <?php endif; ?> 
    <?php endif; ?>
<?php endif; ?>	