<div id="left-column" class="col-lg-7">
    <header class="panel-heading">
        <div class="row">
            <div class="col-sm-6">
                <h3 style="margin: 0">Upcoming Events</h3>
            </div>
        </div>
    </header>
    <?php
    ?>
    <?php foreach ($upcomming_events as $evt): ?>
        <div class="col-lg-7">
            <div>
                <span>Title</span>: <span><?php echo arrIndex($evt, 'event_title') ?></span>
            </div>
            <div>
                <span>Description</span>: <span><?php echo arrIndex($evt, 'description') ?></span>
            </div>
            <div>
                <span>Start Time</span>: <span><?php echo arrIndex($evt, 'event_start_ts') ?></span>        
            </div>
            <div>
                <span>Location</span>: <span><?php echo arrIndex($evt, 'venue_name') ?></span>        
            </div>
            <div>
                <span>Email</span>: <span><?php echo arrIndex($evt, 'email') ?></span>        
            </div>
            <div>
                <span>Phone</span>: <span><?php echo arrIndex($evt, 'phone') ?></span>        
            </div>
            <div>
                <span>City</span>: <span><?php echo arrIndex($evt, 'city') ?></span>        
            </div>
            <div>
                <button class="btn btn-success" onclick="eventbooking(this,<?php echo arrIndex($evt, 'event_id') ?>)">Book This Event</button>   
            </div>
            <br/>
        </div>
        <div class="col-lg-5 top-20">
            <img src="<?php echo site_url1(base_url()) . '/upload/events/' . arrIndex($evt, 'event_img') ?>" class="col-lg-12"/>
        </div>
    <?php endforeach; ?>
    <div class="clearfix"></div>
    <header class="panel-heading">
        <div class="row">
            <div class="col-sm-6">
                <h3 style="margin: 0">My Bookings</h3>
            </div>
        </div>
    </header>
    <div class="col-lg-12 padding-0" style="padding-top: 15px;">
        <table id="table" class="table table-bordered table-striped">
            <thead>
                <tr>                        
                    <?php foreach ($labels as $label): ?>
                        <th><?php echo $label ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>                
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?= arrIndex($row, 'event_title'); ?></td>
                        <td><?= arrIndex($row, 'venue_name'); ?></td>
                        <td><?= arrIndex($row, 'email'); ?></td>
                        <td><?= arrIndex($row, 'phone'); ?></td>
                        <td><?= arrIndex($row, 'postcode'); ?></td>
                        <td><?= arrIndex($row, 'booking_status'); ?></td>                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>                        
                    <?php foreach ($labels as $label): ?>
                        <th><?php echo $label ?></th>
                    <?php endforeach; ?>
                </tr>
            </tfoot>
        </table>
    </div>
    <?php $this->load->view('user/headers/user_index', array('base_url' => base_url())); ?>
</div>