<link href="<?php echo base_url() ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-ui.js"></script>
<link href="css/smoothness/jquery-ui.css" rel="stylesheet"/>
<div class="col-lg-12">
    <form name="" action="">
        <div class="col-sm-5">FROM <input type="text" class=" datepicker" /></div>
        <div class="col-sm-5">TO <input type="text" class=" datepicker" /></div>
        <div class="col-sm-2"><button name="" value="search" class="btn btn-primary">Search</button></div>
    </form>
</div>
<div class="col-lg-12 padding-0" style="padding-top: 15px;">
    <h3>Paid </h3>
    <table id="table" class="table table-bordered table-striped">
        <thead>
            <tr>                        
                <?php
                $labels = array(
                    'pname' => 'Property Name',
                    'unitname' => 'Unit Number',
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
            //e($paidUnits);
            //$Listing =array();
              if($paidUnits['num_rows'] > 0)
              {
            foreach ($paidUnits['result'] as $item):
                ?>
                <tr>
                    <td><?= arrIndex($item, 'pname') . ' ' . arrIndex($item, 'lname'); ?></td>
                    <td><?= arrIndex($item, 'unit_number')  ?></td>
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
                <?php foreach ($labels as $label): ?>
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
                    <td><?= arrIndex($item, 'unit_number')  ?></td>
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
<script>
    $(document).ready(function(){
        $('.datepicker').datepicker({});
        })
  </script>