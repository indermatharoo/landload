<?php

class Reports extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('reportsmodel');
    }

//    public function index() {
//
//        $page = array();
//        $inner = array();
//        $page['content'] = $this->load->view('index', $inner, TRUE);
//        ;
//        $this->load->view('themes/default/templates/customer', $page);
//    }

    function index() {
        $occupiedList = $this->reportsmodel->getOccupiedUnitsList();
        $notOccupied = $this->reportsmodel->getUnOccupiedUnitsList();
        $PaidUnits = $this->reportsmodel->getPaidUnits();
        $UnPaidUnits = $this->reportsmodel->getUnPaidUnits();
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
//
//    function account() {
//        $PaidUnits = $this->reportsmodel->getPaidUnits();
//        $UnPaidUnits = $this->reportsmodel->getUnPaidUnits();
//
//        //  $notOccupied = $this->reportsmodel->getUnOccupiedUnitsList(); 
//        $page = array();
//        $inner = array();
//        $inner['paidUnits'] = $PaidUnits;
//        $inner['UnPaidUnits'] = $UnPaidUnits;
//        $page['content'] = $this->load->view('accounts', $inner, TRUE);
//        $this->load->view('themes/default/templates/customer', $page);
//    }

}
