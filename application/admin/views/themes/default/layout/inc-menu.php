<?php
$path = $this->router->fetch_class() . '/' . $this->router->fetch_method();
//echo $path;
?>
<div class="menubar_right_container">    
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'dashboard/index') ? 'active-btn' : ''; ?>"><a href="user/dashboard"><i class="fa fa-tachometer siz"></i><h3>Dashboard</h3></a></div></div>
     <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'company/index') ? 'active-btn' : ''; ?>"><a href="company"><i class="fa fa-user siz"></i><h3>Company</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'customer/index') ? 'active-btn' : ''; ?>"><a href="customer"><i class="fa fa-user siz"></i><h3>Customer</h3></a></div></div>
    <?php /*if ($this->aauth->isFranshisor()) { ?>
        <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'invoice/index') || ($path == 'invoice/manual') || ($path == 'invoice/invoicedetail') ? 'active-btn' : ''; ?>"><a href="invoice"><i class="fa fa-gbp siz"></i><h3>Invoices</h3></a></div></div>
    <?php } else { ?>
        <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'invoiceuser/index') ? 'active-btn' : ''; ?>"><a href="invoiceuser/index"><i class="fa fa-gbp siz"></i><h3>Invoices</h3></a></div></div>
    <?php }*/ ?>
<!--    <div class="col-bs-15 col-sm-2"><div class="men"><a href="calender/type"><i class="fa fa-university siz"></i><h3>Classrooms</h3></a></div></div>-->
<!--    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'survey/index') || ($path == 'survey/getReport') ? 'active-btn' : ''; ?>"><a href="survey"><i class="fa fa-leanpub siz"></i><h3>Survey</h3></a></div></div>-->

    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'virtcab/index') ? 'active-btn' : ''; ?>"><a href="virtcab"><i class="fa fa-desktop siz"></i><h3>Virtual Cabinet</h3></a></div></div>
<!--    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'dash/index') ? 'active-btn' : ''; ?>"><a href="calender"><i class="fa fa-calendar siz"></i><h3>Calender</h3></a></div></div>-->
    <?php
    clearDbThis($this);
    if ($this->aauth->isFranshisee()) {
        $link = pageFranchise(curUsrId());
        ?>
        <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'page/index') ? 'active-btn' : ''; ?>"><a href="cms/page/edit/<?= arrIndex($link, 'page_id'); ?>/2"><i class="fa fa-tachometer siz"></i><h3>Content</h3></a></div></div>
        <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'invoice/index') || ($path == 'invoice/manual') || ($path == 'invoice/invoicedetail') ? 'active-btn' : ''; ?>"><a href="invoice"><i class="fa fa-gbp siz"></i><h3>Invoices</h3></a></div></div>
    <?php } else { ?>
<!--        <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'page/index') ? 'active-btn' : ''; ?>"><a href="cms/page"><i class="fa fa-file-text-o siz"></i><h3>Content</h3></a></div></div>-->
    <?php } ?>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'settings/index') ? 'active-btn' : ''; ?>"><a href="setting/settings"><i class="fa fa-cog siz"></i><h3>Settings</h3></a></div></div>    

</div>
