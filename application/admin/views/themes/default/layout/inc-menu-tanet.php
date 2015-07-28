<?php
//$path = $this->router->fetch_class() . '/' . $this->router->fetch_method();
$path = $this->router->fetch_class();
$action = $this->router->fetch_method();
//echo $path;
//echo $action;
//exit;
?>
<div class="menubar_right_container">    
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'dashboard') ? 'active-btn' : ''; ?>"><a href="user/dashboard"><i class="fa fa-tachometer siz"></i><h3>Dashboard</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'virtcab') ? 'active-btn' : ''; ?>"><a href="virtcab"><i class="fa fa-desktop siz"></i><h3>Virtual Cabinet</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'invoice') ? 'active-btn' : ''; ?>"><a href="invoice"><i class="fa fa-gbp siz"></i><h3>Invoices</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'applicants/message'  ) ? 'active-btn' : ''; ?>"><a href="applicants/message"><i class="fa fa-user siz"></i><h3>Communication</h3></a></div></div>    
</div>