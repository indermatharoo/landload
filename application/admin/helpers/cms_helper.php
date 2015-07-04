<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('cms_meta_tags')) {

    function cms_meta_tags() {
        $CI = & get_instance();
        return $CI->getMeta();
    }

    function cms_head() {
        $CI = & get_instance();
        return $CI->loadHead();
    }

    function cms_css() {
        $CI = & get_instance();
        return $CI->getCSS();
    }

    function cms_js() {
        $CI = & get_instance();
        return $CI->getJS();
    }

    function cms_base_url() {
        $CI = & get_instance();
        return $CI->baseURL();
    }

    function cms_base_url_nossl() {
        $CI = & get_instance();
        return $CI->baseURLNoSSL();
    }

    function cms_base_url_ssl() {
        $CI = & get_instance();
        return $CI->baseURLSSL();
    }

    function cms_uktous_date($date) {
        //dd/mm/YYYY
        $arr = explode('/', $date);
        return "{$arr[2]}-{$arr[1]}-{$arr[0]}";
    }

    function cms_ustouk_date($date) {
        //YYYY-mm-dd
        $arr = explode('-', $date);
        return "{$arr[2]}/{$arr[1]}/{$arr[0]}";
    }

}
/* End of file cms_helper.php */
/* Location: ./system/helpers/number_helper.php */