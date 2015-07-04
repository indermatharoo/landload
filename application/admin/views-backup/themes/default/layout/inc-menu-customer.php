<?php
//echo current_url();
//$path = explode('/', current_url());
//$path = end($path);
$path = $this->router->fetch_class().'/'.$this->router->fetch_method();
//echo $path;
?>
<div class="clearfix">    
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'dashboard') ? 'active-btn' : ''; ?>"><a href="user/dashboard"><i class="fa fa-tachometer siz"></i><h3>Dashboard</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'customer/index' || $path == 'customer/addedit') ? 'active-btn' : ''; ?>"><a href="customer"><i class="fa fa-user siz"></i><h3>Customer</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'user/index' || $path == 'user/add' || $path == 'user/edit' ) ? 'active-btn' : ''; ?>"><a href="user"><i class="fa fa-user siz"></i><h3>User</h3></a></div></div>
</div>