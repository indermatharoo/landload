<?php

class Wpfeed extends Cms_Controller {

    public $url = 'http://news.thecreationstation.co.uk/test/';

    function __construct() {
        parent::__construct();
    }

    function index() {
       e(latestFeed(3));
    }

    function feed($fid=NULL) {
        $inner = $page = array();
        $param['fid'] = $fid;
        $inner['output'] = self::call($param);
        e($inner);
        die;
//        $page['content'] = $this->load->view('franchiseorders', $inner, TRUE);
//        $this->load->view($this->default, $page);
    }


    private function call($params = array()) {
       $params = http_build_query($params);
        $ch = curl_init();
//        echo $this->url . $url;
//        die;        
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
//        return $server_output;
        return json_decode($server_output, 1);
    }

}
