<h1 style="color: #006C86">Welcome <span style="text-transform: capitalize;"><?php echo $customer['username']; ?></span></h1>

<!--<div id="ctx_menu" class="corner4"><a href="customer/dashboard">My Account</a> | <a href="customer/logout">Logout</a></div>-->
<div class="corner4" id="ctx_menu">
    <a href="product">Place Orders</a> | <a href="customer/order">My Orders</a> | <a href="customer/dashboard/invoice">Invoices</a> | <a href="customer/dashboard/message">Messages</a> | <a href="customer/dashboard/loyaltypoints">Loyalty points</a>   | <a href="customer/logout">Logout</a>
	
</div>

<?php $this->load->view('inc-messages');
?>
Welcome to your customer area. Use above menu to navigate around.