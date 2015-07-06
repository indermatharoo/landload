<link href="<?php echo base_url() ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <i class="fa fa-location-arrow fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Venues</h3>
        </div>
        <div class="col-sm-1" style="text-align: right">
            <a href="calender/venues/add"><h3 style="margin: 0; color: #fff"><i class="fa fa-plus-square" title="Add Venues"></i></h3></a>
        </div>
    </div>
</header>
<div class="col-sm-12">
    <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
</div>
<div class="col-lg-12 padding-0 mar-top10">
    <table id="pagination-table" class="table table-bordered table-striped">
        <thead>
            <tr>                        
                <?php foreach ($labels as $label): ?>
                    <th><?php echo $label ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($venues as $row) {
                $edit_href = 'calender/venues/edit/' . $row['venue_id'];
                $del_href = 'calender/venues/delete/' . $row['venue_id'];
                ?>
                <tr>
                    <td class="text" style="width: 75%"><?= $row['venue_name'] ?></span>
                    <td class="tools">
                        <a href="<?= $edit_href ?>"><i class="fa fa-edit" title="Edit" style="margin-left: 10px"></i></a>
                        <a href="<?= $del_href ?>" onclick="return confirm('Are you sure you want to Delete this Vanue ?');"><i class="fa fa-trash-o" title="Delete"></i></a>
                    </td>
                </tr>
            <?php } ?>
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
<?php $this->load->view('header/common-pagination', array('base_url' => base_url())); ?>
