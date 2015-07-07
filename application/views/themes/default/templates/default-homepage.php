<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <!-- BASICS -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Landlord Masters</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        $this->load->view("themes/" . THEME . "/headers/global.php");
        echo $CI->assets->renderHead();
        ?>

        <!-- skin -->
        <link rel="stylesheet" href="skin/default.css">
    </head>
    <body>
        <?php $this->load->view("themes/" . THEME . "/layout/inc-header"); ?>
        <section class="featured">
            <div class="container"> 
                <a href="franchisee" class="pull-right map1"><img src="images/map1.png" alt="" width="110px"/></a>
                <div class="row mar-bot40 serch">
                    <div class="" style="width: 350px; float: right;">
                        <div class="search-postcode">
                            <h3>FIND YOUR NEAREST CREATION STATION</h3>
                            <p>Pop enter your postcode or town name in here to find your nearest inspiring Creation Station leader</p>
                            <form method="post" action="<?= base_url(); ?>franchisee/index">
                                <input type="text" name='p' placeholder="Town name / postcode here.." class="search"><input type='submit' value="Go!" class="btn go">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- section works -->
        <section id="section-works" class="section appear clearfix padding-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-offset-3 col-lg-6 col-sm-12 col-xs-12 center ">
<!--                        <img src="images/with-us.png" alt="Create With Us" class="img-responsive"/>-->
                        <div class="cwu">
                            <h1>INSPIRE IMAGINATIONS & NATURE POTENTIAL</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-offset-2 col-lg-8">
                        <div class= "want-to-inspire">Do you want to inspire your child’s imagination, nature their potential and have fun? You've come to the right place. Scrolls down to discover award winning creative fun. </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="cacc">
                            <h1>CHILDREN'S ART & CRAFT CLASSES</h1>
                            <p>from 6 months to 11 years</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="portfolio-items isotopeWrapper clearfix" id="3">

                                <article class="col-md-4 isotopeItem webdesign center">
                                    <div class="portfolio-item">                                        
                                        <?php echo ($baby_discover ); ?>
                                    </div>
                                </article>

                                <article class="col-md-4 isotopeItem webdesign center">
                                    <div class="portfolio-item">
                                        <?php echo ($little_explorer ); ?>
                                    </div>
                                </article>
                                <article class="col-md-4 isotopeItem webdesign center">
                                    <div class="portfolio-item">
                                        <?php echo ($family_adventure ); ?>
                                    </div>
                                </article>
                                <article class="col-md-offset-2 col-md-8 col-sm-12 col-xs-12 isotopeItem webdesign center">
                                    <div class="portfolio-item las">
                                        <h1 style="color: #DA0001">JUST LOOKING FOR FUN</h1>
                                        <p><a href="" class="create">Create</a></p>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="section-cparties" class="section appear clearfix padding-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-offset-2 col-lg-8 col-sm-12 col-xs-12 center ">
                        <div class="heading-bg">
                            <h1>ENJOY CREATIVE PARTIES, OUT OF SCHOOL CLUBS AND EVENTS</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="portfolio-items isotopeWrapper clearfix" id="3">

                                <article class="col-md-4 isotopeItem webdesign center">
                                    <div class="portfolio-item">                                        
                                        <?php echo ($birthday_parties ); ?>
                                    </div>
                                </article>

                                <article class="col-md-4 isotopeItem webdesign center">
                                    <div class="portfolio-item">
                                        <?php echo ($baby_discover2 ); ?>
                                    </div>
                                </article>
                                <article class="col-md-4 isotopeItem webdesign center">
                                    <div class="portfolio-item">
                                        <?php echo ($events ); ?>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="section-pro-gift" class="section appear clearfix padding-0">
            <div class="parda"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-offset-2 col-lg-8 col-sm-12 col-xs-12 center ">
                        <div class="heading-bg">
                            <h1>Looking for a great art and craft  products or gifts?</h1>
                        </div>
                    </div>
                </div>
                <div class="row mar-top40">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="portfolio-items isotopeWrapper clearfix" id="3">
                                <article class="col-md-4 col-sm-12 isotopeItem webdesign center">
                                    <div class="portfolio-item">
                                        <?php echo ($visit_our_store ); ?>
                                    </div>
                                </article>
                                <article class="col-md-4 col-sm-12 isotopeItem webdesign center">
                                    <div class="portfolio-item">
                                        <?php echo ($give_the_gift ); ?>
                                    </div>
                                </article>
                                <article class="col-md-4 col-sm-12 isotopeItem webdesign center">
                                    <div class="portfolio-item">
                                        <?php echo ($check_voucher ); ?>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="section-social" class="section appear clearfix padding-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-offset-2 col-lg-8 col-sm-12 col-xs-12 center ">
                        <div class="heading-bg">
                            <h1>Discover fun creative news from across the nation</h1>
                        </div>
                    </div>
                </div>
                <div class="row buttr-fly">
                    <div class="col-lg-4" style="padding: 0 45px">
                        <div class="soc-tp"></div>
                        <div class="soc-bg">
                            <h1>BLOG FEEDS</h1>
                            <?php
                            foreach (latestFeed(3) as $item) {
                                foreach ($item as $feed) {
//                                    echo '<pre>';
//                                    print_r($feed);
                                    ?>
                            <p><a href="http://news.thecreationstation.co.uk/<?= $feed['post_name'] ?>" target="_blank"><i class="fa fa-arrow-circle-right"></i>&nbsp;<?= $feed['post_title'] ?></a></p>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="soc-bot"></div>
                    </div>
                    <div class="col-lg-4" style="padding:0 45px;">
                        <div class="soc-tp"></div>
                        <div class="soc-bg">
                            <h1>NEWS UPDATES</h1>
                            <?php foreach (latestNews(3) as $item) { ?>
                                <p><a href="<?= base_url(); ?>news/details/<?php echo $item['url_alias'] ?>"><?php echo $item['news_title'] ?></a></p>
                                <!--<p><?php //echo word_limiter(strip_tags($item['contents']), 20);     ?></p>-->
                            <?php } ?>
                        </div>
                        <div class="soc-bot"></div>
                    </div>
                    <div class="col-lg-4" style="padding:0 45px;">
                        <div class="soc-tp"></div>
                        <div class="soc-bg">
                            <!-- Facebook -->       
                            <div id="fb-root"></div>
                            <script>(function (d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (d.getElementById(id))
                                        return;
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
                                    fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));
                            </script>

                            <div class="fb-like-box" data-href="https://www.facebook.com/thecreationstationltd" data-width="230px" data-height="250px" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
                            <!--End Facebook -->               
                        </div>
                        <div class="soc-bot"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about -->
        <section id="section-services" class="section pad-bot30 bg-red">
            <div class="container"> 
                <div class="row mar-bot40">
                    <div class="col-lg-6 pad-top60">
                        <?php echo ($take_a_look_what_we_do ); ?>
                    </div>

                    <div class="col-lg-6" >
                        <div class="align-center ">
                            <div class="video-part">
                                <div class="video-bg">
                                    <?php echo ($video ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>	
            </div>
        </section>
        <section id="section-owner" class="section appear clearfix padding-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-offset-2 col-sm-offset-1 center inspire ownerss">
                        <h1>Get free weekly ideas, offers and cool creative stuff</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-offset-1 col-lg-10 ">
                        <div class="owners">
                            <img src="images/owners.png" alt="owners" class="img-responsive" style="width: 100%"/>
                            <div class="mess">
                                <!--<h1>BE PART OF OUR GROWING NETWORK OF FRANCHISEES WHO INSPIRE CHILDRENS IMAGINATION ACROSS THE NATION!</h1>-->
                                <h1>Get free ideas, offers and creative sparks every week.</h1>
                                <p><a href="" class="create">Find Out More</a></p>
                            </div>
                        </div>
                        <div class="owner-bt">
                            <img src="images/owner-bt.png" alt="" class="img-responsive" style="width: 100%"/>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="section-contact" class="section appear clearfix padding-0">
            <div class="container">
                <div class="row ">
                    <div class="contact-form pad-top40">
                        <div class="col-lg-offset-1 col-lg-10 ">
                            <div class="col-lg-offset-1 col-lg-4 center">
                                <?php echo ($mom_child ); ?>
                            </div>
                            <div class="col-lg-7">
                                <div class="chester">
                                    <?php echo ($idea_to_inspire ); ?>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-6 col-lg-offset-6 col-sm-12">
                            <div class="info-pack col-sm-5">
                                <h2>DOWNLOAD YOUR FREE INFORMATION PACK</h2>
                                <p class="text-bold">Download free boredom buster booklet with 15 an half ideas to inspire your child.</p>
                            </div>
                            <div class="info-pack col-sm-5 center">
                                <div id="">
                                    <form id="recommendform" name="recommendform" enctype="multipart/form-data" method="post" >
                                        <input type="text" name="yourname" placeholder="Name" id="nameInput" class="form-control br-round mar-bot10" />
                                        <span id="nameLabel" class="error">Please enter your name</span>
                                        <input type="text" name="yournumber" placeholder="Number" id="numberInput" class="form-control br-round mar-bot10" />
                                        <span  for="yournumber" class="error" id="numberLabel">Please enter your number</span>
                                        <input type="text" name="youremail" placeholder="Email" id="emailInput" class="form-control br-round mar-bot10" />
                                        <span  for="youremail" class="error" id="emailLabel">Please enter your email</span>
                                        <span  for="youremail" class="error" id="emailValid">Please enter valid email</span>
                                        <button class="btn sen fri-inp create">Download</button>
                                    </form>
                                </div>
                            </div>
                            <!--<span class="btn create news-letter-p">Download</span>-->
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- ./span12 -->
                </div>
            </div>
        </section>

        <footer id="footer" class="section footer">
            <div class="container">
                <?php $this->load->view("themes/" . THEME . "/layout/inc-footer"); ?>
            </div>
        </footer>
        <a href="#header" class="scrollup"><i class="fa fa-chevron-up"></i></a>	
        <?php echo $CI->assets->renderFooter(); ?>

        <script type='text/javascript'>
            $(document).ready(function () {
                function recommendvalidation() {
                    var validations = '';
                    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    var name = $('#nameInput').val();
                    var number = $('#numberInput').val();
                    var email = $('#emailInput').val();
                    var inputVal = new Array(name, number, email);
                    var inputMessage = new Array("name", "number", "email address");
                    $('.error').hide();

                    if (name == "") {
                        validations += '#nameLabel ,';

//                        return false;
                    }
                    if (inputVal[1] == "") {

                        validations += '#numberLabel ,';

//                        return false;
                    }
                    if (inputVal[2] == "") {

                        validations += '#emailLabel ,';
//                        return false;
                    }
                    else if (!emailReg.test(email)) {
                        validations += '#emailValid ,';

//                        return false;
                    }
                    if (validations != '')
                    {
                        //alert('if');
                        $(validations.slice(0, -1)).show();

                        return false;
                    } else {
                        //alert('else');
                        return true;
                    }
                    validations = '';
                }
                $('.sen').click(function () {

//                    recommendvalidation();
                    // console.log(recommendvalidation())
                    //   if (recommendvalidation() != false) {
                    $.ajax({
                        url: "contact/download",
                        context: document.body,
                        type: 'post',
                        data: $('#recommendform').serialize(),
                        dataType: 'JSON'
                    }).done(function (data) {
                        console.log(data);
                        if (data.error != 0)
                        {
                            //alert('if');
                            $('.error').hide();
                            $(data.error).show();
                            return false;
                        }
                        if (data.response == 'true')
                            $('#recommend_pop_up').html(data.response);
                        $('#recommend_pop_up').bPopup({closeClass: 'recomclose', });
                        $('.downloadlink').html(data.message);
                    });
                    //  }
                    return false;
                });
                $('.recomclose').click(function () {
                    location.reload();
                });
            });
        </script>
        <style>
            .error {
                display: none;
            }
            .recomclose {
                background: #DA0001 none repeat scroll 0 0;
                border-radius: 75px;
                color: #fff;
                text-align: center;
                width: 20px;
                float: right;
                cursor: pointer;
            }
        </style>
        <div id="recommend_pop_up" style="background: #fff; padding: 10px;display: none; border-radius: 10px;">
            <div class="recomclose">X</div>
            <div style="clear: both; float: left; padding: 2px 0; width: 305px;"> 
                <span class="downloadlink"></span>
            </div>
        </div>
    </body>
</html>

