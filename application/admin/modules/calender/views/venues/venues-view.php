<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <a href="calender/venues"><h3 style="margin: 0; color: #fff"><i class="fa fa-arrow-left" title="Manage Venue"></i></h3></a>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Venue</h3>
        </div>
    </div>

</header>
<div class="col-sm-12">
    <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
</div>
<div class="col-lg-12 padding-0 mar-top10">
    <div class="col-lg-6">
        <div>
            <span>Name</span>
            <span><?php echo arrIndex($model, 'name') ?></span>
        </div>
        <div>
            <span>Email</span>
            <span><?php echo arrIndex($model, 'email') ?></span>
        </div>
        <div>
            <span>Phone</span>
            <span><?php echo arrIndex($model, 'phone') ?></span>
        </div>
        <div>
            <span>City</span>
            <span><?php echo arrIndex($model, 'city') ?></span>
        </div>
        <div>
            <span>State</span>
            <span><?php echo arrIndex($model, 'state') ?></span>
        </div>
        <div>
            <span>Country</span>
            <span><?php echo arrIndex($model, 'country') ?></span>
        </div>
        <div>
            <span>Postcode</span>
            <span><?php echo arrIndex($model, 'postcode') ?></span>
        </div>
        <div>
            <span>Address</span>
            <span><?php echo arrIndex($model, 'address') ?></span>
        </div>
        <div>
            <span>Description</span>
            <span><?php echo arrIndex($model, 'description') ?></span>
        </div>
    </div>
    <div class="col-lg-6">
        <img src="<?php echo base_url() . 'upload/events/' . arrIndex($model, 'venue_image') ?>"/>
    </div>

</div>
