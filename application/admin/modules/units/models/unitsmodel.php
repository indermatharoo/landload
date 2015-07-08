<?php

class Unitsmodel extends Basemodel {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    static public $types = array(
        1 => 'Weekly',
        2 => 'Monthly'
    );
            
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
    function getUnitType()
    {
        return $this->db->get('unit_type')->result_array();
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
        $data = rSF('units');
        $data['is_active'] = $this->input->post('active');
        $data['description'] = $this->input->post('description');
        $data['datetime'] = date('Y-m-d H:i:s');
        $data['amount_type'] = $this->input->post('amount_type');
//        e($data);
        $config['upload_path'] = $this->config->item('UNIT_IMAGE_PATH');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;

        if(!empty($_POST['features']))
        {
            $data['features'] =  implode($_POST['features'],'|');
        }
        else
        {
            $data['features']='';
        }
         
        $this->db->insert('units',$data);
        $unit_id = $this->db->insert_id(); 
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
       // return $this->db->insert_id();
    }
    function getImageName($id)
    {
        $this->db->where('image_id',$id);
        return $this->db->get('unit_image')->row_array();
    }
    function updateRecord($id)
    {
        
        if(isset($_POST['deleteImage']))
        {
            foreach($_POST['deleteImage'] as $delImg)
            {
                $imgar = $this->getImageName($delImg);
                @unlink($this->config->item('UNIT_IMAGE_PATH').$imgar['image']);
                $this->db->where('image_id',$delImg);
                $this->db->delete('unit_image');
            }
        }

        $data = array();
        $data['property_id'] = $this->input->post('property_id');
        $data['unit_number'] = $this->input->post('unit_number');
        $data['status'] = $this->input->post('status');
        $data['area'] = $this->input->post('area');
        $data['room'] = $this->input->post('room');
        $data['bathroom'] = $this->input->post('bathroom');
        $data['amount'] = $this->input->post('amount');
        $data['amount_type'] = $this->input->post('amount_type');
        $data['unit_type'] = $this->input->post('unit_type');
        $data['is_active'] = $this->input->post('active');
        $data['description'] = $this->input->post('description');
       
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
                $this->db->insert('unit_image',array('image'=>$images['file_name'],'unit_id'=>$id));
            }
        }        
    }
    function DeleteRecord($id)
    {
       $this->db->where('id',$id);
       $this->db->delete('units');
    }
    function getUnitImages($id)
    {
        $this->db->where('unit_id',$id);
        $res = $this->db->get('dpd_unit_image');
        return array('num_rows'=>$res->num_rows(),'result'=>$res->result_array());
    }
    function getUnitsByPropertyId($id)
    {
        $this->db->where('property_id',$id);
        $res = $this->db->get('units');
        return $res->result_array();
    }
}