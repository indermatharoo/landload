<?php

class Typemodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    //create indented list
    function indentedList() {
//        $this->db->where('status', 1);
        $query = $this->db->get('eventbooking_event_type');
        return $query->result_array();
    }

    function insertRecord() {
        $data = array();
        $data['event_type'] = $this->input->post('event_type', true);
        $data['event_color'] = $this->input->post('event_color', true);
        $this->db->insert('eventbooking_event_type', $data);
    }

    function getdetails($cid) {
        $this->db->where('event_type_id', $cid);
        $query = $this->db->get('eventbooking_event_type');
        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        return false;
    }

    function updateRecord($type) {
        $data = array();
        $data['event_type'] = $this->input->post('event_type');
        $data['event_color'] = $this->input->post('event_color', true);
        $this->db->where('event_type_id', $type['event_type_id']);
        $this->db->update('eventbooking_event_type', $data);
    }

    function disableRecord($type) {
        $data = array();
        $data['status'] = 0;
        $this->db->where('event_type_id', $type['event_type_id']);
        $this->db->update('eventbooking_event_type', $data);
    }

    function enableRecord($type) {
        $data = array();
        $data['status'] = 1;
        $this->db->where('event_type_id', $type['event_type_id']);
        $this->db->update('eventbooking_event_type', $data);
    }

    function deleteCategory($type) {
        $this->db->where('event_type_id', $type['event_type_id']);
        $this->db->delete('eventbooking_event_type');
    }

}

?>