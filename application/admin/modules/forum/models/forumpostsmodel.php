<?php

/**
 * id
 * forum_id
 * poster_id
 * post_date
 * post_time
 * description 
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ForumPostsmodel extends CI_Model {

    function countAll() {
        $this->db->from('forum_posts');
        return $this->db->count_all_results();
    }

    function countPostGrpForum() {

        $resultSet = $this->db->select(' count(id) as ttl, forum_id')
                        ->from('forum_posts')
                        ->group_by('forum_id')->get();
        if ($resultSet->num_rows()) {
            return $resultSet->result_array();
        }
        return array();
    }

    function listRecords($forumId) {
        $query = $this->db->select('forum_posts.*, aauth_users.name, aauth_users.email ')
                        ->from('forum_posts')
                        ->join('aauth_users', 'aauth_users.id = forum_posts.poster_id ', 'inner')
                        ->where('(forum_id ='.$forumId.' OR forum_id in (SELECT id FROM dpd_forum WHERE parent_id = ' . $forumId . '))')                        
                        ->where('against_post_id', '0')
                        ->where('parent_post_id', '0')
                        ->order_by('forum_posts.id', 'desc')                        
                        ->get();
//        $query = $this->db->get('forum_posts');
//        echo $this->db->last_query();
//        exit;
        if ($query->num_rows) {
            return $query->result_array();
            ;
        }
        return array();
    }

    function lastRecords($count = 5) {
        $query = $this->db->select('forum_posts.*, aauth_users.name ')
                ->from('forum_ posts')
                ->join('aauth_users', 'aauth_users.id = forum_posts.poster_id ', 'inner')
                ->order_by('forum_posts.id', 'desc')
                ->limit($count)
                ->get();
        //$query = $this->db->get('forum_posts');
        if ($query->num_rows) {
            return $query->result_array();            
        }
        return array();
    }

    function getForumsLastRec() {
        $sql = 'SELECT `dpd_forum_posts`.*, 
                `dpd_aauth_users`.`name` 
                FROM (dpd_forum_posts) LEFT JOIN `dpd_aauth_users` ON `dpd_aauth_users`.`id` = `dpd_forum_posts`.`poster_id` 
                WHERE dpd_forum_posts.id in (SELECT MAX(id) FROM dpd_forum_posts GROUP BY forum_id)';
        $query = $this->db->query($sql);
        if ($query->num_rows) {
            return $query->result_array();
            ;
        }
        return array();
    }

    function fetchRecordById($fid) {

        $this->db->select('aauth_users.name as uname, forum.name as "title",forum_posts.*')
                ->from('forum_posts')
                ->join('forum', 'forum.id=forum_posts.forum_id')
                ->join('aauth_users', 'aauth_users.id=forum_posts.poster_id')
                ->where('forum_posts.id', $fid);
        $query = $this->db->get();
        if ($query && $query->num_rows() == 1) {
            return $query->row_array();
        }
        return array();
    }

    function insertRecord($param = array()) {
        $data = array();
        $data['description'] = $this->input->post('description', true);
        $data['parent_post_id'] = $this->input->post('parent_post_id', true);
        $data['against_post_id'] = $this->input->post('against_post_id', true);
        $data['poster_id'] = $param['poster_id'];
        $data['forum_id'] = $param['forum_id'];
        $data['post_date'] = date('Y-m-d');
        $data['post_time'] = date('H:i:s');
        $this->db->insert('forum_posts', $data);
        return $this->db->insert_id();
    }

    function updateRecord($forum) {
        //print_r($image);exit();
        $data = array();
        $data['question'] = $this->input->post('question', true);
        $data['answer'] = $this->input->post('answer', true);
        $this->db->where('forum_id', $forum['forum_id']);
        $status = $this->db->update('forum_posts', $data);
        return $status;
    }

    function deleteRecord($post) {
        $this->db->where('id', $post['id']);
        $this->db->delete('forum_posts');
    }

    function getTopicPosts($fpid = null) {
        $this->db->select('aauth_users.name as uname, quoteUser.name as quoted_user, forum.name as "title",'
                . ' forum_posts.id, forum_posts.forum_id, forum_posts.poster_id, forum_posts.post_date, forum_posts.description, forum_posts.against_post_id, '                
                . ' quoted.id as quoted_id, quoted.post_date  as quoted_date,'
                . ' quoted.description as quoted_description')
                ->from('forum_posts')
                ->join('forum', 'forum.id=forum_posts.forum_id')
                ->join('aauth_users', 'aauth_users.id=forum_posts.poster_id')
                ->join('forum_posts as quoted', 'quoted.id=forum_posts.against_post_id', 'LEFT')
                ->join('aauth_users as quoteUser', 'quoteUser.id=quoted.poster_id', 'LEFT')
                ->where('forum_posts.parent_post_id', $fpid)
                ->or_where('forum_posts.against_post_id', $fpid)
                ->order_by('forum_posts.id', 'desc');
        $query = $this->db->get();
        if ($query && $query->num_rows()) {
            $posts = $query->result_array();
//            echo $this->db->last_query();
//            echo "<br/>";
//            ep($posts);
//            $parentPostId = array();
//            foreach($posts as $postK => $postVal){
//                $parentPostId[] = $postVal['id'];
//            }
//            $this->db->select('aauth_users.name as uname,forum_posts.*')
//                ->from('forum_posts')
//                ->join('aauth_users', 'aauth_users.id=forum_posts.poster_id')
//                ->where_in('forum_posts.parent_post_id', $parentPostId)
//                ->order_by('forum_posts.against_post_id', 'ASC');
//            $query = $this->db->get();
//            echo $this->db->last_query(),"<br/>";
//            $childposts = $query->result_array();
//            return array('posts' => $posts, 'childPosts' =>$childposts);
            return $posts;
        }
        return array();
    }
}