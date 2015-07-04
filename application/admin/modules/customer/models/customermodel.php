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
        $this->db->join('aauth_users','aauth_users.id=customer.user_id');
        $rs = $this->db->get()->result_array();
        
        return $rs;
    }



    //update record
    function insertRecord($customer) {
        $data = array();
        $data['first_name'] = $this->input->post('first_name', TRUE);
        $data['last_name'] = $this->input->post('last_name', TRUE);
        $data['email'] = $this->input->post('email', TRUE);
        $data['passwd'] = $this->input->post('passwd', TRUE);
        $data['delivery_address1'] = $this->input->post('delivery_address1', TRUE);
        $data['delivery_address2'] = $this->input->post('delivery_address2', TRUE);
        $data['delivery_phone'] = $this->input->post('delivery_phone', TRUE);
        $data['delivery_city'] = $this->input->post('delivery_city', TRUE);
        $data['delivery_zipcode'] = $this->input->post('delivery_zipcode', TRUE);
        $data['linkedin'] = $this->input->post('linkedin', TRUE);
        $data['twitter'] = $this->input->post('twitter', TRUE);
        $data['facebook'] = $this->input->post('facebook', TRUE);
        $data['user_id'] = curUsrId();
        print_R($_POST);
        die();
       // echo matches[passconf]; 
        
        $user_id = $this->aauth->create_user($data['email'], $data['passwd'], $data['first_name'], 6, 0,$this->aauth->get_user()->id, false, 0, array('internal' => true));
        if ($user_id) {
            $data['auth_user_id'] = $user_id;
            $this->db->insert('customer', $data);
            $customer_user_id = $this->db->insert_id();
        }
        return;
    }

    //update record
    function updateRecord($customer) {
        $data = array();
        $data['first_name'] = $this->input->post('first_name', TRUE);
        $data['last_name'] = $this->input->post('last_name', TRUE);
        $data['email'] = $this->input->post('email', TRUE);
        $data['passwd'] = $this->input->post('passwd', TRUE);
        $data['auth_user_id'] = $this->input->post('auth_user_id', TRUE);
        // $data['store_id'] = false;
        $datas['editCutomer'] = $this->input->post('editCutomer', TRUE);
        $data['linkedin'] = $this->input->post('linkedin', TRUE);
        $data['twitter'] = $this->input->post('twitter', TRUE);
        $data['facebook'] = $this->input->post('facebook', TRUE);
        $data['delivery_address1'] = $this->input->post('delivery_address1', TRUE);
        $data['delivery_address2'] = $this->input->post('delivery_address2', TRUE);
        $data['delivery_phone'] = $this->input->post('delivery_phone', TRUE);
        $data['delivery_city'] = $this->input->post('delivery_city', TRUE);
        $data['delivery_zipcode'] = $this->input->post('delivery_zipcode', TRUE);


        $this->aauth->update_user($data['auth_user_id'], $data['email'], $data['passwd'], $data['first_name'], FALSE);
        $this->db->where('auth_user_id', $data['auth_user_id'])
                ->update('customer', $data);
        $this->db->where('customer_id', $datas['editCutomer'])
                ->delete('customer_children');


        return;
    }

    //disable record
    function deleteRecord($customer) {
        $this->db->where('auth_user_id', $customer);
        $this->db->delete('customer');
        $this->aauth->delete_user($customer);
    }

}
