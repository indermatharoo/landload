<?php
if($recentTenant['num_rows'] > 0)
{
//    echo "<pre>";
//    print_r($recentCompany['results']);
//    die();
    ?>
<!--<h3 style="margin: 0; text-align: center; background: #d37602 none repeat scroll 0 0; color: #fff; padding: 5px;">Recent Applicants</h3>-->
<div class="col-lg-12 padding-0">
    <table id="table" class="table table-bordered table-striped">
        <thead>
            <tr>                        
                <?php
                            $companylabels = array(
            'pname' => 'Applicant name',
            'type' => 'Address',
            'unit' => 'Phone',
            'email' => 'email',
            
         //   'action' => 'Action',
        );
                foreach ($companylabels as $label): ?>
                    <th><?php echo $label ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            

            foreach ($recentTenant['results'] as $item): ?>
                <tr>
                    <td><?= trim(arrIndex($item, 'fname').' '.arrIndex($item, 'lname')); ?></td>
                    <td><?= arrIndex($item, 'email'); ?></td>
                    <td><?= arrIndex($item, 'phone'); ?></td>
                    <td><?= arrIndex($item, 'email'); ?></td>
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