<h1 style="color: #006C86">My Orders</h1>

<div class="corner4" id="ctx_menu">
    <a href="product">Place Orders</a> | <a href="customer/dashboard/myorder">My Orders</a> | <a href="customer/dashboard/invoice">Invoices</a> | <a href="customer/dashboard/message">Messages</a> | <a href="">Loyalty points</a>   | <a href="customer/logout">Logout</a>
</div>
<div class="col-lg-8 top-20">
    <table width="100%" cellpadding="3" cellspacing="0" border="0" class="o-detail table-responsive">
        <tr>
            <th width="50%">
                Order Detail
            </th>
            <th width="20%">
                Order For
            </th>
            <th width="20%">
                Order On
            </th>
            <th width="10%">
                Action
            </th>
			
			<th width="10%">
                Reorder
            </th>
        </tr>

        <?php
		
       
//        foreach ($orders as $o_k => $o_v) {
//            $date_array[date('d/m/Y', $o_v['date'])] = date('d/m/Y', $o_v['date']);
//        }

        //foreach ($date_array as $da => $dd_arr) {
            ?>

            <?php
            foreach ($orders as $k => $v) {

                //echo "<pre>";
                // print_r($v);
                // exit;
               // if ($da == date('d/m/Y', $v['date'])) {
                    ?>
        

                    <tr>
                        <td><img class="" src="<?php echo 'http://bmsdev.jaspersonline.co.uk/store/products/order_images/' . $v['jpid'] . '.jpg' ?>" width="100"></td>
                        
                        <td><?php echo date('d/m/Y', $v['date']); ?> <br> <?php echo $v['time']; ?></td>
                        <td><?php echo date('d/m/Y',$v['ordered']); ?></td>
                        <?php
//                        if ($v['confirmed'] == "") {
//                            $status = 'pending';
//                        } else {
//                            $status = 'completed';
//                        }
                        ?>
                        
                        <td><a href="/customer/order/orderEdit/<?php echo $v['id']; ?>">Edit</a>/<a >View</a></td>
						
						<td><a href="/customer/order/">Reorder</a></td>
                    </tr>
                <?php
                }
              ?>
    </table>    
</div>
<div class="col-lg-4 top-20">
    <img src="images/promotional.jpg" alt='Promotional Images' width="100%"/>
</div>