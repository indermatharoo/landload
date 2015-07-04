<div class="col-lg-12">
    <div class="addevent">
        <form enctype="multipart/form-data" class="form" id="frmCreateEvent" method="post" action="calender/bookings/edit/<?= $booking['booking_id']; ?> " novalidate="novalidate">
            <div class="box-header ui-sortable-handle">
                <div class="pull-right box-tools">
                    <button style="margin-right: 5px;" title="" data-toggle="tooltip" data-widget="collapse" class="btn btn-default btn-sm " data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                    <!--<button title="" data-toggle="tooltip" data-widget="remove" class="btn btn-default btn-sm" data-original-title="Remove"><i class="fa fa-times"></i></button>-->
                </div>
                <i class="fa fa-map-marker"></i>
                <h3 class="box-title">
                    Add Booking
                </h3>
            </div>
            <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
            <div id="content" class="box-body content-middle">
                <h4 class="box-title text-center"> Booking Details</h4>
                <div class="form-group ">
                    <label class="title">Event</label>
                    <select class="form-control" id="category_id" name="event_id">
                        <option value="">-- Choose --</option>
                        <?php
                        foreach ($events as $event) {
                            echo '<option value="' . $event['event_id'] . '">' . $event['event_title'] . ' | from ' . $event['event_start_ts'] . ' till ' . $event['event_end_ts'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="title">Booking ID</label>
                    <input type="text" class="form-control" value="<?= $booking['unique_id'] ?>" name="unique_id">
                </div>

                <div class="form-group">
                    <label class="title">Status</label>
                    <select class="form-control" id="booking_status" name="booking_status">
                        <option value="">-- Choose --</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="pending">Pending</option>
                        <option value="">Cancelled</option>
                    </select>
                </div>
                <div class="form-group payment_method" style="display: none;">
                    <label class="title displayblock">Payment Method</label>
                    <div class="col-lg-6">
                        <select class="form-control" id="payment_method" name="payment_method">
                            <option value="cash">Cash</option>
                            <option value="paypal">Paypal</option>
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" name="booking_total" class="form-control" value="<?=$booking['booking_total'];?>" placeholder="Total Amount Paid"/>
                    </div>

                </div>
                <div class="form-group">
                    <label class="title">Select Customer</label>
                    <?php echo form_dropdown('customer_id', $customer, set_value('customer_id', $booking['customer_id']), ' class="form-control"'); ?>

                </div>
                <div class="form-group">
                    <label class="title">Tickets</label>
                    <input type="text" name="ctn" class="form-control" placeholder="Number of tickets" value="<?=$booking['ctn'];?>"/>
                </div>
                <div class="form-group">
                    <label class="title">Note</label>
                    <textarea name="customer_notes" class="form-control"><?=$booking['customer_notes'];?></textarea>
                </div>
                <div class="form-group clearfix">
                    <input type="hidden" name="event_id" value="<?= $event['event_id']; ?>">
                    <input type="hidden" class="btn btn-primary pull-right" name="created" value="<?= time(); ?>">
                    <input type="submit" class="btn btn-primary pull-right" value="Save">
                </div>
            </div>
        </form>
    </div>
</div><?php $this->load->view('header/booking_add'); ?>