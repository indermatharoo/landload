<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Newsletter extends Cms_Controller {
	
	function preview($id = false) {
		
		$this->db->where('email_log_id', $id);
		$rs = $this->db->get('email_log');
		if (!$rs || $rs->num_rows() != 1) {
			$this->utility->show404();
			return;
		}
		$log_entry = $rs->row_array();
		
		
		$shell['log_entry'] = $log_entry;
		$this->load->view("themes/" . THEME . "/templates/newsletter", $shell);
	}
	
	function unsubscribe($cid = false) {
		$this->db->where('customer_id', intval($cid));
		$rs = $this->db->get('customer');
		if (!$rs || $rs->num_rows() != 1) {
			$this->utility->show404();
			return;
		}
		$customer = $rs->row_array();
		
		$update = array();
		$update['news_subscription'] = 0;
		$this->db->where('customer_id', $customer['customer_id']);
		$this->db->update('customer', $update);
		
		redirect('unsubscribed');
	}

}

?>
