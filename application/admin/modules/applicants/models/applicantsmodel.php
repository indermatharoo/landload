<?php

class Applicantsmodel extends Basemodel {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    function countAll() {
        $this->db->from('applicants');
        return $this->db->count_all_results();
    }

    function listAll($offset,$limit)
    {
        if ($offset)
            $this->db->offset($offset);
        if ($limit)
            $this->db->limit($limit);
        $this->db->join('applicant_type','applicant_type.code=applicants.type');
        return $this->db->get('applicants')->result_array();
    }
    function getApplicantType()
    {
       return $this->db->get('applicant_type')->result_array();
        
    }
    function getAllApplicants()
    {
       return $this->db->get('applicants')->result_array();
    }
    function getAllfeatures()
    {
        return $this->db->get('features')->result_array();
    }
    function getApplicantDetails($id)
    {
        $this->db->where('applicant_id',$id);
        $res = $this->db->get('applicants');
        if($res->num_rows()>0)
        {
            return $res->row_array();
        }
        else
        {
            redirect('applicants/index');
        }
    }
    function insertRecord()
    {
        $data = array();
        $data['fname'] = $this->input->post('fname');
        $data['lname'] = $this->input->post('lname');
        $data['email'] = $this->input->post('email');
        $data['phone'] = $this->input->post('phone');
        $data['birthdate'] = date('Y-m-d',strtotime($this->input->post('birth_date')));
        $data['license'] = $this->input->post('license');
        $data['password'] = md5($this->input->post('passwd'));
        $data['address'] = $this->input->post('address');
        $data['monthly_gross'] = $this->input->post('monthly_gross');
        if(trim($this->input->post('additional_income'))!=""){$data['additional'] = $this->input->post('additional_income');}else{$data['additional']=NULL;}
        $data['asset'] = $this->input->post('assets');
        $data['type'] = $this->input->post('status');
        $this->db->insert('applicants',$data);
        return $this->db->insert_id();
    }
    function updateRecord($id)
    {
        $data = array();
        $data['fname'] = $this->input->post('fname');
        $data['lname'] = $this->input->post('lname');
        $data['email'] = $this->input->post('email');
        $data['phone'] = $this->input->post('phone');
        $data['birthdate'] = date('Y-m-d',strtotime($this->input->post('birth_date')));
        $data['license'] = $this->input->post('license');
        
        
        if(trim($this->input->post('passwd'))!=""){
             $data['password'] = md5($this->input->post('passwd'));
        }
        $data['address'] = $this->input->post('address');   
        $data['monthly_gross'] = $this->input->post('monthly_gross');
        if(trim($this->input->post('additional_income'))!=""){$data['additional'] = $this->input->post('additional_income');}else{$data['additional']=NULL;}
        $data['asset'] = $this->input->post('assets');
        $data['type'] = $this->input->post('status');
        $this->db->where('applicant_id',$id);
        $this->db->update('applicants',$data);
        return $this->db->insert_id();
    }
    function DeleteRecord($id)
    {
       $this->db->where('id',$id);
       $this->db->delete('applicants');
    }
    function getRecentApplicants()
    {
        $this->db->order_by("applicant_id", "desc");
        $this->db->limit(10);
        $res = $this->db->get('applicants');
        return array('num_rows'=>$res->num_rows(),'results'=>$res->result_array());
    }
}