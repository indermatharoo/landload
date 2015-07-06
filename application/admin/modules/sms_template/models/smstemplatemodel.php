<?php

class Smstemplatemodel extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	//fetch detail
	function detail($eid) {
		$this->db->from('sms_template');
		$this->db->where('sms_template_id', intval($eid));
		$rs = $this->db->get();
		if ($rs->num_rows() == 1)
			return $rs->row_array();
		return false;
	}

	//List All Records
	function listAll() {

		$this->db->select('*');
		$this->db->from('sms_template');

		$rs = $this->db->get();
		return $rs->result_array();
	}

	//get sort order
	function getOrder() {
		$this->db->select_max('sort_order');

		$query = $this->db->get('sms_template');
		$sort_order = $query->row_array();
		return $sort_order['sort_order'] + 1;
	}

	//function update Record
	function insertRecord() {
		$data = array();
		$data['sms_name'] = $this->input->post('name', FALSE);
		$data['message'] = $this->input->post('message', FALSE);
		


		$this->db->insert('sms_template', $data);
		return;
	}

	//function update Record
	function updateRecord($sms) {
		$data = array();
		$data['sms_name'] = $this->input->post('name', FALSE);
		$data['message'] = $this->input->post('message', FALSE);

		$this->db->where('sms_template_id', $sms['sms_template_id']);
		$this->db->update('sms_template', $data);
		return;
	}

	//delete record
	function deleteRecord($sms) {
		$this->db->where('sms_template_id', $sms['sms_template_id']);
		$this->db->delete('sms_template');
	}

}

?>