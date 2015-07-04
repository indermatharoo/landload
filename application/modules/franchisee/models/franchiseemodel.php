<?php

class Franchiseemodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function listAll() {
        $this->db->select('aauth_users.id,aauth_users.name,user_extra_detail.region,user_extra_detail.bussiness_address,user_extra_detail.lat,user_extra_detail.log,user_extra_detail.territory_name');
        $this->db->from('aauth_users');
        $this->db->join('aauth_user_to_group', 'aauth_users.id = aauth_user_to_group.user_id', 'left');
//        $this->db->join('page', 'page.user_id = aauth_users.id', 'left');
        $this->db->join('user_extra_detail', 'aauth_users.id = user_extra_detail.id', 'left');
//        if (!empty($_POST['c'])) {
//            $this->db->like('user_extra_detail.territory_name', $_POST['c']);
//        }
//        if (!empty($_POST['p'])) {
//            $this->db->or_like('user_extra_detail.post_code', $_POST['p']);
//            $this->db->or_like('user_extra_detail.region', $_POST['p']);
//        } else {
//            $this->db->like('user_extra_detail.territory_name', 'United Kingdom');
//        }
        $this->db->where('aauth_user_to_group.group_id', 3);
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

    function getFranchisee($uid) {
//        $this->db->select('page.*,aauth_users.pic,user_extra_detail.*');
        $this->db->where('aauth_users.id', $uid);
        $this->db->from('aauth_users');
        $this->db->join('user_extra_detail', 'user_extra_detail.id=aauth_users.id');
        $this->db->join('page','page.user_id=aauth_users.id','left');
        $rs = $this->db->get();
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