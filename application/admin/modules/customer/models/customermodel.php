<?php

class Customermodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    //get detail of Customer
    function getdetails($cid) {
        if (!$cid)
            return false;
        $query = $this->db->select('*')->from('customer')
                ->where('customer_id', $cid)
                ->get();
        if ($query->num_rows()) {
            return $query->row_array();
        }
        return false;
    }

    function getBookingDetail() {
        $dataTime = date('Y-m-d h:m:s');
        $this->db->where('event_start_ts >', $dataTime);
        $this->db->from('eventbooking_events');
        $this->db->join('eventbooking_event_type', 'eventbooking_event_type.event_type_id = eventbooking_events.event_type_id', 'left');
        $this->db->join('eventbooking_venues', 'eventbooking_venues.venue_id = eventbooking_events.venue_id', 'left');
        $results = $this->db->where('eventbooking_events.status', 1);
        $results = $this->db->get()->result_array();
//        e($results);
        return $results;
    }

    //Count All Customer
    function countAll($ids = array()) {
        $CI = & get_instance();
        if (count($ids))
            $this->db->where_in('auth_user_id', $ids);
        return $this->db->count_all_results('customer');
    }

    //list all Customer
    function listAll($ids = array()) {
        $this->db->select('customer.*,aauth_users.last_login');
        $this->db->from('customer');
        $this->db->join('aauth_users', 'aauth_users.id=customer.user_id');
        $rs = $this->db->get()->result_array();

        return $rs;
    }

    //update record
    function insertRecord($customer) {
//        gAParams();
        $data = rSF('customer');
        $user_id = $this->aauth->create_user(arrIndex($data, 'email'), arrIndex($data, 'passwd'), arrIndex($data, 'first_name'), 6, 0, curUsrId(), false, 0, array('internal' => true));
        if ($user_id) {
            echo "<pre>";
            var_dump($user_id);
            $data['customer_id'] = $user_id;

            $data['auth_user_id'] = $user_id;
            $this->db->insert('customer', $data);
            $customer_user_id = $this->db->insert_id();
        }
        return $user_id;
    }

    //update record
    function updateRecord($customer) {
        $data = array();
        $data = rSF('customer');
        $this->aauth->update_user($data['auth_user_id'], arrIndex($data, 'email'), arrIndex($data, 'passwd'), arrIndex($data, 'first_name'), FALSE);
        $this->db->where('auth_user_id', arrIndex($data, 'auth_user_id'))
                ->update('customer', $data);
        return;
    }

    //disable record
    function deleteRecord($customer) {
        $this->db->where('auth_user_id', $customer);
        $this->db->delete('customer');
        $this->aauth->delete_user($customer);
    }

}
