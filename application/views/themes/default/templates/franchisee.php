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
        <link rel="stylesheet" href="<?= base_url() ?>js/calendar/components/bootstrap2/css/bootstrap-responsive.css">
        <link rel="stylesheet" href="<?= base_url() ?>js/calendar/css/calendar.css">


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
        <div class="col-lg-10 col-sm-10 event-popup"></div>
        <footer id="footer" class="section footer">
            <div class="container">
                <?php $this->load->view("themes/" . THEME . "/layout/inc-footer"); ?>
            </div>
        </footer>
        <a href="#header" class="scrollup"><i class="fa fa-chevron-up"></i></a>	


        <div id="euid" uid="<?= $uid; ?>"></div>
        <?php echo $CI->assets->renderFooter(); ?>
        <script type="text/javascript" src="<?= base_url() ?>js/calendar/components/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/calendar/components/underscore/underscore-min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/calendar/components/bootstrap2/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/calendar/components/jstimezonedetect/jstz.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/calendar/js/calendar.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/calendar/js/app.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/jquery.bpopup.min.js"></script>
        <script type="text/javascript">
            function eventbooking(eid) {
                $.post('<?= base_url() ?>franchisee/eventdetail', {eid: eid}, function (data) {
                    $('.event-popup').html(data.event);
                    $('.event-popup').bPopup({
                        closeClass: 'close1'
                    });
                }, 'json');
            }
            function addtocart(eid) {
                var qty = 1, logged_in = '<?php echo curUsrId(); ?>';
                if(!logged_in){
                   var al = confirm('Login First');
                   if(al)
                   {
                      $('.close1').click();
                       return false;
                   }else{
                    return false;
                }
                }
                $.post('<?= base_url(); ?>booking/cart/add', {eid: eid, qty: qty}, function (data) {
                    console.log(data);
                }, 'json');
                setTimeout(function () {
                    window.location = "<?= base_url(); ?>checkout";
                }, 1000);
            }
        </script>
        <!-- snip -->
    </body>
</html>