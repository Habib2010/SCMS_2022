<div class="departments form">
    <h2>Add Department</h2>
    <div class="actions">
        <ul>
            <li><?php echo $html->link(__('Index', true), array('controller'=>'departments','action'=>'index')); ?></li>
        </ul>
    </div>
    <?php echo $form->create('Department');?>
        <fieldset>
            <div class="tabs">
                <ul>
                    <li><a href="#department-main"><span><?php __('Department'); ?></span></a></li>
                    <?php echo $layout->adminTabs(); ?>
                </ul>

                <div id="department-main">
                <?php
                    echo $form->input('name');
                ?>
                </div>
                <?php echo $layout->adminTabs(); ?>
            </div>
        </fieldset>
    <?php echo $form->end('Submit');?>
</div>