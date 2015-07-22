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
        $config['total_rows'] = $this->Applicationsmodel->countAll($this->ids);
        $config['per_page'] = $perpage;
        $this->pagination->initialize($config);

        $Listing = $this->Applicationsmodel->listAll($this->ids);

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
        if (trim($id) == "") {
            redirect('applications/index');
        }
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
        $uploadedDocuments = $this->Applicationsmodel->getUploadedDocuments($userDetail['applicant_id']);

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
            'sunday' => 'Sunday',
            'monday' => 'Monday',
            'tuesday' => 'Tuesday',
            'wednesday' => 'Wednesday',
            'thursday' => 'Thursday',
            'friday' => 'Friday',
            'satureday' => 'Satureday'
        );
        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $inner['details'] = $userDetail;
            $inner['propertiesList'] = $propertiesList;
            $inner['applicationType'] = $ApplicationType;
            $inner['applicantsType'] = $applicantsType;
            $inner['uploadedDocuments'] = $uploadedDocuments;
            $inner['days'] = $days;
            $inner['offset'] = $id;
            $page = array();
            $page['content'] = $this->load->view('application-manage', $inner, TRUE);
            $this->load->view($this->customer, $page);
        } else {

            $unit_id = $this->Applicationsmodel->updateRecord($offset);
            e($unit_id);

            $this->session->set_flashdata('SUCCESS', 'application_updated');
            redirect(createUrl('applications/index/'));
        }
    }

    function user_details($offset) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('response' => 'false', 'msg' => validation_errors()));
        } else {

            $this->Applicationsmodel->saveUserDetails($offset);
        }
    }

    function job_details($offset = "") {
        $this->Applicationsmodel->saveJobDetails($offset);
    }

    function properties_details($offset) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('property_id', 'First Name', 'trim|required');
        $this->form_validation->set_rules('unit_id', 'Last Name', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('response' => 'false', 'msg' => validation_errors()));
        } else {
            $this->Applicationsmodel->savePropertyDetails($offset);
        }
    }

    function checkPrice($value) {
        if (is_numeric($value)) {
            return true;
        } else {
            $this->form_validation->set_message('checkPrice', 'Rent Amount Must Be A Numeric');
            return false;
        }
    }

    function agree_details($offset) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('agree', 'Agree to Agreement', 'trim|required');
        $this->form_validation->set_rules('rent_amount', 'Rent Amount', 'trim|required|callback_checkPrice');
        $this->form_validation->set_rules('security_amount', 'Security Amount', 'trim|required|integer');
        $this->form_validation->set_rules('ptype', 'Payment Amount', 'trim|required');
        $this->form_validation->set_rules('refund', 'Refund Amount', 'trim|required');
        if ($this->input->post('ptype') == "M") {
            $this->form_validation->set_rules('date_of_month', 'Day Of Month', 'trim|required|callback_valid_date');
        }
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('response' => 'false', 'msg' => validation_errors()));
        } else {
            $this->Applicationsmodel->saveAgreeDetails($offset);
            $this->Applicationsmodel->updateUnit($offset);
        }
    }

    function upload_document($id, $appID) {

        $this->load->library('form_validation');
        $this->load->model('virtcab/VirtualCabinetmodel');

        $allowedTypes = array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'txt' => 'text/plain',
            'rtf' => 'application/rtf',
            'rtf' => 'application/x-rtf',
            'rtf' => 'text/richtext',
            'doc' => 'application/msword',
            'pdf' => 'application/pdf',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'ppsx' => 'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'sldx' => 'application/vnd.openxmlformats-officedocument.presentationml.slide',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'mp4' => 'video/mp4',
            'oog' => 'video/ogg',
            'flv' => 'video/flv'
        );
        $currentUserId = curUsrId();
        $this->load->library('upload');
        $this->upload->initialize(array(
            "upload_path" => $this->config->item('UPLOAD_PATH_VIRCAB_IMG'),
            'allowed_types' => 'gif|jpg|png'
        ));
        if ($this->input->post('deal') != NULL) {
            $this->db->where('id', $appID);
            $this->db->update('applications', array('is_deal_start' => $this->input->post('deal')));
        }
        if ($this->upload->do_multi_upload("document")) {
            //Print data for all uploaded files.

            $userId = $this->session->userdata['id'];
            foreach ($this->upload->get_multi_upload_data() as $images) {
                $ext = strtolower(end(explode('.', $images['file_name'])));
                $data = array();
                $data[$this->VirtualCabinetmodel->visible_name] = $images['file_name'];
                $data[$this->VirtualCabinetmodel->filetype] = $ext;
                $data[$this->VirtualCabinetmodel->assigne_grp] = 6;
                $data[$this->VirtualCabinetmodel->actual_name] = $images['client_name'];
                $data[$this->VirtualCabinetmodel->update_dtime] = date('Y-m-d H:i:s');
                $data[$this->VirtualCabinetmodel->create_dtime] = date('Y-m-d H:i:s');
                $data[$this->VirtualCabinetmodel->assignes] = $id;
                $data[$this->VirtualCabinetmodel->creator_id] = $userId;
                $data['is_applicant'] = 1;
                $virtual_event_id = $this->VirtualCabinetmodel->insertRecord($data, true);
            }
        }
        $getApplication = $this->commonmodel->getByPk($appID, 'dpd_applications');
        if (arrIndex($getApplication, 'is_deal_start')) {
            self::saveInvoices($getApplication);
        } else {
            e(2);
        }
        e('end');
        redirect(createUrl('applications/index/'));
    }

    function saveInvoices($application) {
        $type = arrIndex($application, 'invoice_type');
//        $type = 'M';
        $amount = arrIndex($application, 'invoice_amount');
        $day = arrIndex($application, 'day_of_week');
        if ($day)
            $day = strtolower($day);
        $month = arrIndex($application, 'date_of_month');
//        $month = '2015-07-22';
        $startdate = arrIndex($application, 'startdate');
        $enddateTemp = new DateTime($startdate);
        $enddateTemp->add(new DateInterval('P1Y'));
        switch ($type):
            case 'W':
                $enddateTemp->sub(new DateInterval('P1W'));
                break;
            case 'M':
                $enddateTemp->sub(new DateInterval('P1M'));
                break;
        endswitch;
//        e($enddateTemp);
        $enddate = $enddateTemp->format('Y-m-d');
        while ($startdate <= $enddate):
            $temp = new DateTime($startdate);
            $interval = null;
            switch ($type):
                case 'W':
                    $temp->modify('next ' . $day);
                    $startdate = $temp->format('Y-m-d');
                    $temp->add(new DateInterval('P5D'));
                    $duedate = $temp->format('Y-m-d');
                    break;
                case 'M':
                    if ($startdate < $month):
                        $temp = new DateTime($month);
                        $startdate = $temp->format('Y-m-d');
                        $temp->add(new DateInterval('P5D'));
                        $duedate = $temp->format('Y-m-d');
                    else:
                        $temp = new DateTime($startdate);
                        $temp->add(new DateInterval('P1M'));
                        $startdate = $temp->format('Y-m-d');
                        $temp->add(new DateInterval('P5D'));
                        $duedate = $temp->format('Y-m-d');
                    endif;
                    break;
            endswitch;
            self::addInvoice(array(
                'application_id' => arrIndex($application, 'id'),
                'applicant_id' => arrIndex($application, 'applicant_id'),
                'company_id' => arrIndex($application, 'company_id'),
                'installment_fees' => arrIndex($application, 'rent_amount'),
                'vat' => '20',
                'total_amount' => arrIndex($application, 'rent_amount') + (arrIndex($application, 'rent_amount') * .20),
                'invoice_code' => '0',
                'created_on' => $startdate,
                'due_on' => $duedate,
                'invoice_type' => $type,
                'paid_on' => '0000-00-00 00:00:00',
                'is_paid' => '0'
            ));
        endwhile;
        e('end');
    }

    function addInvoice($attributes = array()) {
        //e($data);
        return $this->db->insert('invoice_new', $attributes);
    }

    function delete($id) {
        $this->Applicationsmodel->DeleteRecord($id);
        $this->session->set_flashdata('SUCCESS', 'application_deleted');
        redirect(createUrl('applications/index/'));
    }

}
