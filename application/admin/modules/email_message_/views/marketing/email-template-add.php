<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <a href="email_message/index/1"><h3 style="margin: 0; color: #fff"><i class="fa fa-arrow-left" title="Manage Email Template"></i></h3></a>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Add New Email Template</h3>
        </div>
    </div>
</header>
<div class="col-sm-12">
    <?php
    $tab1 = 'active';
    $this->load->view(THEME . 'messages/inc-messages');
    ?>
</div>
<div class="col-sm-12 padding-0" style="margin-top: 15px;">
    <form action="email_message/add/" method="post" enctype="multipart/form-data" name="editemlform" id="editemlform">
        <div class="form-group">
            <label class="">Name <span class="error">*</span></label>
            <input name="email_name" type="text" class="textfield form-control" size="40" id="email_name" value="<?php echo set_value('email_name'); ?>" />
        </div>
        <div class="form-group">
            <label class="">Email Subject <span class="error">*</span></label>
            <input name="email_name" type="text" class="textfield form-control" size="40" id="email_name" value="<?php echo set_value('email_name'); ?>" />
        </div>
        <div class="form-group">
            <label class="">Email Content <span class="error">*</span></label>
            <textarea name="email_content" type="text" class="textfield form-control editor" style="width: 90%" id="email_content" rows="5" cols="100"><?php echo set_value('email_content'); ?></textarea>
        </div>
        <div class="form-group center">
            Fields marked with <span class="error">*</span> are required.
            <p style="text-align:center"><input type="submit" name="button" id="button" value="Submit" class="btn btn-primary"></p>
        </div>
    </form>
</div>    