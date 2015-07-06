<link href="<?php echo base_url() ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-6">
            <h3 style="margin: 0">Order History</h3>
        </div>
    </div>
</header>
<?php
$orders = arrIndex($output, 'data');
?>
<div class="col-lg-12 padding-0" style="padding-top: 15px;">
    <table id="table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Sku</th>
                <th>Created At</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Tax(%)</th>
                <th>Total Paid</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <?php $items = arrIndex($order, 'items') ?>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?php echo arrIndex($order, 'increment_id') ?></td>
                        <td><?php echo arrIndex($item, 'name') ?></td>
                        <td><?php echo arrIndex($item, 'sku') ?></td>
                        <td><?php echo arrIndex($order, 'created_at') ?></td>
                        <td><?php echo round(arrIndex($item, 'price'),2) ?></td>
                        <td><?php echo round(arrIndex($item, 'qty_ordered')) ?></td>
                        <td><?php echo round(arrIndex($item, 'tax_percent')) ?></td>
                        <td><?php echo round(arrIndex($item, 'base_row_total_incl_tax'),2) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Sku</th>
                <th>Created At</th>
                <th>Orignal Price</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Tax(%)</th>
                <th>Total Paid</th>                
            </tr>
        </tfoot>
    </table>
</div>
<?php $this->load->view('user/headers/user_index', array('base_url' => base_url())); ?>