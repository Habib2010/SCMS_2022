<div id="contact-<?php echo $contact['Contact']['id']; ?>" class="">
	<h2><?php echo $lang == 'bn' ? __('যোগাযোগ') : 'Contact' ?></h2>
    <h2> <?php if(isset($message)){echo $message ; }?></h2>
	<div class="contact-body">
	<?php echo $contact['Contact']['body']; ?>
	</div>

	<?php if ($contact['Contact']['message_status']) { ?>
	<div class="contact-form">
	<?php
		echo $this->Form->create('Message', array(
			'url' => array(
				'controller' => 'contacts',
				'action' => 'view',
				$contact['Contact']['alias'],
			),
		));
		echo $this->Form->input('Message.name', array('label' => __($lang == 'bn' ? 'আপনার নাম' : 'Your Name'),'style' => 'padding:5px;'));
		echo $this->Form->input('Message.email', array('label' => __($lang == 'bn' ? 'আপনার ইমেইল' : 'Your Email'),'style' => 'padding:5px;'));
		echo $this->Form->input('Message.title', array('label' => __($lang == 'bn' ? 'বিষয়' : 'Subject'),'style' => 'padding:5px;'));
		echo $this->Form->input('Message.body', array('label' => __($lang == 'bn' ? 'বার্তা' : 'Message'),'style' => 'padding:5px;'));
		if ($contact['Contact']['message_captcha']) {
			echo $this->Recaptcha->display_form();
		}
		echo $this->Form->submit(__($lang == 'bn' ? 'পাঠান' : 'Send'));
		echo $this->Form->end();
		
	?>
	</div>
	<?php } ?>
</div> 