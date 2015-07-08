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
                <select name="ptype" class="form-control" autocomlete="off">
                    <option value="">-Select Type-</option>
                    <?php foreach($propertiesType as $ptype){ ?>
                    <option value="<?php echo $ptype['short_code'] ?>" <?php echo ($ptype['short_code']==$details['type'])?'selected="selected"':''; ?>><?php echo $ptype['type'] ?></option>
                    
                    <?php } ?>
                </select>
                
            </div>
            <div class="col-sm-6">
                <label>Unit name</label>
                <input type="text" class="form-control" name="units" value="<?= arrIndex($details, 'units'); ?>" placeholder="Number of units">
            </div>
            <div class="col-sm-6">
                <label>Photo</label>
                <input type="file"  name="photo" value="<?= arrIndex($details, 'state'); ?>" style="height: 34px;" >
            </div>
            <div class="col-sm-6">
                <label>Owner</label>
                <input type="text" class="form-control" name="owner" value="<?= arrIndex($details, 'owner'); ?>" placeholder="Owner  *">
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
                <label>County</label>
                <input type="text" class="form-control"  name="state" value="<?= arrIndex($details, 'state'); ?>" placeholder="County *">
            </div>
            
            <div class="col-sm-6">
                <label>Post Code</label>
                <input type="text" class="form-control"  name="postcode" value="<?= arrIndex($details, 'post_code'); ?>"  placeholder="Post Code *">
            </div>
            <div class="col-sm-6">
                <label>Active</label><br />
                <input type="radio" value="1" <?php echo ($details['is_active']==1)?'checked="checked"':''; ?>  name="active" >&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="0"  name="active" <?php echo ($details['is_active']==0)?'checked="checked"':''; ?>>&nbsp;&nbsp;No
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
