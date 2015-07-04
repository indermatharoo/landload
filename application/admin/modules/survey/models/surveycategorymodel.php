<?php

/**
 * survey_category
 * `id`
 * `parent_id`
 * `category_name`
 * `category_description`
 * `creation_date`
 * `update_date`
 * `is_active`
 * `assign_group`
 * 
 */

class SurveyCategorymodel extends CI_Model {
    
        private $id;
        private $parent_id;
        private $category_name;
        private $category_description;
        private $creation_date;
        private $update_date;
        private $is_active;
        private $assign_group;
    
	function __construct() {
		// Call the Model constructor
		parent::__construct();
                $this->id = 'id';
                $this->parent_id = 'parent_id';                
                $this->is_active = 'is_active';
                $this->update_date = 'update_date';
                $this->assign_group = 'assign_group';
                $this->category_name = 'category_name';                
                $this->creation_date = 'creation_date';                
                $this->category_description = 'category_description';
	}

	
	function detail($sid) {
		$this->db->where($this->id, intval($sid));
		$rs = $this->db->get('survey_category');
		if ($rs->num_rows() == 1) {
			return $rs->row_array();
		}
		return FALSE;
	}


	function countAll() {
		$this->db->where('is_active', '1')->from('survey_category');
		return $this->db->count_all_results();
	}


	function listAll($offset = false, $limit = false) {
		if ($offset)
			$this->db->offset($offset);
		if ($limit)
			$this->db->limit($limit);
		$rs = $this->db->where('is_active', '1')->get('survey_category');
                if(!$rs->num_rows()){
                    return FALSE;
                }
		return $rs->result_array();
	}


	function insertRecord($param = array()) {

		$data = array();
                if(isset($param[$this->parent_id])){
                    $data[$this->parent_id] = $param[$this->parent_id];
                }
                if(isset($param[$this->assign_group])){
                    $data[$this->assign_group] = $param[$this->assign_group];
                }
                $data[$this->is_active] = 1;
                $data[$this->update_date] = date('Y-m-d H:i:s');
                $data[$this->creation_date] = date('Y-m-d H:i:s');
		$data[$this->category_name] = $this->input->post($this->category_name, TRUE);
		$data[$this->category_description] = $this->input->post($this->category_description, TRUE);

		$this->db->insert('survey_category', $data);
	}

	function updateRecord($param = array()) {
            
		$data = array();                
                if(isset($param[$this->parent_id])){
                    $data[$this->parent_id] = $param[$this->parent_id];
                }
                if(isset($param[$this->assign_group])){
                    $data[$this->assign_group] = $param[$this->assign_group];
                }
                $data[$this->update_date] = date('Y-m-d H:i:s');
                $data[$this->creation_date] = date('Y-m-d H:i:s');
		$data[$this->category_name] = $this->input->post($this->category_name, TRUE);
		$data[$this->category_description] = $this->input->post($this->category_description, TRUE);
                
		$this->db->where('id', $param['id']);
		$this->db->update('survey_category', $data);
	}


	function deleteRecord($param = array()) {
                $data = array();
                $data[$this->is_active] = 0;
		$this->db->where('id', $param['id']);
		$this->db->update('survey_category', $data);
	}

}

?>