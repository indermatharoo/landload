<?php

class Applicationsmodel extends Basemodel {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function countAll() {
        $this->db->from('applications');
        return $this->db->count_all_results();
    }

    function listAll() {
//        if ($offset)
//            $this->db->offset($offset);
//        if ($limit)
//            $this->db->limit($limit);
//
//        $this->db->select('applications.*,applicants.fname,applicants.lname')
//                ->from('applications')
//                ->join('applicants', 'applications.applicant_id=applicants.applicant_id');
//        $query = $this->db->get();
//        if ($query->num_rows() > 0) {
//            return $query->result_array();
//        }
//        return FALSE;
//        $this->db->select('t1.id,t1.lease_from,t3.pname,t4.company_name,t2.fname');
        $this->db->select('t1.id as application_id,t1.*,t2.*,t3.*,t4.*');
        $this->db->from('applications t1');
        $this->db->join('applicants t2', 't2.applicant_id=t1.applicant_id');
        $this->db->join('properties t3', 't3.id=t1.property_id');
        $this->db->join('user_extra_detail t4', 't4.id=t3.company_id');
        $results = $this->db->get()->result_array();
        return $results;
    }

    function getApplicationType() {
        return $this->db->get('application_type')->result_array();
    }

    function getAllfeatures() {
        return $this->db->get('features')->result_array();
    }

    function getApplicationDetails($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->from('applications');
        $this->db->join('job_details','job_details.applicant_id = applications.applicant_id');
        $res = $this->db->get();
        if ($res->num_rows() > 0) {
            return $res->row_array();
        } else {
            redirect('applications/index');
        }
    }
    function getJobInformation()
    {
        
    }
    function getLeaseTypes() {
        return $this->db->get('lease_type')->result_array();
    }

    function insertRecord() {
        $data = array();
        $data['applicant_id'] = $this->input->post('applicant_id');
        $data['application_status'] = $this->input->post('application_status');
        $data['property_id'] = $this->input->post('property_id');
        $data['unit_id'] = $this->input->post('unit_id');
        $data['lease_type'] = $this->input->post('lease_type');
        $data['occupants'] = $this->input->post('occupants');
        $data['lease_from'] = date('Y-m-d', strtotime($this->input->post('lease_from')));
        $data['lease_to'] = date('Y-m-d', strtotime($this->input->post('lease_to')));
        $data['charges_frequency'] = $this->input->post('charges_frequence');
        $data['next_due'] = date('Y-m-d', strtotime($this->input->post('next_due')));
        $data['rent_amount'] = $this->input->post('rental_amount');
        $data['security_amount'] = $this->input->post('security_amount');
        $data['security_date'] = date('Y-m-d', strtotime($this->input->post('security_deposit_date')));
        $data['emergency_contact'] = $this->input->post('emeregency_contact');
        $data['co_signer'] = $this->input->post('cosigner');
        if (trim($data['co_signer']) == "") {
            $data['co_signer'] = "";
        }
        $data['notes'] = $this->input->post('notes');




        $this->db->insert('applications', $data);

        return $this->db->insert_id();
    }

    function updateRecord($id) {
        $data = array();
        $data = array();
        $data['applicant_id'] = $this->input->post('applicant_id');
        $data['application_status'] = $this->input->post('application_status');
        $data['property_id'] = $this->input->post('property_id');
        $data['unit_id'] = $this->input->post('unit_id');
        $data['lease_type'] = $this->input->post('lease_type');
        $data['occupants'] = $this->input->post('occupants');
        $data['lease_from'] = date('Y-m-d', strtotime($this->input->post('lease_from')));
        $data['lease_to'] = date('Y-m-d', strtotime($this->input->post('lease_to')));
        $data['charges_frequency'] = $this->input->post('charges_frequence');
        $data['next_due'] = date('Y-m-d', strtotime($this->input->post('next_due')));
        $data['rent_amount'] = $this->input->post('rental_amount');
        $data['security_amount'] = $this->input->post('security_amount');
        $data['security_date'] = date('Y-m-d', strtotime($this->input->post('security_deposit_date')));
        $data['emergency_contact'] = $this->input->post('emeregency_contact');
        $data['co_signer'] = $this->input->post('cosigner');
        if (trim($data['co_signer']) == "") {
            $data['co_signer'] = "";
        }
        $data['notes'] = $this->input->post('notes');



        $this->db->where('id', $id);
        $this->db->update('applications', $data);
    }

    function DeleteRecord($id) {
        $this->db->where('id', $id);
        $this->db->delete('applications');
    }

    function getUserDetails($id) {
        $this->db->select('applications.*,applicants.*,properties.pname,job_details.current_job,job_details.previous_job,job_details.experience');
        $this->db->from('applications');
        $this->db->join('applicants', 'applications.applicant_id=applicants.applicant_id');
        $this->db->join('properties', 'applications.property_id=properties.id');
        $this->db->join('job_details', 'applications.applicant_id=job_details.applicant_id','left');
        $this->db->where('applications.id',$id);
        $results = $this->db->get();
        if($results->num_rows()>0){
            $results = $results->row_array();
            return $results;
        }
        return FALSE;
        //echo $this->db->last_query();
        //result_array();
        
    }
    function saveUserDetails($id)
    {
        $data = array();
         $data['fname'] =$this->input->post('fname');
         $data['lname'] =$this->input->post('lname');
         $data['email'] =$this->input->post('email');
         $data['phone'] =$this->input->post('phone');
         $data['address'] =$this->input->post('address');
         $this->db->where('applicant_id',$id);
         $this->db->update('applicants',$data);
         echo json_encode(array('response'=>'true','msg'=>'User information is successfully saved','tab'=>"2"));
    }
    function getJobExistence($id)
    {
        $this->db->where('applicant_id',$id);
        if($this->db->get('job_details')->num_rows() > 0)
        {
            return true;
        }
        else {
            return false;
        }
    }
    function saveJobDetails($id="")
    {
        $data = array();
        $data['current_job'] =$this->input->post('current_job');
        $data['previous_job'] =$this->input->post('previous_job');
        $data['experience'] =$this->input->post('experience');
        if($this->getJobExistence($id) )
        {
            $this->db->where('applicant_id',$id);
            $this->db->update('job_details',$data);
            
        }
        else
        {
            $data['applicant_id'] = $id;
             $this->db->insert('job_details',$data);
        }

        echo json_encode(array('response'=>'true','msg'=>'Job information is successfully saved','tab'=>"3"));
    }    
    function savePropertyDetails($id)
    {
        $data = array();
        $data['property_id'] =$this->input->post('property_id');
        $data['unit_id'] =$this->input->post('unit_id');
            $this->db->where('id',$id);
            $this->db->update('applications',$data);

       echo json_encode(array('response'=>'true','msg'=>'Property information is successfully saved','tab'=>"4"));
    }        
    function saveAgreeDetails($id)
    {
        $data = array();
        $data['date_of_month'] =$this->input->post('date_of_month');
        $data['day_of_week'] =$this->input->post('day_of_week');
        $data['invoice_type'] =$this->input->post('ptype');
        
        if($data['invoice_type']=="M")
        {
            $data['day_of_week'] = "";
        }
        else
        {
            $data['date_of_month'] = "0000-00-00";
        }
        
        $data['refundable'] =$this->input->post('refund');
        $data['invoice_amount'] =$this->input->post('rent_amount');
        $data['start_date'] =date('Y-m-d H:i:s');
        $data['security_amount'] =$this->input->post('security_amount');
        
            $this->db->where('id',$id);
            $this->db->update('applications',$data);

        echo json_encode(array('response'=>'true','msg'=>'Agreement information is successfully saved','tab'=>"5"));
    }        
    public function UploadDocuments()
    {
        $this->load->library('upload', $config);
        $this->upload->initialize(array(
            "upload_path"   => $this->config->item('UNIT_IMAGE_PATH'),
            'allowed_types'=>'gif|jpg|png'
                
        ));
        if($this->upload->do_multi_upload("photo")) {
            //Print data for all uploaded files.
            print_r($this->upload->get_multi_upload_data());
            foreach($this->upload->get_multi_upload_data() as $images)
            {
                $this->db->insert('unit_image',array('image'=>$images['file_name'],'unit_id'=>$unit_id));
            }
        }
    }
    public function getUploadedDocuments($id)
    {
        $this->db->where('assignes',$id); 
        $res = $this->db->get('virtualCab') ; 
        return array('num_rows'=>$res->num_rows(),'result'=>$res->result_array());
    }
}
