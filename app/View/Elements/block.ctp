<?php
	$this->set(compact('block'));
	$b = $block['Block'];
	$class = 'block block-' . $b['alias'];
	$openclass = '';
	if ($block['Block']['class'] != null) {
		$class .= ' ' . $b['class'];
		if($b['class'] == 'accordianIn'){
			$openclass = ' accordianOpen';
		}
	}
?>
<div id="block-<?php echo $b['id']; ?>" class="<?php echo $class; ?>">
	<?php if ($b['show_title'] == 1): ?>
		<h3><?php echo $lang=='bn' ? $b['bn_title'] : $b['title']; ?></h3>
		<?php if($openclass): ?>
			<a href="javascript:void(0);" class="btnOpen<?php if($b['alias'] == 'notice') echo ' btnClose'; ?>">&nbsp;</a>
		<?php endif; ?>
	<?php endif; ?>
	<div class="block-body<?php echo $openclass; ?>">
		<?php echo $this->Layout->filter($b['body']); ?>
	</div>
</div>