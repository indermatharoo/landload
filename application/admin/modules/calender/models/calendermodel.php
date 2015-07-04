<?php

class Calendermodel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function getType() {
        $result = $this->db->get('eventbooking_event_type');
        return $result->result_array();
    }

    function eventDetele($eid) {
        $data = array();
        $data['status'] = 0;
        $this->db->where('event_id', $eid);
        $this->db->update('eventbooking_events', $data);
        return $this->db->trans_complete();
    }

    function getEventUser($ids = array()) {
        $this->db->from('eventbooking_events');
        $this->db->join('eventbooking_event_type', 'eventbooking_event_type.event_type_id = eventbooking_events.event_type_id', 'left');
        $this->db->join('eventbooking_venues', 'eventbooking_venues.venue_id = eventbooking_events.venue_id', 'left');
        $this->db->where('eventbooking_events.status', 1);
        if (count($ids))
            $this->db->where_in('eventbooking_events.user_id',$ids);
        $rs = $this->db->get();        
        return $rs->result_array();
    }

    function getPrice($eid) {
        $this->db->where('event_id', $eid);
        $result = $this->db->get('eventbooking_prices');
        return $result->result_array();
    }

    function countAll() {
        $this->db->get('eventbooking_events');
        return $this->db->count_all_results();
    }

    function getEvents($ids = array()) {
        $this->db->order_by('event_id', 'ASC');
        if (count($ids)) {
            $this->db->where_in('user_id', $ids);
        }
        $result = $this->db->get('eventbooking_events');
        return $result->result_array();
    }

    function getEvent($eid) {
        $this->db->select('eventbooking_events.*,eventbooking_event_type.event_type');
        $this->db->where('event_id', $eid);
        $this->db->join('eventbooking_event_type', 'eventbooking_events.event_type_id = eventbooking_events.event_type_id');
        $result = $this->db->get('eventbooking_events');
        return $result->row_array();
    }

    /*
     * return json on event completion saving
     */

    function eventComplete($array = array()) {
        $return['status'] = false;
        $event_id = arrIndex($array, 'event_id');
        if ($event_id) {
            $this->db->where('event_id', $event_id);
            $result = $this->db->get('event_complete')->result_array();
            if (!count($result))
                $result = $this->db->insert('event_complete', $array);
            else {
                $this->db->where('event_id', $event_id);
                $result = $this->db->update('event_complete', $array);
            }
            if ($result) {
                $this->session->set_flashdata('SUCCESS', 'event_completed_saved');
                $return['status'] = true;
            } else {
                $this->session->set_flashdata('ERROR', 'event_completed_notsaved');
            }
        }
        echo json_encode($return);
    }

    /*
     * return of compeleted event
     */

    function getComEvent($eid) {
        if (!$eid)
            return FALSE;
        $this->db->where('event_id', $eid);
        $result = $this->db->get('event_complete')->row();
        $result = (array) $result;
        return $result;
    }

    function getVenues() {
        $this->db->select('venue_id,venue_name');
        if($this->aauth->isFranshisee()):
            $users[] = 1;
            $users[] = curUsrId();        
            $this->db->where_in('user_id',$users);
        endif;
        $result = $this->db->get('eventbooking_venues');
        return $result->result_array();
    }

    function insertRecord() {
        $data = array();
        $date = explode(' - ', $this->input->post('eventdate', true));
        $data['user_id'] = $this->aauth->get_user()->id;
        $data['event_type_id'] = $this->input->post('event_type_id', true);
        $data['event_title'] = $this->input->post('event_title', true);
        $data['venue_id'] = $this->input->post('venue', true);
        $data['description'] = $this->input->post('description', true);
        $data['event_start_ts'] = date('Y-m-d H:i:s', strtotime(trim($date[0])));
        $data['event_end_ts'] = date('Y-m-d H:i:s', strtotime(trim($date[1])));

        $config['upload_path'] = $this->config->item('UPLOAD_PATH_EVENTS');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;
        $this->load->library('upload', $config);
        if (count($_FILES) > 0) {
            //Check for valid image upload
            if ($_FILES['event_img']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['event_img']['tmp_name'])) {
                if (!$this->upload->do_upload('event_img')) {
                    show_error($this->upload->display_errors('<p class="err">', '</p>'));
                    return FALSE;
                } else {
                    $upload_data = $this->upload->data();
                    $data['event_img'] = $upload_data['file_name'];
                }
            }
        }

        $this->db->insert('eventbooking_events', $data);

        $event_id = $this->db->insert_id();

        $price = array();
        foreach ($_POST as $key => $row) {
            if (is_array($row)) {
                $index = 0;
                foreach ($row as $rowkey => $rowval) {
                    $price[$index][$key] = $rowval;
                    $index += 1;
                }
            }
        }

        $price_data = array();
        foreach ($price as $row) {
            $price_data['event_id'] = $event_id;
            $price_data['title'] = $row['title'];
            $price_data['price'] = $row['price'];
            $price_data['available'] = $row['available'];
            $this->db->insert('eventbooking_prices', $price_data);
        }
    }

    function updateRecord($event) {

        $data = array();
        //event booking
        $date = explode(' -', $this->input->post('eventdate', true));
        $data['event_type_id'] = $this->input->post('event_type_id', true);
        $data['event_title'] = $this->input->post('event_title', true);
        $data['venue_id'] = $this->input->post('venue_id', true);
        $data['description'] = $this->input->post('description', true);
        $data['event_start_ts'] = date('Y-m-d H:i:s', strtotime(trim($date[0])));
        $data['event_end_ts'] = date('Y-m-d H:i:s', strtotime(trim($date[1])));

        $config['upload_path'] = $this->config->item('UPLOAD_PATH_EVENTS');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;
        $this->load->library('upload', $config);

        if (count($_FILES) > 0) {
            //Check for valid image upload
            if ($_FILES['event_img']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['event_img']['tmp_name'])) {
                if (!$this->upload->do_upload('event_img')) {
                    show_error($this->upload->display_errors('<p class="err">', '</p>'));
                    return FALSE;
                } else {
                    $upload_data = $this->upload->data();
                    $data['event_img'] = $upload_data['file_name'];
                }
            }
        }

        //event confirmation email template
//        $data['o_email_confirmation_subject'] = $this->input->post('email_confirmation_subject', true);
//        $data['o_email_confirmation'] = $this->input->post('email_confirmation', true);
//        $data['o_email_payment_subject'] = $this->input->post('email_payment_subject', true);
//        $data['o_email_payment'] = $this->input->post('email_payment', true);
        //event term
//        $data['terms'] = $this->input->post('terms', true);
        //event ticket
        $data['ticket_info'] = $this->input->post('ticket_info', true);

        $config['upload_path'] = $this->config->item('UPLOAD_PATH_TICKETS');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;
        $this->load->library('upload', $config);

        if (count($_FILES) > 0) {
            //Check for valid image upload
            if ($_FILES['ticket_img']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['ticket_img']['tmp_name'])) {
                if (!$this->upload->do_upload('ticket_img')) {
                    show_error($this->upload->display_errors('<p class="err">', '</p>'));
                    return FALSE;
                } else {
                    $upload_data = $this->upload->data();
                    $data['ticket_img'] = $upload_data['file_name'];
                }
            }
        }

        $this->db->where('event_id', $event['event_id']);
        $this->db->update('eventbooking_events', $data);


        $price = array();
        foreach ($_POST as $key => $row) {
            if (is_array($row)) {
                $index = 0;
                foreach ($row as $rowkey => $rowval) {
                    $price[$index][$key] = $rowval;
                    $index += 1;
                }
            }
        }

        $this->db->where('event_id', $event['event_id']);
        $this->db->delete('eventbooking_prices');

        $price_data = array();
        foreach ($price as $row) {
            $price_data['event_id'] = $event['event_id'];
            $price_data['title'] = $row['title'];
            $price_data['price'] = $row['price'];
            $price_data['available'] = $row['available'];
            $this->db->insert('eventbooking_prices', $price_data);
        }
    }

}

?>