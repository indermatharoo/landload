<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer extends CommonController {

    function __construct() {
        parent::__construct();
        $this->load->helper('text');
        $this->load->helper('form');
        $this->load->library('pagination');
        $this->load->library('pagination');
        $this->load->model('Customermodel');
        $this->load->library('form_validation');
    }

    //function index
    function index($keywords = 0, $offset = 0) {
        $inner = $page = array();
        $customer = $this->getBasicListing(array('keywords' => $keywords, 'offset' => $offset));
        $inner['customer'] = $customer['customers'];
        $inner['labels'] = array(
            'fname' => 'First Name',
            'lname' => 'Last Name',
            'email' => 'Email',
            'last_login' => 'Last Login',
            'action' => 'Action',
        );
        $page['content'] = $this->load->view('customer-index', $inner, TRUE);
        
        $this->load->view($this->customer, $page);
    }

    //function edit
    function addedit($cid = null) {

        //get Customer detail 
        $customerDet = array();
        $customerDet = $this->Customermodel->getdetails($cid);
        if (!$customerDet && $cid) {
            $this->utility->show404();
            return;
        }

        //validation check
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('delivery_address1', 'Address1', 'trim|required');
        $this->form_validation->set_rules('delivery_address2', 'Address2', 'trim');
        $this->form_validation->set_rules('delivery_phone', 'Phone', 'trim|required');
        $this->form_validation->set_rules('delivery_city', 'City', 'trim|required');
        $this->form_validation->set_rules('delivery_zipcode', 'Post Code', 'trim|required');
        $this->form_validation->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $keywords = '';
            $offset = '';
            $inner = $this->getBasicListing();
            $inner['customerDet'] = $customerDet;
            $inner['customerDetChild'] = $this->Customermodel->listAllChildren($cid);
            $inner['isEdit'] = '1';
            $customer = $this->getBasicListing();
            $inner['customer'] = $customer['customers'];
            $inner['labels'] = array(
                'fname' => 'First Name',
                'lname' => 'Last Name',
                'email' => 'Email',
                'action' => 'Action',
            );

            $page = array();
            $page['content'] = $this->load->view('customer-index', $inner, TRUE);
            $this->load->view($this->customer, $page);
        } else {
            if (isset($_POST['editCutomer']) && !empty($_POST['editCutomer'])) {
                $user_id = $this->Customermodel->updateRecord(null);
            } else {
                $user_id = $this->Customermodel->insertRecord(null);
            }
            $this->session->set_flashdata('SUCCESS', 'customer_updated');
            redirect("customer/customer/index/", 'location');
            exit();
        }
    }

    //function to delete record
    function delete($cid = false) {
        if (intval($cid)) {
            $this->Customermodel->deleteRecord($cid);
        }
        redirect('customer');
    }

    function getBasicListing($param = array()) {
        $keywords = arrIndex($param, 'keywords');
        $offset = arrIndex($param, 'offset');

        //Setup pagination
        $perpage = 25;
        $config['base_url'] = base_url() . "customer/index/$keywords/";
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->Customermodel->countAll($this->ids);
        $config['per_page'] = $perpage;
        $this->pagination->initialize($config);

        //Fetch All Customers
        $customers = array();
        $customers = $this->Customermodel->listAll($this->ids);
        //Check For Missing Search Criteria
        if ($keywords == '0' || trim($keywords) == '') {
            $keywords = '';
        }

        //render view
        $inner = array();
        $inner['customers'] = $customers;
        $inner['keywords'] = $keywords;
        $inner['pagination'] = $this->pagination->create_links();
        return $inner;
    }

    public function profile() {
        $this->aauth->isFranshisor();

        $inner = $page = array();
        $inner['cususer'] = $this->aauth->get_user();
        $inner['extrafields'] = array();
        if ($this->aauth->isFranshisee()) {
            $inner['extrafields'] = $this->usermodel->getFranchise();
            $inner['extrafields']->franchise = 1;
        } elseif ($this->aauth->isUser()) {
            $inner['extrafields'] = $this->usermodel->getFranchise($this->aauth->get_user()->pid);
            $inner['extrafields']->user = 1;
        } elseif ($this->aauth->isCustomer()) {
            $inner['extrafields'] = $this->db->where('auth_user_id', curUsrId())->get('customer')->row();
            $inner['extrafields']->customer = 1;
        }
        $page['content'] = $this->load->view('user/profile', $inner, TRUE);
//        $inner = array();
//        $page['content'] = $this->load->view('del', $inner, TRUE);
        $this->load->view('themes/default/templates/customerlogin', $page);
    }

    function add($id = null) {
        if (!$id) {
            return false;
        }
        if (gParam('auth_user_id')) {
            $image = $_FILES['image']['name'];
            if ($image) {
                $image = $this->usermodel->uploadImage();
            } else {
                $image = false;
            }
            $data = rSF('customer');
            $password = gParam('passwd');
            if ($password || $image)
                $this->aauth->update_user($id, false, $password, false, false, $image);
            $this->commonmodel->updateRecord($data, gParam('auth_user_id'), 'customer', 'auth_user_id');
        }
        $inner = array();
        $inner['model'] = $this->commonmodel->getByPk($id, 'customer', 'auth_user_id');
        $inner['model'] = (array) $inner['model'];
        $page['content'] = $this->load->view('customer/add', $inner, TRUE);
//        $this->load->view($this->dashboard, $page);
        $this->load->view('themes/default/templates/customerlogin', $page);
    }

    function events() {
        $franchise = self::getFranchise();
        $ids = $this->usermodel->getFranchiseUsersId($franchise->id);
        $dataTime = date('Y-m-d h:m:s');
        $where = false;
//        $where = 'event_start_ts > "'.$dataTime.'"';
        $inner = $page = array();
        $inner['events'] = $this->commonmodel->getAll('eventbooking_events', $where, $ids, 'user_id');
        $page['content'] = $this->load->view('customer/events', $inner, true);
        $this->load->view($this->shellFile, $page);
    }

    function getFranchise() {
        $id = $this->aauth->get_user();
        $user_or_franchise = $id->pid;
        $franchise = false;
        while ($user_or_franchise != 1) {
            $franchise = $this->aauth->get_user($user_or_franchise);
            $user_or_franchise = $franchise->pid;
        }
        return $franchise;
    }

    function cartupdate() {
        $this->load->library('cart');
        $this->load->model('Cartmodel');
        $this->load->model('Bookingmodel');
        $this->load->library('form_validation');
        $this->load->helper('form');

        $this->Cartmodel->updateRecord();

        $this->session->set_flashdata('SUCCESS', 'cart_updated');
        redirect("customer/checkout");
        exit();
    }

}
