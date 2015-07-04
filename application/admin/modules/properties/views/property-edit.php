<?php
$user = array();
$muser = $user;

?>
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <i class="fa fa-user fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Add Property</h3>
        </div>
        <div class="col-sm-1" style="text-align: right">
            <a href="user"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-home" title="Manage Property"></i></h3></a>
        </div>
    </div>
</header>
<div class="col-lg-12 padding-0 mar-top15">
    <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="add-user">
        <div class="form-group">
            <div class="col-sm-6">
                <label>Property Name</label>
                <input type="text" class="form-control" name="pname" value="<?= arrIndex($details, 'pname'); ?>" placeholder="Property Name *">
            </div>

            <div class="col-sm-6">
                <label>Property Type</label><br>
                <?php foreach($propertiesType as $ptype){ ?>
                <input type="radio" name="ptype" value="<?php echo $ptype['short_code'] ?>" <?php echo ($ptype['short_code']==$details['type'])?'checked':''; ?>><?php echo $ptype['type'] ?><br>
                <?php } ?>
            </div>
            <div class="col-sm-6">
                <label>Number of units</label>
                <input type="text" class="form-control" name="units" value="<?= arrIndex($details, 'units'); ?>" placeholder="Number of units">
            </div>
            <div class="col-sm-6">
                <label>Photo</label>
                <input type="file"  name="photo" value="<?= arrIndex($details, 'state'); ?>" >
            </div>
            <div class="col-sm-6">
                <label>Owner</label>
                <input type="text" class="form-control" name="owner" value="<?= arrIndex($details, 'owner'); ?>" placeholder="Owner  *">
            </div>
            <div class="col-sm-6">
                <label>Country</label>
                <select name="country"  class="form-control" >
                    <option value=""></option>
                    <?php foreach($country as $val){ ?>
                    <option value="<?php echo $val['iso'] ?>" <?php echo ( arrIndex($details, 'country')== $val['iso']) ?"selected":""; ?>><?php echo $val['nicename'] ?></option>
                    <?php } ?>
                </select>
            </div>
            
            <div class="col-sm-6">
                <label>Street</label>
                <input type="text" class="form-control" name="street" value="<?= arrIndex($details, 'street'); ?>" placeholder="Street  *">
            </div>
            

            <div class="col-sm-6">
                <label>City</label>
                  <input type="text" class="form-control" name="city" value="<?= arrIndex($details, 'city'); ?>" placeholder="City *">
            </div>

            <div class="col-sm-6">
                <label>State</label>
                <input type="text" class="form-control"  name="state" value="<?= arrIndex($details, 'state'); ?>" placeholder="State *">
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
<?php //$this->load->view('headers/user_add'); ?>
