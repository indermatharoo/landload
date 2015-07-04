<?php

class Checkout extends Admin_Controller {

    function index() {
        $this->load->library('session');
        $this->load->model('Cartmodel');
        $this->load->model('Checkoutmodel');
        $this->load->model('customermodel');
        $this->load->helper('image');

        $this->load->library('form_validation');
//        e($this->aauth);
        $title = array();
        $title[''] = '--Select--';
        $title['mr'] = 'Mr';
        $title['mrs'] = 'Mrs';
        $title['mis'] = 'Mis';

        //Get customers Details
        if (!$this->aauth->isCustomer(curUsrId())) {
            redirect('/customer/logout', "location");
            exit();
        }
        $variables = $this->Cartmodel->variables();
        extract($variables);

        //Render View
        $inner = array();
        $inner['customer'] = $this->aauth->get_user();
        $inner['cart_total'] = $cart_total;
        $inner['title'] = $title;
        $inner['tax'] = $tax;
        $inner['order_total'] = $order_total;
//        $this->html->addMeta($this->load->view("meta/checkout-index.php", $inner, TRUE));
        $page = array();
        $page['content'] = $this->load->view('checkout-index', $inner, true);
//        $this->load->view("themes/" . THEME . "/templates/booking", $shell);
        $this->load->view($this->shellFile, $page);
    }

    function process() {
        $this->load->model('Cartmodel');
        $this->load->model('Customermodel');
        $this->load->model('Checkoutmodel');
        $this->load->library('parser');
        $this->load->library('email');
        //Get customers Details
        if (!$this->aauth->isCustomer(curUsrId())) {
            redirect('/customer/logout', "location");
            exit();
        }
        $customer = $this->aauth->get_user();
        $variables = $this->Cartmodel->variables();
        extract($variables);

        $order = $this->Checkoutmodel->addBooking($customer, $order_total);
        redirect("customer/checkout/payments/{$order['booking']['unique_id']}");
        exit();
    }

    function payments($onum) {
        $this->load->model('Checkoutmodel');
        $this->load->library('form_validation');
        //fetch order details
        $order = array();
        $order = $this->Checkoutmodel->detail($onum);
//        render view
        $inner = array();
        $page = array();
        $inner['order'] = $order;
//        $this->assets->addFooterJS('js/payment.js', 200);
        $inner['order']['paypal'] = 'harrymatharoo.matharoo@gmail.com';
        $page['content'] = $this->load->view('order-processing', $inner, true);
//        $this->load->view("themes/" . THEME . "/templates/booking", $shell);
        $this->load->view($this->customer, $page);
    }

    function failed($onum) {
        $inner = array();
        $page = array();
        $this->load->model('Checkoutmodel');
        $orders = $this->Checkoutmodel->updateBooking($onum, array('booking_status' => Checkoutmodel::$STATUS[0]));
        $page['content'] = $this->load->view("payment-cancel", $inner, TRUE);
//        $this->load->view("themes/" . THEME . "/templates/subpage", $shell);
        $this->load->view($this->customer, $page);
    }

    //function success
    function success($onum) {
        $this->load->model('Checkoutmodel');
        $this->load->library('form_validation');
        $this->load->helper('form');

        //fetch the order details
        $order = $this->Checkoutmodel->fetchDetails($onum);
        //render vierw
        $inner = array();
        $inner['order'] = $order;
        $page = array();
        $page['content'] = $this->load->view('payment-success', $inner, true);
//        $this->load->view("themes/" . THEME . "/templates/subpage", $shell);
        $this->load->view($this->customer, $page);
    }

}
