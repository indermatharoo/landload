<?php
//echo "<pre><h1>";
//print_r($news);
//die();
?>
<div class="row animated opacity mar-bot20" data-andown="fadeIn" data-animation="animation">
    <div class="col-sm-4">
        <div id="news_scroll">
            <h1>Latest News</h1>
            <?php foreach (latestNews(2) as $item) { ?>
                <h3><a href="<?= base_url(); ?>news/details/<?php echo $item['url_alias'] ?>"><?php echo word_limiter($item['news_title'], 5); ?></a></h3>
                <p><?php echo word_limiter(strip_tags($item['contents']), 20); ?></p>
            <?php } ?>
        </div>
    </div>
    <div class="col-sm-4 align-center">
        <h1>Follow us</h1>
        <ul class="social-network social-circle">
            <li><a href="<?= DWS_RSS_URL ?>" class="icoRss" title="Rss" target="_blank"><i class="fa fa-rss"></i></a></li>
            <li><a href="<?= DWS_FACEBOOK_ACCOUNT ?>" class="icoFacebook" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li><a href="<?= DWS_TWITTER_ACCOUNT ?>" class="icoTwitter" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
            <li><a href="<?= DWS_YOUTUBE_ACCOUNT ?>" class="icoGoogle" title="Google +" target="_blank"><i class="fa fa-youtube"></i></a></li>
            <li><a href="<?= DWS_LINKEDIN_ACCOUNT ?>" class="icoLinkedin" title="Linkedin" target="_blank"><i class="fa fa-linkedin"></i></a></li>
        </ul>				
    </div>
    <div class="col-sm-4">
        <h1>Social wall</h1>
    </div>
</div>
<div class="row align-center copyright">
    <div class="col-sm-12"><p> © 2014 The Creation Station Ltd.
            <br>
            All rights reserved. Terms and Conditions apply
            <br>
            Designed & Developed by <a href="http://multichannelcreative.co.uk/" target="_blank">Multichannelcreative</a></p>
    </div>
</div>

