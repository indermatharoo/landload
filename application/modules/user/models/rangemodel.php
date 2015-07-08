<?php

class Rangemodel extends CI_Model {
    
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

//Count All Records
    function countAll() {
        $this->db->from('region');
        return $this->db->count_all_results();
    }

    //List All Records
    function listAll($offset = FALSE, $limit = FALSE) {
        if ($offset)
            $this->db->offset($offset);
        if ($limit)
            $this->db->limit($limit);

        $rs = $this->db->get('region');
        return $rs->result_array();
    }

}