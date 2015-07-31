<?php

class Applicantsmodel extends Basemodel {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function countAll($ids = array(),$userType="app") {
        if ($this->aauth->isCompany() || $this->aauth->isUser()):
            $this->db->where_in('created_by', $ids);
        endif;
        $this->db->where('applicants.type',$userType);
        $this->db->from('applicants');
        return $this->db->count_all_results();
    }

    function listAll($ids = array(),$userType = "app") {
        if ($this->aauth->isCompany() || $this->aauth->isUser()):
            $this->db->where_in('created_by', $ids);
        endif;
        $this->db->select('applicants.applicant_id as id ,applicants.*,applicant_type.*');
        $this->db->where('applicants.type',$userType);
        $this->db->join('applicant_type', 'applicant_type.code=applicants.type','left');
        
        $results = $this->db->get('applicants')->result_array();
//        e($results);
        return $results;
    }
    function getUnAppliedTenants($test) {
       $res =  $this->db->query('select * from dpd_applicants where type = "tnt" and applicant_id not in (select applicant_id from `dpd_applications` where unit_id = "'.  $test.'")');
        return $res->result_array();
    }
    function getApplicantType() {
        return $this->db->get('applicant_type')->result_array();
    }

    function getAllApplicants() {
        return $this->db->get('applicants')->result_array();
    }

    function getAllfeatures() {
        return $this->db->get('features')->result_array();
    }

    function getApplicantDetails($id) {
        $this->db->where('applicant_id', $id);
        $res = $this->db->get('applicants');
        if ($res->num_rows() > 0) {
            return $res->row_array();
        } else {
            redirect('applicants/index');
        }
    }

    function insertRecord() {
        $data = array();
        $data['fname'] = $this->input->post('fname');
        $data['lname'] = $this->input->post('lname');
        $data['email'] = $this->input->post('email');
        $data['phone'] = $this->input->post('phone');
        $data['birthdate'] = date('Y-m-d', strtotime($this->input->post('birth_date')));
        $data['license'] = $this->input->post('license');
        $data['password'] = md5($this->input->post('passwd'));
        $data['address'] = $this->input->post('address');
        $data['monthly_gross'] = $this->input->post('monthly_gross');
        if (trim($this->input->post('additional_income')) != "") {
            $data['additional'] = $this->input->post('additional_income');
        } else {
            $data['additional'] = NULL;
        }
        $data['asset'] = $this->input->post('assets');
        $data['type'] = $this->input->post('status');
        $data['created_by'] = curUsrId();
        $this->db->insert('applicants', $data);
        return $this->db->insert_id();
    }

    function updateRecord($id) {
        $data = array();
        $data['fname'] = $this->input->post('fname');
        $data['lname'] = $this->input->post('lname');
        $data['email'] = $this->input->post('email');
        $data['phone'] = $this->input->post('phone');
        $data['birthdate'] = date('Y-m-d', strtotime($this->input->post('birth_date')));
        $data['license'] = $this->input->post('license');


        if (trim($this->input->post('passwd')) != "") {
            $data['password'] = md5($this->input->post('passwd'));
        }
        $data['address'] = $this->input->post('address');
        $data['monthly_gross'] = $this->input->post('monthly_gross');
        if (trim($this->input->post('additional_income')) != "") {
            $data['additional'] = $this->input->post('additional_income');
        } else {
            $data['additional'] = NULL;
        }
        $data['asset'] = $this->input->post('assets');
        $data['type'] = $this->input->post('status');
        $this->db->where('applicant_id', $id);
        $this->db->update('applicants', $data);
        return $this->db->insert_id();
    }

    function DeleteRecord($id) {
        $this->db->where('id', $id);
        $this->db->delete('applicants');
    }

    function getRecentApplicants($type) {
        $this->db->order_by("applicant_id", "desc");
        $this->db->limit(10);
        $this->db->where('type',$type);
        $res = $this->db->get('applicants');
        return array('num_rows' => $res->num_rows(), 'results' => $res->result_array());
    }

    function getRecentApplicantsCompany($ids = array()) {
        $this->db->select('t2.*');
        $this->db->from('applications t1');
        $this->db->join('applicants t2', 't1.applicant_id=t2.applicant_id');
//        $this->db->where('t1.company_id', curUsrId());
        $this->db->where_in('t1.company_id', $ids);
        $this->db->where('t2.type','app');
        $this->db->order_by("t2.applicant_id", "desc");
        $res = $this->db->get();
        return array('num_rows' => $res->num_rows(), 'results' => $res->result_array());
    }
    function getRecentTenantCompany($ids = array()) {
        $this->db->select('t2.*');
        $this->db->from('applications t1');
        $this->db->join('applicants t2', 't1.applicant_id=t2.applicant_id');
//        $this->db->where('t1.company_id', curUsrId());
        $this->db->where_in('t1.company_id', $ids);
        $this->db->where('t2.type','tnt');
        $this->db->order_by("t2.applicant_id", "desc");
        $res = $this->db->get();
        return array('num_rows' => $res->num_rows(), 'results' => $res->result_array());
    }    
    function getAppliedCompanies()
    {
        $this->db->select('aauth_users.*');
        $this->db->from('aauth_users');
     //   $this->db->where('applications.applicant_id',  curUsrId());
        $this->db->where('applications.applicant_id', 3);
        $this->db->group_by('applications.company_id');
        $this->db->join('applications','applications.company_id = aauth_users.id');
        $res = $this->db->get();
        return array('num_rows'=>$res->num_rows(),'result'=>$res->result_array());
    }
    function addMessage()
    {
        $data = array();
        $data['user_id'] = curUsrId();
        $data['company_id'] = $this->input->post('company_id');
        $data['message'] = $this->input->post('message');
        $this->db->insert('messages',$data);
        return true;
    }
    function getAllConversations()
    {
        $this->db->select('messages.*,applicants.*');
        $this->db->group_by('messages.user_id');
        //$this->db->where('messages.company_id',  curUsrId());
        $this->db->join('applicants','applicants.applicant_id = messages.user_id');
        $res = $this->db->get('messages');  
        
        return array('num_rows'=>$res->num_rows(),'result'=>$res->result_array());
    }
    function getMessagesByUserId($usrID)
    {
        $this->db->select('messages.*,applicants.fname,applicants.lname,user_extra_detail.company_name');
        $this->db->where('messages.company_id',$usrID);
        $this->db->join('applicants','applicants.applicant_id = messages.user_id');
        $this->db->join('user_extra_detail','user_extra_detail.id = messages.company_id');
        $res = $this->db->get('messages');               
        return array('num_rows'=>$res->num_rows(),'result'=>$res->result_array());
    }    
    function addReply($offset)
    {
        $data = array();
        $data['user_id'] = curUsrId();
        $data['company_id'] = $offset;
        $data['message'] = $this->input->post('message');
        $this->db->insert('messages',$data);
        return true;
    }    
    function addApplication($offset)
    {
        $this->db->where('id',$this->input->post('property_id'));
        $res = $this->db->get('units');
        $unit_data = $res->row_array();
        $data = array();
        $data['applicant_id'] = $offset;
        $data['application_status'] = 'app';
        $data['company_id'] = $unit_data['company_id'];
        $data['unit_id'] = $this->input->post('property_id');
        $data['is_active'] = '1';
        $data['applied_date'] = date("Y-m-d H:i:s");
        $this->db->insert('applications',$data);
        return true;
    }
}
