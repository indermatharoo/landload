<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->is_admin_protected = TRUE;
    }

    function valid_Url_Alias($str) {
        $this->db->where('url_alias', $str);
        $query = $this->db->get('news');
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('valid_Url_Alias', 'URL alias is already being used!');
            return false;
        }
        return true;
    }

    function valid_UrlAlias($str) {
        $this->db->where('url_alias', $str);
        $this->db->where('news_id !=', $this->input->post('news_id'));
        $query = $this->db->get('news');
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('valid_UrlAlias', 'URL alias is already being used!');
            return false;
        }
        return true;
    }

    //function index
    function index($offset = 0) {
        if (!($this->aauth->isFranshisor() || $this->aauth->isFrsUser())) {
            $this->utility->accessDenied();
            return;
        }
        $this->load->model('Newsmodel');
        $this->load->library('pagination');
        $this->load->helper('text');
        $this->load->library('form_validation');

        //Setup pagination
        $perpage = 25;
        $config['base_url'] = base_url() . "news/news/index/";
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->Newsmodel->countAll();
        $config['per_page'] = $perpage;
        $this->pagination->initialize($config);

        //Fetch News
        $news = array();
        $news = $this->Newsmodel->listAll($offset, $perpage);
        //print_r($categories); exit();
        //render view
        $inner = array();
        $inner['news'] = $news;
        $inner['pagination'] = $this->pagination->create_links();

        $page = array();
        $page['content'] = $this->load->view('news-listing', $inner, TRUE);
        $this->load->view($this->content, $page);
    }

    //function add
    function add() {
        if (!($this->aauth->isFranshisor() || $this->aauth->isFrsUser())) {
            $this->utility->accessDenied();
            return;
        }
        $this->load->model('Newsmodel');
        $this->load->library('form_validation');
        $this->load->helper('form');

        //validation check
        $this->form_validation->set_rules('news_title', 'News Title', 'trim|required');
        $this->form_validation->set_rules('url_alias', 'News Alias', 'trim');
        $this->form_validation->set_rules('date', 'News Date', 'trim|required');
        $this->form_validation->set_rules('contents', 'Description', 'trim');

        $this->form_validation->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $page = array();
            $page['content'] = $this->load->view('news-add', $inner, TRUE);
            $this->load->view($this->content, $page);
        } else {
            $this->Newsmodel->insertRecord();
            $this->session->set_flashdata('SUCCESS', 'news_added');

            redirect("news", 'location');
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
        $this->load->model('Newsmodel');


        //Fetch News Details
        $news = array();
        $news = $this->Newsmodel->getdetails($nid);
        if (!$news) {
            $this->utility->show404();
            return;
        }


        //validation check
        $this->form_validation->set_rules('news_title', 'News Title', 'trim|required');
        $this->form_validation->set_rules('url_alias', 'Url Alias', 'trim|callback_valid_UrlAlias');
        $this->form_validation->set_rules('date', 'News Date', 'trim|required');
        $this->form_validation->set_rules('contents', 'Description', 'trim');

        $this->form_validation->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $page = array();

            $inner['news'] = $news;

            $page['content'] = $this->load->view('news-edit', $inner, TRUE);
            $this->load->view($this->content, $page);
        } else {
            $this->Newsmodel->updateRecord($news);

            $this->session->set_flashdata('SUCCESS', 'news_updated');
            redirect("news", 'location');
            exit();
        }
    }

    //function delete
    function delete($nid) {
        if (!($this->aauth->isFranshisor() || $this->aauth->isFrsUser())) {
            $this->utility->accessDenied();
            return;
        }
        $this->load->model('Newsmodel');
        $this->load->library('form_validation');
        $this->load->helper('form');

        //Fetch News Details
        $news = array();
        $news = $this->Newsmodel->getdetails($nid);
        if (!$news) {
            $this->utility->show404();
            return;
        }


        $this->Newsmodel->deleteRecord($news);
        $this->session->set_flashdata('SUCCESS', 'news_deleted');
        redirect('news');
        exit();
    }

}

?>