<?php

class Reports extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('reportsmodel');
    }

    function index() {
        $occupiedList = $this->reportsmodel->getOccupiedUnitsList($this->ids);
        $notOccupied = $this->reportsmodel->getUnOccupiedUnitsList($this->ids);
        $PaidUnits = $this->reportsmodel->getPaidUnits($this->ids);
        $UnPaidUnits = $this->reportsmodel->getUnPaidUnits($this->ids);
     //   e($occupiedList);
        $page = array();
        $inner = array();
        $inner['occupiedList'] = $occupiedList;
        $inner['UnOccupiedUnitsList'] = $notOccupied;
        $inner['paidUnits'] = $PaidUnits;
        $inner['UnPaidUnits'] = $UnPaidUnits;
        $page['content'] = $this->load->view('index', $inner, TRUE);
        ;
        $this->load->view('themes/default/templates/customer', $page);
    }


}
