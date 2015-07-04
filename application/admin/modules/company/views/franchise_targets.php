<form action="" class="targets" method="post" event-id="<?php echo arrIndex($params, 'id') ?>">
    <div class="form-group clearfix" eventid="<?php echo arrIndex($params, 'id') ?>">
        <!--<label for="" class="col-sm-3 control-label">Daily</label>-->
        <?php
        $targets = arrIndex($params, 'target');
        $arr = arrIndex($targets, 1);
        $exclude_weekends = arrIndex($arr, 'exclude_weekends', 0);
        ?>
        <input type="hidden" name="exclude_weekends" value="<?php echo $exclude_weekends ?>"/>
        <input type="hidden" name="event_type" value="<?= arrIndex($params, 'id') ?>">     
        <div class="col-sm-6">
            <label>Daily Events</label>
            <input type="text" class="form-control" name="daily_event" placeholder="Daily Events" value="<?= arrIndex($arr, 'no_of_event') ?>">
        </div>
        <div class="col-sm-6">
            <label>Daily Customer</label>
            <input type="text" class="form-control" name="daily_customer" placeholder="Daily Customer"s value="<?= arrIndex($arr, 'no_of_customer') ?>">
        </div>
    </div>
    <div class="form-group clearfix">
        <!--<label for="" class="col-sm-3 control-label">Weekly</label>-->
        <?php
        $arr = arrIndex($targets, 2);
        ?>
        <div class="col-sm-6">
            <label>Weekly Events</label>
            <input type="text" class="form-control" placeholder="Weekly Events" name="weekly_event" value="<?= arrIndex($arr, 'no_of_event') ?>">
        </div>
        <div class="col-sm-6">
            <label>Weekly Customers</label>
            <input type="text" class="form-control" placeholder="Weekly Customers" name="weekly_customer" value="<?= arrIndex($arr, 'no_of_customer') ?>">
        </div>
    </div>
    <div class="form-group clearfix">
        <!--<label for="" class="col-sm-3 control-label">Monthly</label>-->
        <?php
        $arr = arrIndex($targets, 3);
        ?>
        <div class="col-sm-6">
            <label>Monthly Events</label>
            <input type="text" class="form-control" placeholder="Monthly Events" name="monthly_event" value="<?= arrIndex($arr, 'no_of_event') ?>">
        </div>
        <div class="col-sm-6">
            <label>Monthly Customers</label>
            <input type="text" class="form-control" placeholder="Monthly Customers" name="monthly_customer" value="<?= arrIndex($arr, 'no_of_customer') ?>">
        </div>
    </div>
    <div class="form-group clearfix">
        <!--<label for="" class="col-sm-3 control-label">Yearly</label>-->
        <?php
        $arr = arrIndex($targets, 4);
        ?>
        <div class="col-sm-6">
            <label>Yearly Events</label>
            <input type="text" class="form-control" placeholder="Yearly Events" name="yearly_event" value="<?= arrIndex($arr, 'no_of_event') ?>">
        </div>
        <div class="col-sm-6">
            <label>Yearly Customers</label>
            <input type="text" class="form-control" placeholder="Yearly Customers" name="yearly_customer" value="<?= arrIndex($arr, 'no_of_customer') ?>">
        </div>
    </div>
    <div class="form-group">
        <!--<label for="" class="col-sm-3 control-label">Exclude Weekend's</label>-->
        <div class="col-sm-12">
            <input <?php if ($exclude_weekends) echo 'checked' ?> type="checkbox" class="checkBOX" name='exclude_weekends' onClick="setTarget1(this)"/>&nbsp;&nbsp;Exclude Weekend's
        </div>
    </div>            
</form>