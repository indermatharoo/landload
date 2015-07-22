<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CMS_Controller {

    function login_check($str) {
        $this->aauth->login(gParam('username'), gParam('passwd'), true);
        $data = $this->aauth->get_user();
        if ($data) {
            setcookie('user_id', $data->id, time() + (86400 * 30), "/");
            return true;
        }
        $this->form_validation->set_message('login_check', 'Login failed');
        return false;
    }

    function username_check($str) {
        $this->db->where('username', $str);
        $query = $this->db->get('user');
        if ($query && $query->num_rows() == 1) {
            return true;
        }

        $this->form_validation->set_message('username_check', 'No such user found!');
        return false;
    }

    function index() {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->library('encrypt');

        //validation check
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('passwd', 'Password', 'trim|required|callback_login_check');
        $this->form_validation->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run() == FALSE && !isset($this->session->userdata['loggedin'])
        ) {
//            print_r($_POST);
            if (gParam('username') && gParam('passwd')) {
                self::checkApplicantLogin(gParam('username'), gParam('passwd'));
            }
            $data = array();
            $this->load->view(THEME . 'login', $data);
        } else {
            redirect(createUrl('user/dashboard'));
        }
    }

    function checkApplicantLogin($email, $password) {
        $this->db->where('email', $email);
        $this->db->where('password', md5($password));
        $result = $this->db->get('applicants')->row_array();
//        e($result);
        if (count($result) && arrIndex($result, 'type') == 'tnt'):
            $result['isAdmin'] = 0;
            $result['isCompany'] = 0;
            $result['isUser'] = 0;
            $result['isCustomer'] = 1;
            $result['loggedin'] = 1;
            $this->session->set_userdata($result);
//            e(123);
            redirect(createUrl('applicants/dashboard'));
        endif;
    }

    function lostpasswd() {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->library('encrypt');
        $this->load->helper('string');
        $this->load->model('Adminmodel');
        $this->load->library('parser');
        $this->load->library('email');

        $this->security->init_csrf();
        $this->security->csrf_verify();

        //validation check
        $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_username_check');
        $this->form_validation->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $page = array();
            $page['content'] = $this->load->view('user/lostpasswd-form', $inner, TRUE);
            $this->load->view($this->shellFile, $page);
        } else {
            $this->Adminmodel->issuePassword($this->input->post('username', TRUE));
            header("location: " . base_url() . createUrl("welcome/password_sent/"));
            exit();
        }
    }

    function password_sent() {
        $this->load->library('form_validation');
        $this->load->helper('form');

        $data = array();
        $data['content'] = $this->load->view('user/lostpasswd-success', array(), TRUE);
        $this->load->view('shell', $data);
    }

}

?>
