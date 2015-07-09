<?php

class Propertiesmodel extends Basemodel {
    public $company_id;
    function __construct() {
        // Call the Model constructor
        parent::__construct();
        
        if($this->aauth->isUser()){
            $this->company_id = curUsrPid();
        }
        else if($this->aauth->isCompany()){
            $this->company_id = curUsrId();
        }
        else if($this->aauth->isAdmin()){
            
        }
    }
    function countAll() {
        $this->db->from('properties');
        return $this->db->count_all_results();
    }
    function getPropertiesType()
    {
        $res = $this->db->get('properties_type');
        return $res->result_array();
    }
    function listAll($offset,$limit)
    {
        if ($offset)
            $this->db->offset($offset);
        if ($limit)
            $this->db->limit($limit);
            
        return $this->db->get('properties')->result_array();
    }
    function getPropertDetails($id)
    {
        $this->db->where('id',$id);
        $res = $this->db->get('properties');
        if($res->num_rows()>0)
        {
            return $res->row_array();
        }
        else
        {
            redirect('properties/index');
        }
    }
    function getPropertiesList()
    {
        $this->db->select('id,pname,is_active');
        $res = $this->db->get('properties');
        return $res->result_array();
    }
    function insertRecord()
    {
        $data = array();
        $data['pname'] = $this->input->post('pname');
        $data['type'] = $this->input->post('ptype');
        $data['units'] = $this->input->post('units');
        $data['owner'] = $this->input->post('owner');
        
        $data['street'] = $this->input->post('street');
        $data['city'] = $this->input->post('city');
        $data['state'] = $this->input->post('state');
        $data['post_code'] = $this->input->post('postcode');
        $data['is_active'] = $this->input->post('active');
        $data['datetime'] = date('Y-m-d H:i:s');
        //e($data);
        if($this->aauth->isCompany()):
            $data['company_id'] = curUsrId();
        elseif($this->aauth->isUser()):            
            $data['company_id'] = curUsrPid();
        endif;
       $config['upload_path'] = $this->config->item('PROPERTY_IMAGE_PATH');
       
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
        $this->db->insert('properties',$data);
        echo $this->db->last_query();
        return $this->db->insert_id();
    }
    function getRecentProperties()
    {
        $this->db->select('properties.*,properties_type.type as property_type');
        $this->db->order_by("datetime", "desc");
        $this->db->join('properties_type','properties_type.short_code=properties.type');
        $this->db->limit(10);
        $res = $this->db->get('properties');
        return array('num_rows'=>$res->num_rows(),'results'=>$res->result_array());
    }
    function updateRecord($id)
    {
        $data = array();
        $data['pname'] = $this->input->post('pname');
        $data['type'] = $this->input->post('ptype');
        $data['units'] = $this->input->post('units');
        $data['owner'] = $this->input->post('owner');
        
        $data['street'] = $this->input->post('street');
        $data['city'] = $this->input->post('city');
        $data['state'] = $this->input->post('state');
        $data['post_code'] = $this->input->post('postcode');
        $data['is_active'] = $this->input->post('active');
        $config['upload_path'] = $this->config->item('PROPERTY_IMAGE_PATH');
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
        $this->db->where('id',$id);
        $this->db->update('properties',$data);
    }
    function DeleteRecord($id)
    {
       $this->db->where('id',$id);
       $this->db->delete('properties');
    }
}