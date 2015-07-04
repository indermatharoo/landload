<?php

class Dashboard extends CommonController {

    public function index() {
        $inner = array();
        $page = array();
        $inner['labels'] = array(
            'Event Title',
            'Venue Name',
            'Email',
            'Phone',
            'Postcode',
            'Status'
        );
        $this->load->model('customermodel');
        $inner['rows'] = $this->usermodel->eventsDetail();
        $inner['upcomming_events'] = $this->customermodel->getBookingDetail();
        $page = array();
        $page['content'] = $this->load->view('customer/dashboard', $inner, TRUE);
//        echo $this->dashboard;exit;
        $this->load->view('themes/default/templates/customerlogin', $page);
    }

}
