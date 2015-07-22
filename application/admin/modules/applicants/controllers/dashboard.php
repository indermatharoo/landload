<?php

class Dashboard extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
//        $inner = $page = array();
//        $page['content'] = $this->load->view('dashboard', $inner, true);
//        $this->load->view($this->dashboard, $page);

        $inner = $page = array();
        $this->load->model('calender/Calendermodel');
        $inner['events'] = $this->Calendermodel->getApplications();
        $page['content'] = $this->load->view('dashboard',$inner,true);
//        $page['content'] = $this->load->view('event/event-index', $inner, TRUE);
        $this->load->view($this->dashboard, $page);
    }

}
