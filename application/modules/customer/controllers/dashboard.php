<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends Cms_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->helper('text');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('Customermodel');
        // $this->load->library('Memberauth');

        $customer = array();
        //$customer = $this->Memberauth->checkAuth();
        $id = $this->aauth->isCustomer();
        $customer = $this->Customermodel->fetchByID($id);
//         e($customer);
        if (!$customer) {
            //$this->Hooksmodel->setReturnURL();
            redirect("/customer/login/");
            exit();
        }

        //print_r($customer); exit();
        //Render View
        $inner = array();
        $inner['customer'] = $customer;


        $shell['contents'] = $this->load->view('dashboard', $inner, true);
        $this->load->view("themes/" . THEME . "/templates/subpage", $shell);
    }

    function applied_properties() {
        $this->load->model('Customermodel');
        $properties = $this->Customermodel->getAppliedProperties();
        $inner = array();
        $inner['properties'] = $properties;
        $inner['customer'] = $customer = $this->Customermodel->userByID(curUsrId());
        $shell['contents'] = $this->load->view('applied_properties', $inner, true);
        $this->load->view("themes/" . THEME . "/templates/subpage", $shell);
    }

    function change_pass() {
        $this->load->library('form_validation');
        $this->load->model('Customermodel');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('passconf', 'Password', 'trim|required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $inner['customer'] = $customer = $this->Customermodel->userByID(curUsrId());
            $shell['contents'] = $this->load->view('change_pass', $inner, true);
            $this->load->view("themes/" . THEME . "/templates/subpage", $shell);
        } else {
            $this->Customermodel->changePassword();
            $this->session->set_flashdata('SUCCESS', 'pass_changed');
            redirect('customer/dashboard');
        }
    }

    function message() {
        $this->load->model('Ordermodel');
        $uid = $_SESSION['my_id'];
        $message = $this->Ordermodel->getMessage($uid);
        $inner = array();
        $inner['message'] = $message;
        $shell = array();
        $shell['contents'] = $this->load->view('messages', $inner, true);
        $this->load->view("themes/" . THEME . "/templates/subpage", $shell);
    }

    function msgdel() {
        $this->load->model('Ordermodel');

        $del = $this->Ordermodel->delMsg($_POST['id']);
        if ($del == 1) {
            $output = array();
            $output['message'] = 'Order Deleted Successfully!';
            echo json_encode($output);
            exit();
        }
    }

    function invoice() {
        $shell['contents'] = $this->load->view('invoice', '', true);
        $this->load->view("themes/" . THEME . "/templates/subpage", $shell);
    }

    function myorder() {
        $shell['contents'] = $this->load->view('my-order', '', true);
        $this->load->view("themes/" . THEME . "/templates/subpage", $shell);
    }

    function editorder() {
        $shell['contents'] = $this->load->view('order-edit', '', true);
        $this->load->view("themes/" . THEME . "/templates/subpage", $shell);
    }

    function loyaltypoints() {
        $this->load->model('cart/Cartmodel');
        $this->load->model('product/Productmodel');
        $inner['alloffers'] = $this->Cartmodel->starOffers();
        //$shell['contents'] = $this->load->view('loyaltyshow','', true);
        // $this->load->view("themes/" . THEME . "/templates/subpage", $shell);
        $this->load->view('loyaltyshow', $inner);
    }

    function profile() {
        $id = curUsrId();
        $this->load->model('Customermodel');

        $customer = array();
        $customer = $this->Customermodel->userByID($id);


        $inner = array();
        $inner['customer'] = $customer;


        $shell['contents'] = $this->load->view('profile', $inner, true);
        $this->load->view("themes/" . THEME . "/templates/subpage", $shell);
    }

}

?>
