<?php

class Reportsmodel extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    function getOccupiedUnitsList()
    {
        $this->db->where('status',"0");
        $this->db->join('properties','properties.id=units.property_id','left');
        $this->db->join('unit_type','unit_type.unit_code=units.unit_type','left');
        $this->db->join('properties_type','properties_type.short_code=properties.type','left');
        $res = $this->db->get('units');
        return array('num_rows'=>$res->num_rows(), 'result'=>$res->result_array());
        
    }
    function getUnOccupiedUnitsList()
    {
        $this->db->where("units.status ",'1');
        $this->db->or_where("units.status ",'2');
        $this->db->join('properties','properties.id=units.property_id','left');
        $this->db->join('unit_type','unit_type.unit_code=units.unit_type','left');
        $this->db->join('properties_type','properties_type.short_code=properties.type','left');
        $res = $this->db->get('units');
        echo $this->db->last_query();
        return array('num_rows'=>$res->num_rows(), 'result'=>$res->result_array());
    }
}
