<div class="nodes promoted">
    
    <?php $nodes = array_reverse($nodes); ?>
    <?php foreach ($nodes as $node) { ?>
        <?php $this->Layout->setNode($node); ?>
        <div id="node-<?php echo $this->Layout->node('id'); ?>" class="node node-type-<?php echo $this->Layout->node('type'); ?>">
            <h1><?php echo $this->Html->link($this->Layout->node('title'), $this->Layout->node('url')); ?></h1>
            <div class="node-excerpt">
			<?php echo $this->Layout->nodeBody(); ?>
              
              </div>
             
        </div>
    <?php } ?>

    <div class="paging"><?php echo $this->Paginator->numbers(); ?></div>
</div>