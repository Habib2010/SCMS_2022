<?php //pr($link);?>
            <ul>
                <?php foreach ($link as $link):
                    $link_title = $lang == 'bn' ? $link['Link']['bn_title'] : $link['Link']['title'];
                    ?>
                    <li><?php echo $this->Html->link($link_title, $link['Link']['link'], array('escape' => false)); ?></li>

                <?php endforeach; ?>
            </ul>
