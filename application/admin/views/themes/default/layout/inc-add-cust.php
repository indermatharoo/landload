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
                    <input  name="address1" 
                            value="<?php echo setDefault($customerDet['address1'], ''); ?>" 
                            type="text" 
                            placeholder="Address Line 1" r
                            equired="" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-12">
                    <input  name="address2" 
                            value="<?php echo setDefault($customerDet['address2'], ''); ?>" 
                            type="text" 
                            placeholder="Address Line 2" 
                            required="" 
                            class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6">
                    <input name="city" 
                           value="<?php echo setDefault($customerDet['city'], ''); ?>" 
                           type="text" placeholder="Town" required="" class="form-control">
                </div>
                <div class="col-lg-6">
                    <input name="zipcode" 
                           value="<?php echo setDefault($customerDet['zipcode'], ''); ?>" 
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
                    <input name="phone" 
                           value="<?php echo setDefault($customerDet['phone'], ''); ?>" 
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
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-fix-width">Submit</button>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</div>

<div class="form-inline"></div>


