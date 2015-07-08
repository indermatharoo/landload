<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <a href="slideshow/slide/index/<?php echo $slideshow['slideshow_id']; ?>" style="color: #fff;" title="Manage Slideshow Images"><i class="fa fa-arrow-left fa-2x"></i></a>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Add <?php echo $slideshow['slideshow_title']; ?> Slide</h3>
        </div>
        <div class="col-sm-1">
            <a href="slideshow/index" style="color: #fff;" title="Manage Slide Show"><i class="fa fa-home fa-2x"></i></a>
        </div>
    </div>
</header>
<div class="col-sm-12 padding-0 mar-top20">
    <?php $this->load->view('inc-messages'); ?>
    <form action="slideshow/slide/add/<?php echo $slideshow['slideshow_id']; ?>" method="post" enctype="multipart/form-data" name="add_frm" id="add_frm">
        <div class="form-group">
            <label class="control-label">Slideshow Image <span class="">*</span></label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label">Alt</label>
            <input type="text" name="alt" id="alt" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label">Link</label>
            <input type="text" name="link" id="link" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label">New Window</label>
            <input type="radio" name="new_window" value="1" <?php echo set_radio("new_window", 1, true); ?> />Yes
            <input type="radio" name="new_window" value="0" <?php echo set_radio("new_window", 0); ?> />No
        </div>
        <input name="v_image" type="hidden" id="v_image" value="1" />
        <p>Fields marked with <span class="">*</span> are required.</p>
        <p><input type="submit" name="upload_btn" id="upload_btn" value="Upload" class="btn btn-primary"></p>
    </form>
</div>