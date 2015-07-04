<h1>Marketing</h1>
<?php $this->load->view(THEME.'messages/inc-messages'); ?>

<form action="marketing/export_csv/<?php echo $days; ?>" method="post" enctype="multipart/form-data" name="filter_frm" id="filter_frm">
	<div class="tableWrapper">
		<table width="100%" border="0" cellpadding="2" cellspacing="0">
			<tr>
				<th width="2%"></th>
				<th width="10%">Customer</th>
				<th width="10%">Email</th>
				<th width="35%">Company</th>
			</tr>
			<tr>
				<?php foreach ($customers as $customer) { ?>
					<td><input type="checkbox" name="customer_list[]" value="<?php echo $customer['customer_id'] ?>" checked/></td>
					<td><?php echo $customer['first_name'] . '' . $customer['last_name'] ?> </td>
					<td><?php echo $customer['email'] ?> </td>
					<td><?php echo $customer['company_name'] ?></td>
				</tr>
			<?php } ?>
		</table>
	</div>
	<div style="clear:both;">
	</div>
	<?php if(!empty($customers)) {?>
	<p align="center"><input type="submit" name="button" value="Generate CSV"></p>
	<?php } ?>
</form>