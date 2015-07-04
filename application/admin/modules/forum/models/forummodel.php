<?php
/**
 * table name : forum
 * id
 * name
 * alias
 * description
 * threads
 * creator_id
 * created_date
 * created_time
 * last_activity_datetime
 * last_activity_id
 * active
 */




if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Forummodel extends CI_Model {


    public function __construct() {
        parent::__construct();
        $this->load->model('user/usermodel');
        $this->load->model('ForumPostsmodel');
    }
    
    function listRecords() {
        $this->db->select('forum.*,aauth_users.name as uname ')
                ->from('forum')
                ->join('aauth_users',' aauth_users.id = forum.creator_id', 'left')
                ->where('active', '1')
                ->where('parent_id', '0')                
                ->order_by('id','desc');
        $query = $this->db->get();
        if($query->num_rows()){
            return $query->result_array();
        }else{
            return array();
        }
    }

    function listForumTopicRecords() {
        $this->db->select('*')
                ->where('active', '1')
                ->where('parent_id <>', '0')
                ->order_by('parent_id','desc');
        $query = $this->db->get('forum');
        if($query->num_rows()){
            return $query->result_array();
        }else{
            return array();
        }        
    }
    
    function fetchRecordById($fid) {
        $this->db->select('*')->where('id',$fid);
        $query = $this->db->get('forum');
        if ($query && $query->num_rows() == 1) {
            return $query->row_array();
        }
        return array();
    }

    function fetchTopicRecordById($fid) {
        $this->db->select('forum.*,aauth_users.name as uname')
                ->from('forum')                
                ->join('aauth_users', 'aauth_users.id = forum.creator_id ', 'inner')
                ->where('parent_id',$fid);
        $query = $this->db->get();
        if ($query && $query->num_rows()) {
            return $query->result_array();
        }
        return array();
    }
    
    function insertRecord($param = array()) {
        $data = array();
        $data['name'] = $this->input->post('name',true);
        $alis = $this->input->post('alias',true);
        if(!$alis){ $data['alias'] = str_replace(" ", "-", $data['name']); }
        $description = $this->input->post('description',true);
        if(!$description){ $data['description'] = $data['name'];}
        else{ $data['description'] = $description; }
        $parent_id = arrIndex($param, 'parent_id');
        if(!$parent_id){ $parent_id = 0; }
        $data['parent_id'] = $parent_id;
        $data['creator_id'] = $param['creator_id'];
        $data['last_activity_id'] = $param['creator_id'];
        $data['created_date'] = date('Y-m-d');
        $data['created_time'] = date('H:i:s');
        $data['last_activity_datetime'] = date('Y-m-d H:i:s');
        if($this->db->insert('forum', $data)){
            $forum_id = $this->db->insert_id();
            if($parent_id){
                $this->updateThread($parent_id);
            }
            return $forum_id;
        }
    }

    
    function updateThread($parentId){
        if($parentId){
            $this->db->query('Update dpd_forum set threads = threads + 1 where id = '.$parentId);
        }
    }
    
    function updateRecord($forum) {
        $data = array();
        $data['question'] = $this->input->post('question',true);
        $data['answer'] = $this->input->post('answer',true);
        $this->db->where('forum_id', $forum['forum_id']);
        $status = $this->db->update('forum', $data);
        return $status;
    }
   
    function deleteRecord($forum) {
        $this->ForumPostsmodel->deleteRecord($forum);
        $this->db->where('id', $forum['id']);
        $this->db->delete('forum');
    }

    function forumContributar($forumId){
        //distinct(poster_id);
        $allForum  =  $this->db->select('id')
                        ->from(' forum')                        
                        ->where('id', $forumId)
                        ->or_where('parent_id', $forumId)
                        ->get();
        $ids = array();
        $ids[] = 0;
        if ($allForum && $allForum->num_rows()) {            
            $forumList = $allForum->result_array();
            $ids = array();
            foreach($forumList as $forumId){
                $ids[] = $forumId['id'];
            }
        }        
        $sql = 'SELECT name, id FROM (dpd_aauth_users) WHERE `id` 
                    IN (SELECT distinct(poster_id) FROM dpd_forum_posts WHERE forum_id in ('.implode(',', $ids).'))
                    OR (SELECT distinct(creator_id) FROM dpd_forum where id in ('.implode(',', $ids).'))';
        $names =  $this->db->query($sql)->result_array();
        return $names;
    }
    
    function topicContributar($topicId){
           
        $sql = 'SELECT name, id FROM (dpd_aauth_users) WHERE `id` 
                    IN (SELECT distinct(poster_id) FROM dpd_forum_posts WHERE forum_id = '.$topicId.' )';
        $names =  $this->db->query($sql)->result_array();
        return $names;
    }    
    function deleteTopic($id)
    {
        $this->db->where('id',$id);
       // $this->db->delete('forum');
        echo json_encode(array('success'=>true));
    }
}

?>
