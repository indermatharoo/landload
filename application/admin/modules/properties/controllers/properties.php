<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Properties extends Admin_Controller {

    function __construct() {
        parent::__construct();
       // $this->load->model('calender/event');
        $this->load->model('user/Usermodel');
        $this->load->model('Propertiesmodel');
    }

    function index($offset = 0) {
        $this->load->library('pagination');
        ///Setup pagination
        $perpage = 10;
        $config['base_url'] = base_url() . "properties/index/";
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->Propertiesmodel->countAll();
        $config['per_page'] = $perpage;
        $this->pagination->initialize($config);

        $Listing = $this->Propertiesmodel->listAll($offset, $perpage);
        $inner = array();
        $inner['labels'] = array(
            'property_name' => 'Property Name',
            'property_type' => 'Property Type',
            'units' => 'Units',
            'owner' => 'Owner',
            'street' => 'Street',
            'action' => 'Action',
        );
        $inner['Listing'] = $Listing;
        $inner['pagination'] = $this->pagination->create_links();
        $page = array();
        //$inner['user'] = $this->getUser();
        $page['content'] = $this->load->view('properties-index', $inner, true);
        $this->load->view('themes/default/templates/customer', $page);
    }

    function add() {
        if ($this->aauth->isAdmin()) {
            redirect(createUrl('properties'));
        }
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('string');
        $this->load->library('encrypt');
        $this->load->library('parser');
        $this->load->library('email');

        $propertiesType = $this->Propertiesmodel->getPropertiesType();

        $this->form_validation->set_rules('pname', 'Name', 'trim|required');
        $this->form_validation->set_rules('ptype', 'Property Type', 'trim|required');
        $this->form_validation->set_rules('units', 'Number of units', 'trim|required|integer');
        if (empty($_FILES['photo']['name'])) {
            $this->form_validation->set_rules('photo', 'photo', 'trim|required');
        }
        $this->form_validation->set_rules('owner', 'Owner', 'trim|required');
        //
        $this->form_validation->set_rules('street', 'County', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('postcode', 'Post Code', 'trim|required');
        //$this->form_validation->set_rules('country', 'Country', 'trim|required');
        
        $Countries = $this->Usermodel->getCountries();
        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $inner['propertiesType'] = $propertiesType;
            $inner['country'] = $Countries;
            $page = array();
            $page['content'] = $this->load->view('property-add', $inner, TRUE);
            $this->load->view($this->customer, $page);
        } else {
            $userid = $this->Propertiesmodel->insertRecord();
            $this->session->set_flashdata('SUCCESS', 'property_added');
            redirect(createUrl('properties/index/'));
        }
    }

    function edit($offset) {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('string');
        $this->load->library('encrypt');
        $this->load->library('parser');
        $this->load->library('email');

        $propertiesType = $this->Propertiesmodel->getPropertiesType();

        $details = $this->Propertiesmodel->getPropertDetails($offset);
        $this->form_validation->set_rules('pname', 'Name', 'trim|required');
        $this->form_validation->set_rules('ptype', 'Property Type', 'trim|required');
        $this->form_validation->set_rules('units', 'Unit name', 'trim|required|integer');
        $this->form_validation->set_rules('owner', 'Owner', 'trim|required');
        
        $this->form_validation->set_rules('street', 'Street', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        
        $this->form_validation->set_rules('postcode', 'Post Code', 'trim|required');
        

        $Countries = $this->Usermodel->getCountries();
        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $inner['propertiesType'] = $propertiesType;
            $inner['country'] = $Countries;
            $inner['details'] = $details;
            $page = array();
            $page['content'] = $this->load->view('property-edit', $inner, TRUE);
            $this->load->view($this->customer, $page);
        } else {

            $userid = $this->Propertiesmodel->updateRecord($offset);

            $this->session->set_flashdata('SUCCESS', 'property_updated');
            redirect(createUrl('properties/index/'));
        }
    }

    function delete($id) {
        $this->Propertiesmodel->DeleteRecord($id);
        $this->session->set_flashdata('SUCCESS', 'property_deleted');
        redirect(createUrl('properties/index/'));
    }

}
