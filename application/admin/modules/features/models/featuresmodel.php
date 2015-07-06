<?php

class Featuresmodel extends Basemodel {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    function countAll() {
        $this->db->from('features');
        return $this->db->count_all_results();
    }

    function listAll($offset,$limit)
    {
        if ($offset)
            $this->db->offset($offset);
        if ($limit)
            $this->db->limit($limit);
        
        return $this->db->get('features')->result_array();
    }
    function getAllfeatures()
    {
        return $this->db->get('features')->result_array();
    }
    function getFeatureDetails($id)
    {
        $this->db->where('id',$id);
        $res = $this->db->get('features');
        if($res->num_rows()>0)
        {
            return $res->row_array();
        }
        else
        {
            redirect('featues/index');
        }
    }
    function insertRecord()
    {
        $data = array();
        $data['tag'] = $this->input->post('feature');
        $this->db->insert('features',$data);
        return $this->db->insert_id();
    }
    function updateRecord($id)
    {
        $data = array();
        $data['tag'] = $this->input->post('feature');
        $this->db->where('id',$id);
        $this->db->update('features',$data);
    }
    function DeleteRecord($id)
    {
       $this->db->where('id',$id);
       $this->db->delete('features');
    }
}