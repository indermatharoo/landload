<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Role extends Admin_Controller {

    function index($offset = 0) {
        $this->load->model('Rolemodel');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->library('pagination');

        if (!$this->checkAccess('MANAGE_USERS')) {
            $this->utility->accessDenied();
            return;
        }

        ///Setup pagination
        $perpage = 20;
        $config['base_url'] = base_url() . "use/role/index/";
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->Rolemodel->countAll();
        $config['per_page'] = $perpage;
        $this->pagination->initialize($config);

        $roles = array();
        $roles = $this->Rolemodel->listAll($offset, $perpage);

        //render view
        $inner = array();
        $inner['roles'] = $roles;
        $inner['user'] = $this->getUser();
        $inner['pagination'] = $this->pagination->create_links();

        $page = array();
        $page['content'] = $this->load->view('roles/listings', $inner, TRUE);
        $this->load->view($this->shellFile, $page);
    }

    //function add
    function add() {
        $this->load->model('Rolemodel');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('string');
        $this->load->library('encrypt');
        $this->load->library('parser');
        $this->load->library('email');

        if (!$this->checkAccess('MANAGE_USERS')) {
            $this->utility->accessDenied();
            return;
        }

        //validation check
        $this->form_validation->set_rules('role', 'Role', 'trim|required');
        $this->form_validation->set_error_delimiters('<li>', '</li>');

        //Render View
        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $page = array();
            $page['content'] = $this->load->view('roles/add', $inner, TRUE);
            $this->load->view($this->shellFile, $page);
        } else {
            $this->Rolemodel->addRole();
            $this->session->set_flashdata('SUCCESS', 'role_added');
            redirect('user/role');
            exit();
        }
    }

    //Edit Users
    function edit($uid = 0) {
        $this->load->model('Rolemodel');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('string');
        $this->load->library('encrypt');

        if (!$this->checkAccess('MANAGE_USERS')) {
            $this->utility->accessDenied();
            return;
        }

        //Fetch user details
        $role = array();
        $role = $this->Rolemodel->fetchByID($uid);
        if (!$role) {
            $this->utility->show404();
            return;
        }

        //Current Permission
        $current_permissions = array();
        $role_permissions = $this->Rolemodel->getPermissions($role['role_id']);
        if ($role_permissions) {
            foreach ($role_permissions as $row) {
                $current_permissions[] = $row['protected_resource_id'];
            }
        }

        //validation check
		$this->form_validation->set_rules('role', 'Role', 'trim|required');
        $this->form_validation->set_rules('protected_resource_id[]', 'Permission', 'trim');
        $this->form_validation->set_error_delimiters('<li>', '</li>');

        $resources = array();
        $resources_rs = $this->Rolemodel->listProtectedResources();
        foreach ($resources_rs as $row) {
            $resources[$row['protected_resource_id']] = $row['resource'];
        }

        //Render View
        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $inner['role'] = $role;
            $inner['resources'] = $resources;
            $inner['current_permissions'] = $current_permissions;

            $page = array();
            $page['content'] = $this->load->view('roles/edit', $inner, TRUE);
            $this->load->view($this->shellFile, $page);
        } else {
            $this->Rolemodel->updateRole($role);
            $this->session->set_flashdata('SUCCESS', 'user_updated');
            redirect('user/role');
            exit();
        }
    }

    //Delete users
    function delete($uid) {
        $this->load->model('Rolemodel');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('string');

        if (!$this->checkAccess('MANAGE_USERS')) {
            $this->utility->accessDenied();
            return;
        }

        //Fetch user details
        $role = array();
        $role = $this->Rolemodel->fetchByID($uid);
        if (!$role) {
            $this->utility->show404();
            return;
        }

        if ($role['role_id'] == 1) {
            $this->session->set_flashdata('ERROR', 'user_cnonot_deleted');

            redirect('/user/role', 'location');
            exit();
        }

        $this->Rolemodel->deleteRole($role);

        $this->session->set_flashdata('SUCCESS', 'role_deleted');

        redirect('user/role');
        exit();
    }

}

?>