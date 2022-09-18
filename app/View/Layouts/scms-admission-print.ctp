<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo $title_for_layout; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale = 1, user-scalable=no, maximum-scale=1.0">
        <?php
        echo $this->Html->css(array(
            'admin',
            //'/css/menu',
            //'/css/slider',
            //'/css/ticker-style',
            //'/css/slider-theame',
            //'/fonts/sutom/stylesheet',
            //'/fonts/Bebas/stylesheet',
            //'/fonts/newbaskerville/stylesheet',
            '/css/fonts',
            //'/css/prettyCheckable'

            '/css/scms-admit-print'
        ));
        ?>
  <?php
          echo $this->Layout->js();
          echo $this->Html->script(array(
           'admin',
          '/js/jquery.nivo.slider',
          '/js/jqueryeasing',
          '/js/jquery.ticker',
          '/js/menu',
          '/js/prettyCheckable',
          '/js/js'
          ));

          echo $this->Blocks->get('css');
          echo $this->Blocks->get('script');
          ?><?php ?>
    </head>
    <body>
        <?php //echo $this->element('admin/header'); ?>
        <?php
        //echo $this->Layout->sessionFlash();
        echo $content_for_layout;
        ?>

        <?php //echo $this->element('admin/footer'); ?>
        <?php
        //echo $this->Blocks->get('scriptBottom');
        //echo $this->Js->writeBuffer();
        ?>
    </body><!-- end of fromwrapper-->
</html>
