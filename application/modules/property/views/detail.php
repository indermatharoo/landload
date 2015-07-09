<?php
//e($property);
?>
<div class="row">
    <div class="col-lg-8">
        <div class="col-lg-12 padding-0 unit-imgs" style="height: 300px;">
            <div id="carousel-example" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" style="height: 292px;">
                    <?php
                    $c = '';
                    foreach ($gallery as $slide) {
                        ++$c;
                        ?>
                        <div class="item <?php echo $c == 1 ? 'active' : ''; ?> ">
                            <img src="<?php echo $this->config->item('UNIT_IMAGE_URL') . $slide['image']; ?>" height="300px"/>
                        </div>
                    <?php } ?>
                </div>

                <a class="left carousel-control" href="#carousel-example" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>
        <div class="col-lg-12 padding-0 mar-top30">
            <div class="head_desc">
                <?php foreach ($property as $item)?>
                <h2><?php echo $item['unit_number']; ?></h2>
                <hr>
                <p style="font-size: 20px;"><b>Property Description</b></p>
                <p><?php echo $item['description']; ?></p>
            </div>
        </div>
        <?php // if ($attributes) { ?>
            <div class="col-lg-12 padding-0 mar-top20 mar-bot20">
                <div class="bas_detail">
                    <p style="font-size: 20px; color: #fff;"><b>Features</b></p>
                    <?php // foreach ($attributes as $feature) { ?>
                        <div class="col-sm-3">
                            <div class="attr-lab">Property Type</div>
                            <div class="attrb">Villa House</div>
                        </div>
                    <?php // } ?>
                    <div class="col-sm-3">
                        <div class="attr-lab">Property Type</div>
                        <div class="attrb">Villa House</div>
                    </div>
                    <div class="col-sm-3">
                        <div class="attr-lab">Property Type</div>
                        <div class="attrb">Villa House</div>
                    </div>
                    <div class="col-sm-3">
                        <div class="attr-lab">Property Type</div>
                        <div class="attrb">Villa House</div>
                    </div>
                    <div class="col-sm-3">
                        <div class="attr-lab">Property Type</div>
                        <div class="attrb">Villa House</div>
                    </div>
                    <div class="col-sm-3">
                        <div class="attr-lab">Property Type</div>
                        <div class="attrb">Villa House</div>
                    </div>
                    <div class="col-sm-3">
                        <div class="attr-lab">Property Type</div>
                        <div class="attrb">Villa House</div>
                    </div>
                    <div class="col-sm-3">
                        <div class="attr-lab">Property Type</div>
                        <div class="attrb">Villa House</div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        <?php // } ?>
       
    </div>
    <div class="col-lg-4" style="padding: 0 30px;">
        <div class="det-right">
            <div class="unit-inf">
                <div class="col-sm-10 lft"><i class="fa fa-home fa-2x hm"></i> <span>Villa For Sale</span></div>
                <div class="col-sm-2 padding-0 rgt"><img src="<?php echo base_url(); ?>imgs/sale.JPG" alt="sale" /></div>
                <div class="clearfix"></div>
            </div>
            <div class="unit-inf con-deta mar-top20">
                <div class="col-sm-10 lft">
                    <?php foreach ($property as $items) { ?>
                    <div><b>Listing ID : </b><i><?= $items['id']; ?></i></div>
                    <div><b>Bedroom : </b><i>5</i></div>
                    <div><b>Bathroom : </b><i>3</i></div>
                    <div><b>Build Up Area : </b><i>4500ft</i></div>
                    <br />
                    <div><b>City Name : </b><i><?= $items['city']; ?></i></div>
                    <div><b>Area Code : </b><i><?= $items['post_code']; ?></i></div>
                    <br />
                    <div style="font-size: 20px"><b><i class="fa fa-usd"></i>  <?= $items['amount']; ?></b></div>
                    <?php } ?>
                    <?php
                   $this->session->set_userdata('referred_from', current_url());
                   //e($this->session->all_userdata());
                   if ($this->session->userdata('applicant_id') != '') {
                       
                       $attributes = array('class' => 'apply', 'id' => 'myform', 'name' => 'myform');
                       echo form_open('property/apply', $attributes);
                       echo form_hidden('unit_id', $property['unit_id']);
                       echo form_hidden('property_id', $property['property_id']);
                       echo form_hidden('applicant_id', $this->session->userdata('applicant_id'));
                       
                       ?>
                        
                       <button name="" type="submit" class="btn btn-primary subbmint push-right">Apply</button>
                       <?php
                       echo form_close();
                       
                       
                   } else {
                       ?>
                       <button name="" onclick="window.location = '<?php echo base_url(); ?>customer/login'" type="button" class="btn btn-primary subbmint">Apply</button>
                       <?php
                   }
                   ?>
                </div>
                <div class="col-sm-2 rgt">
                    <div><a href=""><i class="fa fa-facebook-square fa-2x"></i></a></div>
                    <div><a href=""><i class="fa fa-twitter-square fa-2x"></i></a></div>
                    <div><a href=""><i class="fa fa-linkedin-square fa-2x"></i></a></div>
                    <div><a href=""><i class="fa fa-google-plus-square fa-2x"></i></a></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="unit-inf mar-top30">
                <div class="col-sm-12 lft"><span>Contact Us</span></div>
                <div class="col-sm-12 mar-top20">
                    <form action="contact" method="post">
                        <div class="col-sm-12">
                            <div class="form-group required-field-block">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" required=""/>
                                <div class="required-icon">
                                    <div class="text">*</div>
                                </div>
                            </div>
                            <div class="form-group required-field-block">
                                <input type="text" name="email" id="email" class="form-control" placeholder="Your Email Address" required=""/>
                                <div class="required-icon">
                                    <div class="text">*</div>
                                </div>
                            </div>
                            <div class="form-group required-field-block">
                                <input type="text" name="number" id="number" class="form-control" placeholder="Your Alternate Number" required=""/>
                                <div class="required-icon">
                                    <div class="text">*</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <select name="ptype" id="ptype" class="form-control">
                                    <option value="0">Select Property Type</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea name="message" id="message" class="form-control" placeholder="Your Message" rows="5"></textarea>
                            </div>
                            <div class="form-group push-right">
                                <input type="submit" name="submit" class="btn btn-black push-right"  value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<?php
//e($property);
?>
<div class="col-lg-6">
    <?php if (!empty($property)) { ?>
        <h1><?= $property['pname']; ?></h1>
        <?php echo $property['unit_number']; ?>

        <?php
        $this->session->set_userdata('referred_from', current_url());
        //e($this->session->all_userdata());
        if ($this->session->userdata('applicant_id') != '') {
            $attributes = array('class' => 'appy', 'id' => 'myform', 'name' => '');
            echo form_open('email/send', $attributes);
            ?>

            <button name="" type="submit" class="btn btn-primary subbmint">Apply</button>
            <?php
        } else {
            ?>
            <button name="" onclick="window.location = '<?php echo base_url(); ?>customer/login'" type="button" class="btn btn-primary subbmint">Apply</button>
            <?php
        }
        ?>

    <?php } ?>
</div>

<script>
//    $('.carousel').carousel({
//        interval: 3000
//    })
</script>
