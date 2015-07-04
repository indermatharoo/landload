<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Utility {

    var $CI;

    function Utility() {
        $this->CI = & get_instance();
        log_message('debug', "Utility Class Initialized");
    }

    function show404($params = array()) {
        $this->CI->load->model('cms/Pagemodel');
        $this->CI->load->helper('text');

        set_status_header('404');

        $alias = '404';
        //Get Page Details
        $page = array();
        $page = $this->CI->Pagemodel->getDetails($alias);
        $this->CI->setPage($page);

        //Compiled blocks
        $compiled_blocks = array();
        $compiled_blocks = $this->CI->Pagemodel->compiledBlocks($page);
        
        $breadcrumbs = array();
        $breadcrumbs = $this->CI->Pagemodel->breadcrumbs($page['page_id']);

        $inner = array();
        $shell = array();
        $inner['page'] = $page;
        $inner['breadcrumbs'] = $breadcrumbs;
        $compiledblocks = array();
        foreach ($compiled_blocks as $key => $val) {
            $compiledblocks[] = $val;
            $inner[$key] = $val;
        }
        $inner['compiledblocks'] = $compiledblocks;
        
        //File Name & File Path
        $file_name = str_replace('/', '_', $page['page_uri']);
        
        $file_path = "application/views/themes/" . THEME . "/cms/" . $file_name . ".php";

        //Meta
        $meta_file = "application/views/themes/" . THEME . "/meta/" . $file_name . ".php";
        if (file_exists($meta_file)) {
            $this->CI->html->addMeta($this->CI->load->view("themes/" . THEME . "/meta/cms/" . $file_name, array('page' => $page), TRUE));
        } else {
            $this->CI->html->addMeta($this->CI->load->view("themes/" . THEME . "/meta/default", array('page' => $page), TRUE));
        }
        
        $shell['contents'] = $this->CI->load->view("themes/" . THEME . "/cms/" . 'default', $inner, true);
        $this->CI->load->view("themes/" . THEME . "/templates/{$page['template_alias']}", $shell);
    }

    function accessDenied() {
        $inner = array();
        $page = array();
        $page['title'] = 'Access Denied';
        $page['contents'] = $this->CI->load->view('pages/access-denied', $inner, true);
        $this->CI->load->view('shell', $page);
    }

    function showMessage($title, $message) {
        $inner = array();
        $page = array();
        $inner['title'] = $title;
        $inner['message'] = $message;
        $page['contents'] = $this->CI->load->view('themes/' . DWS_THEME . '/pages/message', $inner, true);
        $this->CI->load->view('themes/' . DWS_THEME . '/shell', $page);
    }

}

?>