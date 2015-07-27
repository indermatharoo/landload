<?php
//echo "<pre>";
//print_r($occupiedList);
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
                 //   'pname' => 'Property Name',
                    'unitname' => 'Property Name',
                    'type' => 'Property Type',
                    'unit' => 'Postcode',
                    'Unittype' => 'Amount',
                );
                foreach ($labels as $label):
                    ?>
                    <th><?php echo $label ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($occupiedList['num_rows'] > 0) {
                foreach ($occupiedList['result'] as $item):
                    ?>
                    <tr>
              <?php /* ?>   <td><?php arrIndex($item, 'pname') . ' ' . arrIndex($item, 'lname'); ?></td><?php */ ?>
                        <td><?= arrIndex($item, 'unit_number')  ?></td>
                        <td><?= arrIndex($item, 'property_type') ?></td>
                        <td><?= arrIndex($item, 'post_code') ?></td>
                        <td><?= arrIndex($item, 'amount') ?></td>
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
                        <td><?= arrIndex($item, 'unit_number')  ?></td>
                        <td><?= arrIndex($item, 'property_type') ?></td>
                        <td><?= arrIndex($item, 'post_code') ?></td>
                        <td><?= arrIndex($item, 'amount') ?></td>
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
<p align="center"><?php //echo $pagination;       ?></p>


