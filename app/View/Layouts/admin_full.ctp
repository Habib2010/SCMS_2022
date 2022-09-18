<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title><?php echo $title_for_layout; ?> - <?php echo __('SCMS'); ?></title>
        <?php
        echo $this->Html->css(array(
            'reset',
            '960',
            '/ui-themes/smoothness/jquery-ui.css',
            'admin',
            'thickbox',
        ));
        echo $this->Layout->js();
        echo $this->Html->script(array(
            'jquery/jquery.min',
            'jquery/jquery-ui.min',
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
    </head>

    <body>
        <div id="wrapper">
            <?php echo $this->element('admin/header'); ?>
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