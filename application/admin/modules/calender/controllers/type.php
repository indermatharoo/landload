<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Type extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->is_admin_protected = TRUE;
        isLogged();
        $this->load->model('user/usermodel');
    }

    //*************************************validation End********************************
    //function index
    function index() {
        $this->load->model('Typemodel');

        $type = array();
        $type = $this->Typemodel->indentedList();
//       ep($categories);

        $inner = array();

        $inner['type'] = $type;

        $page = array();
        $page['content'] = $this->load->view('type/type-index', $inner, TRUE);
        $this->load->view($this->event, $page);
    }

    //function add
    function add() {
        $this->load->model('Typemodel');
        $this->load->library('form_validation');
        $this->load->helper('form');



        //validation check
        $this->form_validation->set_rules('event_type', 'Event Type', 'trim|required');
        $this->form_validation->set_rules('event_color', 'Event Color', 'trim');
        $this->form_validation->set_error_delimiters('<li>', '</li>');



        if ($this->form_validation->run() == FALSE) {
            $inner = array();

            $page = array();
            $page['content'] = $this->load->view('type/type-add', $inner, TRUE);
            $this->load->view($this->event, $page);
        } else {
            $this->Typemodel->insertRecord();
            $this->session->set_flashdata('SUCCESS', 'type_added');
            redirect("calender/type/index", 'location');
            exit();
        }
    }

    //function edit
    function edit($tid = false) {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('Typemodel');

        //get category detail 
        $current_type = array();
        $current_type = $this->Typemodel->getdetails($tid);

        if (!$current_type) {
            $this->utility->show404();
            return;
        }

        //validation check
        $this->form_validation->set_rules('event_type', 'Event Type', 'trim|required');
        $this->form_validation->set_rules('event_color', 'Event Color', 'trim');
        $this->form_validation->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $page = array();
            $inner['current_type'] = $current_type;
            $page['content'] = $this->load->view('type/type-edit', $inner, TRUE);
            $this->load->view($this->event, $page);
        } else {
            $this->Typemodel->updateRecord($current_type);
            $this->session->set_flashdata('SUCCESS', 'type_updated');
            redirect("calender/type/index", 'location');
            exit();
        }
    }

    function disable($tid = false) {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('Typemodel');

        //get category detail 
        $current_type = array();
        $current_type = $this->Typemodel->getdetails($tid);
        if (!$current_type) {
            $this->utility->show404();
            return;
        }

        $this->Typemodel->disableRecord($current_type);

        $this->session->set_flashdata('SUCCESS', 'type_updated');

        redirect("calender/type/index/");
        exit();
    }

    function enable($tid = false) {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('Typemodel');

        //get category detail 
        $current_type = array();
        $current_type = $this->Typemodel->getdetails($tid);
        if (!$current_type) {
            $this->utility->show404();
            return;
        }

        $this->Typemodel->enableRecord($current_type);

        $this->session->set_flashdata('SUCCESS', 'type_updated');

        redirect("calender/type/index/");
        exit();
    }

    //function delete
    function delete($tid = false) {
        $this->load->model('Typemodel');
        $this->load->library('form_validation');
        $this->load->helper('form');

        //get category detail 
        $current_type = array();
        $current_type = $this->Typemodel->getdetails($tid);
        if (!$current_type) {
            $this->utility->show404();
            return;
        }

        $this->Typemodel->deleteCategory($current_type);
        $this->session->set_flashdata('SUCCESS', 'type_deleted');
        redirect('calender/type/index/');
        exit();
    }

}

?>