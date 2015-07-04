<?php
$path = $this->router->fetch_class() . '/' . $this->router->fetch_method();
?>
<div class=""> 
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'dashboard/index') ? 'active-btn' : ''; ?>"><a href="customer/profile"><i class="fa fa-tachometer siz"></i><h3>My Account</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men"><a href="#mybooking"><i class="fa fa-tachometer siz"></i><h3>My Bookings</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'survey/index') ? 'active-btn' : ''; ?>"><a href="survey"><i class="fa fa-tachometer siz"></i><h3>Survey</h3></a></div></div>    
</div>