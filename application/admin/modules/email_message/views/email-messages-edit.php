<?php
$tab1 = 'active';
$tab2 = '';
?>
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-6">
            <a href="<?php echo $messages['marketing_email'] == 1 ? 'email_message/index/1' : 'email_message/index' ?>">
                <h3 style="color: #fff; cursor: pointer; margin: 0"><i class="fa fa-arrow-left"></i><?php echo $messages['marketing_email'] == 1 ? 'Manage Email Template' : 'Manage Email Content' ?></h3></a>
        </div>
        <div class="col-sm-6">
            <h3 style="margin: 0; text-align: center">Edit marketing email<?php echo $messages['marketing_email'] == 1 ? ' template' : ' content' ?></h3>
        </div>
    </div>
</header>
<div class="col-sm-12">
    <?php
    $this->load->view(THEME . 'messages/inc-messages');
    ?>
</div>
<div class="col-sm-12 padding-0 mar-top15">                
    <form action="email_message/edit/<?php echo $messages['email_content_id']; ?>" method="post" enctype="multipart/form-data" name="editemlform" id="editemlform">
        <div class="form-group">
            <label class="">Name <span class="error">*</span></label>
            <input name="email_name" type="text" class="textfield form-control" size="40" id="email_name" value="<?php echo set_value('email_name', $messages['email_name']); ?>" />
        </div>
        <div class="form-group">
            <label class="">Email Subject <span class="error">*</span></label>
            <input name="email_subject" type="text" class="form-control textfield" size="40" id="email_subject" value="<?php echo set_value('email_subject', $messages['email_subject']); ?>" />
        </div>
        <div class="form-group">
            <label class="">Email Content <span class="error">*</span></label>
            <textarea name="email_content" type="text" class="form-control textfield editor" style="height: 400px" id="email_content" rows="5" cols="100"><?php echo set_value('email_content', $messages['email_content']); ?></textarea>
        </div>
        <div class="form-group center">
            Fields marked with <span class="error">*</span> are required.
            <p><input type="submit" name="button" id="button" value="Submit" class="btn btn-primary"></p>
        </div>
    </form>
</div>
