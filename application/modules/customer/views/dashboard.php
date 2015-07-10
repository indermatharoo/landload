<h1 style="color: #006C86; text-align: left">Welcome <?php echo $customer['fname']; ?></h1>
<div class="col-lg-12">
    <div class="corner4" id="ctx_menu">
        <a href="">Applied Properties</a> | <a href="">Virtual Cabinet</a> | <a href="">Profile</a> | <a href="">Change Password</a> | <a href="logout">Logout</a>

    </div>

    <?php $this->load->view('inc-messages');
    ?>
    Welcome to your customer area. Use above menu to navigate around.
</div>
