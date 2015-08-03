<?php //e($details);     ?>
<link rel="stylesheet" href="js/tagsystem/chosen.css">  
<script src="js/tagsystem/chosen.jquery.js" type="text/javascript"></script>
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <i class="fa fa-user fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Edit Property</h3>
        </div>
        <div class="col-sm-1" style="text-align: right">
            <a href="units"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-home" title="Manage Units"></i></h3></a>
        </div>
    </div>
</header>
<div class="col-lg-12 padding-0 mar-top15">
    <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
    <form autocomplete="off" action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="add-user">
        <div class="col-sm-6">
            <label>Unit Name<span class="red">*</span></label>
            <input type="text" class="form-control" name="unit_number"  placeholder="Unit Name" value="<?php echo arrIndex($details, 'unit_number') ?>">
        </div>
        <div class="col-sm-6">
            <label>Photo<span class="red">*</span></label>
            <input type="file"  name="photo"   >
            <img src="<?php echo $this->config->item('UNIT_IMAGE_URL').  arrIndex($details,  'unit_image'); ?>" height="50" width="50">
        </div>
        <div class="col-sm-6">
            <label>Owner<span class="red">*</span></label>
            <input type="text" class="form-control" name="owner"  placeholder="Owner  *" value="<?php echo arrIndex($details, 'owner') ?>">
        </div>
        <div class="col-sm-6">
            <label>Street<span class="red">*</span></label>
            <input type="text" class="form-control" name="street"  placeholder="Street  *" value="<?php echo arrIndex($details, 'street') ?>">
        </div>
        <div class="col-sm-6">
            <label>City<span class="red">*</span></label>
            <input type="text" class="form-control" name="city"  placeholder="City *" value="<?php echo arrIndex($details, 'city') ?>">
        </div>
        <div class="col-sm-6">
                <label>Post Code<span class="red">*</span></label>
                  <input type="text" class="form-control" name="post_code"  placeholder="Post Code *" value="<?php echo arrIndex($details, 'post_code') ?>">
        </div>
            <div class="col-sm-6">
                <label>County<span class="red">*</span></label>
                <select name="county" class="form-control">
                    <option></option>
                    <?php foreach($county as $counties){ ?>
                    <option value="<?php echo $counties['county'] ?>" <?php if(arrIndex($details, 'county')==$counties['county']){echo "selected";} ?> ><?php echo $counties['county'] ?></option>
                    <?php } ?>
                </select>
            </div>      
        <?php /* ?>
        <div class="col-sm-6">
            <label>Country<span class="red">*</span></label>
            <input type="text" class="form-control"  name="country"  placeholder="County *" value="<?php echo arrIndex($details, 'country') ?>">
        </div>
        <?php */ ?>
        <input type="hidden" name="country"  value="GB" >
        <div class="col-sm-6">
            <label>Gallery Images</label>
            <input type="file"  name="galleryImages[]" multiple  >
        </div>               
        <div class="col-sm-6">
            <label>Status<span class="red">*</span></label><br>
            <?php foreach ($status as $st => $stval) { ?>
                <input type="radio" name="status" value="<?php echo $st ?>" <?php echo ($st == $details['status']) ? 'checked' : ''; ?>>&nbsp;&nbsp;<?php echo $stval ?>&nbsp;&nbsp;&nbsp;&nbsp;
            <?php } ?>
        </div>
        <div class="col-sm-6">
            <label>Rental Amount<span class="red">*</span></label>
            <input type="text" class="form-control"  name="amount"  placeholder="rental Amount *" value="<?php echo $details['amount']; ?>">
        </div> 
        <div class="col-sm-6">
            <label>Features</label>
            <select data-placeholder="Choose a Feature..." class="chosen-select" multiple style="width:324px;" name="features[]" tabindex="4">
                <?php
                $exp = explode('|', $details['features']);
                foreach ($features as $feature) {
                    ?>
                    <option value="<?php echo $feature['id'] ?>" <?php echo (in_array($feature['id'], $exp)) ? 'selected' : '' ?>><?php echo $feature['tag'] ?></option>
                <?php } ?>
            </select>
        </div> 
        <div class="col-sm-6">
            <label>Rent Types<span class="red">*</span></label>
            <select name="amount_type" class="form-control">
                <option>Select</option>
                <?php foreach (Unitsmodel::$types as $val => $type): ?>
                    <option <?php echo ($val == $details['amount_type']) ? 'selected="selected"' : ''; ?> value="<?php echo $val ?>"><?php echo $type ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-sm-6">
            <label>Map Image</label>
            <input type="file"  name="map_image" style="height: 34px;"> <strong>(NOTE: Only browse the image if you want to replace existing)</strong>
        </div>

        <div class="col-sm-6">
            <label>Featured</label><br />
            <input type="radio" value="1"  name="is_featured" <?php echo ($details['is_featured'] == 1) ? 'checked="checked"' : ''; ?>>&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="0"  name="is_featured" <?php echo ($details['is_featured'] == 0) ? 'checked="checked"' : ''; ?>>&nbsp;&nbsp;No
        </div>

        <div class="col-sm-6">
            <label>Active</label><br />
            <input type="radio" value="1" <?php echo ($details['is_active'] == 1) ? 'checked="checked"' : ''; ?>  name="active" >&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="0"  name="active" <?php echo ($details['is_active'] == 0) ? 'checked="checked"' : ''; ?>>&nbsp;&nbsp;No
        </div>

        <div class="col-sm-12">
            <label>Description</label>
            <textarea name="description" class="form-control"><?php echo $details['description']; ?></textarea>
        </div>

        <div class="col-sm-6">
            <label>Unit Type<span class="red">*</span></label>
            <select name="unit_type" class="form-control" autocomlete="off">
                <option value="">-Select Type-</option>
                <?php foreach ($propertiesType as $ptype) { ?>
                    <option value="<?php echo $ptype['short_code'] ?>" <?php
                    if ($ptype['short_code'] == arrIndex($details, 'unit_type')) {
                        echo "selected    ";
                    }
                    ?>><?php echo $ptype['type'] ?></option>

                <?php } ?>
            </select>
        </div>   

        <div class="form-group extraAttributes">
        </div>

        <div class="col-sm-6">

            <?php foreach ($images['result'] as $image) { ?>
                <div class="koiclass col-sm-4 center" >
                    <img src="<?php echo $this->config->item('UNIT_IMAGE_URL') . $image['image'] ?>" height="100px"  width="100px">
                    <input type="checkbox" name="deleteImage[]" value="<?php echo $image['image_id'] ?>" title="">delete
                </div>
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
        <button type="submit" name="button" id="button" class="btn btn-primary preview-add-button btn-fix-width">Submit</button>
    </div>
</div>
</form>

<script type="text/javascript">
    var config = {
        '.chosen-select': {}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
    $(document).ready(function () {
        post();
        $('select[name="unit_type"]').on('change', function () {
            post();
        });
    });

    function post(elm) {
        var val = $('select[name="unit_type"]').val(),
                unit_id = '<?php echo $unit_id; ?>';
        ;
        $.post('units/attributes/getAttributeValue', {val: unit_id, type: val}, function (response) {
            response = JSON.parse(response);
            if (!response.success) {
                $('.extraAttributes').html('');
                return false;
            }
            var html = '';
            response.data.forEach(function (elm) {
                    if(elm.type=="text")
                    {
                        var row = '';
                        row += '<div class="col-sm-6">';
                        row += '<label>' + capitalizeFirstLetter(elm.label) + '</label><br />';
                        row += '<input type="text" class="form-control " value="'+elm.value+'" name="attributes[' + elm.id + ']"   placeholder="' + capitalizeFirstLetter(elm.label) + '">';
                        row += '</div>';
                        html += row;
                    }
                    else
                    {

                    var row = '';
                    row += '<div class="col-sm-6">';
                    row += '<label>' + capitalizeFirstLetter(elm.label) + '</label><br />';
                    row += '<select name="attributes[' + elm.id + ']"  class="form-control drpdown-' + elm.id + '" ></select>';
                    row += '</div>';
                    html += row;      
                    $.ajax({
                        url:'units/attributes/getAttributeVals',
                        type:'post',
                        
                        data:{val: elm.id}                        
                    }).done(function(htm){
                        $('.drpdown-' + elm.id ).html(htm);
                        $('.drpdown-' + elm.id +' option[value="'+elm.value+'"]').attr('selected',true);
                    })
                    }
            });
            $('.extraAttributes').html(html);
        });
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    function l(v) {
        console.log(v);
    }

</script>

