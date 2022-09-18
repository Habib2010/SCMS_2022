<?php if (isset($location)): ?>
    <?php $albums = $this->requestAction('albums/getAlbumByLocation/' . $location); ?>

    <?php foreach ($albums as $album): ?>
        <?php

        $photos = array();
        if (isset($album['Photo'])) {
            $photos = $album['Photo'];
        }
        ?>

        <?php foreach ($photos as $photo): ?>
            <?php

            echo $this->Html->image("gallery/large/" . $photo['large'], array(
                "title" => $photo['title'],
                'div' => false,
                'class' => false
                    )
            );
            ?>
        <?php endforeach; ?>
    <?php endforeach; ?>
<?php else: ?>
    <p>Please define location</p>
<?php endif; ?>