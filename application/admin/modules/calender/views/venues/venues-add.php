<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <a href="calender/venues"><h3 style="margin: 0; color: #fff"><i class="fa fa-arrow-left" title="Manage Venue"></i></h3></a>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Add Venue</h3>
        </div>
    </div>
</header>
<div class="col-sm-12">
    <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
</div>
<div class="col-sm-12 padding-0 mar-top10">
    <form enctype="multipart/form-data" class="form" id="frmCreateEvent" method="post" action="calender/venues/add " novalidate="novalidate">
        <div class="form-group">
            <label class="title">Venue Name</label>
            <input type="text" name="venue_name" class="form-control" id="" value=""/>
        </div>
        <div class="form-group">
            <label class="title">Email Address</label>
            <input type="text" name="email" class="form-control" id="" value="">
        </div>
        <div class="form-group">
            <label class="title">Phone No.</label>
            <input type="text" name="phone" class="form-control" id="" value="">
        </div>
        <div class="form-group">
            <label class="title">City</label>
            <input type="text" name="city" class="form-control" id="" value="">
        </div>
        <div class="form-group">
            <label class="title">State</label>
            <input type="text" name="state" class="form-control" id="" value="">
        </div>
        <div class="form-group">
            <label class="title">Country</label>
            <input type="text" name="country" class="form-control" id="" value="">
        </div>
        <div class="form-group">
            <label class="title">Postal Code</label>
            <input type="text" name="postcode" class="form-control" id="" value="">
        </div>
        <div class="form-group">
            <label class="title">Address</label>
            <input type="text" name="address" class="form-control" id="" value="">
        </div>

        <div class="form-group">
            <label class="title">Description</label>
            <textarea name="description" class="form-control" ></textarea>
        </div>
        <div class="form-group">
            <label class="title">Image</label>
            <input type="file" class=""  name="image">
        </div>
        <div class="clearfix"></div>
        <div class="form-group clearfix">
            <input name="v_image" type="hidden" id="v_image" value="1" />
            <button type="submit" class="btn btn-primary pull-right">Submit</button>
        </div>
    </form>
</div>