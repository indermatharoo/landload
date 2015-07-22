<?php

class Calendermodel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function getApplications() {
        $this->db->where('is_deal_start', 1);
        $this->db->from('applications');
        $rs = $this->db->get()->result_array();
        return $rs;
    }

    function getEventUser($ids = array()) {
        if (count($ids)) {
            $this->db->where_in('company_id', $ids);
        }
        $this->db->where('is_deal_start', 1);
        $this->db->from('applications');
        $rs = $this->db->get()->result_array();
        return $rs;
    }

    function getCompanyInvoices($ids = array(), $where = array()) {
        $this->db->select('t1.*,t3.unit_number,t3.unit_image,t3.description,UNIX_TIMESTAMP(created_on) * 1000 as start,UNIX_TIMESTAMP(created_on) * 1000 as end');
        if (count($ids)) {
            $this->db->where_in('company_id', $ids);
        }
        $this->db->from('invoice_new t1');
        foreach ($where as $key => $value):
            $this->db->where($key, $value);
        endforeach;
        $this->db->join('applications t2', 't2.id=t1.application_id');
        $this->db->join('units t3', 't3.id=t2.unit_id');
        $rs = $this->db->get()->result_array();
        return $rs;
    }

}

?>