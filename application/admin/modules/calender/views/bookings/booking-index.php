<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <i class="fa fa-inbox fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; color: #fff; text-align: center;">Bookings</h3>
        </div>
        <div class="col-sm-1">
            <a href="calender/bookings/add" style="color: #fff"><i class="fa fa-plus-square fa-2x"></i></a>
        </div>
    </div>
</header>
<div class="col-lg-12">
    <div class="">
        <div class="box-header ui-sortable-handle">
            <h3 class="box-title"><a href="calender/bookings/add">Add Bookings</a></h3>
            <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
        </div>
        <div class="box-body table-responsive">
            <table id="mytable" class="table table-bordred table-striped">
                <thead>
                <th>Name</th>
                <th>Date</th>
                <th>Event title</th>
                <th>Tickets</th>
                <th>Status</th>
                <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $ev) { ?>
                        <tr>
                            <td><?= $ev['first_name'] . ' ' . $ev['last_name']; ?></td>
                            <td><?= 'From ' . $ev['event_start_ts'] . ' to ' . $ev['event_end_ts']; ?></td>
                            <td><?= $ev['event_title']; ?></td>
                            <td><?= $ev['ctn']; ?></td>
                            <td><?= $ev['booking_status']; ?></td>
                            <td>
                                <a href="calender/bookings/edit/<?= $ev['booking_id'] ?>"><button class="btn btn-primary btn-xs"><span class="fa fa-edit"></span></button></a>
                                <a href="calender/bookings/delete/<?= $ev['booking_id'] ?>"><button class="btn btn-danger btn-xs"  ><span class="fa fa-trash"></span></button></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="clearfix"></div>
            <div><?php echo $pagination; ?></div>
        </div>
    </div>
</div>
