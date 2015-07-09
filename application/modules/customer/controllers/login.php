<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends Cms_Controller {

    function __construct() {
        parent::__construct();
    }

//***************************Validation Functions Start ****************************************************************
    function login_check($str) {
//        $email = gParam('email');
//        $password = gParam('password');
//        if (!$email || !$password) {
//            return false;
//        }
//        $this->db->from('applicants');
//        $this->db->where('email', $email);
//        $this->db->where('password', md5($password));
//        $result = $this->db->get()->row_array();
//        return count($result);
        return true;
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
            $email = gParam('email');
            $password = gParam('password');
            if (!$email || !$password) {
                return false;
            }
            $this->db->from('applicants');
            $this->db->where('email', $email);
            $this->db->where('password', md5($password));
            $result = $this->db->get()->row_array();
            if (!count($result)) {
                redirect("/customer/login/");
            } else {
                $result['isAdmin'] = 0;
                $result['isCompany'] = 0;
                $result['isUser'] = 0;
                $result['isCustomer'] = 1;
                $this->session->set_userdata($result);
               // e($this->session->all_userdata());
               $referred_from = $this->session->userdata('referred_from');
               if($referred_from!=''){
                redirect($referred_from, 'refresh');
               
               }
               else{
                   redirect('');
               }
                //redirect('');
            }
        }
        
    }

}

?>
