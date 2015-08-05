<?php foreach ($property as $row) { ?>
    <div class="col-md-3 col-sm-6">
                        <div class="property_list_box">
                            <div class="view view-first property_img">
                                <img src="imgs/property/property-01.jpg">
                                <div class="mask">
                                    <h2><?php echo arrIndex($row, 'unit_number') ?></h2>
                                    <p><?php echo arrIndex($row, 'description')?></p>
                                    <p class="prop_price">     $<?php echo arrIndex($row, 'amount')?> </p>
                                    
                                    
                                    <a class="info" href="property/detail/<?= arrIndex($row, 'unit_id') ?>">Read More</a>                                    
                                </div>
                            </div> 
                            <div class="clearfix"></div>
                            
                            <div class="property_text">
                                <div class="read-btn-left"> 
                                    <div class="property-city-name"><p>  <span class="text-gold"> <?= $row['county'] ?>, </span> <?= $row['country'] ?> </p></div>
                                </div>
                                <div class="read-btn-right">
                                    <div class="buy-now-btn"> 
                                    <a class="info btn btn-primarybtn btn-primary" href="property/detail/<?= arrIndex($row, 'unit_id') ?>">Read More</a>
                                    </div> 
                                </div>
                                <div class="clearfix"></div>
                                
                                <div class="col-md-12"> 
                                    <ul class="list-unstyled list-inline property-list-format">
                                        <li><a href="#"> <i class="fa fa fa-map-marker"></i> <?= arrIndex($row, 'property_type') ?></a></li>
<!--                                        <li><a href="#"> <i class="fa fa-map-marker"></i> 3BKH Room</a></li>-->
                                        <li><a href="#"> <i class="fa fa-map-marker"></i> For Sale</a></li>
                                    </ul>
                                    <!--<div class="property-text-name"><h4> Property Tittle Name</h4></div>-->
                                </div>
                                <!--div class="col-md-3">
                                    <div class="price-text-note"> <p>  $1,599.000 </p></div> 
                                </div>-->
                                <div class="clearfix"></div>
                                <div class="property-contact-info">
                                    <div class="read-btn-left"> 
<!--                                        <div class="property-agent-name"><p>   Agent Name </p></div>-->
                                    </div>
                                    <div class="read-btn-right"> 
                                        <div class="property-company-name"><p>   <?= arrIndex($row, 'company_id') ?> </p></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
<?php } ?>