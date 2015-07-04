<?php // ep($attendanc);      ?>
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <a href="calender" style="color: #fff"><i class="fa fa-calendar fa-2x" title="Calender"></i></a>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Manage Calender</h3>
        </div>
    </div>
</header>
<div class="col-lg-12">
    <div class="">
        <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
        <div class="box-body table-responsive">
            <table id="mytable" class="table table-bordred table-striped">
                <thead>
                <th>Name</th>
                <th>Ticket Number</th>
                <th>Attendance</th>
                </thead>
                <tbody>
                    <?php foreach ($attendanc as $ev) { ?>
                        <tr>
                            <td><?= $ev['first_name'] . ' ' . $ev['last_name']; ?></td>
                            <td><?= $ev['ticket_id']; ?></td>
                            <td>
                                <select class="form-control booking_attendance" tid="<?= $ev['id']; ?>" >
                                    <option value="T" <?= $ev['is_used'] == 'T' ? 'selected="selected"' : ''; ?>>Present</option>
                                    <option value="F" <?= $ev['is_used'] == 'F' ? 'selected="selected"' : ''; ?>>Absent</option>
                                </select>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->load->view('header/attendance-index'); ?>