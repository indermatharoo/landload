<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <!-- BASICS -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>Online Property Management - Landlord Master</title>
        <?php
        $this->load->view("themes/" . THEME . "/headers/global.php");
        echo $CI->assets->renderHead();
        ?>
    </head>
    <body>
        <header id="header">
            <?php $this->load->view("themes/" . THEME . "/layout/inc-header"); ?>
        </header>

        <section id="slider">
            <?php $this->load->view("themes/" . THEME . "/layout/inc-slideshow"); ?>
        </section>

        <section id="topsearch">
            <?php $this->load->view("themes/" . THEME . "/layout/inc-topsearch"); ?>
        </section>

        <section id="properties">
            <div class="full_middle_container">
                <div class="container">
                    <div class="row">
                        <div class="middle_center_container">
                            <div class="property_heading_text">
                                <h2> Property List </h2>
                            </div>
                            <?php if (!count($property)): ?>
                                <div class="col-lg-12">
                                    No Property Found..
                                </div>
                            <?php endif; ?>
                            <?php foreach ($property as $row) { ?>
                                <?php
//                           e($row);
                                ?>
                                <div class="col-md-3">
                                    <div class="property_list_box">
                                        <div class="view view-first property_img">

                                            <img src="timthumb.php?src=<?php echo $this->config->item('UNIT_IMAGE_URL') . $row['unit_image'] ?>&h=275&w=275&q=100&zc=0" class="img-responsive">
                                            <div class="mask">
                                                <h2><?= substr($row['unit_number'],5) ?></h2>
                                                <p><?php echo substr($row['description'], 0, 50) . ".."; ?></p>
                                                <p class="prop_price"><?= DWS_CURRENCY_SYMBOL . $row['amount'] ?></p>

                                                <a class="info" href="property/detail/<?= $row['unit_id'] ?>">View</a>
                                            </div>
                                        </div> 
                                        <div class="property_text">
                                            <div class="col-md-9"> 
                                                <div class="property-city-name"><p><?= $row['city'] ?> </p></div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="price-text-note"> <p><?= DWS_CURRENCY_SYMBOL . $row['amount'] ?></p></div> 
                                            </div>
                                            <div class="clearfix"></div>

                                            <div class="col-md-9"> 
                                                <div class="property-text-name"><h4><?= $row['unit_number'] ?></h4></div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="buy-now-btn"> <a href="property/detail/<?= $row['unit_id'] ?>" class="btn btn-primary">  Apply </a></div> 
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div> <!-- /container -->
        </section>

        <footer>
            <?php $this->load->view("themes/" . THEME . "/layout/inc-footer"); ?>
        </footer>   
        <?php echo $CI->assets->renderFooter(); ?>
        <script src="js/ie10-viewport-bug-workaround.js"></script>
        <script>
            $('.carousel').carousel({
                interval: 3000
            })
        </script>
    </body>
</html>

