<div class="comments">
<?php
	$commentHeading = $node['Node']['comment_count'] . ' ';
	if ($node['Node']['comment_count'] == 1) {
		$commentHeading .= __('কমেন্ট');
	} else {
		$commentHeading .= __('কমেন্টস');
	}
	echo $this->Html->tag('h3', $commentHeading);

	foreach ($comments as $comment) {
		echo $this->element('comment', array('comment' => $comment, 'level' => 1));
	}
?>
</div>