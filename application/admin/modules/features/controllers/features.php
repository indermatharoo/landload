<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Features extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('calender/event');
        $this->load->model('user/Usermodel');
        $this->load->model('Featuresmodel');
        $this->load->model('properties/Propertiesmodel');
    }
    function index($offset=0)
    {
        $this->load->library('pagination');
                ///Setup pagination
        $perpage = 10;
        $config['base_url'] = base_url() . "features/index/";
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->Featuresmodel->countAll();
        $config['per_page'] = $perpage;
        $this->pagination->initialize($config);
        
        $Listing = $this->Featuresmodel->listAll($offset,$perpage);
        $inner = array();
                $inner['labels'] = array(
            'name' => 'Name',
            'Action' => 'Action',
       );
        $inner['Listing'] = $Listing;
        $inner['pagination'] = $this->pagination->create_links();
        $page = array();
        //$inner['user'] = $this->getUser();
        $page['content'] = $this->load->view('features-index', $inner,true);
        $this->load->view('themes/default/templates/customer', $page);
        
    }
    function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('feature', 'Feature', 'trim|required');


         
        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $page = array();
            $page['content'] = $this->load->view('features-add', $inner, TRUE);
            $this->load->view('themes/default/templates/customer', $page);
        } else {
            $userid = $this->Featuresmodel->insertRecord();
            $this->session->set_flashdata('SUCCESS', 'feature_added');
            redirect(createUrl('features/index/'));
        }
    }
    function edit($offset)
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('string');
        $this->load->library('encrypt');
        $this->load->library('parser');
        $this->load->library('email');
       

        $details = $this->Featuresmodel->getFeatureDetails($offset);
        $this->form_validation->set_rules('feature', 'Feature', 'trim|required');
        
        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $inner['details'] = $details;
            $page = array();
            $page['content'] = $this->load->view('features-edit', $inner, TRUE);
            $this->load->view($this->customer, $page);
        } else {
            
            $userid = $this->Featuresmodel->updateRecord($offset);
            
            $this->session->set_flashdata('SUCCESS', 'feature_updated');
            redirect(createUrl('features/index/'));
        }

        
    }    
    function delete($id)
    {
     $this->Featuresmodel->DeleteRecord($id);
     $this->session->set_flashdata('SUCCESS', 'feature_deleted');
     redirect(createUrl('features/index/'));
    }
}