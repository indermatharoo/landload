<div class="full_middle_container">
        <div class="container">
        <div class="middle_center_container">
            <div class="row">
                <div class="property_top_heading_flag_container text-center">
                    <img src="imgs/icons/flag-icon.png">
                </div>
                <div class="property_heading_text">
                    <h2> Property List </h2>
                </div>
            </div>
            <div class="clearfix"></div>
            
           
        </div>
      </div>

    </div>


<div class="property_full_container">
        <div class="container">
         <div class="property_mid_section">
                <div class="row">        
                <!-- Start First Column Line -->
 <?php if (!count($property)): ?>
                                <div class="col-lg-12">
                                    No Property Found..
                                </div>
                            <?php endif; ?>
                            <?php foreach ($property as $row) { ?>
                                <?php
                           
                                
                                ?>
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
<!--                                <div class="col-md-3">
                                    <div class="property_list_box">
                                        <div class="view view-first property_img">

                                            <img src="timthumb.php?src=<?php echo $this->config->item('UNIT_IMAGE_URL') . $row['unit_image'] ?>&h=275&w=275&q=100&zc=0" class="img-responsive">
                                            <div class="mask">
                                                <h2><?= substr($row['unit_number'],0,25) ?></h2>
                                                <p><?php echo substr($row['description'], 0, 50) . ".."; ?></p>
                                                <p class="prop_price"><?= DWS_CURRENCY_SYMBOL . $row['amount'] ?></p>

                                                <a class="info" href="property/detail/<?= $row['unit_id'] ?>">View</a>
                                            </div>
                                        </div> 
                                        <div class="property_text">
                                            <div class="col-md-9"> 
                                                <div class="property-city-name"><p><?= $row['city'] ?> </p></div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="price-text-note"> <p><?= DWS_CURRENCY_SYMBOL . $row['amount'] ?></p></div> 
                                            </div>
                                            <div class="clearfix"></div>

                                            <div class="col-md-9"> 
                                                <div class="property-text-name"><h4><?= $row['unit_number'] ?></h4></div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="buy-now-btn"> <a href="property/detail/<?= $row['unit_id'] ?>" class="btn btn-primary">  Apply </a></div> 
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>-->
                            <?php //e($row);
                            } ?>                
                <div class="col-md-3 col-sm-6">
                        <div class="property_list_box">
                            <div class="view view-first property_img">
                                <img src="imgs/property/property-01.jpg">
                                <div class="mask">
                                    <h2>Property Name Here</h2>
                                    <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
                                    <p class="prop_price">     $1,599.000 </p>
                                    
                                    <a href="#" class="info">Read More</a>
                                </div>
                            </div> 
                            <div class="clearfix"></div>
                            
                            <div class="property_text">
                                <div class="read-btn-left"> 
                                    <div class="property-city-name"><p>  <span class="text-gold"> London, </span> UK </p></div>
                                </div>
                                <div class="read-btn-right">
                                    <div class="buy-now-btn"> <a class="btn btn-primary" href="#">  Read More </a></div> 
                                </div>
                                <div class="clearfix"></div>
                                
                                <div class="col-md-12"> 
                                    <ul class="list-unstyled list-inline property-list-format">
                                        <li><a href="#"> <i class="fa fa fa-map-marker"></i> Residential</a></li>
                                        <li><a href="#"> <i class="fa fa-map-marker"></i> 3BKH Room</a></li>
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
                                        <div class="property-agent-name"><p>   Agent Name </p></div>
                                    </div>
                                    <div class="read-btn-right"> 
                                        <div class="property-company-name"><p>   Company Name </p></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    
                
                
                
                
                
                
                
                
                
                
                 
                   <!-- End First Column Line -->
                     
                </div>
            </div>
        </div><!-- container /-->
    </div>


<div class="full-view-all-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="view-all-property">
                        <div class="property_heading_text btn-view-all">
                            <a href="property/">
                                <h4> View All </h4>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="clearfix"></div>