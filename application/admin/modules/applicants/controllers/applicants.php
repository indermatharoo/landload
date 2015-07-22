<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Applicants extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('calender/event');
        $this->load->model('user/Usermodel');
        $this->load->model('Applicantsmodel');
        $this->load->model('properties/Propertiesmodel');
    }

    function index($offset = 0) {
        $this->load->library('pagination');
        ///Setup pagination
        $perpage = 10;
        $config['base_url'] = base_url() . "applicants/index/";
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->Applicantsmodel->countAll($this->ids,'app');
        $config['per_page'] = $perpage;
        $this->pagination->initialize($config);

        $Listing = $this->Applicantsmodel->listAll($this->ids,'app');
        $inner = array();
        $inner['labels'] = array(
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'phone',
            'birthdate' => 'birthdate',
            'license' => 'license',
            'monthly_gross' => 'monthly_gross',
            'Action' => 'Action',
        );
        $inner['Listing'] = $Listing;
        $inner['pagination'] = $this->pagination->create_links();
        $page = array();
        //$inner['user'] = $this->getUser();
        $page['content'] = $this->load->view('listing', $inner, true);
        $this->load->view('themes/default/templates/customer', $page);
    }
    public function tenants()
    {
        
        $this->load->library('pagination');
        ///Setup pagination
        $perpage = 10;
        $config['base_url'] = base_url() . "applicants/index/";
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->Applicantsmodel->countAll($this->ids,'tnt');
        $config['per_page'] = $perpage;
        $this->pagination->initialize($config);

        $Listing = $this->Applicantsmodel->listAll($this->ids,"tnt");
        $inner = array();
        $inner['labels'] = array(
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'phone',
            'birthdate' => 'birthdate',
            'license' => 'license',
            'monthly_gross' => 'monthly_gross',
            'Action' => 'Action',
        );
        $inner['Listing'] = $Listing;
        $inner['pagination'] = $this->pagination->create_links();
        $page = array();
        //$inner['user'] = $this->getUser();
        $page['content'] = $this->load->view('tenants_listing', $inner, true);
        $this->load->view('themes/default/templates/customer', $page);
    }
    public function valid_date($date) {
        if (strtotime(trim(date('m/d/Y ', strtotime($date)))) == strtotime($date)) {
            return true;
        } else {
            $this->form_validation->set_message('valid_date', 'The %s date is not valid it should match this (Y-m-d) format');
            return false;
        }
    }

    function add($offset = "") {
        if($offset=="" || !in_array($offset,array('app','tnt')))
        {
          redirect('applicants');
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('fname', 'First name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
        $this->form_validation->set_rules('birth_date', 'Birth date', 'trim|required|callback_valid_date');
        if (trim($this->input->post('additional_income')) != "") {
            $this->form_validation->set_rules('additional_income', 'Additional Income', 'trim|required|integer');
        }
        $this->form_validation->set_rules('license', 'Driving License Number', 'trim|required');
        $this->form_validation->set_rules('monthly_gross', 'Monthly Gross', 'trim|required|integer');
//        $this->form_validation->set_rules('assets', 'Assets', 'trim|required|integer');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        $this->form_validation->set_rules('passwd', 'password', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('conpasswd', 'confirm password', 'trim|required|matches[passwd]');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        // get applicant type

        $applicantsType = $this->Applicantsmodel->getApplicantType();


        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $inner['applicantsType'] = $applicantsType;
            $inner['postdata'] = $_POST;
            $inner['offset'] = $offset;
            $page = array();
            $page['content'] = $this->load->view('applicant-add', $inner, TRUE);
            $this->load->view('themes/default/templates/customer', $page);
        } else {

            $userid = $this->Applicantsmodel->insertRecord();
            $this->session->set_flashdata('SUCCESS', 'applicant_added');
            redirect(createUrl('applicants/index/'));
        }
    }

    function edit($offset) {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('string');
        $this->load->library('encrypt');
        $this->load->library('parser');
        $this->load->library('email');


        $details = $this->Applicantsmodel->getApplicantDetails($offset);
        $applicantsType = $this->Applicantsmodel->getApplicantType();
        $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('fname', 'First name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
        $this->form_validation->set_rules('birth_date', 'Birth date', 'trim|required|callback_valid_date');
        if (trim($this->input->post('additional_income')) != "") {

            $this->form_validation->set_rules('additional_income', 'Additional Income', 'trim|required|integer');
        }
        if (trim($this->input->post('passwd')) != "") {

            $this->form_validation->set_rules('conpasswd', 'confirm password', 'trim|required|matches[passwd]');
        }

        $this->form_validation->set_rules('license', 'Driving License Number', 'trim|required');
        $this->form_validation->set_rules('monthly_gross', 'Monthly Gross', 'trim|required|integer');
//        $this->form_validation->set_rules('assets', 'Assets', 'trim|required|integer');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        $this->form_validation->set_rules('address', 'Address', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $inner['details'] = $details;
            $inner['applicantsType'] = $applicantsType;
            $page = array();
            $page['content'] = $this->load->view('applicant-edit', $inner, TRUE);
            $this->load->view($this->customer, $page);
        } else {

            $userid = $this->Applicantsmodel->updateRecord($offset);

            $this->session->set_flashdata('SUCCESS', 'applicant_updated');
            redirect(createUrl('applicants/index/'));
        }
    }

    function delete($id) {
        $this->Applicantsmodel->DeleteRecord($id);
        $this->session->set_flashdata('SUCCESS', 'applicant_deleted');
        redirect(createUrl('applicants/index/'));
    }

}
