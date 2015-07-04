<header>
    <div class="top-menu">
        <div class="container">
            <div class="col-lg-6 col-sm-12 col-xs-12 right padding-0">
                <?php $this->load->view("themes/" . THEME . "/layout/inc-top"); ?>
            </div>
        </div>
    </div>
    <div class="redbg">
        <div class="container">
            <div class="col-lg-3 col-sm-2 col-xs-6">
                <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>images/logo.png" alt="The Creationstation" class="img-responsive logo"/></a>
            </div>
            <div class="col-lg-9 col-sm-10 col-xs-12 padding-0">
                <?php $this->load->view("themes/" . THEME . "/layout/inc-menu"); ?>
            </div>
        </div>
    </div>
</header>