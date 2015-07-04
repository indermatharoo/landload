<?php 

if(isset($_SESSION['C_REMAIN_STARS'])){
	$loyalty_points = $_SESSION['C_REMAIN_STARS'] ; 
}else{
   $loyalty_points = get_cust_stars();	
}
?>

<div id="" class="">You are having <?php echo $loyalty_points ;?> stars . </div>
<?php $this->load->view('inc-messages');?>
<h1>You can redeem following offers.</h1>
<div><?php
if (sizeof($alloffers)) {
    foreach ($alloffers as $m => $n) {

       //if ($n['order_value'] <= $cart_total) {
            ?>

                                        <a href="/cart/loyal/<?php echo $n['id']; ?>"><img class="" src="<?php echo base_url() . 'upload/products/' . $n['image'] ?>"  width="100"></a>
            <?php
       // }
    }
}
?></div>

