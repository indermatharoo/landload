<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <!-- BASICS -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Landlord Masters</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        $this->load->view("themes/" . THEME . "/headers/global.php");
        echo $CI->assets->renderHead();
        ?>
    </head>

    <body>
        <header id="header">
            <?php $this->load->view("themes/" . THEME . "/layout/inc-header"); ?>
        </header>
        <section class="content-area">
        <section id="topsearch">
            <?php $this->load->view("themes/" . THEME . "/layout/inc-topsearch"); ?>
        </section>
            <div class="container"> 
                <div class="row mar-bot40">
                    <div class="subpages"> 
                        <?php
                        echo $contents;
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <footer>
            <?php $this->load->view("themes/" . THEME . "/layout/inc-footer"); ?>
        </footer>   
        <?php echo $CI->assets->renderFooter(); ?>

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>
