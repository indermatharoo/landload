<?php

class Reportsmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getOccupiedUnitsList($ids = array()) {
        if (count($ids)):
            $this->db->where_in('company_id', $ids);
        endif;
        $this->db->where('status', "0");
      
       
        $res = $this->db->get('units');
        return array('num_rows' => $res->num_rows(), 'result' => $res->result_array());
    }

    function getUnOccupiedUnitsList($ids = array()) {
        if (count($ids)):
            $this->db->where_in('company_id', $ids);
        endif;
        $this->db->where("units.status ", '1');
        $this->db->or_where("units.status ", '2');
       
        
        $res = $this->db->get('units');
        return array('num_rows' => $res->num_rows(), 'result' => $res->result_array());
    }

    function getPaidUnits($ids = array()) {
        if (count($ids)):
         //   $this->db->where_in('properties.company_id', $ids);
        endif;
        $this->db->where("invoice_new.is_paid ", '1');
        $this->db->join('invoice_new', 'invoice_new.applicant_id=applications.id', 'left');
        $this->db->join('units', 'units.id =applications.unit_id', 'left');
       
        
        $res = $this->db->get('applications');
        return array('num_rows' => $res->num_rows(), 'result' => $res->result_array());
    }

    function getUnPaidUnits($ids = array()) {
        if (count($ids)):
        //    $this->db->where_in('properties.company_id', $ids);
        endif;
        $this->db->where("invoice_new.is_paid = '0'");
        $this->db->join('invoice_new', 'invoice_new.applicant_id=applications.id', 'left');
        $this->db->join('units', 'units.id =applications.unit_id', 'left');
        
       
        $res = $this->db->get('applications');
        return array('num_rows' => $res->num_rows(), 'result' => $res->result_array());
    }

}
