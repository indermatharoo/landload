<?php
//e($row);
?>
<div class="event-data col-lg-10" style="background: white;  padding: 10px; border-radius: 5px;">
    <div class="col-lg-12 close1" style="text-align: right; cursor: pointer">X</div>
    <div class="col-lg-6">
        <div class="col-lg-10 evnt-data">
            <h4 class="modal-title"><i class="fa fa-calendar"></i> Event <?= $row['event_title']; ?></h4>    
        </div>
        <div class="col-lg-12 padding-0 mar-bot10">
            <img class="col-lg-12" src="<?= $this->config->item('UPLOAD_URL_EVENTS') . $row['event_img']; ?>" class="img-responsive" />    
        </div>
        <div class="col-lg-10 padding-0 mar-bot10">
            <table class="table">
                <tr>
                    <td>Start :</td><td><?= date("d-m-Y h:m", strtotime($row['event_start_ts'])) ?></td>
                </tr>
                <tr>
                    <td>End :</td><td><?= date("d-m-Y h:m", strtotime($row['event_end_ts'])) ?></td>
                </tr>
                <tr>
                    <td>Description :</td><td><?= substr($row['description'], 0, 100); ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="col-lg-12 evnt-data">
            <h4 class="modal-title"><i class="fa fa-map-marker"></i> <?= $row['venue_name'] ?></h4>
        </div>
        <div class="col-lg-12 padding-0 mar-bot10">
            <img src="<?= $this->config->item('UPLOAD_URL_VENUES') . $row['venue_image']; ?>" class="img-responsive" />    
        </div>
        <div class="col-lg-12 padding-0 mar-bot10">
            <table class="table">
                <tr><td>Address :</td><td><?= $row['address'] ?>, <?= $row['city'] ?>, <?= $row['state'] ?>, <?= $row['country'] ?>, <?= $row['postcode'] ?></td></tr>
                <tr><td>email :</td><td><?= $row['email'] ?></td></tr>
                <tr><td>phone :</td><td><?= $row['phone'] ?></td></tr>
            </table>
        </div>
    </div>
    <div class="col-lg-12 padding-0">
        <a href="<?= base_url(); ?>contact/index/<?= $row['event_id'] ?>"><button class="btn btn-primary pull-right">Enquiry</button></a>
        <button class="btn btn-primary add_booking pull-right mar-right10" onclick="addtocart(<?= $row['event_id'] ?>)" >Book Now</button>

    </div>
</div>
<script type="text/javascript">
    $(function () {
        //        $('.qty').on('change', function () {
        //            var id = $(this).attr('pid'); //            var qty = $(this).val();
//            var price = $(this).attr('price');
        //            $('.price_' + id).html('$' + price * qty);
//        });



    });
</script>