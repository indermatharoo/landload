<link href="<?php echo base_url() ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php
//echo 
?>
<div class="col-lg-12">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Franchise Listing</h3>
        </div>
        <?php
//        e($labels);
        ?>
        <div class="box-body">
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
                    foreach ($franchises as $franchise):
                        echo "<tr class='franchise' franchise-id=" . arrIndex($franchise, 'id') . ">";
                        foreach ($labels as $key => $label):
                            echo "<td>" . arrIndex($franchise, $key) . "</td>";
                        endforeach;
                    endforeach;
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
            <?php // foreach ($franchises as $franchise):  ?>

            <?php // endforeach;  ?>
        </div>

        <div class="row col-lg-offset-0">
            <form method="post" name="targetsetting">
                <h3>Status</h3>
                <h4>Assign Percentage And Color For Target</h4>
                <?php foreach ($targetcolors as $targetcolor): ?>
                    <div class="input-group col-lg-12">
                        <input type="text" class="col-lg-5" placeholder="Percentage" name="percentage[]" value="<?php echo arrIndex($targetcolor, 'percentage') ?>">
                        <input type="text" class="col-lg-5" placeholder="Color" name="color[]"  value="<?php echo arrIndex($targetcolor, 'color') ?>">
                    </div>
                    <br/>                
                <?php endforeach; ?>
                <input type="button" class="targetsetting" value ="save"/>
            </form>
        </div>
    </div>
</div>
<?php
$this->load->view('headers/franchise', array('base_url' => base_url()));
?>