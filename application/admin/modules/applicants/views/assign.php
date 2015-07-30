<?php //e($details);     ?>


<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <i class="fa fa-user fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Assign Property</h3>
        </div>
        <div class="col-sm-1" style="text-align: right">
            <!--<a href="units"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-home" title="Manage Units"></i></h3></a>-->
        </div>
    </div>
</header>
 <form autocomplete="off" action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="add-user">
<div class="col-lg-12 padding-0 mar-top15">
    <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
   
        <div class="col-sm-6">
            <?php //e($properties) ?>
            <label>Property<span class="red">*</span></label>
                <select name="property_id" class="form-control" autocomlete="off">
                        <option></option>
                        <?php if($properties['num_rows'] > 0) {?>

                        <?php foreach($properties['result'] as $tnt){ ?>
                        <option value="<?php echo arrIndex($tnt, 'id') ?>"><?php echo trim(arrIndex($tnt,'unit_number')) ?></option>
                        <?php }} ?>  
                </select>
        </div>
    
</div>
<div class="form-group">
    <div class="col-sm-12 center">
        <button type="submit" name="button" id="button" class="btn btn-primary preview-add-button btn-fix-width">Submit</button>
    </div>
</div>
     
</form>



