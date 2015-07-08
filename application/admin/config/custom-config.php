<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$config['EMAIL_CONFIG'] = array(
    'mailtype' => 'html'
);

//get path of various files upload in website
$config['UPLOAD_PATH'] = str_replace('\\', '/', realpath(BASEPATH . '../')) . '/upload/';
$config['UPLOAD_URL'] = $this->config['site_url'] . 'upload/';


$config['INVOICES_PATH'] = str_replace('\\', '/', realpath(BASEPATH . '../')) . '/invoices/';
$config['INVOICES_URL'] = $this->config['site_url'] . 'invoices/';

$config['DEFAULT_LANG'] = 'en';

$config['PAGE_PATH'] = $config['UPLOAD_PATH'] . 'page/';
$config['PAGE_URL'] = $config['UPLOAD_URL'] . 'page/';

$config['PAGE_DATA_IMAGE_PATH'] = $config['UPLOAD_PATH'] . 'page_data/images/';
$config['PAGE_DATA_IMAGE_URL'] = $config['UPLOAD_URL'] . 'page_data/images/';

//path for the widget data
$config['WIDGET_PATH'] = $config['UPLOAD_PATH'] . 'widget_data/';
$config['WIDGET_URL'] = $config['UPLOAD_URL'] . 'widget_data/';

$config['BLOCK_IMAGE_PATH'] = $config['UPLOAD_PATH'] . 'page/block_images/';
$config['BLOCK_IMAGE_URL'] = $config['UPLOAD_URL'] . 'page/block_images/';

$config['CATEGORY_IMAGE_PATH'] = $config['UPLOAD_PATH'] . 'category/';
$config['CATEGORY_THUMBNAIL_PATH'] = $config['CATEGORY_IMAGE_PATH'] . 'thumbnails/';
$config['CATEGORY_IMAGE_URL'] = $config['UPLOAD_URL'] . 'category/';
$config['CATEGORY_THUMBNAIL_URL'] = $config['CATEGORY_IMAGE_URL'] . 'thumbnails/';

$config['CATEGORY_BANNER_PATH'] = $config['UPLOAD_PATH'] . 'category/banner/';
$config['CATEGORY_BANNER_URL'] = $config['UPLOAD_URL'] . 'category/banner/';

$config['BANNER_PATH'] = $config['UPLOAD_PATH'] . 'page/banner/';
$config['BANNER_URL'] = $config['UPLOAD_URL'] . 'page/banner/';

$config['PRODUCT_PATH'] = $config['UPLOAD_PATH'] . 'products/images/';
$config['PRODUCT_URL'] = $config['UPLOAD_URL'] . 'products/images/';

$config['DOCUMENT_PATH'] = $config['UPLOAD_PATH'] . 'products/documents/';
$config['DOCUMENT_URL'] = $config['UPLOAD_URL'] . 'products/documents/';

$config['SHOPPING_CART_PATH'] = $config['UPLOAD_PATH'] . 'shopping_cart/';
$config['SHOPPING_CART_URL'] = $config['UPLOAD_URL'] . 'shopping_cart/';

$config['SHOPPING_CART_FILE_PATH'] = $config['SHOPPING_CART_PATH'] . 'images/';
$config['SHOPPING_CART_FILE_URL'] = $config['SHOPPING_CART_URL'] . 'images/';

$config['CASESTUDY_PATH'] = $config['UPLOAD_PATH'] . 'casestudies/';
$config['CASESTUDY_THUMBNAIL_PATH'] = $config['CASESTUDY_PATH'] . 'thumbnails/';

$config['CASESTUDY_URL'] = $config['UPLOAD_URL'] . 'casestudies/';
$config['CASESTUDY_THUMBNAIL_URL'] = $config['CASESTUDY_URL'] . 'thumbnails/';

$config['SLIDESHOW_IMAGE_PATH'] = $config['UPLOAD_PATH'] . 'slideshow/';
$config['SLIDESHOW_IMAGE_URL'] = $config['UPLOAD_URL'] . 'slideshow/';

$config['CSV_PATH'] = $config['UPLOAD_PATH'] . 'import/';
$config['CSV_URL'] = $config['UPLOAD_URL'] . 'import/';

$config['HOME_IMAGE_PATH'] = $config['UPLOAD_PATH'] . 'home-page/images/';
$config['HOME_IMAGE_URL'] = $config['UPLOAD_URL'] . 'home-page/images/';

$config['IMAGE_PATH'] = $config['UPLOAD_PATH'] . 'images/';
$config['IMAGE_URL'] = $config['UPLOAD_URL'] . 'images/';

$config['HEADER_BACKGROUND_PATH'] = $config['UPLOAD_PATH'] . 'category/images/';
$config['HEADER_BACKGROUND_URL'] = $config['UPLOAD_URL'] . 'category/images/';

$config['SHOWREEL_IMAGE_PATH'] = $config['UPLOAD_PATH'] . 'showreel/images/';
$config['SHOWREEL_IMAGE_URL'] = $config['UPLOAD_URL'] . 'showreel/images/';

$config['CLIENT_LOGO_PATH'] = $config['UPLOAD_PATH'] . 'clients/logos/';
$config['CLIENT_LOGO_URL'] = $config['UPLOAD_URL'] . 'clients/logos/';

$config['PROPERTY_IMAGE_PATH'] = $config['UPLOAD_PATH'] . 'property/images/';
$config['PROPERTY_IMAGE_URL'] = $config['UPLOAD_URL'] . 'property/images/';

$config['UNIT_IMAGE_PATH'] = $config['UPLOAD_PATH'] . 'property/units/';
$config['UNIT_IMAGE_URL'] = $config['UPLOAD_URL'] . 'property/units/';

$config['VIRT_IMAGE_PATH'] = $config['UPLOAD_PATH'] . 'virtcab/img/';
$config['VIRT_IMAGE_URL'] = $config['UPLOAD_URL'] . 'virtcab/img/';

$config['CASESTUDY_IMAGE_PATH'] = $config['UPLOAD_PATH'] . 'casestudy/images/';
$config['CASESTUDY_IMAGE_URL'] = $config['UPLOAD_URL'] . 'casestudy/images/';

//
$config['TEAM_PATH'] = $config['UPLOAD_PATH'] . 'team/';
$config['TEAM_URL'] = $config['UPLOAD_URL'] . 'team/';

$config['TEAM_BLACK_IMG_PATH'] = $config['TEAM_PATH'] . 'black_images/';
$config['TEAM_BLACK_IMG_URL'] = $config['TEAM_URL'] . 'black_images/';

$config['TEAM_COLOR_IMG_PATH'] = $config['TEAM_PATH'] . 'color_images/';
$config['TEAM_COLOR_IMG_URL'] = $config['TEAM_URL'] . 'color_images/';

$config['PDF_FILE_PATH'] = $config['UPLOAD_PATH'] . 'pdfs/';
$config['PDF_FILE_URL'] = $config['UPLOAD_URL'] . 'pdfs/';

$config['PRODUCT_IMAGE_PATH'] = $config['UPLOAD_PATH'] . 'products/';
$config['PRODUCT_IMAGE_URL'] = $config['UPLOAD_URL'] . 'products/';

$config['PRODUCT_PROMOTION_PATH'] = $config['UPLOAD_PATH'] . 'product_promotion/';
$config['PRODUCT_PROMOTION_URL'] = $config['UPLOAD_URL'] . 'product_promotion/';

$config['MEALDEAL_PROMOTION_PATH'] = $config['UPLOAD_PATH'] . 'mealdeal_promotion/';
$config['MEALDEAL_PROMOTION_URL'] = $config['UPLOAD_URL'] . 'mealdeal_promotion/';

$config['EXPORT_CSV_PATH'] = str_replace('\\', '/', realpath(BASEPATH . '../')) . '/exports/';

$config['MISC_PATH'] = $config['UPLOAD_PATH'] . 'misc/';
$config['MISC_URL'] = $config['UPLOAD_URL'] . 'misc/';

/**
 * Virtual Cab
 * img
 * doc
 * videos
 */
$config['UPLOAD_PATH_VIRCAB'] = str_replace('\\', '/', realpath(BASEPATH . '../')) . '/upload/virtcab/';
$config['UPLOAD_PATH_VIRCAB_IMG'] = str_replace('\\', '/', realpath(BASEPATH . '../')) . '/upload/virtcab/img/';
$config['UPLOAD_PATH_VIRCAB_DOC'] = str_replace('\\', '/', realpath(BASEPATH . '../')) . '/upload/virtcab/doc/';
$config['UPLOAD_PATH_VIRCAB_MISC'] = str_replace('\\', '/', realpath(BASEPATH . '../')) . '/upload/virtcab/misc/';
$config['UPLOAD_PATH_VIRCAB_VIDEO'] = str_replace('\\', '/', realpath(BASEPATH . '../')) . '/upload/virtcab/video/';

$config['UPLOAD_URL_VIRCAB'] = $this->config['site_url'] . 'upload/virtcab/';
$config['UPLOAD_URL_VIRCAB_IMG'] = $this->config['site_url'] . 'upload/virtcab/img/';
$config['UPLOAD_URL_VIRCAB_DOC'] = $this->config['site_url'] . 'upload/virtcab/doc/';
$config['UPLOAD_URL_VIRCAB_MISC'] = $this->config['site_url'] . 'upload/virtcab/misc/';
$config['UPLOAD_URL_VIRCAB_VIDEO'] = $this->config['site_url'] . 'upload/virtcab/video/';

/**
 * ===Events===
 * image
 */
$config['UPLOAD_PATH_EVENTS'] = str_replace('\\', '/', realpath(BASEPATH . '../')) . '/upload/events/';
$config['UPLOAD_URL_EVENTS'] = $this->config['site_url'] . 'upload/events/';
$config['UPLOAD_PATH_TICKETS'] = str_replace('\\', '/', realpath(BASEPATH . '../')) . '/upload/events/tickets';
$config['UPLOAD_URL_TICKETS'] = $this->config['site_url'] . 'upload/events/';

/**
 * ===Venues===
 * image
 */
$config['UPLOAD_PATH_VENUES'] = str_replace('\\', '/', realpath(BASEPATH . '../')) . '/upload/venues/';
$config['UPLOAD_URL_VENUES'] = $this->config['site_url'] . 'upload/venues/';

$config['UPLOAD_PATH_USERS'] = str_replace('\\', '/', realpath(BASEPATH . '../')) . '/upload/logo/';
$config['UPLOAD_URL_USERS'] = $this->config['site_url'] . 'upload/logo/';

$config['RESIZED_IMAGES_PATH'] = str_replace('\\', '/', realpath(BASEPATH . '../')) . '/images/resized/';
$config['RESIZED_IMAGES_URL'] = $this->config['base_url'] . 'images/resized/';

$config['SIDELINKS'] = str_replace('\\', '/', realpath(BASEPATH . '../')) . '/upload/sidelinks/images/';
$config['SIDELINKS_URL'] = $this->config['base_url'] . 'upload/sidelinks/images/';

$config['SLIDESHOW_IMAGE_PATH'] = $config['UPLOAD_PATH'] . 'slideshow/';
$config['SLIDESHOW_IMAGE_URL'] = $config['UPLOAD_URL'] . 'slideshow/';
?>