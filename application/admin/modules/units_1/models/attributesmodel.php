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

    function save() {
        $data = rSF('units_attributes');
        $id = gParam('id');
        if ($id) {
            $this->db->where('id', $id);
            $this->db->update('units_attributes', $data);
            $this->session->set_flashdata('SUCCESS', 'attribute_updated');
        } else {
            $this->db->insert('units_attributes', $data);
            $this->session->set_flashdata('SUCCESS', 'attribute_added');
        }
    }

}
