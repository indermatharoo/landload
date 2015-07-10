<?php

class Reports extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('reportsmodel');
    }

    public function index() {
       
        $page = array();
        $inner = array();
        $page['content'] = $this->load->view('index', $inner, TRUE);;
        $this->load->view('themes/default/templates/customer', $page);
    }
    function property()
    {
        $occupiedList = $this->reportsmodel->getOccupiedUnitsList();
        $notOccupied = $this->reportsmodel->getUnOccupiedUnitsList(); 
        $page = array();
        $inner = array();
        $inner['occupiedList'] = $occupiedList;
        $inner['UnOccupiedUnitsList'] = $notOccupied;
        $page['content'] = $this->load->view('property', $inner, TRUE);;
        $this->load->view('themes/default/templates/customer', $page);
    }
    function account()
    {
        $PaidUnits = $this->reportsmodel->getPaidUnits();
        $UnPaidUnits = $this->reportsmodel->getUnPaidUnits();
        //e($PaidUnits);
        $notOccupied = $this->reportsmodel->getUnOccupiedUnitsList(); 
        $page = array();
        $inner = array();
        $inner['paidUnits'] = $PaidUnits;
        $inner['UnPaidUnits'] = $UnPaidUnits;
        $page['content'] = $this->load->view('accounts', $inner, TRUE);
        $this->load->view('themes/default/templates/customer', $page);
    }

}
