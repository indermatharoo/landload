<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Booking extends Cms_Controller {

    function __construct() {
        parent::__construct();
    }

    function index($eid = FALSE) {
        if(!$eid) redirect ('franchisee');
        $this->load->model('Bookingmodel');
        $event = $this->Bookingmodel->getEvent($eid);
        $price = $this->Bookingmodel->getEventPrice($eid);
        
        
        $inner = array();
        $inner['event'] = $event;
        $inner['price'] = $price;
        $shell['contents'] = $this->load->view("booking-index", $inner, true);
        $this->load->view("themes/" . THEME . "/templates/booking", $shell);
    }


    function event($uid) {
        $this->load->model('Bookingmodel');
        $franchisee = $this->Bookingmodel->getEvent($uid);
//         e($franchisee);

        $inner = array();
        $inner['franchisee'] = $franchisee;
        $output['status'] = 1;
        $output['message'] = $this->load->view('franchisee', $inner, true);
        echo json_encode($output);
        exit();
    }

}

?>