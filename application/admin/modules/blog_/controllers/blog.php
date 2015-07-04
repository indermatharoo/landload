<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blog extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->is_admin_protected = TRUE;
    }

    function valid_Url_Alias($str) {
        $this->db->where('url_alias', $str);
        $query = $this->db->get('blog');
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('valid_Url_Alias', 'URL alias is already being used!');
            return false;
        }
        return true;
    }

    function valid_UrlAlias($str) {
        $this->db->where('url_alias', $str);
        $this->db->where('blog_id !=', $this->input->post('blog_id'));
        $query = $this->db->get('blog');
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('valid_UrlAlias', 'URL alias is already being used!');
            return false;
        }
        return true;
    }

    //function index
    function index($offset = 0) {
        if (($this->aauth->isFranshisor() || $this->aauth->isFrsUser())) {
            $this->utility->accessDenied();
            return;
        }
        $this->load->model('blogmodel');
        $this->load->library('pagination');
        $this->load->helper('text');
        $this->load->library('form_validation');

        //Setup pagination
        $perpage = 25;
        $config['base_url'] = base_url() . "blog/blog/index/";
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->blogmodel->countAll();
        $config['per_page'] = $perpage;
        $this->pagination->initialize($config);

        //Fetch News
        $blog = array();
        $blog = $this->blogmodel->listAll($offset, $perpage);
        //print_r($categories); exit();
        //render view
        $inner = array();
        $inner['blog'] = $blog;
        $inner['pagination'] = $this->pagination->create_links();

        $page = array();
        $page['content'] = $this->load->view('blog-listing', $inner, TRUE);
        $this->load->view($this->content, $page);
    }

    //function add
    function add() {
        if (!($this->aauth->isFranshisor() || $this->aauth->isFrsUser())) {
            $this->utility->accessDenied();
            return;
        }
        $this->load->model('blogmodel');
        $this->load->library('form_validation');
        $this->load->helper('form');

        //validation check
        $this->form_validation->set_rules('blog_title', 'News Title', 'trim|required');
        $this->form_validation->set_rules('url_alias', 'News Alias', 'trim');
        $this->form_validation->set_rules('date', 'News Date', 'trim|required');
        $this->form_validation->set_rules('contents', 'Description', 'trim');

        $this->form_validation->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $page = array();
            $page['content'] = $this->load->view('blog-add', $inner, TRUE);
            $this->load->view($this->content, $page);
        } else {
            $this->blogmodel->insertRecord();
            $this->session->set_flashdata('SUCCESS', 'blog_added');

            redirect("blog", 'location');
            exit();
        }
    }

    //function edit
    function edit($nid) {
        if (!($this->aauth->isFranshisor() || $this->aauth->isFrsUser())) {
            $this->utility->accessDenied();
            return;
        }
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('blogmodel');


        //Fetch News Details
        $blog = array();
        $blog = $this->blogmodel->getdetails($nid);
        if (!$blog) {
            $this->utility->show404();
            return;
        }


        //validation check
        $this->form_validation->set_rules('blog_title', 'News Title', 'trim|required');
        $this->form_validation->set_rules('url_alias', 'Url Alias', 'trim|callback_valid_UrlAlias');
        $this->form_validation->set_rules('date', 'News Date', 'trim|required');
        $this->form_validation->set_rules('contents', 'Description', 'trim');

        $this->form_validation->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $page = array();

            $inner['blog'] = $blog;

            $page['content'] = $this->load->view('blog-edit', $inner, TRUE);
            $this->load->view($this->content, $page);
        } else {
            $this->blogmodel->updateRecord($blog);

            $this->session->set_flashdata('SUCCESS', 'blog_updated');
            redirect("blog", 'location');
            exit();
        }
    }

    //function delete
    function delete($nid) {
        if (!($this->aauth->isFranshisor() || $this->aauth->isFrsUser())) {
            $this->utility->accessDenied();
            return;
        }
        $this->load->model('blogmodel');
        $this->load->library('form_validation');
        $this->load->helper('form');

        //Fetch News Details
        $blog = array();
        $blog = $this->blogmodel->getdetails($nid);
        if (!$blog) {
            $this->utility->show404();
            return;
        }


        $this->blogmodel->deleteRecord($blog);
        $this->session->set_flashdata('SUCCESS', 'blog_deleted');
        redirect('blog');
        exit();
    }

}

?>