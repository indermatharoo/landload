<?php echo $this->session->flashdata('success'); ?>
<h1 style="color: #006C86; text-align: left">Welcome <?php //echo $customer['fname']; ?></h1>
<div class="col-lg-12">
    <div class="corner4" id="ctx_menu">
        <a href="<?php echo base_url() ?>customer/dashboard/applied_properties">Applied Properties</a> | 
        <a href="<?php echo base_url() ?>virtcab">Virtual Cabinet</a> | 
        <a href="<?php echo base_url() ?>customer/dashboard/profile">Profile</a> | 
        <a href="<?php echo base_url() ?>customer/dashboard/change_pass">Change Password</a> | 
        <a href="<?php echo base_url() ?>customer/logout">Logout</a>


    </div>
    <?php $this->load->view('inc-messages');
    ?>
    Welcome to your customer area. Use above menu to navigate around.
</div>
