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

    </head>
    <body>
        <?php $this->load->view("themes/" . THEME . "/layout/inc-header"); ?>
        <section class="content-area">
            <div class="container"> 
                <div class=" mar-bot40">
                    <div class="subpages"> 
                        <?php
                        echo $contents;
                        ?>
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