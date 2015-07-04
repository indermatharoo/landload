<div class="table">
    <table width="100%" border="0" cellpadding="2" cellspacing="0" class="grid">
        <tr style="background: #EBEBEB">
            <th width="20%">First Name</th>
            <th width="15%">Last Name</th>
            <th width="25%">Email</th>
            <th width="20%">Action</th>
        </tr>
        <?php
        foreach ($customers as $row) {
            ?>
            <tr class="<?php echo alternator('', 'alt') ?>">
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>                
                <td><?php echo $row['email']; ?></td>
                <td>
                    <a href="customer/customer/addedit/<?php echo $row['customer_id']; ?>">Edit</a>
                    | <a href="customer/customer/delete/<?php echo $row['customer_id'] ?>" 
                         onclick="return confirm('Are you sure you want to Delete this Customer?');">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>