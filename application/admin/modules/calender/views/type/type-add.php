<?php $this->load->view('header/type_add'); ?>
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <a href="calender/type/index"><h3 style="margin: 0; color: #fff"><i class="fa fa-arrow-left" title="Manage Event Type"></i></h3></a>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Add Event Type</h3>
        </div>
    </div>
</header>
<div class="col-lg-12 mar-top10 padding-0">
    <form action="calender/type/add" method="post" enctype="multipart/form-data" name="addtypeform" id="addtypeform">
        <div class="form-group">
            <label>Class Room Name <span class="error"> *</span></label>
            <input name="event_type" type="text" class="form-control" id="event_type" value="<?php echo set_value('event_type'); ?>" size="40">
        </div>
        <div class="form-group">
            <label>Class Room Color <span class="error"> *</span></label>
            <input name="event_color" type="text" class="form-control my-colorpicker" id="event_color" value="<?php echo set_value('event_color'); ?>" size="40">
        </div>
        <div class="box-footer clearfix">
            <input type="submit" name="button" class="btn btn-primary pull-right" value="Submit">
        </div>
    </form>
</div>