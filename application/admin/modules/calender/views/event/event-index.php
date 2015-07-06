<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <i class="fa fa-calendar fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Events</h3>
        </div>
        <div class="col-sm-1" style="text-align: right">
            <a href="calender/add" ><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-plus-square" title="Add New Event"></i></h3></a>
        </div>
    </div>
</header>
<div class="col-sm-12 mar-top10 padding-0">
    <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
    <div class="page-header clearfix" style="border-bottom: none; background: #EAEAEA; padding-top: 10px">
        <div class="col-sm-4">
            <h3 style="margin: 0"></h3>
        </div>
        <div class="col-sm-8 form-inline" style="text-align: right">
            <div class="btn-group">
                <button class="btn btn-sm btn-primary" data-calendar-nav="prev"><< Prev</button>
                <button class="btn btn-sm" data-calendar-nav="today">Today</button>
                <button class="btn btn-sm btn-primary" data-calendar-nav="next">Next >></button>
            </div>
            <div class="btn-group">
                <button class="btn btn-sm btn-warning" data-calendar-view="year">Year</button>
                <button class="btn btn-sm btn-warning active" data-calendar-view="month">Month</button>
                <button class="btn btn-sm btn-warning" data-calendar-view="week">Week</button>
                <!--<button class="btn btn-sm btn-warning" data-calendar-view="day">Day</button>-->
            </div>
        </div>
    </div>
    <div class="">
        <div id="calendar"></div>
    </div>
</div>
<div id="euid" uid="<?= $this->aauth->get_user()->id; ?>"></div>
<?php $this->load->view('header/event_index'); ?>