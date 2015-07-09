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
//            'searchable' => 'Searchable',
            -1 => 'Action'
        );
        $page['content'] = $this->load->view('attributes/index', $inner, true);
        $this->load->view('themes/default/templates/customer', $page);
    }

    function add() {
        $model = tableFields('units_attributes', true);
        unset($model['id']);
        self::save($model);
    }

    function edit($id) {
        $model = $this->commonmodel->getByPk($id, 'units_attributes');
        self::save($model);
    }

    function delete($id) {
        $this->commonmodel->delete($id, 'units_attributes');
        $this->session->set_flashdata('SUCCESS', 'attribute_deleted');
        redirect('units/attributes');
    }

    function save($model) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('label', 'Label', 'required');
        $this->form_validation->set_rules('searchable', 'Searchable', 'required');
        $this->form_validation->set_rules('unit_type', 'Attribute Type', 'required');
        $this->form_validation->set_rules('sort', 'Sort Order', 'numeric');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        if ($this->form_validation->run() == FALSE) {
            $inner = $page = array();
            $inner['model'] = $model;
            $page['content'] = $this->load->view('attributes/form', $inner, true);
            $this->load->view('themes/default/templates/customer', $page);
        } else {
            $this->attributesmodel->save();
            redirect('units/attributes');
        }
    }

    function getAttribute() {
        $attribute = gParam('val');
        $return['success'] = false;
        if ($attribute) {
            $return['data'] = $this->attributesmodel->getAttributes($attribute);
            if (count($return['data'])) {
                $return['success'] = true;
            }
        }
        echo json_encode($return);
    }

}
