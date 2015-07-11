<?php
//echo "<pre>";
//print_r($Listing);
//die();
?> 

<?php $this->load->view(THEME . 'messages/inc-messages'); ?>
<link href="<?php echo base_url() ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <i class="fa fa-user fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center"> Applications / Lease Management</h3>
        </div>
        <div class="col-sm-1" style="text-align: right">
<!--            <a href="applications/add"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-plus-square" title="Add New Applications / Lease"></i></h3></a>-->
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
            <?php
            if(count($Listing) > 0)
            {
            foreach ($Listing as $item):
                //echo '<pre>'; print_r($item);
                ?>
                <tr>
                    <td><?= arrIndex($item, 'fname') . ' ' . arrIndex($item, 'lname'); ?></td>
                    <td><?= arrIndex($item, 'pname') ?></td>
                    <td><?= arrIndex($item, 'company_name') ?></td>
                    <td><?= arrIndex($item, 'lease_from') ?></td>
                    <td><a href="<?= createUrl('applications/manage/') . arrIndex($item, 'application_id'); ?>">Manage</a>  |<a href="<?= createUrl('applications/edit/') . arrIndex($item, 'application_id'); ?>">Edit</a>  | <a href="<?= createUrl('applications/delete/') . $item['application_id']; ?>" onclick="return confirm('Are you sure you want to delete this Feature?');">Delete</a> </td>
                </tr>
            <?php endforeach; 
            
            }
            else
            {
                ?>
                <tr><td colspan="5">No Record Found</td></tr>
                <?php
            }
            ?>
        </tbody>
        <tfoot>
            <?php /* ?>
            <tr>                        
                <?php foreach ($labels as $label): ?>
                    <th><?php echo $label ?></th>
                <?php endforeach; ?>
            </tr>
            <?php */ ?>
        </tfoot>
    </table>
</div>
<p align="center"><?php echo $pagination; ?></p>

