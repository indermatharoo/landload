<div class="row">
    <div class="col-lg-8">
        <div class="col-lg-12 padding-0 unit-imgs">
            <div id="carousel-example" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="<?php echo base_url() ?>imgs/slider1.jpg" alt="" />
                    </div>
                    <div class="item">
                        <img src="<?php echo base_url() ?>imgs/slider2.jpg" alt="" />
                    </div>
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
                <h2><?php echo $property['unit_number']; ?></h2>
                <hr>
                <p style="font-size: 20px;"><b>Property Description</b></p>
                <p><?php echo $property['description']; ?></p>
            </div>
        </div>
        <div class="col-lg-12 padding-0 mar-top20">
            <div class="bas_detail">
                <p style="font-size: 20px; color: #fff;"><b>Basic Details</b></p>
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
                <div class="col-sm-3">
                    <div class="attr-lab">Property Type</div>
                    <div class="attrb">Villa House</div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
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
                    <div><b>Listing ID : </b><i>1008</i></div>
                    <div><b>Bedroom : </b><i>5</i></div>
                    <div><b>Bathroom : </b><i>3</i></div>
                    <div><b>Build Up Area : </b><i>4500ft</i></div>
                    <br />
                    <div><b>City Name : </b><i>New York</i></div>
                    <div><b>Area Code : </b><i>4598 dc</i></div>
                    <br />
                    <div style="font-size: 20px"><b><i class="fa fa-usd"></i>  300</b></div>
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
                            <div class="form-group">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <input type="text" name="email" id="email" class="form-control" placeholder="Your Email Address"/>
                            </div>
                            <div class="form-group">
                                <input type="text" name="number" id="number" class="form-control" placeholder="Your Alternate Number"/>
                            </div>
                            <div class="form-group">
                                <select name="ptype" id="ptype" class="form-control">
                                    <option value="0">Select Property Type</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea name="message" id="message" class="form-control" placeholder="Your Message" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-black right"  value="Submit">
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
