<h1>Edit <?= $user['username']; ?> Details</h1>
<div id="ctxmenu"><a href="user/">Manage Users</a></div>
<?php $this->load->view(THEME.'messages/inc-messages'); ?>


<form action="user/edit/<?php echo $user['user_id']; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
            <th width="20%">Username <span class="error">*</span></th>
            <td width="80%"><input name="username" type="text" id="username" size="40" class="textfield" value="<?= set_value('username', $user['username']); ?>"></td>
        </tr>
        <tr>
            <th>Email <span class="error">*</span></th>
            <td><input name="email" type="text" id="email" size="40" class="textfield" value="<?= set_value('email', $user['email']); ?>"></td>
        </tr>
        <tr>
            <th>Password</th>
            <td><input name="passwd" type="password" id="passwd" size="40" class="textfield"></td>
        </tr>
        <tr>
            <th>Confirm Password</th>
            <td><input name="passwd1" type="password" id="passwd1" size="40" class="textfield"></td>
        </tr>
		<tr>
            <td>&nbsp;</td>
            <td><small>Fields mark with <span class="error">*</span> required</small></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="button" id="button" value="Submit"></td>
        </tr>
    </table>
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user['user_id']; ?>">
</form>
