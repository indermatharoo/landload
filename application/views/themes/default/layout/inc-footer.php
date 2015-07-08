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
                                        <img src="imgs/footer_abut_img.png"/>
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
                                        <a href="about-us" >Read More</a>  
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
                                    <?php
                                    $params = array(
                                        'menu_alias' => 'pop_links',
                                        'ul_format' => '<ul class="footer_menu_links list-unstyled">{MENU}</ul>',
                                        'level_1_format' => '<a href="{HREF}"{ATTRIBUTES}><i class="fa fa-arrow-circle-o-right"></i>{LINK_NAME}</a>',
                                        'level_2_format' => '<a href="{HREF}"{ATTRIBUTES}>{LINK_NAME}</a>'
                                    );
                                    echo $CI->html->menu($params);
                                    ?>
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
                                    <?php
                                    $params = array(
                                        'menu_alias' => 'feature_links',
                                        'ul_format' => '<ul class="footer_menu_links list-unstyled">{MENU}</ul>',
                                        'level_1_format' => '<a href="{HREF}"{ATTRIBUTES}><i class="fa fa-arrow-circle-o-right"></i>{LINK_NAME}</a>',
                                        'level_2_format' => '<a href="{HREF}"{ATTRIBUTES}>{LINK_NAME}</a>'
                                    );
                                    echo $CI->html->menu($params);
                                    ?>
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
                        <?php
                        $params = array(
                            'menu_alias' => 'footer_terms',
                            'ul_format' => '<ul class="list-unstyled list-inline">{MENU}</ul>',
                            'level_1_format' => '<a href="{HREF}"{ATTRIBUTES}>{LINK_NAME}</a>',
                            'level_2_format' => '<a href="{HREF}"{ATTRIBUTES}>{LINK_NAME}</a>'
                        );
                        echo $CI->html->menu($params);
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer_social_links_right">
                        <ul class="list-unstyled list-inline text-right">
                            <li> <a href="<?= DWS_TWITTER_ACCOUNT; ?>" target="_blank"> <i class="fa fa-twitter-square"></i> </a></li>
                            <li> <a href="<?= DWS_LINKEDIN_ACCOUNT; ?>" target="_blank"> <i class="fa fa-linkedin-square"></i> </a></li>
                            <li> <a href="<?= DWS_GOOGLE_ACCOUNT; ?>" target="_blank"> <i class="fa fa-google-plus-square"></i> </a></li>
                            <li> <a href="<?= DWS_FACEBOOK_ACCOUNT; ?>" target="_blank"><i class="fa fa-facebook-square"></i> </a></li>
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
                        <p class="text-right"><span class="text-gray">Designed & Developed By: </span>Multichannelcreative</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>