<?php

class Attributesmodel extends Basemodel {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function findAll() {
        $results = $this->db->get('units_attributes')->result_array();
        return $results;
    }

}
