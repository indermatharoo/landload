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
    <form autocomplete="off" action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="add-user">
        <div class="form-group">
            <div class="col-sm-6">
                <label>Property </label>
                
                <select name="property_id" class="form-control">
                    <option></option>
                    <?php
                    foreach($propertyList as $list)
                    {
                        ?>
                    <option value="<?php echo $list['id'] ?>" <?php echo ($list['id']==$details['property_id'])?'selected':''; ?>><?php echo $list['pname'] ?></option>
                        <?php 
                    }
                    ?>
                </select>
            </div>


            <div class="col-sm-6">
                <label>Unit Name</label>
                <input type="text" class="form-control" name="unit_number" value="<?php echo $details['unit_number']; ?>"  placeholder="units Number">
            </div>
            <div class="col-sm-6">
                <label>Photo</label>
                <input type="file"  name="photo" multiple="" >
            </div>
            <div class="col-sm-6">
                <label>Gallery Images</label>
                <input type="file"  name="galleryImages[]" multiple  >
            </div>               
            <div class="col-sm-6">
                <label>Status</label><br>
                <?php foreach($status as $st=>$stval){ ?>
                <input type="radio" name="status" value="<?php echo $st ?>" <?php echo ($st==$details['status'])?'checked':''; ?>>&nbsp;&nbsp;<?php echo $stval ?>&nbsp;&nbsp;&nbsp;&nbsp;
                <?php } ?>
            </div>
            <div class="col-sm-6">
                <label>Unit Type</label>
                <select name="unit_type" class="form-control">
                    <option <?php echo ($details['unit_type']=='s')?'selected="selected"':''; ?> value="s">Shop</option>
                    <option <?php echo ($details['unit_type']=='f')?'selected="selected"':''; ?> value="f">Flat</option>
                </select>
               
            </div>   
            <div class="col-sm-6">
                <label>Area(sq.feet)</label>
                 <input type="text" class="form-control" name="area"  placeholder="Area" value="<?php echo $details['area']; ?>">
            </div>
            <div class="col-sm-6">
                <label>Room</label>
                <input type="text" class="form-control"  name="room"  placeholder="Rooms *" value="<?php echo $details['room']; ?>">
            </div>
            <div class="col-sm-6">
                <label>BathRoom</label>
                <input type="text" class="form-control"  name="bathroom"  placeholder="Bathroom *" value="<?php echo $details['bathroom']; ?>">
            </div>
            <div class="col-sm-6">
                <label>Rental Amount</label>
                <input type="text" class="form-control"  name="amount"  placeholder="rental Amount *" value="<?php echo $details['amount']; ?>">
            </div> 
            <div class="col-sm-6">
                <label>Features</label>
                <select data-placeholder="Choose a Feature..." class="chosen-select" multiple style="width:324px;" name="features[]" tabindex="4">
                      <?php
                      $exp = explode('|',$details['features']);
                      foreach($features as $feature){ ?>
                    <option value="<?php echo $feature['id'] ?>" <?php echo (in_array( $feature['id'] ,$exp))?'selected':'' ?>><?php echo $feature['tag'] ?></option>
                      <?php } ?>
                </select>
            </div> 
            <div class="col-sm-6">
                <label>Rent Types</label>
                <select name="amount_type" class="form-control">
                    <option>Select</option>
                    <?php foreach (Unitsmodel::$types as $val => $type): ?>
                        <option <?php echo ($val==$details['amount_type'])?'selected="selected"':''; ?> value="<?php echo $val ?>"><?php echo $type ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
           <div class="col-sm-6">
                <label>Active</label><br />
                <input type="radio" value="1" <?php echo ($details['is_active']==1)?'checked="checked"':''; ?>  name="active" >&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="0"  name="active" <?php echo ($details['is_active']==0)?'checked="checked"':''; ?>>&nbsp;&nbsp;No
            </div>
            
            <div class="col-sm-12">
                <label>Description</label>
                <textarea name="description" class="form-control"><?php echo $details['description']; ?></textarea>
            </div>
            
            <div class="col-sm-6">
                <?php foreach($images['result'] as $image){ ?>
                <img src="<?php echo $this->config->item('UNIT_IMAGE_URL').$image['image'] ?>" height="100px"  width="100px">
                <input type="checkbox" name="deleteImage[]" value="<?php echo $image['image_id'] ?>" >
                <?php } ?>
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
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>

