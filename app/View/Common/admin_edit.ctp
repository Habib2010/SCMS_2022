<?php
if (empty($modelClass)) {
	$modelClass = Inflector::singularize($this->name);
}
if (!isset($className)) {
	$className = strtolower($this->name);
}
$what = isset($this->request->data[$modelClass]['id']) ? __('Edit') : __('Add');
?>
<div class="<?php echo $className; ?> form">
	<h2><?php if ($titleBlock = $this->fetch('title')): ?>
		<?php echo $titleBlock; ?>
	<?php else: ?>
		<?php
		echo !empty($title_for_layout) ? $title_for_layout : $what . ' ' . $modelClass;
		?>
	<?php endif; ?></h2>
	
	<?php if ($actionsBlock = $this->fetch('actions')): ?>
	<div class="actions">
		<ul>
			<?php echo $actionsBlock; ?>
		</ul>
	</div>
	<?php endif; ?>

	<?php if ($contentBlock = $this->fetch('content')): ?>
		<?php echo $contentBlock; ?>
	<?php else: ?>
		<?php echo $this->Form->create($modelClass); ?>
		<?php
		if (isset($this->request->data[$modelClass]['id'])) {
			echo $this->Form->input('id');
		}
		?>
		<fieldset>
			<div class="tabs">
				<ul>
					<li><a href="#<?php echo strtolower($modelClass); ?>-main"><?php echo $modelClass; ?></a></li>
					<?php echo $this->Layout->adminTabs(); ?>
				</ul>
				<div id="<?php echo strtolower($modelClass); ?>-main">
					<?php foreach ($editFields as $field => $opts){
							echo $this->Form->input($field, $opts);
						/*if( $field=='capabilities' ){
							echo '<br /><br /><fieldset style="padding:10px; border:1px solid red"><legend style="font-size:22px; padding:0 10px">Capabilities</legend>';
							echo $this->Form->input('User.capabilities.level',array(
								'options' => array(1=>'ONE',2=>'TWO',3=>'THREE',4=>'FOUR',5=>'FIVE',6=>'SIX',7=>'SEVEN',8=>'EIGHT',9=>'NINE',10=>'TEN',11=>'ELEVEN',12=>'TWELVE'),
								'empty' => '(Choose One)',
								'label'=> 'Level'
							)).'<br />';
							
							echo $this->Form->input('User.capabilities.section',array(
								'options' => array('A'=>'A','B'=>'B','C'=>'C','D'=>'D'),
								'empty' => '(Choose One)',
								'label'=> 'Section'
							)).'<br />';
							echo '</fieldset>';
						}else{
							echo $this->Form->input($field, $opts);
						}*/
					} ?>
				</div>
				<?php echo $this->Layout->adminTabs(); ?>
			</div>
		</fieldset>

		<div class="buttons">
			<?php if ($buttonsBlock = $this->fetch('buttons')): ?>
				<?php echo $buttonsBlock; ?>
			<?php else: ?>
				<?php
				echo $this->Form->end(__('Save'));
				echo $this->Html->link(__('Cancel'), array(
					'action' => 'index',
				), array(
					'class' => 'cancel',
				));
				?>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>