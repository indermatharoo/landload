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
        <style>
            #map{
                height: 500px !important;
                margin: 0px;
                padding: 0px
            }
        </style>

    </head>
    <body>
        <?php $this->load->view("themes/" . THEME . "/layout/inc-header"); ?>
        <section class="content-area">
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

        <footer id="footer" class="section footer">
            <div class="container">
                <?php  $this->load->view("themes/" . THEME . "/layout/inc-footer"); ?>
            </div>
        </footer>
        <a href="#header" class="scrollup"><i class="fa fa-chevron-up"></i></a>	
            <?php echo $CI->assets->renderFooter(); ?>
        
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
        <script type="text/javascript" src="<?= base_url(); ?>/js/franchisee.js"></script>
    </body>
</html>