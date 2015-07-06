<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Marketing extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->is_admin_protected = TRUE;
        $this->load->model('user/usermodel');
    }

    function index($email = false, $eid = 0) {
        $this->load->model('Marketingmodel');
        $this->load->model('email_message/Emailmessagesmodel');
        $this->load->model('sms_template/Smstemplatemodel');
        $this->load->library('pagination');
        $this->load->helper('text');
        $this->load->library('form_validation');
        $this->load->library('parser');
        $this->load->library('email');

        $email_detail = array();
        if ($eid != 0) {
            $email_detail = $this->Emailmessagesmodel->detail($eid);
            if (!$email_detail) {
                $this->utility->show404();
                return;
            }
        }

        $send_email = 1;
        if ($email) {
            $send_email = 1;
            $this->form_validation->set_rules('email', 'Email Template', 'trim|required');
        } else {
            $this->form_validation->set_rules('sms', 'SMS Template', 'trim|required');
        }

        $this->form_validation->set_rules('campaign_option', 'Campaign Option', 'trim|required');

        // fetch marketing email content
        $emails = array();
        $emails[''] = '-- Select --';
        $email_rs = $this->Emailmessagesmodel->listAll($this->ids);
        foreach ($email_rs as $item) {
            $emails[$item['email_content_id']] = $item['email_name'];
        }

        // fetch marketing email content
        $sms_template = array();
        $sms_template[''] = '-- Select --';
        $sms_rs = $this->Smstemplatemodel->listAll();
        foreach ($sms_rs as $item) {
            $sms_template[$item['sms_template_id']] = $item['sms_name'];
        }

        if ($this->form_validation->run() == FALSE) {
            //render view            
            $inner = array();
            $inner['send_email'] = $send_email;
            $inner['emails'] = $emails;
            $inner['sms_template'] = $sms_template;
            $inner['email_detail'] = $email_detail;
            $page = array();
            $page['content'] = $this->load->view('index', $inner, TRUE);
            $this->load->view($this->default, $page);
        } else {
            $days = $this->input->post('campaign_option', true);
            if ($email) {
                $template_id = $this->input->post('email', true);
            } else {

                $template_id = $this->input->post('sms', true);
            }
            redirect("marketing/SendEmail/$send_email/$days/$template_id?branches=$selected_branches");
            exit();
        }
    }

    function SendEmail($send_email = false, $days = false, $template_id = false) {
        $this->load->model('Marketingmodel');
        $this->load->model('email_message/Emailmessagesmodel');
        $this->load->model('sms_template/Smstemplatemodel');
        $this->load->library('pagination');
        $this->load->helper('text');
        $this->load->library('form_validation');
        $this->load->library('parser');
        $this->load->library('email');
        $send_email = 0;
        if (isset($_POST['mode'])) {
            if ($_POST['mode'] == 'email') {
                $send_email = 1;
            }
        }
        $template_id = $_POST['email'];
        // fetch template
        $template = array();
        if ($send_email == 1) {
            $template = $this->Emailmessagesmodel->detail($template_id);
        } else {
            $template = $this->Smstemplatemodel->detail($template_id);
        }

        $this->form_validation->set_rules('assigne_id[]', 'Customer', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            //render view
            $inner = array();
            $inner['customers'] = $customer_list;
            $inner['days'] = $days;
            $inner['email_template_id'] = $template_id;
            $inner['send_email'] = $send_email;
            $page = array();
            $page['content'] = $this->load->view('select-customer', $inner, TRUE);
            $this->load->view($this->shellFile, $page);
        } else {
            if ($send_email == 1) {
                $this->Marketingmodel->sendMail($template);
                $this->session->set_flashdata('SUCCESS', 'marketing_mail');
                redirect('marketing/index/email');
                exit();
            } else {
                $this->Marketingmodel->sendSMS($template);
                $this->session->set_flashdata('SUCCESS', 'marketing_sms');
                redirect('marketing');
                exit();
            }
        }
    }

    function csv() {

        $this->load->model('branches/Branchmodel');
        $this->load->model('Marketingmodel');
        $this->load->helper('text');
        $this->load->library('form_validation');

        $branches = array();
        $branches_rs = $this->Branchmodel->listAll();
        foreach ($branches_rs as $row) {
            $branches[$row['branch_id']] = $row['branch_name'];
        }


        $this->form_validation->set_rules('campaign_option', 'Select Customer', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            //render view
            $inner = array();
            $inner['branches'] = $branches;
            $page = array();
            $page['content'] = $this->load->view('csv-index', $inner, TRUE);
            $this->load->view($this->shellFile, $page);
        } else {
            $selected_branches = '';
            if ($this->input->post('branches', TRUE)) {
                $selected_branches = implode(':', $this->input->post('branches', TRUE));
            }
            $days = $this->input->post('campaign_option', true);
            redirect("marketing/export_csv/$days?branches=$selected_branches");
            exit();
        }
    }

    function export_csv($days = false) {
        $this->load->model('Marketingmodel');
        $this->load->helper('text');
        $this->load->library('form_validation');

        $selected_branches = false;
        if ($this->input->get('branches', TRUE)) {
            $selected_branches = explode(':', $this->input->get('branches', TRUE));
        }

        //fetch customer list
        $customer_list = array();
        //$customer_list = $this->Marketingmodel->customersWithoutOrders($days);
        if ($days == -1) {
            $customer_list = $this->Marketingmodel->subscribedCustomers($selected_branches);
        } else if ($days == -2) {
            $customer_list = $this->Marketingmodel->subscribedGuardians($selected_branches);
        } else {
            $customer_list = $this->Marketingmodel->customersWithoutOrders($days, $selected_branches);
        }
//print_r($customer_list);exit();
        $this->form_validation->set_rules('customer_list[]', 'Customer', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            //render view
            $inner = array();
            $inner['customers'] = $customer_list;
            $inner['days'] = $days;
            $page = array();
            $page['content'] = $this->load->view('select-customer-csv', $inner, TRUE);
            $this->load->view($this->shellFile, $page);
        } else {
            $customer_ids = array();
            $customer_ids = $this->input->post('customer_list', true);

            if (!empty($customer_ids)) {

                $customers = array();
                $customers = $this->Marketingmodel->fetchCustomersByIDs($customer_ids);

                $f_name = "Marketing-" . date('Y-m-d-h-i-s') . ".csv";
                $export_file = $this->config->item('EXPORT_CSV_PATH') . 'marketing/' . $f_name;
                $fp = fopen($export_file, 'w');
                $columns = array(
                    'Company',
                    'Customer',
                    'Email',
                    'Address',
                    'Phone',
                    'Zipcode'
                );
                fputcsv($fp, $columns, ',', '"');
                foreach ($customers as $item) {
                    $csv_row = array();

                    $csv_row['Company'] = $item['company_name'];
                    $csv_row['Customer'] = $item['first_name'] . '' . $item['last_name'];

                    $csv_row['Email'] = $item['email'];
                    $csv_row['Address'] = $item['delivery_address1'];
                    $csv_row['Phone'] = $item['delivery_phone'];
                    $csv_row['Zipcode'] = $item['delivery_zipcode'];
                    fputcsv($fp, $csv_row, ',', '"');
                }
                fclose($fp);

                $this->load->helper('download');
                $data = file_get_contents($export_file);
                force_download($f_name, $data);
            }
        }
    }

    function showTemplate($template_id = 0, $type = false) {
        $this->load->model('email_message/Emailmessagesmodel');
        $this->load->model('sms_template/Smstemplatemodel');

        if ($type == 'email') {
            $template = $this->Emailmessagesmodel->detail($template_id);
            echo html_entity_decode($template['email_content']);
        } else {
            $template = $this->Smstemplatemodel->detail($template_id);
            echo html_entity_decode($template['message']);
        }
    }

    function template() {
        $this->load->model('email_message/Emailmessagesmodel');
        $models = $this->Emailmessagesmodel->listAll($this->ids);
        $inner = $page = array();
        $inner['models'] = $models;
        $inner['labels'] = array(
            "email_name" => "Name",
            "email_alias" => "Alias",
            "email_subject" => "Subject",
            "action" => "Action"
        );
        $page['content'] = $this->load->view('email-templates/manage', $inner, TRUE);
        $this->load->view($this->default, $page);
    }

    function delete($id = null) {
        if (!$id) {
            return false;
        }
        $this->load->model('email_message/Emailmessagesmodel');
        $this->Emailmessagesmodel->deleteRecord($id);
        redirect('marketing/template');
    }

    function create($id = null) {
        $this->load->model('email_message/Emailmessagesmodel');
        $model = array();
        if ($id) {
            $model = $this->Emailmessagesmodel->detail($id);
        }
        $inner = $page = array();
        $inner['model'] = $model;
        $inner['fields'] = tableFields('email_content');
        $inner['templates'] = $this->Emailmessagesmodel->adminTemplate();
        if (!empty($_POST['email_name']) && !empty($_POST['email_alias']) && !empty($_POST['email_subject'])) {
            $this->Emailmessagesmodel->insertRecord($id);
            redirect('marketing/template');
        }
        $page['content'] = $this->load->view('email-templates/template', $inner, TRUE);
        $this->load->view($this->default, $page);
    }

    function detail($id = null) {
        if (!$id) {
            return false;
        }        
        $this->load->model('email_message/Emailmessagesmodel');
        $data = $this->Emailmessagesmodel->detail($id);
        echo html_entity_decode($data['email_content']);
    }

}

?>