<?php if(isset($slug)): ?>
	<?php $album = $this->requestAction('albums/getAlbumBySlug/'.$slug); ?>

	<?php 
	$photos = array();
	if(isset($album['Photo'])){
		$photos = $album['Photo'];
	} 
	?>

	<?php foreach($photos as $photo): ?>
		<?php 
		echo $this->Html->image("gallery/".$photo['large'] , array (
				"title" => $photo['title'],
				'div' 	=> false,
				'class' => false
			)
		);
		?>
	<?php endforeach; ?>
<?php else: ?>
	<p>Please define slug</p>
<?php endif; ?>
