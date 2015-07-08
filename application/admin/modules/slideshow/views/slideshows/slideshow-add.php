<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <a href="slideshow" style="color: #fff;" title="Add Slide Show"><i class="fa fa-arrow-left fa-2x"></i></a>
        </div>
        <div class="col-sm-11">
            <h3 style="margin: 0; text-align: center">Add Slide Show</h3>
        </div>
    </div>
</header>
<div class="col-sm-12 padding-0 mar-top20">
    <?php $this->load->view('inc-messages'); ?>
    <form action="slideshow/add/" method="post" enctype="multipart/form-data" name="add_frm" id="add_frm">
        <div class="form-group">
            <label class="control-label">Slideshow Title <span class="">*</span></label>
            <input type="text" name="slideshow_title" id="slideshow_title" class="form-control" required=""/>
        </div>
        <div class="form-group">
            <label class="control-label">Slideshow URL <span class="">*</span></label>
            <input type="text" name="slideshow_alias" id="slideshow_alias" class="form-control" required="" value="<?php echo set_value('slideshow_alias'); ?>"/>
        </div>
        <p>Fields marked with <span class="">*</span> are required.</p>
        <p><input type="submit" name="button" id="button" value="Submit" class="btn btn-primary"></p>

    </form>
</div>