<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends Cms_Controller {

    function __construct() {
        parent::__construct();
    }

    //***************************Validation Functions Start ****************************************************************
    function login_check($str) {
//        $this->load->library('encrypt');
        $this->db_bms = $this->load->database('bms', TRUE);
        $this->db_bms->where('username', $this->input->post('username', TRUE));
//        $this->db_bms->where('cactive', 1);
        $query = $this->db_bms->get('_users');

        if ($query->num_rows() == 1) {

            $row = $query->row_array();
            if ($row['password'] == ($this->input->post('password', TRUE))) {

                // $this->traditional_login($this->input->post('username', TRUE),$this->input->post('password', TRUE));
//                     $this->do_post_request($this->input->post('username', TRUE),$this->input->post('password', TRUE));

                return true;
            }
        }

        $this->form_validation->set_message('login_check', 'Oops! Forgot Your Password? Please click on the link below to retrieve your password');
        return false;
    }

    //*****************************Validation Functions End ********************************************************************

    function index() {

        $return['success'] = false;
        if (!gParam('email') || !gParam('password')) {
            echo json_encode($return);
            return false;
        }
        
        $this->db->from('applicants');
        $this->db->where('email', gParam('email'));
        $this->db->where('password', md5(gParam('password')));
        $result = $this->db->get()->row_array();
        if (count($result)) {
            $result['isCustomer'] = true;
            $result['isAdmin'] = false;
            $result['isCompany'] = false;
            $result['isUser'] = false;
            $this->session->set_userdata($result);
            $return['success'] = true;
        }
        echo json_encode($return);
    }

}

?>
