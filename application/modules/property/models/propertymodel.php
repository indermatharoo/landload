<?php

class Propertymodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function listAll() {
        $this->db->select('units.id as unit_id,units.*')
                ->from('units')
                ->join('properties','units.property_id=properties.id');
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
        $this->db->where('units.id', $uid);
        $this->db->from('units');
        $this->db->join('properties', 'properties.id=units.property_id');
        $rs = $this->db->get();
        e($this->db->last_query());
        return $rs->row_array();
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

}

?>