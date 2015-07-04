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
                Order On
            </th>
            <th width="20%">
                Shipping Status
            </th>
            <th width="10%">
                Action
            </th>
        </tr>
        
        <?php 
//        
//        echo "<pre>";
//        print_r($orders);
//        exit;
        
        foreach ($orders as $k=>$v){ ?>
            
        <tr>
            <td><strong><?php  echo $v['id'] ?></strong></td>
            <td><?php echo date('d/m/Y', $v['date']);?> <br> <?php echo $v['time'];?></td>
            <?php 
            if($v['confirmed']==""){
                $status ='pending';
            }else{
                $status ='completed';
            }
            ?>
            <td><?php echo $status ;?></td>
            <td><a href="/customer/order/orderEdit/<?php echo $v['id'];?>">Edit</a>/<a href="#">View</a></td>
        </tr>
        <?php }  ?>
    </table>    
</div>