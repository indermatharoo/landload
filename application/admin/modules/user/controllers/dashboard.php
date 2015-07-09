<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    function index($syear = 2014, $eyear = 2015) { 
        ini_set('display_errors','On');
        if ($this->aauth->isCustomer()):
            redirect('customer/dashboard');
        endif;
        $this->load->library('pagination');
        $this->load->helper('text');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('properties/Propertiesmodel');
        $this->load->model('company/Companymodel');
        $this->load->model('applicants/Applicantsmodel');
        $notification = $this->load->model('usermodel');
        $recentProperties = $this->Propertiesmodel->getRecentProperties();
        $recentCompanies = $this->Companymodel->getRecentCompany();
        //e($recentCompanies);
        $recentUser = $this->Applicantsmodel->getRecentApplicants();
        $inner = array();
        $inner['recentProperties'] = $recentProperties;
        $inner['recentCompanies'] = $recentCompanies;
        $inner['recentApplicants'] = $recentUser;
        $page = array();
        $page['content'] = $this->load->view('user/dashboard', $inner, TRUE);
        $this->load->view($this->dashboard, $page);
    }
    
   
    function setUserSession($regions, $franchises) {
        $this->session->set_userdata('reporttype', 'default');
        $temp = array();
        foreach ($regions as $region):
            $temp[] = arrIndex($region, 'id');
        endforeach;
        $this->session->set_userdata('regions', $temp);
        $temp = array();
        foreach ($franchises as $franchise):
            $temp[] = arrIndex($franchise, 'id');
        endforeach;
        $this->session->set_userdata('franchises', $temp);
    }

    function password_check($str) {
        $this->load->library('encrypt');

        $this->db->where('user_id', $this->input->post('user_id', true));
        $query = $this->db->get('user');
        if ($query->num_rows() == 1) {
            $row = $query->row_array();
            if ($this->encrypt->decode($row['passwd']) == $str) {
                return true;
            }
        }

        $this->form_validation->set_message('password_check', 'Old Password is incorrect');
        return false;
    }

    function changepassword() {
        $this->load->library('encrypt');
        $this->load->library('form_validation');
        $this->load->helper('form');

        $this->security->init_csrf();
        $this->security->csrf_verify();

        //validation check
        $this->form_validation->set_rules('old_passwd', 'Old Password', 'trim|required|callback_password_check');
        $this->form_validation->set_rules('passwd', 'Password', 'trim|required');
        $this->form_validation->set_rules('passwd1', 'Confirm Password', 'trim|required|matches[passwd]');
        $this->form_validation->set_error_delimiters('<li>', '</li>');


        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $page = array();
            $inner['user'] = $this->getUser();
            $page['content'] = $this->load->view('user/change-password', $inner, TRUE);
            $this->load->view($this->shellFile, $page);
        } else {
            $this->Usermodel->updatePassword($this->getUser());

            $this->session->set_flashdata('SUCCESS', 'admin_updated');

            redirect("user/dashboard/changepassword/");
            exit();
        }
    }

    function logout() {
        $this->session->unset_userdata('ADMIN_USER_ID');
        $this->session->unset_userdata('COMPANY_ID');
        $this->session->unset_userdata('BRANCH_ID');
        $this->session->sess_destroy();
        redirect("/welcome/");
        exit();
    }

    function timeData($event = false, $customer = false, $quarter) {
        $this->db->from('eventbooking_events');
        switch ($quarter) {
            case 1:
                $where = 'event_start_ts > "2014-04-01 00:00:00" and event_start_ts < "2014-06-31 11:59:59"';
                break;
            case 2:
                $where = 'event_start_ts > "2014-07-01 00:00:00" and event_start_ts < "2014-09-31 11:59:59"';
                break;
            case 3:
                $where = 'event_start_ts > "2014-10-01 00:00:00" and event_start_ts < "2014-12-31 11:59:59"';
                break;
            case 4:
                $where = 'event_start_ts > "2015-01-01 00:00:00" and event_start_ts < "2015-03-31 11:59:59"';
                break;
            case 12:
                $where = 'event_start_ts > "2014-04-01 00:00:00" and event_start_ts < "2015-03-31 11:59:59"';
                break;
        }
        $where .= ' and event_type_id = ' . $event;
        if (!$this->aauth->isAdmin()) {
//            $id = $this->aauth->get_user()->id;
            $id = $this->session->userdata['id'];
            $where .= ' AND user_id = ANY (select id from dpd_aauth_users where id = ' . $id . ' or pid = ' . $id . ')';
        }
        $query = $this->db->query("select * from dpd_eventbooking_events where $where");
        if ($customer)
            return 0;
        else
            return $query->num_rows();
    }

    function timePrice($event = false, $quarter) {
        /*
         * implementaion pending
         */
    }

}

?>
