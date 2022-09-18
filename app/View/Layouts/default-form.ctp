<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $title_for_layout; ?> &raquo; <?php echo Configure::read('Site.title'); ?></title>
        <?php
        if (isset($this->Layout)) { //This condition is added by TechPlexus for the application use other than any pages;
            echo $this->Layout->meta();
            echo $this->Layout->feed();
        }
        echo $this->Html->css(array(
            'reset',
            '960',
            'ie',
            'slider',
            'theme',
            'ticker-style',
            'slider-theame',
            '/css/fonts',
            'jquery.fancybox',
            'jquery.fancybox-buttons',
            'jquery.fancybox-thumbs',
            'style',
            'menu',
            'prettyCheckable', //admission
            '/css/result',
            '/ui-themes/smoothness/jquery-ui.css',
        ));

        if (isset($this->Layout)) //The condition is added By TechPlexus;
            echo $this->Layout->js();

        echo $this->Html->script(array(
            'jquery/jquery.min',
            'jquery/jquery-ui.min',
            'canvasjs.min',
            'jquery/jquery.hoverIntent.minified',
            'jquery/superfish',
            'jquery/supersubs',
            'theme',
            'scms/ie6PngFix',
            'scms/jquery.nivo.slider',
            'scms/jquery.ticker',
            'scms/jqueryeasing',
            'jquery.fancybox',
            'jquery.fancybox-buttons',
            'scms/prettyCheckable', //admission
            'scms/menu',
            'scms/js'
        ));
        echo $this->Blocks->get('css');
        echo $this->Blocks->get('script');


        if (!empty($bodyMinWidth)) {
            echo '<style type="text/css">body{min-width:' . $bodyMinWidth . '}</style>';
        }
        ?>
    </head>
    <body>

<!--        <div class="fixedHdr">-->
<!--            <div class="fxdFormCon">	-->
<!--                --><?php //echo $this->element('user_comments'); ?>
<!--                --><?php //echo $this->element('login'); ?><!--           -->
<!--            </div>-->
<!--            <div class="fx_hdr_wrap">-->
<!--                <div class="fright">-->
<!--                    <a href="#" class="btn1">মন্তব্য </a>-->
<!--                    --><?php //if ($this->Session->read('Auth.User.username')) { ?>
<!--                        <div class="btn1" id="logout">-->
<!--                            --><?php //echo $this->Html->link(__('লগ আউট', true), array('controller' => 'users', 'action' => 'logout', 'plugin' => false)); ?>
<!--                        </div>-->
<!--                    --><?php //} else { ?>
<!--                        <a href="#" class="btn1">লগ ইন</a>-->
<!--                    --><?php //} ?>
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <header class="header">-->
<!--            <div class="hdr_wrap">-->
<!--                <a href="#" id="logo">-->
<!--                    --><?php //echo $this->Html->image("/uploads/logo.png", array("alt" => "Dinajpur Polytechnic Institute", 'url' => '/')); ?>
<!--                </a>-->
<!--                <div class="hdrRgt">           	           -->
<!--                    --><?php //echo $this->Layout->blocks('header'); ?>
<!--                </div>-->
<!--                <div id="menu">                -->
<!--                    --><?php //echo $this->Layout->menu('main', array('selected' => 'selected')); ?>
<!--                </div>-->
<!--                <div class="newsTicker">				            					-->
<!--                    --><?php //echo $this->Layout->blocks('region1'); ?>
<!--                </div>-->
<!--            </div>-->
<!--        </header>-->

        <header class="header">
    <div class="hdrRgt">
        <?php echo $this->Layout->blocks('header'); ?>
    </div>
    <div class="slider_theame">

        <?php echo $this->Html->image("/uploads/logo.png", array("alt" => "UPMS", 'id' => 'logo', 'url' => '/')); ?>

        <div id="slider" class="nivoSlider" >
            <?php echo $this->element('gallery_by_location', array('location' => 'home')); ?>
        </div>
    </div>
    <div class="hdr_wrap">

        <div id="menu">
            <?php echo $this->Layout->menu('main', array('selected' => 'selected')); ?>
        </div>

    </div>
</header>

        <section class="content">
            <?php if (!empty($noSidebar)) { ?>
                <?php echo $this->Layout->sessionFlash(); ?>
                <?php echo $content_for_layout; ?>
            <?php } else { ?>

<!--                <div class="slider_theame">-->
<!--                    <div id="slider" class="nivoSlider" >				-->
<!--                        --><?php //echo $this->element('gallery_by_location', array('location' => 'home')); ?><!--                    -->
<!--                    </div>-->
<!--                </div>-->

                <!-- End of slider_theame -->
                <?php if ($this->action == 'promoted'){ ?>
                <div style="width:44%; float:left; margin-top: 10px; background-color:rgb(237, 236, 236); height: 416px;"> 
                <!--<h1><?php echo $welcome['Node']['title'] ?></h1> -->
                            <p><?php echo $welcome['Node']['body'] ?></p>
                
                </div>
                <div style="width:55%; float:right; margin-top: 10px;">
                 <div class="accordian">   
                        <?php echo $this->Layout->blocks('right'); ?>
                    </div>   
                
                
                </div>
				<?php } ?>
                <div class="<?php if ($this->action == 'promoted') echo 'admissionCon'; else echo 'admissionCon'; ?>">
                    <?php echo $this->Layout->sessionFlash(); ?>
                    <?php echo $content_for_layout; ?>  
                </div>
            <?php } ?>
        </section>

        <footer class="footer">
            <div class="footer-logo"><?php echo $this->Html->image("/images/footer-logo.png", array("alt" => "Dinajpur Polytechnic Institute")); ?></div>
            <div class="ourAddress">
                <h4>Our Address</h4>
                <address>Dinajpur Polytechnic Institute</address>
                <p>Dinajpur-5200.<br>
                    <strong>Tel:&nbsp;</strong>0531-65573<br>
                    <strong>Email:&nbsp;</strong><a href="mailto:contact@api.edu.bd">contact@dpi.edu.bd</a><br>	

            </div>
            <?php
            echo $this->Layout->menu('footer');
            if (empty($totalPrStudent)) {
                $totalPrStudent = 0;
            }
            if (empty($totalAbsent)) {
                $totalAbsent = 0;
            }
            ?>
            <a href="http://tech-plexus.com/" class="ftrLogo" target="_blank"><?php echo $this->Html->image("/uploads/ftrlogo.png", array("alt" => "TechPlexus Ltd.")); ?></a>
        </footer>
        <div id="copyright" style="display:none">Copyright &copy; 2013 <a href="http://apycom.com/">Apycom jQuery Menus</a></div>

        <?php
        echo $this->Blocks->get('scriptBottom');
        echo $this->Js->writeBuffer();
        ?>
    </body>
</html>
