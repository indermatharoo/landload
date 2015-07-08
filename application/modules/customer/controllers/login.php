<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends Cms_Controller {

    function __construct() {
        parent::__construct();
    }

    //***************************Validation Functions Start ****************************************************************
    function login_check($str) {
       
        $this->load->library('encrypt');

        $this->db->where('email', $this->input->post('email', TRUE));
        $this->db->where('is_active', 1);
        $query = $this->db->get('applicants');

        if ($query->num_rows() == 1) {
            $row = $query->row_array();
            if ($this->encrypt->decode($row['password']) === $this->input->post('password', TRUE)) {
                return true;
            }
        }
    
        $this->form_validation->set_message('login_check', 'Login failed');
        return false;
    }

    //*****************************Validation Functions End ********************************************************************

    function index() {
        

        $this->load->model('Customermodel');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('parser');
        $this->load->helper('form');
        $this->load->helper('text');

        //Get Page Details
        //validation check

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_login_check');
        $this->form_validation->set_error_delimiters('<li>', '</li>');

      
        if ($this->form_validation->run() == FALSE) {
           
            $inner = array();

            $shell = array();
            $shell['contents'] = $this->load->view('login-page', $inner, true);
            $this->load->view("themes/" . THEME . "/templates/subpage", $shell);
        } else {
            $this->db->where('email', $this->input->post('email', true));
            $rs = $this->db->get('applicants');
            if ($rs->num_rows() == 1) {
                $customer = $rs->row_array();
                $session = array();
                $session['CUSTOMER_ID'] = $customer['applicant_id'];
                $session['LOGIN_EMAIL'] = $customer['email'];
                $this->session->set_userdata($session);
                if ($this->session->userdata('REDIR_URL') == "") {
                    echo 'Logged in';
                    redirect('customer/dashboard');
                    exit();
                } else {
                    $url = $this->session->userdata('REDIR_URL');
                    $this->session->unset_userdata('REDIR_URL');
                    header("location: " . base_url() . "$url");
                    exit();
                }
            }
            redirect("/customer/login/");
            exit();
        }
    }

}

?>
