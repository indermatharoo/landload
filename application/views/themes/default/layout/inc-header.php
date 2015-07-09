<div class="full_topbar_container">
    <div class="container">
        <div class="row">
            <div class="topbar_left_section">
                <div class="col-md-6">
                    <ul class="list-unstyled list-inline">
                        <li> <i class="fa fa-phone"></i><?= DWS_CONTACT_NUMBER; ?> </li>
                        <li> <a href="mailto:<?= DWS_EMAIL_ADMIN; ?>"><i class="fa fa-envelope-o "></i><?= DWS_EMAIL_ADMIN; ?></a> </li>
                    </ul>
                </div>
            </div>

            <div class="topbar_left_section text-right">
                <div class="col-md-6">
                    <ul class="list-unstyled list-inline">
                        <li>Open 24 hrs 7 days a week  | </li> 
                        <li>Mon - Sat: 7.00 - 18.00 - Sunday: Closed</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="top-login-links text-right">
                <ul class="list-unstyled list-inline"> 
                    <li> <a href="customer/login"> <i class="fa fa-key"></i> Login</a></li>
                    <li> <a href="customer/register"> <i class="fa fa-user"></i> Sign up</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Static navbar -->
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <?php $this->load->view("themes/" . THEME . "/layout/inc-menu"); 
       
        ?>
    </div>
</nav>