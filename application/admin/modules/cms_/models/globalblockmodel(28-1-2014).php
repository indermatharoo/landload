<?php

class Globalblockmodel extends CI_Model {

	function __construct() {
		// Call the Model constructor
		parent::__construct();
	}

	//Get block Detial
	function getDetails($g_bid) {
		$this->db->where('block_id', intval($g_bid));
		$rs = $this->db->get('block');
		if ($rs->num_rows() == 1)
			return $rs->row_array();
		return FALSE;
	}

	//count all block
	function countAll() {
		$this->db->where('page_id', 0);
		$this->db->from('block');
		return $this->db->count_all_results();
	}

	//list all block
	function listAll($offset = FALSE, $limit = FALSE) {
		if ($offset)
			$this->db->offset($offset);
		if ($limit)
			$this->db->limit($limit);

		$this->db->where('page_id', 0);
		$query = $this->db->get('block');

		return $query->result_array();
	}

	//function insert record
	function insertRecord() {
		$data = array();
		$data['page_id'] = 0;
		$data['block_title'] = $this->input->post('block_title', TRUE);
		$data['block_alias'] = strtolower($this->input->post('block_alias', TRUE));
		$data['block_contents'] = $this->input->post('block_contents', TRUE);
		$data['block_template'] = $this->input->post('block_template', FALSE);

		if ($data['block_template']) {
			$block_template = $this->input->post('block_template', FALSE);
			$file_name = 'global_' . strtolower($this->input->post('block_alias', TRUE)) . '.php';

			$status = file_put_contents("../application/views/themes/" . THEME . "/blocks/" . $file_name, $block_template);
			if (!$status)
				return FALSE;
		}

		$this->db->insert('block', $data);
	}

	//function update record
	function updateRecord($block) {
		//print_r($block); exit();
		$data = array();
		$data['block_title'] = $this->input->post('block_title', TRUE);
		$data['block_alias'] = strtolower($this->input->post('block_alias', TRUE));
		$data['block_contents'] = $this->input->post('block_contents', TRUE);
		$data['block_template'] = $this->input->post('block_template', FALSE);

		if ($data['block_template']) {
			$block_template = $this->input->post('block_template', FALSE);
			$old_file_name = 'global_' . $block['block_alias'] . '.php';
			$new_file_name = 'global_' . strtolower($this->input->post('block_alias', TRUE)) . '.php';



			if ($old_file_name != $new_file_name) {
				//unlink the old file
				if (file_exists("../application/views/themes/" . THEME . "/blocks/" . $old_file_name)) {
					@unlink("../application/views/themes/" . THEME . "/blocks/" . $old_file_name);
				}
			}

			$status = file_put_contents("../application/views/themes/" . THEME . "/blocks/" . $new_file_name, $block_template);
			if (!$status)
				return FALSE;
		}

		$this->db->where('block_id', $block['block_id']);
		$this->db->update('block', $data);
	}

	//function delete page block
	function deleteRecord($block) {
		//Delete Block Templates
		$file_name = 'global_'.$block['block_alias'].'.php';
		if (file_exists("../application/views/themes/".THEME."/blocks/".$file_name)) {
			@unlink("../application/views/themes/".THEME."/blocks/".$file_name);
		}
		
		//delete the entry form the product image table
		$this->db->where('block_id', $block['block_id']);
		$this->db->delete('block');
	}

}

?>
