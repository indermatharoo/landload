<?php

class Dashboard extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $inner = $page = array();
        $page['content'] = $this->load->view('dashboard', $inner, true);
        $this->load->view($this->dashboard, $page);
    }

}
