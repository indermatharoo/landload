<div class="col-lg-12 padding-0" style="padding-top: 15px;">
    
    <h3>Paid </h3>
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
            //e($paidUnits);
            //$Listing =array();
              if($paidUnits['num_rows'] > 0)
              {
            foreach ($paidUnits['result'] as $item):
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
    
    <h3>Un-Paid </h3>
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
            //e($paidUnits);
            //$Listing =array();
              if($UnPaidUnits['num_rows'] > 0)
              {
            foreach ($UnPaidUnits['result'] as $item):
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