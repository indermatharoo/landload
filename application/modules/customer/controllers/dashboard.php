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
              // $this->load->library('Memberauth');

        $customer = array();
        //$customer = $this->Memberauth->checkAuth();
         $customer =  get_cust_data();
        if (!$customer) {
            //$this->Hooksmodel->setReturnURL();
            redirect("/customer/login/");
            exit();
        }

        //print_r($customer); exit();
        //Render View
        $inner = array();
        $inner['customer'] = $customer;

        $inner['title'] = 'Welcome ' . $customer['username'];

        $shell['contents'] = $this->load->view('dashboard', $inner, true);
        $this->load->view("themes/" . THEME . "/templates/subpage", $shell);
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
	
	 function loyaltypoints(){
        $this->load->model('cart/Cartmodel');
         $this->load->model('product/Productmodel');
        $inner['alloffers'] = $this->Cartmodel->starOffers();
        //$shell['contents'] = $this->load->view('loyaltyshow','', true);
       // $this->load->view("themes/" . THEME . "/templates/subpage", $shell);
	   $this->load->view('loyaltyshow', $inner);
    }


}

?>
