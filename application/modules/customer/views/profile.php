<h1 style="color: #006C86; text-align: left">Welcome <?php echo $customer['fname'] . ' ' . $customer['lname']; ?></h1>
<div class="col-lg-12">
    <div class="corner4" id="ctx_menu"> 
        <a href="<?php echo base_url() ?>customer/dashboard/applied_properties">Applied Properties</a> | 
        <a href="<?php echo base_url() ?>virtcab">Virtual Cabinet</a> | 
        <a href="<?php echo base_url() ?>customer/dashboard/profile">Profile</a> | 
        <a href="<?php echo base_url() ?>customer/dashboard/change_pass">Change Password</a> | 
        <a href="<?php echo base_url() ?>customer/logout">Logout</a>
    </div>
    <hr>
    <div class="col-lg-6">
        <div>
            <label>Name</label><br>
            <div><?= $customer['fname'] . ' ' . $customer['lname']; ?></div>
        </div>
        <div>
            <label>Email</label><br>
            <div><?= $customer['email'] ?></div>
        </div>
        <div>
            <label>Phone</label><br>
            <div><?= $customer['phone'] ?></div>
        </div>
        <div>
            <label>Address</label><br>
            <div><?= $customer['address'] ?></div>
        </div>
    </div>
</div>