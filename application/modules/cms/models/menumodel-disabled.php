<?php
class Menumodel extends CI_Model {
	private $CI;
	function __construct() {
		parent::__construct();
		$this->CI =& get_instance();
	}

	function getDetailsByAlias($alias) {
		$partner = $this->CI->core->getPartner();
		  
		$this->db->where('menu_alias', $alias);
		$this->db->where('partner_id', $partner['partner_id']);
		$rs = $this->db->get('partner_menu');
		if ($rs->num_rows() == 1) return $rs->row_array();

		return false;
	}


	//FUnction Menu
	function menu($params) {
		$partner = $this->CI->core->getPartner();
		
		if (!isset($params['menu_alias'])) return false;

		$menu = $this->getDetailsByAlias($params['menu_alias']);
		if(!$menu) return false;

		$params['partner_menu_id'] = $menu['partner_menu_id'];

		//Fetch root menu items
		$this->db->from('partner_menu_item');
		$this->db->where('partner_menu_item.parent_id', 0);
		$this->db->where('partner_menu_item.partner_menu_id', $params['partner_menu_id']);
		$this->db->order_by('menu_sort_order', 'ASC');
		$rs = $this->db->get();
		if($rs->num_rows() == 0) return false;
		$rows = $rs->result_array();

		$params['first_menu_id'] = $rows[0]['partner_menu_item_id'];
		$tmp = array_pop($rows);
		$params['last_menu_id'] = $tmp['partner_menu_item_id'];

		$menu = $this->_menu($params);

		return str_replace('{MENU}', $menu, $params['ul_format']);
	}

	function _menu($params, $parent_id = 0, $output = '') {
		$partner = $this->CI->core->getPartner();
		
		$this->db->from('partner_menu_item');
		$this->db->join('partner_menu', 'partner_menu_item.partner_menu_id = partner_menu.partner_menu_id');
		$this->db->join('partner_content', 'partner_content.partner_content_id = partner_menu_item.menu_item', 'LEFT OUTER');
		$this->db->where('partner_menu_item.parent_id', $parent_id);
		$this->db->where('partner_menu_item.partner_menu_id', $params['partner_menu_id']);
		$this->db->where('partner_menu.partner_id', $partner['partner_id']);
		$this->db->order_by('menu_sort_order', 'ASC');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			if ($parent_id == 0) {
				//$output .= '<ul class="'.$params['ul_class'].'">' . "\r\n";
			} else {
				$output .= "<ul>\r\n";
			}

			foreach ($query->result_array() as $row) {
				//li tag class
				$li_class_arr = array();
				$li_class = '';
				if($row['partner_menu_item_id'] == $params['first_menu_id']){
					$li_class_arr[] = "first";
				}
				if($row['partner_menu_item_id'] == $params['last_menu_id']){
					$li_class_arr[] = "last";
				}
				if(isset($params['list_class'])) {
					$li_class_arr[] = $params['list_class'];
				}
				if($parent_id == 0) {
					$li_class_arr[] = "root_menu";
				}
				if($row['partner_content_id'] != 0) {
					$cpage = $this->CI->getPage();
					if($cpage && $row['partner_content_id'] == $cpage['partner_content_id']) {
						$li_class_arr[] = "current";
					}
				}
				$li_class = trim(join(' ', $li_class_arr));

				//anchor tag class
				$a_class_arr = array();
				$a_class = '';
				if(isset($params['anchor_class'])) {
					$a_class_arr[] = $params['anchor_class'];
				}
				if($row['partner_content_id'] != 0) {
					$cpage = $this->CI->getPage();
					if($cpage && $row['partner_content_id'] == $cpage['partner_content_id']) {
						$a_class_arr[] = "current";
					}
				}
				$a_class = trim(join(' ', $a_class_arr));

				$href = '';
				switch($row['menu_item_type']) {
					case 'url':
						//Get Company Details
						//$company = $this->CI->core->getCompany();
						
						$href = $row['menu_item'];
						$match = array('{base_url}', '{base_url_ssl}', '{base_url_nossl}', '{partner}');
						$replace = array($this->CI->baseURL(), $this->CI->baseURLSSL(), $this->CI->baseURLNoSSL(), $partner['partner_url_alias']);
						$href = str_replace($match, $replace, $href);
						//echo $href;
						break;
					case 'page':
						$href = $partner['partner_url_alias'].'/'.$row['page_uri'];
						break;
					case 'placeholder':
						
						$href = 'javascript:void(0)';
						break;
				}

				if($parent_id == 0) {
					$link = $params['level_1_format'];
				}else {
					$link = $params['level_2_format'];
				}

				//Additional
				$new_window = '';
				if($row['new_window'] == 1) {
					$new_window = ' target="_blank"';
				}

				$match = array('{HREF}', '{ADDITIONAL}', '{CLASSES}', '{LINK_NAME}');
				$replace = array($href, $new_window, $a_class, $row['menu_item_name']);

				$output .= '<li class="'.$li_class.'">';
				$output .= str_replace($match, $replace, $link);
				$output .= "\r\n";

				$output = $this->_menu($params, $row['partner_menu_item_id'], $output);

				$output .= "</li>\r\n";
			}

			if ($parent_id > 0) {
				$output .= "</ul>\r\n";
			}
		}
		return $output;
	}

}

?>