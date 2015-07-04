<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test extends Admin_Controller {

    function index() {
        $this->load->library('email');
        $this->load->helper('form');
        $this->load->helper('text');
        
        $this->email->initialize($this->config->item('EMAIL_CONFIG'));
        $this->email->from('info@desktopdeli.co.uk', 'info@desktopdeli.co.uk');
		$this->email->set_header('Return-Path', '<b3c05447f14690ccd2bc@cloudmailin.net>');
		$this->email->set_header('X-HS-ID', "<76>");
		$this->email->set_header('X-HS-Email', "<jatinder132131@desktopdeli.co.uk>");
        $this->email->to("jatinder132131@desktopdeli.co.uk");
        $this->email->subject('Test Message');
        $this->email->message("This is a test message.");
        $status = $this->email->send();
        echo $this->email->print_debugger();
		exit();
    }

}
?>