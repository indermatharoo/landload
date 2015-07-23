<?php

class Paypal extends CI_Controller {
    function __construct() {
        parent::__construct();
       $this->load->library('paypal');
    }
    function index()
    {

       echo "i m here";
    }
}