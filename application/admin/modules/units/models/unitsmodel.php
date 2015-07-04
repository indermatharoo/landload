<?php

class Unitsmodel extends Basemodel {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    function countAll() {
        $this->db->from('units');
        return $this->db->count_all_results();
    }

    function listAll($offset,$limit)
    {
        if ($offset)
            $this->db->offset($offset);
        if ($limit)
            $this->db->limit($limit);
        $this->db->select('units.id as unit_id,units.*,properties.*');
        $this->db->join('properties','properties.id=units.property_id','left');
        return $this->db->get('units')->result_array();
    }
    function getUnitDetails($id)
    {
        $this->db->where('id',$id);
        $res = $this->db->get('units');
        if($res->num_rows()>0)
        {
            return $res->row_array();
        }
        else
        {
            redirect('units/index');
        }
    }
    function insertRecord()
    {
        $data = array();
        $data['property_id'] = $this->input->post('property_id');
        $data['unit_number'] = $this->input->post('unit_number');
        $data['status'] = $this->input->post('status');
        $data['area'] = $this->input->post('area');
        $data['room'] = $this->input->post('room');
        $data['bathroom'] = $this->input->post('bathroom');
        $data['amount'] = $this->input->post('amount');
        $config['upload_path'] = $this->config->item('UNIT_IMAGE_PATH');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;
        $this->load->library('upload', $config);
        if (count($_FILES) > 0) {
            if ($_FILES['photo']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['photo']['tmp_name'])) {
                if (!$this->upload->do_upload('photo')) {
                    show_error($this->upload->display_errors('<p class="err">', '</p>'));
                    return FALSE;
                } else {
                    $upload_data = $this->upload->data();
                    $data['photo'] = $upload_data['file_name'];
                }
            }
        }
           if(!empty($_POST['features']))
        {
            $data['features'] =  implode($_POST['features'],'|');
        }
        else
        {
            $data['features']='';
        }
         
        $this->db->insert('units',$data);
        return $this->db->insert_id();
    }
    function updateRecord($id)
    {
        $data = array();
        $data['property_id'] = $this->input->post('property_id');
        $data['unit_number'] = $this->input->post('unit_number');
        $data['status'] = $this->input->post('status');
        $data['area'] = $this->input->post('area');
        $data['room'] = $this->input->post('room');
        $data['bathroom'] = $this->input->post('bathroom');
        $data['amount'] = $this->input->post('amount');
        $config['upload_path'] = $this->config->item('UNIT_IMAGE_PATH');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;
        $this->load->library('upload', $config);
        if (count($_FILES) > 0) {
            if ($_FILES['photo']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['photo']['tmp_name'])) {
                if (!$this->upload->do_upload('photo')) {
                    //show_error($this->upload->display_errors('<p class="err">', '</p>'));
                    //return FALSE;
                } else {
                    $upload_data = $this->upload->data();
                    $data['photo'] = $upload_data['file_name'];
                }
            }
        }
        if(!empty($_POST['features']))
        {
            $data['features'] =  implode($_POST['features'] ,'|');
        }
        else
        {
            $data['features']='';
        }
        $this->db->where('id',$id);
        $this->db->update('units',$data);
    }
    function DeleteRecord($id)
    {
       $this->db->where('id',$id);
       $this->db->delete('units');
    }
    function getUnitsByPropertyId($id)
    {
        $this->db->where('property_id',$id);
        $res = $this->db->get('units');
        return $res->result_array();
    }
}