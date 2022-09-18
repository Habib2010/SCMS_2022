<div class="dashboard index">
    <h2 style="font-size:2em">
        <?php
        echo $title_for_layout;
        ?>
    </h2>
    <?php if ($u_roleid == 10) { ?>
        <div> 
            <button><?php echo $this->Html->link(__('Reset password'), array('controller' => 'users', 'action' => 'reset_password', $uid)); ?></button>
        </div><br />
    <?php } ?>
    <div class="container_16">
        <?php echo $this->element("admin/dash_navigation"); ?>
    </div>
    <div class="clear">&nbsp;</div>
</div>