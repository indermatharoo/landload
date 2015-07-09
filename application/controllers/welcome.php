<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function index() {
       
        $this->load->model('Settingsmodel');
        $this->load->model('Pagemodel');
        $this->load->helper('text');

        //Page Alias
        $alias = 'homepage';
        //Get Page Details
        $page = array();
        $page = $this->Pagemodel->getDetails($alias);

        if (!$page) {
            $this->utility->show404();
            return;
        }

        $this->cms->setPage($page);


        //Get Page Blocks
        $blocks = array();
        $blocks = $this->Pagemodel->getAllBlocks($page['page_id']);

        //Compiled blocks
        $compiled_blocks = array();
        $compiled_blocks = $this->Pagemodel->compiledBlocks($page, $blocks);


        //Variables
        $inner = array();
        $inner['page'] = $page;

        foreach ($compiled_blocks as $key => $val) {
            $inner[$key] = $val;
        }

        //Compile page template
        echo $this->Pagemodel->compiledPage($page, $inner);
        exit();
    }

    function test() {
        print_r($this->session->all_userdata());
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */