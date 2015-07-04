<?php

class Categorymodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    //create indented list
    function indentedList() {
        $query = $this->db->get('eventbooking_categories');
        return $query->result_array();
    }

    function insertRecord() {
        $data = array();
        $data['category'] = $this->input->post('category', true);
        $this->db->insert('eventbooking_categories', $data);
    }

    function getdetails($cid) {
        $this->db->where('category_id', $cid);
        $query = $this->db->get('eventbooking_categories');
        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        return false;
    }

    function updateRecord($category) {
        $data = array();
        $data['category'] = $this->input->post('category');
        $this->db->where('category_id', $category['category_id']);
        $this->db->update('eventbooking_categories', $data);
    }

    function disableRecord($category) {
        $data = array();
        $data['status'] = 0;
        $this->db->where('category_id', $category['category_id']);
        $this->db->update('eventbooking_categories', $data);
    }
    
      function enableRecord($category) {
        $data = array();
        $data['status'] = 1;
        $this->db->where('category_id', $category['category_id']);
        $this->db->update('eventbooking_categories', $data);
    }

    function deleteCategory($current_category) {
        //delete category table
        $this->db->where('category_id', $current_category['category_id']);
        $this->db->delete('eventbooking_categories');
    }

}

?>