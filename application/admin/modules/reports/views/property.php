<?php
//echo "<pre>";
//print_r($Listing);
//die();
?> 

<?php $this->load->view(THEME . 'messages/inc-messages'); ?>
<link href="<?php echo base_url() ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <i class="fa fa-user fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center"> Property Report</h3>
        </div>
        <div class="col-sm-1" style="text-align: right">
<!--            <a href="applications/add"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-plus-square" title="Add New Applications / Lease"></i></h3></a>-->
        </div>
    </div>
</header>
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
                foreach ($labels as $label): ?>
                    <th><?php echo $label ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            //e($occupiedList);
            //$Listing =array();
              if($occupiedList['num_rows'] > 0)
              {
            foreach ($occupiedList['result'] as $item):
                ?>
                <tr>
                    <td><?= arrIndex($item, 'pname') . ' ' . arrIndex($item, 'lname'); ?></td>
                    <td><?= arrIndex($item, 'type') ?></td>
                    <td><?= arrIndex($item, 'amount') ?></td>
                    <td><?= arrIndex($item, 'unit_type') ?></td>
                </tr>
            <?php endforeach; 
              }
                       else
            {
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
                <?php
                foreach ($labels as $label): ?>
                    <th><?php echo $label ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            //e($occupiedList);
            //$Listing =array();
              if($UnOccupiedUnitsList['num_rows'] > 0)
              {
            foreach ($UnOccupiedUnitsList['result'] as $item):
                ?>
                <tr>
                    <td><?= arrIndex($item, 'pname') . ' ' . arrIndex($item, 'lname'); ?></td>
                    <td><?= arrIndex($item, 'type') ?></td>
                    <td><?= arrIndex($item, 'amount') ?></td>
                    <td><?= arrIndex($item, 'unit_type') ?></td>
                </tr>
            <?php endforeach; 
              }
                       else
            {
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
<p align="center"><?php //echo $pagination; ?></p>


