<div class="col-lg-6">
    <h1 style="display: none">Login Form</h1>
    <?php $this->load->view('inc-messages'); ?>

    <form action="<?php echo createUrl('customer/login'); ?>" method="post" role="form" class="">
        <div class="form-group">
            <input type="text" name="email" class="form-control br-round" id="email" placeholder="Email"/>
            <div class="validation"></div>
        </div>
        <div class="form-group">
            <input type="password" class="form-control br-round" name="password" id="password" placeholder="password" />
            <div class="validation"></div>
        </div>
        <button name="" type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

