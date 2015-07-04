<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Postcode extends Cms_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        show_404();
    }

    function find() {
        $keywords = trim($this->input->post('postcode', TRUE));
        $keywords = str_replace(' ', '', $keywords);
        $keywords = substr($keywords, 0, 3);
        //b139pg

        //$DB1 = $this->load->database('jasper', TRUE);

        $this->db->from('branch');
        $this->db->join('branch_postcode', 'branch_postcode.branch_id = branch.branch_id');
        $this->db->like("postcode", $keywords, "after");
        $this->db->group_by('branch.branch_id');
        $this->db->where('b_active', 1);
        $rs = $this->db->get();
        $branch = false;
        if ($rs && $rs->num_rows() > 0) {
            $branch = $rs->row_array();
        }

        $this->load->view('search-result', array('branch' => $branch));
    }

}

?>