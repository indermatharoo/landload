<?php

class Attributes extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('attributesmodel');
    }

    function index() {
        $inner = $page = array();
        $inner['attributes'] = $this->attributesmodel->findAll();
        $inner['labels'] = array(
            'class' => 'Class',
            'name' => 'Name',
            'label' => 'Label',
            'sort' => 'Sort',
            0 => 'Action'
        );
        $page['content'] = $this->load->view('attributes/index', $inner, true);
        $this->load->view('themes/default/templates/customer', $page);
    }

    function add() {
        $model = tableFields('units_attributes', true);
        unset($model['id']);
        self::save($model);
    }

    function update($id) {
        $model = $this->commonmodel->getByPk($id, 'units_attributes');
        self::save($model);
    }

    function save($model) {
//        e($model);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('sort', 'Property ', 'numeric');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        if ($this->form_validation->run() == FALSE) {
            $inner = $page = array();
            $inner['model'] = $model;
            $page['content'] = $this->load->view('attributes/form', $inner, true);
            $this->load->view('themes/default/templates/customer', $page);
        } else {
            echo 'ok';exit;
        }
    }

}
