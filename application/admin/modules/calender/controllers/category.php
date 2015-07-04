<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->is_admin_protected = TRUE;
        isLogged();
        $this->load->model('user/usermodel');
    }

    //*************************************validation End********************************
    //function index
    function index() {
        $this->load->model('Categorymodel');

        $categories = array();
        $categories = $this->Categorymodel->indentedList();
//       ep($categories);

        $inner = array();

        $inner['categories'] = $categories;

        $page = array();
        $page['content'] = $this->load->view('category/category-index', $inner, TRUE);
        $this->load->view($this->event, $page);
    }

    //function add
    function add() {
        $this->load->model('Categorymodel');
        $this->load->library('form_validation');
        $this->load->helper('form');


//        $categories = $this->Categorymodel->indentedListTwo();
//        print_r($categories); exit();
//        foreach ($categories as $row) {
//            $parent[$row['category_id']] = str_repeat('&nbsp;', ($row['depth']) * 8) . $row['category'];
//        }
        //print_r($parent); exit();
        //validation check
        $this->form_validation->set_rules('category', 'Category Name', 'trim|required');

        $this->form_validation->set_error_delimiters('<li>', '</li>');



        if ($this->form_validation->run() == FALSE) {
            $inner = array();

            $page = array();
            $page['content'] = $this->load->view('category/category-add', $inner, TRUE);
            $this->load->view($this->event, $page);
        } else {
            $this->Categorymodel->insertRecord();
            $this->session->set_flashdata('SUCCESS', 'category_added');
            redirect("calender/category/index", 'location');
            exit();
        }
    }

    //function edit
    function edit($cid = false) {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('Categorymodel');

        //get category detail 
        $current_category = array();
        $current_category = $this->Categorymodel->getdetails($cid);

        if (!$current_category) {
            $this->utility->show404();
            return;
        }

        //validation check
        $this->form_validation->set_rules('category', 'Category Name', 'trim|required');
        $this->form_validation->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $page = array();
            $inner['current_category'] = $current_category;
            $page['content'] = $this->load->view('category/category-edit', $inner, TRUE);
            $this->load->view($this->event, $page);
        } else {
            $this->Categorymodel->updateRecord($current_category);
            $this->session->set_flashdata('SUCCESS', 'category_updated');
            redirect("calender/category/index", 'location');
            exit();
        }
    }

    function disable($cid = false) {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('Categorymodel');

        //get category detail 
        $current_category = array();
        $current_category = $this->Categorymodel->getdetails($cid);
        if (!$current_category) {
            $this->utility->show404();
            return;
        }

        $this->Categorymodel->disableRecord($current_category);

        $this->session->set_flashdata('SUCCESS', 'category_updated');

        redirect("calender/category/index/");
        exit();
    }

        function enable($tid = false) {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('Categorymodel');

        //get category detail 
        $current_category = array();
        $current_category = $this->Categorymodel->getdetails($tid);
        if (!$current_category) {
            $this->utility->show404();
            return;
        }

        $this->Categorymodel->enableRecord($current_category);

        $this->session->set_flashdata('SUCCESS', 'category_updated');

        redirect("calender/category/index/");
        exit();
    }
    
    //function delete
    function delete($cid = false) {
        $this->load->model('Categorymodel');
        $this->load->library('form_validation');
        $this->load->helper('form');

        //get category detail 
        $current_category = array();
        $current_category = $this->Categorymodel->getdetails($cid);
        if (!$current_category) {
            $this->utility->show404();
            return;
        }

        $this->Categorymodel->deleteCategory($current_category);
        $this->session->set_flashdata('SUCCESS', 'category_deleted');
        redirect('calender/category/index/');
        exit();
    }

}

?>