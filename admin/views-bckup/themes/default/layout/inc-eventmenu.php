<?php
$path = $this->router->fetch_class() . '/' . $this->router->fetch_method();
//print_r($path);
?>
<div class="">    
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'dashboard') ? 'active-btn' : ''; ?>"><a href="user/dashboard"><i class="fa fa-tachometer siz"></i><h3>Dashboard</h3></a></div></div>
    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'calender/index' || $path == 'calender/add' || $path == 'calender/edit' || $path == 'attendance/index') ? 'active-btn' : ''; ?>"><a href="calender"><i class="fa fa-calendar siz"></i><h3>Calender</h3></a></div></div>
    <?php if ($this->aauth->isFranshisor()): ?>
        <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'type/index' || $path == 'type/add' || $path == 'type/edit') ? 'active-btn' : ''; ?>"><a href="calender/type"><i class="fa fa-university siz"></i><h3>Class Room</h3></a></div></div>
    <?php endif; ?>

    <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'venues/index' || $path == 'venues/add' || $path == 'venues/edit') ? 'active-btn' : ''; ?>"><a href="calender/venues"><i class="fa fa-location-arrow siz"></i><h3>Venue</h3></a></div></div>
    <?php if (!$this->aauth->isFranshisor()): ?>
        <div class="col-bs-15 col-sm-2"><div class="men <?php echo ($path == 'bookings/index' || $path == 'bookings/add' || $path == 'bookings/edit') ? 'active-btn' : ''; ?>"><a href="calender/bookings"><i class="fa fa-inbox siz"></i><h3>Bookings</h3></a></div></div>
   <?php endif; ?>
</div>
