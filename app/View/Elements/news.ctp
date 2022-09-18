<!--<h3>Recent Notice</h3>-->
<?php $notices = $this->requestAction('nodes/news'); ?>	
	<ul id="js-news" class="js-hidden">
		<?php foreach($notices as $notice):
            $notice_title = $lang == 'bn' ? $notice['Node']['bn_title'] : $notice['Node']['title'];
            ?>
		<li class="news-item"><?php echo $this->Html->link($notice_title, array(
		                       'admin' => false,
							   'controller' => 'nodes',
							   'action' => 'view',
							   'type' => $notice['Node']['type'],
							   'slug' => $notice['Node']['slug'],
							   ));
							   ?>
		</li>
		<?php endforeach ; ?>
	</ul>	

