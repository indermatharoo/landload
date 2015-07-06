<?php
//echo "<pre>";
//print_r($Listing);
?> 

<?php $this->load->view(THEME . 'messages/inc-messages'); ?>
<link href="<?php echo base_url() ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <i class="fa fa-user fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Features Management</h3>
        </div>
        <div class="col-sm-1" style="text-align: right">
            <a href="features/add"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-plus-square" title="Add New Feature"></i></h3></a>
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
            <?php foreach ($Listing as $item): ?>
                <tr>
                    <td><?= arrIndex($item, 'tag'); ?></td>
                 
                    <td><a href="<?= createUrl('features/edit/') . arrIndex($item, 'id'); ?>">Edit</a>  | <a href="<?= createUrl('features/delete/') . $item['id']; ?>" onclick="return confirm('Are you sure you want to delete this Feature?');">Delete</a> </td>
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
<p align="center"><?php echo $pagination;?></p>

