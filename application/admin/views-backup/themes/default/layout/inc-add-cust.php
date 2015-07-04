<header class="panel-heading">
    <div class="row">
        <div class="col-sm-12">
            <h3 style="margin: 0;">Add/Edit Customers</h3>
        </div>
    </div>
</header>
<div class="col-lg-12 padding-0" style="padding-top: 15px;">
    <form action="customer/addedit" class="form-horizontal" role="form" method="POST">
        <input type="hidden" name="ispost" value="1" />
        <fieldset>
            <?php
            if (isset($isEdit)) {
                echo form_hidden('editCutomer', $customerDet['customer_id']);
                echo form_hidden('auth_user_id', $customerDet['auth_user_id']);
                echo form_hidden('passwd', $customerDet['passwd']);
            }
            ?>
            <div class="form-group">
                <div class="col-lg-6">
                    <input type="text" 
                           name="first_name" 
                           placeholder="First Name" 
                           required="" 
                           value="<?php echo setDefault($customerDet['first_name'], ''); ?>" 
                           class="form-control">
                </div>
                <div class="col-lg-6">
                    <input type="text" 
                           name="last_name" 
                           value="<?php echo setDefault($customerDet['last_name'], ''); ?>" 
                           placeholder="Last Name" 
                           required="" 
                           class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-12">
                    <input  name="delivery_address1" 
                            value="<?php echo setDefault($customerDet['delivery_address1'], ''); ?>" 
                            type="text" 
                            placeholder="Address Line 1" r
                            equired="" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-12">
                    <input  name="delivery_address2" 
                            value="<?php echo setDefault($customerDet['delivery_address2'], ''); ?>" 
                            type="text" 
                            placeholder="Address Line 2" 
                            required="" 
                            class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6">
                    <input name="delivery_city" 
                           value="<?php echo setDefault($customerDet['delivery_city'], ''); ?>" 
                           type="text" placeholder="Town" required="" class="form-control">
                </div>
                <div class="col-lg-6">
                    <input name="delivery_zipcode" 
                           value="<?php echo setDefault($customerDet['delivery_zipcode'], ''); ?>" 
                           type="text" placeholder="Post Code" required="" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6">
                    <input name="email" 
                           value="<?php echo setDefault($customerDet['email'], ''); ?>" 
                           type="text" placeholder="Email" required="" class="form-control">
                </div>
                <div class="col-lg-6">
                    <input name="delivery_phone" 
                           value="<?php echo setDefault($customerDet['delivery_phone'], ''); ?>" 
                           type="text" placeholder="Telephone" required="" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-9">
                    <input name="passwd" 
                           value="<?php echo setDefault($customerDet['passwd'], ''); ?>" 
                           type="password" placeholder="Enter password" required="" class="form-control">
                </div>
            </div>            
            <div class="form-group">
                <div class="col-lg-4">
                    <div class="input-group">
                        <span class="input-group-addon primary"><span class="fa fa-linkedin"></span></span>
                        <input name="linkedin" 
                               value="<?php echo setDefault($customerDet['linkedin'], ''); ?>" 
                               type="text" class="form-control"  placeholder="Linkedin ID">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group">
                        <span class="input-group-addon primary"><span class="fa fa-facebook"></span></span>
                        <input name="facebook" 
                               value="<?php echo setDefault($customerDet['facebook'], ''); ?>" 
                               type="text" class="form-control" placeholder="Facebook ID">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group">
                        <span class="input-group-addon info"><span class="fa fa-twitter"></span></span>
                        <input name="twitter" 
                               value="<?php echo setDefault($customerDet['twitter'], ''); ?>" 
                               type="text" class="form-control" placeholder="Twitter ID">
                    </div>
                </div>
            </div>
            <div id="children-data" >
                <?php
                if (isset($isEdit)) {
                    $this->load->helper('date');
                    $divHtml = '';
                    foreach ($customerDetChild as $key => $kval) {
                        $newDynId = NOW() . $key;
                        $divHtml = '<div id="' . $newDynId . '" class="form-group">
                                        <div class="col-lg-6">
                                            <input type="hidden" name="childName[' . $newDynId . ']"  
                                                value="' . $kval['name'] . '" />' . $kval['name'] . '
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="hidden" name="childDob[' . $newDynId . ']"  
                                                value="' . $kval['dob'] . '" />' . $kval['dob'] . '
                                            </div>
                                            <div class="col-lg-11"> 
                                                <input type="hidden" name="childInterest[' . $newDynId . ']" 
                                                value="' . $kval['interest'] . '" />' . $kval['interest'] . '
                                            </div>
                                            <div class="child-det-remove" class="col-lg-1" data-id=\'' . $newDynId . '\'>
                                                <button type="button" 
                                                class="btn btn-sm btn-info"                                                 
                                                title="Remove"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>';
                    }
                    echo $divHtml;
                }
                ?>
            </div>     
            <h1 style="background: #EAEAEA; padding: 5px;">Add Child</h1>
            <div class="form-group">
                <div class="col-sm-12 padding-0">
                    <div class="col-sm-6">
                        <input name="childName[]" id="childName"  type="text" placeholder="Name" class="form-control">
                    </div>
                    <div class='col-sm-6 date' id='datetimepicker1'>
                        <input name="childDob[]" id="childDob" readonly type='text' class="form-control" placeholder="Child DOB"/>                        
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <textarea  id="childInterest" name="childInterest[]" placeholder="interests" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12" id="addChild" style="text-align: right; cursor: pointer">
                    <button class="btn btn-primary btn-fix-width">Add child</button>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-fix-width">Submit</button>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</div>
<script src="js/jquery-datetimepicker/jquery-ui.js"></script>
<script src="js/jquery-datetimepicker/jquery-ui-timepicker-addon.js"></script>
<link rel="stylesheet" href="js/jquery-datetimepicker/date-style.css">
<script>
    $(function () {
        $("#childDob").datepicker({
            dateFormat: 'dd-mm-yy'
        });
        $('#addChild').on('click', function () {
            var childName = $('#childName').val();
            var childDob = $('#childDob').val();
            var childInterest = $('#childInterest').val();
            if (childName.trim() == ""
                    || childDob.trim() == "" || childInterest.trim() == "") {
                bootbox.alert("Please check Child : Name, D.O.B, Interest must be fill");
                return false;
            }
            var newDynamicId = $.now();
            var addChild = "<div id='" + newDynamicId + "' class='form-group'>\n\
                            <div class='col-lg-6'><input type='hidden' name='childName[" + newDynamicId + "]' value='" + childName + "' />\n\
                            " + childName + "</div>\n\
                            <div class='col-lg-6'><input type='hidden' name='childDob[" + newDynamicId + "]' value='" + childDob + "' />" + childDob + "</div>\n\
                           <div class='col-lg-11'> <input type='hidden' name='childInterest[" + newDynamicId + "]' value='" + childInterest + "' /> " + childInterest + "</div>\n\
                            <div class='child-det-remove' data-id='" + newDynamicId + "' class='col-lg-1'><button type='button' class='btn btn-sm btn-info' title='Remove'><i class='fa fa-minus'></i></button></div></div>";
            $("#children-data").append(addChild);
            addChild = '';
            $('#childName').val('');
            $('#childDob').val('');
            $('#childInterest').val('');
        });
        $(document).on('click', '.child-det-remove', function () {
            var DivId = $(this).data('id');
            $('#' + DivId).remove();
        });
    });
</script>
<div class="form-inline"></div>


