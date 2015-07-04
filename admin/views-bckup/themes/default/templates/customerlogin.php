<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <title>Welcome To Admin Panel</title>
        <base href="<?php echo base_url(); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <?php echo cms_meta_tags(); ?>
        <base href="<?php echo cms_base_url(); ?>" />
        <?php
        $this->load->view(THEME . "headers/global");

        echo cms_head();
        echo cms_css();
        echo cms_js();
        ?>
        <?php $this->load->view(THEME . 'layout/inc-before-head-close'); ?>
        <!--Le HTML5 shim, for IE6-8 support of HTML5 elements 
        [if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <?php if ($this->aauth->isFranshisor() || $this->aauth->isFranshisee()): ?>           
            <link type="text/css" href="http://localhost/cometchat/cometchatcss.php" rel="stylesheet" charset="utf-8"/>
            <script type="text/javascript" src="http://localhost/cometchat/cometchatjs.php" charset="utf-8"></script>
        <?php endif; ?>
    </head>
    <body>
        <header id='header' class='pageTop'>
            <?php $this->load->view(THEME . 'layout/inc-header'); ?>
        </header>
        <section id='main-content'>
            <div class="container">
                <div class="content-main">
                    <link href="<?php echo base_url() ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
                    <div class="event-popup"></div>
                    <div class="row content-bg">
                        <?php echo $content ?>
                        <div id="right-column" class="col-lg-5">
                            <div class="col-lg-12 menu padding-0">
                                <?php $this->load->view(THEME . 'layout/inc-menu-customer-dashboard'); ?>
                            </div>
                            <?php $this->load->view(THEME . 'layout/inc-notifications'); ?>
                            <?php $this->load->view(THEME .'layout/in-social-links');?>
                        </div>
                    </div>
                    <script>
                        function eventbooking(elm, eid) {
                            var top = $(elm).position().top;
                            $.post('<?php echo createUrl('franchisee/eventdetail', site_url1(base_url())) ?>', {eid: eid, small: true}, function (data) {
                                $('div.event-popup').html(data.event);
                                $('div.event-popup').bPopup({
                                    closeClass: 'close1',
                                    follow: [false, false], //x, y
                                    position: ["10%", top + 'px'] //x, y
                                });
                            }, 'json');
                        }
                        function addtocart(eid) {
                            var qty = 1;
                    //        var url = 'http://localhost/desktopdeli/booking/cart/add';
                            $.post('<?php echo createUrl('customer/cart/add') ?>', {eid: eid, qty: qty}, function (data) {
                                console.log(data);
                            }, 'json');
                            setTimeout(function () {
                                //            window.location = "http://localhost/desktopdeli/checkout";
                                var url = "<?php echo createUrl('customer/checkout') ?>";
                                window.location = url;
                            }, 1000);
                        }
                    </script>
                </div>
            </div>    
        </section>
        <section id='footer'>
            <?php $this->load->view(THEME . 'layout/inc-footer'); ?>
        </section>
        <?php $this->load->view(THEME . 'layout/inc-before-body-close'); ?>
    </body>
</html>