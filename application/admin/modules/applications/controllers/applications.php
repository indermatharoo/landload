<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Applications extends Admin_Controller {

    function __construct() {
        parent::__construct();
//        $this->load->model('calender/event');
        $this->load->model('user/Usermodel');
        $this->load->model('Applicationsmodel');
        $this->load->model('properties/Propertiesmodel');
        $this->load->model('applicants/Applicantsmodel');
    }
    function index($offset=0)
    {
        $this->load->library('pagination');
                ///Setup pagination
        $perpage = 10;
        $config['base_url'] = base_url() . "applicants/index/";
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->Applicationsmodel->countAll();
        $config['per_page'] = $perpage;
        $this->pagination->initialize($config);
        
        $Listing = $this->Applicationsmodel->listAll($offset,$perpage);
        $inner = array();
                $inner['labels'] = array(
            'name' => 'Name',
            'Action' => 'Action',
       );
        $inner['Listing'] = $Listing;
        $inner['pagination'] = $this->pagination->create_links();
        $page = array();
        //$inner['user'] = $this->getUser();
        $page['content'] = $this->load->view('listing', $inner,true);
        $this->load->view('themes/default/templates/customer', $page);
        
    }
    public function valid_date($date )
    {
        if (strtotime(trim(date('m/d/Y ', strtotime($date)))) == strtotime($date)) 
        {
            return true;
        }
        else
        {
            $this->form_validation->set_message('valid_date', 
                           'The %s date is not valid it should match this (Y-m-d) format');
                    return false;
        }
    }
    function add()
    {
        
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('applicant_id', 'Applicant/Tenant', 'trim|required|integer');
        $this->form_validation->set_rules('property_id', 'Property', 'trim|required|integer');
        $this->form_validation->set_rules('lease_type', 'Lease Type', 'trim|required');
        $this->form_validation->set_rules('charges_frequence', 'Recurring Charges frequency', 'trim|required');
        $this->form_validation->set_rules('rental_amount', 'Rental Amount', 'trim|required|integer');
        $this->form_validation->set_rules('security_deposit_date', 'Security Deposit Date', 'trim|required|callback_valid_date');
       
        $this->form_validation->set_rules('application_status', 'Co-signer Detail', 'trim|required');
        $this->form_validation->set_rules('unit_id', 'Unit', 'trim|required|integer');
        $this->form_validation->set_rules('occupants', 'Occupants', 'trim|required|integer');
        $this->form_validation->set_rules('lease_from', 'Lease from', 'trim|required|callback_valid_date');
        $this->form_validation->set_rules('lease_to', 'Lease to', 'trim|required|callback_valid_date');
        $this->form_validation->set_rules('next_due', 'Next Due Date', 'trim|required|callback_valid_date');
        $this->form_validation->set_rules('security_amount', 'Security Amount', 'trim|required|integer');
        $this->form_validation->set_rules('emeregency_contact', 'Emergency Contact', 'trim|required');
        $this->form_validation->set_rules('notes', 'Notes', 'trim|required');
        
        
        

        $AllApplicants = $this->Applicantsmodel->getAllApplicants();
        $ApplicationType = $this->Applicationsmodel->getApplicationType();
        $propertiesList = $this->Propertiesmodel->getPropertiesList();
        $LeaseTypes = $this->Applicationsmodel->getLeaseTypes();
        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $inner['allApplicants'] = $AllApplicants;
            $inner['applicationType'] = $ApplicationType;
            $inner['propertiesList'] = $propertiesList;
            $inner['leaseTypes'] = $LeaseTypes;
            $page = array();
            $page['content'] = $this->load->view('application-add', $inner, TRUE);
            $this->load->view('themes/default/templates/customer', $page);
       } else {

            $userid = $this->Applicationsmodel->insertRecord();
            $this->session->set_flashdata('SUCCESS', 'application_added');
            redirect(createUrl('applications/index/'));
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
       

        $details = $this->Applicationsmodel->getApplicationDetails($offset);
        $AllApplicants = $this->Applicantsmodel->getAllApplicants();
        $ApplicationType = $this->Applicationsmodel->getApplicationType();
        $propertiesList = $this->Propertiesmodel->getPropertiesList();
        $LeaseTypes = $this->Applicationsmodel->getLeaseTypes();

        $this->form_validation->set_rules('applicant_id', 'Applicant/Tenant', 'trim|required|integer');
        $this->form_validation->set_rules('property_id', 'Property', 'trim|required|integer');
        $this->form_validation->set_rules('lease_type', 'Lease Type', 'trim|required');
        $this->form_validation->set_rules('charges_frequence', 'Recurring Charges frequency', 'trim|required');
        $this->form_validation->set_rules('rental_amount', 'Rental Amount', 'trim|required|integer');
        $this->form_validation->set_rules('security_deposit_date', 'Rental Amount', 'trim|required|callback_valid_date');
        $this->form_validation->set_rules('application_status', 'Co-signer Detail', 'trim|required');
        $this->form_validation->set_rules('unit_id', 'Unit', 'trim|required|integer');
        $this->form_validation->set_rules('occupants', 'Occupants', 'trim|required|integer');
        $this->form_validation->set_rules('lease_from', 'Lease from', 'trim|required|callback_valid_date');
        $this->form_validation->set_rules('lease_to', 'Lease to', 'trim|required|callback_valid_date');
        $this->form_validation->set_rules('next_due', 'Next Due Date', 'trim|required|callback_valid_date');
        $this->form_validation->set_rules('security_amount', 'Security Amount', 'trim|required|integer');
        $this->form_validation->set_rules('emeregency_contact', 'Emergency Contact', 'trim|required');
        $this->form_validation->set_rules('notes', 'Notes', 'trim|required');
        
        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $inner['details'] = $details;
            $inner['allApplicants'] = $AllApplicants;
            $inner['applicationType'] = $ApplicationType;
            $inner['propertiesList'] = $propertiesList;
            $inner['leaseTypes'] = $LeaseTypes;
            $page = array();
            $page['content'] = $this->load->view('application-edit', $inner, TRUE);
            $this->load->view($this->customer, $page);
        } else {
            
            $userid = $this->Applicationsmodel->updateRecord($offset);
            
            $this->session->set_flashdata('SUCCESS', 'application_updated');
            redirect(createUrl('applications/index/'));
        }

        
    }    
    function delete($id)
    {
     $this->Applicantsmodel->DeleteRecord($id);
     $this->session->set_flashdata('SUCCESS', 'application_deleted');
     redirect(createUrl('applications/index/'));
    }
    
}