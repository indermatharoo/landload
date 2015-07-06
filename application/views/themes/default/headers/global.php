<link href='http://fonts.googleapis.com/css?family=McLaren' rel='stylesheet' type='text/css'>
<script type="text/javascript">
    var DWS_BASE_URL = "<?php echo $CI->http->baseURL(); ?>";
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script type="text/javascript">
    $(document).ready(function () {
        $(".root_menu a").each(function () {
            if (this.href == window.location.href) {
                $(this).parent('li').addClass("mactive");
            }
        });
        $(".custom_login").on('click', function () {
            $('.login_form').bPopup({
                closeClass: 'cls'
            });
        });
        $('.carousel').carousel();
    });
    $(function () {
        $('.required-icon').tooltip({
            placement: 'left',
            title: 'Required field'
        });
    });
</script>

<?php
$CI->assets->addCSS('css/animate.css');
$CI->assets->addCSS('css/bootstrap-theme.css');
$CI->assets->addCSS('css/bootstrap.css');
$CI->assets->addCSS('css/font-awesome.css');
$CI->assets->addCSS('css/isotope.css');
$CI->assets->addCSS('css/overwrite.css');
$CI->assets->addCSS('css/style.css');
$CI->assets->addCSS('css/bs_style.css');

$CI->assets->addFooterJS('js/modernizr-2.6.2-respond-1.1.0.min.js');
//$CI->assets->addFooterJS('js/jquery.js');
$CI->assets->addFooterJS('js/jquery.easing.1.3.js');
$CI->assets->addFooterJS('js/bootstrap.min.js');
$CI->assets->addFooterJS('js/jquery.isotope.min.js');
$CI->assets->addFooterJS('js/jquery.nicescroll.min.js');
$CI->assets->addFooterJS('js/fancybox/jquery.fancybox.pack.js');
$CI->assets->addFooterJS('js/skrollr.min.js');
$CI->assets->addFooterJS('js/jquery.scrollTo-1.4.3.1-min.js');
$CI->assets->addFooterJS('js/jquery.localscroll-1.2.7-min.js');
$CI->assets->addFooterJS('js/stellar.js');
$CI->assets->addFooterJS('js/jquery.appear.js');
$CI->assets->addFooterJS('js/main.js');
$CI->assets->addFooterJS('js/bPopup.js');
//$CI->assets->addFooterJS('js/globel.js');
?>

