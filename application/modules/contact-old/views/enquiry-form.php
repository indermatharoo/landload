<div class="col-sm-12 padding-0">

    <div class="row">

        <?php $this->load->view('inc-messages'); ?>

    </div>

    <form method="POST" name="" action="contact/">

        <div class="clearfix">

            <div class="col-sm-12 mar-bot10">

                <label class="control-label common-form-lay form-control"><?= $eventDetail['uname']; ?></label>

            </div>

            <div class="col-sm-12 mar-bot10">

                <label class="control-label common-form-lay form-control"><?= $eventDetail['event_title']; ?></label>

            </div>

            <div class="col-sm-12 mar-bot10">

                <label class="control-label common-form-lay form-control"><?= date("d-m-Y h:m", strtotime($eventDetail['event_start_ts'])), ' - ', date("d-m-Y h:m", strtotime($eventDetail['event_end_ts'])); ?></label>


                <label class="control-label common-form-lay form-control"><?= date("d-m-Y h:m", strtotime($eventDetail['event_start_ts'])), ' - ', date("d-m-Y h:m", strtotime($eventDetail['event_end_ts'])); ?></label>


            </div>            

            <div class="col-sm-12 mar-bot10">

                <label class="control-label common-form-lay form-control" placeholder="Description">

                    <?= character_limiter($eventDetail['description'], 70) . (strlen($eventDetail['description']) > 70 ? '...' : ''); ?>

                </label>

            </div>

            <?php

            echo form_hidden('event_id', $eventDetail['event_id']);

            echo form_hidden('event_user_id', $eventDetail['user_id']);

            echo form_hidden('ispost', 1);

            ?>

        </div>

        <div class="form-group clearfix">

            <div class="col-sm-6">

                <input id="fname" class="form-control" maxlength="100" name="first_name" required="required" type="text" value="" placeholder="First Name *"/>

            </div>

            <div class="col-sm-6">

                <input id="lname" class="form-control" maxlength="100" name="last_name" required="required" type="text" value="" placeholder="Last Name *"/>

            </div>

        </div>

        <div class="form-group clearfix">

            <div class="col-sm-6">

                <input id="tele" class="form-control" maxlength="100" name="tel_number" required="required" type="text" value="" placeholder="Telephone Number *"/>

            </div>

            <div class="col-sm-6">

                <input id="email" class="form-control" maxlength="100" name="email_addr" required="required" type="text" value="" placeholder="Email *"/>

            </div>

        </div>

        <div class="form-group clearfix">

            <div class="col-sm-6">

                <input id="pcode" class="form-control" maxlength="100" name="post_code" required="required" type="text" value="" placeholder="Post Code *"/>

            </div>

            <div class="col-sm-6">

                <input id="hear" class="form-control" maxlength="100" name="how_reach" type="text" value="" placeholder="How did you hear about us"/>

            </div>

        </div>

        <div class="form-group">

            <div class="col-sm-12">

                <textarea id="contents" class="form-control" maxlength="100" name="enquiry" placeholder="Enquiry *"></textarea>

            </div>

        </div>

        <div class="form-group">

            <div class="col-sm-12">

                <label class="control-label">Receive news and updates</label>

                <input maxlength="100" name="receive_update_news" type="checkbox" value="1" />

            </div>

        </div>

        <div class="form-group">

            <p style="text-align: center;">Fields marked with <span class="error">*</span> are required.</p>

            <p style="text-align: center;"><input id="button" class="btn btn-primary" name="button" type="submit" value="Submit" /></p>

        </div>

    </form>

</div>
