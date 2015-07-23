<?php
$muser = $user;
//e($country);
?>
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <i class="fa fa-user fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Edit Company</h3>
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
                <label>Username</label>
                <input type="text" class="form-control" id="username" name="name" value="<?= arrIndex($user, 'name'); ?>" placeholder="Username *">
            </div>
            <div class="col-sm-6">
                <label>Email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?= arrIndex($user, 'email'); ?>" placeholder="Email *">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6">
                <label>Password</label>
                <input type="password" class="form-control" id="passwd" name="pass" value="<?= set_value('passwd'); ?>" placeholder="Password *">
            </div>
            <div class="col-sm-6">
                <label>Confirm Password</label>
                <input type="password" class="form-control" id="passwd1" name="pass1" value="<?= set_value('passwd1'); ?>" placeholder="Confirm Password *">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6">
                <label>Company Logo</label>
                <input type="file" class="form-control padding-0" id="image" name="image" placeholder="Image"/>
            </div>
             <div class="col-sm-6">
                <label>Company Name</label>
                <input type="text" class="form-control" id="company_name" name="company_name" value="<?= arrIndex($user, 'company_name'); ?>" placeholder="Company Name *">
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-sm-6">
                <label>Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?= arrIndex($user, 'phone'); ?>" placeholder="Phone">
            </div>
             <div class="col-sm-6">
                <label>Mobile</label>
                <input type="text" class="form-control" id="mobile" name="mobile" value="<?= arrIndex($user, 'mobile'); ?>" placeholder="Mobile">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-12">
                <label>Address</label>
                <textarea name="address" id="address" class="form-control"><?= arrIndex($user, 'address'); ?></textarea>
            </div>
             
        </div>
        
        <div class="form-group">
            <div class="col-sm-6">
                <label>City</label>
                <input type="text" class="form-control" id="city" name="city" value="<?= arrIndex($user, 'city'); ?>" placeholder="City">
            </div>
             <div class="col-sm-6">
                <label>State</label>
                <input type="text" class="form-control" id="state" name="state" value="<?= arrIndex($user, 'state'); ?>" placeholder="State">
            </div>
        </div>
        
         <div class="form-group">
              <div class="col-sm-6">
                <label>Country</label>
                <select name="country" class="form-control" autocomplete="off">
                <?php
                foreach ($country as $list){
                
                    ?>
                <option <?php if($user['country']==$list['id']) { echo "selected=selected"; } ?> value="<?php echo $list['id']; ?>"><?php echo $list['nicename']; ?></option>
                <?php
                }
                ?>
                </select>
            </div>
             <div class="col-sm-6">
                <label>Package</label>
                <?php
                $options = array(
                  'brone'  => 'Bronze',
                  'silver'    => 'Sliver',
                  'gold'   => 'Gold',
                  'diamond' => 'Diamond',
                );
                ?>
                <?php echo form_dropdown('package',$options,$user['package'],'class="form-control" autocomplete="off"'); ?>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-sm-6">
                <label>Contact Person</label>
                <input type="text" class="form-control" id="contact_person" name="contact_person" value="<?= arrIndex($user, 'contact_person'); ?>" placeholder="Contact Person">
            </div>
        </div>
        
        
        <div class="form-group">
            &nbsp;
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
</div>
<?php $this->load->view('headers/user_add'); ?>
