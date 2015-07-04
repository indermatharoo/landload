<?php

class Ordermodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail($bid) {
//        $this->db->select('*');
        $this->db->from('eventbooking_bookings');
        $this->db->join('eventbooking_events', 'eventbooking_events.event_id = eventbooking_bookings.event_id', 'left');
        $this->db->join('user_extra_detail', 'eventbooking_events.user_id = user_extra_detail.id', 'left');
        $this->db->where('eventbooking_bookings.unique_id', $bid);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        return false;
    }

    //count all customer
    function countAll($customer) {

        $this->db->where('ordered_by', $customer['id']);
        //$this->db->where('confirmed',1);
        $query = $this->db->get('orders');
        return $this->db->count_all_results();
    }

    //List all customer
    function listAll($customer, $offset, $limit) {

        $this->db->offset($offset);
        $this->db->limit($limit);
        $this->db->from('orders');
        $this->db->where('orders.ordered_by', $customer['id']);
        $this->db->where('orders.confirmed', "");
//        $this->db->order_by('ordered', 'DESC');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    //fetch by id
    function fetchById($oid) {

        $this->db->select('*');
        $this->db->from('eventbooking_bookings');
        $this->db->where('booking_id', $oid);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        return false;
    }

    //fetch details
    function fetchDetails($onum) {
        $this->load->library('email');
        $this->load->library('parser');


        $data = array();
        $data['booking_status'] = 'confirmed';
        $this->db->where('unique_id', $onum);
        $this->db->update('eventbooking_bookings', $data);

        $this->db->select('*');
        $this->db->from('eventbooking_bookings');
        $this->db->where('unique_id', $onum);
        $query = $this->db->get();
        $booking = $query->row_array();
        //Send out email to store owner
        $order_details = array();
        $order_details['order'] = $booking;

        $emailData = array();
        $emailData['DATE'] = date("jS F, Y");
        $emailData['S_FIRSTNAME'] = $sorder['s_first_name'];
        $emailData['S_LASTNAME'] = $sorder['s_last_name'];
        $emailData['S_STREET'] = $sorder['s_address1'];
        $emailData['S_STREET2'] = $sorder['s_address2'];
        $emailData['S_CITY'] = $sorder['s_city'];
        $emailData['S_COUNTY'] = $sorder['s_county'];
        $emailData['S_POSTCODE'] = $sorder['s_postcode'];
        $emailData['S_PHONE'] = $sorder['s_phone'];
        $emailData['EMAIL'] = $sorder['email'];

        $emailData['B_FIRSTNAME'] = $sorder['b_first_name'];
        $emailData['B_LASTNAME'] = $sorder['b_last_name'];
        $emailData['B_STREET'] = $sorder['b_address1'];
        $emailData['B_STREET2'] = $sorder['b_address2'];
        $emailData['B_CITY'] = $sorder['b_city'];
        $emailData['B_COUNTY'] = $sorder['b_county'];
        $emailData['B_POSTCODE'] = $sorder['b_postcode'];
        $emailData['BASE_URL'] = base_url();
        $emailData['DATA'] = $order_details;


        $emailBody = $this->parser->parse('emails/admin-order-email', $emailData, TRUE);

        log_message($this->log_level, 'email body.here');
        log_message($this->log_level, 'email body.' . $emailBody);

        $this->email->initialize($this->config->item('EMAIL_CONFIG'));
        $this->email->from(DWS_EMAIL_NOREPLY, DWS_EMAIL_FROM);
        $this->email->to(DWS_EMAIL_ADMIN);

        //$this->email->bcc('js_thind@hotmail.com');
        $this->email->subject('New Order Placed');
        $this->email->message($emailBody);
        $this->email->send();
        //print_R($status); exit();
        //Send out email to customer
        $emailData = array();
        $emailData['DATE'] = date("jS F, Y");
        $emailData['BASE_URL'] = base_url();
        $emailData['DATA'] = $order_details;

        $emailBody = $this->parser->parse('emails/customer-order-details', $emailData, TRUE);

        $this->email->initialize($this->config->item('EMAIL_CONFIG'));
        $this->email->from(DWS_EMAIL_NOREPLY, DWS_EMAIL_FROM);
        $this->email->to($sorder['email']);
        $this->email->subject('Order Placed Successfully');
        $this->email->message($emailBody);
        $this->email->send();

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        return false;
    }

    function updateExistingOrder($data) {

        $this->db->where('id', $data['id']);

        $this->db->update('orders', $data);
    }

    function getMessage($myid) {

        $this->db->from('messenger');
        $this->db->where('oid', $myid);
        $this->db->order_by('sent', 'DESC');
//        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }

    function delMsg($id) {

        $this->db->where('id', $id);
        $status = $this->db->delete('messenger');
        return $status;
    }

}

?>