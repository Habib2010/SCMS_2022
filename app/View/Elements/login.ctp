<?php

echo $this->Form->create('GradStudent', array('id' => 'MiniUserLoginForm', 'url' => array('controller' => 'grad_students', 'action' => 'login'), 'class' => 'fxHdrForm2'));
echo $this->Form->input('username', array('label' => false, 'div' => false, 'value' => 'ব্যবহারকারী :', 'class' => 'txtBox2', 'div' => array('class' => 'fleft')));
echo $this->Form->input('password', array('label' => false, 'div' => false, 'value' => 'গোপন নং  :', 'class' => 'txtBox2', 'div' => array('class' => 'fleft')));

$options = array('class' => 'subBtn2', 'div' => false);
echo $this->Form->submit('পাঠান', $options);
echo $this->Form->end();
?>
