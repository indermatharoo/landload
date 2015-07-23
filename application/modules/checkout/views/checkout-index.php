<div class="col-lg-12" style="background: white; border-radius: 5px;">
    <div class=" page-header mar-top15">
        <h2>Ticket Booking</h2>
    </div>
    <div class="row">
        <?php $this->load->view('inc-messages'); ?>
        <form id="cartFrm" name="cartFrm" method="post" action="<?= base_url(); ?>booking/cart/update">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Booking</th>
                        <th>Ticket</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->cart->contents() as $item) {
                        $options = '';
                        if ($this->cart->has_options($item['rowid'])) {
                            $options = $this->cart->product_options($item['rowid']);
                        }
                        ?>
                        <tr>
                            <td class="col-sm-4 col-md-4">
                                <div class="media">
                                    <a class="thumbnail pull-left" href="#"> 
                                        <img class="media-object" src="<?php
                                        echo arrIndex($item,'image') ? resize($this->config->item('UPLOAD_URL_EVENTS') . $item['image'], 100, 75, 'event_img') : '' ; 
                                        ?>" > 
                                    </a>
                                    <div class="media-body">
                                        <h3 class="media-heading"><a href="#"><?php echo $item['name']; ?></a></h3>
                                        <!--<h5 class="media-heading"> by <a href="#">Brand name</a></h5>-->
                                    </div>
                                </div>
                            </td>
                            <td class="col-sm-2 col-md-2" style="text-align: center">
                                <input name="quantity[]" type="number" min=1  class="form-control" id="quantity" value="<?php echo $item['qty']; ?>"  >
                            </td>
                            <td class="col-sm-1 col-md-1 text-center"><strong><?php echo DWS_CURRENCY_SYMBOL; ?><?php echo $item['price']; ?></strong></td>
                            <td class="col-sm-1 col-md-1 text-center"><strong><?php echo DWS_CURRENCY_SYMBOL; ?><?php echo $this->cart->format_number($item['price'] * $item['qty']); ?></strong></td>

                            <td class="col-sm-1 col-md-1"><a href="<?= base_url() ?>booking/cart/delete/<?php echo $item['rowid']; ?>" onclick="return confirm('Are you sure you want to remove this item?');"><button type="button" class="btn btn-danger">
                                        <span class="fa fa-remove "></span> Remove
                                    </button> </a></td>
                    <input name="key[]" type="hidden" id="key" value="<?php echo $item['rowid']; ?>" size="10">
                    <input name="product_id[]" type="hidden" id="product_id" value="<?php echo $item['id']; ?>" size="10">
                    </tr>
                <?php } ?>
                <tr><td colspan="3"></td><td><h5>Subtotal</h5></td>
                    <td class="text-right"><h5><strong><?php echo DWS_CURRENCY_SYMBOL . $this->cart->format_number($cart_total); ?></strong></h5></td>
                </tr>
                <tr><td colspan="3"></td><td><h3>Total</h3></td>
                    <td class="text-right"><h3><strong><?php echo DWS_CURRENCY_SYMBOL . $this->cart->format_number($order_total); ?></strong></h3></td>
                </tr>
                <tr><td colspan="3"></td><td><button type="submit" class="btn btn-success"> Update Booking </button></td>
                    <td><a href="<?= base_url(); ?>checkout/process"><button type="button" class="btn btn-success">Pay Now</button></a></td>
                </tr>
                </tbody>
            </table>
        </form>
        <?php if ($this->cart->total_items() == 0) { ?>
            <p align="center" style="padding-top:20px; padding-bottom:20px; color: #CC0000"><strong>Your Booking is currently empty!</strong></p>
            <?php
            return;
        }
        ?>
    </div>
</div>
<!--<div class="col-lg-4" style="background: white; border-radius: 5px;">
    
</div>-->

