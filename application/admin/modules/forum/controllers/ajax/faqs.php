<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faqs extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->is_admin_protected = TRUE;
    }

    function updateSortOrder() {
        $sort_data = $this->input->post('faq', true);
        foreach ($sort_data as $key => $val) {
            $update = array();
            $update['faq_sort_order'] = $key + 1;
            $this->db->where('faq_id', $val);
            $this->db->update('faq', $update);
        }

        print_r($_POST);
    }

}

?>