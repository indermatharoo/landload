<?php

class Region extends CommonController {

    function __construct() {
        parent::__construct();
        $this->table = 'franchise_region';
        $this->page_view = $this->default;
        $this->controllername = 'user/region';
    }

    function index() {
        $inner['labels'] = array(
            'id' => 'Id',
            'name' => 'Name',
            'action' => 'Action'
        );
        $this->inner = $inner;
        $this->index_view = 'region/index';
        parent::index();
    }

    function add($id = null) {
        $model = $this->commonmodel->getByPk($id, $this->table);
        $this->inner['model'] = (array) $model;
        $this->index_view = 'region/add';
        parent::add();
    }

    function unique($name, $id = null) {
        $return['status'] = 0;
        if ($id)
            $this->db->where('id !=', $id);
        $this->db->where('name', $name);
        $row = $this->db->get($this->table)->row();
        $return['status'] = count($row);
        echo json_encode($return);
    }

}