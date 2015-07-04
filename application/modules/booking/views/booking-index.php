<!--<div class="col-lg-12" style="background: white; padding: 10px 10px 50px 10px; border-radius: 5px;">-->
    <div class="col-lg-6">
        <h2>
            <?= $event['event_title']; ?>
            <span class="pull-right">Date: <?= $event['event_start_ts']; ?></span>
        </h2>
        <?php
        //// foreach ($price as $row) {
//     print_r($row);
//     exit;
        ?>
        <div class="form-group">
            <div class="col-xs-5"><?= $price['title'] . '($' . $price['price'] . ')'; ?></div>
            <div class="col-xs-4"><input type="number" class="qty form-control" pid="<?= $price['prices_id'] ?>" price="<?= $price['price'] ?>" placeholder="Qty" min="0"/></div>
            <div class="col-xs-3 price_<?= $price['prices_id'] ?>">$0.00</div>
        </div>
        <?php // } ?>
        <div class="clearfix"></div>
        <div class="booking-msg"></div>
        <button class="btn btn-primary add_booking" event_id="<?= $price['event_id'] ?>"><a href=""></a>Book Now</button>
    </div> 
    <?php if (!empty($event['terms'])) { ?>
        <div class="col-lg-6">
            <?= $event['terms']; ?>
        </div>
    <?php } ?>
</div>
<script type="text/javascript">
    $(function () {
        $('.qty').on('change', function () {
            var id = $(this).attr('pid');
            var qty = $(this).val();
            var price = $(this).attr('price');
            $('.price_' + id).html('$' + price * qty);
        });

        $('.add_booking').click(function () {
            var event_id = $(this).attr('event_id');
            var qty = $('.qty').val();
            if (qty > 0) {
                $.post('<?= base_url(); ?>booking/cart/add', {eid: event_id, qty: qty}, function (data) {
                    window.location = "<?= base_url(); ?>checkout";
                });
                $('.booking-msg').hide();
            } else {
                $('.booking-msg').html('Please add qty');
            }

        });

    });
</script>