<div class="row content-bg">
    <div class="col-lg-7">
        <header class="panel-heading">
            <div class="row">
                <div class="col-sm-6">
                    <h3 style="margin: 0">Upcoming Events</h3>
                </div>
            </div>
        </header>
        <br/>
        <?php foreach ($events as $evt): ?>
            <div class="col-lg-12">
                <div>
                    <span>Title</span>: <span><?php echo arrIndex($evt, 'event_title') ?></span>
                </div>
                <div>
                    <span>Description</span>: <span><?php echo arrIndex($evt, 'description') ?></span>
                </div>
                <div>
                    <span>Start Time</span>: <span><?php echo arrIndex($evt, 'event_start_ts') ?></span>        
                </div>
                <div>
                    <span>Terms</span>: <span><?php echo arrIndex($evt, 'terms') ?></span>        
                </div>
                <br/>
            </div>
        <?php endforeach; ?>
    </div>
    <div id="right-column" class="col-lg-5">
        <div class="col-lg-12 menu padding-0">
            <?php $this->load->view(THEME . 'layout/inc-menu-customer-dashboard'); ?>
        </div>

        <?php $this->load->view(THEME . 'layout/inc-notifications'); ?>
        <div class="col-lg-12 social-part">
            <div class="row">
                <div class="col-lg-6">
                    <div class="social-top">
                        <img src="images/fb.jpg" alt="facebook" />
                    </div>
                    <div class="social">
                        <div class="social-content">

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="social-top">
                        <img src="images/tw.jpg" alt="twitter" />
                    </div>
                    <div class="social">
                        <div class="social-content">

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="social-top">
                        <img src="images/gp.jpg" alt="google+" />
                    </div>
                    <div class="social">
                        <div class="social-content">

                        </div>
                    </div>
                </div>
                <div class=" col-lg-6">
                    <div class="social-top">
                        <img src="images/li.jpg" alt="linkedin" />
                    </div>
                    <div class="social">
                        <div class="social-content">

                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>