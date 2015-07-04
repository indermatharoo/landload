<?php

class Testimonials extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $table_name = 'franchise_testimonials';
        $inner = $page = array();
        $inner['labels'] = array(
            'Content',
            "Name",
            "Action"
        );
        $inner['models'] = $this->commonmodel->getAll($table_name);
        $page['content'] = $this->load->view('testimonials', $inner, true);
        $this->load->view($this->default, $page);
    }

    function add($id = null) {
        $table_name = 'franchise_testimonials';

        if (gParam('content') && gParam('name')) {
            $data = rSF($table_name);
            $data['user_id'] = curUsrId();
            if (!$id)
                $result = $this->commonmodel->insertRecord($data, $table_name);
            else
                $result = $this->commonmodel->updateRecord($data, $id, $table_name);
            if ($result) {
                redirect(createUrl('frontend/testimonials'));
            }
        }
        $model = $this->commonmodel->getByPk($id, $table_name);
        $inner = $page = array();
        $inner['model'] = $model;
        $page['content'] = $this->load->view('addtestimonials', $inner, true);
        $this->load->view($this->default, $page);
    }

    function delete($id = null) {
        if (!$id)
            return false;
        $this->commonmodel->delete($id, 'franchise_testimonials');
        redirect(createUrl('frontend/testimonials'));
    }

}
