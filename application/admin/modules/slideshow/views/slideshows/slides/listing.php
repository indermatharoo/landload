<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <a href="slideshow/index" style="color: #fff;" title="Manage Slide Shows"><i class="fa fa-arrow-left fa-2x"></i></a>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Manage <?php echo $slideshow['slideshow_title']; ?> Slides</h3>
        </div>
        <div class="col-sm-1">
            <a href="slideshow/slide/add/<?php echo $slideshow['slideshow_id']; ?>" style="color: #fff;" title="Add Slide"><i class="fa fa-plus-square fa-2x"></i></a>
        </div>
    </div>
</header>
<div class="col-sm-12 padding-0 mar-top20">
    <?php $this->load->view('inc-messages'); ?>
    <div class="tableWrapper">
        <div class="main_action" style="padding-bottom:20px;">
            <div class="category_name" style="float:left; padding-left:15px; font-size:12px; font-weight:bold;">Slide Image</div>
            <div class="action" style="float:right; padding-right:30px; font-size:12px; font-weight:bold">Action</div>
        </div>
        <?php echo $slidetree; ?>
    </div>

    <div id="dialog-modal" title="Working">
        <p style="text-align: center; padding-top: 40px;">Updating the sort order...</p>
    </div>
</div>