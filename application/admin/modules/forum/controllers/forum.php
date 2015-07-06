<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Forum extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->is_admin_protected = TRUE;
        $this->load->model('user/Usermodel');
        $this->load->model('ForumPostsmodel');
        $this->load->model('Forummodel');
        $this->load->model('user/usermodel');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->library('Notification');
    }

    function getForum($id, $directadd = false) {
        $this->load->model('user/usermodel');
//        if(is_numeric($id)){ }else{}
        $posts = $this->ForumPostsmodel->listRecords($id);
        $forumdet = $this->Forummodel->fetchRecordById($id);
        $forumTopic = $this->Forummodel->fetchTopicRecordById($id);
        $forumContributar = $this->Forummodel->forumContributar($id);

        $inner = array();
        $inner['posts'] = $posts;
        $inner['forum'] = $forumdet;
        $inner['forumTopic'] = (!$forumTopic ? array() : $forumTopic);
        $inner['forumContributar'] = $forumContributar;
        $inner['addTopicClass'] = '0';
        if ($directadd) {
            $inner['addTopicClass'] = '1';
        }
        $shell = array();
        $shell['content'] = $this->load->view('forum/forum/topiclisting', $inner, true);
        $this->load->view($this->default, $shell);
    }

    function getTopic($id) {
//        if(is_numeric($id)){ }else{}
        $posts = $this->ForumPostsmodel->listRecords($id);
        $forumdet = $this->Forummodel->fetchRecordById($id);
        $forumTopic = $this->Forummodel->fetchTopicRecordById($id);
        $topicContributar = $this->Forummodel->topicContributar($id);

        $inner = array();
        $inner['posts'] = $posts;
        $inner['forum'] = $forumdet;
        $inner['forumTopic'] = $forumTopic;
        $inner['topicContributar'] = $topicContributar;

        $shell = array();
        $shell['content'] = $this->load->view('forum/forum/postlisting', $inner, true);
        $this->load->view($this->default, $shell);
    }

    function addTopic() {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('topic', 'topic', 'trim|required');
        $this->form_validation->set_rules('forum_id', 'forum_id', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $shell = array();
            echo json_encode(array('msg' => strip_tags(validation_errors()), 'success' => 0));
        } else {
            if ($this->session->userdata['loggedin']) {
                $param = array(
                    'creator_id' => $this->session->userdata['id'],
                    'parent_id' => $this->input->post('forum_id', true)
                );
                $forum_id = $this->Forummodel->insertRecord($param);

                $notify_data = array(
                    'class' => $this->router->fetch_class(),
                    'method' => $this->router->fetch_method(),
                    'creator_id' => $param['creator_id'],
                    'creator_name' => $this->session->userdata['name'],
                    'sender_id' => $param['creator_id'],
                    'sender_name' => $this->session->userdata['name'],
                    'parent_id' => $param['parent_id'],
                    'assigne_grp' => '',
                    'assigne_id' => '',
                    'event_title' => '',
                    'event_id' => $forum_id,
                    'filter' => ''
                );

                $this->notification->notify($notify_data);
                echo json_encode(array('msg' => 'Successfully Added', 'success' => 1));
                //redirect('forum/forum');   
            }
        }
        exit();
    }

    function addpost() {
        $this->form_validation->set_rules('description', 'Description', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $shell = array();
            //$this->session->set_flashdata('ERROR', 'forum_post_not_exist');
            echo json_encode(array('msg' => strip_tags(validation_errors()), 'success' => 0));
        } else {
            if ($this->session->userdata['loggedin']) {
                $param = array(
                    'poster_id' => $this->session->userdata['id'],
                    'forum_id' => $this->input->post('forum_id', true)
                );
                $post_id = $this->ForumPostsmodel->insertRecord($param);

                $notify_data = array(
                    'class' => $this->router->fetch_class(),
                    'method' => $this->router->fetch_method(),
                    'creator_id' => $param['poster_id'],
                    'creator_name' => $this->session->userdata['name'],
                    'sender_id' => $param['poster_id'],
                    'sender_name' => $this->session->userdata['name'],
                    'forum_id' => $param['forum_id'],
                    'assigne_grp' => '',
                    'assigne_id' => '',
                    'event_title' => '',
                    'event_id' => $post_id,
                    'filter' => '',
                );

                $this->notification->notify($notify_data);
                $this->session->set_flashdata('SUCCESS', 'forum_post_saved');
                echo json_encode(array('msg' => 'Successfully Added', 'success' => 1));
                //redirect('forum/forum');   
            }
        }
        exit();
    }

    function getTopicPost($postid = null) {
        $inner = array();
        $shell = array();
        $postid = intval($postid);
        $inner['postDetail'] = $this->ForumPostsmodel->fetchRecordById($postid);
        $inner['posts'] = $this->ForumPostsmodel->getTopicPosts($postid);
        if (!$inner['postDetail']) {
            $this->session->set_flashdata('ERROR', 'forum_post_not_exist');
            redirect('forum');
        }
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            
        }

        $shell['content'] = $this->load->view('forum/forum/postreplies', $inner, true);
        $this->load->view($this->default, $shell);
    }

    function index() {
        $this->load->model('user/usermodel');
        $this->load->model('Forummodel');
        $this->load->model('ForumPostsmodel');

        //team list
        $forum = array();
        $forum = $this->Forummodel->listRecords();

        $forumTopics = array();
        $forumTopics = $this->Forummodel->listForumTopicRecords();

        $postCount = $this->ForumPostsmodel->countPostGrpForum();
        $countArray = array();
        foreach ($postCount as $postCountKey => $postCountVal) {
            $countArray[$postCountVal['forum_id']] = $postCountVal['ttl'];
        }
        $postCount = $countArray;
        //render view
        $inner = array();
        $inner['forum'] = $forum;
        $inner['forumTopics'] = $forumTopics;

        $inner['postCount'] = $postCount;
        $inner['latestPost'] = $this->ForumPostsmodel->getForumsLastRec();

        //get last activity
        if (isset($forum['0'])) {
            $lastUser = $this->Usermodel->fetchByID($forum['0']['last_activity_id']);
            $inner['lastActivity_user'] = $lastUser;
            $inner['lastActivity_datetime'] = $forum['0']['last_activity_datetime'];
        }

        $shell = array();
        $shell['content'] = $this->load->view('forum/forum/listing', $inner, true);
        $this->load->view($this->default, $shell);
    }

    function add() {
        $this->load->model('Forummodel');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('text');

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        /* $this->form_validation->set_rules('alias', 'Alias', 'trim|require'); 
         * $this->form_validation->set_rules('description', 'Description', 'trim|require');
         */

        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $shell = array();
            echo json_encode(array('msg' => strip_tags(validation_errors()), 'success' => 0));
        } else {
            if ($this->session->userdata['loggedin']) {
                $param = array('creator_id' => $this->session->userdata['id']);
                $forum_id = $this->Forummodel->insertRecord($param);

//                        $this->load->library('Notification');

                $notify_data = array(
                    'class' => $this->router->fetch_class(),
                    'method' => $this->router->fetch_method(),
                    'creator_id' => $param['creator_id'],
                    'creator_name' => $this->session->userdata['name'],
                    'sender_id' => $param['creator_id'],
                    'sender_name' => $this->session->userdata['name'],
                    'assigne_grp' => '',
                    'assigne_id' => '',
                    'event_title' => '',
                    'event_id' => $forum_id,
                    'filter' => '',
                );

                $this->notification->notify($notify_data);

                echo json_encode(array('msg' => 'Successfully Added', 'success' => 1));
                //redirect('forum/forum');   
            }
        }
        exit();
    }

    function edit($fid = false) {
        $this->load->model('Forummodel');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('text');

        //Fetch Panel Details
        $faq = array();
        $faq = $this->Forummodel->fetchRecordById($fid);
        if (!$faq) {
            show_404('faq Not Found');
        }

        $this->form_validation->set_rules('question', 'Question', 'trim|required');
        $this->form_validation->set_rules('answer', 'Answer', 'trim|require');

        if ($this->form_validation->run() == FALSE) {
            $inner = array();
            $inner['faq'] = $faq;
            $shell = array();
            $shell['content'] = $this->load->view('faqs/faqs/edit', $inner, true);
            $this->load->view($this->default, $shell);
        } else {
            $this->Forummodel->updateRecord($faq);
            redirect('faqs/faqs');
            exit();
        }
    }

    function delete($fid) {

        $forum = array();
        $forum = $this->Forummodel->fetchRecordById($fid);
        if (!$forum) {
            show_404('faq Not Found');
        }
        $this->Forummodel->deleteRecord($forum);
        echo json_encode(array('success' => 1, 'msg' => 'Forum Deleted'));
        exit();
    }
    function delete_topic()
    {
       // $this->load->model('ForumPosts');
        if($this->input->post('id')!="");
        {
            
            $this->Forummodel->deleteTopic($this->input->post('id'));
        }
    }

}

?>