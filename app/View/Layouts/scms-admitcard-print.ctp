<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo $title_for_layout; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale = 1, user-scalable=no, maximum-scale=1.0">
        <?php
        echo $this->Html->css(array(
            '/css/style',
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
        <?php /* ?><!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
          <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
          <![endif]-->
          <?php
          echo $this->Layout->js();
          echo $this->Html->script(array(
          //student layout
          //'/students_tmp_design/js/jquery-1.8.2.min',
          //'/students_tmp_design/js/js.js',
          //'admin'
          '/js/jquery-1.8.2.min',
          '/js/jquery.nivo.slider',
          '/js/jqueryeasing',
          '/js/jquery.ticker',
          '/js/menu',
          '/js/prettyCheckable',
          '/js/js'
          ));

          echo $this->Blocks->get('css');
          echo $this->Blocks->get('script');
          ?><?php */ ?>
    </head>
    <body class="scms-admitcard-print">
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
