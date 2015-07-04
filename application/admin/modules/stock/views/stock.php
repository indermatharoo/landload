<link href="<?php echo base_url() ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-11">
            <h3 style="margin: 0; text-align: center">Store Orders</h3>
        </div>
        <div class="col-sm-1" style="text-align: right">
            <!--<a href="marketing/create"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-plus-square" title="Add New Template"></i></h3></a>-->
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
            <?php foreach ($models as $item): ?>
                <tr>
                    <td><?= arrIndex($item, 'fname'); ?></td>
                    <td><?= arrIndex($item, 'lname'); ?></td>
                    <td><?= arrIndex($item, 'email'); ?></td>                    
                    <td><?= arrIndex($item, 'telephone'); ?></td>
                    <td><?= arrIndex($item, 'territory_name'); ?></td>
                    <td><?= arrIndex($item, 'paypal'); ?></td>
                    <td><a href="<?php echo createUrl('stock/store/' . arrIndex($item, 'store_id')) ?>"><?= arrIndex($item, 'store_id'); ?></a></td>
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
<?php $this->load->view('user/headers/user_index', array('base_url' => base_url())); ?>
