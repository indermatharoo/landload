<?php

class Venuemodel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function indentedList($ids = array()) {
        if (count($ids)) {
//            $ids = array_merge($ids, array(1));
            $this->db->where_in('user_id', $ids);
        }
        $query = $this->db->get('eventbooking_venues');
        return $query->result_array();
    }

    function getVenue($vid) {
        $this->db->where('venue_id', $vid);
        $result = $this->db->get('eventbooking_venues');
        return $result->row_array();
    }

    function insertRecord() {
        $data = array();
        $data['venue_name'] = $this->input->post('venue_name', true);
        $data['email'] = $this->input->post('email', true);
        $data['phone'] = $this->input->post('phone', true);
        $data['city'] = $this->input->post('city', true);
        $data['state'] = $this->input->post('state', true);
        $data['country'] = $this->input->post('country', true);
        $data['postcode'] = $this->input->post('postcode', true);
        $data['address'] = $this->input->post('address', true);
        $data['description'] = $this->input->post('description', true);
        $data['user_id'] = curUsrId();

        $config['upload_path'] = $this->config->item('UPLOAD_PATH_VENUES');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;
        $this->load->library('upload', $config);

        if (count($_FILES) > 0) {
            //Check for valid image upload
            if ($_FILES['image']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['image']['tmp_name'])) {
                if (!$this->upload->do_upload('image')) {
                    show_error($this->upload->display_errors('<p class="err">', '</p>'));
                    return FALSE;
                } else {
                    $upload_data = $this->upload->data();
                    $data['venue_image'] = $upload_data['file_name'];
                }
            }
        }

        $this->db->insert('eventbooking_venues', $data);
    }

    function updateRecord($venue) {
//        ep($_POST);
        $data = array();
        $data['venue_name'] = $this->input->post('venue_name', true);
        $data['email'] = $this->input->post('email', true);
        $data['phone'] = $this->input->post('phone', true);
        $data['city'] = $this->input->post('city', true);
        $data['state'] = $this->input->post('state', true);
        $data['country'] = $this->input->post('country', true);
        $data['postcode'] = $this->input->post('postcode', true);
        $data['address'] = $this->input->post('address', true);
        $data['description'] = $this->input->post('description', true);


        $config['upload_path'] = $this->config->item('UPLOAD_PATH_VENUES');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;
        $this->load->library('upload', $config);

        if (count($_FILES) > 0) {
            //Check for valid image upload
            if ($_FILES['image']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['image']['tmp_name'])) {
                if (!$this->upload->do_upload('image')) {
                    show_error($this->upload->display_errors('<p class="err">', '</p>'));
                    return FALSE;
                } else {
                    $upload_data = $this->upload->data();
                    $data['venue_image'] = $upload_data['file_name'];
                }
            }
        }
        $this->db->where('venue_id', $venue['venue_id']);
        $this->db->update('eventbooking_venues', $data);
    }

    function vanueDetele($vid) {
        $this->db->where('venue_id', $vid);
        $this->db->delete('eventbooking_venues');
        return $this->db->trans_complete();
    }

}

?>