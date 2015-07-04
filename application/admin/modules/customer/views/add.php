<div class="col-lg-7">
    <div class="row content-bg padding-0">
        <header class="panel-heading">
            <div class="row">
                <div class="col-sm-6">
                    <h3 style="margin: 0">My Profile</h3>
                </div>
            </div>
        </header>
        <div class="col-lg-12">
            <?php
//        e($model);
            ?>
            <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="add-user mar-top10">
                <input type="hidden" name="id" value="<?php echo arrIndex($model, 'customer_id') ?>">
                <input type="hidden" name="auth_user_id" value="<?php echo arrIndex($model, 'auth_user_id') ?>">
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="first_name" value="<?php echo arrIndex($model, 'first_name') ?>" placeholder="First Name">
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="last_name" value="<?php echo arrIndex($model, 'last_name') ?>" placeholder="Last Name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="passwd" value="<?php echo arrIndex($model, '') ?>" placeholder="Password">
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="passwd1" value="" placeholder="Repeat Password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="" readonly="true" value="<?php echo arrIndex($model, 'email') ?>" placeholder="Email">
                    </div>
                    <div class="col-sm-6">

                        <input type="text" class="form-control" name="linkedin" value="<?php echo arrIndex($model, 'linkedin') ?>" placeholder="Linkedin">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="twitter" value="<?php echo arrIndex($model, 'twitter') ?>" placeholder="Twitter">
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="facebook" value="<?php echo arrIndex($model, 'facebook') ?>" placeholder="Facebook">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="delivery_first_name" value="<?php echo arrIndex($model, 'delivery_first_name') ?>" placeholder="delivery first name">
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="delivery_last_name" value="<?php echo arrIndex($model, 'delivery_last_name') ?>" placeholder="delivery last name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <textarea type="text" class="form-control" name="delivery_address1" value="" placeholder="delivery address1"><?php echo arrIndex($model, 'delivery_address1') ?></textarea>
                    </div>
                    <div class="col-sm-6">
                        <textarea type="text" class="form-control" name="delivery_address2" value="" placeholder="delivery address2"><?php echo arrIndex($model, 'delivery_address2') ?></textarea>
                    </div>
                </div>
                <br/>
                <div class="form-group" style="margin-top:20px">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="delivery_phone" value="<?php echo arrIndex($model, 'delivery_phone') ?>" placeholder="Delivery Phone No">
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="delivery_city" value="<?php echo arrIndex($model, 'delivery_city') ?>" placeholder="Delivery City">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="delivery_state" value="<?php echo arrIndex($model, 'delivery_state') ?>" placeholder="Delivery State">
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="delivery_zipcode" value="<?php echo arrIndex($model, 'delivery_zipcode') ?>" placeholder="Delivery Zipcode">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <textarea type="text" class="form-control" name="billing_address1" value="" placeholder="Billing Address1"><?php echo arrIndex($model, 'billing_address1') ?></textarea>
                    </div>
                    <div class="col-sm-6">
                        <textarea type="text" class="form-control" name="billing_address2" value="" placeholder="Billing Address2"><?php echo arrIndex($model, 'billing_address2') ?></textarea>
                    </div>
                </div>
                <div class="form-group" style="margin-top:50px">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="billing_phone" value="<?php echo arrIndex($model, 'billing_phone') ?>" placeholder="Billing Phone">
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="billing_city" value="<?php echo arrIndex($model, 'billing_city') ?>" placeholder="Billing City">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="billing_state" value="<?php echo arrIndex($model, 'billing_state') ?>" placeholder="Billing State">
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="billing_zipcode" value="<?php echo arrIndex($model, 'billing_zipcode') ?>" placeholder="Billing Zipcode">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="file" class="form-control" name="image">
                    </div>
                </div>
                <button name="button" class="btn btn-primary preview-add-button btn-fix-width" onclick="window.location='<?php echo createUrl('customer/profile'); ?>';return false">Back</button>
                <button type="submit" name="button" id="button" class="btn btn-primary preview-add-button btn-fix-width">Save</button>
            </form>                    
            <br/>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<script>
    $(document).ready(function () {
        $('#button').on('click', function () {
            var pass, pass1;
            pass = $('input[name="passwd"]').val();
            pass1 = $('input[name="passwd1"]').val();
            if (pass != pass1) {
                alert('Password Does\'t Mached');
                return false;
            }
        });
    });
    function l(v) {
        console.log(v);
    }
</script>
