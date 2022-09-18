<div class="nodes">
    <?php
    if (count($nodes) == 0) {
        __('No items found.');
    } else {
        foreach ($this->params['named'] as $nn => $nv) {
            $this->Paginator->options['url'][$nn] = $nv;
        }
    }
    ?>
    <h2 style="padding-left: 5px"><?php echo ucwords(str_replace('_',' ',$this->params['type'])); ?></h2>
    <table class="tableNoticeView">
        <tr>
            <th style="width:12%">Date</th>
            <th>Title</th>
            <th>View</th>
        </tr>
    <?php
    foreach ($nodes as $node) {
        $this->Layout->setNode($node);
        $node_title = $lang == 'bn' ? $this->Layout->node('bn_title') : $this->Layout->node('title');
        ?>
        <tr>
            <td><?php echo date("d-m-Y", strtotime($this->Layout->node('created'))); ?></td>
            <td><?php echo $this->Html->link($node_title, $this->Layout->node('url')); ?></td>
            <td><?php echo $this->Html->link(__('View'), $this->Layout->node('url')); ?></td>
        </tr>
            
        <?php
    }
    ?>
    </table>
    <div class="paging"><?php echo $this->Paginator->numbers(); ?></div>
</div>