<div class="full_topbar_container">
    <div class="container">
        <div class="row">
            <div class="topbar_left_section">
                <div class="col-md-6">
                    <ul class="list-unstyled list-inline">
                        <li> <a href="#"><i class="fa fa-twitter"></i> </a> </li>
                              <li> <a href="#"><i class="fa fa-facebook "></i></a> </li>
                              <li> <a href="#"><i class="fa fa-google-plus"></i> </a> </li>
                              <li> <a href="#"><i class="fa fa-linkedin"></i></a> </li>
                              <li> <a href="#"><i class="fa fa-pinterest-p"></i> </a> </li>
                              <li> <a href="#"><i class="fa fa-skype"></i> </a> </li>
<!--                        <li> <i class="fa fa-phone"></i><?= DWS_CONTACT_NUMBER; ?> </li>
                        <li> <a href="mailto:<?= DWS_EMAIL_ADMIN; ?>"><i class="fa fa-envelope-o "></i><?= DWS_EMAIL_ADMIN; ?></a> </li>-->
                    </ul>
                </div>
            </div>
            <?php /* ?>
            <div class="topbar_left_section text-right">
                <div class="col-md-6">
                    <ul class="list-unstyled list-inline">
                        <li><i class="fa fa-clock-o fa-lg"></i><span id="curdate">Monday 7/27/2015 â€“ 11:33:37 am</span></li>
                    </ul>                    
                </div>
            </div>
            
            <script>
                $(document).ready(function () {
                    DisplayCurrentTime();
                });
                function DisplayCurrentTime() {
                    var dt = new Date();
                    var refresh = 1000; //Refresh rate 1000 milli sec means 1 sec
                    var cDate = (dt.getMonth() + 1) + "/" + dt.getDate() + "/" + dt.getFullYear();
                    var d = new Date();
                    var n = d.getDay();
                    var dayname = '';
                    switch (n) {
                        case 0:
                            dayname = 'Sunday';
                            break;
                        case 1:
                            dayname = 'Monday';
                            break;
                        case 2:
                            dayname = 'Tuesday';
                            break;
                        case 3:
                            dayname = 'Wednesday';
                            break;
                        case 4:
                            dayname = 'Thursday';
                            break;
                        case 5:
                            dayname = 'Friday';
                            break;
                        case 6:
                            dayname = 'Saturday';
                            break;
                    }
                    document.getElementById('curdate').innerHTML = dayname + ' ' + cDate + " â€“ " + dt.toLocaleTimeString();
                    window.setTimeout('DisplayCurrentTime()', refresh);
                }
            </script>
            <?php */ ?>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="top-login-links text-right">
                <ul class="list-unstyled list-inline"> 
                    <?php if (!$this->aauth->isCustomer()) { ?>
                        <li> <a href="<?php echo createUrl('customer/login'); ?>"> <i class="fa fa-key"></i> Login</a></li>
                        <li> <a href="<?php echo createUrl('customer/register'); ?>"> <i class="fa fa-user"></i> Sign up</a></li>
                    <?php } else { ?>
                        <li> <a href="<?php echo createUrl('customer/dashboard'); ?>"> <i class="fa fa-dashcube"></i> Dashboard</a></li>
                        <li> <a href="<?php echo createUrl('customer/dashboard'); ?>"> <i class="fa fa-dashcube"></i> <?php echo $this->session->userdata('fname') ?></a></li>
                        <li> <a href="<?php echo createUrl('customer/logout'); ?>"> <i class="fa fa-dashcube"></i> Sign out</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Static navbar -->
<div class="clearfix"></div>

<div class="container">
          <div class="row">
              <div class="col-md-4 col-sm-6">
                   <div class="logo_container">
                        <div class="logo">
                            <a href="<?php echo  base_url() ?>">
                                <img src="/imgs/logo.png" class="logo-img"/>
                            </a>
                        </div>
                    </div>
              </div>
              
              <div class="col-md-8 col-sm-6">
                   <div class="right_logo_container  navbar-right">
                        <div class="right_logo">
                            <ul class="list-unstyled">
                                <li><i class="fa fa-phone"></i> 215 -368- 1234</li>
                                <li><i class="fa fa-envelope-o"></i> email@domainname.com</li>
                            </ul>
                        </div>
                    </div>
              </div>
              
          </div>
</div>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <?php $this->load->view("themes/" . THEME . "/layout/inc-menu"); ?>
    </div>
</nav>