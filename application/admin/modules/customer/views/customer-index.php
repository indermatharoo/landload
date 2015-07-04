<link href="<?php echo base_url() ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php $this->load->view(THEME . 'messages/inc-messages'); ?>
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <i class="fa fa-user fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Manage Customers</h3>
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
            <?php foreach ($customer as $item): ?>
            <?php
//            e($item);
            ?>
                <tr>
                    <td><?= arrIndex($item, 'first_name'); ?></td>
                    <td><?= arrIndex($item, 'last_name'); ?></td>
                    <td><?= arrIndex($item, 'email'); ?></td>
                    <td><?= arrIndex($item, 'last_login')?></td>
                    <td><a href="<?= createUrl('customer/addedit/') . arrIndex($item, 'customer_id'); ?>">Edit</a><?php if ($item['customer_id'] > 1) { ?>  | <a href="<?= createUrl('customer/delete/') . $item['auth_user_id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a><?php } ?> </td>
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
<?php $this->load->view('headers/customer_index', array('base_url' => base_url())); ?>