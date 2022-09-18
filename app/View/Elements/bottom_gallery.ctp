<?php //$albums = $this->requestAction('albums/index'); ?>	
<?php //$photos = $gallery[0]['Photo']; ?>

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
<!--<div class="pagination">&nbsp;</div>-->




