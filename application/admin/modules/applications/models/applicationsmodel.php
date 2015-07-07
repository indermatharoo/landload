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
        $this->db->select('t1.id,t1.lease_from,t3.pname,t4.company_name,t2.fname');
        $this->db->from('applications t1');
        $this->db->join('applicants t2', 't2.applicant_id=t1.applicant_id');
        $this->db->join('properties t3', 't3.id=t1.property_id');
        $this->db->join('company t4', 't4.company_id=t3.company_id');
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
        $this->db->where('id', $id);
        $res = $this->db->get('applications');
        if ($res->num_rows() > 0) {
            return $res->row_array();
        } else {
            redirect('applications/index');
        }
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
        $this->db->select('applications.*,applicants.*,properties.pname');
        $this->db->from('applications');
        $this->db->join('applicants', 'applications.applicant_id=applicants.applicant_id');
        $this->db->join('properties', 'applications.property_id=properties.id');
        
        $results = $this->db->get();
        if($results->num_rows()>0){
            $results = $results->row_array();
            return $results;
        }
        return FALSE;
        //echo $this->db->last_query();
        //result_array();
        
    }

}
