<?php
$path = $this->router->fetch_class() . '/' . $this->router->fetch_method();
?>
<div class="">    
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'dashboard/index') ? 'active-btn' : ''; ?>"><a href="user/dashboard"><i class="fa fa-tachometer siz"></i><h3>Dashboard</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'customer/index') ? 'active-btn' : ''; ?>"><a href="customer"><i class="fa fa-user siz"></i><h3>Customer</h3></a></div></div>
    <?php if($this->aauth->isFranshisor()){ ?>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'invoice/index') || ($path == 'invoice/manual') || ($path == 'invoice/invoicedetail') ? 'active-btn' : ''; ?>"><a href="invoice"><i class="fa fa-gbp siz"></i><h3>Financial & Invoices</h3></a></div></div>
    <? } else { ?>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'invoiceuser/index') ? 'active-btn' : ''; ?>"><a href="invoiceuser/index"><i class="fa fa-gbp siz"></i><h3>Financial & Invoices</h3></a></div></div>
    <? } ?>
    <div class="col-bs-15 col-sm-2"><div class="men"><a href="calender/type"><i class="fa fa-university siz"></i><h3>Classrooms</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'survey/index') ? 'active-btn' : ''; ?>"><a href="survey"><i class="fa fa-leanpub siz"></i><h3>Survey</h3></a></div></div>

    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'virtcab/index') ? 'active-btn' : ''; ?>"><a href="virtcab"><i class="fa fa-desktop siz"></i><h3>Virtual Cabinet</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'dash/index') ? 'active-btn' : ''; ?>"><a href="calender"><i class="fa fa-calendar siz"></i><h3>Calender</h3></a></div></div>
    <?php
    clearDbThis($this);
    if ($this->aauth->isFranshisee()) {
        $link = pageFranchise(curUsrId());
        ?>
        <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'page/index') ? 'active-btn' : ''; ?>"><a href="cms/page/edit/<?= arrIndex($link, 'page_id'); ?>/2"><i class="fa fa-tachometer siz"></i><h3>Content</h3></a></div></div>
    <?php } else { ?>
        <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'page/index') ? 'active-btn' : ''; ?>"><a href="cms/page"><i class="fa fa-file-text-o siz"></i><h3>Content</h3></a></div></div>
    <?php } ?>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'marketing/index') ? 'active-btn' : ''; ?>"><a href="marketing"><i class="fa fa-bullseye siz"></i><h3>Marketing</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'forum/index') ? 'active-btn' : ''; ?>"><a href="forum"><i class="fa fa-comments siz"></i><h3>Forum</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'customer/index') ? 'active-btn' : ''; ?>"><a href="user"><i class="fa fa-user siz"></i><h3>Users</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'reports/franchisesTarget') ? 'active-btn' : ''; ?>"><a href="reports/franchisesTarget"><i class="fa fa-user siz"></i><h3>Franchises Target</h3></a></div></div>    
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'calender/venues') ? 'active-btn' : ''; ?>"><a href="calender/venues"><i class="fa fa-user siz"></i><h3>Mange Venues</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'settings/index') ? 'active-btn' : ''; ?>"><a href="setting/settings"><i class="fa fa-cog siz"></i><h3>Mange Settings</h3></a></div></div>    
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'settings/index') ? 'active-btn' : ''; ?>"><a href="frontend/sideEventsLinks"><i class="fa fa-cog siz"></i><h3>Side Links</h3></a></div></div>
</div>