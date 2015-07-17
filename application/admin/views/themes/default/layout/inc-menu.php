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
    <?php
    if ($this->aauth->isAdmin()) {
        ?>
        <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'company') ? 'active-btn' : ''; ?>"><a href="company"><i class="fa fa-user siz"></i><h3>Company</h3></a></div></div>
    <?php } ?>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'applicants') ? 'active-btn' : ''; ?>"><a href="applicants"><i class="fa fa-user siz"></i><h3>Applicant</h3></a></div></div>

    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'virtcab') ? 'active-btn' : ''; ?>"><a href="virtcab"><i class="fa fa-desktop siz"></i><h3>Virtual Cabinet</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'properties') ? 'active-btn' : ''; ?>"><a href="properties"><i class="fa fa-building siz"></i><h3>Property</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'units') ? 'active-btn' : ''; ?>"><a href="units/index"><i class="fa fa-home siz"></i><h3>Units</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'invoice/index') || ($path == 'invoice/manual') || ($path == 'invoice/invoicedetail') ? 'active-btn' : ''; ?>"><a href="invoice"><i class="fa fa-gbp siz"></i><h3>Invoices</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'applications') || ($path == 'applications/add') || ($path == 'applications/edit') ? 'active-btn' : ''; ?>"><a href="applications/applications"><i class="fa fa-file-text siz"></i><h3>Applications</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'reports') ? 'active-btn' : ''; ?>"><a href="reports"><i class="fa fa-file-excel-o siz"></i><h3>Reports</h3></a></div></div>
    <?php if ($this->aauth->isAdmin() || $this->aauth->isCompany()): ?>
        <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'user') ? 'active-btn' : ''; ?>"><a href="user/index"><i class="fa fa-file-excel-o siz"></i><h3>Users</h3></a></div></div>    
    <?php endif; ?>
    <?php if ($this->aauth->isAdmin()): ?>
        <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'page') || ($path == 'applications/add') || ($path == 'applications/edit') ? 'active-btn' : ''; ?>"><a href="cms/page"><i class="fa fa-connectdevelop siz"></i><h3>Content</h3></a></div></div>    
        <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'attributes') ? 'active-btn' : ''; ?>"><a href="units/attributes"><i class="fa fa-pie-chart siz"></i><h3>Attributes</h3></a></div></div>    
        <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'settings') ? 'active-btn' : ''; ?>"><a href="setting/settings"><i class="fa fa-cog siz"></i><h3>Settings</h3></a></div></div>
                    <?php endif; ?>
</div>
