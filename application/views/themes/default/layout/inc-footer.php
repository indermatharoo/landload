<div class="full_footer_container">
    <div class="footer_container">
        <div class="container">
            <div class="row">
                <div class="footer_middle_container">
                    
                    
                    
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
                                        'level_1_format' => '<a href="{HREF}"{ATTRIBUTES}><i class="fa fa-angle-double-right"></i> {LINK_NAME}</a>',
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
                                        'level_1_format' => '<a href="{HREF}"{ATTRIBUTES}><i class="fa fa-angle-double-right"></i> {LINK_NAME}</a>',
                                        'level_2_format' => '<a href="{HREF}"{ATTRIBUTES}>{LINK_NAME}</a>'
                                    );
                                    echo $CI->html->menu($params);
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End Feature Products -->
                    
                    <div class="col-md-3 col-sm-6">
                               <div class="popular_link_container">
                                   <div class="popular_link_list_section">
                                       <div class="popular_heading_text">
                                           <h3>  <br/> </h3>
                                       </div>
                                       <div class="popular_links_active_list">
                                           <ul class="footer_menu_links list-unstyled">
                                               <li> <a href="#"> <i class="fa fa-angle-double-right"></i> Product Overview</a></li>
                                               <li> <a href="#"> <i class="fa fa-angle-double-right"></i> Pricing</a></li>
                                               <li> <a href="#"> <i class="fa fa-angle-double-right"></i> Calculate Your Cost Savings</a></li>
                                               <li> <a href="#"> <i class="fa fa-angle-double-right"></i> Case Studies & Testimonials</a></li>
                                               <li> <a href="#"> <i class="fa fa-angle-double-right"></i> Top 10 Reasons to Choose</a></li>
                                               <li> <a href="#"> <i class="fa fa-angle-double-right"></i> Property Manager</a></li>
                                           </ul>
                                       </div>
                                   </div>
                               </div>
                               
                           </div>
                           <!-- End Feature Products -->
                           
                           
                           <div class="col-md-3 col-sm-6">
                               <div class="popular_link_container">
                                   <div class="popular_link_list_section">
                                       <div class="popular_heading_text">
                                           <h3>  Contact Us </h3>
                                           <p> or call +1 (121) 000-2020</p>
                                       </div>
                                       <div class="popular_links_active_list">
                                           <ul class="footer_menu_links list-unstyled footer_address_section">
                                               <li>  <p> 
                                                       <i class="fa fa-map-marker"></i> 
                                                       <span class="text-gold"> Address: </span> Ctetur adipisicing elit, sed do eiusmod tempor
                                                   </p>
                                               </li>
                                               <li>  <p> 
                                                       <i class="fa fa-fax"></i> 
                                                       <span class="text-gold"> Fax: </span> 800-2345-6789
                                                   </p>
                                                   <p> 
                                                       <i class="fa fa-envelope-o"></i> 
                                                       <span class="text-gold"> E-mail: </span> info@demolink.org
                                                   </p>
                                               </li> 
                                               
                                           </ul>
                                       </div>
                                       
                                       <div class="clearfix"></div>
                                       <div class="social_links_heading_text">
                                           <h3>  Follow Us </h3>
                                           <ul class="footer_menu_links list-unstyled list-inline footer_social_links_section">
                                               <li>  <i class="fa fa-facebook fa-2x"></i> </li>
                                               <li>  <i class="fa fa-linkedin fa-2x"></i> </li> 
                                               <li>  <i class="fa fa-twitter fa-2x"></i> </li> 
                                               <li>  <i class="fa fa-skype fa-2x"></i> </li> 
                                               <li>  <i class="fa fa-youtube-play fa-2x"></i> </li> 
                                               <li>  <i class="fa fa-share-alt fa-2x"></i> </li>
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




<div class="full_footer_copyright_container">
    <div class="footer_copyright_section">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyrigt_text_leftside">
                        <p>Copyright © 2011-2015 <span class="text-white">Landlord Master.</span> all rights reserved</p>
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