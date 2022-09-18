<div style=" width:100%; overflow:hidden; background-color:#666666">
    <?php echo $this->Html->image('../uploads/logo.png', array('style' => 'width: 510px;')); ?>
</div>
<div class="users form">
    <?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login'))); ?>
    <fieldset>
        <?php
        echo $this->Form->input('username', array('label' => 'নাম'));
        echo $this->Form->input('password', array('label' => 'পাসওয়ার্ড'));
        ?>
    </fieldset>
    <?php
    echo $this->Html->link(__('পাসওয়ার্ড ভুলে গিয়েছেন?'), array(
        'admin' => false,
        'controller' => 'users',
        'action' => 'forgot',
            ), array(
        'class' => 'forgot',
    ));
    echo $this->Form->end(__('লগইন'));
    ?>
</div>