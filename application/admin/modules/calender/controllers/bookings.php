<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bookings extends Admin_Controller {

    function __construct() {
        parent::__construct();
        isLogged();
        $this->load->model('user/usermodel');
    }

    //**************************************validation start*********************
    //validation for add valid image
    function valid_event_image($str) {
        if (!isset($_FILES['event_img']) || $_FILES['event_img']['size'] == 0 || $_FILES['event_img']['error'] != UPLOAD_ERR_OK) {
            $this->form_validation->set_message('valid_image', 'Image not uploaded');
            return FALSE;
        }
        $imginfo = @getimagesize($_FILES['event_img']['tmp_name']);

        if (!($imginfo[2] == 1 || $imginfo[2] == 2 || $imginfo[2] == 3 )) {
            $this->form_validation->set_message('valid_image', 'Only GIF, JPG and PNG Images are accepted');
            return FALSE;
        }
        return TRUE;
    }

//*************************************validation End********************************

    function index($offset = 0) {

        $this->load->model('Bookingsmodel');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->helper('text');

        $perpage = 10;
        $config = array();
        $config['base_url'] = base_url() . "calender/bookings/index/";
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->Bookingsmodel->countAll($this->ids);
        $config['per_page'] = $perpage;
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $this->pagination->initialize($config);
        $bookings = array();
        $inner = array();

        $inner['bookings'] = $this->Bookingsmodel->getBookings($offset, $perpage, $this->ids);
        $inner['pagination'] = $this->pagination->create_links();


        $page = array();
        $page['content'] = $this->load->view('calender/bookings/booking-index', $inner, TRUE);
        $this->load->view($this->event, $page);
    }

    function add() {
        $this->load->model('Bookingsmodel');
        $this->load->model('users/usermodel');
        $this->load->library('form_validation');
        $this->load->helper('form');

        //event type

        $events = array();
        $ids = array();
        if ($this->aauth->isFranshisee()):
            $ids = $this->usermodel->getFranchiseUsersId();
        endif;
        $rs = $this->Bookingsmodel->getEvents($ids);
        foreach ($rs as $item) {
            $events[$item['event_id']] = $item;
        }
        //locaton of event
        $customer = array();
        $customer[''] = '-- Choose --';
        $cus = $this->Bookingsmodel->getCustomer($this->ids);
        foreach ($cus as $item) {
            $customer[$item['customer_id']] = $item['first_name'] . ' ' . $item['last_name'];
        }
        $this->form_validation->set_rules('event_type_id', 'Event Type', 'trim|');
        $this->form_validation->set_rules('eventdate', 'Event Date', 'trim|');
        $this->form_validation->set_rules('event_title', 'Event Title', 'trim|');
        $this->form_validation->set_rules('category_id', 'Category', 'trim|');
        $this->form_validation->set_rules('venue', 'Venues', 'trim|');
        $this->form_validation->set_rules('description', 'Description', 'trim|');

        $this->form_validation->set_error_delimiters('<li>', '</li>');



        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $inner['events'] = $events;
            $inner['customer'] = $customer;
            $page['content'] = $this->load->view('bookings/booking-add', $inner, TRUE);
            $this->load->view($this->event, $page);
        } else {
            $this->Bookingsmodel->insertRecord();
            $this->session->set_flashdata('SUCCESS', 'event_added');

            redirect("calender/bookings/index", 'location');
            exit();
        }
    }

    function edit($bid = false) {
        $this->load->model('Bookingsmodel');
        $this->load->library('form_validation');
        $this->load->helper('form');

        //event type
        $events = array();
        $ids = array();
        if ($this->aauth->isFranshisee()):
            $ids = $this->usermodel->getFranchiseUsersId();
        endif;
        $rs = $this->Bookingsmodel->getEvents($ids);
        foreach ($rs as $item) {
            $events[$item['event_id']] = $item;
        }

        $booking = array();
        $booking = $this->Bookingsmodel->getBooking($bid);
//        ep($booking);

        $customer = array();
        $customer[''] = '-- Choose --';
        $cus = $this->Bookingsmodel->getCustomer($this->ids);
        foreach ($cus as $item) {
            $customer[$item['customer_id']] = $item['first_name'] . ' ' . $item['last_name'];
        }

        $this->form_validation->set_rules('event_type_id', 'Event Type', 'trim');
        $this->form_validation->set_rules('eventdate', 'Event Date', 'trim');
        $this->form_validation->set_rules('event_title', 'Event Title', 'trim');
        $this->form_validation->set_rules('category_id', 'Category', 'trim');
        $this->form_validation->set_rules('venue_id', 'Venues', 'trim');
        $this->form_validation->set_rules('description', 'Description', 'trim');

        $this->form_validation->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run() == FALSE) {
            $inner = array();

            $inner['events'] = $events;
            $inner['booking'] = $booking;
            $inner['customer'] = $customer;
            $page['content'] = $this->load->view('calender/bookings/booking-edit', $inner, TRUE);
            $this->load->view($this->event, $page);
        } else {
            $this->Bookingsmodel->updateRecord($booking);
            $this->session->set_flashdata('SUCCESS', 'event_updated');
            redirect("calender/bookings/index", 'location');
            exit();
        }
    }

    function delete($bid) {
        $this->load->model('Bookingsmodel');
        $status = $this->Bookingsmodel->bookingDetele($bid);
        if ($status == true) {
            $this->session->set_flashdata('SUCCESS', 'booking_deleted');
            redirect("calender/bookings", 'location');
            exit();
        }
    }

}

?>