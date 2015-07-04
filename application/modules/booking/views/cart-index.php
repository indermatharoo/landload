<div class="col-lg-12">
    <h1>Booking</h1>
    <?php
    $this->load->view('inc-messages');
    if ($this->cart->total_items() == 0) {
        echo '<p>Empty.</p>';
        return;
    }
    ?>

    <div class="col-lg-12">
        <form id="cartFrm" name="cartFrm" method="post" action="<?= base_url(); ?>booking/cart/update">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="cart_grid">
                <tr>
                    <th></th>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
                <?php
                foreach ($this->cart->contents() as $item) {
                    $options = '';
                    if ($this->cart->has_options($item['rowid'])) {
                        $options = $this->cart->product_options($item['rowid']);
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td><?php echo $item['name'] ?>
                            <?php if ($options) {
                                ?> (
                                <?php foreach ($options as $key => $val) {
                                    ?>
                                    <?php if ($key) { ?>

                                        <span class="lg_text"><b><?php echo $key; ?>:</b> </span> <?php echo $val; ?> 
                                        <?php
                                    }
                                }
                                ?> )
                            <?php } ?>
                        </td>
                        <td><input name="quantity[]" type="text" class="qtn_textfield iqty" id="quantity" value="<?php echo $item['qty']; ?>" size="3"></td>
                        <td><?php echo DWS_CURRENCY_SYMBOL; ?><?php echo $this->cart->format_number($item['price']); ?></td>
                        <td><?php echo DWS_CURRENCY_SYMBOL; ?><?php echo $this->cart->format_number($item['price'] * $item['qty']); ?></td>
                        <td><a href="cart/delete/<?php echo $item['rowid']; ?>" onclick="return confirm('Are you sure you want to remove this item?');">Delete </a></td> 
                    <input name="key[]" type="hidden" id="key" value="<?php echo $item['rowid']; ?>" size="10">
                    <input name="product_id[]" type="hidden" id="product_id" value="<?php echo $item['id']; ?>" size="10">
                    <input name="price[]" type="hidden" id="price" value="<?php echo $item['price']; ?>" size="10">
                    </tr>
                <?php } ?>
            </table>
            <div class="update_button"><input type="submit" value="update"></div>
        </form>
    </div>
    <div class="col-lg-12">

        <div id="code_total">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
<!--                <tr>
                    <th>Booking Total:</th>
        <td width="24%"><?php // echo DWS_CURRENCY_SYMBOL;   ?> <?php // echo $this->cart->format_number($cart_total);   ?></td> 
                </tr>-->
                <tr>
                    <th>Booking Total:</th>
                    <td><strong><?php echo DWS_CURRENCY_SYMBOL; ?> <?php echo $this->cart->format_number($order_total); ?></strong></td>
                </tr>
            </table>
            <a href="<?=  base_url()?>checkout" ><button  class="checkout">PROCEED TO PAYMENT</button></a>
        </div>

    </div>

</div>
