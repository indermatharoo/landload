<?php

class Messagemodel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    function getAllmessages()
    {
        $this->db->select('messages.*,applicants.*');
        $this->db->group_by('messages.user_id');
        $this->db->where('company_id',  curUsrId());
        $this->db->join('applicants','applicants.applicant_id = messages.user_id');
        $res = $this->db->get('messages');        
        return array('num_rows'=>$res->num_rows(),'result'=>$res->result_array());
    }
    function DeleteAllConversation($usrID)
    {
//        $this->db->where('user_id',$usrID);
//       $this->db->delete('messages');
    }
    function getMessagesByUserId($usrID)
    {
        $this->db->select('messages.*,applicants.fname,applicants.lname,user_extra_detail.company_name');
        $this->db->where('messages.user_id',$usrID);
        $this->db->join('applicants','applicants.applicant_id = messages.user_id');
        $this->db->join('user_extra_detail','user_extra_detail.id = messages.company_id');
        $res = $this->db->get('messages');               
        return array('num_rows'=>$res->num_rows(),'result'=>$res->result_array());
    }
    function addReply($offset)
    {
        $data=array();
        $data['user_id'] = $offset;
        $data['company_id'] = curUsrId();
        $data['message'] = $this->input->post('message');
        $data['reply'] = 1;
        $this->db->insert('messages',$data);
    }
    
}