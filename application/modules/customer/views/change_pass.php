<?php echo $this->session->flashdata('success'); ?>
<h1 style="color: #006C86; text-align: left">Welcome <?php //echo $customer['fname']; ?></h1>
<div class="col-lg-12">
    <div class="corner4" id="ctx_menu">
        <a href="">Applied Properties</a> | 
        <a href="">Virtual Cabinet</a> | 
        <a href="dashboard/profile">Profile</a> | 
        <a href="dashboard/change_pass">Change Password</a> | 
        <a href="logout">Logout</a>

    </div>
    <?php $this->load->view('inc-messages');
    ?>
    Welcome to your customer area. Use above menu to navigate around.
    <form name="change_pass" method="post" action="">
        <table>
            <tr>
                <td>New password:</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td>Confirm new password:</td>
                <td><input type="password" name="passconf"></td>
            </tr>
            <tr>
                <td><input type="submit" ></td>
            </tr>
        </table>
    </form>
</div>
