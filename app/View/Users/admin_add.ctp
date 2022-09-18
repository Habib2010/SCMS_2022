<?php $this->extend('/Common/admin_edit'); ?>
<?php echo $this->Form->create('User'); ?>
<fieldset>
    <div class="tabs">
        <ul>
            <li><a href="#user-main"><?php echo __('User'); ?></a></li>
            <?php echo $this->Layout->adminTabs(); ?>
        </ul>

        <div id="user-main">
            <?php
            echo $this->Form->input('role_id');
            echo $this->Form->input('username');
            echo $this->Form->input('password');
            echo $this->Form->input('name');
            echo $this->Form->input('email');
            echo $this->Form->input('website');
            echo $this->Form->input('status');


            /* echo '<br /><br /><fieldset style="padding:10px; border:1px solid red"><legend style="font-size:22px; padding:0 10px">Capabilities</legend>';
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
              echo '</fieldset>'; */

            /* echo $this->Form->input('capabilities', array(
              'options'=>array(
              'Value 1' => 'Label 1',
              'Value 2' => 'Label 2'
              ),
              'multiple' => 'checkbox',
              'label'=>'Capabilities',
              'div'=>'checkbox'
              )); */
            ?>
        </div>
        <?php echo $this->Layout->adminTabs(); ?>
    </div>
</fieldset>

<div class="buttons">
    <?php
    echo $this->Form->end(__('Save'));
    echo $this->Html->link(__('Cancel'), array(
        'action' => 'index',
            ), array(
        'class' => 'cancel',
    ));
    ?>
</div>