<?php

class Stock extends Admin_Controller {

    public $url = 'http://www.thecreationstationstore.co.uk/crm/';

    function __construct() {
        parent::__construct();
    }

    function index() {
        $inner = $page = array();
        $this->load->model('stockmodel');
        $inner['models'] = $this->stockmodel->getFrannchiseWithStore();
        $inner['labels'] = array(
            "First Name",
            "Last Name",
            "Email",
            "Telephone",
            "Territory Name",
            "Paypal",
            "Store Id"
        );
        $page['content'] = $this->load->view('stock', $inner, TRUE);
        $this->load->view($this->default, $page);
    }

    function store($fid) {
        $inner = $page = array();
        $param['fid'] = $fid;
        $inner['output'] = self::call('index/getFranchise', $param);
        $page['content'] = $this->load->view('franchiseorders', $inner, TRUE);
        $this->load->view($this->default, $page);
    }

    function test() {
        $param['fid'] = array(262, 263, 264);
        $param['syear'] = 2014;
        $param['eyear'] = 2015;
//        $output = self::call('index/getFranchise', $param);
        $output = self::call('index/getFranchiseOrder', $param);
        echo "<pre>";
        print_r($output);
    }

    private function call($url, $params = array()) {
       $params = http_build_query($params);
        $ch = curl_init();
//        echo $this->url . $url;
//        die;        
        curl_setopt($ch, CURLOPT_URL, $this->url . $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
//        return $server_output;
        return json_decode($server_output, 1);
    }

}
