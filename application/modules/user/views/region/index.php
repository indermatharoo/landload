<link href="<?php echo base_url() ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-6">
            <h3 style="margin: 0">Region Management</h3>
        </div>
        <div class="col-sm-6" style="text-align: right">
            <a href="user/region/add"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-plus-square" title="Add New user"></i></h3></a>
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
            <?php foreach ($rows as $row): ?>
                <tr>
                    <td><?= arrIndex($row, 'id'); ?></td>
                    <td><?= arrIndex($row, 'name'); ?></td>
                    <td><a href="<?= createUrl('user/region/add/') . arrIndex($row, 'id'); ?>">Edit</a>  | <a href="<?= createUrl('user/region/delete/') . $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this region?');">Delete</a> </td>
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
<?php $this->load->view('headers/user_index', array('base_url' => base_url())); ?>
