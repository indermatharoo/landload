<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>Welcome To LandLord Masters Admin Panel</title>
        <base href="<?php echo base_url(); ?>" />
        <!-- Stylesheet -->
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen" />
        <!--[if lte IE 6]>
        <link rel="stylesheet" type="text/css" href="css/css_iehacks.css" />
        <![endif]-->
        <!--[if lte IE 7]>
        <link rel="stylesheet" type="text/css" href="css/css_ie7hacks.css" />
        <![endif]-->

        <!-- Meta Tags -->
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    </head>
    <body>
        <div class="pageTop">
            <div class="container">
                <a href="<?php echo base_url(); ?>"><img src="images/logo.png" class="logo" alt="" border="0" /></a>
            </div>
        </div>
        <div class="container">
            <div class="content-area">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Control panel login</h1>
                    </div>
                    <div class="col-lg-6">
                        <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
                        <form action=<?= createUrl("welcome/index/"); ?> method="post" enctype="multipart/form-data">
                            <?php echo form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()); ?>
                            <div class="form-group">
                                <label for="username" class="control-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="" required="" title="Please enter you username" placeholder="user name">
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">Password</label>
                                <input type="password" class="form-control" id="password" name="passwd" value="" required="" title="Please enter your password" placeholder='password'>
                            </div>
                            <div id="loginErrorMsg" class="alert alert-error hide">Wrong username og password</div>
<!--                            <div class="form-group">
                                <input type="radio" name="login_type" value="Admin" <?php echo set_radio('login_type', 'Admin', TRUE); ?> />Admin
                                <input type="radio" name="login_type" value="Company" <?php echo set_radio('login_type', 'Company'); ?> />Company
                                <input type="radio" name="login_type" value="Branch" <?php echo set_radio('login_type', 'Branch'); ?> />Branch
                            </div>-->
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <div class="innerRight">
                            <h2>Authentication Required</h2>
                            <p>In order to gain access to the control panel please authenticate yourself.</p>
                            <p>If you don't have an account, please contact the site Administrator.</p>
                            <h2>Forgotten your password?</h2>
                            <p>If you lost your password or other needed account details, please use the <a href=<?= createUrl("welcome/lostpasswd/"); ?>>retreive account</a> section of the website.</p>
                            <p><small>Your IP is being logged for security reasons.</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer"><?php $this->load->view(THEME .'layout/inc-footer'); ?></div>
    </body>
</html>