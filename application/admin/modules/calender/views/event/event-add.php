<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <a href="calender"><h3 style="margin: 0; color: #fff"><i class="fa fa-arrow-left" title="Manage Event Type"></i></h3></a>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Add Event</h3>
        </div>
    </div>
</header>
<div class="col-lg-12 padding-0">
    <div class="addevent">
        <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
        <div id="content" class="box-body content-middle">
            <form enctype="multipart/form-data" class="EventAddForm" id="frmCreateEvent" method="post" action="calender/add " novalidate="novalidate">
                <div class="form-group ">
                    <label class="displayblock" id="event_typeLabel">Event Type</label>
                    <select class="form-control" id="event_type" name="event_type_id">
                        <option value="">-- Choose --</option>
                        <?php
                        foreach ($types as $type) {
                            echo '<option value="' . $type['event_type_id'] . '">' . $type['event_type'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group ">
                    <label class="displayblock" id="event_dateLabel">Event Date</label>
                    <input class="form-control" id="event_date" type="text" name="eventdate" value="" />
                </div>
                <div class="form-group">
                    <label class="displayblock" id="event_titleLabel">Event title</label>
                    <input type="text" class="form-control" value="" id="event_title" name="event_title">
                </div>

                <div class="form-group">
                    <label class="displayblock" id="event_venueLable">Venue</label>
                    <select class="form-control" id="location" name="venue">
                        <option value="">-- Choose --</option>
                        <?php
                        foreach ($venues as $venue) {
                            echo '<option value="' . $venue['venue_id'] . '">' . $venue['venue_name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="displayblock" >Description</label>
                    <span class="inline_block">
                        <textarea class="form-control texteditor"  name="description"></textarea>
                    </span>
                </div>
                <div class="form-group">
                    <label class="displayblock">Image</label>

                    <input type="file" class="" id="event_img" name="event_img">

                </div>
                <div class="form-group price_div">
                    <label >Price</label>
                    <div class="col-lg-12 ">
                        <div class="col-lg-3" >
                            <label class="displayblock" for="event_priceTitleLabel" id="event_priceTitleLabel"></label>
                            <input type="text" id="event_price_title" class="form-control" value="Regular" placeholder="price title" name="title[]" >
                        </div>
                        <div class="col-lg-3 " >
                            <label class="displayblock" for="event_priceLabel" id="event_priceLabel"></label>
                            <div class="input-group" >
                                <span class="input-group-addon">$</span>
                                <input type="text" id="event_price" class="form-control" name="price[]" >
                            </div>
                        </div>
                        <div class="col-lg-4" >
                            <label class="displayblock" for="event_priceTicketLabel" id="event_priceTicketLabel"></label>
                            <div class="input-group" >
                                <span class="input-group-addon">Available tickets</span>
                                <input type="number" min="1" id="event_price_ticket" class="form-control" name="available[]" >
                            </div>
                        </div>
                    </div>
                </div>
                <!--                            <div class="form-group">
                                                <input type="button"  class="price-button add_price" value="Add +">
                                            </div>-->
                <div class="form-group clearfix">
                    <input name="v_image" type="hidden" id="v_image" value="1" />
                    <input type="button" class="btn btn-primary pull-right btn-fix-width event_add" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('header/event_add'); ?>