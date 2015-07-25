<h2><?php // echo $page['page_title']; ?></h2>
<?php //echo $page['page_contents']; ?>
<?php //load_form('contact-us'); ?>

<div class="col-sm-12 padding-0">
    <div class="row">
        <?php $this->load->view('inc-messages'); ?>
    </div>
    <form method="post" name="">
        <?php echo form_hidden('ispost', 1); ?>
        <div class="form-group clearfix">
            <div class="col-sm-6">
                <input id="fname" class="form-control" name="first_name" required="required" type="text" value="" placeholder="First name *"/>
            </div>
            <div class="col-sm-6">
                <input id="lname" class="form-control" name="last_name" required="required" type="text" value="" placeholder="Last name *"/>
            </div>
        </div>
        <div class="form-group clearfix">
            <div class="col-sm-6">
                <input id="tele" class="form-control" name="tel_number" required="required" type="text" value="" placeholder="Telephone number *"/>
            </div>
            <div class="col-sm-6">
                <input id="email" class="form-control" name="email_addr" required="required" type="text" value="" placeholder="Email *"/>
            </div>
        </div>
        <div class="form-group clearfix">
            <div class="col-sm-6">
                <input id="pcode" class="form-control" name="post_code" required="required" type="text" value="" placeholder="Post code *"/>
            </div>
            <div class="col-sm-6">
                <?php
                $optionArr = array();
                $selected = array();
                $extra = ' id="reason" class="col-sm-9 form-control" placeholder="Reason for enquiry"';
                foreach ($enquiryList as $key => $keyVal) {
                    $optionArr[arrIndex($keyVal, 'id')] = arrIndex($keyVal, 'desc');
                }
                echo form_dropdown('enq_reason', $optionArr, $selected, $extra);
                ?>
            </div>
        </div>
        <div class="form-group clearfix">
            <div class="col-sm-12">
                <textarea id="contents" class="form-control" name="enquiry" placeholder="Enquiry *"></textarea>
            </div>
        </div>
        <div class="form-group clearfix">
            <div class="col-sm-6">
                <input name="receive_update_news" type="checkbox" value="1" />&nbsp;&nbsp;Receive news and updates
            </div>
            <div class="col-sm-6">
                <input id="hear" class="form-control" name="how_reach" type="text" value="" placeholder="How did you hear about us"/>
            </div>
        </div>
        <div class="form-group clearfix">
            <input type="hidden" name="franchiseeId" value="<?= $franchise_id ?>">
            <p style="text-align: center;"><input id="button" class="btn btn-primary" name="button" type="submit" value="Submit" /></p>
            <p style="text-align: center;">Fields marked with <span class="error">*</span> are required.</p>
        </div>
    </form>
</div>