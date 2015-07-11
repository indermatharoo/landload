<?php
if($recentProperties['num_rows'] > 0)
{
//    echo "<pre>";
//    print_r($recentCompany['results']);
//    die();
    ?>
<h3 style="margin: 0; text-align: center; background: #d37602 none repeat scroll 0 0; color: #fff; padding: 5px;">Recent Properties</h3>
<div class="col-lg-12 padding-0" style="padding-top: 15px;">
    <table id="table" class="table table-bordered table-striped">
        <thead>
            <tr>                        
                <?php
                            $companylabels = array(
            'pname' => 'Property Name',
            'type' => 'Type',
            'unit' => 'Units',
            
         //   'action' => 'Action',
        );
                foreach ($companylabels as $label): ?>
                    <th><?php echo $label ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            

            foreach ($recentProperties['results'] as $item): ?>
                <tr>
                    <td><?= arrIndex($item, 'pname'); ?></td>
                    <td><?= arrIndex($item, 'property_type'); ?></td>
                    <td><?= arrIndex($item, 'units'); ?></td>
                    
                    
                    
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