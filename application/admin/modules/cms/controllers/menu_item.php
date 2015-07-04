<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu_item extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->is_admin_protected = TRUE;
    }

    function index($mid = '', $offset = 0) {
        $this->load->model('Menulinkmodel');
        $this->load->model('Menumodel');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->library('pagination');

        if (!$this->checkAccess('MANAGE_MENU_ITEMS')) {
            $this->utility->accessDenied();
            return;
        }

        //fetch the menu details
        $menu_detail = array();
        $menu_detail = $this->Menumodel->detail($mid);
        if (!$menu_detail) {
            $this->utility->show404();
            return;
        }

        //Fetch pagetree
        $menutree = '';
        $menutree = $this->Menulinkmodel->menuItemTree(0, $menu_detail['menu_id']);

        $menu_items = array();
        $menu_items = $this->Menulinkmodel->getAll($menu_detail['menu_id']);

        //render view
        $inner = array();
        $inner['menu_detail'] = $menu_detail;
        $inner['menu_items'] = $menu_items;
        $inner['menutree'] = $menutree;
        $inner['pagination'] = $this->pagination->create_links();

        $page = array();
        $page['content'] = $this->load->view('menu_items/listing', $inner, TRUE);
        $this->load->view($this->content, $page);
    }

    //function add
    function add($mid = false) {
        $this->load->model('Menulinkmodel');
        $this->load->model('Menumodel');
        $this->load->model('Pagemodel');
        $this->load->library('form_validation');
        $this->load->helper('form');

        if (!$this->checkAccess('ADD_MENU_ITEM')) {
            $this->utility->accessDenied();
            return;
        }

        //fetch the menu details
        $menu_detail = array();
        $menu_detail = $this->Menumodel->detail($mid);
        if (!$menu_detail) {
            $this->utility->show404();
            return;
        }

        //fetc the menu item  indentedList
        $parent_menu = array();
        $parent_menu['0'] = 'Root';
        $rs = $this->Menulinkmodel->indentedList($menu_detail['menu_id']);
        foreach ($rs as $row) {
            $parent_menu[$row['menu_item_id']] = str_repeat('&nbsp;', ($row['menu_item_level']) * 8) . $row['menu_item_name'];
        }

        //fetch the main page
        $pages = array();
        $pages[''] = 'Select';
        $rs = $this->Pagemodel->indentedActiveList(0);
        foreach ($rs as $row) {
            $pages[$row['page_id']] = str_repeat('&nbsp;', ($row['level']) * 8) . $row['browser_title'];
        }

        //Menu item types
        $menu_item_types = array();
        $menu_item_types[''] = 'Select';
        $menu_item_types['page'] = 'Page';
        $menu_item_types['url'] = 'URL';
        $menu_item_types['placeholder'] = 'Placeholder';

        //Form Validations
        $this->form_validation->set_rules('parent_id', 'Parent Name', 'trim');
        $this->form_validation->set_rules('menu_item_type', 'Menu Item Type', 'trim|required');
        $this->form_validation->set_rules('menu_item_name', 'Link Name', 'trim|required');
        switch ($this->input->post('menu_item_type', TRUE)) {
            case "page":
                $this->form_validation->set_rules('page_id', 'Page', 'trim|required');
                break;
            case "url":
                $this->form_validation->set_rules('url', 'URL', 'trim|required');
                break;
        }
        $this->form_validation->set_rules('new_window', 'Open in New Window', 'trim|required');
        $this->form_validation->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $shell = array();

            $inner['parent_menu'] = $parent_menu;
            $inner['pages'] = $pages;
            $inner['menu_detail'] = $menu_detail;
            $inner['menu_item_types'] = $menu_item_types;
            $shell['content'] = $this->load->view('menu_items/add', $inner, TRUE);
            $this->load->view($this->content, $shell);
        } else {
            $this->Menulinkmodel->insertRecord($menu_detail);

            $this->session->set_flashdata('SUCCESS', 'menu_item_added');

            redirect("cms/menu_item/index/$mid/", 'location');
            exit();
        }
    }

    //function edit page link
    function edit($m_item_id = false) {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('Menulinkmodel');
        $this->load->model('Pagemodel');

        if (!$this->checkAccess('EDIT_MENU_ITEM')) {
            $this->utility->accessDenied();
            return;
        }

        //Get Page Details
        $menu_item = array();
        $menu_item = $this->Menulinkmodel->details($m_item_id);
        if (!$menu_item) {
            $this->utility->show404();
            return;
        }

        //fetc the menu item  indentedList
        $parent_menu = array();
        $parent_menu['0'] = 'Root';
        $rs = $this->Menulinkmodel->indentedList($menu_item['menu_id'], $menu_item['menu_item_id']);
        foreach ($rs as $row) {
            $parent_menu[$row['menu_item_id']] = str_repeat('&nbsp;', ($row['menu_item_level']) * 8) . $row['menu_item_name'];
        }


        //fetch the main page
        $pages = array();
        $pages[''] = 'Select';
        $rs = $this->Pagemodel->indentedActiveList(0);
        foreach ($rs as $row) {
            $pages[$row['page_id']] = str_repeat('&nbsp;', ($row['level']) * 8) . $row['browser_title'];
        }

        //Menu item types
        $menu_item_types = array();
        $menu_item_types[''] = 'Select';
        $menu_item_types['page'] = 'Page';
        $menu_item_types['url'] = 'URL';
        $menu_item_types['placeholder'] = 'Placeholder';

        //Form Validations
        $this->form_validation->set_rules('parent_id', 'Parent Name', 'trim');
        $this->form_validation->set_rules('menu_item_type', 'Menu Item Type', 'trim|required');
        $this->form_validation->set_rules('menu_item_name', 'Link Name', 'trim|required');
        switch ($this->input->post('menu_item_type', TRUE)) {
            case "page":
                $this->form_validation->set_rules('page_id', 'Page', 'trim|required');
                break;
            case "url":
                $this->form_validation->set_rules('url', 'URL', 'trim|required');
                break;
        }
        $this->form_validation->set_rules('new_window', 'Open in New Window', 'trim|required');
        $this->form_validation->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $page = array();
            $inner['menu_item'] = $menu_item;
            $inner['parent_menu'] = $parent_menu;
            $inner['pages'] = $pages;
            $inner['menu_item_types'] = $menu_item_types;
            $page['content'] = $this->load->view('menu_items/edit', $inner, TRUE);
            $this->load->view($this->content, $page);
        } else {
            $this->Menulinkmodel->updateRecord($menu_item);

            $this->session->set_flashdata('SUCCESS', 'menu_item_updated');

            redirect("cms/menu_item/index/{$menu_item['menu_id']}");
            exit();
        }
    }

    //function add link
    function addurl($mid = false) {
        $this->load->model('Menulinkmodel');
        $this->load->model('Menumodel');
        $this->load->model('Pagemodel');
        $this->load->library('form_validation');
        $this->load->helper('form');

        if (!$this->checkAccess('ADD_MENU_ITEM')) {
            $this->utility->accessDenied();
            return;
        }

        //fetch the menu details
        $menu_detail = array();
        $menu_detail = $this->Menumodel->detail($mid);
        if (!$menu_detail) {
            $this->utility->show404();
            return;
        }

        //fetc the menu item  indentedList
        $parent_menu = array();
        $parent_menu['0'] = 'Root';
        $rs = $this->Menulinkmodel->indentedList($menu_detail['menu_id']);
        foreach ($rs as $row) {
            $parent_menu[$row['menu_item_id']] = str_repeat('&nbsp;', ($row['menu_item_level']) * 8) . $row['menu_item_name'];
        }

        //Form Validations
        $this->form_validation->set_rules('parent_id', 'Parent Name', 'trim');
        $this->form_validation->set_rules('menu_item_name', 'Link Name', 'trim|required');
        $this->form_validation->set_rules('url', 'Url', 'trim|required');
        $this->form_validation->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $page = array();

            $inner['menu_detail'] = $menu_detail;
            $inner['parent_menu'] = $parent_menu;

            $page['content'] = $this->load->view('menu_items/addurl', $inner, TRUE);
            $this->load->view($this->content, $page);
        } else {
            $this->Menulinkmodel->addlink($menu_detail);

            $this->session->set_flashdata('SUCCESS', 'menu_item_added');

            redirect("cms//menu_item/index/{$menu_detail['menu_id']}");
            exit();
        }
    }

    //function add link
    function placeholder($mid = false) {
        $this->load->model('Menulinkmodel');
        $this->load->model('Menumodel');
        $this->load->model('Pagemodel');
        $this->load->library('form_validation');
        $this->load->helper('form');

        if (!$this->checkAccess('ADD_MENU_ITEM')) {
            $this->utility->accessDenied();
            return;
        }

        //fetch the menu details
        $menu_detail = array();
        $menu_detail = $this->Menumodel->detail($mid);
        if (!$menu_detail) {
            $this->utility->show404();
            return;
        }

        //fetc the menu item  indentedList
        $parent_menu = array();
        $parent_menu['0'] = 'Root';
        $rs = $this->Menulinkmodel->indentedList($menu_detail['menu_id']);
        foreach ($rs as $row) {
            $parent_menu[$row['menu_item_id']] = str_repeat('&nbsp;', ($row['menu_item_level']) * 8) . $row['menu_item_name'];
        }

        //Form Validations
        $this->form_validation->set_rules('parent_id', 'Parent Name', 'trim');
        $this->form_validation->set_rules('menu_item_name', 'Link Name', 'trim|required');
        $this->form_validation->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $page = array();

            $inner['menu_detail'] = $menu_detail;
            $inner['parent_menu'] = $parent_menu;

            $page['content'] = $this->load->view('menu_items/add-placeholder', $inner, TRUE);
            $this->load->view($this->content, $page);
        } else {
            $this->Menulinkmodel->addPlaceholder($menu_detail);

            $this->session->set_flashdata('SUCCESS', 'menu_item_added');

            redirect("cms/menu_item/index/{$menu_detail['menu_id']}");
            exit();
        }
    }

    //function link url
    function editurl($m_item_id) {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('Menulinkmodel');
        $this->load->model('Pagemodel');


        if (!$this->checkAccess('EDIT_MENU_ITEM')) {
            $this->utility->accessDenied();
            return;
        }

        //Get Page Details
        $menu_item = array();
        $menu_item = $this->Menulinkmodel->details($m_item_id);
        if (!$menu_item) {
            $this->utility->show404();
            return;
        }

        $parent_menu['0'] = 'Root';
        $rs = $this->Menulinkmodel->indentedList($menu_item['menu_id'], $menu_item['menu_item_id']);
        foreach ($rs as $row) {
            $parent_menu[$row['menu_item_id']] = str_repeat('&nbsp;', ($row['menu_item_level']) * 8) . $row['menu_item_name'];
        }



        //Form Validations
        $this->form_validation->set_rules('parent_id', 'Parent Name', 'trim|required');
        $this->form_validation->set_rules('menu_item_name', 'Link Name', 'trim|required');
        $this->form_validation->set_rules('url', 'URL', 'trim|required');


        $this->form_validation->set_error_delimiters('<li>', '</li>');


        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $page = array();
            $inner['menu_item'] = $menu_item;
            $inner['parent_menu'] = $parent_menu;

            $page['content'] = $this->load->view('menu_items/edit-url', $inner, TRUE);
            $this->load->view($this->content, $page);
        } else {
            $this->Menulinkmodel->updateLinkUrlRecord($menu_item);

            $this->session->set_flashdata('SUCCESS', 'menu_item_updated');

            redirect("cms/menu_item/index/{$menu_item['menu_id']}/");
            exit();
        }
    }

    //function link url
    function edit_placeholder($m_item_id) {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('Menulinkmodel');
        $this->load->model('Pagemodel');

        if (!$this->checkAccess('EDIT_MENU_ITEM')) {
            $this->utility->accessDenied();
            return;
        }

        //Get Page Details
        $menu_item = array();
        $menu_item = $this->Menulinkmodel->details($m_item_id);
        if (!$menu_item) {
            $this->utility->show404();
            return;
        }

        $parent_menu = array();
        $parent_menu['0'] = 'Root';
        $rs = $this->Menulinkmodel->indentedList($menu_item['menu_id'], $menu_item['menu_item_id']);
        foreach ($rs as $row) {
            //$parent_menu[$row['menu_item_id']] = $row['menu_item_name'];
            $parent_menu[$row['menu_item_id']] = str_repeat('&nbsp;', ($row['menu_item_level']) * 8) . $row['menu_item_name'];
        }


        //Form Validations
        $this->form_validation->set_rules('parent_id', 'Parent Name', 'trim|required');
        $this->form_validation->set_rules('menu_item_name', 'Link Name', 'trim|required');
        ;


        $this->form_validation->set_error_delimiters('<li>', '</li>');


        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $page = array();
            $inner['menu_item'] = $menu_item;
            $inner['parent_menu'] = $parent_menu;

            $page['content'] = $this->load->view('menu_items/edit-placeholder', $inner, TRUE);
            $this->load->view($this->content, $page);
        } else {
            $this->Menulinkmodel->updatePlaceholder($menu_item);

            $this->session->set_flashdata('SUCCESS', 'menu_item_updated');

            redirect("cms/menu_item/index/{$menu_item['menu_id']}/");
            exit();
        }
    }

    function delete($pid) {
        $this->load->model('Menulinkmodel');
        $this->load->library('form_validation');
        $this->load->helper('form');

        if (!$this->checkAccess('DELETE_MENU_ITEM')) {
            $this->utility->accessDenied();
            return;
        }

        $page_details = array();
        $page_details = $this->Menulinkmodel->details($pid);
        if (!$page_details) {
            $this->utility->show404();
            return;
        }

        $this->Menulinkmodel->deleteRecord($page_details);

        $this->session->set_flashdata('SUCCESS', 'menu_item_deleted');
        redirect("cms/menu_item/index/{$page_details['menu_id']}");
        exit();
    }

}

?>