<link href="<?php echo base_url() ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<div>
    <div class="dashboard_message content-bg" style="min-width:200px;left: 207.5px; position: absolute; top: 152px; z-index: 9999; opacity: 1; display: none; padding: 10px;">
        <div class="cls" style="text-align: right; cursor: pointer">X</div>
        <div class="content" style="padding: 0; text-align: center; text-transform: capitalize"></div>
    </div>
    <div class="col-lg-12 padding-0" >
        <header class="panel-heading">
            <div class="row">
                <div class="col-sm-1">
                    <i class="fa fa-user fa-2x"></i>
                </div>
                <div class="col-sm-10">
                    <h3 style="margin: 0; text-align: center">Side Links</h3>
                </div>
                <div style="text-align: right" class="col-sm-1">
                    <a href="frontend/addsidelinks"><h3 style="cursor: pointer; margin: 0; color: #fff"><i title="Add New user" class="fa fa-plus-square"></i></h3></a>
                </div>
            </div>
        </header>
        <div class="col-lg-12 mar-top10 padding-0">
            <table id="table" class="table table-bordered table-striped">
                <thead>
                    <tr>                        
                        <?php foreach ($labels as $label): ?>
                            <th><?php echo $label ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($models as $item): ?>
                        <?php
//                    e($item);
                        ?>
                        <tr>
                            <td><?= arrIndex($item, 'content'); ?></td>
                            <td><?= arrIndex($item, 'color'); ?></td>
                            <td><?= arrIndex($item, 'pic'); ?></td>
                            <td><?= arrIndex($item, 'link'); ?></td>
                            <td>
                                <a href="<?php echo createUrl('frontend/addsidelinks/' . arrIndex($item, 'id')); ?>">Edit</a> | 
                                <a href="<?php echo createUrl('frontend/delete/' . arrIndex($item, 'id')); ?>">Delete</a>
                            </td>
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
    </div>
</div>
<?php $this->load->view('user/headers/user_index', array('base_url' => base_url())); ?>

