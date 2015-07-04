<div style='text-align: center'><h1 style="display: none">Registration Form</h1>
    <p style="margin-bottom: 20px; font-size: 20px">If you already have account then <a href="customer/login/">click here</a></p>
    <?php $this->load->view('inc-messages'); ?>
</div>
<form id="form1" name="form1" method="post" action="customer/register">
    <div class="detail_box" style="margin-right:20px;">
        <h3 class="h4_border" style="text-align: center">Address Details</h3>
        <table width="70%" border="0" cellspacing="0" cellpadding="4" align='center'>
            <tbody>
                <tr>
                    <td>First Name <span class="error">*</span></td>
                    <td><input name="first_name" type="text" class="textfield width_95" id="first_name" value="<?php echo set_value('first_name'); ?>"></td>
                </tr>
                <tr>
                    <td>Last Name <span class="error">*</span></td>
                    <td><input name="last_name" type="text" class="textfield width_95" id="last_name" value=""></td>
                </tr>
                <tr>
                    <td>Email <span class="error">*</span></td>
                    <td><input name="email" type="text" class="textfield width_95" id="email" value="<?php echo set_value('email'); ?>"></td>
                </tr>
                <tr>
                    <td>Confirm Email<span class="error">*</span></td>
                    <td><input name="confirm_email" type="text" class="textfield width_95" id="confirm_email" value="<?php echo set_value('confirm_email'); ?>"></td>
                </tr>
                <tr>
                    <td>Password<span class="error">*</span></td>
                    <td><input name="passwd" type="password" class="textfield width_95" id="passwd"></td>
                </tr>
                <tr>
                    <td>Confirm Password<span class="error">*</span></td>
                    <td><input name="cpasswd" type="password" class="textfield width_95" id="cpasswd"></td>
                </tr>
                <tr>
                    <td width="21%">Address 1 <span class="error">*</span></td>
                    <td width="79%"><input name="address1" type="text" class="textfield width_95" id="address1" value="<?php echo set_value('address1'); ?>"></td>
                </tr>
                <tr>
                    <td>Address 2</td>
                    <td><input name="address2" type="text" class="textfield width_95" id="address2" value="<?php echo set_value('address2'); ?>"></td>
                </tr>
                <tr>
                    <td>City <span class="error">*</span></td>
                    <td><input name="city" type="text" class="textfield width_95" id="city" value="<?php echo set_value('city'); ?>"></td>
                </tr>

                <tr>
                    <td>State <span class="error">*</span></td>
                    <td><input name="state" type="text" class="textfield width_95" id="state" value="<?php echo set_value('state'); ?>"></td>
                </tr>
                <tr>
                    <td>Zip Code <span class="error">*</span></td>
                    <td><input name="zipcode" type="text" class="textfield width_95" id="zipcode" value="<?php echo set_value('zipcode'); ?>"></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="clear:both"></div>
    <p align="center"  style="padding-top: 20px">Fields marked with<span class="error">*</span> are required.</p>
    <p align="center">
        <input type="submit" name="register" class='btn log' value="REGISTER" width="71" height="32" />
    </p>
</form>