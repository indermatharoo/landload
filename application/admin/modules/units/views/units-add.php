<link rel="stylesheet" href="js/tagsystem/chosen.css">  
<script src="js/tagsystem/chosen.jquery.js" type="text/javascript"></script>
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <i class="fa fa-user fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Add Unit</h3>
        </div>
        <div class="col-sm-1" style="text-align: right">
            <a href="units"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-home" title="Manage Units"></i></h3></a>
        </div>
    </div>
</header>
<div class="col-lg-12 padding-0 mar-top15">
    <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="add-user">
        <div class="form-group">
            <div class="col-sm-6">
                <label>Property </label>
                <select name="property_id" class="form-control">
                    <option></option>
                    <?php
                    foreach ($propertyList as $list) {
                        ?>
                        <option value="<?php echo $list['id'] ?>"><?php echo $list['pname'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>


            <div class="col-sm-6">
                <label>unit Number</label>
                <input type="text" class="form-control" name="unit_number"  placeholder="units Number">
            </div>
            <div class="col-sm-6">
                <label>Photo</label>
                <input type="file"  name="photo"  >
            </div>
            <div class="col-sm-6">
                <label>Status</label><br>
                <?php foreach ($status as $st => $stval) { ?>
                    <input type="radio" name="status" value="<?php echo $st ?>"><?php echo $stval ?><br />
                <?php } ?>
            </div>
            <div class="col-sm-6">
                <label>Area(sq.feet)</label>
                <input type="text" class="form-control" name="area"  placeholder="Area">
            </div>
            <div class="col-sm-6">
                <label>Room</label>
                <input type="text" class="form-control"  name="room"  placeholder="Rooms *">
            </div>
            <div class="col-sm-6">
                <label>BathRoom</label>
                <input type="text" class="form-control"  name="bathroom"  placeholder="Bathroom *">
            </div>
            <div class="col-sm-6">
                <label>Rental Amount</label>
                <input type="text" class="form-control"  name="amount"  placeholder="rental Amount *">
            </div>
            <div class="col-sm-6">
                <label>Features</label>
                <select data-placeholder="Choose a Feature..." class="chosen-select" multiple style="width:350px;" name="features[]" tabindex="4">
                    <?php foreach ($features as $feature) { ?>
                        <option value="<?php echo $feature['id'] ?>"><?php echo $feature['tag'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-sm-6">
                <label>Rent Types</label>
                <select name="amount_type" class="form-control">
                    <option>Select</option>
                    <?php foreach (Unitsmodel::$types as $val => $type): ?>
                        <option value="<?php echo $val ?>"><?php echo $type ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-12 text-center">
                Fields mark with <span class="error">*</span> required
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12 center">
                <button type="submit" name="button" id="button" class="btn btn-primary preview-add-button btn-fix-width">Add</button>
            </div>
        </div>
    </form>
</div>
<?php //$this->load->view('headers/user_add');  ?>
<script type="text/javascript">
    var config = {
        '.chosen-select': {}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
</script>