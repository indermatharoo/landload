<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Units extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('calender/event');
        $this->load->model('user/Usermodel');
        $this->load->model('Unitsmodel');
        $this->load->model('properties/Propertiesmodel');
        $this->load->model('features/Featuresmodel');
        //$this->load->library('MY_Upload');
    }

    function index($offset = 0) {
        $this->load->library('pagination');
        ///Setup pagination
        $perpage = 10;
        $config['base_url'] = base_url() . "units/index/";
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->Unitsmodel->countAll();
        $config['per_page'] = $perpage;
        $this->pagination->initialize($config);


        $Listing = $this->Unitsmodel->listAll($offset, $perpage);
        $inner = array();
        $inner['labels'] = array(
            'pname' => 'Name',
            'area' => 'Area',
            'room' => 'Room',
            'bathroom' => 'Bathroom',
            'amount' => 'Amount',
            'owner' => 'Owner',
            'state' => 'State',
            0 => 'Action'
        );
        $inner['Listing'] = $Listing;

        $inner['pagination'] = $this->pagination->create_links();
        $page = array();
        //$inner['user'] = $this->getUser();
        $page['content'] = $this->load->view('units-index', $inner, true);
        $this->load->view('themes/default/templates/customer', $page);
    }

    function add() {
        if ($this->aauth->isAdmin()) {
            redirect(createUrl('units'));
        }
        $this->load->library('form_validation');
        $features = $this->Featuresmodel->getAllfeatures();
        $propertyList = $this->Propertiesmodel->getPropertiesList();

        //$unitsType = $this->Unitsmodel->getUnitType();
        
        $this->form_validation->set_rules('property_id', 'Property ', 'trim|required');
        $this->form_validation->set_rules('unit_number', 'Unite Number', 'trim|required');
        if (empty($_FILES['photo']['name'])) {
            $this->form_validation->set_rules('photo', 'photo', 'trim|required');
        }
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        $this->form_validation->set_rules('unit_type', 'Unit Type', 'trim|required');
//        $this->form_validation->set_rules('room', 'Room', 'trim|required|integer');
//        $this->form_validation->set_rules('bathroom', 'Bathroom', 'trim|required|integer');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|integer');
        $this->form_validation->set_rules('amount_type', 'Rent Type', 'trim|required|integer');
        //$this->form_validation->set_rules('description', 'Rent Type', 'trim|required|integer');

        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $inner['status'] = array('0' => 'Ocupied', '1' => 'Listed', '2' => 'Unlisted');
            $inner['features'] = $features;
            $inner['propertyList'] = $propertyList;
           // $inner['unitsType'] = $unitsType;
            $page = array();
            $page['content'] = $this->load->view('units-add', $inner, TRUE);
            $this->load->view($this->customer, $page);
        } else {
            
            $userid = $this->Unitsmodel->insertRecord();
            $this->session->set_flashdata('SUCCESS', 'unit_added');
            redirect(createUrl('units/index/'));
        }
    }

    function edit($offset) {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('string');
        $this->load->library('encrypt');
        $this->load->library('parser');
        $this->load->library('email');
        $features = $this->Featuresmodel->getAllfeatures();
        $unitsType = $this->Unitsmodel->getUnitType();
        $propertyList = $this->Propertiesmodel->getPropertiesList();
        $details = $this->Unitsmodel->getUnitDetails($offset);
        $images = $this->Unitsmodel->getUnitImages($offset);
       
        $this->form_validation->set_rules('property_id', 'Property Type', 'trim|required');
        $this->form_validation->set_rules('unit_number', 'Unit Name', 'trim|required');
//        if(empty($_FILES['photo']['name'])){
//            $this->form_validation->set_rules('photo', 'photo', 'trim|required');
//        }
        $this->form_validation->set_rules('unit_type', 'Unit Type', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        $this->form_validation->set_rules('area', 'Area', 'trim|required|integer');
        $this->form_validation->set_rules('room', 'Room', 'trim|required|integer');
        $this->form_validation->set_rules('bathroom', 'Bathroom', 'trim|required|integer');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|integer');

        $Countries = $this->Usermodel->getCountries();
        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $inner['status'] = array('0' => 'Ocupied', '1' => 'Listed', '2' => 'Unlisted');
            $inner['features'] = $features;
            $inner['images'] = $images;
            $inner['propertyList'] = $propertyList;
            $inner['details'] = $details;
            $inner['unitsType'] = $unitsType;
            $page = array();
            $page['content'] = $this->load->view('unit-edit', $inner, TRUE);
            $this->load->view($this->customer, $page);
        } else {

            $userid = $this->Unitsmodel->updateRecord($offset);

            $this->session->set_flashdata('SUCCESS', 'unit_updated');
            redirect(createUrl('units/index/'));
        }
    }

    function delete($id) {
        $this->Unitsmodel->DeleteRecord($id);
        $this->session->set_flashdata('SUCCESS', 'unit_deleted');
        redirect(createUrl('units/index/'));
    }

    function getunits() {
        $html = "";
        if ($this->input->post('unit_id') != NULL) {
            $res = $this->Unitsmodel->getUnitsByPropertyId($this->input->post('unit_id'));
            $html .= "<option >";

            $html .= "</option>";
            foreach ($res as $unit) {
                $html .= "<option value='" . $unit['id'] . "'>";
                $html .= $unit['unit_number'];
                $html .= "</option>";
            }
            echo $html;
            $html = "";
        }
    }

}
