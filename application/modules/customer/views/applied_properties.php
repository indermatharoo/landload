<?php //echo $this->session->flashdata('success'); 

//e($properties);
?>
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
    <h3>Applied Properties</h2>
    <form name="change_pass" method="post" action="">
        <table width="100%">
            <tr>
                <th>Unit name</th>
                <th>Property Type</th>
                <th>Rent Amount</th>
            </tr>
            <?php if($properties['num_rows'] > 0){ ?>
          <?php  foreach($properties['result'] as $property){ ?>
            <tr>
                <td><?php echo arrIndex($property,'unit_number'); ?></td>
                <td><?php echo arrIndex($property,'property_type'); ?></td>
                <td><?php echo arrIndex($property,'rent_amount'); ?></td>
            </tr>
            <?php } }
 else {
            ?>
            <td><h4>No Record Found</h4></td>    
 <?php } ?>
        </table>
    </form>
</div>
