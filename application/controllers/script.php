<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Script extends CI_Controller {

    function index() {
        $this->load->library('parser');
        $this->load->library('email');
        $this->load->model('customer/Ordermodel');
        $this->load->model('checkout/Checkoutmodel');
        
        //Fetch order details
        $order = $this->Ordermodel->fetchByOrderNum('131118-140626-1169');
        if (!$order) {
            echo 'Invalid Order';
            exit();
        }
        
        $this->Checkoutmodel->confirmOrder($order);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */