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

    function index($offset = 0) {
        $this->load->library('pagination');
        ///Setup pagination
        $perpage = 10;
        $config['base_url'] = base_url() . "applicants/index/";
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->Applicationsmodel->countAll();
        $config['per_page'] = $perpage;
        $this->pagination->initialize($config);

        $Listing = $this->Applicationsmodel->listAll();
        
        $inner = array();
        $inner['labels'] = array(
            'name' => 'Name',
            'property' => 'Property',
            'compnay_name' => 'Company Name',
            'applied_date' => 'Applied Date',
            'Action' => 'Action',
        );
        $inner['Listing'] = $Listing;
        $inner['pagination'] = $this->pagination->create_links();
        $page = array();
        //$inner['user'] = $this->getUser();
        $page['content'] = $this->load->view('listing', $inner, true);
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

    function add() {


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

    function edit($offset) {


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

    function check_default($post_string) {
        return $post_string == '0' ? FALSE : TRUE;
    }

    function manage($id) {
//        echo '<pre>';
//        print_r($_POST);
//        exit;
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('string');
        $this->load->library('encrypt');
        $this->load->library('parser');
        $this->load->library('email');

        //$details = $this->Applicationsmodel->getApplicationDetails($id);
        
        $userDetail = $this->Applicationsmodel->getUserDetails($id);
        $ApplicationType = $this->Applicationsmodel->getApplicationType();
        $propertiesList = $this->Propertiesmodel->getPropertiesList();
          $applicantsType = $this->Applicantsmodel->getApplicantType();
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('current_job', 'Current Job', 'trim|required');
        $this->form_validation->set_rules('previous_job', 'Previous Job', 'trim|required');
        $this->form_validation->set_rules('experience', 'Experience', 'trim|required');
        $this->form_validation->set_rules('property', 'Property', 'trim|required');
        $this->form_validation->set_rules('lease_from', 'Applied Date', 'trim|required|callback_valid_date');
        $this->form_validation->set_rules('checkbox', 'Agree to Agreement', 'trim|required');
        $this->form_validation->set_rules('rent_amount', 'Amount', 'trim|required|integer');
        $this->form_validation->set_rules('security_amount', 'Security Amount', 'trim|required|integer');
        $this->form_validation->set_rules('ptype', 'Payment Type', 'required|callback_check_default');
        $this->form_validation->set_message('check_default', 'You need to select something other than the default');
        $this->form_validation->set_rules('refund', 'Refundable', 'trim|required');

        $days = array(
            'sunday'=>'Sunday',
            'monday'=>'Monday',
            'tuesday'=>'Tuesday',
            'wednesday'=>'Wednesday',
            'thursday'=>'Thursday',
            'friday'=>'Friday',
            'satureday'=>'Satureday'
            );
        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $inner['details'] = $userDetail;
            $inner['propertiesList'] = $propertiesList;
            $inner['applicationType'] = $ApplicationType;
            $inner['applicantsType'] = $applicantsType;
            $inner['days'] = $days;
            $inner['offset'] = $id;
            $page = array();
            $page['content'] = $this->load->view('application-manage', $inner, TRUE);
            $this->load->view($this->customer, $page);
        } else {

            $userid = $this->Applicationsmodel->updateRecord($offset);

            $this->session->set_flashdata('SUCCESS', 'application_updated');
            redirect(createUrl('applications/index/'));
        }
    }
    function user_details($offset)
    {
          $this->load->library('form_validation');
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
             if ($this->form_validation->run() == FALSE) {
                 echo json_encode(array('response'=>'false','msg'=>  validation_errors()));
             }
             else
             {
                 
                 $this->Applicationsmodel->saveUserDetails($offset);
             }
    }
    function job_details($offset)
    {
        $this->Applicationsmodel->saveJobDetails($offset);
    }
    function properties_details($offset)
    {
          $this->load->library('form_validation');
        $this->form_validation->set_rules('property_id', 'First Name', 'trim|required');
        $this->form_validation->set_rules('unit_id', 'Last Name', 'trim|required');
       
      if ($this->form_validation->run() == FALSE) {
                  echo json_encode(array('response'=>'false','msg'=>  validation_errors()));
             }
             else
             {
                 $this->Applicationsmodel->savePropertyDetails($offset);
             }        
    }
    function agree_details($offset)
    {
       $this->load->library('form_validation');
       $this->form_validation->set_rules('agree', 'Agree to Agreement', 'trim|required');
       $this->form_validation->set_rules('rent_amount', 'Rent Amount', 'trim|required|integer');
       $this->form_validation->set_rules('security_amount', 'Security Amount', 'trim|required|integer');
       $this->form_validation->set_rules('ptype', 'Payment Amount', 'trim|required');
       $this->form_validation->set_rules('refund', 'Refund Amount', 'trim|required');
       if($this->input->post('ptype')=="M")
       {
           $this->form_validation->set_rules('date_of_month', 'Day Of Month', 'trim|required|callback_valid_date');
       }
      if ($this->form_validation->run() == FALSE) {
                   echo json_encode(array('response'=>'false','msg'=>  validation_errors()));
             }
             else
             {
                 $this->Applicationsmodel->saveAgreeDetails($offset);
             }        
    }   
    function upload_document($id)
    {
        $this->load->library('form_validation');
        echo "<pre>";
        print_r($_FILES);
        foreach($_FILES['document']['name'] as $file)
        {
            if(trim($file)=="")
            {
              $this->session->set_flashdata('ERROR', 'required_document');
               redirect(createUrl('applications/manage/'.$id));
            }
        }
    }
    function delete($id) {
        $this->Applicationsmodel->DeleteRecord($id);
        $this->session->set_flashdata('SUCCESS', 'application_deleted');
        redirect(createUrl('applications/index/'));
    }
    
}
