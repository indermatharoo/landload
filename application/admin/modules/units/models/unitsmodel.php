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

    function listAll($offset, $limit) {
        if ($offset)
            $this->db->offset($offset);
        if ($limit)
            $this->db->limit($limit);
        $this->db->select('units.id as unit_id,units.*,properties.*');
        $this->db->join('properties', 'properties.id=units.property_id', 'left');
        return $this->db->get('units')->result_array();
    }

    function getUnitType() {
        return $this->db->get('unit_type')->result_array();
    }

    function getUnitDetails($id) {
        $this->db->where('id', $id);
        $res = $this->db->get('units');
        if ($res->num_rows() > 0) {
            return $res->row_array();
        } else {
            redirect('units/index');
        }
    }

    function insertRecord() {
        $data = array();
        $data = rSF('units');
        $data['is_active'] = $this->input->post('active');
        $data['description'] = $this->input->post('description');
        $data['datetime'] = date('Y-m-d H:i:s');
        $data['amount_type'] = $this->input->post('amount_type');
        $data['is_featured'] = $this->input->post('is_featured');
//        e($data);
        
        $config_slug = array(
        'field' => 'uri',
        'title' => 'title',
        'table' => 'units',
        'id' => 'id',
        );
        $this->load->library('slug', $config_slug);
        
        $data_uri = array(
            'title' => $this->input->post('unit_number')
        );
        $data['uri'] = $this->slug->create_uri($data_uri);
        
        if(!empty($_POST['features']))
        {
            $data['features'] =  implode($_POST['features'],'|');
        }
        else
        {
            $data['features']='';
        }
        $config['upload_path'] = $this->config->item('UNIT_IMAGE_PATH');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;
        $this->load->library('upload', $config);
        
        $map_img = $_FILES['map_image']['name'];
        
        if($map_img!=''){
                        
            if ($_FILES['map_image']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['map_image']['tmp_name'])) {
                if (!$this->upload->do_upload('map_image')) {
                    show_error($this->upload->display_errors('<p class="err">', '</p>'));
                    return FALSE;
                } else {
                    $upload_data = $this->upload->data();
                     $data['map_image'] = $upload_data['file_name'];
                }
            }
        }
        
        if (count($_FILES) > 0) {
            
            //e($_FILES);
            
            if ($_FILES['photo']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['photo']['tmp_name'])) {
                if (!$this->upload->do_upload('photo')) {
                    show_error($this->upload->display_errors('<p class="err">', '</p>'));
                    return FALSE;
                } else {
                    $upload_data = $this->upload->data();
                    $data['unit_image'] = $upload_data['file_name'];
                }
            }
            
            
        }
        $status = $this->db->insert('units', $data);
        if ($status) {
            $unit_id = $this->db->insert_id();
            if ($unit_id) {
                $attributes = (gParam('attributes') ? gParam('attributes') : array());
                foreach ($attributes as $key => $value):
                    $data = array();
                    $data['unit_id'] = $unit_id;
                    $data['attribute_id'] = $key;
                    $data['value'] = $value;
                    $this->db->insert('units_attributes_value', $data);
                endforeach;
            }
        }
        $unit_id = $this->db->insert_id();
        $this->upload->initialize(array(
            "upload_path" => $this->config->item('UNIT_IMAGE_PATH'),
            'allowed_types' => 'gif|jpg|png'
        ));
        if ($this->upload->do_multi_upload("galleryImages")) {
            //Print data for all uploaded files.
            print_r($this->upload->get_multi_upload_data());
            foreach ($this->upload->get_multi_upload_data() as $images) {
                $this->db->insert('unit_image', array('image' => $images['file_name'], 'unit_id' => $unit_id));
            }
        }
    }

    function getImageName($id) {
        $this->db->where('image_id', $id);
        return $this->db->get('unit_image')->row_array();
    }

    function updateRecord($id) {

        if (isset($_POST['deleteImage'])) {
            foreach ($_POST['deleteImage'] as $delImg) {
                $imgar = $this->getImageName($delImg);
                @unlink($this->config->item('UNIT_IMAGE_PATH') . $imgar['image']);
                $this->db->where('image_id', $delImg);
                $this->db->delete('unit_image');
            }
        }
              $data = array();
              
        
        $config['upload_path'] = $this->config->item('UNIT_IMAGE_PATH');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;
        $this->load->library('upload', $config);  
        
        $config_slug = array(
            'field' => 'uri',
            'title' => 'title',
            'table' => 'units',
            'id' => 'id',
        );
        $this->load->library('slug', $config_slug);
        
        $data = array(
            'title' => $this->input->post('unit_number'),
        );
        $data['uri'] = $this->slug->create_uri($data, $id);
              
        $map_img = $_FILES['map_image']['name'];
        
        if($map_img!=''){
            $mainimage = $this->getUnitDetails($id);
            @unlink($this->config->item('UNIT_IMAGE_PATH').$mainimage['map_image']);
            
            if ($_FILES['map_image']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['map_image']['tmp_name'])) {
                if (!$this->upload->do_upload('map_image')) {
                    show_error($this->upload->display_errors('<p class="err">', '</p>'));
                    return FALSE;
                } else {
                    $upload_data = $this->upload->data();
                     $data['map_image'] = $upload_data['file_name'];
                }
            }
        }
        
        if(!empty($_FILES['photo']['name']))
        {
            
            $mainimage = $this->getUnitDetails($id);
            @unlink($this->config->item('UNIT_IMAGE_PATH').$mainimage['unit_image']);
            
             if (count($_FILES) > 0) {
                 if ($_FILES['photo']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['photo']['tmp_name'])) {
                     if (!$this->upload->do_upload('photo')) {
                         show_error($this->upload->display_errors('<p class="err">', '</p>'));
                         return FALSE;
                     } else {
                         $upload_data = $this->upload->data();
                          $data['unit_image'] = $upload_data['file_name'];
                     }
                 }
        }
        }
  
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
        $data['is_featured'] = $this->input->post('is_featured');
        
        if(!empty($_POST['features']))
        {
            $data['features'] =  implode($_POST['features'] ,'|');
        }
        $this->db->where('id', $id);
        $status = $this->db->update('units', $data);
        if ($status) {
            $unit_id = $id;
            if ($unit_id) {
                $this->db->where('unit_id', $unit_id);
                $this->db->delete('units_attributes_value');
                $attributes = (gParam('attributes') ? gParam('attributes') : array());
                foreach ($attributes as $key => $value):
                    $data = array();
                    $data['unit_id'] = $unit_id;
                    $data['attribute_id'] = $key;
                    $data['value'] = $value;
                    $this->db->insert('units_attributes_value', $data);
                endforeach;
            }
        }
        $this->load->library('upload', $config);
        $this->upload->initialize(array(
            "upload_path" => $this->config->item('UNIT_IMAGE_PATH'),
            'allowed_types' => 'gif|jpg|png'
        ));
        if ($this->upload->do_multi_upload("galleryImages")) {
            //Print data for all uploaded files.

            foreach ($this->upload->get_multi_upload_data() as $images) {
                $this->db->insert('unit_image', array('image' => $images['file_name'], 'unit_id' => $id));
            }
        }
    }

    function DeleteRecord($id) {
        $mainimage = $this->getUnitDetails($id);
        @unlink($this->config->item('UNIT_IMAGE_PATH') . $mainimage['unit_image']);
        $this->db->where('id', $id);
        $this->db->delete('units');

        $imgar = $this->getUnitImages($id);
        print_r($imgar);
        foreach ($imgar['result'] as $img) {
            @unlink($this->config->item('UNIT_IMAGE_PATH') . $img['image']);
        }



        $this->db->where('unit_id', $id);
        $this->db->delete('unit_image');
    }

    function getUnitImages($id) {
        $this->db->where('unit_id', $id);
        $res = $this->db->get('dpd_unit_image');
        return array('num_rows' => $res->num_rows(), 'result' => $res->result_array());
    }

    function getUnitsByPropertyId($id) {
        $this->db->where('property_id', $id);
        $res = $this->db->get('units');
        return $res->result_array();
    }

}
