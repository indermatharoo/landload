<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
             <i class="fa fa-university fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Class Rooms</h3>
        </div>
        <div class="col-sm-1" style="text-align: right">
            <a href="calender/type/add"><h3 style="margin: 0; color: #fff"><i class="fa fa-plus-square" title="Add Class Room"></i></h3></a>
        </div>
    </div>
</header>
<div class="col-sm-12">
    <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
</div>
<div class="col-lg-12 mar-top15 padding-0">
    <?php if (!empty($type)) { ?>
        <ul class="todo-list ui-sortable">
            <?php
            foreach ($type as $row) {
                //edit
                $edit_href = 'calender/type/edit/' . $row['event_type_id'];
                //enable disable
                $var = $row['status'] == 1 ? 'disable' : 'enable';
                $ed_href = 'calender/type/' . $var . '/' . $row['event_type_id'];
                //delete
                $del_href = 'calender/type/delete/' . $row['event_type_id'];
                ?>
                <li>
                    <span class="text"><?= $row['event_type'] ?></span>
                    <div class="tools">
                        <a href="<?= $ed_href ?>"><?= ucfirst($var) ?></a> 
                        <a href="<?= $edit_href ?>"><i class="fa fa-edit"></i></a>
                        <a href="<?= $del_href ?>" onclick="return confirm('Are you sure you want to Delete this Event Type ?');"><i class="fa fa-trash-o"></i></a>
                    </div>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
</div>
