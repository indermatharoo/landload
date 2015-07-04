<h1>Reject Customer</h1>
<div id="ctxmenu"><a href="customer/customer/">Manage Customers</a> | <a href="customer/customer/pending">Manage Pending Customers</a> </div>
<?php $this->load->view(THEME.'messages/inc-messages'); ?>
<form action="customer/customer/reject/<?php echo $customer['customer_id']; ?>" method="post" enctype="multipart/form-data" name="addcatform" id="addcatform">
	<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="formtable">
		
		
		<tr>
			<th width="177"><b>Reason for Reject <span class="error"> *</span></b></th>
			<td width="773"><textarea name="reject_text"  rows="10" cols="100" type="text" class="textfield" id="reject_text"><?php echo set_value('reject_text'); ?></textarea></td>
		</tr>
		
		
		
		<tr>
			<td>&nbsp;</td>
			<td>Fields marked with <span class="error">*</span> are required.</td>
        </tr>
        <tr>
			<td><input type="hidden" name="customer_id" id="customer_id" value="<?php echo $customer['customer_id']; ?>" /></td>

			<td><input type="submit" name="button" id="button" value="Submit"></td>
        </tr>
	</table>
</form>