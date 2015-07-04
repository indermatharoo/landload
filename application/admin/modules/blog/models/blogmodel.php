<?php

class blogmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    //Get detail of Blog
    function getdetails($nid) {
        $this->db->where('blog_id', intval($nid));
        $query = $this->db->get('blog');
        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        return false;
    }

    //Count All Blog
    function countAll() {
        $this->db->from('blog');
        return $this->db->count_all_results();
    }

    //list all Blog
    function listAll($offset = FALSE, $limit = FALSE) {
        if ($offset)
            $this->db->offset($offset);
        if ($limit)
            $this->db->limit($limit);

        $rs = $this->db->get('blog');
        return $rs->result_array();
    }

    //insert record
    function insertRecord() {
//            echo '<pre>';
//            print_r($_POST);
//            print_r($_FILES);
//            exit;
        $data = array();
        $data['blog_title'] = $this->input->post('blog_title', true);
        if ($this->input->post('url_alias', TRUE) == '') {
            $data['url_alias'] = $this->_slug($this->input->post('blog_title', TRUE));
        } else {
            $data['url_alias'] = url_title($this->input->post('url_alias', TRUE));
        }
        $cont = $this->input->post('contents', false);
        $data['contents'] = str_replace('<img src="admin/', '<img src="', $cont);
        $data['blog_date'] = $this->input->post('date', true);

        $this->db->insert('blog', $data);
        return;
    }

    //update record
    function updateRecord($blog) {
//        echo '<pre>';
//        print_r($_POST);
//        exit;
        $data = array();
        $data['blog_title'] = $this->input->post('blog_title', true);
        $alias = $this->input->post('url_alias', true);
        if ($this->input->post('url_alias', TRUE) == '') {
            $data['url_alias'] = $blog['url_alias'];
        } else {
            $data['url_alias'] = url_title($this->input->post('url_alias', TRUE));
        }
        $cont = $this->input->post('contents', false);
        $data['contents'] = str_replace('<img src="admin/', '<img src="', $cont);
        $data['blog_date'] = $this->input->post('date', true);

        $this->db->where('blog_id', $blog['blog_id']);
        $this->db->update('blog', $data);
        return;
    }

    //Function Delete Record
    function deleteRecord($blog) {
        $this->db->where('blog_id', $blog['blog_id']);
        $this->db->delete('blog');
    }

    function _slug($name) {
        $new = ($name) ? $name : '';

        $replace_array = array('.', '*', '/', '\\', '"', '\'', ',', '{', '}', '[', ']', '(', ')', '~', '`', '#');

        $slug = $new;
        $slug = trim($slug);
        $slug = str_replace($replace_array, "", $slug);
        //.,*,/,\,",',,,{,(,},)[,]
        $slug = url_title($slug, '-', true);
        $this->db->limit(1);
        $this->db->where('url_alias', $slug);
        $rs = $this->db->get('blog');
        if ($rs->num_rows() > 0) {
            $suffix = 2;
            do {
                $slug_check = false;
                $alt_slug = substr($slug, 0, 200 - (strlen($suffix) + 1)) . "-$suffix";
                $this->db->limit(1);
                $this->db->where('url_alias', $alt_slug);
                $rs = $this->db->get('blog');
                if ($rs->num_rows() > 0)
                    $slug_check = true;
                $suffix++;
            }while ($slug_check);
            $slug = $alt_slug;
        }
        return $slug;
    }

}

?>