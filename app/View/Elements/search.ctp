<?php 
	$b = $block['Block'];
	$class = 'block block-' . $b['alias'];
	if ($block['Block']['class'] != null) {
		$class .= ' ' . $b['class'];
	}
?>
<div id="block-<?php echo $b['id']; ?>" class="<?php echo $class; ?>">
<?php if ($b['show_title'] == 1) { ?>
	<h3><?php echo $b['title']; ?></h3>
<?php } ?>
	<style>.block{margin:0;}</style>
	<div class="block-body">
		<form id="searchform" class="hdrForm" method="post" action="javascript: document.location.href=''+Croogo.basePath+'search/q:'+encodeURI($('#searchform #q').val());">
		<?php
			$qValue = null;
			if (isset($this->params['named']['q'])) {
				$qValue = $this->params['named']['q'];
			}
			echo $this->Form->input('q', array(
				'label' => false,
				'class' => 'txtBox1',
				'div'   => false,
				'name'  => 'q',
				'size'  => '10',
				'value' => $qValue,
			));
			$options = array('class' => 'subBtn1','div' => false);
			echo $this->Form->submit('Submit',$options);
		?>
		</form>
	</div>
</div>