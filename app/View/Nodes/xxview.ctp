<?php $this->Layout->setNode($node); ?>
<div id="node-<?php echo $this->Layout->node('id'); ?>" class="node node-type-<?php echo $this->Layout->node('type'); ?>">
	<h2><?php echo $this->Layout->node('title'); ?></h2>
	<?php
		echo $this->Layout->nodeInfo();
		echo $this->Layout->nodeBody();
		echo $this->Layout->nodeMoreInfo();
	?>
	<ol class="nodeattachments">
	<?php
		$attachments = $node['Nodeattachment']; 
		foreach($attachments as $attachment): 
			$downloadurl = $attachment['path']; 
			$downloadtitle = $this->Html->tag('span',$attachment['title']);
			$dnbtn = $this->Html->image('Download-Button.png',array('alt'=>$downloadtitle,'url'=>$downloadurl));
			echo $this->Html->tag('li',$downloadtitle.$dnbtn);
		endforeach; 
	?>
	</ol>
</div>

<div id="comments" class="node-comments">
<?php
	$type = $types_for_layout[$this->Layout->node('type')];

	if ($type['Type']['comment_status'] > 0 && $this->Layout->node('comment_status') > 0) {
		echo $this->element('comments');
	}

	if ($type['Type']['comment_status'] == 2 && $this->Layout->node('comment_status') == 2) {
		echo $this->element('comments_form');
	}
?>
</div>