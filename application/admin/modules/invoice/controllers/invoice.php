<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoice extends Admin_Controller {

    function __construct() {
        parent::__construct();
        isLogged();
        $this->load->model('user/usermodel');
    }

    //**************************************validation start*********************
    //validation for add valid image
    function valid_event_image($str) {
        if (!isset($_FILES['event_img']) || $_FILES['event_img']['size'] == 0 || $_FILES['event_img']['error'] != UPLOAD_ERR_OK) {
            $this->form_validation->set_message('valid_image', 'Image not uploaded');
            return FALSE;
        }
        $imginfo = @getimagesize($_FILES['event_img']['tmp_name']);

        if (!($imginfo[2] == 1 || $imginfo[2] == 2 || $imginfo[2] == 3 )) {
            $this->form_validation->set_message('valid_image', 'Only GIF, JPG and PNG Images are accepted');
            return FALSE;
        }
        return TRUE;
    }

//*************************************validation End********************************

    function index($arg = "") {
        if($this->aauth->isCustomer()):
            self::tanetData();
            return;
        endif;
        if ($arg == '') {
            $this->load->library('form_validation');
            $this->load->helper('form');
            $this->load->library('pagination');
            $this->load->model('invoicemodel');



            if (!$this->checkAccess('MANAGE_USERS')) {
                $this->utility->accessDenied();
                return;
            }

            ///Setup pagination            
            $inner["total"] = $this->invoicemodel->countAll($this->ids);

            $inner['total_rows_weekly'] = $this->invoicemodel->countAllWeekly($this->ids);
            $inner['total_rows_monthly'] = $this->invoicemodel->countAllMonthly($this->ids);
            $inner["weekly_data"] = $this->invoicemodel->getWeeklyInvoice($this->ids);

            $page = array();
            $page['content'] = $this->load->view('invoice-index', $inner, TRUE);
            $this->load->view($this->default, $page);
        } else {
            $this->load->library('form_validation');
            $this->load->helper('form');
            $this->load->library('pagination');

            if (!$this->checkAccess('MANAGE_USERS')) {
                $this->utility->accessDenied();
                return;
            }

            ///Setup pagination
            $this->load->model('invoicemodel');

            ///Setup pagination
            $perpage = 20;
            $config['base_url'] = base_url() . "invoice/index/detail/";
            $config['uri_segment'] = 3;
            $inner['total_rows_weekly'] = $this->invoicemodel->countAllWeekly();
            $inner['total_rows_monthly'] = $this->invoicemodel->countAllMonthly();
            $config['per_page'] = $perpage;
            $this->pagination->initialize($config);

            $inner["total"] = $this->invoicemodel->countAll();
            $inner['pagination'] = $this->pagination->create_links();
            $inner["weekly_data_detail"] = $this->invoicemodel->getWeeklyDetailInvoice();
            $page = array();
            $page['content'] = $this->load->view('invoice-index-detail', $inner, TRUE);
            $this->load->view($this->default, $page);
        }
    }

    function tanetData() {
        $inner = $page = array();
        $inner['data'] = $this->commonmodel->getAll('invoice_new', false, array(curUsrId()), 'applicant_id');
        $page['content'] = $this->load->view('tanet-invoice', $inner, true);
        $this->load->view($this->default, $page);
    }

    function monthly($arg = "") {

        if ($arg == '') {
            $this->load->library('form_validation');
            $this->load->helper('form');
            $this->load->library('pagination');
            $this->load->model('invoicemodel');



            if (!$this->checkAccess('MANAGE_USERS')) {
                $this->utility->accessDenied();
                return;
            }

            ///Setup pagination            
            $inner["total"] = $this->invoicemodel->countAll();

            $inner['total_rows_weekly'] = $this->invoicemodel->countAllWeekly();
            $inner['total_rows_monthly'] = $this->invoicemodel->countAllMonthly();
            $inner["monthly_data"] = $this->invoicemodel->getMonthlyInvoice();
            //e($inner);
            $page = array();
            $page['content'] = $this->load->view('invoice-monthly', $inner, TRUE);
            $this->load->view($this->default, $page);
        } else {
            $this->load->library('form_validation');
            $this->load->helper('form');
            $this->load->library('pagination');

            if (!$this->checkAccess('MANAGE_USERS')) {
                $this->utility->accessDenied();
                return;
            }

            ///Setup pagination
            $this->load->model('invoicemodel');

            ///Setup pagination
            $perpage = 20;
            $config['base_url'] = base_url() . "invoice/monthly/detail/";
            $config['uri_segment'] = 3;
            $inner['total_rows_weekly'] = $this->invoicemodel->countAllWeekly();
            $inner['total_rows_monthly'] = $this->invoicemodel->countAllMonthly();
            $config['per_page'] = $perpage;
            $this->pagination->initialize($config);

            $inner["total"] = $this->invoicemodel->countAll();
            $inner['pagination'] = $this->pagination->create_links();
            $inner["monthly_data_detail"] = $this->invoicemodel->getMonthlyDetailInvoice();
            $page = array();
            $page['content'] = $this->load->view('invoice-monthly-detail', $inner, TRUE);
            $this->load->view($this->default, $page);
        }
    }

    function quaterly($arg = "") {

        if ($arg == '') {
            $this->load->library('form_validation');
            $this->load->helper('form');
            $this->load->library('pagination');

            if (!$this->checkAccess('MANAGE_USERS')) {
                $this->utility->accessDenied();
                return;
            }

            ///Setup pagination
            $this->load->model('invoicemodel');
            $types = $this->invoicemodel->getFranshiseType();
            $temp = array();
            foreach ($types as $type):
                $temp[arrIndex($type, 'mon_fee_type')] = $type;
            endforeach;

            $inner["row"] = $temp;
            $inner["total"] = $this->invoicemodel->countAll();
            $inner["quarterly_data"] = $this->invoicemodel->getQuarterlyInvoice();
            $page = array();
            if ($this->aauth->isFranshisor()) {
                $page['content'] = $this->load->view('invoice-quarterly', $inner, TRUE);
            }
            $this->load->view($this->default, $page);
        } else {
            $this->load->library('form_validation');
            $this->load->helper('form');
            $this->load->library('pagination');

            if (!$this->checkAccess('MANAGE_USERS')) {
                $this->utility->accessDenied();
                return;
            }

            ///Setup pagination
            $this->load->model('invoicemodel');
            $types = $this->invoicemodel->getFranshiseType();
            $temp = array();
            foreach ($types as $type):
                $temp[arrIndex($type, 'mon_fee_type')] = $type;
            endforeach;

            $inner["row"] = $temp;
            $inner["total"] = $this->invoicemodel->countAll();
            $inner["quarterly_data_detail"] = $this->invoicemodel->getQuarterlyDetailInvoice();
            $page = array();
            if ($this->aauth->isFranshisor()) {
                $page['content'] = $this->load->view('invoice-quarterly-detail', $inner, TRUE);
            }
            $this->load->view($this->default, $page);
        }
    }

    function halfyearly($arg = "") {

        if ($arg == '') {
            $this->load->library('form_validation');
            $this->load->helper('form');
            $this->load->library('pagination');

            if (!$this->checkAccess('MANAGE_USERS')) {
                $this->utility->accessDenied();
                return;
            }

            ///Setup pagination
            $this->load->model('invoicemodel');
            $types = $this->invoicemodel->getFranshiseType();
            $temp = array();
            foreach ($types as $type):
                $temp[arrIndex($type, 'mon_fee_type')] = $type;
            endforeach;

            $inner["row"] = $temp;
            $inner["total"] = $this->invoicemodel->countAll();
            $inner["halfyearly_data"] = $this->invoicemodel->getHalfYearlyInvoice();
            $page = array();
            if ($this->aauth->isFranshisor()) {
                $page['content'] = $this->load->view('invoice-halfyearly', $inner, TRUE);
            }
            $this->load->view($this->default, $page);
        } else {
            $this->load->library('form_validation');
            $this->load->helper('form');
            $this->load->library('pagination');

            if (!$this->checkAccess('MANAGE_USERS')) {
                $this->utility->accessDenied();
                return;
            }

            ///Setup pagination
            $this->load->model('invoicemodel');
            $types = $this->invoicemodel->getFranshiseType();
            $temp = array();
            foreach ($types as $type):
                $temp[arrIndex($type, 'mon_fee_type')] = $type;
            endforeach;

            $inner["row"] = $temp;
            $inner["total"] = $this->invoicemodel->countAll();
            $inner["halfyearly_data_detail"] = $this->invoicemodel->getHalfYearlyDetailInvoice();
            $page = array();
            if ($this->aauth->isFranshisor()) {
                $page['content'] = $this->load->view('invoice-halfyearly-detail', $inner, TRUE);
            }
            $this->load->view($this->default, $page);
        }
    }

    /* ------------- Invoice Detail --------------------- */

    function invoicedetail($invoiceid = NULL) {

        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->library('pagination');

        if (!$this->checkAccess('MANAGE_USERS')) {
            $this->utility->accessDenied();
            return;
        }

        ///Setup pagination
        $this->load->model('invoicemodel');
        $inner = array();


        $inner["invoice_detail"] = $this->invoicemodel->getInvoiceDetail($invoiceid);

        $page = array();
        //if ($this->aauth->isFranshisor()) {
        $page['content'] = $this->load->view('invoice_template', $inner, TRUE);
        //}
        $this->load->view($this->default, $page);
    }

    /* ------------- Invoice Detail --------------------- */

    function manual() {

        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->library('pagination');

        if (!$this->checkAccess('MANAGE_USERS')) {
            $this->utility->accessDenied();
            return;
        }

        ///Setup pagination
        //$this->form_validation->set_rules('franchise_id', 'Franchise', 'trim|required');
        $this->form_validation->set_rules('franchise_id', 'Select Option', 'required|greater_than[0]');
        $this->form_validation->set_rules('due_on', 'Due date', 'trim|required');
        $this->form_validation->set_rules('particular', 'Particular', 'trim|required');
        $this->form_validation->set_rules('amount', 'Installation Amount', 'trim|required');
        $this->form_validation->set_error_delimiters('<li>', '</li>');

        //Render View
        $this->load->model('invoicemodel');
        if ($this->form_validation->run() == FALSE) {
            $inner = array();

            $inner["rows"] = $this->invoicemodel->getAllfranchisee();

            $page['content'] = $this->load->view('manual-invoice-index', $inner, TRUE);
            $this->load->view($this->default, $page);
        } else {
            $senddata["inner"] = $this->invoicemodel->insertInvoiceRecord();

            $emailtosend = $senddata["inner"]["f_email"];
            $invoice_id = $senddata["inner"]["invoice_id"];
            $fid = $senddata["inner"]["fid"];

            $msg_body = $this->load->view('invoice-manual-template', $senddata, true);

            // As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/

            $filename = $invoice_id;
            $pdfFilePath = FCPATH . "upload/virtcab/doc/$filename.pdf";
            include_once APPPATH . 'third_party/mpdf/mpdf.php';
            ini_set('memory_limit', '64M');
            $param = '"en-GB-x","A4","","",10,10,10,10,6,3';
            $mpdf = new mPDF('c');
            $mpdf->WriteHTML($msg_body);

            $mpdf->Output($pdfFilePath, 'F');
            $this->invoicemodel->updatevirtualcabnet($fid, $filename);


            $this->email->set_newline("\r\n");
            $this->email->from('invoice@checksample.co.uk', 'The Creative Station'); // change it to yours
            $this->email->to($emailtosend); // change it to yours
            $this->email->subject('Invoice Notification');
            $this->email->message($msg_body);

            if ($this->email->send()) {
                $this->invoicemodel->updateIsFirst($fid, 'M', $invoice_ref_code);
            } else {
                show_error($this->email->print_debugger());
            }


            //$this->Pagemodel->franchisee($page_details, $userid);
            $this->session->set_flashdata('SUCCESS', 'Invoice Generated');
            redirect(createUrl('invoice/manual/'));
            exit();
        }
    }

}

?>