<?php

class Bookingsmodel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function countAll($ids = array()) {
        $uid = curUsrId();
        $this->db->from('eventbooking_bookings');
        $this->db->join('eventbooking_events', 'eventbooking_events.event_id = eventbooking_bookings.event_id');
        if (count($ids))
            $this->db->where_in('eventbooking_events.user_id', $ids);
        $this->db->get();
        return $this->db->count_all_results();
    }

    function getBookings($offset = FALSE, $limit = FALSE, $ids = array()) {
        $uid = curUsrId();
        $this->db->from('eventbooking_bookings');
        $this->db->join('eventbooking_events', 'eventbooking_events.event_id = eventbooking_bookings.event_id', 'left');
        $this->db->join('customer', 'eventbooking_bookings.customer_id = customer.customer_id', 'left');
        if ($offset)
            $this->db->offset($offset);
        if ($limit)
            $this->db->limit($limit);
        if (count($ids))
            $this->db->where_in('eventbooking_events.user_id', $ids);
        $result = $this->db->get();
        return $result->result_array();
    }

    function getEvents($ids = array()) {
        $this->db->select('event_id,event_title,event_start_ts,event_end_ts');
        if (count($ids))
            $this->db->where_in('user_id', $ids);
        $result = $this->db->get('eventbooking_events');
        return $result->result_array();
    }

    function getBooking($bid) {
        $this->db->where('booking_id', $bid);
        $result = $this->db->get('eventbooking_bookings');
        return $result->row_array();
    }

    function insertRecord() {
        $data = array();
        $data = rSF('eventbooking_bookings');
        $this->db->insert('eventbooking_bookings', $data);

        $booking_id = $this->db->insert_id();
        $ticket = array();
        for ($i = 0; $i < $_POST['ctn']; $i++) {
            foreach ($_POST as $row) {
                $ticket[$i] = $_POST;
            }
        }

        $no = 1;
        $ticket_data = array();
        foreach ($ticket as $row) {
            $ticket_data['booking_id'] = $booking_id;
            $ticket_data['event_id'] = $row['event_id'];
            $ticket_data['ticket_id'] = $row['unique_id'] . '-' . $no;
            $this->db->insert('eventbooking_bookings_tickets', $ticket_data);
            $no++;
        }
    }

    function updateRecord($booking) {
        $data = array();
        $data = rSF('eventbooking_bookings');
        $this->db->where('booking_id', $booking['booking_id']);
        $this->db->update('eventbooking_bookings', $data);

        $ticket = array();
        for ($i = 0; $i < $_POST['ctn']; $i++) {
            foreach ($_POST as $row) {
                $ticket[$i] = $_POST;
            }
        }
        $this->db->where('booking_id', $booking['booking_id']);
        $this->db->delete('eventbooking_bookings_tickets');
        $no = 1;
        $ticket_data = array();
        foreach ($ticket as $row) {
            $ticket_data['booking_id'] = $booking['booking_id'];
            $ticket_data['event_id'] = $row['event_id'];
            $ticket_data['ticket_id'] = $row['unique_id'] . '-' . $no;
            $this->db->insert('eventbooking_bookings_tickets', $ticket_data);
            $no++;
        }
    }

    function getCustomer($ids = array()) {
        if (count($ids))
            $this->db->where_in('user_id', $ids);
        $result = $this->db->get('customer');
        return $result->result_array();
    }

    function bookingDetele($bid) {
        $this->db->where('booking_id', $bid);
        $this->db->delete('eventbooking_bookings');
        $this->db->where('booking_id', $bid);
        $this->db->delete('eventbooking_bookings_tickets');
        return $this->db->trans_complete();
    }

}

?>