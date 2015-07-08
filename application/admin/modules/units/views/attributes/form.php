<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <a href="units/attributes"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-arrow-left" title="Attributes"></i></h3></a>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Add Attribute</h3>
        </div>
    </div>
</header>
<?php $this->load->view('inc-messages'); ?>
<form  name="form" enctype="multipart/form-data" method="post" action="">
    <?php foreach ($model as $key => $value): ?>
        <?php
        if ($key == 'id'):
            ?>
            <input  type="hidden" name="<?php echo $key ?>" value="<?php echo $value ?>">
            <?php
            continue;
        endif;
        ?>
        <?php
        $unit_type = arrIndex($model, 'unit_type');
        if ($key == 'unit_type'):
            ?>
            <div class="form-group">
                <div class="col-sm-12">
                    <label>Attribute Type</label>
                    <select name="<?php echo $key ?>" class="form-control">
                        <option>Select</option>
                        <?php foreach (getUnitsTypes() as $key => $value): ?>
                            <option <?php echo ($unit_type == $key) ? 'selected="true"' : ''  ?> value="<?php echo $key ?>"><?php echo $value ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <?php
            continue;
        endif;
        ?>
        <div class="form-group">
            <div class="col-sm-12">
                <label><?php echo ucfirst($key); ?></label>
                <input type="text" placeholder="<?php echo ucfirst($key); ?>" value="<?php echo $value ?>" name="<?php echo $key; ?>" class="form-control">
            </div>
        </div>
    <?php endforeach; ?>
    <br/>
    <div class="form-group">
        <br/><br/>
        <div class="col-sm-12">
            <input type="submit" class="btn btn-primary preview-add-button btn-fix-width" value="Submit"/>
        </div>
    </div>
</form>