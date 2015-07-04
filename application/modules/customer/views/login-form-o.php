<div class="center">        
    <h2>Jaspers Customer</h2>
</div> 
<div class="col-lg-12">
<!--    <div class="col-lg-6">
        <div id="new_customer">
            <h2>New Customers</h2>
            <p>In just one step, sign up and finalize your purchase: all this with ease, speed and safety. <strong>Register now.</strong></p>
            <p><a href="customer/register"><img src="images/btn-register.png" width="149" height="48" /></a></p>
        </div>
    </div>-->
    <div class="col-lg-6 col-lg-offset-3">
        <div id="returning_customer">
            <h2>Existing Customers</h2>
            <?php $this->load->view('inc-messages'); ?>
            <form id="form1" name="form1" method="post" action="customer/login">
                <table width="415" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="82" align="right">Email <span class="error">*</span></td>
                        <td width="333"><input name="username" type="text" class="textfield width_95" id="email"></td>
                    </tr>
                    <tr>
                        <td align="right">Password <span class="error">*</span></td>
                        <td><input name="password" type="password" class="textfield width_95" id="passwd"></td>
                    </tr>
                    <tr>
                        <td align="right">&nbsp;</td>
                        <td><a href="customer/password"><input type="image" src="images/btn-login.png" width="100" height="35"></a></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>




