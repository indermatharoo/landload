<h1>Edit Customer</h1>
<div id="ctxmenu"><a href="customer/customer/">Manage Customers</a> </div>
<?php $this->load->view(THEME.'messages/inc-messages'); ?>
<form action="customer/customer/edit/<?php echo $customer['customer_id']; ?>" method="post" enctype="multipart/form-data" name="addcatform" id="addcatform">
	<div id="tabs">
        <ul>
            <li><a href="<?php echo current_url(); ?>#tabs-1">Details</a></li>
			<li><a href="<?php echo current_url(); ?>#tabs-2">Limits</a></li>

        </ul>
        <div id="tabs-1">
			<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="formtable">
				<tr>
					<th width="20%"><b>First Name <span class="error"> *</span></b></th>
					<td width="80%"><input name="first_name" type="text" class="textfield" id="first_name" value="<?php echo set_value('first_name', $customer['first_name']); ?>" size="40"></td>
				</tr>
				<tr>
					<th><b>Last Name</b></th>
					<td><input name="last_name" type="text" class="textfield" id="last_name" value="<?php echo set_value('last_name', $customer['last_name']); ?>" size="40"></td>
				</tr>
				<tr>
					<th><b>Email</b><span class="error"> *</span></th>
					<td><input name="email" type="text" class="textfield" readonly="readonly" id="email" value="<?php echo set_value('email', $customer['email']); ?>" size="40"></td>
				</tr>

				<tr>
					<th><b>Phone<span class="error"> *</span></b></th>
					<td><input name="billing_phone" type="text" class="textfield" id="billing_phone" value="<?php echo set_value('billing_phone', $customer['billing_phone']); ?>" size="40"></td>
				</tr>

				<tr>
					<th><b>Address Line 1</b><span class="error"> *</span></th>
					<td><input name="billing_address1" type="text" class="textfield" id="billing_address1" value="<?php echo set_value('billing_address1', $customer['billing_address1']); ?>" size="40"></td>
				</tr>
				<tr>
					<th><b>Address Line 2</b></th>
					<td><input name="billing_address2" type="text" class="textfield" id="billing_address2" value="<?php echo set_value('billing_address2', $customer['billing_address2']); ?>" size="40"></td>
				</tr>
				<tr>
					<th><b>City</b><span class="error"> *</span></th>
					<td><input name="billing_city" type="text" class="textfield" id="billing_city" value="<?php echo set_value('billing_city', $customer['billing_city']); ?>" size="40"></td>
				</tr>
				<tr>
					<th><b>County</b><span class="error"> *</span></th>
					<td><input name="billing_state" type="text" class="textfield" id="billing_state" value="<?php echo set_value('billing_state', $customer['billing_state']); ?>" size="40"></td>
				</tr>

				<tr>
					<th><b>Post Code</b><span class="error"> *</span></th>
					<td><input name="billing_zipcode" type="text" class="textfield" id="billing_zipcode" value="<?php echo set_value('billing_zipcode', $customer['billing_zipcode']); ?>" size="40"></td>
				</tr>
				<tr>
					<th><b>Default Location</b><span class="error"> *</span></th>
					<td><?php echo form_dropdown('location_id', $locations,set_value('location_id',$customer['default_location']), ' class="textfield width_auto"'); ?></td>
				</tr>
				<tr>
					<th><b>Guardian</b></th>
					<td>
					<input type="radio" name="guardian" class="guardian" value="1" <?php echo set_radio('guardian', '1', ($customer['guardian'] == '1')); ?> />Yes
						<input type="radio" name="guardian" class="guardian" value="0" <?php echo set_radio('guardian', '0', ($customer['guardian'] == '0')); ?> />No
					
					</td>
					
				</tr>
				<tr id="guardian_discount">
					<th><b>Guardian Discount</b></th>
					<td><input name="guardian_discount" type="text" class="textfield" id="guardian" value="<?php echo set_value('guardian_discount', $customer['guardian_discount']); ?>" size="40"></td>
				</tr>

			</table>
		</div>

		<div id="tabs-2">
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="formtable">

				<tr>
					<th width="16%">Customer Type <span class="error">*</span></th>
					<td width="84%"><?php echo form_dropdown('customer_type_id', $customer_types, set_value('customer_type_id', $customer['customer_type_id']), ' class="textfield width_auto"'); ?></td>
				</tr>

				<tr>
					<th ><b>Monthly Limit</b> </th>
					<td >
						<input type="radio" name="mon_limit" value="1" <?php echo set_radio('mon_limit', '1', ($customer['active_monthly_limit'] == '1')); ?> />Yes
						<input type="radio" name="mon_limit" value="0" <?php echo set_radio('mon_limit', '0', ($customer['active_monthly_limit'] == '0')); ?> />No
					</td>
				</tr>
				<tr>
					<th>&nbsp;</th>
					<td><input name="monthly_limit" type="text" class="textfield" id="monthly_limit" value="<?php echo set_value('monthly_limit', $customer['monthly_limit']); ?>" size="40"></td>
				</tr>

				<tr>
					<th ><b>Weekly Limit</b> </th>
					<td wwidth="773">
						<input type="radio" name="week_limit" value="1" <?php echo set_radio('week_limit', '1', ($customer['active_weekly_limit'] == '1')); ?> />Yes
						<input type="radio" name="week_limit" value="0" <?php echo set_radio('week_limit', '0', ($customer['active_weekly_limit'] == '0')); ?> />No
					</td>
				</tr>
				<tr>
					<th>&nbsp;</th>
					<td><input name="weekly_limit" type="text" class="textfield" id="weekly_limit" value="<?php echo set_value('weekly_limit', $customer['weekly_limit']); ?>" size="40"></td>
				</tr>

				<tr>
					<th><b>Daily Limit</b></th>
					<td>
						<input type="radio" name="d_limit" value="1" <?php echo set_radio('d_limit', '1', ($customer['active_daily_limit'] == '1')); ?> />Yes
						<input type="radio" name="d_limit" value="0" <?php echo set_radio('d_limit', '0', ($customer['active_daily_limit'] == '0')); ?> />No
					</td>
				</tr>
				<tr>
					<th>&nbsp;</th>
					<td><input name="daily_limit" type="text" class="textfield" id="daily_limit" value="<?php echo set_value('daily_limit', $customer['daily_limit']); ?>" size="40"></td>
				</tr>

				<tr>
					<th><b>Order Limit</b></th>
					<td>
						<input type="radio" name="o_limit" value="1" <?php echo set_radio('o_limit', '1', ($customer['active_order_limit'] == 1)); ?> />Yes
						<input type="radio" name="o_limit" value="0" <?php echo set_radio('o_limit', '0', ($customer['active_order_limit'] == 0)); ?> />No
					</td>
				</tr>
				<tr>
					<th><b>&nbsp;</b></th>
					<td><input name="order_limit" type="text" class="textfield" id="order_limit" value="<?php echo set_value('order_limit', $customer['order_limit']); ?>" size="40"></td>
				</tr>
				
			

			</table>
		</div>


		<p align="center"> Fields marked with <span class="error">*</span> are required.</p>
		<p><input type="hidden" name="customer_id" id="customer_id" value="<?php echo $customer['customer_id']; ?>" /></p>

		<p align="center"><input type="submit" name="button" id="button" value="Submit"></p>

	</div>
</form>