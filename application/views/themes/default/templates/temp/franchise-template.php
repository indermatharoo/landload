<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <!-- BASICS -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>The creation station</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        $this->load->view("themes/" . THEME . "/headers/global.php");
        echo $CI->assets->renderHead();
        ?>

        <!-- skin -->
        <link rel="stylesheet" href="skin/default.css">
    </head>

    <body>
        <div class="top-menu">
            <div class="container">
                <div class="col-lg-6 col-sm-12 col-xs-12 right">                                      
                    <?php $this->load->view("themes/" . THEME . "/layout/inc-top"); ?>
                </div>
            </div>
        </div>
        <div class="navbar" role="navigation" data-0="line-height:85px; height:85px; background-color:rgba(0,0,0,0.3);" data-300="line-height:60px; height:60px; background-color:rgba(0,0,0,1);">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="fa fa-bars color-white"></span>
                    </button>
                    <a href="<?php echo $CI->http->baseURL(); ?>"><img src="images/logo.png" alt="The Creationstation" class="img-responsive logo"/></a>
                </div>
                <div class="navbar-collapse collapse">
                    <div class="menu">
                        <?php $this->load->view("themes/" . THEME . "/layout/inc-menu"); ?>
                    </div>
                </div>
            </div>
        </div>
        <section class="content-area">
            <div class="container"> 
                <div class="row mar-bot40">
                    <div class="col-lg-7">
                        <div class="subpages "> 
                            <?php //print_r($page); ?>
                            <h1><?php echo $page['page_title']; ?></h1>
                            <?php echo $page['page_contents']; ?>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <?php echo $compiledblocks[0]; ?>
                    </div>
                </div>
            </div>
        </section>

        <footer id="footer" class="section footer">
            <div class="container">
                <?php $this->load->view("themes/" . THEME . "/layout/inc-footer"); ?>
            </div>
        </footer>
        <a href="#header" class="scrollup"><i class="fa fa-chevron-up"></i></a>	
            <?php echo $CI->assets->renderFooter(); ?>
    </body>
</html>