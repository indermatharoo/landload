<div class="top">
    <div class="row">
        <div class="col-lg-6 col-sm-3">
            <div class="admin_logo_section">
                <img src="images/logo.png" alt="" class="img-responsive"/>
            </div>
        </div>
        <div class="col-lg-6 col-sm-9">
            <div class="col-lg-6 col-sm-6">
                <div class="top-address">
                    <?php
                    $curUser = $this->aauth->get_user();
                    $edit_url = '';
                    if ($this->aauth->isAdmin()):
                        $edit_url = createUrl('user/edit/' . curUsrId());
                    elseif($this->aauth->isCompany()):
                        $edit_url = createUrl('company/edit/' . curUsrId());
                    elseif($this->aauth->isUser()):
                        $edit_url = createUrl('user/edit/' . curUsrId());                        
                    endif;
                    ?>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                <div class="header_top_timezone_container">
                    <div class="current_time_zone">
                        <!-- This span is where the clock will appear -->
                        <div class="time_title">
                            <span style=""><i class="fa fa-clock-o"></i></span> 
                            Current date and time: 
                        </div>
                        <div ID="cTime"></div>
                        <script type="text/javascript">
                            $(document).ready(function () {
                                DisplayCurrentTime();
                            });
                            function DisplayCurrentTime() {
                                var dt = new Date();
                                var refresh = 1000; //Refresh rate 1000 milli sec means 1 sec
                                var cDate = (dt.getMonth() + 1) + "/" + dt.getDate() + "/" + dt.getFullYear();
                                document.getElementById('cTime').innerHTML = cDate + " – " + dt.toLocaleTimeString();
                                window.setTimeout('DisplayCurrentTime()', refresh);
                            }
                        </script>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="account">
                    <p id="demo"></p>
                    <span style="color: #000;font-size: 17px;"> 
                        <i class="fa fa-user-secret"></i> 
                    </span>
                    <span style="">Welcome 
                        <a style="text-decoration: underline;" href="<?php echo $edit_url ?>">
                            <?php echo ucfirst($curUser->name); ?>
                        </a>
                    </span> | 
                    <a href="<?= createUrl('user/logout') ?>">
                        <span style="color: #170000;">Logout</span>
                    </a>
                </div> 
            </div>
        </div>
    </div>
</div>
