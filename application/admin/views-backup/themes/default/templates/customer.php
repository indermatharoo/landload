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
    </head>
    <body>
        <header id='header' class='pageTop'>
            <?php $this->load->view(THEME . 'layout/inc-header'); ?>
        </header>
        <section id='main-content'>
            <div class="container">
                <div class="row content-bg">
                    <div class="col-lg-7 pad-left30 pad-top20">
                        <?php echo $content; ?>
                    </div>
                    <div class="col-lg-5 pad-top20">
                        <?php $this->load->view(THEME . 'layout/inc-menu-customer'); ?>
                        <?php
                        $path = $this->router->fetch_class().'/'.$this->router->fetch_method();
                        if($path == 'customer/index' || $path == 'customer/addedit'){
                        $this->load->view(THEME . 'layout/inc-add-cust');
                        }
                        ?>
                        <?php $this->load->view(THEME . 'layout/inc-notifications'); ?>
                    </div>
                </div>    
            </div>
        </section>
        <section id='footer'>
            <?php $this->load->view(THEME . 'layout/inc-footer'); ?>
        </section>
        <?php $this->load->view(THEME . 'layout/inc-before-body-close'); ?>
    </body>
</html>