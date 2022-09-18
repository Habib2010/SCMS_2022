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
        <style>
            .language {
                position: absolute;
                right: 25%;
                /*z-index: 1000;*/
                border: 5px solid rgb(7, 161, 56);
                border-radius: 4px;
                background-color: #fff;
            }
        </style>
    </head>
    <body>


        <header class="header">
            <div class="hdrRgt">           	           
                <?php echo $this->Layout->blocks('header'); ?>
<!--                --><?php //if ($this->action == 'promoted') { ?>
                <div class="language">
                    <?php $language = array(
                        'en' => 'English Version',
                        'bn' => 'Bangla Version'
                    );
                    //pr($lang); die;
                    echo $this->Form->create('Node', array('id'=>'lang', 'url' =>'/'));
//                    echo $this->Form->input('lang',array('label' => false, 'div' => false, 'options' =>$language, 'selected'=>$lang,  'onchange' => "this.form.submit()"));
                    if($lang == 'bn'){
                        echo $this->Form->button('English Version', array('name' => 'lang', 'onclick'=> 'SelectAll("client_name");' , 'value'=>'en'));
                    }  else {
                        echo $this->Form->button('বাংলা সংস্করণ', array('name' => 'lang', 'onclick'=> 'SelectAll("client_name");' , 'value'=>'bn'));
                    }
                    echo $this->Form->end();
                    ?>
                </div>
<!--                --><?php //} ?>
            </div>
            <div class="slider_theame">

                <?php echo $this->Html->image("/uploads/logo.png", array("alt" => "UPMS",'style' => 'margin-top: 85px;', 'id' => 'logo', 'url' => '/')); ?>

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
<?php //pr($lang);die; ?>
        <section class="content">
            <?php if (!empty($noSidebar)) { ?>
                <?php echo $this->Layout->sessionFlash(); ?>
                <?php echo $content_for_layout; ?>
            <?php } else { ?>
                <div id="left-content" class="leftCon mainwrapper">
                	<?php echo $this->Html->image("/uploads/National-Portal-Card-PM.jpeg", array("alt" => "",'style' => 'width:100%;', 'id' => '', 'url' => '/')); ?>
                    <?php
                    echo $this->Layout->sessionFlash();
                    echo $content_for_layout;
                    ?>  
                </div>

                <div class="sidebar_2">
<!--                    <div class="empMsg">-->
<!--                        <a href="/admin" style="line-height: 30px; text-align: center">--><?php //echo $this->Html->image('/images/loginimg.png'); ?><!--</a>-->
<!--                    </div>-->
                    <?php if (!empty($chairmanInfo)) { ?>
                        <div class="empMsg">
                            <h5 class="bk-org title"><?= ($lang == 'bn') ? 'মাননীয় মন্ত্রী' : 'Honourable Minister'; ?></h5>
                            <div class="empMsgImg">
                                <?php echo $this->Html->image('/img/employee/thumbnail/' . $chairmanInfo['Employee']['thumbnail'], array('style' => 'width:120px;')); ?>
                            </div>
                            <p><strong><?= $lang == 'bn' ? $chairmanInfo['Employee']['bn_name'] : $chairmanInfo['Employee']['name']; ?></strong></p>
                            <h4><a href="/deo_panchagarh/employees/index/minister"><span style="color:#008000"><?php if ($lang == 'bn') echo 'বিস্তারিত'; else echo 'Details';?></span></a></h4>
                        </div>  
                    <?php } ?>

                    <?php if (!empty($unoInfo)) { ?>
                        <div class="empMsg">
                            <h5 class="bk-org title"><?= ($lang == 'bn') ? 'উপমন্ত্রী' : 'Deputy Minister'; ?></h5>
                            <div class="empMsgImg">
                                <?php echo $this->Html->image('/img/employee/thumbnail/' . $unoInfo['Employee']['thumbnail'], array('style' => 'width:120px;')); ?>
                            </div>
                            <p><strong><?= $lang == 'bn' ? $unoInfo['Employee']['bn_name'] : $unoInfo['Employee']['name']; ?></strong></p>
                            <h4><a href="/employees/index/deputy-minister"><span style="color:#008000"><?php if ($lang == 'bn') echo 'বিস্তারিত'; else echo 'Details';?></span></a></h4>
                        </div>
                    <?php } ?>

                    <?php if (!empty($sochib)) { ?>
                        <div class="empMsg">
                            <h5 class="bk-org title"><?= ($lang == 'bn') ? 'সচিব' : 'Secretary'; ?></h5>
                            <div class="empMsgImg">
                                <?php echo $this->Html->image('/img/employee/thumbnail/' . $sochib['Employee']['thumbnail'], array('style' => 'width:120px;')); ?>
                            </div>
                            <p><strong><?= $lang == 'bn' ? $sochib['Employee']['bn_name'] : $sochib['Employee']['name']; ?></strong></p>
                            <h4><a href="/employees/index/sochib"><span style="color:#008000"><?php if ($lang == 'bn') echo 'বিস্তারিত'; else echo 'Details';?></span></a></h4>
                        </div>
                    <?php } ?>

                    <?php if (!empty($director)) { ?>
                        <div class="empMsg">
                            <h5 class="bk-org title"><?= ($lang == 'bn') ? 'মহাপরিচালক' : 'Director General'; ?></h5>
                            <div class="empMsgImg">
                                <?php echo $this->Html->image('/img/employee/thumbnail/' . $director['Employee']['thumbnail'], array('style' => 'width:120px;')); ?>
                            </div>
                            <p><strong><?= $lang == 'bn' ? $director['Employee']['bn_name'] : $director['Employee']['name']; ?></strong></p>
                            <h4><a href="/employees/index/director"><span style="color:#008000"><?php if ($lang == 'bn') echo 'বিস্তারিত'; else echo 'Details';?></span></a></h4>
                        </div>
                    <?php } ?>

                    <?php if (!empty($principal)) { ?>
                        <div class="empMsg">
                            <h5 class="bk-org title"><?= ($lang == 'bn') ? 'অধ্যক্ষ' : 'Principal'; ?></h5>
                            <div class="empMsgImg">
                                <?php echo $this->Html->image('/img/employee/thumbnail/' . $principal['Employee']['thumbnail'], array('style' => 'width:120px;')); ?>
                            </div>
                            <p><strong><?= $lang == 'bn' ? $principal['Employee']['bn_name'] : $principal['Employee']['name']; ?></strong></p>
                            <h4><a href="/employees/index/principal"><span style="color:#008000"><?php if ($lang == 'bn') echo 'বিস্তারিত'; else echo 'Details';?></span></a></h4>
                        </div>
                    <?php } ?>

                    <div class="accordian">
                        <?php echo $this->Layout->blocks('right'); ?>
                    </div>         

                    <div class="sidebarComn">
                        <?php echo $this->element('calendar'); ?>
                    </div>

                    <div class="sidebarComn">
                        <h2><?php if ($lang == 'bn') echo 'গুরুত্বপূর্ণ লিঙ্ক'; else echo 'Important Links';?></h2>
                        <?php echo $this->Layout->blocks('blogroll'); ?>
                    </div>

                    <?php if ($this->action == 'promoted') { ?>

                        <div class="sidebarComn" style=" width:99%; height:160px; margin-bottom:10px; overflow:hidden; text-align:center; float:left">         <a href="https://goo.gl/maps/bKNL2xPdQjyKtoyo6" target="_blank"><?php echo $this->Html->image("/img/map.png", array("alt" => "Dinajpur Polytechnic Institute")); ?></a>

                        </div>

                        <div class="sidebarComn" style=" width:99%; text-align:center; float:left">
                            <!-- Clock -->
                            <div align="center" style="margin:15px 0px 0px 0px"><noscript><div align="center" style="width:140px;border:1px solid #ccc;background:#fff ;color: #fff ;font-weight:bold"><a style="padding:2px 1px;margin:2px 1px;font-size:12px;line-height:16px;font-family:arial;text-decoration:none;color:#000" href="http://localtimes.info/Asia/Bangladesh/Rangpur/"><img src="http://localtimes.info/images/countries/bd.png" border=0 style="border:0;margin:0;padding:0">&nbsp;Time in Rangpur </a></div></noscript><script type="text/javascript" src="http://localtimes.info/clock.php?continent=Asia&country=Bangladesh&city=Rangpur&widget_number=105&cp3_Hex=040404&cp2_Hex=FFFFFF&cp1_Hex=040404&ham=0&fwdt=100&ham=1&hbg=1"></script></div>

                            

                        </div>

                    <?php } ?>

                </div>
            <?php } ?>
        </section>

        <footer class="footer">
            <div class="footer-logo"><?php echo $this->Html->image("/images/footer-logo.png", array("alt" => "Dinajpur Polytechnic Institute")); ?></div>
            <div class="ourAddress">
                <h4><?= $lang=='bn' ? 'আমাদের ঠিকানা' : 'Our Address' ?></h4>
                <address><?= $lang=='bn' ? 'দিনাজপুর পলিটেকনিক ইনস্টিটিউট' : 'Dinajpur Polytechnic Institute' ?></address>
                <p><?= $lang=='bn' ? 'দিনাজপুর-৫২০০.' : 'Dinajpur-5200.' ?><br>
                    <strong><?= $lang=='bn' ? 'ফোন: </strong>৮৮-০৫৩১-৬৫৫৭৩,' : 'Tel: </strong>88-0531-65573,' ?>&nbsp; <br>
                    <strong><?= $lang=='bn' ? 'ইমেইল: ' : 'Email: ' ?>&nbsp;</strong><a href="mailto:contact@api.edu.bd">contact@dpi.edu.bd</a><br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="mailto:dpi_dinajpur@yahoo.com">dpi_dinajpur@yahoo.com</a><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="mailto:principal_dpibd@yahoo.com">principal_dpibd@yahoo.com</a>
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
