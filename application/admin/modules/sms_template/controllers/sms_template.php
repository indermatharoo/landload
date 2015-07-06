<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Sms_template extends Admin_Controller {

	function __construct() {
		parent::__construct();
		$this->is_admin_protected = TRUE;
	}

	//function index
	function index() {
		$this->load->model('Smstemplatemodel');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->library('pagination');



		//print_R($market_sms_template); exit();
		//list all sms_template
		$sms_template = array();
		$sms_template = $this->Smstemplatemodel->listAll();



		//render view
		$inner = array();
		$inner['sms_templates'] = $sms_template;


		$page = array();
		$page['content'] = $this->load->view('index', $inner, TRUE);
		$this->load->view($this->shellFile, $page);
	}

	//function to add marketing sms_template template record
	function add() {
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->model('Smstemplatemodel');


		//Form Validations
		$this->form_validation->set_rules('name', 'Name ', 'trim|required');

		$this->form_validation->set_rules('message', 'Message ', 'trim|required');
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		if ($this->form_validation->run() == FALSE) {
			$inner = array();
			$page = array();

			$page['content'] = $this->load->view('add', $inner, TRUE);
			$this->load->view($this->shellFile, $page);
		} else {
			$this->Smstemplatemodel->insertRecord();

			$this->session->set_flashdata('SUCCESS', 'sms_template_added');

			redirect('sms_template', 'location');

			exit();
		}
	}

	//function to edit record
	function edit($s_tid) {
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->model('Smstemplatemodel');

		//Get Menu Details
		$sms_template = array();
		$sms_template = $this->Smstemplatemodel->detail($s_tid);

		if (!$sms_template) {
			$this->utility->show404();
			return;
		}



		$this->form_validation->set_rules('name', 'Name ', 'trim|required');
		$this->form_validation->set_rules('message', 'Message ', 'trim|required');
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		if ($this->form_validation->run() == FALSE) {
			$inner = array();
			$page = array();
			$inner['sms_template'] = $sms_template;


			$page['content'] = $this->load->view('edit', $inner, TRUE);
			$this->load->view($this->shellFile, $page);
		} else {
			$this->Smstemplatemodel->updateRecord($sms_template);

			$this->session->set_flashdata('SUCCESS', 'sms_template_updated');
			redirect('sms_template', 'location');
			exit();
		}
	}

	function delete($s_tid) {
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->model('Smstemplatemodel');


// get sms_template content
		$sms_template = array();
		$sms_template = $this->Smstemplatemodel->detail($s_tid);

		if (!$sms_template) {
			$this->utility->show404();
			return;
		}

		//Delete Marketing Email Template
		$this->Smstemplatemodel->deleteRecord($sms_template);
		$this->session->set_flashdata('SUCCESS', 'sms_template_deleted');

		redirect('sms_template', 'location');
		exit();
	}

}

?>