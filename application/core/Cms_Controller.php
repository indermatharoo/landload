<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cms_Controller extends CI_Controller {
	private $page = false;
	
    function __construct() {
        parent::__construct();
    }
	
	function setPage($page) {
		$this->page = $page;
	}

	function getPage() {
		return $this->page;
	}

}

/* End of file cms.php */
/* Location: ./application/libraries/cms.php */