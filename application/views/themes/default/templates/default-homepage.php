<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <!-- BASICS -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>Online Property Management - Landlord Master</title>
        <?php
        $this->load->view("themes/" . THEME . "/headers/global.php");
        echo $CI->assets->renderHead();
        ?>

        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Google font file-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="js/ie-emulation-modes-warning.js"></script>

        <!-- skin -->
        <link rel="stylesheet" href="skin/default.css">
    </head>
    <body>
        <div class="full_topbar_container">
            <div class="container">
                <div class="row">
                    <div class="topbar_left_section">
                        <div class="col-md-6">
                            <ul class="list-unstyled list-inline">
                                <li> <a href="#"><i class="fa fa-phone"></i> 123 456 9878 </a> </li>
                                <li> <a href="#"><i class="fa fa-envelope-o "></i> email@domainname.com</a> </li>
                            </ul>
                        </div>
                    </div>

                    <div class="topbar_left_section text-right">
                        <div class="col-md-6">
                            <ul class="list-unstyled list-inline">
                                <li>Open 24 hrs 7 days a week  | </li> 
                                <li>Mon - Sat: 7.00 - 18.00 - Sunday: Closed</li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>


        <!-- Static navbar -->
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="logo_container">
                        <div class="logo">
                            <a href="#">
                                <img src="imgs/logo.png" class="img-responsive"/>
                            </a>
                        </div>
                    </div>
                </div>
                <div id="navbar" class="navbar-collapse collapse top_mymenu">

                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="#">Landlord Services </a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Why Rentify? </a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Our Properties <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Properties One</a></li>
                                <li><a href="#">Properties Two</a></li>
                                <li><a href="#">Properties Three</a></li>
                                <li><a href="#">Properties Four</a></li>
                                <li><a href="#">Properties Five</a></li>
                                <li><a href="#">Properties Six</a></li>

                            </ul>
                        </li>
                        <li><a href="#">Resources</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <!-- Bootstrap Slider -->

        <div id="carousel-example" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example" data-slide-to="1"></li>
                <li data-target="#carousel-example" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner">
                <div class="item active">
                    <a href="#"><img src="imgs/slider2.jpg" /></a>
                    <div class="carousel-caption">
                        <h3>Meow</h3>
                        <p>Just Kitten Around</p>
                    </div>
                </div>
                <div class="item">
                    <a href="#"><img src="imgs/slider1.jpg" /></a>
                    <div class="carousel-caption">
                        <h3>Meow</h3>
                        <p>Just Kitten Around</p>
                    </div>
                </div>
                <div class="item">
                    <a href="#"><img src="imgs/slider3.jpg"  /></a>
                    <div class="carousel-caption">
                        <h3>Meow</h3>
                        <p>Just Kitten Around</p>
                    </div>
                </div>
            </div>

            <a class="left carousel-control" href="#carousel-example" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>

        <div class="clearfix"></div>
        <!-- End Bootstrap Slider -->
        <div class="full_top_searchbar_container">
            <div class="property_searchbar_section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="property_searchbar_option">
                                <form role="form" class="navbar-form" id="signin">
                                    <div class="input-group">

                                        <div class="srch_heading_text"><h4 style="">Find Now</h4></div>

                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-gbp"></i></span>
                                        <input type="text" placeholder="Min Price" value="" name="email" class="form-control" id="email">                                        
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-gbp"></i></span>
                                        <input type="text" placeholder="Max Price" value="" name="email" class="form-control" id="email">                                        
                                    </div>


                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                        <input type="text" placeholder="Property Type " value="" name="email" class="form-control" id="email">                                        
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                        <input type="text" placeholder="Zipcode, Country" value="" name="password" class="form-control" id="password">                                        
                                    </div>

                                    <button class="btn btn-primary" type="submit"> Search <i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="clearfix"></div>

        <div class="full_middle_container">
            <div class="container">
                <div class="row">
                    <div class="middle_center_container">
                        <div class="property_heading_text">
                            <h2> Property List </h2>
                        </div>


                        <!-- Start First Column Line -->
                        <div class="col-md-3">
                            <div class="property_list_box">
                                <div class="view view-first property_img">
                                    <img src="imgs/property/prop01.png">
                                    <div class="mask">
                                        <h2>Property Name Here</h2>
                                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
                                        <p class="prop_price">     $1,599.000 </p>

                                        <a class="info" href="#">Read More</a>
                                    </div>
                                </div> 
                                <div class="property_text">
                                    <div class="col-md-9"> 
                                        <div class="property-city-name"><p>  United States</p></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="price-text-note"> <p>  $1,599.000 </p></div> 
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="col-md-9"> 
                                        <div class="property-text-name"><h4> Property Tittle Name</h4></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="buy-now-btn"> <a href="#" class="btn btn-primary">  Buy Now </a></div> 
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-3">
                            <div class="property_list_box">
                                <div class="view view-first property_img">
                                    <img src="imgs/property/prop01.png">
                                    <div class="mask">
                                        <h2>Property Name Here</h2>
                                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
                                        <p class="prop_price">     $1,599.000 </p>

                                        <a class="info" href="#">Read More</a>
                                    </div>
                                </div> 
                                <div class="property_text">
                                    <div class="col-md-9"> 
                                        <div class="property-city-name"><p>  United States</p></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="price-text-note"> <p>  $1,599.000 </p></div> 
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="col-md-9"> 
                                        <div class="property-text-name"><h4> Property Tittle Name</h4></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="buy-now-btn"> <a href="#" class="btn btn-primary">  Buy Now </a></div> 
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-3">
                            <div class="property_list_box">
                                <div class="view view-first property_img">
                                    <img src="imgs/property/prop01.png">
                                    <div class="mask">
                                        <h2>Property Name Here</h2>
                                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
                                        <p class="prop_price">     $1,599.000 </p>

                                        <a class="info" href="#">Read More</a>
                                    </div>
                                </div> 
                                <div class="property_text">
                                    <div class="col-md-9"> 
                                        <div class="property-city-name"><p>  United States</p></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="price-text-note"> <p>  $1,599.000 </p></div> 
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="col-md-9"> 
                                        <div class="property-text-name"><h4> Property Tittle Name</h4></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="buy-now-btn"> <a href="#" class="btn btn-primary">  Buy Now </a></div> 
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-3">
                            <div class="property_list_box">
                                <div class="view view-first property_img">
                                    <img src="imgs/property/prop01.png">
                                    <div class="mask">
                                        <h2>Property Name Here</h2>
                                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
                                        <p class="prop_price">     $1,599.000 </p>

                                        <a class="info" href="#">Read More</a>
                                    </div>
                                </div> 
                                <div class="property_text">
                                    <div class="col-md-9"> 
                                        <div class="property-city-name"><p>  United States</p></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="price-text-note"> <p>  $1,599.000 </p></div> 
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="col-md-9"> 
                                        <div class="property-text-name"><h4> Property Tittle Name</h4></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="buy-now-btn"> <a href="#" class="btn btn-primary">  Buy Now </a></div> 
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>



                        <!-- End First Column Line -->

                        <!-- Start First Column Line -->
                        <div class="col-md-3">
                            <div class="property_list_box">
                                <div class="view view-first property_img">
                                    <img src="imgs/property/prop01.png">
                                    <div class="mask">
                                        <h2>Property Name Here</h2>
                                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
                                        <p class="prop_price">     $1,599.000 </p>

                                        <a class="info" href="#">Read More</a>
                                    </div>
                                </div> 
                                <div class="property_text">
                                    <div class="col-md-9"> 
                                        <div class="property-city-name"><p>  United States</p></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="price-text-note"> <p>  $1,599.000 </p></div> 
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="col-md-9"> 
                                        <div class="property-text-name"><h4> Property Tittle Name</h4></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="buy-now-btn"> <a href="#" class="btn btn-primary">  Buy Now </a></div> 
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-3">
                            <div class="property_list_box">
                                <div class="view view-first property_img">
                                    <img src="imgs/property/prop01.png">
                                    <div class="mask">
                                        <h2>Property Name Here</h2>
                                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
                                        <p class="prop_price">     $1,599.000 </p>

                                        <a class="info" href="#">Read More</a>
                                    </div>
                                </div> 
                                <div class="property_text">
                                    <div class="col-md-9"> 
                                        <div class="property-city-name"><p>  United States</p></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="price-text-note"> <p>  $1,599.000 </p></div> 
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="col-md-9"> 
                                        <div class="property-text-name"><h4> Property Tittle Name</h4></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="buy-now-btn"> <a href="#" class="btn btn-primary">  Buy Now </a></div> 
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-3">
                            <div class="property_list_box">
                                <div class="view view-first property_img">
                                    <img src="imgs/property/prop01.png">
                                    <div class="mask">
                                        <h2>Property Name Here</h2>
                                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
                                        <p class="prop_price">     $1,599.000 </p>

                                        <a class="info" href="#">Read More</a>
                                    </div>
                                </div> 
                                <div class="property_text">
                                    <div class="col-md-9"> 
                                        <div class="property-city-name"><p>  United States</p></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="price-text-note"> <p>  $1,599.000 </p></div> 
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="col-md-9"> 
                                        <div class="property-text-name"><h4> Property Tittle Name</h4></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="buy-now-btn"> <a href="#" class="btn btn-primary">  Buy Now </a></div> 
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-3">
                            <div class="property_list_box">
                                <div class="view view-first property_img">
                                    <img src="imgs/property/prop01.png">
                                    <div class="mask">
                                        <h2>Property Name Here</h2>
                                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
                                        <p class="prop_price">     $1,599.000 </p>

                                        <a class="info" href="#">Read More</a>
                                    </div>
                                </div> 
                                <div class="property_text">
                                    <div class="col-md-9"> 
                                        <div class="property-city-name"><p>  United States</p></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="price-text-note"> <p>  $1,599.000 </p></div> 
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="col-md-9"> 
                                        <div class="property-text-name"><h4> Property Tittle Name</h4></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="buy-now-btn"> <a href="#" class="btn btn-primary">  Buy Now </a></div> 
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- End First Column Line -->



                    </div>
                </div>
            </div>


        </div> <!-- /container -->

        <div class="clearfix"></div>
        <!-- Start footer Section --> 
        <footer>
            <div class="full_footer_container">
                <div class="footer_container">
                    <div class="container">
                        <div class="row">
                            <div class="footer_middle_container">
                                <div class="col-md-6">
                                    <div class="footer_abut_left_section">
                                        <div class="footer_abt_heading">
                                            <h3><span class="text-white">About </span>Company</h3>
                                        </div>
                                        <div class="footer_abt_desc">
                                            <div class="footer_abt_imgleft">
                                                <div class="footer_about_img">
                                                    <a href="#"><img src="imgs/footer_abut_img.png"/></a>
                                                </div>
                                            </div>
                                            <div class="footer_abt_descright">
                                                <div class="fabt_desc_read">
                                                    <p>
                                                        Contrary to popular belief, Lorem Ipsum is not simply random
                                                        text. It has roots in a piece of classical Latin literature from 45 BC
                                                        making it over 2000 years old. Richard McClintock, a Latin professor
                                                        at Hampden-Sydney College in Virginia, looked up one of the more
                                                        obscure Latin words, consectetur, from a Lorem Ipsum passage, and
                                                        going through the cites of the word in classical literature
                                                    </p>
                                                </div>
                                                <div class="abt_footer_read_link text-right">
                                                    <a href="#" >Read More</a>  
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="popular_link_container">
                                        <div class="popular_link_list_section">
                                            <div class="popular_heading_text">
                                                <h3> Popular Links </h3>
                                            </div>
                                            <div class="popular_links_active_list">
                                                <ul class="footer_menu_links list-unstyled">
                                                    <li> <a href="#"> <i class="fa fa-arrow-circle-o-right"></i> Home</a></li>
                                                    <li> <a href="#"> <i class="fa fa-arrow-circle-o-right"></i> About Us</a></li>
                                                    <li> <a href="#"> <i class="fa fa-arrow-circle-o-right"></i> Our Services</a></li>
                                                    <li> <a href="#"> <i class="fa fa-arrow-circle-o-right"></i> Property List</a></li>
                                                    <li> <a href="#"> <i class="fa fa-arrow-circle-o-right"></i> How to use</a></li>
                                                    <li> <a href="#"> <i class="fa fa-arrow-circle-o-right"></i> Contact us</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- End Popular links-->

                                <div class="col-md-3">
                                    <div class="popular_link_container">
                                        <div class="popular_link_list_section">
                                            <div class="popular_heading_text">
                                                <h3> Features & Benefits </h3>
                                            </div>
                                            <div class="popular_links_active_list">
                                                <ul class="footer_menu_links list-unstyled">
                                                    <li> <a href="#"> <i class="fa fa-arrow-circle-o-right"></i> Product Overview</a></li>
                                                    <li> <a href="#"> <i class="fa fa-arrow-circle-o-right"></i> Pricing</a></li>
                                                    <li> <a href="#"> <i class="fa fa-arrow-circle-o-right"></i> Calculate Your Cost Savings</a></li>
                                                    <li> <a href="#"> <i class="fa fa-arrow-circle-o-right"></i> Case Studies & Testimonials</a></li>
                                                    <li> <a href="#"> <i class="fa fa-arrow-circle-o-right"></i> Top 10 Reasons to Choose</a></li>
                                                    <li> <a href="#"> <i class="fa fa-arrow-circle-o-right"></i> Property Manager</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- End Feature Products -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>


            <div class="full_footer_policy_links_container">
                <div class="footer_policy_links_section">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="footer_policy_links_left">
                                    <ul class="list-unstyled list-inline">
                                        <li> <a href="#"> Terms </a></li>
                                        <li> <a href="#"> Privacy policy  </a></li>
                                        <li> <a href="#"> Credit reference terms  </a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="footer_social_links_right">
                                    <ul class="list-unstyled list-inline text-right">
                                        <li> <a href="#"> <i class="fa fa-twitter-square"></i> </a></li>
                                        <li> <a href="#"> <i class="fa fa-linkedin-square"></i> </a></li>
                                        <li> <a href="#"> <i class="fa fa-google-plus-square"></i> </a></li>
                                        <li> <a href="#"> <i class="fa fa-facebook-square"></i> </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="full_footer_copyright_container">
                <div class="footer_copyright_section">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="copyrigt_text_leftside">
                                    <p>Copyright © 2011-2015 Landlord Master. all rights reserved</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="designed_by_text_rightside">
                                    <p class="text-right"><span class="text-gray">Designed By: </span>Multichannelcreative</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </footer>   

        <!-- End footer Section -->


        <!-- Custom styles for this template -->
        <link href="css/navbar.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

        <!-- Font Awesome Style Sheet  -->
        <link href="css/font-awesome.css" rel="stylesheet">
        <link href="css/font-css/font-awesome.min.css" rel="stylesheet">

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
        <!--<script src="js/bootstrap.min.js"></script>-->
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="js/ie10-viewport-bug-workaround.js"></script>

        <script>
            $('.carousel').carousel({
                interval: 3000
            })
        </script>
    </body>
</html>

