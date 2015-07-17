<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Company extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('calender/event');
        $this->load->model('Companymodel');
    }

    //***********************************Validation start ****************************************
    //for registration
    function email_check($str) {
        $this->db->where('email', strtolower($str));
        $query = $this->db->get('user');
        if ($query->num_rows() == 1) {
            $this->form_validation->set_message('email_check', 'Email is already being used!');
            return false;
        }

        return true;
    }

    function user($id = null) {
        $this->load->library('form_validation');
        $model = array();
        if ($id) {
            $model = $this->commonmodel->getByPk($id, 'aauth_users');
        }
        $this->form_validation->set_rules('name', 'Name', 'trim|required|callback_valid_login');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');
        $this->form_validation->set_rules('pass', 'Password', 'trim|required');
        $this->form_validation->set_rules('pass1', 'confirm Password', 'trim|required|matches[pass]');
        $this->form_validation->set_error_delimiters('<li>', '</li>');

        //Render View
        if ($this->form_validation->run() == FALSE) {
            $inner = $page = array();
            if (!$id) {
                $model = $_POST;
            }
            $inner['user'] = $model;
            $page['content'] = $this->load->view('companyuser', $inner, true);
            $this->load->view($this->customer, $page);
        } else {
            $data = rSF('aauth_users');
            $status = $this->commonmodel->insertRecord($data,'aauth_users');
            $this->session->set_flashdata('SUCCESS', 'user_added');
            redirect(createUrl('company/user/'));
            exit();
        }
    }

    //for edit
    function valid_email_e($str) {
        $this->db->where('email', $str);
        $this->db->where('user_id !=', $this->input->post('user_id', true));
        $this->db->from('user');
        $rs = $this->db->count_all_results();
        if ($rs != 0) {
            $this->form_validation->set_message('valid_email_e', 'Email is already being used!');
            return false;
        }
        return true;
    }

    //for registration
    function valid_login($str) {
        $this->db->where('username', $str);
        $query = $this->db->get('user');
        if ($query->num_rows() == 1) {
            $this->form_validation->set_message('valid_login', 'Username is already being used!');
            return false;
        }
        return true;
    }

    //for edit
    function valid_login_e($str) {
        $this->db->where('username', $str);
        $this->db->where('user_id !=', $this->input->post('user_id', true));
        $this->db->from('user');
        $rs = $this->db->count_all_results();
        if ($rs != 0) {
            $this->form_validation->set_message('valid_login_e', 'Username is already being used!');
            return false;
        }
        return true;
    }

    //Check Password
    function check_pwd($str) {
        if ($this->input->post('passwd', true) != '' || $str != '') {
            if ($this->input->post('passwd', true) != $str) {
                $this->form_validation->set_message('check_pwd', ' Password and Confirm Password do not match!');
                return false;
            }
        }
        return true;
    }

    //****************************************End Validation****************************************
    //function index
    function index($sortby = 'coupon_title', $direction = 'asc', $offset = false) {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->library('pagination');

        if (!$this->checkAccess('MANAGE_USERS')) {
            $this->utility->accessDenied();
            return;
        }

        ///Setup pagination
        $perpage = 20;
        $config['base_url'] = base_url() . "company/index/";
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->Companymodel->countAll();
        $config['per_page'] = $perpage;
        $this->pagination->initialize($config);

        //Users list
        $users = array();
        $users = $this->Companymodel->listAll($this->ids);
        //render view
        $inner = array();
        $inner['labels'] = array(
            'name' => 'Name',
            'email' => 'Email',
            'pid' => 'Role',
            'action' => 'Action',
        );
        $inner['users'] = $users;
        $inner['user'] = $this->getUser();
        $inner['pagination'] = $this->pagination->create_links();
        $page = array();
        $page['content'] = $this->load->view('company-index', $inner, TRUE);
        $this->load->view($this->customer, $page);
    }

    //function add
    function add() {


        $this->load->model('companymodel');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('string');
        $this->load->library('encrypt');
        $this->load->library('parser');
        $this->load->library('email');

        if (!$this->checkAccess('ADD_USER')) {
            $this->utility->accessDenied();
            return;
        }
        $country = array();
        $country_list = $this->companymodel->getCountry();

        //validation check
        //$this->form_validation->set_rules('role_id', 'Role', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|callback_valid_login');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');
        $this->form_validation->set_rules('pass', 'Password', 'trim|required');
        $this->form_validation->set_rules('pass1', 'confirm Password', 'trim|required|matches[pass]');
        $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
        $this->form_validation->set_error_delimiters('<li>', '</li>');

        //Render View
        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $inner['user'] = array();
            $inner['country'] = $country_list;
            $inner['edit'] = false;
            $page['content'] = $this->load->view('add-company', $inner, TRUE);
            $this->load->view($this->customer, $page);
        } else {
            $this->companymodel->insertRecord();
            $this->session->set_flashdata('SUCCESS', 'user_added');
            redirect(createUrl('company/index/'));
            exit();
        }
    }

    //Edit Users
    function edit($uid = 0) {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('string');
        $this->load->library('encrypt');

        //check user
        $login_user = $this->userauth->checkAuth();

        if (!$this->checkAccess('EDIT_USER')) {
            $this->utility->accessDenied();
            return;
        }
        if (($uid == 1) && ($this->aauth->isFrsUser())) {
            $this->session->set_flashdata('ERROR', 'premission_denied_user');
            redirect(createUrl('company/index'));
        }
        //Fetch user details
        $user = array();
        $user = $this->Companymodel->fetchByID($uid);
        if (!$user) {
            $this->utility->show404();
            return;
        }

        $country = array();
        $country_list = $this->Companymodel->getCountry();

        //validation check
        $this->form_validation->set_rules('protected_resource_id[]', 'Permission', 'trim');
        $this->form_validation->set_rules('name', 'name', 'trim|required|callback_valid_login_e');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_valid_email_e');
        $this->form_validation->set_rules('passwd', 'Password', 'trim');
        $this->form_validation->set_rules('passwd1', 'confirm Password', 'trim|callback_check_pwd');
        $this->form_validation->set_error_delimiters('<li>', '</li>');

        //Render View
        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $inner['user'] = $user;
            $inner['uid'] = $uid;
            $page = array();
//          $page['content'] = $this->load->view('edit-user', $inner, TRUE);            
            $inner['edit'] = $uid;
            $inner['country'] = $country_list;
            $page['content'] = $this->load->view('edit-company', $inner, TRUE);
            $this->load->view($this->customer, $page);
        } else {
            $this->Companymodel->updateRecord($uid);
            $this->session->set_flashdata('SUCCESS', 'Company');
            redirect(createUrl('user/index/'));
            exit();
        }
    }

    //Delete users
    function delete($uid) {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('string');

        if (!$this->checkAccess('DELETE_USER')) {
            $this->utility->accessDenied();
            return;
        }

        //Fetch user details
        $user = array();
        $user = $this->Usermodel->fetchByID($uid);
        if (!$user) {
            $this->utility->show404();
            return;
        }
        if ($user['id'] == 1) {
            $this->session->set_flashdata('ERROR', 'user_cnonot_deleted');

            redirect('/user/index/', 'location');
            exit();
        }

        $this->Usermodel->deleteRecord($user);

        $this->session->set_flashdata('SUCCESS', 'user_deleted');

        redirect(createUrl('user/index/'));
        exit();
    }

    function logout() {
        $this->session->sess_destroy();
        redirect("/welcome/");
        exit();
    }

    function profile($id) {
        $this->aauth->isFranshisor($id);
        if (!$id)
            return false;

        $inner = $page = array();
        $inner['cususer'] = $this->aauth->get_user($id);
        $inner['extrafields'] = array();
        if ($this->aauth->isFranshisee($id)) {
            $inner['extrafields'] = $this->usermodel->getFranchise($id);
            $inner['extrafields']->franchise = 1;
        } elseif ($this->aauth->isUser($id)) {
            $inner['extrafields'] = $this->usermodel->getFranchise($this->aauth->get_user($id)->pid);
            $inner['extrafields']->user = 1;
        } elseif ($this->aauth->isCustomer($id)) {
            $inner['extrafields'] = $this->db->where('auth_user_id', $id)->get('customer')->row();
            $inner['extrafields']->customer = 1;
        }
        $page['content'] = $this->load->view('profile', $inner, TRUE);
//        $inner = array();
//        $page['content'] = $this->load->view('del', $inner, TRUE);
        $this->load->view($this->shellFile, $page);
    }

    function IsFirstTimeLogin() {
//        gAParams();
        $val = gParam('val');
        if ($val) {
            $this->usermodel->IsFirstTimeLogin();
        }
        echo $this->load->view('IsFirstTimeLogin', array(), true);
    }

    function customdate() {
        ini_set('display_errors', 'On');
//        print_r($_POST);
        if (gParam('customdate')) {
            $date = explode(' - ', gParam('customdate'));
            $syear = date('Y-m-d', strtotime($date[0]));
            $eyear = date('Y-m-d', strtotime($date[1]));
//            e($syear,0);
//            e($eyear);
            $inner = $page = array();
            $notification = $this->load->model('usermodel');
            $notification = $this->load->model('calender/event');
            $inner['loadContent'] = true;
            $inner['dasbBoardData'] = $this->usermodel->dasbBoardCustomdate($syear, $eyear, $this->ids);
            $inner['franchises'] = $this->usermodel->getAllFranchise();
            $inner['regions'] = $this->db->get('franchise_region')->result_array();
            $inner['magentoDashboardData'] = self::loadmagentodata();
            $page['content'] = $this->load->view('dashboard/customdate', $inner, TRUE);
//            $page['content'] = $this->load->view('user/dashboard', $inner, TRUE);
        } else {
            $inner = $page = array();
            $inner['loadContent'] = false;
            $page['content'] = $this->load->view('dashboard/customdate', $inner, TRUE);
        }
        $this->load->view($this->dashboard, $page);
    }

    function loadmagentodata() {
        $rs = $this->commonmodel->getAll('user_extra_detail', 'store_id != 0', array(), false, 'store_id');
        $ids = array();
        foreach ($rs as $row):
            $ids[] = arrIndex($row, 'store_id');
        endforeach;
        $sessionData = $this->session->all_userdata();
        $params = array();
        $params['fid'] = $ids;
        $params['syear'] = arrIndex($sessionData, 'syear');
        $params['eyear'] = arrIndex($sessionData, 'eyear');
        $data = self::call('index/getFranchiseOrder', $params);
        if (arrIndex($data, 'success') == false) {
            return false;
        }
        $temp = array();
        foreach ($data['data'] as $key => $result):
            $temp[arrIndex($result, 'gid')] = $result;
        endforeach;
        return $temp;
    }

    public $url = 'http://www.thecreationstationstore.co.uk/crm/';

    private function call($url, $params = array()) {
        $params = http_build_query($params);
        $ch = curl_init();
//        echo $this->url . $url;
//        exit;
        curl_setopt($ch, CURLOPT_URL, $this->url . $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
//        print_r($server_output);
//        exit;
//        return $server_output;
        return json_decode($server_output, 1);
    }

}

?>
