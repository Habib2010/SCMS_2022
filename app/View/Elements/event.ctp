<?php $events = $this->requestAction('nodes/event'); ?>

<ul class="newsCont">
    <?php foreach ($events as $event) : ?>
        <li>

            <div class="nwsLft">
                <?php echo $this->Html->image("/img/date.png", array("alt" => "")); ?>
                <span><?php
            $month = substr($event['Node']['created'], 5, 2);
            $date = substr($event['Node']['created'], 8, 2);
            $eng_month = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
            foreach ($eng_month as $x => $value) {
                if ($month == $x + 1) {
                    $month_res = $value;
                }
            }
            echo $date . '&nbsp;' . $month_res;
                ?>

                </span>
            </div>
            <div class="nwsRgt">
                <p><?php
                $title = substr($event['Node']['title'], 0, 68);
                echo $this->Html->link($title, array(
                    'admin' => false,
                    'controller' => 'nodes',
                    'action' => 'view',
                    'type' => $event['Node']['type'],
                    'slug' => $event['Node']['slug'],
                    
                ));
                ?></p>
            </div>
        </li>
    <?php endforeach; ?>
</ul>
<div class="more" >
 <?php echo $this->Html->link('more...', '/events', array('id' => 'more')) ?>
</div>