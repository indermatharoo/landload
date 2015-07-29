<?php

class Propertymodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function listAll($attributes = array()) {

        $attributeWhere = $valueWhere = array();
        foreach ($attributes as $id => $value):
            if (empty($value))
                continue;
            $attributeWhere[] = $id;
            $valueWhere[] = 't3.value like "%' . $value . '%"';
        endforeach;
        if (count($valueWhere)) {
            $valueWhere = implode(' OR ', $valueWhere);
            $valueWhere = 'AND ' . $valueWhere;
        } else {
            $valueWhere = '';
        }
       
        $this->db->select('t1.id as unit_id,t1.*,t3.attribute_id as attribute_id,t3.value as attrbute_value');
        $this->db->from('units t1');
        
        $this->db->join('units_attributes_value t3', 't3.unit_id=t1.id ' . $valueWhere, 'left');
        $this->db->group_by('unit_id');
 $this->db->where('t1.status != "0"');
 
        if (count($attributeWhere))
            $this->db->where_in('attribute_id', $attributeWhere);
        $results = $this->db->get()->result_array(); 
        return $results;
    }

    function territoryList() {
        $this->db->select('territory_name');
        $this->db->group_by('territory_name');
        $this->db->where('territory_name !=', '');
        $rs = $this->db->get('user_extra_detail');
        return $rs->result_array();
    }

    function getProperty($uid) {
//      $this->db->select('page.*,aauth_users.pic,user_extra_detail.*');
        $this->db->select('units.id as unit_id,units.*,properties_type.*')->from('units');
        $this->db->where('units.id', $uid);
        // $this->db->join('properties', 'properties.id=units.property_id');
        $this->db->join('properties_type', 'units.property_type=properties_type.short_code');
        $rs = $this->db->get();
//        e($rs->result_array());
        //e($this->db->last_query());
        return $rs->row_array();
    }

    function getGalleryImages($uid) {
        $this->db->where('unit_id', $uid);
        $this->db->from('unit_image');
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return FALSE;
        //e($this->db->last_query());
    }

    function getAttributes($uid) {
        $this->db->where('unit_id', $uid);
        $this->db->from('units_attributes_value');
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->row_array();
        }
        return FALSE;
        //e($this->db->last_query());
    }

    function getEvent() {
        $this->db->from('eventbooking_events');
        $this->db->join('eventbooking_event_type', 'eventbooking_event_type.event_type_id = eventbooking_events.event_type_id', 'left');
        $this->db->join('eventbooking_venues', 'eventbooking_venues.venue_id = eventbooking_events.venue_id', 'left');
        $this->db->where('eventbooking_events.status', 1);
        $this->db->where('eventbooking_events.user_id', $_GET['uid']);
        $rs = $this->db->get();
        return $rs->result_array();
    }

    function eventDetail($eid) {
        $this->db->from('eventbooking_events');
        $this->db->join('eventbooking_event_type', 'eventbooking_event_type.event_type_id = eventbooking_events.event_type_id', 'left');
        $this->db->join('eventbooking_venues', 'eventbooking_venues.venue_id = eventbooking_events.venue_id', 'left');
        $this->db->where('eventbooking_events.event_id', $eid);
        $rs = $this->db->get();
        return $rs->row_array();
    }

    function sideLinks() {
        $this->db->from('front_events');
        $rs = $this->db->get();
        return $rs->result_array();
    }

    function testimonials() {
        $this->db->from('franchise_testimonials');
        $rs = $this->db->get();
        return $rs->result_array();
    }

    function getCompanyId($id) {

        $this->db->select('company_id');
        $this->db->from('units');
        $this->db->where('id', $id);
        $rs = $this->db->get();

        if ($rs->num_rows() > 0) {
            return $rs->row_array();
        }
        return FALSE;
    }

    function insertApplication() {
        $data['unit_id'] = $this->input->post('unit_id');
        // $data['property_id'] = $this->input->post('property_id');
        $data['applicant_id'] = $this->input->post('applicant_id');
        $data['rent_amount'] = $this->input->post('rent_amount');
        $data['invoice_amount'] = $this->input->post('rent_amount');
        $data['applied_date'] = date("Y-m-d H:i:s");
        $company = $this->getCompanyId($data['unit_id']);
        $data['company_id'] = $company['company_id'];
        $data['datetime'] = date('Y-m-d H:i:s');
        $applied_date = date('Y-m-d');

        return $this->db->insert('applications', $data);

        //echo $this->db->last_query();
        //exit;
    }

    function getAttributeValue($unit_id) {
        $this->db->from('units_attributes_value t1');
        $this->db->join('units_attributes t2', 't1.attribute_id=t2.id');
        $this->db->where('unit_id', $unit_id);
        $results = $this->db->get()->result_array();
        return $results;
    }

    function features($feature = '') {
        $ids = explode('|', $feature);
        $this->db->where_in('id', $ids);
        return $this->db->get('features')->result_array();
    }

}

?>