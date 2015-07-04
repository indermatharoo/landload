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
                    <td>Email <span class="error">*</span></td>
                    <td><input name="email" type="text" class="textfield width_95" id="email" value="<?php echo set_value('email'); ?>"></td>
                </tr>
<!--                <tr>
                    <td>Company Email<span class="error">*</span></td>
                    <td><input name="confirm_email" type="text" class="textfield width_95" id="confirm_email" value="<?php echo set_value('confirm_email'); ?>"></td>
                </tr>-->
               <tr>
                    <td width="21%">Telephone <span class="error">*</span></td>
                    <td width="79%"><input name="telephone" type="text" class="textfield width_95" id="address1" value="<?php echo set_value('telephone'); ?>"></td>
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