<link href="<?php echo base_url() ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-ui.js"></script>
<link href="css/smoothness/jquery-ui.css" rel="stylesheet"/>
<!--<div class="col-lg-12">
    <form name="" action="">
        <div class="col-sm-5">FROM <input type="text" class="form-control datepicker" /></div>
        <div class="col-sm-5">TO <input type="text" class="form-control datepicker" /></div>
        <div class="col-sm-2 mar-top20"><button name="" value="search" class="btn btn-primary">Search</button></div>
    </form>
</div>-->
<div class="col-lg-12 padding-0" style="padding-top: 15px;">
    <h3>Paid </h3>
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
            //e($paidUnits);
            //$Listing =array();
              if($paidUnits['num_rows'] > 0)
              {
            foreach ($paidUnits['result'] as $item):
                ?>
                <tr>
                        <td><?= arrIndex($item, 'unit_number')  ?></td>
                        <td><?= arrIndex($item, 'property_type') ?></td>
                        <td><?= arrIndex($item, 'post_code') ?></td>
                        <td><?= arrIndex($item, 'amount') ?></td>
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
                        <td><?= arrIndex($item, 'unit_number')  ?></td>
                        <td><?= arrIndex($item, 'property_type') ?></td>
                        <td><?= arrIndex($item, 'post_code') ?></td>
                        <td><?= arrIndex($item, 'amount') ?></td>
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
<script>
    $(document).ready(function(){
        $('.datepicker').datepicker({});
        })
  </script>