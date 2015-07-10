<?php

class Propertymodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function listAll() {
        $this->db->select('units.id as unit_id,units.*,properties.*')
                ->from('units')
                ->join('properties', 'units.property_id=properties.id');
        $rs = $this->db->get();
//        e($rs->result_array());
        return $rs->result_array();
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
        $this->db->select('units.id as unit_id,units.*,properties.*,properties_type.*')->from('units');
        $this->db->where('units.id', $uid);
        $this->db->join('properties', 'properties.id=units.property_id');
        $this->db->join('properties_type', 'properties.type=properties_type.short_code');
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
        $this->db->from('properties');
        $this->db->where('id', $id);
        $rs = $this->db->get();

        if ($rs->num_rows() > 0) {
            return $rs->row_array();
        }
        return FALSE;
    }

    function insertApplication() {
        $data['unit_id'] = $this->input->post('unit_id');
        $data['property_id'] = $this->input->post('property_id');
        $data['applicant_id'] = $this->input->post('applicant_id');
        $company = $this->getCompanyId($data['property_id']);
        $data['company_id'] = $company['company_id'];
        $applied_date = date('Y-m-d');

        $status = $this->db->insert('applications', $data);
        if ($status = 1) {
            $this->db->select('*');
            $this->db->from('applicants');
            $this->db->where('applicant_id', $data['applicant_id']);
            $rs = $this->db->get();

            if ($rs->num_rows() > 0) {
                return $rs->row_array();
            }
        }
    }

    function getAttributeValue($unit_id) {
        $this->db->from('units_attributes_value t1');
        $this->db->join('units_attributes t2', 't1.attribute_id=t2.id');
        $this->db->where('unit_id', $unit_id);
        $results = $this->db->get()->result_array();
        return $results;
    }

}

?>