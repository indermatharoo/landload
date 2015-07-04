<?php

class Attendancemodel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function getAll($eid) {
        $this->db->select('eventbooking_bookings_tickets.*, customer.*');
        $this->db->from('eventbooking_bookings_tickets');
        $this->db->join('eventbooking_bookings', 'eventbooking_bookings_tickets.booking_id = eventbooking_bookings.booking_id', 'left');
        $this->db->join('customer', 'customer.customer_id = eventbooking_bookings.customer_id', 'left');
        $this->db->where('eventbooking_bookings_tickets.event_id', $eid);
        $result = $this->db->get();
        return $result->result_array();
    }

    function saveAttendance() {
        $data = array();
        $data['is_used'] = $_POST['is_used'];
        $this->db->where('id', $_POST['id']);
        $this->db->update('eventbooking_bookings_tickets', $data);
        return $this->db->trans_complete();
    }

}

?>