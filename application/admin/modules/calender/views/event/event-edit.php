<?php $this->load->view('header/event_add'); ?>
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <a href="calender"><h3 style="margin: 0; color: #fff"><i class="fa fa-arrow-left" title="Manage Event"></i></h3></a>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Edit Event</h3>
        </div>
    </div>
</header>
<div class="col-lg-12 padding-0">
    <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
    <!-- Custom Tabs -->
    <form enctype="multipart/form-data" class="EventAddForm" id="frmCreateEvent" method="post" action="calender/edit/<?= $event['event_id']; ?>" novalidate="novalidate">
        <div class="nav-tabs-custom ">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Details</a></li>
                <li><a href="#tab_2" data-toggle="tab">Ticket</a></li>
                <!--                <li><a href="#tab_3" data-toggle="tab">Confirmation</a></li>
                                <li><a href="#tab_4" data-toggle="tab">Terms</a></li>-->
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="form-group">
                        <label class="displayblock" id="event_typeLabel">Event Type</label>
                        <?php echo form_dropdown('event_type_id', $types, set_value('event_type_id', $event['event_type_id']), ' class="form-control" id="event_type"'); ?>
                    </div>
                    <div class="form-group ">
                        <label class="displayblock" id="event_dateLabel">Event Date</label>
                        <input class="form-control" id="event_date" type="text" name="eventdate" value="<?= date('d-m-Y h:m', strtotime(trim($event['event_start_ts']))).' - '. date('d-m-Y h:m', strtotime(trim($event['event_end_ts']))) ?>" />
                    </div>
                    <div class="form-group">
                        <label class="displayblock" id="event_titleLabel">Event title</label>
                        <input type="text" id="event_title" class="form-control" value="<?= $event['event_title'] ?>" id="event_title" name="event_title">
                    </div>
                    <div class="form-group">
                        <label class="displayblock" id="event_venueLable">Venue</label>
                        <?php echo form_dropdown('venue_id', $venues, set_value('venue_id', $event['venue_id']), ' class="form-control" id="location"'); ?>
                    </div>
                    <div class="form-group">
                        <label class="displayblock">Description</label>
                        <span class="inline_block">
                            <textarea class="form-control editor" id="description" name="description"><?= $event['description'] ?></textarea>
                        </span>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4">
                            <label class="displayblock">Image</label>
                            <input type="file" class="" id="event_img" name="event_img">
                        </div>
                        <div class="col-lg-8">
                            <img width="100" src="<?php echo $this->config->item('UPLOAD_URL_EVENTS') . $event['event_img']; ?>"  /> 
                        </div>
                    </div>
                    <div class="form-group price_div">
                        <label >Price</label>
                        <?php
                        $count = 0;
                        foreach ($prices as $price) {
                            ?>
                            <div class="form-group col-lg-12 padding-0">
                                <div class="col-lg-3">
                                    <label class="displayblock" for="event_priceTitleLabel" id="event_priceTitleLabel"></label>
                                    <input type="text" id="event_price_title" class="form-control" value="<?= $price['title'] ?>" placeholder="price title" name="title[]">
                                </div>
                                <div class="col-lg-3 ">
                                    <label class="displayblock" for="event_priceLabel" id="event_priceLabel"></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" id="event_price" class="form-control" value="<?= $price['price'] ?>" name="price[]">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label class="displayblock" for="event_priceTicketLabel" id="event_priceTicketLabel"></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Available tickets</span>
                                        <input type="number" id="event_price_ticket" class="form-control" value="<?= $price['available'] ?>" name="available[]" >
                                    </div>
                                </div>
                                <?php if ($count != 0) { ?>
                                    <div class="col-lg-2 padding-0">
                                        <label class="displayblock"></label>
                                        <button type="button" onclick="rmdiv(this)" class="btn btn-danger btn-fix-width pull-right">Remove</button>
                                    </div>
                                <?php } $count++; ?>
                            </div>
                        <?php } ?>
                    </div>
                    <!--                                <div class="form-group">
                                                        <input type="button" id="add_price" class="price-button" value="Add +">
                                                    </div>-->
                    <div class="form-group clearfix">
                        <input name="v_image" type="hidden" id="v_image" value="1" />
                        <input type="button" class="btn btn-primary btn-fix-width pull-right event_add" value="Save">
                    </div>

                </div>
                <div class="tab-pane" id="tab_2">
                    <div class="form-group">
                        <label class="title">Ticket Detail</label>
                        <textarea class="form-control editor" name="ticket_info"><?= $event['ticket_info']; ?></textarea>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-4">
                            <label class="displayblock">Ticket Image</label>
                        </div>
                        <div class="col-lg-4">
                            <input type="file" id="event_img" name="ticket_img">
                        </div>
                        <div class="col-lg-4">
                            <?php if ($event['ticket_img']) { ?>
                                <img width="100" src="<?php echo $this->config->item('UPLOAD_URL_TICKETS') . $event['ticket_img']; ?>"  /> 
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <input type="submit" class="btn btn-primary btn-fix-width pull-right" value="Save">
                    </div>
                </div>
                <!--                <div class="tab-pane" id="tab_3">
                                    <div class="form-bg"><b>Confirmation email</b></div>
                                    <div class="form-group">
                                        <label class="title">Subject</label> 
                                        <input class="form-control" type="text" name="email_confirmation_subject" value="<?= $event['o_email_confirmation_subject']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label class="title">Message</label>
                                        <textarea name="email_confirmation"  class="form-control editor"><?= $event['o_email_confirmation']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-bg"><b>Payment email</b></div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="title ">Subject</label>
                                        <input class="form-control" type="text" name="email_payment_subject" value="<?= $event['o_email_payment_subject']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label class="title">Message</label>
                                        <textarea name="email_payment" class="form-control editor"><?= $event['o_email_payment']; ?></textarea>
                                    </div>
                                    <div class="form-group clearfix">
                                        <input type="submit" class="btn btn-primary pull-right" value="Save">
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_4">
                                    <div class="form-group ">
                                        <label class="title">Term</label>
                                        <textarea class="form-control editor" name="terms"><?= $event['terms']; ?></textarea>
                                    </div>
                                    <div class="form-group clearfix">
                                        <input type="submit" class="btn btn-primary btn-fix-width pull-right" value="Save">
                                    </div>
                                </div>-->
            </div>
        </div>
    </form> 
    <!-- Custom Tabs end -->
</div>
