<div class="col-lg-12 col-sm-12 col-xs-12" style="padding-top: 3px;">
    <a href="http://blog.thecreationstation.co.uk/" target="_blank">Blog</a> &nbsp;|&nbsp; <a href="<?php echo createUrl('news') ?>">News</a> &nbsp;|&nbsp; <a href="<?php echo createUrl('contact') ?>">Contact</a>&nbsp;|&nbsp; 
    <?php if ($this->aauth->isCustomer()): ?>
        <span class="" style="text-transform: capitalize"><?= $this->aauth->getCustomerName(); ?> | <a href="<?php echo createUrl('customer/logout') ?>">Logout</a></span>
    <?php else: ?>
        <span class="custom_login">Customer login</span>
    <?php endif; ?>
</div>
<div class="col-lg-4 col-sm-6 col-xs-6" style="display: none">
    <form>
        <input type="text" name="keyword" class="input-search">
    </form>
</div>
<div class="login_form">
    <div class="cls">X</div>
    <h2>Login here</h2>
    <form action="<?php echo createUrl('customer/login'); ?>" method="post" role="form" class="loginform">
        <div class="form-group">
            <input type="text" name="email" class="form-control br-round bl-email" id="email" placeholder="Email"/>
            <div class="validation"></div>
        </div>
        <div class="form-group">
            <input type="password" class="form-control br-round bl-pass" name="password" id="password" placeholder="password" />
            <div class="validation"></div>
        </div>
        <button name="" type="submit" class="btn btn-primary subbmint">Login</button>
        <h3 class="login_success">You Are Logged In Now</h3>
        <h3 class="login_fail">Username / Password is Incorrect</h3>
    </form>
</div>
<script>
    function l(v) {
        console.log(v);
    }
    $(document).ready(function () {
        $('.login_success').hide();
         $('.login_fail').hide();
        $('.subbmint').click(function () {
            var email = $('.bl-email').val();
            var password = $('.bl-pass').val();
            if (!email || !password) {
                alert('Email and password are compulsary fields');
                return false;
            }
            $.post('<?php echo createUrl('customer/login') ?>', {email: email, password: password}, function (response) {
                console.log(response);
                var data = JSON.parse(response);                
                if (data.success) {
                    $('.login_fail').hide();
                    $('.custom_login').html('<a href="http://localhost/desktopdeli/customer/logout">Logout</a>');
                    $('.login_success').show();
                    setTimeout(function () {
                        $('.cls').trigger('click');
//                        window.location.href = '<?php echo base_url(); ?>';
                    }, 2000);
                }
                else
                {
                $('.login_fail').show();
                }
            });
            return false;
        });
    });
</script>
