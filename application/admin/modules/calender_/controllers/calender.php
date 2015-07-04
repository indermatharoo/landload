<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Calender extends Admin_Controller {

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
        
        $this->load->model('Calendermodel');
        $this->load->model('user/usermodel');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->helper('text');

        $perpage = 100;
        $config = array();
        $config['base_url'] = base_url() . "calender/index/";
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->Calendermodel->countAll();
        $config['per_page'] = $perpage;
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $this->pagination->initialize($config);

        $event = array();
        $event = $this->Calendermodel->getEvents($this->ids);
        if ($this->aauth->isFranshisee()) {
            $ids = $this->usermodel->getFranchiseUsersId(curUsrId());
            $event = $this->Calendermodel->getEvents($offset, $perpage, $ids);
        }
        $inner = array();
        $inner['event'] = $event;
        $inner['pagination'] = $this->pagination->create_links();
        $inner['labels'] = array(
            '' => '',
            'date' => 'Date',
            'title' => 'Event Title',
            'status' => 'Status',
            'action' => 'Actions'
        );
        
        $page = array();
        $page['content'] = $this->load->view('event/event-index', $inner, TRUE);
        $this->load->view($this->event, $page);
    }

    function event() {
        $this->load->model('Calendermodel');
        $franchisee = $this->Calendermodel->getEventUser($this->ids);
        $event = array();
        $count = 0;
        foreach ($franchisee as $row) {
            $url = base_url() . "booking/index/" . $row['event_id'];
            $row['start'] = strtotime(trim($row['event_start_ts'])) * 1000;
            $row['end'] = strtotime(trim($row['event_end_ts'])) * 1000;
            $row['time'] = 'From ' . date('d-m-Y h:m', strtotime(trim($row['event_start_ts']))) . ' till ' . date('d-m-Y h:m', strtotime(trim($row['event_end_ts'])));
            $event[$count] = array(
                "id" => $row['event_id'],
                "img" => $row['event_img'],
                "title" => $row['event_title'],
                "time" => $row['time'],
                "color" => $row['event_color'],
                "location" => $row['venue_name'],
                "class" => $row['event_type'],
                "url" => $url,
                "start" => $row['start'],
                "end" => $row['end']);
            $count ++;
        }
        $output = array();
        $output['success'] = 1;
        $output['result'] = $event;
        echo json_encode($output);
    }

    function add() {
        $this->load->model('Calendermodel');
        $this->load->library('form_validation');
        $this->load->helper('form');

        //event type
        $types = array();
        $types = $this->Calendermodel->getType();

        //locaton of event
        $venues = array();
        $venues = $this->Calendermodel->getVenues();
        
        $this->form_validation->set_rules('event_type_id', 'Event Type', 'trim|required');
        $this->form_validation->set_rules('eventdate', 'Event Date', 'trim|required');
        $this->form_validation->set_rules('event_title', 'Event Title', 'trim|required');
//        $this->form_validation->set_rules('category_id', 'Category', 'trim|required');
        $this->form_validation->set_rules('venue', 'Venues', 'trim|required');
//        $this->form_validation->set_rules('description', 'Description', 'trim|required');
//        $this->form_validation->set_rules('v_image', 'Event Image', 'trim|callback_valid_event_image');

        $this->form_validation->set_error_delimiters('<li>', '</li>');



        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $inner['types'] = $types;
//            $inner['categories'] = $categories;
            $inner['venues'] = $venues;
            $page['content'] = $this->load->view('event/event-add', $inner, TRUE);
            $this->load->view($this->event, $page);
        } else {
            $this->Calendermodel->insertRecord();
            $this->session->set_flashdata('SUCCESS', 'event_added');

            redirect("calender/index", 'location');
            exit();
        }
    }

    function edit($eid = false) {
//        ep($_POST);
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('Calendermodel');

        //event type
        $types = array();
        $types[''] = '-- Choose --';
        $ty = $this->Calendermodel->getType();
        foreach ($ty as $item) {
            $types[$item['event_type_id']] = $item['event_type'];
        }

        //get current event
        $event = array();
        $event = $this->Calendermodel->getEvent($eid);
        if (!$event) {
            $this->utility->show404();
            return;
        }

        //get event price
        $prices = array();
        $prices = $this->Calendermodel->getPrice($eid);


        //locaton of event
        $venues = array();
        $venues[''] = '-- Choose --';
        $ven = $this->Calendermodel->getVenues();
        foreach ($ven as $item) {
            $venues[$item['venue_id']] = $item['venue_name'];
        }

        $this->form_validation->set_rules('event_type_id', 'Event Type', 'trim|required');
        $this->form_validation->set_rules('eventdate', 'Event Date', 'trim|required');
        $this->form_validation->set_rules('event_title', 'Event Title', 'trim|required');
//        $this->form_validation->set_rules('category_id', 'Category', 'trim|required');
        $this->form_validation->set_rules('venue_id', 'Venues', 'trim|required');
//        $this->form_validation->set_rules('description', 'Description', 'trim|required');
//        $this->form_validation->set_rules('v_image', 'Event Image', 'trim|callback_valid_image');

        $this->form_validation->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $inner['prices'] = $prices;
            $inner['types'] = $types;
            $inner['event'] = $event;
            $inner['venues'] = $venues;
            $page['content'] = $this->load->view('event/event-edit', $inner, TRUE);
            $this->load->view($this->event, $page);
        } else {
            $this->Calendermodel->updateRecord($event);
            $this->session->set_flashdata('SUCCESS', 'event_updated');
            redirect("calender/index", 'location');
            exit();
        }
    }

    function dash() {
        $inner = array();
        $page = array();
        $page['content'] = $this->load->view('calender-index', $inner, TRUE);
        $this->load->view('themes/default/templates/calenderd', $page);
    }

    function complete($id) {
        $this->load->model('Calendermodel');
        $this->load->library('form_validation');
        $this->load->helper('form');
        //event type
        $types = $this->Calendermodel->getType();
        //locaton of event
        $venues = $this->Calendermodel->getVenues();
        //event category
//        $categories = $this->Calendermodel->getCategory();
        //current event
        $event = $this->Calendermodel->getEvent($id);
        $eventcomplete = $this->Calendermodel->getComEvent($id);
        $this->form_validation->set_rules('event_type_id', 'Event Type', 'trim|required');
        $this->form_validation->set_rules('eventdate', 'Event Date', 'trim|required');
        $this->form_validation->set_rules('event_title', 'Event Title', 'trim|required');
        $this->form_validation->set_rules('category_id', 'Category', 'trim|required');
        $this->form_validation->set_rules('venue', 'Venues', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('v_image', 'Event Image', 'trim|callback_valid_event_image');

        $this->form_validation->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $inner['types'] = $types;
//            $inner['categories'] = $categories;
            $inner['venues'] = $venues;
            $inner['event'] = $event;
            $inner['eventcomplete'] = $eventcomplete;
            $page['content'] = $this->load->view('event/complete', $inner, TRUE);
            $this->load->view($this->event, $page);
        } else {
//            $this->session->set_flashdata('SUCCESS', 'event_added');
            redirect("calender/index", 'location');
            exit();
        }
    }

    function delete($eid) {
        $this->load->model('Calendermodel');
        $status = $this->Calendermodel->eventDetele($eid);
        if ($status == true) {
            $this->session->set_flashdata('SUCCESS', 'event_deleted');
            redirect("calender/index", 'location');
            exit();
        }
    }

}

?>