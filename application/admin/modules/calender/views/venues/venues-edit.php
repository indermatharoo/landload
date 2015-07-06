<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <a href="calender/venues"><h3 style="margin: 0; color: #fff"><i class="fa fa-arrow-left" title="Manage Venue"></i></h3></a>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Edit Venue</h3>
        </div>
    </div>
</header>
<div class="col-sm-12">
    <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
</div>
<div class="col-sm-12 padding-0 mar-top10">
    <form enctype="multipart/form-data" class="form" id="frmCreateEvent" method="post" action="calender/venues/edit/<?= $vanue['venue_id']; ?>" novalidate="novalidate">
        <div class="form-group">
            <label class="title">Venue Name</label>
            <input type="text" name="venue_name" class="form-control" id="" value="<?= $vanue['venue_name']; ?>">
        </div>
        <div class="form-group">
            <label class="title">Email Address</label>
            <input type="text" name="email" class="form-control" id="" value="<?= $vanue['email']; ?>">
        </div>
        <div class="form-group">
            <label class="title">Phone No.</label>
            <input type="text" name="phone" class="form-control" id="" value="<?= $vanue['phone']; ?>">
        </div>
        <div class="form-group">
            <label class="title">City</label>
            <input type="text" name="city" class="form-control" id="" value="<?= $vanue['city']; ?>">
        </div>
        <div class="form-group">
            <label class="title">State</label>
            <input type="text" name="state" class="form-control" id="" value="<?= $vanue['state']; ?>">
        </div>
        <div class="form-group">
            <label class="title">Country</label>
            <input type="text" name="country" class="form-control" id="" value="<?= $vanue['country']; ?>">
        </div>
        <div class="form-group">
            <label class="title">Postal Code</label>
            <input type="text" name="postcode" class="form-control" id="" value="<?= $vanue['postcode']; ?>">
        </div>
        <div class="form-group">
            <label class="title">Address</label>
            <input type="text" name="address" class="form-control" id="" value="<?= $vanue['address']; ?>">
        </div>

        <div class="form-group">
            <label class="title">Description</label>
            <textarea name="description" class="form-control" ><?= $vanue['description']; ?></textarea>
        </div>
        <div class="form-group">
            <div class="col-lg-2">
                <label class="title">Image</label>
            </div>
            <div class="col-lg-6">
                <input type="file" id="event_img" name="image">
            </div>
            <div class="col-lg-4">
                <?php if ($vanue['venue_image']) { ?>
                    <img width="100" src="<?php echo $this->config->item('UPLOAD_URL_VENUES') . $vanue['venue_image']; ?>"  /> 
                <?php } ?>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary pull-right">Submit</button>
        </div>
    </form>
</div>