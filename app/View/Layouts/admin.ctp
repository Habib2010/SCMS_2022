<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <title><?php echo $title_for_layout; ?> - <?php echo __('IMS'); ?></title>
            <?php
            echo $this->Html->css(array(
                'reset',
                '960',
                '/ui-themes/smoothness/jquery-ui.css',
                'admin',
                'thickbox',
                'responsive'
            ));
            echo $this->Layout->js();
            echo $this->Html->script(array(
                'jquery/jquery.min',
                'jquery/jquery-ui.min',
                'jquery/jquery.slug',
                'jquery/jquery.cookie',
                'jquery/jquery.hoverIntent.minified',
                'jquery/superfish',
                'jquery/supersubs',
                'jquery/jquery.tipsy',
                'jquery/jquery.elastic-1.6.1.js',
                'jquery/thickbox-compressed',
                'admin',
                'seat',
            ));
            echo $this->Blocks->get('css');
            echo $this->Blocks->get('script');
            ?>
            <script type="text/javascript">	
                
                function getTableRows(pid,tid, Seatplan, rs){ 
                    if(!rs){
                        rs= 1;
                    }
                    var headRow = '<tr class="rowHead pid_'+ pid +' tid_'+ tid +'" pid="'+pid+'" tid="'+tid+'">';
                    headRow =  headRow + '<td class="rowspan" rowspan="'+ rs +'"><div class="minusHead"><span>-</span></div><?php echo $this->Form->input('Seatplan.0.name', array('div' => false, 'value' => '', 'class' => 'input', 'label' => false, 'type' => 'textarea', 'rows' => 2, 'cols' => 30)); ?></td>' +
                        '<td class="rowspan" rowspan="'+ rs +'"><?php echo $this->Form->input('Seatplan.0.quantity', array('div' => false, 'value' => '', 'label' => false, 'type' => 'textarea', 'rows' => 2, 'cols' => 20)); ?></td>' +
                        '<td class="rowspan" rowspan="'+ rs +'"><?php echo $this->Form->input('Seatplan.0.location', array('div' => false, 'value' => '', 'label' => false, 'type' => 'textarea', 'rows' => 2, 'cols' => 20)); ?></td>';
				
				
                    headRow =  headRow + '</tr>';
                    //headRow = headRow.split('ProkolpoTask0').join('ProkolpoTask'+tid+'');
                    //			headRow = headRow.split('[ProkolpoTask][0]').join('[ProkolpoTask]['+tid+']');
                    headRow = headRow.split('Seatplan0').join('Seatplan'+pid+'');
                    headRow = headRow.split('[Seatplan][0]').join('[Seatplan]['+pid+']');

                    if(Seatplan){ 
                        return headRow;
                    }
			
                }
            </script>
    </head>

    <body>

        <div id="wrapper">
            <?php echo $this->element('admin/header'); ?>

            <div id="nav-container">
                <div class="container_16">
                    <?php echo $this->element("admin/navigation"); ?>
                </div>
            </div>

            <div id="main" class="container_16">
                <div class="grid_16">
                    <div id="content">
                        <?php
                        echo $this->Layout->sessionFlash();
                        echo $content_for_layout;
                        ?>
                    </div>
                </div>
                <div class="clear">&nbsp;</div>
            </div>

            <div class="push"></div>
        </div>

        <?php echo $this->element('admin/footer'); ?>
        <?php
        echo $this->Blocks->get('scriptBottom');
        echo $this->Js->writeBuffer();
        ?>
    </body>
</html>