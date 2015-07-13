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
        //print_r($this->session->all_userdata());
        $this->load->library('user_agent');
        $referred_from_url = $this->agent->referrer();
        $this->load->model('Customermodel');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('parser');
        $this->load->helper('form');
        $this->load->helper('text');

//Get Page Details
//validation check
        if (count($_POST)) {
            $this->session->set_flashdata('error', '<h1 style="color:red">Wrong email id or password</h1>');
        }
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
                //e($this->session->all_userdata());
                $result['isAdmin'] = 0;
                $result['isCompany'] = 0;
                $result['isUser'] = 0;
                $result['isCustomer'] = 1;
                $this->session->set_userdata($result);

                //echo $referred_from;
                redirect('/');
//               if($redirect!=''){
//                redirect($redirect, 'refresh');
//                
//                $shortlist = $this->session->userdata('referred_from');
//                unset($shortlist[0]);
//               
//               }
//               else{
//                   redirect('/');
//               }
                //redirect('');
            }
        }
    }

}

?>
