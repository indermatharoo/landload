<?php
//echo "<pre>";
//print_r($Listing);
//die();
?> 
<link href="<?php echo base_url() ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<div class="col-lg-12 padding-0" style="padding-top: 15px;">
    <h3>Occupied</h3>
    <table id="table" class="table table-bordered table-striped">
        <thead>
            <tr>                        
                <?php
                $labels = array(
                    'pname' => 'Property Name',
                    'type' => 'Type',
                    'unit' => 'Amount',
                    'Unit' => 'Unit type',
                );
                foreach ($labels as $label):
                    ?>
                    <th><?php echo $label ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            //e($occupiedList);
            //$Listing =array();
            if ($occupiedList['num_rows'] > 0) {
                foreach ($occupiedList['result'] as $item):
                    ?>
                    <tr>
                        <td><?= arrIndex($item, 'pname') . ' ' . arrIndex($item, 'lname'); ?></td>
                        <td><?= arrIndex($item, 'type') ?></td>
                        <td><?= arrIndex($item, 'amount') ?></td>
                        <td><?= arrIndex($item, 'unit_type') ?></td>
                    </tr>
                    <?php
                endforeach;
            }
            else {
                ?>
                <tr><td colspan="5">No Record Found</td></tr>
                <?php
            }
            ?>
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
<div class="col-lg-12 padding-0" style="padding-top: 15px;">

    <h3>Un-Occupied</h3>
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
            //e($occupiedList);
            //$Listing =array();
            if ($UnOccupiedUnitsList['num_rows'] > 0) {
                foreach ($UnOccupiedUnitsList['result'] as $item):
                    ?>
                    <tr>
                        <td><?= arrIndex($item, 'pname') . ' ' . arrIndex($item, 'lname'); ?></td>
                        <td><?= arrIndex($item, 'type') ?></td>
                        <td><?= arrIndex($item, 'amount') ?></td>
                        <td><?= arrIndex($item, 'unit_type') ?></td>
                    </tr>
                    <?php
                endforeach;
            }
            else {
                ?>
                <tr><td colspan="5">No Record Found</td></tr>
                <?php
            }
            ?>
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
<p align="center"><?php //echo $pagination;      ?></p>


