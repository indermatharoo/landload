<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order extends Cms_Controller {

    function __construct() {
        parent::__construct();
    }

    function index($offset = 0) {

        $this->load->model('Customermodel');
        $this->load->model('Ordermodel');
        $this->load->library('pagination');
        $this->load->helper('text');


        //Check for customer login
        if (!$this->session->userdata('CUSTOMER_ID')) {
            redirect("/customer/login/");
            exit();
        }

        //Get customers Details
        $customer = array();
        $customer = $this->Customermodel->fetchByID($this->session->userdata('CUSTOMER_ID'));

        if (count($customer) == 0) {
            redirect('/customer/logout/', "location");
            exit();
        }

        //setup Pagenation
        $perpage = 500;
        $config = array();
        $config['base_url'] = base_url() . "customer/order/index/";
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->Ordermodel->countAll($customer);
        $config['per_page'] = $perpage;
        $this->pagination->initialize($config);

        $orders = array();
        $orders = $this->Ordermodel->listAll($customer, $offset, $perpage);

        //Render View
        $inner = array();
        $shell = array();
        $inner['customer'] = $customer;
        $inner['orders'] = $orders;
        $inner['pagination'] = $this->pagination->create_links();

        $shell['contents'] = $this->load->view("order-index", $inner, true);
        $this->load->view("themes/" . THEME . "/templates/subpage", $shell);
    }

    //Order Details
    function details($onum) {
        $this->load->model('cms/Templatemodel');
        $this->load->model('Ordermodel');
        $this->load->model('Customermodel');
        $this->load->library('pagination');
        $this->load->helper('text');

        //Check for customer login
        if (!$this->memberauth->checkAuth()) {
            redirect("/customer/login/");
            exit();
        }

        //Get customers Details
        $customer = array();
        $customer = $this->Customermodel->fetchByID($this->session->userdata('CUSTOMER_ID'));
        if (count($customer) == 0) {
            redirect('/customer/logout/', "location");
            exit();
        }

        //get order details
        $order = array();
        $order = $this->Ordermodel->fetchByOrderNum($onum);
        if (!$order) {
            $this->utility->show404();
            return;
        }


        //get order items
        $order_items = array();
        $order_items = $this->Ordermodel->listOrderItems($order['order_id']);

        //check customer see own order
        if ($customer['customer_id'] != $order['customer_id']) {
            redirect('/customer/logout/', "location");
            exit();
        }

        //render view
        $inner = array();
        $inner['order'] = $order;
        $inner['order_items'] = $order_items;
        $inner['customer'] = $customer;

        $shell['contents'] = $this->load->view("order/order-detail", $inner, true);
        $this->load->view("themes/" . THEME . "/templates/subpage", $shell);
    }

    function printer($onum) {
        $this->load->model('cms/Templatemodel');
        $this->load->model('Ordermodel');
        $this->load->model('Customermodel');
        $this->load->library('pagination');
        $this->load->helper('text');

        //Check for customer login
        if (!$this->memberauth->checkAuth()) {
            redirect("/customer/login");
            exit();
        }

        //Get customers Details
        $customer = array();
        $customer = $this->Customermodel->fetchByID($this->session->userdata('CUSTOMER_ID'));
        if (count($customer) == 0) {
            redirect('/customer/logout');
            exit();
        }

        //get order details
        $order = array();
        $order = $this->Ordermodel->fetchByOrderNum($onum);
        if (!$order) {
            $this->utility->show404();
            return;
        }


        //get order items
        $order_items = array();
        $order_items = $this->Ordermodel->listOrderItems($order['order_id']);

        //check customer see own order
        if ($customer['customer_id'] != $order['customer_id']) {
            redirect('/customer/logout');
            exit();
        }

        //print_r($order);
        //render view
        $inner = array();
        $inner['order'] = $order;
        $inner['order_items'] = $order_items;
        $inner['customer'] = $customer;

        $shell['contents'] = $this->load->view("order/order-detail-print", $inner, true);
        $html = $this->load->view("themes/" . THEME . "/templates/print", $shell, true);

        echo $html;
        exit();

        include(APPPATH . '/libraries/Pdface.php');
        $pdface = new Pdface('BUQSASSAZZ3JHL8Y', '3SbNm6WX');
        $options = array();
        $options['width'] = '4in';
        $pdface->setOptions($options);
        $response = $pdface->htmlToPdf($html);

        echo $html;

        echo $pdface->ERROR_MESSAGE;

        file_put_contents('print.pdf', $response);
    }

    function reorder() {
        $this->load->model('Ordermodel');
        $this->load->model('Customermodel');
        $this->load->library('pagination');
        $this->load->helper('text');
 
        //get order details
        $order = array();
        $order = $this->Ordermodel->fetchById($_POST['product_id']);
        if (!$order) {
            $this->utility->show404();
            return;
        }

        //get order items
        
       $product = array();
        $product['product_id'] = $this->input->post('product_id', true);
        $product['product_qty'] = $this->input->post('product_qty', true);
        $product['product_date'] = strtotime(str_replace("/", "-", $this->input->post('product_date', true)));
        $product['product_time'] = $this->input->post('product_time', true);
$product['product_req'] = $this->input->post('spcl_req', true);
        
        if($order['qty'] != $product['product_qty'] || $order['date'] != $product['product_date'] || $order['time'] != $product['product_time'] || $order['specials'] != $product['product_req']){
            $data['id'] = $order['id'];
            $data['qty']= $product['product_qty'];
            $data['date']= $product['product_date'];
            $data['time']= $product['product_time'];
            $data['specials']= $product['product_req'];
            $data['total']= number_format($product['product_qty'] * $order['price'],2);
            $data['updated_by'] = time();
          
            $this->Ordermodel->updateExistingOrder($data);
        }
           redirect('/customer/order/index');
        exit();
    }

    function orderEdit($oid) {
        $this->load->model('cms/Templatemodel');
        $this->load->model('Ordermodel');
        $this->load->model('Customermodel');
        $this->load->helper('text');

        //Check for customer login
        if (!$this->session->userdata('CUSTOMER_ID')) {
            redirect("/customer/login/");
            exit();
        }

        //Get customers Details
        $customer = array();
        $customer = $this->Customermodel->fetchByID($this->session->userdata('CUSTOMER_ID'));
        if (count($customer) == 0) {
            redirect('/customer/logout');
            exit();
        }

        //get order details
        $order = array();
        $order = $this->Ordermodel->fetchById($oid);
        if (!$order) {
            $this->utility->show404();
            return;
        }


        //get order items
//        $order_items = array();
//        $order_items = $this->Ordermodel->listOrderItems($order['order_id']);

        //check customer see own order
        if ($customer['id'] != $order['ordered_by']) {
            redirect('/customer/logout');
            exit();
        }
        
         $inner = array();
        $shell = array();
        $inner['customer'] = $customer;
        $inner['order'] = $order;
  
//
//        echo "<pre>";
//        print_r($inner); exit;
        $shell['contents'] = $this->load->view("order-edit", $inner, true);
        $this->load->view("themes/" . THEME . "/templates/subpage", $shell);
        
    }

}

?>