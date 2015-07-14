<div class="full_top_searchbar_container">
    <div class="property_searchbar_section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="property_searchbar_option">
                        <form role="form" class="navbar-form" id="signin" method="post">
                            <!--                            <div class="input-group">
                                                            <div class="srch_heading_text"><h4 style="">Find Now</h4></div>
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                                                            <input type="text" placeholder="Min Price" value="" name="email" class="form-control" id="email">                                        
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                                                            <input type="text" placeholder="Max Price" value="" name="email" class="form-control" id="email">                                        
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                                            <input type="text" placeholder="Property Type " value="" name="email" class="form-control" id="email">                                        
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                                            <input type="text" placeholder="Zipcode, Country" value="" name="password" class="form-control" id="password">                                        
                                                        </div>-->
                            <?php foreach (getAttributes() as $attribute): ?>
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input type="text" placeholder="<?php echo ucfirst(arrIndex($attribute, 'label')); ?>" value="" name="attributes[<?php echo arrIndex($attribute, 'id') ?>]" class="form-control">
                                </div>
                            <?php endforeach; ?>

                            <button class="btn btn-primary" type="submit"> Search <i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>