<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cart extends Cms_Controller {

    function __construct() {
        parent::__construct();
    }

    function add() {
        $this->load->library('cart');
        $this->load->library('form_validation');
        $this->load->model('Cartmodel');
        $this->load->model('Bookingmodel');
        //Get product details
        $event = array();
        $event = $this->Bookingmodel->getEvent($this->input->post('eid', TRUE));
        $price = array();
        $price = $this->Bookingmodel->getEventPrice($this->input->post('eid', TRUE));
        
        $this->Cartmodel->insertRecord($event, $price);



//        if (!$ajax) {
//            redirect("booking/cart");
//            exit();
//        }
//        $output = array();
//        $output['status'] = 1;
//        $output['cart'] = $this->Cartmodel->minicart();
//        echo json_encode($output);
//        exit();
    }

    function minicart() {
        $this->load->library('cart');
        $this->load->model('Cartmodel');
        echo $this->Cartmodel->minicart();
    }

    //View cart
    function index() {

        $this->load->model('Cartmodel');
        $this->load->library('cart');
        $this->load->library('form_validation');

        $variables = $this->Cartmodel->variables();
        extract($variables);

//		$this->assets->addFooterJS('js/website/cart_price.js', 200);
        //render view


        $inner = array();
        $inner['cart_total'] = $cart_total;
        $inner['discount'] = $discount;
        $inner['tax'] = $tax;
        $inner['order_total'] = $order_total;
        $shell = array();



        $shell['contents'] = $this->load->view('cart-index', $inner, true);
        $this->load->view("themes/" . THEME . "/templates/booking", $shell);
    }

    //Update cart
    function update($target = false) {

        //  echo "here"; exit();
        $this->load->library('cart');
        $this->load->model('Cartmodel');
        $this->load->model('Bookingmodel');
        $this->load->library('form_validation');
        $this->load->helper('form');



        $this->Cartmodel->updateRecord();

        $this->session->set_flashdata('SUCCESS', 'cart_updated');
        redirect("checkout");
        exit();
    }

    function delete($ctid, $status = false) {
        $this->load->library('cart');
        $this->load->library('form_validation');
        $this->load->model('Cartmodel');

        $this->Cartmodel->deleteRecord($ctid);

        $this->session->set_flashdata('SUCCESS', 'cart_deleted');
        redirect("checkout");
        exit();
    }

}

?>