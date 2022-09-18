<?php $this->extend('/Common/admin_edit'); ?>
<?php echo $this->Form->create('Employee', array('type' => 'file')); ?>
<fieldset>
    <div class="tabs">
        <ul>
            <li><a href="#empployee-main"><span><?php echo __('User'); ?></span></a></li>
            <li><a href="#empployee-bio"><span><?php echo __('Bio'); ?></span></a></li>
            <li><a href="#empployee-contact"><span><?php echo __('Contact'); ?></span></a></li>
            <li><a href="#empployee-profile"><span><?php echo __('Profile'); ?></span></a></li>
            <?php echo $this->Layout->adminTabs(); ?> 				
        </ul>

        <div id="empployee-main">
            <?php
            echo $this->Form->input('User.name');
            echo $this->Form->input('bn_name', ['label' => 'Bangla Name']);
            echo $this->Form->input('User.username');
            echo $this->Form->input('User.email');
            echo $this->Form->input('join_date', array('minYear' => date('Y') - 70, 'maxYear' => date('Y')));
            echo $this->Form->input('mpo_date', array('minYear' => date('Y') - 70, 'maxYear' => date('Y'), 'label' => 'Join this Institute'));
            echo $this->Form->input('join_as');
            echo $this->Form->input('designation');
            echo $this->Form->input('bn_designation', ['label' => 'Bangla Designation']);
            echo $this->Form->input('User.role_id', array('options' => $role_id, 'label' => 'Employee Type'));
            $toggleCss = (!empty($this->request->data['User']['role_id']) && $this->request->data['User']['role_id'] == $scms_jSIdVal) ? '' : 'display:none;';
            echo '<br /><br /><fieldset id="capabilityCont" style="' . $toggleCss . 'padding:10px; border:1px solid red"><legend style="font-size:22px; padding:0 10px">Special Capabilities</legend>';
            echo $this->Form->input('level_id', array(
                'options' => $levels,
                'empty' => '--(Choose One)--',
                'label' => 'Department'
            ));
          
            echo '</fieldset>';

            echo $this->Form->input('Employee.featured');
            echo $this->Form->input('Employee.status');
            ?>
        </div>

        <div id="empployee-bio">
            <?php
            echo $this->Form->input('father_name');
            echo $this->Form->input('degree');
            echo $this->Form->input('training');
            echo $this->Form->input('date_of_birth', array('minYear' => date('Y') - 70, 'maxYear' => date('Y')));
            echo $this->Form->input('blood_group');
            echo $this->Form->input('hobby');
            echo $this->Form->input('gender', array('options' => array('Male', 'Female')));
            echo $this->Form->input('marital_status', array('options' => array('Married', 'Unmarried')));
            echo $this->Form->label('Picture');
            ?>
            <input type="file" name="image"/>
        </div>

        <div id="empployee-contact">
            <?php
            echo $this->Form->input('address');
            echo $this->Form->input('phone');
            echo $this->Form->input('nationality');
            echo $this->Form->input('national_id', array('type' => 'text', 'label' => 'National ID'));
            ?>
        </div>

        <div id="empployee-profile">
            <?php
            echo $this->Form->input('profile', array('class' => 'content'));
            echo $this->Form->input('quote_heading', array('class' => 'content', 'label' => 'বক্তব্য শিরোনাম'));
            echo $this->Form->input('quote', array('class' => 'content', 'label' => 'বেক্তিগত বক্তব্য   '));
            ?>
        </div>

        <?php echo $this->Layout->adminTabs(); ?>
        <div class="clear">&nbsp;</div>
    </div>
</fieldset>

<div class="buttons">
    <?php
    
    echo $this->Form->end(__('Save'));
    echo $this->Html->link(__('Cancel'), array('action' => 'index',), array('class' => 'cancel',)
    );
    ?>
</div>
<script type="text/javascript">scms_jSIdVal = <?php echo $scms_jSIdVal; ?>;</script>

