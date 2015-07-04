<?php

class Bookingmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getEvent($eid) {
        $this->db->from('eventbooking_events');
        $this->db->join('eventbooking_event_type', 'eventbooking_event_type.event_type_id = eventbooking_events.event_type_id');
//        $this->db->join('eventbooking_categories', 'eventbooking_categories.category_id = eventbooking_events.category_id');
        $this->db->where('eventbooking_events.event_id', $eid);
        $rs = $this->db->get();
        return $rs->row_array();
    }

    function getEventPrice($eid) {
        $this->db->from('eventbooking_prices');
        $this->db->where('event_id', $eid);
        $rs = $this->db->get();
        return $rs->row_array();
    }
    
    function listAll() {
        $this->db->select('aauth_users.id,aauth_users.name,user_extra_detail.region');
        $this->db->from('aauth_users');
        $this->db->join('aauth_user_to_group', 'aauth_users.id = aauth_user_to_group.user_id', 'left');
//        $this->db->join('page', 'page.user_id = aauth_users.id', 'left');
        $this->db->join('user_extra_detail', 'aauth_users.id = user_extra_detail.id', 'left');
        if ($_POST['c']) {
            $this->db->like('user_extra_detail.territory_name', $_POST['c']);
        }
        if ($_POST['p']) {
            $this->db->or_like('user_extra_detail.region', $_POST['p']);
        } else {
            $this->db->like('user_extra_detail.territory_name', 'United Kingdom');
        }
        $this->db->where('aauth_user_to_group.group_id', 3);
        $rs = $this->db->get();
        return $rs->result_array();
    }

    function getFranchisee($uid) {
        $this->db->from('page');
        $this->db->where('user_id', $uid);
        $rs = $this->db->get();
        return $rs->row_array();
    }

}

?>