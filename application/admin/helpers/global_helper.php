<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function getblock() {
    $ci = & get_instance();
    $ci->db->from('block');
    $global_block = $ci->db->get();
    return $global_block->result_array();
}



/* End of file cms_helper.php */
/* Location: ./system/helpers/number_helper.php */