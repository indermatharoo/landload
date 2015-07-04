<?php

class CommonController extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    public $table;
    public $inner = array();
    public $index_view;
    public $page_view;
    public $controllername;

    private function loadView() {
        $inner = array();
        $page = array();
        $inner = $this->inner;
        $inner['rows'] = $this->commonmodel->getAll($this->table);
        $page = array();
        $page['content'] = $this->load->view($this->index_view, $inner, TRUE);
        $this->load->view($this->page_view, $page);
    }

    function index() {
        $this->loadView();
    }

    function add() {        
        $data = rSF('franchise_region');
        if (arrIndex($data, 'name')) {
            if (arrIndex($data, 'id')) {
                $this->commonmodel->updateRecord($data, $data['id'], $this->table);
                $this->session->set_flashdata('SUCCESS', 'region_updated');
            } else {
                $this->commonmodel->insertRecord($data, $this->table);
                $this->session->set_flashdata('SUCCESS', 'region_added');
            }
            redirect($this->controllername . '/index');
        }
        $this->loadView();
    }

    function delete($id) {
        $this->commonmodel->delete($id, $this->table);
        $this->session->set_flashdata('SUCCESS', 'region_deleted');
        redirect($this->controllername . '/index');
    }

}
