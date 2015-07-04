<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logout extends Cms_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->aauth->logout();
        redirect(base_url());
        exit();
    }

}

?>
