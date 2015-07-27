<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends Cms_Controller {

    function __construct() {
        parent::__construct();
    }

    //Validation Functions Start ****************************************************************


    function email_check($str) {
        $this->db->where('email', $str);
        $query = $this->db->get('customer');
        if ($query->num_rows() == 1) {
            $this->form_validation->set_message('email_check', 'Email already in use');
            return false;
        }

        return true;
    }

    //Validation Functions Ends ****************************************************************

    function index() {

        $this->load->model('Customermodel');
        $this->load->library('form_validation');
        $this->load->helper('string');
        $this->load->library('encrypt');
        $this->load->library('parser');
        $this->load->library('session');
        $this->load->library('email');
        $this->load->helper('form');

        //Validation checks
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|strtolower|valid_email|callback_email_check');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');

        $this->form_validation->set_error_delimiters('<li>', '</li>');
        
        //Render View
        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $shell = array();
            $inner['post'] = $_POST;
            $shell['contents'] = $this->load->view('register', $inner, true);
            $this->load->view("themes/" . THEME . "/templates/subpage", $shell);
        } else {
            $customer = $this->Customermodel->insertRecord();
            if ($customer) {
                redirect('customer/register/success');
                exit();
            }
            redirect('customer/register/error');
            exit();
        }
    }

    function success() {
        $this->load->model('Customermodel');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->library('cart');

        //Render View
        $inner = array();
        $shell = array();

        $shell['contents'] = $this->load->view('registration-success', $inner, TRUE);
        $this->load->view("themes/" . THEME . "/templates/subpage", $shell);
    }

    function error() {
        $this->load->model('Customermodel');
        $this->load->library('form_validation');
        $this->load->model('cms/Pagemodel');
        $this->load->model('cms/Templatemodel');
        $this->load->helper('form');
        $this->load->library('cart');

        //Render View
        $inner = array();
        $this->html->addMeta($this->load->view("meta/register_error.php", $inner, TRUE));

        $shell = array();
        $shell['contents'] = $this->load->view('registration-error', $inner, TRUE);
        $this->load->view("themes/" . THEME . "/templates/subpage", $shell);
    }

}

?>