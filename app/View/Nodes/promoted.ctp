<div class="row" id="notice-board">
    <div class="notice-board-bg">
        <h5><?= $lang == 'bn' ? 'নোটিশ বোর্ড' : 'Notice Board'; ?></h5>

        <div id="notice-board-ticker">
            <ul>
                <?php
                foreach ($notices as $notice) {
                    ?>
                    <li>
                        <a href="/nodes/view/<?php echo $notice['Node']['id'] ?>"><?php echo $lang == 'bn' ? $notice['Node']['bn_title'] : $notice['Node']['title']; ?></a>
                    </li>
                <?php } ?>
            </ul>	
            <a class="btn right" href="/notice"><?= $lang == 'bn' ? 'সকল' : 'More'; ?></a>
        </div>
    </div>
</div>
<div class="newsTicker">				            					
    <?php
    // pr($this->Layout->blocks('home_notice'));die;
    echo $this->Layout->blocks('region1');
    ?>
</div>

<div class="smallCont">
    <?php
//     pr($blockArray);die;
    $i = 1;
    foreach ($blockArray as $blocks) {
        if (!empty($blocks[0]) && !empty($blocks['slug'])) {//pr($blocks);die;
            ?><div class="six columns service-box box">
                <h4><?php echo $blocks['slug']; ?></h4>
<!--                <h4>--><?php //echo $lang == 'bn' ? $blocks['Node']['bn_title'] : $block['Node']['title']; ?><!--</h4>-->
                <img src="/deo_panchagarh/images/box<?php echo $i; ?>.jpg" alt="<?php echo $blocks['slug']; ?>" width="110">
                <ul class="caption fade-caption" style="margin:0">
                    <?php
                    foreach ($blocks as $block) {
                        if (!empty($block['Node']['id'])) {
                            ?>
                            <li><a href="/nodes/view/<?php echo $block['Node']['id']; ?>"><?php echo $lang == 'bn' ? $block['Node']['bn_title'] : $block['Node']['title']; ?></a></li>
                            <?php
                        }
                    }
                    ?>
                </ul>
                <a class="btn right" href="/<?php echo $blocks[0]['Node']['type']; ?>"><?= $lang == 'bn' ? 'সকল' : 'More'; ?></a>
            </div>
            <?php
        }
        $i++;
    }
    ?>
</div>
<div class="nodes promoted">
    <?php
    $session = $this->Session->read('Auth');
    foreach ($nodes as $node) {
        ?>
        <?php $this->Layout->setNode($node); ?>
        <div id="node-<?php echo $this->Layout->node('id'); ?>" class="node node-type-<?php echo $this->Layout->node('type'); ?>">
            <?php $title = $lang == 'bn' ? $this->Layout->node('bn_title') : $this->Layout->node('title'); ?>
            <h1><?php echo $this->Html->link($title, $this->Layout->node('url')); ?></h1>
            <div class="">
                <?php
                echo $this->Layout->nodeExcerpt();
                if (!empty($session)) {
                    echo $this->Html->link(__('Edit'), array('admin' => true, 'controller' => 'nodes', 'action' => 'edit', $node['Node']['id']));
                }
                ?>
                <a style="text-align: right; display: inline-block; width: 100%; color:#F19300" href="javascript:;" onClick="readmore('<?php echo $node['Node']['id']; ?>')"  id="click<?php echo $node['Node']['id']; ?>"><?= $lang == 'bn' ? '...আরও দেখুন' : '...Show more'; ?></a>
            </div>
            <div id="des<?php echo $node['Node']['id']; ?>" style="display: none">
                <?php echo $this->Layout->nodeBody(); ?>
            </div>
        </div>
    <?php } ?>

    <div class="paging"><?php echo $this->Paginator->numbers(); ?></div>
</div>
