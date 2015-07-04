<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact extends Cms_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Enquirymodel');
        $this->load->model('cms/pagemodel');
    }

    function index($enqId = null) {

        $enq_type = $this->input->get('type', TRUE);

        $enqId = intval($enqId);
        if ($enqId) {
            $eventDetail = $this->Enquirymodel->getEvent($enqId);
            if (empty($eventDetail) || !$eventDetail) {
                $this->session->set_flashdata('INFO', 'event_not_exist');
                redirect('contact');
            }
        }

        $this->load->model('cms/Pagemodel');
        $this->load->model('cms/Widgetmodel');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('parser');
        $this->load->helper('form');
        $this->load->helper('text');
        $this->load->model('news/Newsmodel');
        $this->load->model('franchisee/Franchiseemodel');



        $news = array();
        $news = $this->Newsmodel->listAll(0, 2);
        //Get Page Details
        $page = array();
        //$page = $this->Pagemodel->getDetails('contact-us');
//        if (!$page) {
//            $this->utility->show404();
//            return;
//        }
//
//        $this->setPage($page);

        $breadcrumbs = array();
//        $breadcrumbs = $this->Pagemodel->breadcrumbs($page['page_id']);
        //validation check
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email_addr', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('tel_number', 'Telephone', 'trim|required');
        $this->form_validation->set_rules('post_code', 'Postcode', 'trim|required');
        $this->form_validation->set_rules('enq_reason', 'Enquiry', 'trim');
        $this->form_validation->set_rules('receive_update_news', 'New Updates', 'trim');
        $this->form_validation->set_rules('how_reach', 'How you reach', 'trim');

        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $inner = array();
        $shell = array();
        $inner['news'] = $news;

        if ($this->form_validation->run() == FALSE) {
            $block_alias = array('"address"');
            $compiled_blocks = $this->pagemodel->getGlobalUnassignBlocks($block_alias);

            $compiledblocks = array();
            foreach ($compiled_blocks as $key => $val) {
                $compiledblocks[] = $val;
                $inner[$key] = $val;
            }

            $inner['page'] = $page;
            $inner['breadcrumbs'] = $breadcrumbs;
            $inner['compiledblocks'] = $compiledblocks;
            $inner['page']['page_title'] = 'ENQUIRY ONLINE';
            if ($enqId) {
                $inner['eventDetail'] = $eventDetail;
                $inner['page']['page_contents'] = $this->load->view('enquiry-form', $inner, true);
            } else {
                $inner['enquiryList'] = $this->Enquirymodel->getEnquiryTypeList();
                $inner['page']['page_contents'] = $this->load->view('contact-form', $inner, true);
            }
            $shell = $inner;
            $this->load->view("themes/" . THEME . "/templates/pages", $shell);
        } else {
            $data = $this->Enquirymodel->insertRecord();
            if ($data) {
                $this->session->set_flashdata('SUCCESS', 'enquiry_insert');
            } else {
                $this->session->set_flashdata('ERROR', 'enquiry_insert_error');
            }
            redirect('/contact');
            exit();
        }
    }

    function franchiseenquiry($franchise_id = null) {
        if (!$franchise_id)
            redirect('contact');
        $this->load->model('cms/Pagemodel');
        $this->load->model('cms/Widgetmodel');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('parser');
        $this->load->helper('form');
        $this->load->helper('text');
        $this->load->model('news/Newsmodel');
        $this->load->model('franchisee/Franchiseemodel');



        $news = array();
        $news = $this->Newsmodel->listAll(0, 2);
        //Get Page Details
        $page = array();
        //$page = $this->Pagemodel->getDetails('contact-us');
//        if (!$page) {
//            $this->utility->show404();
//            return;
//        }
//
//        $this->setPage($page);

        $breadcrumbs = array();
//        $breadcrumbs = $this->Pagemodel->breadcrumbs($page['page_id']);
        //validation check
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email_addr', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('tel_number', 'Telephone', 'trim|required');
        $this->form_validation->set_rules('post_code', 'Postcode', 'trim|required');
        $this->form_validation->set_rules('enq_reason', 'Enquiry', 'trim');
        $this->form_validation->set_rules('receive_update_news', 'New Updates', 'trim');
        $this->form_validation->set_rules('how_reach', 'How you reach', 'trim');

        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $inner = array();
        $shell = array();
        $inner['news'] = $news;

        if ($this->form_validation->run() == FALSE) {
            $inner['page'] = $page;
            $inner['breadcrumbs'] = $breadcrumbs;
            $inner['compiledblocks'] = array(0 => '');
            $inner['page']['page_title'] = 'ENQUIRY ONLINE';
            $inner['franchise_id'] = $franchise_id;
            $inner['enquiryList'] = $this->Enquirymodel->getEnquiryTypeList();
            $inner['page']['page_contents'] = $this->load->view('franchise-form', $inner, true);
            $shell = $inner;
            $this->load->view("themes/" . THEME . "/templates/pages", $shell);
        } else {
//            gAParams();
            $data = $this->Enquirymodel->insertFranchiseRecord();
            if ($data) {
                $this->session->set_flashdata('SUCCESS', 'enquiry_insert');
            } else {
                $this->session->set_flashdata('ERROR', 'enquiry_insert_error');
            }
            redirect('/contact');
            exit();
        }
    }

    function eventenquiry($event_id = null) {
        if (!$event_id)
            redirect('contact');
        $this->load->model('cms/Pagemodel');
        $this->load->model('cms/Widgetmodel');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('parser');
        $this->load->helper('form');
        $this->load->helper('text');
        $this->load->model('news/Newsmodel');
        $this->load->model('franchisee/Franchiseemodel');



        $news = array();
        $news = $this->Newsmodel->listAll(0, 2);
        //Get Page Details
        $page = array();
        $breadcrumbs = array();
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email_addr', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('tel_number', 'Telephone', 'trim|required');
        $this->form_validation->set_rules('post_code', 'Postcode', 'trim|required');
        $this->form_validation->set_rules('enq_reason', 'Enquiry', 'trim');
        $this->form_validation->set_rules('receive_update_news', 'New Updates', 'trim');
        $this->form_validation->set_rules('how_reach', 'How you reach', 'trim');

        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $inner = array();
        $shell = array();
        $inner['news'] = $news;




        if ($this->form_validation->run() == FALSE) {
            $inner['page'] = $page;
            $inner['breadcrumbs'] = $breadcrumbs;
            $inner['compiledblocks'] = array(0 => '');
            $inner['page']['page_title'] = 'ENQUIRY ONLINE';
            $inner['franchise_id'] = $franchise_id;
            $inner['enquiryList'] = $this->Enquirymodel->getEnquiryTypeList();
            $inner['page']['page_contents'] = $this->load->view('event-enquiry', $inner, true);
            $shell = $inner;
            $this->load->view("themes/" . THEME . "/templates/pages", $shell);
        } else {
//            gAParams();
            $data = $this->Enquirymodel->insertFranchiseRecord();
            if ($data) {
                $this->session->set_flashdata('SUCCESS', 'enquiry_insert');
            } else {
                $this->session->set_flashdata('ERROR', 'enquiry_insert_error');
            }
            redirect('/contact');
            exit();
        }
    }

    function download() {

        $this->load->library('form_validation');
        $this->load->library('email');

//if(){}

        $validation = "";
        if (trim($this->input->post('yourname', TRUE)) == "") {
            $validation .= "#nameLabel ,";
        }
        if ($this->_check_phone($this->input->post('yournumber', TRUE)) != '1') {
            $validation .= "#numberLabel ,";
        }
        if (filter_var($this->input->post('youremail', TRUE), FILTER_VALIDATE_EMAIL) === false) {
            $validation .= "#emailValid ,";
        }


        if ($validation != "") {
            $validation = substr($validation, 0, -1);
            ;
            echo json_encode(array('response' => 'false', 'error' => $validation, 'message' => 'link'));
            $validation == "";
        } else {
            $data = $this->Enquirymodel->insertDownloadinfo();
            if ($data) {
                echo json_encode(array('response' => 'TRUE', 'error' => 0, 'message' => '<a href="upload/Technical_Support.pdf">DOWNLOAD YOUR FREE INFORMATION PACK</a>'));
            }
        }
        return true;
    }

    public function _check_phone($phone) {
        if (preg_match('/^([0-9]( |-)?)?(\(?[0-9]{3}\)?|[0-9]{3})( |-)?([0-9]{3}( |-)?[0-9]{4}|[a-zA-Z0-9]{7})$/', $phone)) {
            return 1;
        } else {
            $this->form_validation->set_message('_check_phone', '%s ' . $phone . ' is invalid format');
            return 0;
        }
    }

//    recieve information pack
    function info_pack() {

        $this->load->model('cms/Pagemodel');
        $this->load->model('cms/Widgetmodel');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('parser');
        $this->load->helper('form');
        $this->load->helper('text');
        $this->load->model('news/Newsmodel');
        $this->load->model('franchisee/Franchiseemodel');

        

        $news = array();
        $news = $this->Newsmodel->listAll(0, 2);
        //Get Page Details
        $page = array();

        //validation check
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email_addr', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('tel_number', 'Telephone', 'trim|required');
        $this->form_validation->set_rules('address1', 'Address1', 'trim|required');
        $this->form_validation->set_rules('address2', 'Address2', 'trim');
        $this->form_validation->set_rules('city', 'Town/City', 'trim|required');
        $this->form_validation->set_rules('county', 'County', 'trim|required');
        $this->form_validation->set_rules('post_code', 'Postcode', 'trim|required');

        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $inner = array();
        $shell = array();

        if ($this->form_validation->run() == FALSE) {
            $inner['page'] = $page;
            $inner['compiledblocks'] = array(0 => '');
            $inner['page']['page_title'] = 'Receive Information Pack';
            $inner['enquiryList'] = $this->Enquirymodel->getEnquiryTypeList();
            $inner['page']['page_contents'] = $this->load->view('infopack-form', $inner, true);
            $shell = $inner;
            $this->load->view("themes/" . THEME . "/templates/pages", $shell);
        } else {
//            gAParams();
            $emaildata = array();
            $data = $this->Enquirymodel->insertInfoPack();
            $row = $this->Enquirymodel->getpackinfo($data);
            $sendtoemail = $row['email'];
            $emaildata['sendername'] = $row['first_name']." ".$row['last_name'];
            $emaildata['verifynumber'] = $row['verifynumber'];
            $emaildata['today_date'] = date('d/m/Y');
            //e($row);
            //echo $data."<br />";
            
            
            $msg_body = $this->load->view('emails/infopack', $emaildata, true);
            $config['mailtype'] = 'html';
            $this->email->initialize($config); 
            
            $this->email->set_newline("\r\n");
            $this->email->from('invoice@checksample.co.uk','The Creative Station'); // change it to yours
            $this->email->to($sendtoemail); // change it to yours
            $this->email->subject('Creation Station- Information Pack');
            $this->email->message($msg_body);

            if ($this->email->send()) {
              echo "Email Sent";
              die;
              
            } else {
                show_error($this->email->print_debugger());
                
            }
            
           die;
            redirect('thankyou');
            exit();
        }
    }
    function checked($verifynumber){
        $this->Enquirymodel->updateInfoPack($verifynumber);
        redirect('mailverified');
    }

}

?>