<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Venues extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->is_admin_protected = TRUE;
        isLogged();
        $this->load->model('user/usermodel');
    }

//**************************************validation start*********************
//validation for add valid image
    function valid_image($str) {
        if (!isset($_FILES['image']) || $_FILES['image']['size'] == 0 || $_FILES['image']['error'] != UPLOAD_ERR_OK) {
            $this->form_validation->set_message('valid_image', 'Image not uploaded');
            return FALSE;
        }
        $imginfo = @getimagesize($_FILES['image']['tmp_name']);

        if (!($imginfo[2] == 1 || $imginfo[2] == 2 || $imginfo[2] == 3 )) {
            $this->form_validation->set_message('valid_image', 'Only GIF, JPG and PNG Images are accepted');
            return FALSE;
        }
        return TRUE;
    }

//*************************************validation End********************************
//function index
    function index() {
        $this->load->model('Venuemodel');

        $venues = array();
        $venues = $this->Venuemodel->indentedList($this->ids);

        $inner = array();
        $inner['venues'] = $venues;
        $inner['labels'] = array(
            'name' => 'Name',
            'action' => 'Actions'
        );

        $page = array();
        $page['content'] = $this->load->view('venues/venues-index', $inner, TRUE);

        $this->load->view($this->event, $page);
    }

    function view($id) {
        $inner = $page = array();
        $this->load->model('Venuemodel');
        $inner['model'] = $this->Venuemodel->getVenue($id);        
        $page['content'] = $this->load->view('venues/venues-view', $inner, TRUE);
        $this->load->view($this->event, $page);
    }

    //function add
    function add() {
        $this->load->model('Venuemodel');
        $this->load->library('form_validation');
        $this->load->helper('form');


        $this->form_validation->set_rules('venue_name', 'Venue name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone No.', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('postcode', 'Postal Code', 'trim|required');


        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('v_image', 'Venue Image', 'trim|callback_valid_image');

        $this->form_validation->set_error_delimiters('<li>', '</li>');


        if ($this->form_validation->run() == FALSE) {
            $inner = array();

            $page = array();
            $page['content'] = $this->load->view('venues/venues-add', $inner, TRUE);
            $this->load->view($this->event, $page);
        } else {
            $this->Venuemodel->insertRecord();
            $this->session->set_flashdata('SUCCESS', 'venue_added');
            redirect("calender/venues/index", 'location');
            exit();
        }
    }

    //function edit
    function edit($vid = false) {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('Venuemodel');

        //get category detail 
        $vanue = array();
        $vanue = $this->Venuemodel->getVenue($vid);
//        ep($vanue);
        //validation check
        $this->form_validation->set_rules('venue_name', 'Venue name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone No.', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('postcode', 'Postal Code', 'trim|required');


        $this->form_validation->set_rules('description', 'Description', 'trim|required');

        $this->form_validation->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $page = array();
            $inner['vanue'] = $vanue;
            $page['content'] = $this->load->view('venues/venues-edit', $inner, TRUE);
            $this->load->view($this->event, $page);
        } else {
            $this->Venuemodel->updateRecord($vanue);
            $this->session->set_flashdata('SUCCESS', 'venue_updated');
            redirect("calender/venues/index", 'location');
            exit();
        }
    }

    function disable($cid = false) {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('Categorymodel');

        //get category detail 
        $current_category = array();
        $current_category = $this->Venuemodel->getdetails($cid);
        if (!$current_category) {
            $this->utility->show404();
            return;
        }

        $this->Venuemodel->disableRecord($current_category);

        $this->session->set_flashdata('SUCCESS', 'venue_updated');

        redirect("calender/venues/index/");
        exit();
    }

    //function delete
    function delete($vid) {
        $this->load->model('Venuemodel');
        $status = $this->Venuemodel->vanueDetele($vid);
        if ($status == true) {
            $this->session->set_flashdata('SUCCESS', 'venue_deleted');
            redirect("calender/venues", 'location');
            exit();
        }
    }

}

?>