<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Company_Controller extends CMS_Controller {

    //private $member_data = false;

    function __construct() {
        parent::__construct();
        $this->checkAuth();
    }

    function checkAuth() {
        $company_id = $this->session->userdata('COMPANY_ID');
        if (isset($company_id) && ($company_id != '')) {
            $this->load->model('company/Companymodel');
            $user = $this->Companymodel->getdetails($company_id);
            if ($user) {
                $this->member_data = $user;
                $this->user_name = $user['company_name'];
                $this->user_type = 'COMPANY';
                return TRUE;
            }
        }

        $admin_id = $this->session->userdata('ADMIN_USER_ID');
        if (isset($admin_id) && ($admin_id != '')) {
            $this->load->model('Adminmodel');
            $user = $this->Adminmodel->fetchByID($admin_id);
            if ($user) {
                $this->member_data = $user;
                $this->user_name = $user['username'];
                $this->user_type = 'ADMIN';
                return TRUE;
            }
        }

        $branch_id = $this->session->userdata('BRANCH_ID');
        if (isset($branch_id) && ($branch_id != '')) {
            $this->load->model('branches/Branchmodel');
            $user = $this->Branchmodel->getdetails($branch_id);
            if ($user) {
                $this->member_data = $user;
                $this->user_name = $user['branch_name'];
                $this->user_type = 'BRANCH';
                return TRUE;
            }
        }

        header('location: ' . base_url() . 'welcome/');
        exit();
    }

    function getUser() {
        
        return $this->member_data;
    }

}

?>