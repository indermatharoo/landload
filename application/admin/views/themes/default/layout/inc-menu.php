<?php
//$path = $this->router->fetch_class() . '/' . $this->router->fetch_method();
$path = $this->router->fetch_class();
?>
<div class="menubar_right_container">    
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'dashboard') ? 'active-btn' : ''; ?>"><a href="user/dashboard"><i class="fa fa-tachometer siz"></i><h3>Dashboard</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'company') ? 'active-btn' : ''; ?>"><a href="company"><i class="fa fa-user siz"></i><h3>Company</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'customer') ? 'active-btn' : ''; ?>"><a href="customer"><i class="fa fa-user siz"></i><h3>Customer</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'virtcab') ? 'active-btn' : ''; ?>"><a href="virtcab"><i class="fa fa-desktop siz"></i><h3>Virtual Cabinet</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'properties') ? 'active-btn' : ''; ?>"><a href="properties"><i class="fa fa-desktop siz"></i><h3>Property</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'units') ? 'active-btn' : ''; ?>"><a href="units/index"><i class="fa fa-cog siz"></i><h3>Units</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'invoice/index') || ($path == 'invoice/manual') || ($path == 'invoice/invoicedetail') ? 'active-btn' : ''; ?>"><a href="invoice"><i class="fa fa-gbp siz"></i><h3>Invoices</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'applications/index') ? 'active-btn' : ''; ?>"><a href="applications/applications"><i class="fa fa-cog siz"></i><h3>Applications</h3></a></div></div>    

    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'settings') ? 'active-btn' : ''; ?>"><a href="setting/settings"><i class="fa fa-cog siz"></i><h3>Settings</h3></a></div></div>    
</div>
