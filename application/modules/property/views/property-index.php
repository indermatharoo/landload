<?php foreach ($property as $row) { ?>
    <div class="col-md-3">
        <div class="property_list_box">
            <div class="view view-first property_img">

                <img src="<?= $this->config->item('UNIT_IMAGE_URL') . $row['unit_image'] ?>">
                <div class="mask">
                    <h2><?= $row['pname'] ?></h2>
                    <p><?php echo substr($row['description'], 0, 50) . ".."; ?></p>
                    <p class="prop_price"><?= DWS_CURRENCY_SYMBOL . $row['amount'] ?></p>

                    <a class="info" href="property/detail/<?= $row['unit_id'] ?>">Read More</a>
                </div>
            </div> 
            <div class="property_text">
                <div class="col-md-9"> 
                    <div class="property-city-name"><p>United States</p></div>
                </div>
                <div class="col-md-3">
                    <div class="price-text-note"> <p><?= DWS_CURRENCY_SYMBOL . $row['amount'] ?></p></div> 
                </div>
                <div class="clearfix"></div>

                <div class="col-md-9"> 
                    <div class="property-text-name"><h4><?= $row['unit_number'] ?></h4></div>
                </div>
                <div class="col-md-3">
                    <div class="buy-now-btn"> <a href="#" class="btn btn-primary">  Buy Now </a></div> 
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
<?php } ?>