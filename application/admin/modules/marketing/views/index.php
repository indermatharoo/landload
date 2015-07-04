<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <i class="fa fa-envelope-o fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Send <?php echo $send_email ? "Email" : "SMS"; ?></h3>
        </div>
    </div>
</header>
<div class="col-sm-12 mar-top10 padding-0">
    <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
    <form action="<?php echo ($send_email == 1 ) ? 'marketing/SendEmail' : 'marketing/' ?>" 
          method="POST" 
          enctype="multipart/form-data" 
          name="filter_frm" 
          id="filter_frm">
        <input type="hidden" 
               name="mode" 
               value="<?php echo ($send_email == 1 ) ? 'email' : 'sms' ?>"
               />
        <div class="col-sm-12 padding-0">
            <?php if ($send_email == 1) { ?>
                <label>Select Email Template <span class="error">*</span></label>
                <div class="col-sm-12 padding-0">
                    <?php
                    if ($email_detail) {
                        echo form_dropdown('email', $emails, set_value('email', $email_detail['email_content_id']), 'class="form-control template_type" data-type="email"');
                    } else {

                        echo form_dropdown('email', $emails, set_value('email'), 'class="form-control template_type" data-type="email"');
                    }
                    ?>
                </div>
            <?php } else { ?>
                <label>Select SMS Template <span class="error">*</span></label>
                <div class="col-sm-12 padding-0">
                    <?php echo form_dropdown('sms', $sms_template, set_value('sms'), 'class="form-control template_type" data-type="sms"'); ?>
                </div>
            <?php } ?>
        </div>
        <div class="col-sm-12 padding-0">
            <label>Select</label>
            <div class="col-sm-12 padding-0">
                <div class="col-sm-6 padding-0">
                    <?php
                    $grpArr = $this->aauth->list_group_key_pair_form();
                    $grpArr[0] = 'Select Group';
                    ksort($grpArr);
                    $extraJs = ' id = "group" form-control ';
                    $selected = '';
                    echo form_dropdown('group', $grpArr, $selected, $extraJs);
                    ?>
                </div>
                <div class="col-sm-6 padding-0">
                    <div id="assignArea" class="pull-right"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 padding-0">
            <p><input type="submit" name="button" value="<?php echo ($send_email == 1) ? 'Send Email' : 'Send SMS' ?>" class="btn btn-primary pull-right"></p>
        </div>
        <div class="col-sm-12 mar-top15 padding-0">
            <iframe src="" class="template_view" width="100%" height="400"></iframe>
        </div>
    </form>
</div>
<?php $this->load->view('headers/marketing_index'); ?>