<?php $this->load->view(THEME . 'messages/inc-messages'); ?>
<link href="<?php echo base_url() ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <i class="fa fa-user fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Properties Management</h3>
        </div>
        <div class="col-sm-1" style="text-align: right">
            <?php if (!$this->aauth->isAdmin()) { ?><a href="properties/add"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-plus-square" title="Add New user"></i></h3></a> <?php }?>
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
                    <td><?= arrIndex($item, 'pname'); ?></td>
                    <td><?= arrIndex($item, 'type'); ?></td>
                    <td><?= arrIndex($item, 'units'); ?></td>
                    <td><?= arrIndex($item, 'owner'); ?></td>
                    <td><?= arrIndex($item, 'street'); ?></td>
                    <td><a href="<?= createUrl('properties/edit/') . arrIndex($item, 'id'); ?>">Edit</a>  | <a href="<?= createUrl('properties/delete/') . $item['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a> </td>
                </tr>
            <?php endforeach; ?>
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

