<?php
$muser = $user;
?>
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <i class="fa fa-user fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Add User</h3>
        </div>
        <div class="col-sm-1" style="text-align: right">
            <a href="user"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-home" title="Manage User"></i></h3></a>
        </div>
    </div>
</header>
<div class="col-lg-12 padding-0 mar-top15">
    <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="add-user">
        <div class="form-group">
            <div class="col-sm-6">
                <label>First Name<span class="red">*</span></label>
                <input type="text" class="form-control" id="username" name="name" value="<?= arrIndex($user, 'name'); ?>" placeholder="First Name *">
            </div>

            <div class="col-sm-6">
                <label>City<span class="red">*</span></label>
                <input type="text" class="form-control" name="city" value="<?= arrIndex($user, 'city'); ?>" placeholder="City *">
                </textarea>
            </div>
            <div class="col-sm-6">
                <label>State<span class="red">*</span></label>
                <input type="text" class="form-control" name="state" value="<?= arrIndex($user, 'state'); ?>" placeholder="State *">
            </div>
            <div class="col-sm-6">
                <label>Country<span class="red">*</span></label>
                <select name="country"  class="form-control" >
                    <!--<option value=""></option>-->
                    <?php foreach ($country as $val) { ?>
                        <?php
                        $selected = (arrIndex($val, 'iso') == 'GB') ? true : false;
                        ?>
                        <option <?php echo ($selected) ? "selected" : ""; ?> value="<?php echo $val['iso'] ?>" <?php echo ( arrIndex($user, 'country') == $val['iso']) ? "selected" : ""; ?>><?php echo $val['nicename'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-sm-6">
                <label>Phone<span class="red">*</span></label>
                <input type="text" class="form-control" name="phone" value="<?= arrIndex($user, 'phone'); ?>" placeholder="Phone *">
            </div>
            <div class="col-sm-6">
                <label>mobile<span class="red">*</span></label>
                <input type="text" class="form-control" name="mobile" value="<?= arrIndex($user, 'mobile'); ?>" placeholder="mobile *">
            </div>

            <!--            <div class="col-sm-6">
                            <label>Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= arrIndex($user, 'name'); ?>" placeholder="Username *">
                        </div>-->
            <div class="col-sm-6">
                <label>Email<span class="red">*</span></label>
                <input type="text" class="form-control" id="email" name="email" value="<?= arrIndex($user, 'email'); ?>" placeholder="Email *">
            </div>
            <div class="col-sm-12">
                <label>Address<span class="red">*</span></label>
                <!--<input type="text" class="form-control" name="address" value="<?= arrIndex($user, 'address'); ?>" placeholder="Address *">-->                
                <textarea name="address" class="form-control"><?= arrIndex($user, 'address'); ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6">
                <label>Password<span class="red">*</span></label>
                <input type="password" class="form-control" id="passwd" name="pass" value="" placeholder="Password *">
            </div>
            <div class="col-sm-6">
                <label>Confirm Password<span class="red">*</span></label>
                <input type="password" class="form-control" id="passwd1" name="pass1" value="" placeholder="Confirm Password *">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12 text-center">
                Fields mark with <span class="error">*</span> required
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12 center">
                <button type="submit" name="button" id="button" class="btn btn-primary preview-add-button btn-fix-width">
                    <?php echo (!$edit) ? 'Add' : 'Submit'; ?>
                </button>
            </div>
        </div>
    </form>
</div>
<?php $this->load->view('headers/user_add'); ?>
