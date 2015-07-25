<?php
if ($recentProperties['num_rows'] > 0) {
//    echo "<pre>";
//    print_r($recentCompany['results']);
//    die();
    ?>
    <!--<h3 style="margin: 0; text-align: center; background: #d37602 none repeat scroll 0 0; color: #fff; padding: 5px;">Recent Properties</h3>-->
    <div class="col-lg-12 padding-0">
        <table id="table" class="table table-bordered table-striped">
            <thead>
                <tr>                        
                    <?php
//                    e($recentProperties['results']);
                    $companylabels = array(
                        'Name',
                        'Type',
                        'Owner',
                        'City',
                        'Amount',
                    );
                    foreach ($companylabels as $label):
                        ?>
                        <th><?php echo $label ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recentProperties['results'] as $item): ?>
                    <tr>
                        <td><?= arrIndex($item, 'unit_number') ?></td>
                        <td><?= arrIndex($item, 'property_type') ?></td>
                        <td><?= arrIndex($item, 'owner') ?></td>
                        <td><?= arrIndex($item, 'city') ?></td>
                        <td><?= arrIndex($item, 'amount') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <?php /* ?>
                  <tr>
                  <?php foreach ($companylabels as $label): ?>
                  <th><?php echo $label ?></th>
                  <?php endforeach; ?>
                  </tr>
                  <?php */ ?>
            </tfoot>
        </table>
    </div>
    <?php
}
?>