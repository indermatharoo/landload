<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Contact extends Cms_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		$this->load->model('cms/Pagemodel');
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->library('parser');
		$this->load->helper('form');
		$this->load->helper('text');
		
//		$status = $this->cmscore->loadPage($this);
//		if (!$status)
//			return;
//		extract($status);
		
		//$this->assets->addCSS('css/subpage.css', 200);


		//validation check
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('number', 'Phone Number', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('message', 'Message', 'trim');
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		if ($this->form_validation->run() == FALSE) {
			
			$shell = array();
			$shell['contents'] = $this->load->view('contact-form', $inner, true);
			$this->load->view("themes/" . THEME . "/templates/default", $shell);
		} else {
			$emailData = array();
			$emailData['DATE'] = date("jS F, Y");
			$emailData['NAME'] = $this->input->post('name', TRUE);
			$emailData['EMAIL'] = $this->input->post('email', TRUE);
			$emailData['PHONE'] = $this->input->post('number', TRUE);
			$emailData['COMMENTS'] = nl2br($this->input->post('message', TRUE));
			$emailBody = $this->parser->parse('contact/emails/contactus', $emailData, TRUE);

			$config = array();
			$this->email->initialize($this->config->item('EMAIL_CONFIG'));
			$this->email->from(DWS_EMAIL_NOREPLY, DWS_EMAIL_FROM);
			$this->email->reply_to(DWS_EMAIL_REPLY_TO);
//			$this->email->to(DWS_EMAIL_ADMIN);
                        $this->email->to('balwinder@multichannelcreative.co.uk');
			$this->email->subject('Contact Us');
			$this->email->message($emailBody);
                       
			$status = $this->email->send();
			$status = true;
			if ($status == TRUE) {
				redirect('/thank-you');
				exit();
			}
			redirect('/contact-us/error');
			exit();
		}
	}

}

?>