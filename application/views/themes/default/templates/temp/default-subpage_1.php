<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
 <?php
    $com = array();
    if ($this->COMPANY)
        $com = $this->COMPANY;
    ?>
    <head>
        <meta charset="utf-8">
        <?php $CI->html->getMeta(); ?>
        <base href="<?php echo $CI->http->baseURL(); ?>" />
        <meta name="viewport" content="width=device-width" />
        <?php
        $this->load->view("themes/" . THEME . "/headers/global.php");
        $this->load->view("themes/" . THEME . "/headers/subpage.php");
//        $this->load->view("themes/" . THEME . "/headers/homepage.php");
        echo $CI->assets->renderHead();
        $this->load->view("themes/" . THEME . "/layout/inc-before-head-close.php");
        ?>

        <!--[if lt IE 9]>
            <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')</script>
        <![endif]-->
    </head>

    <body>
        <div id="wrap">
            <div id="wrapinner">
                <div  class="container-outer">
                    <div class="head-top">
                        <div class="top">
                            <div class="topleft">
                                <a href="<?php echo $CI->http->baseURL(); ?>"><img src="image/dlogo.png" alt="Desktopdeli" /></a>
                            </div>
                            <div class="topright">
                                <div class="menu">
                                    <?php $this->load->view("themes/" . THEME . "/layout/inc-menu"); ?>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="dot"></div>
                <div class="container-outer">
                    <div class="head-bot">
                        <div class="hbanner">
                            <div class="hbanner catb">
                            <?php if (!empty($com['banner_image'])) { ?>
                                <img src="<?php echo $this->config->item('MISC_URL') . $com['banner_image']; ?>" alt="" width="900px"/>
                            <?php } else { ?>
                                <img src="image/hbanner.png" alt="" width="900"/>
                            <?php }
                            ?>

                        </div>
                        </div>
                        <div class="hlogin"> 
                            <?php
                            $customer = array();
                            $customer = $this->memberauth->checkAuth();
                            if ($customer == true) {
                                echo "<strong>Welcome </strong> " . $customer['first_name'] . " " . $customer['last_name'] . "!";
                                echo " | <a href='http://" . $customer['company_url_alias'] . ".desktopdeli.co.uk/customer/order'>My Account</a>";
                                echo " | <a href='http://" . $customer['company_url_alias'] . ".desktopdeli.co.uk/customer/logout'>Logout</a>";
                            }
                            ?>
                        </div>
<!--                        <div class="hoffer">
                            <img src="image/loyalty.png" alt="" />
                        </div>-->
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="container-outer">
                    <div id="left_column">
                        <?php $this->load->view("themes/" . THEME . "/layout/inc-default-left-column"); ?>
                    </div>
                    <!--                    <div id="contents">
                                            <div id="content_top"></div>
                                            <div id="content_rep">
                    <?php echo $contents; ?>
                                            </div>
                                            <div id="content_bottom"></div>
                                        </div>-->
                     <div class="subpages"> 
                             <?php echo $contents; ?>
                    </div>

                    <div id="right_column" class="checkout_margin">
                        <?php $this->load->view("themes/" . THEME . "/layout/inc-default-right-column"); ?>
                    </div>
                    <div style="clear:both"></div>
                </div>
                <div class="dot"></div>

                <div style='clear: both'></div>
                <?php $this->load->view("themes/" . THEME . "/layout/inc-footer"); ?>
            </div>
        </div>
        <?php $this->load->view("themes/" . THEME . "/layout/inc-before-body-close"); ?>
        <?php echo $CI->assets->renderFooter(); ?>
    </body>
</html>