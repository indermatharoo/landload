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
            <!-- <div class="col-sm-6">
                <label>Property </label>
                <select name="property_id" class="form-control">
                    <option></option>
                    <?php
                    foreach ($propertyList as $list) {
                        ?>
                        <option <?php if ($list['is_active'] != 1) { ?>disabled<?php } ?> value="<?php echo $list['id'] ?>"><?php echo $list['pname'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>-->
            <div class="col-sm-6">
                <?php //e($propertiesType) ?>
                <label>Property Type<span class="red">*</span></label>
                <select name="ptype" class="form-control" autocomlete="off">
                    <option value="">-Select Type-</option>
                    <?php foreach($propertiesType as $ptype){ ?>
                        <option value="<?php echo $ptype['short_code'] ?>"><?php echo $ptype['type'] ?></option>
                    <?php } ?>
                </select>
                
            </div>

            <div class="col-sm-6">
                <label>Unit Name<span class="red">*</span></label>
                <input type="text" class="form-control" name="unit_number"  placeholder="Unit Name">
            </div>
            <div class="col-sm-6">
                <label>Photo<span class="red">*</span></label>
                <input type="file"  name="photo"   >
            </div>
            <div class="col-sm-6">
                <label>Owner<span class="red">*</span></label>
                <input type="text" class="form-control" name="owner"  placeholder="Owner  *">
            </div>
            <div class="col-sm-6">
                <label>Street<span class="red">*</span></label>
                <input type="text" class="form-control" name="street"  placeholder="Street  *">
            </div>
            <div class="col-sm-6">
                <label>City<span class="red">*</span></label>
                  <input type="text" class="form-control" name="city"  placeholder="City *">
            </div>
            <div class="col-sm-6">
                <label>Post Code<span class="red">*</span></label>
                  <input type="text" class="form-control" name="post_code"  placeholder="Post Code *">
            </div>
            <div class="col-sm-6">
                <label>Country<span class="red">*</span></label>
                <select name="country"  class="form-control" >
                    <!--<option value=""></option>-->
                    <?php foreach ($country as $val) { ?>
                        <?php
                        $selected = (arrIndex($val, 'iso') == 'GB') ? true : false;
                        ?>
                        <option <?php echo ($selected) ? "selected" : ""; ?> value="<?php echo $val['iso'] ?>" ><?php echo $val['nicename'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-sm-6">
                <label>Gallery Images</label>
                <input type="file"  name="galleryImages[]" multiple  >
            </div>            
            <div class="col-sm-6">
                <label>Status<span class="red">*</span></label><br>
                <?php foreach ($status as $st => $stval) { ?>
                    <input type="radio" name="status" value="<?php echo $st ?>" <?php if($st=="1"){echo "checked";} ?>>&nbsp;&nbsp;<?php echo $stval ?>&nbsp;&nbsp;&nbsp;&nbsp;
                <?php } ?>
            </div>
<!--            <div class="col-sm-6">
                <label>Active</label><br />
                <input type="radio" value="1" checked="checked"  name="active" >&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="0"  name="active">&nbsp;&nbsp;No
            </div>-->
            <div class="col-sm-6">
                <label>Rental Amount<span class="red">*</span></label>
                <input type="text" class="form-control"  name="amount"  placeholder="rental Amount *">
            </div>
            <div class="col-sm-6">
                <label>Features</label>
                <select data-placeholder="Choose a Feature..." class="chosen-select form-control" multiple style="width:327px;" name="features[]" tabindex="4">
                    <?php foreach ($features as $feature) { ?>
                        <option value="<?php echo $feature['id'] ?>"><?php echo $feature['tag'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-sm-6">
                <label>Rent Types<span class="red">*</span></label>
                <select name="amount_type" class="form-control">
                    <option>Select</option>
                    <?php foreach (Unitsmodel::$types as $val => $type): ?>
                        <option value="<?php echo $val ?>"><?php echo $type ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="col-sm-6">
                <label>Map Image</label>
                <input type="file"  name="map_image" style="height: 34px;">
            </div>
            
            <div class="col-sm-6">
                <label>Featured</label><br />
                <input type="radio" value="1"  name="is_featured" >&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="0"  name="is_featured" checked="checked">&nbsp;&nbsp;No
            </div>
            
            
            <div class="col-sm-6">
                <label>Active</label><br />
                <input type="radio" value="1" checked="checked"  name="active" >&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="0"  name="active">&nbsp;&nbsp;No
            </div>

            <div class="col-sm-12">
                <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
        </div>
        <div class="col-sm-6">
            <label>Unit Type<span class="red">*</span></label><br>
            <select name="unit_type" class="form-control">
                <option value="">Select</option>
                <option value="s">Shop</option>
                <option value="f">Flat</option>
            </select>
        </div>            
        <div class="form-group extraAttributes">

        </div>
        <div class="form-group">
            <div class="col-sm-12 text-center">
                Fields mark with <span class="error1">*</span> required
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12 center">
                <button type="submit" name="button" id="button" class="btn btn-primary preview-add-button btn-fix-width">Add</button>
            </div>
        </div>
    </form>
</div>
<?php //$this->load->view('headers/user_add');   ?>
<script type="text/javascript">
    var config = {
        '.chosen-select': {}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
    $(document).ready(function () {
        $('select[name="unit_type"]').on('change', function () {
            var val = $(this).val();
            $.post('units/attributes/getAttribute', {val: val}, function (response) {
//                console.log(response);
                response = JSON.parse(response);
                if (!response.success) {
                    $('.extraAttributes').html('');
                    return false;
                }
                var html = '';
                response.data.forEach(function (elm) {
                    var row = '';
                    row += '<div class="col-sm-6">';
                    row += '<label>' + capitalizeFirstLetter(elm.label) + '</label><br />';
                    row += '<input type="text" class="form-control"  name="attributes[' + elm.id + ']"  placeholder="' + capitalizeFirstLetter(elm.label) + '">';
                    row += '</div>';
                    html += row;
                });
                $('.extraAttributes').html(html);
            });
        });
    });

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    function l(v) {
        console.log(v);
    }
</script>
