<?php
if($recentCompanies['num_rows'] > 0)
{
//    echo "<pre>";
//    print_r($recentCompany['results']);
//    die();
    ?>
<h3 style="margin: 0; text-align: center">Recent Company</h3>
<div class="col-lg-12 padding-0" style="padding-top: 15px;">
    <table id="table" class="table table-bordered table-striped">
        <thead>
            <tr>                        
                <?php
                            $companylabels = array(
            'pname' => 'Company name',
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
            

            foreach ($recentCompanies['results'] as $item): ?>
                <tr>
                    <td><?= arrIndex($item, 'company_name'); ?></td>
                    <td><?= arrIndex($item, 'company_address'); ?></td>
                    <td><?= arrIndex($item, 'company_phone'); ?></td>
                    <td><?= arrIndex($item, 'company_email'); ?></td>
                    
                    
                    

                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>                        
                <?php foreach ($companylabels as $label): ?>
                    <th><?php echo $label ?></th>
                <?php endforeach; ?>
            </tr>
        </tfoot>
    </table>
</div>
<?php 
}

?>