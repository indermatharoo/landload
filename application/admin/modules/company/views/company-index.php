<link href="<?php echo base_url() ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <i class="fa fa-user fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Company Management</h3>
        </div>
        <div class="col-sm-1" style="text-align: right">
            <a href="company/add"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-plus-square" title="Add New user"></i></h3></a>
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
            <?php foreach ($users as $item): ?>
                <tr>
                    <td><?= arrIndex($item, 'name'); ?></td>
                    <td><?= arrIndex($item, 'email'); ?></td>
                    <td><?= $this->aauth->get_group_name(arrIndex($item, 'group_id')); ?></td>
                    <td><a href="<?= createUrl('company/edit/') . arrIndex($item, 'id'); ?>">Edit</a><?php if ($item['id'] > 1) { ?>  | <a href="<?= createUrl('company/delete/') . $item['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a><?php } ?> </td>
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
<?php $this->load->view('headers/user_index', array('base_url' => base_url())); ?>
