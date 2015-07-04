<?php

class Stockmodel extends CI_Model   {
    
    function __construct() {
        parent::__construct();
    }
        
    function getFrannchiseWithStore()   {
        $this->db->where('store_id <>',"");
        $this->db->from('user_extra_detail');
        $this->db->join('aauth_users','aauth_users.id=user_extra_detail.id');
        $rs = $this->db->get()->result_array();
        return $rs;
    }
    
}