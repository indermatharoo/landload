<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Block extends Admin_Controller {

	function __construct() {
		parent::__construct();
		$this->is_admin_protected = TRUE;
	}

	function updateSortOrder(){
		$sort_data = $this->input->post('menu', true);
		foreach($sort_data as $key=>$val) {
			$update = array();
			$update['sort_order'] = $key+1;
			$this->db->where('block_id', $val);
			$this->db->update('block', $update);
		}
		//echo "Done";
        print_r($_POST);
	}
}
?>