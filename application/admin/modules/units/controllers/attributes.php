<?php

class Attributes extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('attributesmodel');
        $this->load->model('units/Unitsmodel');
    }

    function index() {
        $inner = $page = array();
        $inner['attributes'] = $this->attributesmodel->findAll();
        $inner['labels'] = array(
//            'class' => 'Class',
//            'name' => 'Name',
            'label' => 'Label',
            'unit_type' => 'Property Type',
            'sort' => 'Sort',
//            'searchable' => 'Searchable',
            -1 => 'Action'
        );
        $page['content'] = $this->load->view('attributes/index', $inner, true);
        $this->load->view('themes/default/templates/customer', $page);
    }

    function add() {
         $this->load->library('form_validation');
        if(arrIndex($_POST, 'type')=="dropdown")
        {
            if(empty(array_filter($_POST['drop'])))
            {
            $this->form_validation->set_rules('dropdown', 'Dropdown values', 'trim|required');
            }
        }
        $model = tableFields('units_attributes', true);
        $model['sort'] = 0;
        unset($model['id']);
        self::save($model, 0);
    }

    function edit($id) {
         $this->load->library('form_validation');
        $model = $this->commonmodel->getByPk($id, 'units_attributes');
        self::save($model, 1);
    }

    function delete($id) {
        $this->commonmodel->delete($id, 'units_attributes');
        $this->session->set_flashdata('SUCCESS', 'attribute_deleted');
        redirect('units/attributes');
    }

    function save($model, $edit = false) {
       
       $propertiesType = $this->Unitsmodel->getPropertiesType();
//        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('label', 'Label', 'required');
        $this->form_validation->set_rules('searchable', 'Searchable', 'required');
        $this->form_validation->set_rules('unit_type', 'Attribute Type', 'required');
        $this->form_validation->set_rules('sort', 'Sort Order', 'numeric');
        $this->form_validation->set_rules('type', 'Type', 'trim|required');
        

        
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        if ($this->form_validation->run() == FALSE) {
            $inner = $page = array();
            $inner['model'] = $model;
            $inner['edit'] = $edit;
            $inner['propertiesType'] = $propertiesType;
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
    function getAttributeVals($id=0)
    {
        $html = "";
        $drpdown = gParam('val');
        
        $drpdownVal = $this->attributesmodel->getAttributeVals($drpdown);
        
        foreach($drpdownVal as $val)
        {
            $html .= "<option value='".$val['id']."'>".$val['value']."</option>"; 
        }
        echo $html;
    }
    function getAttributeValue() {
        $unit_id = gParam('val');
        $type = gParam('type');
        $return['success'] = false;
        if ($unit_id || $type) {
            $return['data'] = $this->attributesmodel->getAttributeValue($unit_id, $type);
            if (count($return['data'])) {
                $return['success'] = true;
            }
        }
        echo json_encode($return);
    }
    function getAttributeValueByFields() {
        $unit_id = gParam('val');
        $type = gParam('type');
        $return['success'] = false;
        if ($unit_id || $type) {
            $return['data'] = $this->attributesmodel->getAttributeValueByFields($unit_id, $type);
            if (count($return['data'])) {
                $return['success'] = true;
            }
        }
        echo json_encode($return);
    }

}
