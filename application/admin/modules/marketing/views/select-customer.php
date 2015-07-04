<h1>Select <?php echo $send_email ? "Email" : "SMS"; ?> Recipients</h1>
<?php $this->load->view(THEME . 'messages/inc-messages'); ?>

<form action="marketing/SendEmail/<?php echo $send_email ?>/<?php echo $days ?>/<?php echo $email_template_id ?>" method="post" enctype="multipart/form-data" name="filter_frm" id="filter_frm">
    <div class="tableWrapper">
        <table width="100%" border="0" cellpadding="2" cellspacing="0">
            <tr>

                <th width="2%"></th>
                <th width="13%">Customer</th>
                <th width="25%">Email</th>
                <th width="25%">Contact Number</th>
                <th width="35%">Company</th>


            </tr>
            <tr>
                <?php foreach ($customers as $customer) { ?>
                    <td><input type="checkbox" name="customer_list[]" value="<?php echo $customer['customer_id'] ?>" checked/></td>
                    <td><?php echo $customer['first_name'] . '' . $customer['last_name'] ?> </td>
                    <td><?php echo $customer['email'] ?> </td>
                    <td><?php echo $customer['billing_phone'] ?></td>
                    <td><?php echo $customer['company_name'] ?></td>




                </tr>
            <?php } ?>

        </table>
    </div>
    <div style="clear:both;">
    </div>
    <?php if (!empty($customers)) { ?>
        <p align="center"><input type="submit" name="button" value="<?php echo ($send_email == 1) ? 'Send Mail' : 'Send SMS' ?>">   </p>
    <?php } ?>

</form>