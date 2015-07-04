<div class="col-sm-12 padding-0">
    <div class="row">
        <?php $this->load->view('inc-messages'); ?>
    </div>
    <p>Thanks for wanting to find out more about this exciting opportunity. Simply complete the form below and click submit and we will send you some really interesting information.</p>
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
                <input id="email" class="form-control" name="email_addr" required="required" type="text" value="" placeholder="Email *"/>
            </div>
            <div class="col-sm-6">
                <input id="tele" class="form-control" name="tel_number" required="required" type="text" value="" placeholder="Telephone number *"/>
            </div>
        </div>
        <div class="form-group clearfix">
            <div class="col-sm-6">
                <input id="address1" class="form-control" name="address1" required="required" type="text" value="" placeholder="address1 *"/>
            </div>
            <div class="col-sm-6">
                <input id="address2" class="form-control" name="address2" type="text" value="" placeholder="address2"/>
            </div>
        </div>
        <div class="form-group clearfix">
            <div class="col-sm-6">
                <input id="city" class="form-control" name="city" required="required" type="text" value="" placeholder="town/city *"/>
            </div>
            <div class="col-sm-6">
                <input id="county" class="form-control" name="county" required="required" type="text" value="" placeholder="county *"/>
            </div>
        </div>
        <div class="form-group clearfix">
            <div class="col-sm-6">
                <input id="pcode" class="form-control" name="post_code" required="required" type="text" value="" placeholder="Post code *"/>
            </div>
            <div class="col-sm-6">
                It's really helpful if you can let us know where did you hear about us - many thanks.
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
            <p style="text-align: center;"><input id="button" class="btn btn-primary" name="button" type="submit" value="Submit" /></p>
            <p style="text-align: center;">Fields marked with <span class="error">*</span> are required.</p>
        </div>
    </form>
</div>