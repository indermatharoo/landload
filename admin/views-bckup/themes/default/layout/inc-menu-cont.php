<?php
//echo current_url();
//$path = explode('/', current_url());
//$path = end($path);
$path = $this->router->fetch_class() . '/' . $this->router->fetch_method();
//echo $path;
?>
<div class="">    
    <?php if ($this->aauth->isFranshisee()) { ?>
        <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'dashboard') ? 'active-btn' : ''; ?>"><a href="user/dashboard"><i class="fa fa-tachometer siz"></i><h3>Dashboard</h3></a></div></div>
    <?php } else { ?>
        <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'dashboard') ? 'active-btn' : ''; ?>"><a href="user/dashboard"><i class="fa fa-tachometer siz"></i><h3>Dashboard</h3></a></div></div>
        <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'page/index' || $path == 'page/add' || $path == 'page/edit') ? 'active-btn' : ''; ?>"><a href="cms/page"><i class="fa fa-file-text-o siz"></i><h3>Page</h3></a></div></div>
        <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'news/index' || $path == 'news/add' || $path == 'news/edit') ? 'active-btn' : ''; ?>"><a href="news"><i class="fa fa-newspaper-o siz"></i><h3>News</h3></a></div></div>
        <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'globalblock/index' || $path == 'globalblock/add' || $path == 'globalblock/edit') ? 'active-btn' : ''; ?>"><a href="cms/globalblock"><i class="fa fa-th-large siz"></i><h3>Global Block</h3></a></div></div>
        <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'menu/index' || $path == 'menu/add' || $path == 'menu_item/index' || $path == 'menu_item/add' || $path == 'menu_item/edit') ? 'active-btn' : ''; ?>"><a href="cms/menu"><i class="fa fa-bars siz"></i><h3>Menu</h3></a></div></div>
                    <?php } ?>
</div>
