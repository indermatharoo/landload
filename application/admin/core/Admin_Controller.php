<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_Controller extends CMS_Controller {

    protected $company_id;
    protected $ids = array();

    function __construct() {
        parent::__construct();
        isLogged();
        $this->_checkAuth();
        $this->shellFile = THEME . 'shell';
        $this->load->model('user/usermodel');
        self::init();
    }

    function init() {
        if ($this->aauth->isCompany()):
            $this->company_id = curUsrId();
        elseif ($this->aauth->isUser()):
            $this->company_id = curUsrPid();
        endif;
    }

    function _checkAuth() {
//        if (!$this->aauth->isFranshisor()) {
//            redirect(createUrl('welcome'));
//            exit();
//        }
    }

    function checkAccess($resource) {
        return true;
    }

}

?>
