<?php ep('fd');?>
<link href="<?php echo base_url() ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<div class="col-lg-12">
    <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
    <div class="box-header">
        <h3 class="box-title"><a href="calender/venues/add">Add Venues</a></h3>            
    </div>
    <div class="box-body">
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
                    //edit
                    $edit_href = 'calender/venues/edit/' . $row['venue_id'];
                    //enable disable
//                    $var = $row['status'] == 1 ? 'disable' : 'enable';
//                    $ed_href = 'calender/venues/' . $var . '/' . $row['venue_id'];
                    //delete
                    $del_href = 'calender/venues/delete/' . $row['venue_id'];
                    ?>
                    <tr>
                        <td class="text" style="width: 75%"><?= $row['venue_name'] ?></span>
                        <td class="tools">
                            <!--<a href="<? = $ed_href ?>"><? = ucfirst($var) ?></a>--> 
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
</div>
<?php $this->load->view('header/common-pagination', array('base_url' => base_url())); ?>